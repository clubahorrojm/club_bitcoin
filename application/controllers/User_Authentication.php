

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User_Authentication
 *
 * @author Ing. José Solorzano
 */

Class User_Authentication extends CI_Controller {

    public function __construct() {
        parent::__construct();

// Load form helper library
        $this->load->helper('form');

// Load form validation library
        $this->load->library('form_validation');

// Load session library
        $this->load->library('session');

// Load database
        $this->load->model('Login_database');
        $this->load->model('MMails');
        $this->load->model('configuracion/usuarios/Usuarios_model');
        $this->load->model('administracion/MAuditoria');
        $this->load->model('administracion/MPaises');
        $this->load->model('referidos/MRelLinks');
        $this->load->model('referidos/MReferidos');
        $this->load->model('configuracion/grupos_usuarios/ModelsGruposUsuarios');
        $this->load->model('busquedas_ajax/ModelsBusqueda');
		$this->load->model('referidos/MReferidos');
    }

// Show login page
    public function index() {
        $data['fecha'] = $this->uri->segment(1);
        //~ print_r($data);
        $data['listar_paises'] = $this->MPaises->obtenerPais();  // Lista de países
        $this->load->view('login_form', $data);
    }

// Check for user login process
    public function user_login_process() {

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            if ($this->session->userdata('username')) {
               
                redirect('admin_page');
      
            }
            if (isset($this->session->userdata['logged_in'])) {
                if($this->session->userdata['logged_in']['tipo_usuario'] == 'BÁSICO'){
					$this->load->view('base');
					$this->load->view('admin_page');
					header("location: ".base_url()."index.php/referidos/CReferidos");
				}else{
					$this->load->view('base');
					$this->load->view('admin_page');
				}
                               
            } else {
				$data['listar_paises'] = $this->MPaises->obtenerPais();  // Lista de países
                $this->load->view('login_form', $data);
            }
            
        } else {
            
            
            $data = array(
                'username' => $this->input->post('username'),
                'password' => 'pbkdf2_sha256$12000$'.hash( "sha256", $this->input->post('password') )
            );
            $result = $this->Login_database->login($data);
            if ($result == true) {

                $username = $this->input->post('username');
                $result = $this->Login_database->read_user_information($username);
                if ($result != false) {
                    $data['list_grupos'] = $this->ModelsGruposUsuarios->obtenerGrupoUsuarios($result[0]->tipo_usuario);
                    //$data['cargo'] = $this->ModelsCargos->obtenerCargo($result[0]->cargo);
                    foreach ($data['list_grupos'] as $value) {
                        //print_r($value);
                        $name =  $value->name;
                    }
                    
//                    foreach ($data['cargo'] as $valu) {
////                        print_r($valu);
//                        $cargo =  $valu->cargo;
//                    }
//                    echo 'hols'. $result[0]->fecha_create;

                    $session_data = array(
                        'username' => $result[0]->username,
                        'email' => $result[0]->email,
                        //'cargo' => $cargo,
                        'tipo_usuario' => $name,
                        'id' => $result[0]->id,
                        'codigo' => $result[0]->codigo,
                        'picture' => $result[0]->picture,
                        'fecha_create' => $result[0]->fecha_create
                        
                    );

// Add user data in session
                    $this->session->set_userdata('logged_in', $session_data);
                    if($session_data['tipo_usuario'] == 'BÁSICO'){
						$this->load->view('base');
						$this->load->view('admin_page');
						header("location: ".base_url()."index.php/referidos/CReferidos");
					}else{
						$this->load->view('base');
						$this->load->view('admin_page');
					}
                    $param   = array(
						'tabla' => '',
						'codigo' => '',
						'accion' => 'Inicio de Sesion',
						'fecha'   => date('Y-m-d'),
						'hora'   =>  date("h:i:s a"),
						'usuario' => $result[0]->id,
					);
                $this->MAuditoria->add($param);
                }
            } else {
                $data = array(
                    'error_message' => 'Usuario y Contraseñas Invalidos'
                );
                $data['listar_paises'] = $this->MPaises->obtenerPais();  // Lista de países
                $this->load->view('login_form', $data);
            }
        }
    }

