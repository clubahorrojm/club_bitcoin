<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControllersPaises
 *
 * @author Ing. Marcel Arcuri
 */
class CPaises extends CI_Controller
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
        $this->load->model('administracion/MPaises');
        $this->load->model('busquedas_ajax/ModelsBusqueda');
        $this->load->model('administracion/MAuditoria');
        
    }

    function index()
    {
        //Validacion de configuracion de primer uso
        //Al no haber registros por defecto carga algunos genericos
        $data['listar'] = '';
        $ultimo_id = $this->ModelsBusqueda->count_all_table('adm_paises');
        if ($ultimo_id > 0){
            $data['listar'] = $this->MPaises->obtenerPais();
        }
        else{
            $this->MPaises->cargarCSV();
            redirect('configuracion/CPaises');
        }
        $this->load->view('administracion/paises/lista', $data);
    }

    function registrar()
    {
        $data['ultimo_id']   = $this->ModelsBusqueda->count_all_table('adm_paises');
        $this->load->view('administracion/paises/registrar', $data);
    }
    
    //metodo para guardar un nuevo registro
    public function guardar()
    {

        $result = $this->MPaises->insertarPaises($this->input->post());
        if ($result) {
            
            $param = array(
                'tabla' => 'Paises',
                'codigo' => $this->input->post('codigo'),
                'accion' => 'Registro de nuevo País: '.$this->input->post('descripcion'),
                'fecha' => date('Y-m-d'),
                'hora' => date("h:i:s a"),
                'usuario' => $this->session->userdata['logged_in']['id'],
            );
            $this->MAuditoria->add($param);
            //redirect('configuracion/CPaises');
        }
    }

    //metodo para editar
    function editar()
    {
        $data['id']     = $this->uri->segment(4);
        $data['editar'] = $this->MPaises->obtenerPaises($data['id']);
        $this->load->view('administracion/paises/editar', $data);
    }
    
    //metodo para eliminar
    function eliminar($id)
    {
        $data = $this->MPaises->obtenerPaises($id);
        echo $data[0]->descripcion;
        $result = $this->MPaises->eliminarPaises($id);
        $param = array(
            'tabla' => 'Paises',
            'codigo' => $data[0]->codigo,
            'accion' => 'Eliminación de País: '.$data[0]->descripcion,
            'fecha' => date('Y-m-d'),
            'hora' => date("h:i:s a"),
            'usuario' => $this->session->userdata['logged_in']['id'],
        );
        $this->MAuditoria->add($param);
    }

    //Metodo para actualizar
    function actualizar()
    {
        $result = $this->MPaises->actualizarPaises($this->input->post());
        if ($result) {
            
            $param = array(
                'tabla' => 'Paises',
                'codigo' => $this->input->post('codigo'),
                'accion' => 'Edición de País: '.$this->input->post('descripcion'),
                'fecha' => date('Y-m-d'),
                'hora' => date("h:i:s a"),
                'usuario' => $this->session->userdata['logged_in']['id'],
            );
            $this->MAuditoria->add($param);
            //redirect('configuracion/CPaises');
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
        $result = $this->MPaises->actualizarPaises($data);
    }
}
