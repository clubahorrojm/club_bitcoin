<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControllersRepAutoconsumo
 *
 * @author jsolorzano
 */
class ControllersRepAutoconsumo extends CI_Controller
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
        $this->load->model('rep_autoconsumo/ModelsRepAutoconsumo');
        $this->load->model('clientes/ModelsClientes');
        $this->load->model('topologia/ModelsEstado');
        $this->load->model('topologia/ModelsMunicipio');
        $this->load->model('topologia/ModelsParroquia');
        $this->load->model('busquedas_ajax/ModelsBusqueda');
        $this->load->model('tipo_cliente/ModelsTipoCliente');
        $this->load->model('usuarios/Usuarios_model');
        
    }

    function index()
    {
        $data['listar'] = $this->ModelsRepAutoconsumo->obtenerVentas();
        //~ $data['usuarios'] = $this->Usuarios_model->obtenerUsuarios();
        $this->load->view('rep_autoconsumo/generar_reporte', $data);
    }
    
    // Consulta de ventas
    function obtenerVentas($tratamiento,$desde,$hasta)
    {
        $data = $this->ModelsRepAutoconsumo->obtenerConsumosEsp($tratamiento,$desde,$hasta);
        
        return $data;
    }
    
    
    // Generación de reporte de ventas
    function pdf_autoconsumos($tratamiento,$desde,$hasta)
    {
		
        $data['autoconsumos'] = $this->ModelsRepAutoconsumo->obtenerConsumosEsp($tratamiento,$desde,$hasta);  // Datos de las ventas generales
        $data['desde'] = $desde;  // Fecha de inicio
        $data['hasta'] = $hasta;  // Fecha final
        $data['tipo_tratamiento'] = $tratamiento;
        
        $this->load->view('rep_autoconsumo/pdf/reporte_autoconsumo', $data);
    }    
    
}