// Logout from admin page
    public function logout($id) {

// Removing session data
        $sess_array = array(
            'username' => ''
        );
        $this->session->unset_userdata('logged_in', $sess_array);
        $data['message_display'] = 'Sesión Cerrada con exito';
        $data['listar_paises'] = $this->MPaises->obtenerPais();  // Lista de países
        $this->load->view('login_form', $data);
        $param   = array(
            
                    'tabla' => '',
                    'codigo' => '',
                    'accion' => 'Cerrada la Sesión',
                    'fecha'   => date('Y-m-d'),
                    'hora'   =>  date("h:i:s a"),
                    'usuario' => $id,
        );
        $this->MAuditoria->add($param);
    }
    
    // Método para recuperación de clave
    function recuperar() {
		$usuario = $this->input->post('username_rec');
		$clave_maestra = 'pbkdf2_sha256$12000$'.hash( "sha256", $this->input->post('password_rec'));
		$nueva_clave = (string)rand();
		$nueva_clave_encrip = 'pbkdf2_sha256$12000$'.hash( "sha256",$nueva_clave);
		//~ echo $usuario;
		//~ echo $clave_maestra;
		
		// Verificamos la clave maestra
		$data_clave = $this->Login_database->obtenerClave($clave_maestra);
		if(count($data_clave) > 0){
			// Consultamos los datos del usuario
			$data_usuario = $this->Login_database->obtenerUsuarioName($usuario);
			if(count($data_usuario) > 0){
				$passwd = $nueva_clave_encrip;  // Clave encriptada
				$update_usuario = $this->Login_database->actualizarPasswd($data_usuario->id,$passwd);
				echo "Nueva Clave de Acceso: $nueva_clave";
			}else{
				echo "Usuario o clave incorrectos";
			}
			
		}else{
			echo "Usuario o clave incorrectos";
		}
	}
	
	// Método para registrar nuevo usuario referido
    function registrar_referido() {
		$usuario = $this->input->post('username_reg');
		$clave_nueva = 'pbkdf2_sha256$12000$'.hash( "sha256", $this->input->post('password_reg'));
		$codigo = $this->input->post('codigo');
		$link = $this->input->post('link');
		$enlace = base_url().'index.php?codigo='.$codigo.'&link='.$link;
		$fecha = explode('/',$this->input->post('fecha_na'));
        $fecha = $fecha[2].'-'.$fecha[1].'-'.$fecha[0];

		$codigo_usuario = $this->ModelsBusqueda->count_all_table('usuarios') + 1;
		
		// Preparamos los datos del nuevo usuario
		$data_usuario = array(
			'id' => $codigo_usuario,
			'codigo' => $codigo_usuario,
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'fecha_na' => $fecha,
			'email' => $this->input->post('correo'),
			'username' => $usuario,
			'password' => $clave_nueva,
			'tipo_usuario' => '3',
			'estatus' => True,
			'pais_id' => $this->input->post('pais_id'),
			'patrocinador_id' => $this->input->post('patrocinador_id'),
			'fecha_create' => date('Y-m-d H:i:s'),
			'fecha_update' => date('Y-m-d H:i:s'),
		);
		
		// Registramos los datos del usuario y su perfil
		$reg_usuario = $this->Usuarios_model->insertar($data_usuario);
		
		// Actualizamos el estatus y el id(código) del usuario referido registrado
		$estatus_link = $this->ModelsBusqueda->obtenerRegistro('ref_rel_links', 'links', $enlace);
		$estatus_link = $estatus_link->estatus;
		
		if($estatus_link == 1){
			$estatus_link = 2;
		}else if($estatus_link == 3){
			$estatus_link = 4;
		}
		
		$data_link = array(
			'links' => $enlace,
			'estatus' => $estatus_link,
			'referido_id' => $codigo_usuario,
		);
		
		$update_link = $this->MRelLinks->actualizarRelLinks2($data_link);
		
		// Enviamos un correo con la información del monedero de la empresa al correo proporcionado por el usuario
		// Datos del monedero bitcoin de la empresa
        $monedero_emp = $this->ModelsBusqueda->obtenerRegistro('adm_monedero', 'id', 1);
		$datos_reg = array(
			'username' => $usuario,
			'email' => $this->input->post('correo'),
			'password' => $this->input->post('password_reg'),
			'monedero_emp' => $monedero_emp->monedero
		);
		$this->MMails->enviarMailConfirm($datos_reg);
	}
	
	// Método para registro de perfil nuevo con la identificación (código) del usuario padre
	public function registrar_perfil(){
		$usuario = $this->input->post('username_reg');
		$tipo_moneda = $this->input->post('tipo_moneda');
		$referido_id = $this->input->post('codigo');
		$link = $this->input->post('link');
		
		echo "Código usuario referido: ".$referido_id;
		echo "Link usuario referido: ".$link;
		
		// Buscamos los datos del usuario por su nombre para obtener su código
		$data_usuario = $this->Login_database->obtenerUsuarioName($usuario);
		
		// Buscamos los datos del usuario padre (referido) por su código
		$data_padre = $this->ModelsBusqueda->obtenerRegistro('ref_perfil', 'usuario_id', $referido_id);
		
		// Generamos automáticamente el código del nuevo perfil
		$codigo_perfil = $this->ModelsBusqueda->count_all_table('ref_perfil') + 1;
		
		$data_perfil = array(
			'id' => $codigo_perfil,
			'codigo' => $codigo_perfil,
			'usuario_id' => $data_usuario->codigo,
			'maximo' => $data_padre->maximo,
			'disponible' => 0,
			'estatus' => 1,
			'referido_id' => $referido_id,
			't_moneda_id' => $data_padre->t_moneda_id,
			'monto_pago' => $data_padre->monto_pago,
			'monto_retiro_minimo' => $data_padre->monto_retiro_minimo,
			'cargo_mora' => $data_padre->cargo_mora,
			'fecha' => date('Y-m-d'),
		);
		
		$reg_perfil = $this->Usuarios_model->insertar_perfil($data_perfil);
	}
	// Método para registro de perfil nuevo con la identificación (código) del usuario padre
	public function actualizar_perfil(){
		$datos2 = array(
            'codigo'=> $this->input->post('pk_perfil'),
            'estatus'=> 5,
        );
		$result = $this->MReferidos->actualizarReferidos($datos2);
	}
	
	// Método para búsqueda de siguiente enlace correspondiente para registro de nuevo usuario
	public function enlace_disponible(){
		echo $result = $this->ModelsBusqueda->search_next_link();
	}
	// Método para búsqueda de siguiente enlace correspondiente para registro de nuevo usuario
	public function enlace_disponible2(){
		echo $result = $this->ModelsBusqueda->search_next_link2();
	}

	function cargar_punteros(){
        $resultado = $this->ModelsBusqueda->search_punteros();
		//print_r($resultado);
		//saco el numero de elementos
		$longitud = count($resultado);
		
		//~ echo $longitud;
		
		// Arreglo para retornar la data
		$lista_regs = array();
		
		//Recorro todos los elementos
		for($i=0; $i<$longitud; $i++) {
			  //saco el valor de cada elemento
			  $nombre = $resultado[$i]->username;
			  $lgt = $resultado[$i]->longitud;
			  $ltd = $resultado[$i]->latitud;
			  // print_r("{ latLng:[".$longitud.",".$latitud."], name:'".$nombre."'}, ");
			  // Armamos el registro
			  $reg['latLng'][0] = $lgt;
			  $reg['latLng'][1] = $ltd;
			  $reg['name'] = $nombre;
			  // Listamos el registro
			  $lista_regs[$i] = $reg;
		}
		
		// Alternativa que también funciona
		//~ foreach($resultado as $r){
			//~ $reg = array();
			//~ $latLng = array();
			//~ $nombre = $r->username;
			//~ $lgt = $r->longitud;
			//~ $ltd = $r->latitud;
			//~ // Armamos el registro
			//~ $latLng[0] = $lgt;
			//~ $latLng[1] = $ltd;
			//~ $reg['latLng'] = $latLng;
			//~ $reg['name'] = $nombre;
			//~ // Listamos el registro
			//~ $lista_regs[] = $reg;
		//~ }
		
		echo json_encode($lista_regs);
    }
	function cargar_grafica_pagos(){
		$cod_user = $this->session->userdata['logged_in']['id'];
        $resultado = $this->ModelsBusqueda->search_pagos($cod_user);
		//print_r($resultado);
		//saco el numero de elementos
		$longitud = count($resultado);
		
		//~ echo $longitud;
		// Arreglo para retornar la data
		$lista_fechas = array();
		$lista_cant_pagos = array();
		//Recorro todos los elementos
		for($i=0; $i<$longitud; $i++) {
			  //saco el valor de cada elemento
			  //$fecha = $resultado[$i]->fecha;
			  $total = $resultado[$i]->total;
			  //$ltd = $resultado[$i]->latitud;
			  // print_r("{ latLng:[".$longitud.",".$latitud."], name:'".$nombre."'}, ");
			  // Armamos el registro
			  //$reg_fec['fecha'][0] = $fecha;
			  $reg_tot = $total;
			  //$reg['name'] = $nombre;
			  // Listamos el registro
			  //$lista_fechas[$i] = $reg_fec;
			  $lista_cant_pagos[$i] = $reg_tot;
		}		
		echo json_encode($lista_cant_pagos);
		//echo json_encode($lista_cant_pagos);
    }
}
