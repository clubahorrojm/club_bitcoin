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
class CRelRanking extends CI_Controller
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
        $this->load->model('referidos/MRelRanking');
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

        $data['listar_top_ref'] = $this->MRelRanking->obtenerTopCantRef(); // Listado de Retiros solicitados/**/
        $data['listar_top_disp'] = $this->MRelRanking->obtenerTopCantDisp(); // Listado de Retiros solicitados/**/
        $data['listar_usuarios'] = $this->Usuarios_model->obtenerUsuarios(); // Listado de usuarios
        $this->load->view('referidos/perfil/paneles/ranking',$data);
    }

}
