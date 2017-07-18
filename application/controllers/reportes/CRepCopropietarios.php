<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CRepCopropietarios
 *
 * @author Ing. Marcel Arcuri
 */
class CRepCopropietarios extends CI_Controller{

    public function __construct(){

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
        // $this->load->model('procesos/pagos/MPagos');
        // $this->load->model('procesos/pagos/MRelPagos');
        // $this->load->model('configuracion/MRelRecibos');
        // $this->load->model('configuracion/MInmuebles');
        // $this->load->model('configuracion/MCopropietarios');
        // $this->load->model('configuracion/MBancos');
        $this->load->model('busquedas_ajax/ModelsBusqueda');
        $this->load->model('administracion/MAuditoria');
        
    }

    function index(){
        
        // $data['listar'] = $this->MPagos->obtenerPagos();
        // $data['listar_inmuebles'] = $this->MInmuebles->obtenerInmuebles();
        // $data['listar_copropietarios'] = $this->MCopropietarios->obtenerCopropietarios();
        $this->load->view('reportes/copropietarios');
    }
    // function registrar(){   
    //     $data['ultimo_id'] = $this->ModelsBusqueda->count_all_table('pro_pagos');
    //     $data['fecha'] = date('d-m-Y');
    //     $data['listar_inmuebles'] = $this->MInmuebles->obtenerInmuebles();
    //     $data['listar_bancos'] = $this->MBancos->obtenerBanco();
    //     $this->load->view('procesos/pagos/registrar', $data);
    // }


    // //metodo para editar
    // function editar(){
    //     $this->load->view('base');
    //     $data['id']     = $this->uri->segment(5);
    //     $data['editar'] = $this->MPagos->obtenerPago($data['id']);
    //     $data['listar_inmuebles'] = $this->MInmuebles->obtenerInmuebles();
    //     $data['listar_bancos'] = $this->MBancos->obtenerBanco();
    //     $data['listar_copropietarios'] = $this->MCopropietarios->obtenerCopropietarios();
    //     $this->load->view('procesos/pagos/editar', $data);
    // }
}
