<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControllersBancos
 *
 * @author Ing. Marcel Arcuri
 */
class CBancos extends CI_Controller
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
        $this->load->model('configuracion/MBancos');
        $this->load->model('busquedas_ajax/ModelsBusqueda');
        $this->load->model('administracion/MAuditoria');
        
    }

    function index()
    {
        //Validacion de configuracion de primer uso
        //Al no haber registros por defecto carga algunos genericos
        $data['listar'] = '';
        $ultimo_id = $this->ModelsBusqueda->count_all_table('conf_bancos');
        if ($ultimo_id > 0){
            $data['listar'] = $this->MBancos->obtenerBanco();
        }
        else{
            $this->MBancos->cargarCSV();
            redirect('configuracion/CBancos');
        }
        $this->load->view('configuracion/bancos/lista', $data);
    }

    function registrar()
    {
        $data['ultimo_id']   = $this->ModelsBusqueda->count_all_table('conf_bancos');
        $this->load->view('configuracion/bancos/registrar', $data);
    }
    
    //metodo para guardar un nuevo registro
    public function guardar()
    {

        $result = $this->MBancos->insertarBancos($this->input->post());
        if ($result) {
            
            $param = array(
                'tabla' => 'Bancos',
                'codigo' => $this->input->post('codigo'),
                'accion' => 'Registro de nuevo Banco: '.$this->input->post('descripcion'),
                'fecha' => date('Y-m-d'),
                'hora' => date("h:i:s a"),
                'usuario' => $this->session->userdata['logged_in']['id'],
            );
            $this->MAuditoria->add($param);
            //redirect('configuracion/CBancos');
        }
    }

    //metodo para editar
    function editar()
    {
        $data['id']     = $this->uri->segment(4);
        $data['editar'] = $this->MBancos->obtenerBancos($data['id']);
        $this->load->view('configuracion/bancos/editar', $data);
    }
    
    //metodo para eliminar
    function eliminar($id)
    {
        $data = $this->MBancos->obtenerBancos($id);
        $result = $this->MBancos->eliminarBancos($id);
        $param = array(
            'tabla' => 'Bancos',
            'codigo' => $data[0]->codigo,
            'accion' => 'Eliminación de Banco: '.$data[0]->descripcion,
            'fecha' => date('Y-m-d'),
            'hora' => date("h:i:s a"),
            'usuario' => $this->session->userdata['logged_in']['id'],
        );
        $this->MAuditoria->add($param);
    }

    //Metodo para actualizar
    function actualizar()
    {
        $result = $this->MBancos->actualizarBancos($this->input->post());
        if ($result) {
            
            $param = array(
                'tabla' => 'Bancos',
                'codigo' => $this->input->post('codigo'),
                'accion' => 'Edición de Banco: '.$this->input->post('descripcion'),
                'fecha' => date('Y-m-d'),
                'hora' => date("h:i:s a"),
                'usuario' => $this->session->userdata['logged_in']['id'],
            );
            $this->MAuditoria->add($param);
            //redirect('configuracion/CBancos');
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
        $result = $this->MBancos->actualizarBancos($data);
    }
}
