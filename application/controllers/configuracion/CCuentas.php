<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CCuentas
 *
 * @author Ing. José Solorzano
 */
class CCuentas extends CI_Controller
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
        $this->load->model('configuracion/MCuentas');
        $this->load->model('configuracion/MTiposCuenta');
        $this->load->model('configuracion/MBancos');
        $this->load->model('busquedas_ajax/ModelsBusqueda');
        $this->load->model('administracion/MAuditoria');
        
    }

    function index()
    {
        //Validacion de configuracion de primer uso
        //Al no existir registros por defecto carga algunos genéricos
        $data['listar'] = '';
        $ultimo_id = $this->ModelsBusqueda->count_all_table('conf_cuentas');
        if ($ultimo_id > 0){
            $data['listar'] = $this->MCuentas->obtenerCuentas();
        }
        else{
            //~ $this->MCuentas->cargarCSV();
            //~ redirect('configuracion/CCuentas');
            $data['listar'] = [];
        }
        $data['listar_t_cuentas'] = $this->MTiposCuenta->obtenerTiposCuenta();
        $data['listar_bancos'] = $this->MBancos->obtenerBanco();
        $this->load->view('configuracion/cuentas/lista', $data);
    }

    function registrar()
    {
        $data['ultimo_id'] = $this->ModelsBusqueda->count_all_table('conf_cuentas');
        $data['listar_t_cuentas'] = $this->MTiposCuenta->obtenerTiposCuenta();
        $data['listar_bancos'] = $this->MBancos->obtenerBanco();
        $this->load->view('configuracion/cuentas/registrar', $data);
    }
    
    //metodo para guardar un nuevo registro
    public function guardar()
    {

        $result = $this->MCuentas->insertarCuenta($this->input->post());
        if ($result) {
            
            $param = array(
                'tabla' => 'Tipos de Cuenta',
                'codigo' => $this->input->post('codigo'),
                'accion' => 'Registro de nueva Cuenta: '.$this->input->post('descripcion'),
                'fecha' => date('Y-m-d'),
                'hora' => date("h:i:s a"),
                'usuario' => $this->session->userdata['logged_in']['id'],
            );
            $this->MAuditoria->add($param);
            //redirect('configuracion/CBancos');
        }
    }

    //método para editar
    function editar()
    {
        $data['id']     = $this->uri->segment(4);
        $data['listar_t_cuentas'] = $this->MTiposCuenta->obtenerTiposCuenta();
        $data['listar_bancos'] = $this->MBancos->obtenerBanco();
        $data['editar'] = $this->MCuentas->obtenerCuenta($data['id']);
        $this->load->view('configuracion/cuentas/editar', $data);
    }
    
    //método para eliminar
    function eliminar($id)
    {
        $data = $this->MCuentas->obtenerCuenta($id);
        $result = $this->MCuentas->eliminarCuenta($id);
        $param = array(
            'tabla' => 'Tipos de Cuenta',
            'codigo' => $data[0]->codigo,
            'accion' => 'Eliminación de Cuenta: '.$data[0]->descripcion,
            'fecha' => date('Y-m-d'),
            'hora' => date("h:i:s a"),
            'usuario' => $this->session->userdata['logged_in']['id'],
        );
        $this->MAuditoria->add($param);
    }

    //Método para actualizar
    function actualizar()
    {
        $result = $this->MCuentas->actualizarCuenta($this->input->post());
        if ($result) {
            
            $param = array(
                'tabla' => 'Tipos de Cuenta',
                'codigo' => $this->input->post('codigo'),
                'accion' => 'Edición de Cuenta: '.$this->input->post('descripcion'),
                'fecha' => date('Y-m-d'),
                'hora' => date("h:i:s a"),
                'usuario' => $this->session->userdata['logged_in']['id'],
            );
            $this->MAuditoria->add($param);
            //redirect('configuracion/CCuentas');
        }
    }
    
     // Método para activar/desactivar
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
        // Actualizamos el tipo de cuenta con los datos armados
        $result = $this->MCuentas->actualizarCuenta($data);
    }
}

