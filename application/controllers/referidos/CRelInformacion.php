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
class CRelInformacion extends CI_Controller
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
        $this->load->model('referidos/MRelPagos');
        $this->load->model('referidos/MReferidos');
        $this->load->model('busquedas_ajax/ModelsBusqueda');
        $this->load->model('administracion/MAuditoria');
		$this->load->model('administracion/MPaises');
        $this->load->model('configuracion/usuarios/Usuarios_model');
        
    }
    // INDEX del modulo de perfil del referido
    function index(){
        $this->load->view('base');
        $id_user = ($this->session->userdata['logged_in']['id']); // ID usuario
        $data['usuario'] = $this->Usuarios_model->obtenerUsuario($id_user);
        $cod_user = $data['usuario'][0]->codigo; // Codigo del Usuario
        $nombre_ref = $data['usuario'][0]->first_name.' '.$data['usuario'][0]->last_name; // Variable que contiene el nombre del usuario completo
        $data['editar'] = $this->MReferidos->obtenerReferido($cod_user);
        $data['cod_perfil']  = $data['editar'][0]->codigo; // Codigo del Usuario
        $data['listar_paises'] = $this->MPaises->obtenerPais(); // Listado de cuentas de la pagina
		$data['estatus_perfil']  = $data['editar'][0]->estatus; // Estatus del perfil del Usuario
        $this->load->view('referidos/perfil/paneles/informacion_personal',$data);
    }
    
   //Metodo para actualizar
   function actualizar(){
		$fecha = explode('/',$this->input->post('fecha_na'));
        $fecha = $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
        $datos = array(
            //'cedula' => $this->input->post('cedula'),
            'first_name' => $this->input->post('nombre'),
            'last_name' => $this->input->post('apellido'),
            'email'=> $this->input->post('correo'),
			'fecha_na' => $fecha,
            'pais_id' => $this->input->post('pais_id'),
            'patrocinador_id'=> $this->input->post('patrocinador_id'),
        );
        $id = $this->input->post('usuario_id');
		$result = $this->Usuarios_model->actualizar2($id, $datos);
		
		$id_user = ($this->session->userdata['logged_in']['id']); // ID usuario
		$data['usuario'] = $this->Usuarios_model->obtenerUsuario($id_user);
		$cod_user = $data['usuario'][0]->codigo; // Codigo del Usuario
		$data['editar'] = $this->MReferidos->obtenerReferido($cod_user);
		$estatus = $data['editar'][0]->estatus; // Codigo del Usuario
		$username = $data['usuario'][0]->username; // Codigo del Usuario
		//Si es primera actualizacion (cambia estatus)
		if ($estatus == 2){
            $datos2 = array(
				'dir_monedero' => $this->input->post('dir_monedero_per'),
				'codigo'=> $this->input->post('pk_perfil'),
				'estatus'=> 3,
            );
		}else{ //Si es una actualizacion secundaria
            $datos2 = array(
				'dir_monedero' => $this->input->post('dir_monedero_per'),
				'codigo'=> $this->input->post('pk_perfil'),
            );
		}
        $result = $this->MReferidos->actualizarReferidos($datos2);
        if ($result) {
           $param = array(
               'tabla' => 'Perfiles',
               'codigo' => $this->input->post('cedula'),
               'accion' => 'Edición de perfil de usuario: '.$username,
               'fecha' => date('Y-m-d'),
               'hora' => date("h:i:s a"),
               'usuario' => $this->session->userdata['logged_in']['id'],
           );
           $this->MAuditoria->add($param);
           echo "registrado";
        }else{
			echo "fallo";
		}
   }
}
