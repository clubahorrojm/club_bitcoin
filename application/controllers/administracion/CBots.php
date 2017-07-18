<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CBots
 *
 * @author Ing. José Solorzano
 */
class CBots extends CI_Controller
{

    public function __construct()
    {


        parent::__construct();

// Load form helper library
        $this->load->helper('form');

        $this->load->helper(array('url'));

        

// Load form validation library
        $this->load->library('form_validation');

// Load session library
        $this->load->library('session');

// Load database
        $this->load->model('administracion/MBots');
        $this->load->model('configuracion/MTiposMonedas');
        $this->load->model('administracion/MAMontos');
        $this->load->model('configuracion/usuarios/Usuarios_model');
        $this->load->model('referidos/MRelLinks');
        $this->load->model('busquedas_ajax/ModelsBusqueda');
        $this->load->model('administracion/MAuditoria');
        
    }

    function index()
    {
		$this->load->view('base');
        $data['listar'] = $this->MBots->obtenerBots();
        $data['monedas'] = $this->MTiposMonedas->obtenerTipoMoneda();
        $data['usuarios'] = $this->Usuarios_model->obtenerUsuarios();
        $data['links'] = $this->MRelLinks->obtenerLinks();
        $this->load->view('administracion/bots/lista', $data);
    }
    
    // Método para guardar un nuevo registro
    public function guardar()
    {
		//~ echo "Hola mundo";
		// Proceso de registro de nueva cuenta
		$ultimo_id  = $this->ModelsBusqueda->count_all_table('adm_cuentas_bot');
		
		$data = array(
			'id' => $ultimo_id + 1,
			'moneda' => $this->input->post('moneda'),
            'monto_pago' => $this->input->post('monto_pago'),
            'monto_retiro_minimo' => $this->input->post('monto_retiro_minimo'),
            'cargo_mora' => $this->input->post('cargo_mora'),
            'fecha' => date('Y-m-d '),
            'user_create' => $this->session->userdata['logged_in']['id'],
        );
        // Registramos el movimiento en la bitacora
        $result = $this->MBots->insertarBots($data);
        if ($result) {
            
            $param = array(
                'tabla' => 'Cuentas Bot',
                'codigo' => $ultimo_id + 1,
                'accion' => 'Registro de Nueva Cuenta',
                'fecha' => date('Y-m-d'),
                'hora' => date("h:i:s a"),
                'usuario' => $this->session->userdata['logged_in']['id'],
            );
            $this->MAuditoria->add($param);
        }
        
    }
    
