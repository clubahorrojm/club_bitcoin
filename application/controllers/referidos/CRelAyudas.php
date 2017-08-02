<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControllersRelacionBancos
 *
 * @author Ing. Marcel Arcuri
 */
class CRelAyudas extends CI_Controller
{

    public function __construct()
    {


        parent::__construct();

// Load form helper library
        $this->load->helper('form');

        $this->load->helper(array('url'));

        // $this->load->view('base');

// Load form validation library
        $this->load->library('form_validation');

// Load session library
        $this->load->library('session');

// Load database
        $this->load->model('referidos/MReferidos');
        $this->load->model('referidos/MRelAyudas');
        $this->load->model('busquedas_ajax/ModelsBusqueda');
        $this->load->model('administracion/MAuditoria');
        $this->load->model('configuracion/usuarios/Usuarios_model');
        
    }
    // INDEX del modulo de perfil del referido
    function index(){
        $this->load->view('base');
        $id_user = ($this->session->userdata['logged_in']['id']); // ID usuario
        $data['usuario'] = $this->Usuarios_model->obtenerUsuario($id_user);
        $cod_user = $data['usuario'][0]->codigo; // Codigo del Usuario
        $data['editar'] = $this->MReferidos->obtenerReferido($cod_user);
        $data['cod_perfil'] = $data['editar'][0]->codigo;

        $data['listar'] = $this->MRelAyudas->obtenerRelAyudas($cod_user); // Listado de Retiros solicitados
        $data['listar_usuarios'] = $this->Usuarios_model->obtenerUsuarios(); // Listado de usuarios
        $this->load->view('referidos/perfil/paneles/soporte_usuario',$data);
    }
    //metodo para guardar un nuevo registro
    public function guardar(){
        $datos = array(
            'codigo' => $this->ModelsBusqueda->count_all_table('ref_rel_ayudas')+1,
            'usuario_id' => $this->input->post('usuario_id'),
            'motivo'=> $this->input->post('motivo'),
            'pregunta'=> $this->input->post('preguntas'),
            'estatus'=> 1,
            'fecha_pre' => date('Y-m-d'),
        );
        $result = $this->MRelAyudas->insertarRelAyudas($datos);
        if ($result) {
            $param = array(
                'tabla' => 'RelAyudas',
                'codigo' => $this->input->post('codigo'),
                'accion' => 'Nueva solicitud de Soporte',
                'fecha' => date('Y-m-d'),
                'hora' => date("h:i:s a"),
                'usuario' => $this->session->userdata['logged_in']['id'],
            );
            $this->MAuditoria->add($param);
        }    
    }
}
