<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CRepPagos
 *
 * @author jsolorzano
 */
class CRepPagos extends CI_Controller
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
        $this->load->model('procesos/MLPagos');
        $this->load->model('configuracion/MBancos');
        $this->load->model('configuracion/MCuentas');
        $this->load->model('administracion/MEmpresa');
        $this->load->model('busquedas_ajax/ModelsBusqueda');
        $this->load->model('usuarios/Usuarios_model');
        
    }

    function index()
    {
		$this->load->view('base');
        $data['bancos'] = $this->MBancos->obtenerBanco();
        $data['cuentas'] = $this->MCuentas->obtenerCuentas();
        $this->load->view('reportes/pagos', $data);
    }
    
    // Consulta de auditorías
    function obtenerPagos($cuenta,$estatus,$desde,$hasta)
    {
        $data = $this->MLPagos->obtenerPagosEsp($cuenta,$estatus,$desde,$hasta);  // Datos generales
        return $data;
    }
    
    
    // Generación de reporte de pagos
    function pdf_pagos($cuenta,$estatus,$desde,$hasta)
    {
        $data['pagos'] = $this->MLPagos->obtenerPagosEsp($cuenta,$estatus,$desde,$hasta);  // Datos generales del los pagos
        
        //~ print_r($data['pagos']);
        $data['empresa'] = $this->MEmpresa->obtenerEmpresa(1);
		$data['usuarios'] = $this->Usuarios_model->obtenerUsuarios();  // Usuarios
		$data['cuentas'] = $this->MCuentas->obtenerCuentas();  // Cuentas
		$data['usuario'] = $this->ModelsBusqueda->obtenerRegistro('usuarios', 'id', $this->session->userdata['logged_in']['id']); // Usuario en sesión
        $data['desde'] = $desde;  // Fecha de inicio
        $data['hasta'] = $hasta;  // Fecha final
        
        $this->load->view('reportes/pdf/reporte_pagos', $data);
    }    
    
}
