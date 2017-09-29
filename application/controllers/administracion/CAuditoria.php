<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CAuditoria
 *
 * @author fmedina
 */
class CAuditoria extends CI_Controller
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
        $this->load->model('administracion/MAuditoria');
        $this->load->model('busquedas_ajax/ModelsBusqueda');
        $this->load->model('usuarios/Usuarios_model');
       
// Load base view
        $this->load->view('base2');
        
    }

    function index()
    {
        $data['listar'] = $this->MAuditoria->obtenerAuditorias();
        $data['usuarios'] = $this->Usuarios_model->obtenerUsuarios();
        $this->load->view('administracion/auditoria/lista', $data);
    }
    
    // Consulta de auditorías
    function obtenerAuditorias($usuario,$desde,$hasta)
    {
        $data = $this->MAuditoria->obtenerAuditoriasEsp($usuario,$desde,$hasta);  // Datos generales
        return $data;
    }
    
    
    // Generación de reporte de auditoría
    function pdf_auditoria($usuario,$desde,$hasta)
    {
        $data['auditoria'] = $this->MAuditoria->obtenerAuditoriasEsp($usuario,$desde,$hasta);  // Datos generales de la factura
        if ($usuario != "xxx"){
			$data['usuario'] = $this->ModelsBusqueda->obtenerRegistro('usuarios', 'id', $usuario);  // Usuario
		}else{
			$data['usuario'] = "xxx";
		}
        $data['desde'] = $desde;  // Fecha de inicio
        $data['hasta'] = $hasta;  // Fecha final
        
        $this->load->view('administracion/auditoria/pdf/reporte_auditoria', $data);
    }    
    
}
