<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControllersAMontos
 *
 * @author Ing. Marcel Arcuri
 */
class CAMontos extends CI_Controller
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
        $this->load->model('administracion/MAMontos');
        // $this->load->model('configuracion/MInmuebles');
        $this->load->model('busquedas_ajax/ModelsBusqueda');
        $this->load->model('administracion/MAuditoria');
        
    }
//	function index(){
//        $this->load->view('base');
//        $data['listar'] = $this->MAMontos->obtenerAMontos();
//        //$data['listar_t_inmueble'] = $this->MTiposInmueble->obtenerTiposInmuebles();
//        $this->load->view('administracion/asignacion_montos/lista', $data);
//    }

    function index(){
        $data['editar'] = '';
        $ultimo_id = $this->ModelsBusqueda->count_all_table('adm_asignacion_montos');
        if ($ultimo_id > 0){
            $data['editar'] = $this->MAMontos->obtenerAMontos($ultimo_id);
        }
        else{
            $datos = array(
                'id' => 1,
				'porcentaje1' => 20,
				'porcentaje2' => 10,
				'porcentaje3' => 10,
				'porcentaje4' => 10,
				'porcentaje5' => 10,
				'porcentaje6' => 10,
				'porcentaje7' => 20,
				'porcentaje8' => 10,
            );
            $result = $this->MAMontos->insertarAMontos($datos);
            if ($result) {
				$param = array(
					'tabla' => 'Montos',
					'codigo' => 1,
					'accion' => 'Registro de nuevo monto',
					'fecha' => date('Y-m-d'),
					'hora' => date("h:i:s a"),
					'usuario' => $this->session->userdata['logged_in']['id'],
				);
				$this->MAuditoria->add($param);
			}
            $ultimo_id = 1;
            $data['editar'] = $this->MAMontos->obtenerAMontos($ultimo_id);

        }
        $this->load->view('administracion/asignacion_montos/base', $data);
    }
	function actualizar(){
        
        $data = array(
			'id' => 1,
            'porcentaje1' => $this->input->post('porcentaje1'),
            'porcentaje2' => $this->input->post('porcentaje2'),
			'porcentaje3' => $this->input->post('porcentaje3'),
            'porcentaje4' => $this->input->post('porcentaje4'),
			'porcentaje5' => $this->input->post('porcentaje5'),
            'porcentaje6' => $this->input->post('porcentaje6'),
			'porcentaje7' => $this->input->post('porcentaje7'),
            'porcentaje8' => $this->input->post('porcentaje8'),
            'codigo' => 'pbkdf2_sha256$12000$'.hash( "sha256", $this->input->post('codigo')),
        );
        $result = $this->MAMontos->actualizarAMontos($data);
        if ($result) {
            $param = array(
                'tabla' => 'Asignacion Monto',
                'codigo' => $this->input->post('id'),
                'accion' => 'Edición de Asignacion de Monto',
                'fecha' => date('Y-m-d'),
                'hora' => date("h:i:s a"),
                'usuario' => $this->session->userdata['logged_in']['id'],
            );
            $this->MAuditoria->add($param);
		}
    }

}
