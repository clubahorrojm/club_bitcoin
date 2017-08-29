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
		$this->load->model('referidos/MRelAyudas');
        $this->load->model('referidos/MReferidos');
		$this->load->model('administracion/MNotificaciones');
        
    }

    function index()
    {
        $this->load->view('base');
        //Validación de configuración de primer uso
        //Al no existir registros por defecto carga algunos genéricos
        $data['listar'] = '';
        $ultimo_id = $this->ModelsBusqueda->count_all_table('ref_rel_ayudas');
        $data['listar'] = $this->MAyuda->obtenerAyuda();
        $data['listar_usuarios'] = $this->Usuarios_model->obtenerUsuarios();
        // $data['listar_cuentas'] = $this->MCuentas->obtenerCuentas();
        $this->load->view('procesos/ayudas/lista', $data);
    }
    
    // Método para validar el pago
    function responder(){
        // Armamos la data a actualizar
		$data = array(
            'codigo' => $this->input->post('codigo'),
			'operador_id' => $this->session->userdata['logged_in']['id'],
			'respuesta' => $this->input->post('respuestas'),
			'estatus' => 2,
        );
        // Actualizamos la consulta del usuario con los datos armados
        $result = $this->MAyuda->actualizarConsulta($data);
		
		// SE GENERA LA NOTIFICACION AL USUARIO QUE SU PREGUNTA FUE RESPONDIDA
		$cod_ayuda = $this->input->post('codigo');
		$data['listar'] = $this->MNotificaciones->obtener_user_id_ayuda($cod_ayuda); // Listado de Retiros solicitados
		$param2 = array(
			'usuario_id' => $data['listar'][0]->usuario_id,
			'tipo' => 3,
			'accion' => 'Mensaje respondido',
			'fecha' => date('Y-m-d'),
			'hora' => date("h:i:s a"),
			'estatus' => 1,
		);
		$this->MAuditoria->insertarNotificacion($param2);
		
		
		
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

