<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CRepRetiros
 *
 * @author jsolorzano
 */
class CRepRetiros extends CI_Controller
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
        $this->load->model('procesos/MLRetiros');
        $this->load->model('administracion/MEmpresa');
        $this->load->model('busquedas_ajax/ModelsBusqueda');
        $this->load->model('usuarios/Usuarios_model');
        
    }

    function index()
    {
		$this->load->view('base');
        $this->load->view('reportes/retiros');
    }
    
    // Consulta de auditorías
    function obtenerRetiros($estatus,$desde,$hasta)
    {
        $data = $this->MLRetiros->obtenerRetirosEsp($estatus,$desde,$hasta);  // Datos generales
        return $data;
    }
    
    
    // Generación de reporte de retiros
    function pdf_retiros($estatus,$desde,$hasta)
    {
        $data['retiros'] = $this->MLRetiros->obtenerRetirosEsp($estatus,$desde,$hasta);  // Datos generales de los retiros
        $data['empresa'] = $this->MEmpresa->obtenerEmpresa(1);
        $data['usuarios'] = $this->Usuarios_model->obtenerUsuarios();  // Usuarios
        $data['usuario'] = $this->ModelsBusqueda->obtenerRegistro('usuarios', 'id', $this->session->userdata['logged_in']['id']); // Usuario en sesión
        $data['desde'] = $desde;  // Fecha de inicio
        $data['hasta'] = $hasta;  // Fecha final
        
        $this->load->view('reportes/pdf/reporte_retiros', $data);
    }    
    
}