    // Método de registro de bots (usuarios, perfiles y links)
    public function generar()
    {
        // Lectura de archivo csv
        $ruta = getcwd();  // Obtiene el directorio actual en donde se está trabajando
        $nombre_archivo = "bots.csv";
        $ubicacion_archivo = $ruta."/application/models/scripts/".$nombre_archivo;
        
        $fila = 0;

		$fecha = date('Y-m-d H:i:s');
		
		// Capturamos la abreviatura de la moneda correspondiente para luego construir con ella los nombres de usuario
		$abrv_moneda = $this->ModelsBusqueda->obtenerRegistro('conf_tipos_monedas', 'id', $this->input->post('moneda'));

		if (($archivo = fopen("$ubicacion_archivo","r")) !== FALSE) {
			echo "Lectura correcta";
			print "</br>";
					
			$referido_id = null;  // Variable que almacenará el id del bot número 8
			
			// Preparamos los datos del nuevo perfil
		   // Calculo de monto maximo que tendra en la cuenta el usuario
		   $monto_pago = $this->input->post('monto_pago');
		   $montos = $this->MAMontos->obtenerAMontos(1); // Captura del % por nivel en la asignacion de montos
		   $porcentaje1 = (($monto_pago * $montos->porcentaje1) / 100) * 5;
		   $porcentaje2 = (($monto_pago * $montos->porcentaje2) / 100) * 25;
		   $porcentaje3 = (($monto_pago * $montos->porcentaje3) / 100) * 125;
		   $porcentaje4 = (($monto_pago * $montos->porcentaje4) / 100) * 625;
		   $porcentaje5 = (($monto_pago * $montos->porcentaje5) / 100) * 3125;
		   $porcentaje6 = (($monto_pago * $montos->porcentaje6) / 100) * 15625;
		   $porcentaje7 = (($monto_pago * $montos->porcentaje7) / 100) * 78125;
		   
		   echo $montos->porcentaje7."<br>";
		   
		   echo $porcentaje1."<br>"; 
		   echo $porcentaje2."<br>"; 
		   echo $porcentaje3."<br>"; 
		   echo $porcentaje4."<br>"; 
		   echo $porcentaje5."<br>"; 
		   echo $porcentaje6."<br>"; 
		   echo $porcentaje7."<br>";
		   
		   $total_disponible = $porcentaje1 + $porcentaje2 + $porcentaje3 + $porcentaje4 + $porcentaje5 + $porcentaje6 + $porcentaje7;
		   
		   echo $total_disponible;
			
			while(($data = fgetcsv($archivo, 1000, ";")) !== FALSE){
				$num_columnas = count($data);
				if($fila > 0){
					//~ echo $fila."->".$data[0]."->".$data[1]."->".$fecha;
					$ultimo_id_usu = $this->ModelsBusqueda->count_all_table('usuarios');  // El id del último usuario registrado
					$ultimo_id_perfil = $this->ModelsBusqueda->count_all_table('ref_perfil');  // El id del último perfil registrado
					
					if($fila < 8){
						$referido_id = $ultimo_id_usu;  // Re-asignamos el id del usuario que será el referido de todos los usuarios bots del 8vo en adelante
					}else if($fila == 8){
						$referido_id = $ultimo_id_usu;
					}
					
					// Generación de links para los usuarios bot del 8vo en adelante
					if($fila >= 8){
						//~ echo "Links asociados</br>";
						for($i=0; $i<=4; $i++){
							//~ echo "\t Link".($i+1)."</br>";
							$ultimo_id_bot = $this->ModelsBusqueda->count_all_table('adm_cuentas_bot');  // El id de la última cuenta registrada
							$ultimo_id_link = $this->ModelsBusqueda->count_all_table('ref_rel_links');  // El id del último link registrado
							$link = base_url()."index.php?codigo=".($ultimo_id_usu + 1)."&link=".($i+1);
							// Preparamos los datos del nuevo link
							$data_link = array(
								'id' => $ultimo_id_link + 1,
								'codigo' => $ultimo_id_link + 1,
								'usuario_id' => $ultimo_id_usu + 1,
								'links' => $link,
								'estatus' => 1,
								'referido_id' => null,
								'num_link' => $i+1,
								'fecha' => date('Y-m-d'),
								'bot_id' => $ultimo_id_bot,
							);
							
							$reg_link = $this->MRelLinks->insertarRelLinks($data_link);
							
							if ($reg_link) {
								
								$param = array(
									'tabla' => 'Links',
									'codigo' => $ultimo_id_link + 1,
									'accion' => 'Registro de Nuevo Link',
									'fecha' => date('Y-m-d'),
									'hora' => date("h:i:s a"),
									'usuario' => $this->session->userdata['logged_in']['id'],
								);
								$this->MAuditoria->add($param);
							}
						}
					}
					
					// Registro de nuevo usuario y perfil
					// Preparamos los datos del nuevo usuario
					$nom_usu = $data[0].(string)trim($abrv_moneda->abreviatura).(string)$fila;  // Construimos el nombre de usuario con el contador y la abreviatura de la moneda
					$data_usuario = array(
						'id' => $ultimo_id_usu + 1,
						'codigo' => $ultimo_id_usu + 1,
						'username' => $nom_usu,
						'password' => 'pbkdf2_sha256$12000$'.hash( "sha256", $data[1]),
						'first_name' => $data[2],
						'last_name' => $data[3],
						'tipo_usuario' => $data[4],
						'estatus' => True,
						'fecha_create' => date('Y-m-d H:i:s'),
						'user_create_id' => $this->session->userdata['logged_in']['id'],
					);
					
					// Preparamos los datos del nuevo perfil
					$data_perfil = array(
						'id' => $ultimo_id_perfil + 1,
						'codigo' => $ultimo_id_perfil + 1,
						'usuario_id' => $ultimo_id_usu + 1,
						'maximo' => $total_disponible,
						'disponible' => $this->input->post('monto_pago'),
						'estatus' => 4,
						'referido_id' => $referido_id,
						't_moneda_id' => $this->input->post('moneda'),
						'monto_pago' => $this->input->post('monto_pago'),
						'monto_retiro_minimo' => $this->input->post('monto_retiro_minimo'),
						'cargo_mora' => $this->input->post('cargo_mora'),
						'fecha' => date('Y-m-d'),
					);
					// Registramos los datos del usuario y su perfil
					$reg_usuario = $this->Usuarios_model->insertar($data_usuario);
					if ($reg_usuario) {
						
						$param = array(
							'tabla' => 'Usuarios',
							'codigo' => $ultimo_id_usu + 1,
							'accion' => 'Registro de Nuevo Usuario',
							'fecha' => date('Y-m-d'),
							'hora' => date("h:i:s a"),
							'usuario' => $this->session->userdata['logged_in']['id'],
						);
						$this->MAuditoria->add($param);
					}
					
					$reg_perfil = $this->Usuarios_model->insertar_perfil($data_perfil);
					if ($reg_perfil) {
						
						$param = array(
							'tabla' => 'Perfiles',
							'codigo' => $ultimo_id_perfil + 1,
							'accion' => 'Registro de Nuevo Perfil',
							'fecha' => date('Y-m-d'),
							'hora' => date("h:i:s a"),
							'usuario' => $this->session->userdata['logged_in']['id'],
						);
						$this->MAuditoria->add($param);
					}
				}
				
				$fila += 1;
			}

		}else{
			echo "Falla de lectura";
		}
	}
         
}
