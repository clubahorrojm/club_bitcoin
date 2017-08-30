<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControllersMonedero
 *
 * @author Ing. Marcel Arcuri
 */
class CMonedero extends CI_Controller
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
        $this->load->model('administracion/MMonedero');
        $this->load->model('busquedas_ajax/ModelsBusqueda');
        $this->load->model('administracion/MAuditoria');
        
    }

    function index(){
        $data['editar'] = '';
        $ultimo_id = $this->ModelsBusqueda->count_all_table('adm_monedero');
        if ($ultimo_id > 0){
            $data['editar'] = $this->MMonedero->obtenerMonedero($ultimo_id);
        }
        else{
            $datos = array(
                'id' => 1,
				'monedero' => 'JGQko7DZfuNqgyMkiSM6TKJBmAMCHhZL7',
            );
            $result = $this->MMonedero->insertarMonedero($datos);
            if ($result) {
				$param = array(
					'tabla' => 'Monedero',
					'codigo' => 1,
					'accion' => 'Registro de monedero',
					'fecha' => date('Y-m-d'),
					'hora' => date("h:i:s a"),
					'usuario' => $this->session->userdata['logged_in']['id'],
				);
				$this->MAuditoria->add($param);
			}
            $ultimo_id = 1;
            $data['editar'] = $this->MMonedero->obtenerMonedero($ultimo_id);

        }
        $this->load->view('administracion/monedero/base', $data);
    }
	function actualizar(){
        
        $data = array(
			'id' => 1,
            'monedero' => $this->input->post('monedero'),
			'codigo' => 'pbkdf2_sha256$12000$'.hash( "sha256", $this->input->post('codigo')),
        );

        $result = $this->MMonedero->actualizarMonedero($data);
        if ($result) {
            $param = array(
                'tabla' => 'Monedero',
                'codigo' => $this->input->post('id'),
                'accion' => 'Edición de monedero',
                'fecha' => date('Y-m-d'),
                'hora' => date("h:i:s a"),
                'usuario' => $this->session->userdata['logged_in']['id'],
            );
            $this->MAuditoria->add($param);
		}
    }

}
