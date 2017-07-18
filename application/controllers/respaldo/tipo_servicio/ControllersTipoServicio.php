<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControllersTopologia
 *
 * @author fmedina
 */
class ControllersTipoServicio extends CI_Controller {

    public function __construct() {


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
        $this->load->model('administracion/MAuditoria');
        $this->load->model('tipo_servicio/ModelsTipoServicio');
        $this->load->model('busquedas_ajax/ModelsBusqueda');  // Librería de consultas extra
    }

    function index() {
        $data['listar'] = $this->ModelsTipoServicio->obtenerTiposServicios();
        $this->load->view('tipo_servicio/lista', $data);
    }

    function registrar() {
        $data['ultimo_id'] = $this->ModelsBusqueda->count_all_table('tipo_servicio');
        $this->load->view('tipo_servicio/registrar', $data);
    }

    public function guardar() {
		$ultimo_id = $this->ModelsBusqueda->count_all_table('tipo_servicio');
		
		$data_t_servicio['id'] = $ultimo_id + 1;
		$data_t_servicio['cod_servicio'] = $this->input->post('cod_servicio');
		$data_t_servicio['tipo_servicio'] = $this->input->post('tipo_servicio');
		
        $result = $this->ModelsTipoServicio->insertarTipoServicio($data_t_servicio);

        if ($result) {

            $param = array(
                'tabla' => 'tipo_servicio',
                'codigo' => $this->input->post('cod_servicio'),
                'accion' => 'Nuevo Tipo de Servicio',
                'fecha' => date('Y-m-d'),
                'hora' => date("h:i:s a"),
                'usuario' => $this->session->userdata['logged_in']['id'],
            );
            $this->MAuditoria->add($param);
            //~ redirect('tipo_servicio/ControllersTipoServicio');
        }
    }

    function editar() {
        $data['id'] = $this->uri->segment(4);
        $data['editar'] = $this->ModelsTipoServicio->obtenerTipoServicio($data['id']);
        $this->load->view('tipo_servicio/editar', $data);
    }

    function eliminar($id) {
        $result = $this->ModelsTipoServicio->eliminarTipoServicio($id);
        $param = array(
                'tabla' => 'tipo_servicio',
                'codigo' => $id,
                'accion' => 'Eliminar Tipo de Servicio',
                'fecha' => date('Y-m-d'),
                'hora' => date("h:i:s a"),
                'usuario' => $this->session->userdata['logged_in']['id'],
            );
            $this->MAuditoria->add($param);
        if ($result) {
            
            //~ redirect('tipo_servicio/ControllersTipoServicio');
        }
    }

    function actualizar() {
        $result = $this->ModelsTipoServicio->actualizarTipoServicio($this->input->post());

        if ($result) {

            $param = array(
                'tabla' => 'tipo_servicio',
                'codigo' => $this->input->post('cod_servicio'),
                'accion' => 'Editar Tipo de Servicio',
                'fecha' => date('Y-m-d'),
                'hora' => date("h:i:s a"),
                'usuario' => $this->session->userdata['logged_in']['id'],
            );
            $this->MAuditoria->add($param);
            //~ redirect('tipo_servicio/ControllersTipoServicio');
        }
    }

    function consultar() {
        $result = $this->ModelsBusqueda->existe_registro('tipo_servicio', 'tipo_servicio', $this->input->post('tipo_servicio'));
    }

}
