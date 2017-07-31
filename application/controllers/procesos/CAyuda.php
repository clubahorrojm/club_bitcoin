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
class CAyuda extends CI_Controller
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
		$this->load->model('procesos/MAyuda');
        $this->load->model('configuracion/usuarios/Usuarios_model');
        // $this->load->model('configuracion/MCuentas');
        $this->load->model('busquedas_ajax/ModelsBusqueda');
        $this->load->model('administracion/MAuditoria');
        $this->load->model('referidos/MRelPagos');
        $this->load->model('referidos/MReferidos');
        
    }

    function index()
    {
        $this->load->view('base');
        //Validación de configuración de primer uso
        //Al no existir registros por defecto carga algunos genéricos
        $data['listar'] = '';
        $ultimo_id = $this->ModelsBusqueda->count_all_table('ref_rel_ayudas');
        if ($ultimo_id > 0){
            $data['listar'] = $this->MAyuda->obtenerAyuda();
        }
        else{
            $data['listar'] = [];
        }
        $data['listar_usuarios'] = $this->Usuarios_model->obtenerUsuarios();
        // $data['listar_cuentas'] = $this->MCuentas->obtenerCuentas();
        $this->load->view('procesos/ayudas/lista', $data);
    }
    
    // Método para validar el pago
    function responder(){
        // Armamos la data a actualizar
		$data = array(
			'id' => 1,
            'codigo' => $this->input->post('codigo'),
			'operador_id' => $this->session->userdata['logged_in']['id'],
			'respuesta' => $this->input->post('respuestas'),
			'estatus' => 2,
        );

        // Actualizamos la consulta del usuario con los datos armados
        $result = $this->MAyuda->actualizarConsulta($data);
        // Registramos los cambios en la Bitacora
        if ($result) {
            $param = array(
                'tabla' => 'ref_rel_ayudas',
                'codigo' => $cod,
                'accion' => 'Respondida consulta de usuario',
                'fecha' => date('Y-m-d'),
                'hora' => date("h:i:s a"),
                'usuario' => $this->session->userdata['logged_in']['id'],
            );
            $this->MAuditoria->add($param);
        }
    }

}

