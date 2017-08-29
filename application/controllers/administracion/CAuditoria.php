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

        $this->load->view('base2');

// Load form validation library
        $this->load->library('form_validation');

// Load session library
        $this->load->library('session');

// Load database
        $this->load->model('administracion/MAuditoria');
        //$this->load->model('clientes/ModelsClientes');
        //$this->load->model('topologia/ModelsEstado');
        //$this->load->model('topologia/ModelsMunicipio');
        //$this->load->model('topologia/ModelsParroquia');
        $this->load->model('busquedas_ajax/ModelsBusqueda');
        //$this->load->model('tipo_cliente/ModelsTipoCliente');
        $this->load->model('usuarios/Usuarios_model');
        
        $this->load->model('administracion/MEmpresa');
        
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
        
		$data['empresa'] = $this->MEmpresa->obtenerEmpresa(1);
        
        //~ 
        //~ $data['productos_servicios'] = $this->ModelsFacturar->obtenerProductosServicios($data['factura']->codfactura);  // Productos/Servicios asociados a la factura
        
        $this->load->view('administracion/auditoria/pdf/reporte_auditoria', $data);
    }    
    
}
