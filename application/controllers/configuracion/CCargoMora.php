<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CCargoMora
 *
 * @author Ing. José Solorzano
 */
class CCargoMora extends CI_Controller
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
        $this->load->model('configuracion/MCargoMora');
        $this->load->model('busquedas_ajax/ModelsBusqueda');
        $this->load->model('administracion/MAuditoria');
        
    }

    function index()
    {
		$this->load->view('base');
        $data['editar'] = '';
        $ultimo_id = $this->ModelsBusqueda->count_all_table('conf_cargo_mora');
        if ($ultimo_id > 0){
            $data['editar'] = $this->MCargoMora->obtenerCargoMora($ultimo_id);
        }
        else{
            $datos = array(
                'id' => 1,
                'codigo' => 1,
                'fecha_create' => date('Y-m-d'),
                'user_create' => $this->session->userdata['logged_in']['id'],
            );
            $result = $this->MCargoMora->insertarCargoMora($datos);
            // Registramos los cambios en la Bitacora
            if ($result) {
				$param = array(
					'tabla' => 'Cargo Mora',
					'codigo' => 1,
					'accion' => 'Registro de nuevo Cargo por Mora',
					'fecha' => date('Y-m-d'),
					'hora' => date("h:i:s a"),
					'usuario' => $this->session->userdata['logged_in']['id'],
				);
				$this->MAuditoria->add($param);
			}
            $ultimo_id = 1;
            $data['editar'] = $this->MCargoMora->obtenerCargoMora($ultimo_id);
        }
        //print_r($data);
        $this->load->view('configuracion/cargo_mora/editar', $data);
    }
    //Metodo para actualizar
    function actualizar(){
        
        $data = array(
			'id' => 1,
            'codigo' => $_POST['codigo'],
            'porcentaje_cargo' => $_POST['porcentaje_cargo'],
            'fecha_update' => date('Y-m-d'),
            'user_update' => $this->session->userdata['logged_in']['id'],
        );
        $result = $this->MCargoMora->actualizarCargoMora($data);
        if ($result) {
            $param = array(
                'tabla' => 'Cargo Mora',
                'codigo' => $this->input->post('codigo'),
                'accion' => 'Edición de Cargo Mora: '.$this->input->post('porcentaje_cargo'),
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
