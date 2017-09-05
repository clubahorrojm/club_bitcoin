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
class CRelLinks extends CI_Controller
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
        $this->load->model('busquedas_ajax/ModelsBusqueda');
        $this->load->model('administracion/MAuditoria');
		$this->load->model('configuracion/usuarios/Usuarios_model');
        $this->load->model('referidos/MRelPagos');
        $this->load->model('referidos/MRelLinks');
		$this->load->model('referidos/MRelNivel');
    }
    // INDEX del modulo de perfil del referido
    function index(){
        $this->load->view('base');
		$id_user = ($this->session->userdata['logged_in']['id']); // ID usuario
		$data['usuario'] = $this->Usuarios_model->obtenerUsuario($id_user);
		$cod_user = $data['usuario'][0]->codigo; // Codigo del Usuario
		$data['editar'] = $this->MReferidos->obtenerReferido($cod_user);

        $data['listar_usuarios'] = $this->Usuarios_model->obtenerUsuarios(); // Listado de usuarios
        //$data['pago'] = $this->MRelPagos->obtenerRelPagos($cod_user); // Informacion del pago de ingreso al sistema
        $data['listar_links'] = $this->MRelLinks->obtenerLinksDisp(); // Listado de links de invitacion 
        $data['val_links'] = count($data['listar_links']); //Captura de numero de links generados
        $data['listar_cant_links'] = $this->MRelLinks->obtenerCantRelLinks($cod_user); // Cantidad de links ocupados por referido hijo

        $this->load->view('referidos/perfil/paneles/links',$data);
    }
    
    //Método para guardar un nuevo registro
    public function guardar(){
        $u_id = $this->input->post('usuario_id');
		$data['usuario'] = $this->Usuarios_model->obtenerUsuario($u_id);
		$username = $data['usuario'][0]->username; // Codigo del Usuario
        $result = $this->MRelLinks->obtenerRelLinks($u_id);
		$data['editar'] = $this->MReferidos->obtenerReferido($u_id);
		$cod_perfil = $data['editar'][0]->codigo;
        if (count($result) == 0){
            for ($i=1; $i<6; $i++){
                $datos = array(
					'id' => $this->ModelsBusqueda->count_all_table('ref_rel_links')+1,
                    'codigo' => $this->ModelsBusqueda->count_all_table('ref_rel_links')+1,
                    'usuario_id' => $this->input->post('usuario_id'),
                    'links'=> base_url().'index.php?codigo='.$u_id.'&link='.$i,
                    'estatus'=> 1,
                    'num_link'=> $i,
                    'fecha'=> date('Y-m-d'),
                );
                $result = $this->MRelLinks->insertarRelLinks($datos);
            }
			//Registro del nivel 0
			if ($result) {
                $param = array(
					'usuario_id' => $this->session->userdata['logged_in']['id'],
                    'nivel' => 0,
                    'tiempo' => 0,
                    'fecha' => date('Y-m-d'),                    
                );
                $this->MRelNivel->insertarRelNivel($param);
            }
			$niveles = array(
				'codigo' => $cod_perfil,
				'nivel' => 1,
			);
			$result = $this->MReferidos->actualizarReferidos($niveles); // SE ACTUALIZA EL NIVEL DEL USUARIO		
            if ($result) {
                $param = array(
                    'tabla' => 'RelLinks',
                    'codigo' => $this->input->post('usuario_id'),
                    'accion' => 'Generacion de Links de invitación usuario:'.$username,
                    'fecha' => date('Y-m-d'),
                    'hora' => date("h:i:s a"),
                    'usuario' => $this->session->userdata['logged_in']['id'],
                );
                $this->MAuditoria->add($param);
            }

        }else{
            echo 1;
        }
    }
}
