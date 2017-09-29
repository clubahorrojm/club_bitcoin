<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControllersGrupoUsuarios
 *
 * @author Ing. Francis Medina
 */
class ControllersGrupoUsuarios extends CI_Controller
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
        $this->load->model('configuracion/grupos_usuarios/ModelsGruposUsuarios');
        $this->load->model('busquedas_ajax/ModelsBusqueda');
        $this->load->model('administracion/MAuditoria');
        
// Load base view
        $this->load->view('base2');
        
    }

    function index()
    {
		$data['listar'] = '';
        $ultimo_id = $this->ModelsBusqueda->count_all_table('conf_grupo_user');
        if ($ultimo_id > 0){
			$data['listar'] = $this->ModelsGruposUsuarios->obtenerGrupoUsuario();
        }
        else{
            $this->generar();  // Pre-carga de los grupos de usuarios básicos
            $data['listar'] = $this->ModelsGruposUsuarios->obtenerGrupoUsuario();
        }
        $this->load->view('configuracion/grupos_usuarios/lista', $data);
    }

    function registrar()
    {
		$data['ultimo_id'] = $this->ModelsBusqueda->count_all_table('conf_grupo_user');
        $this->load->view('configuracion/grupos_usuarios/registrar', $data);
    }
    
    //metodo para guardar un nuevo registro
    public function guardar()
    {

        $result = $this->ModelsGruposUsuarios->insertar($this->input->post());
        if ($result) {
            
            $param = array(
                'tabla' => 'Grupos Usuarios',
                'codigo' => $this->input->post('codigo'),
                'accion' => 'Nuevo Grupos Usuarios',
                'fecha' => date('Y-m-d'),
                'hora' => date("h:i:s a"),
                'usuario' => $this->session->userdata['logged_in']['id'],
            );
            $this->MAuditoria->add($param);
            redirect('configuracion/grupos_usuarios/ControllersGrupoUsuarios');
        }
    }

    //metodo para editar
    function editar()
    {
        $data['id']     = $this->uri->segment(5);
        $data['editar'] = $this->ModelsGruposUsuarios->obtenerGrupoUsuarios($data['id']);
        $this->load->view('configuracion/grupos_usuarios/editar', $data);
    }
    
    //metodo para eliminar
    function eliminar($id)
    {
		//echo $id;
		$cadena = explode("-", $id);
		$id_reg = $cadena[0];
		$codigo_seg = 'pbkdf2_sha256$12000$'.hash( "sha256", $cadena[1]);;
        $result = $this->ModelsGruposUsuarios->eliminar($id_reg, $codigo_seg);
        
        if ($result) {
            $param = array(
				'tabla' => 'Grupos Usuarios',
				'codigo' => $id,
				'accion' => 'Edición del Grupo de Usuarios',
				'fecha' => date('Y-m-d'),
				'hora' => date("h:i:s a"),
				'usuario' => $this->session->userdata['logged_in']['id'],
			);
			$this->MAuditoria->add($param);
            
            redirect('configuracion/grupos_usuarios/ControllersGrupoUsuarios');
        }
    }

    //Metodo para actualizar
    function actualizar(){
		$data = array(
			'id' => $this->input->post('id'),
            'name' => $this->input->post('name'),
        );
		$codigo_seg = 'pbkdf2_sha256$12000$'.hash( "sha256", $this->input->post('codigo_seg'));
		$result = $this->ModelsGruposUsuarios->actualizar($data, $codigo_seg);
        //$result = $this->ModelsGruposUsuarios->actualizar($this->input->post());
        if ($result) {
            
            $param = array(
                'tabla' => 'Grupos Usuarios',
                'codigo' => $this->input->post('cod_unidad'),
                'accion' => 'Edición de Grupo de Usuarios',
                'fecha' => date('Y-m-d'),
                'hora' => date("h:i:s a"),
                'usuario' => $this->session->userdata['logged_in']['id'],
            );
            $this->MAuditoria->add($param);
            redirect('configuracion/grupos_usuarios/ControllersGrupoUsuarios');
        }
    }
    
     // Método para anular o activar un usuario
    function activar_desactivar($id) {
        //~ echo "Id: ".$id;

        $accion = $this->input->post('accion');
        $estatus = true;

        if ($accion == 'desactivar') {
            $estatus = false;
        }

        // Armamos la data a actualizar
        $data_usuario = array(
            'id' => $id,
            'activo' => $estatus,
            'user_update' => $this->session->userdata['logged_in']['id'],
            'date_update' => date('Y-m-d'),
        );

        // Actualizamos el usuario con los datos armados
        $result = $this->ModelsGruposUsuarios->actualizarEstatus($id, $data_usuario);

//		 Guardado en el módulo de auditoría
        if ($result) {

            $param = array(
                'tabla' => 'Grupo de Usuario',
                'codigo' => $id,
                'accion' => "Se desactivo el Grupo de Usuario",
                'fecha' => date('Y-m-d'),
                'hora' => date("h:i:s a"),
                'usuario' => $this->session->userdata['logged_in']['id'],
            );
            $this->MAuditoria->add($param);
        }
    }

    // Método de registro inicial de tipos de cuenta
    public function generar()
    {
        // Lectura de archivo csv
        $ruta = getcwd();  // Obtiene el directorio actual en donde se está trabajando
        $nombre_archivo = "grupos_usuarios.csv";
        $ubicacion_archivo = $ruta."/application/models/scripts/".$nombre_archivo;
        
        $fila = 0;

		if (($archivo = fopen("$ubicacion_archivo","r")) !== FALSE) {
			
			while(($data = fgetcsv($archivo, 1000, ";")) !== FALSE){
				$num_columnas = count($data);
				
					//~ echo $fila."->".$data[0]."->".$data[1];
					$consulta = $this->ModelsBusqueda->obtenerRegistro('conf_grupo_user','codigo',$data[1]);  // Buscamos si ya existe el grupo de usuarios a registrar
					
					if(count($consulta) == 0){
						// Registro de nuevo tipo de cuenta
						// Preparamos los datos del nuevo tipo de cuenta
						$data_grupo_usuarios = array(
							'id' => $data[0],
							'codigo' => $data[1],
							'name' => $data[2],
							'activo' => $data[3],
							'user_create' => $this->session->userdata['logged_in']['id'],
							'date_create' => date('Y-m-d H:i:s'),
						);
						// Registramos los datos del nuevo tipo de cuenta
						$reg_grupo_usuarios = $this->ModelsGruposUsuarios->insertar($data_grupo_usuarios);
						if ($reg_grupo_usuarios) {
							
							$param = array(
								'tabla' => 'Grupos de Usuarios',
								'codigo' => $data[1],
								'accion' => 'Registro de Nuevo Grupo de Usuarios',
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
