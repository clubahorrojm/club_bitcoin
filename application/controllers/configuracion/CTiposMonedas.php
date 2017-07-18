<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControllersTiposMonedas
 *
 * @author Ing. Marcel Arcuri
 */
class CTiposMonedas extends CI_Controller
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
        $this->load->model('configuracion/MTiposMonedas');
        $this->load->model('busquedas_ajax/ModelsBusqueda');
        $this->load->model('administracion/MAuditoria');
        
    }

    function index()
    {
        //Validacion de configuracion de primer uso
        //Al no haber registros por defecto carga algunos genericos
        $data['listar'] = '';
        $ultimo_id = $this->ModelsBusqueda->count_all_table('conf_tipos_monedas');
        if ($ultimo_id > 0){
            $data['listar'] = $this->MTiposMonedas->obtenerTipoMoneda();
        }
        else{
            $this->MTiposMonedas->cargarCSV();
            redirect('configuracion/CTiposMonedas');
        }
        $this->load->view('configuracion/tipos_monedas/lista', $data);
    }

    function registrar()
    {
        $data['ultimo_id']   = $this->ModelsBusqueda->count_all_table('conf_tipos_monedas');
        $this->load->view('configuracion/tipos_monedas/registrar', $data);
    }
    
    //metodo para guardar un nuevo registro
    public function guardar()
    {

        $result = $this->MTiposMonedas->insertarTiposMonedas($this->input->post());
        if ($result) {
            
            $param = array(
                'tabla' => 'Tipos de Monedas',
                'codigo' => $this->input->post('codigo'),
                'accion' => 'Registro de nuevo Tipo de Moneda: '.$this->input->post('descripcion'),
                'fecha' => date('Y-m-d'),
                'hora' => date("h:i:s a"),
                'usuario' => $this->session->userdata['logged_in']['id'],
            );
            $this->MAuditoria->add($param);
            //redirect('configuracion/CTiposMonedas');
        }
    }

    //metodo para editar
    function editar()
    {
        $data['id']     = $this->uri->segment(4);
        $data['editar'] = $this->MTiposMonedas->obtenerTiposMonedas($data['id']);
        $this->load->view('configuracion/tipos_monedas/editar', $data);
    }
    
    //metodo para eliminar
    function eliminar($id)
    {
        $data = $this->MTiposMonedas->obtenerTiposMonedas($id);
        $result = $this->MTiposMonedas->eliminarTiposMonedas($id);
        $param = array(
            'tabla' => 'Tipos de Monedas',
            'codigo' => $data[0]->codigo,
            'accion' => 'Eliminación de Tipo de Moneda: '.$data[0]->descripcion,
            'fecha' => date('Y-m-d'),
            'hora' => date("h:i:s a"),
            'usuario' => $this->session->userdata['logged_in']['id'],
        );
        $this->MAuditoria->add($param);
    }

    //Metodo para actualizar
    function actualizar()
    {
        $result = $this->MTiposMonedas->actualizarTiposMonedas($this->input->post());
        if ($result) {
            
            $param = array(
                'tabla' => 'Tipos de Monedas',
                'codigo' => $this->input->post('codigo'),
                'accion' => 'Edición de Tipo de Monedas: '.$this->input->post('descripcion'),
                'fecha' => date('Y-m-d'),
                'hora' => date("h:i:s a"),
                'usuario' => $this->session->userdata['logged_in']['id'],
            );
            $this->MAuditoria->add($param);
            //redirect('configuracion/CTiposMonedas');
        }
    }
    
     // Método para anular o activar 
    function activar_desactivar($id){
        $accion = $this->input->post('accion');
        $activo = true;
        if ($accion == 'desactivar'){
            $activo = false;
        }
        // Armamos la data a actualizar
        $data = array(
            'id' => $id,
            'activo' => $activo,
        );
        // Actualizamos el usuario con los datos armados
        $result = $this->MTiposMonedas->actualizarTiposMonedas($data);
    }
}
