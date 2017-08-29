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

        $this->load->view('base2');

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
		
		$data = array(
			'id' => 1,
			'codigo' => $this->input->post('monedero'),
            'nombre_empresa' => $this->input->post('nombre_empresa'),
            'rif' => $this->input->post('rif'),
            'cedula' => $this->input->post('cedula'),
            'nombre' => $this->input->post('nombre'),
            'apellido' => $this->input->post('apellido'),
            'telefono1' => $this->input->post('telefono1'),
            'telefono2' => $this->input->post('telefono2'),
            'correo' => $this->input->post('correo'),
            'direccion' => $this->input->post('direccion'),
			'clave' => 'pbkdf2_sha256$12000$'.hash( "sha256", $this->input->post('clave')),
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
