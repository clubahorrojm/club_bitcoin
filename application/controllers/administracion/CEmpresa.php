<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControllersEmpresa
 *
 * @author Ing. Marcel Arcuri
 */
class CEmpresa extends CI_Controller
{

    public function __construct()
    {


        parent::__construct();

// Load form helper library
        $this->load->helper('form');

        $this->load->helper(array('url'));

        $this->load->view('base');

// Load form validation library
        $this->load->library('form_validation');

// Load session library
        $this->load->library('session');

// Load database
        $this->load->model('administracion/MEmpresa');
        // $this->load->model('configuracion/MInmuebles');
        $this->load->model('busquedas_ajax/ModelsBusqueda');
        $this->load->model('administracion/MAuditoria');
        
    }

    function index()
    {
        $data['editar'] = '';
        $ultimo_id = $this->ModelsBusqueda->count_all_table('adm_empresa');
        if ($ultimo_id > 0){
            $data['editar'] = $this->MEmpresa->obtenerEmpresa($ultimo_id);
        }
        else{
            $datos = array(
                'id' => 1,
                'codigo' => 1,
            );
            $result = $this->MEmpresa->insertarEmpresa($datos);
            if ($result) {
						
				$param = array(
					'tabla' => 'Empresa',
					'codigo' => 1,
					'accion' => 'Registro de Nueva Empresa',
					'fecha' => date('Y-m-d'),
					'hora' => date("h:i:s a"),
					'usuario' => $this->session->userdata['logged_in']['id'],
				);
				$this->MAuditoria->add($param);
			}
            $ultimo_id = 1;
            $data['editar'] = $this->MEmpresa->obtenerEmpresa($ultimo_id);
        }
        //print_r($data);
        $this->load->view('administracion/empresa/base', $data);
    }
    //Metodo para actualizar
    function actualizar(){
        // Sección de carga de la foto en el servidor
		$ruta = getcwd();  // Obtiene el directorio actual en donde se esta trabajando
		
		// Obtenemos la extensión de la foto
		//~ if($_FILES['logo']['name'] != ''){
			//~ $ext = explode(".",$_FILES['logo']['name']);
			//~ $ext = $ext[1];
			//~ //$nombre_foto = $_POST['cedula'].".".$ext;
			//~ $nombre_foto = "logo.".$ext;
			//~ ///var/www/html/SistemaAdministrativo/foto
			//~ move_uploaded_file($_FILES['logo']['tmp_name'], $ruta."/foto/".$nombre_foto);  // Copiamos el archivo a la carpeta en el servidor
		//~ }else{
			//~ $nombre_foto = $_POST['img_id'];
		//~ }
        $data = array(
			'id' => 1,
            'codigo' => $_POST['codigo'],
            'nombre_empresa' => $_POST['nombre_empresa'],
            'rif' => $_POST['rif'],
            'cedula' => $_POST['cedula'],
            'nombre' => $_POST['nombre'],
            'apellido' => $_POST['apellido'],
            'telefono1' => $_POST['telefono1'],
            'telefono2' => $_POST['telefono2'],
            'correo' => $_POST['correo'],
            'direccion' => $_POST['direccion'],
			//~ 'logo' => $nombre_foto,
        );
        $result = $this->MEmpresa->actualizarEmpresa($data);
        if ($result) {
            $param = array(
                'tabla' => 'Empresa',
                'codigo' => $this->input->post('id'),
                'accion' => 'Edición de la Empresa',
                'fecha' => date('Y-m-d'),
                'hora' => date("h:i:s a"),
                'usuario' => $this->session->userdata['logged_in']['id'],
            );
            $this->MAuditoria->add($param);
            echo "registrado";
        }else{
			echo "fallo";
		}
    }
}
