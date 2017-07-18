<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CMontoPago
 *
 * @author Ing. José Solorzano
 */
class CMontoPago extends CI_Controller
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
        $this->load->model('configuracion/MMontoPago');
        $this->load->model('busquedas_ajax/ModelsBusqueda');
        $this->load->model('administracion/MAuditoria');
        
    }

    function index()
    {
		$this->load->view('base');
        $data['editar'] = '';
        $ultimo_id = $this->ModelsBusqueda->count_all_table('conf_monto_pago');
        if ($ultimo_id > 0){
            $data['editar'] = $this->MMontoPago->obtenerMontoPago($ultimo_id);
        }
        else{
            $datos = array(
                'id' => 1,
                'codigo' => 1,
                'fecha_create' => date('Y-m-d'),
                'user_create' => $this->session->userdata['logged_in']['id'],
            );
            $result = $this->MMontoPago->insertarMontoPago($datos);
            $ultimo_id = 1;
            $data['editar'] = $this->MMontoPago->obtenerMontoPago($ultimo_id);
        }
        //print_r($data);
        $this->load->view('configuracion/monto_pago/editar', $data);
    }
    //Metodo para actualizar
    function actualizar(){
        
        $data = array(
			'id' => 1,
            'codigo' => $_POST['codigo'],
            'monto_pago' => $_POST['monto_pago'],
            'fecha_update' => date('Y-m-d'),
            'user_update' => $this->session->userdata['logged_in']['id'],
        );
        $result = $this->MMontoPago->actualizarMontoPago($data);
        if ($result) {
            $param = array(
                'tabla' => 'Monto Pago',
                'codigo' => $this->input->post('id'),
                'accion' => 'Editar Monto Pago',
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
