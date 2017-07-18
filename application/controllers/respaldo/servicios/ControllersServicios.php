<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControllersClientes
 *
 * @author fmedina
 */
class ControllersServicios extends CI_Controller {

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
        $this->load->model('servicios/ModelsServicios');
        $this->load->model('unidad_medida/ModelsUnidadMedida');
        $this->load->model('impuesto/ModelsImpuesto');
        $this->load->model('tipo_servicio/ModelsTipoServicio');
        $this->load->model('busquedas_ajax/ModelsBusqueda');
    }

    function index() {
        $data['listar'] = $this->ModelsServicios->obtenerServicios();
        $this->load->view('servicios/lista', $data);
    }

    function registrar() {
        $data['detalles_lista'] = $this->ModelsBusqueda->count_all_table('servicio');
        $data['list_um'] = $this->ModelsUnidadMedida->obtenerUnidadMedidas();
        $data['list_iva'] = $this->ModelsImpuesto->obtenerImpuestos();
        $data['list_tipos_servicios'] = $this->ModelsTipoServicio->obtenerTiposServicios();
        $this->load->view('servicios/registrar', $data);
    }

    public function guardar() {

        $result = $this->ModelsServicios->insertar($this->input->post());
        echo $result;

        if ($result) {

            $param = array(
                'tabla' => 'servicio',
                'codigo' => $this->input->post('codigo'),
                'accion' => 'Nuevo Servicio',
                'fecha' => date('Y-m-d'),
                'hora' => date("h:i:s a"),
                'usuario' => $this->session->userdata['logged_in']['id'],
            );
            $result = $this->MAuditoria->add($param);
            redirect('servicios/ControllersServicios');
        }
    }

    function editar() {
        $data['id'] = $this->uri->segment(4);
        $data['editar'] = $this->ModelsServicios->obtenerServicio($data['id']);
        $data['list_um'] = $this->ModelsUnidadMedida->obtenerUnidadMedidas();
        $data['list_iva'] = $this->ModelsImpuesto->obtenerImpuestos();
        $data['list_tipos_servicios'] = $this->ModelsTipoServicio->obtenerTiposServicios();
        $this->load->view('servicios/editar', $data);
    }

    function eliminar($id) {
        $result = $this->ModelsServicios->eliminarServicio($id);
        $param = array(
                'tabla' => 'servicio',
                'codigo' => $id,
                'accion' => 'Eliminar Servicio',
                'fecha' => date('Y-m-d'),
                'hora' => date("h:i:s a"),
                'usuario' => $this->session->userdata['logged_in']['id'],
            );
        $this->MAuditoria->add($param);
        if ($result) {
            
            redirect('servicios/ControllersServicios');
        }
    }

    function actualizar() {

        $result = $this->ModelsServicios->actualizarServicio($this->input->post());

        if ($result) {
            $param = array(
                'tabla' => 'servicio',
                'codigo' => $this->input->post('codigo'),
                'accion' => 'Editar Servicio',
                'fecha' => date('Y-m-d'),
                'hora' => date("h:i:s a"),
                'usuario' => $this->session->userdata['logged_in']['id'],
            );
            $result = $this->MAuditoria->add($param);
            redirect('servicios/ControllersServicios');
        }
    }

}
