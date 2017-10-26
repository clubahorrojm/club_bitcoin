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
class CLPagos extends CI_Controller
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
		$this->load->model('procesos/MLPagos');
        $this->load->model('configuracion/usuarios/Usuarios_model');
        $this->load->model('busquedas_ajax/ModelsBusqueda');
        $this->load->model('administracion/MAuditoria');
        $this->load->model('referidos/MRelPagos');
        $this->load->model('referidos/MRelLinks');
        $this->load->model('referidos/MReferidos');
        $this->load->model('mails/MPagoConfirm');
        $this->load->model('mails/MMotivoNegacion1');
        $this->load->model('mails/MMotivoNegacion2');
        
    }

    function index()
    {
        $this->load->view('base');
        //Validación de configuración de primer uso
        //Al no existir registros por defecto carga algunos genéricos
        $data['listar'] = '';
        $ultimo_id = $this->ModelsBusqueda->count_all_table('ref_rel_pagos_bitcoins');
        if ($ultimo_id > 0){
            $data['listar'] = $this->MLPagos->obtenerPagosBit();
        }
        else{
            $data['listar'] = [];
        }
        $data['listar_usuarios'] = $this->Usuarios_model->obtenerUsuarios();
        // Datos del monedero bitcoin de la empresa
        $data['monedero_emp'] = $this->ModelsBusqueda->obtenerRegistro('adm_monedero', 'id', 1);
        // $data['listar_cuentas'] = $this->MCuentas->obtenerCuentas();
        $this->load->view('procesos/pagos/lista2', $data);
    }
    
    // Método para validar el pago
    function validar($cod){
        // Armamos la data a actualizar
        $data = array(
            'codigo' => $cod,
            'estatus' => 2,
            'operador_id' => $this->session->userdata['logged_in']['codigo'],
            'fecha_verificacion' => date('Y-m-d'),
        );
        // Actualizamos el pago con los datos armados
        $result = $this->MLPagos->actualizarPagoBit($data);
        // Registramos los cambios en la Bitacora
        if ($result) {
            $param = array(
                'tabla' => 'ref_rel_pagos_bitcoins',
                'codigo' => $cod,
                'accion' => 'Actualización de Pago',
                'fecha' => date('Y-m-d'),
                'hora' => date("h:i:s a"),
                'usuario' => $this->session->userdata['logged_in']['id'],
            );
            $this->MAuditoria->add($param);
        }
        // Actualizamos el perfil
        $data['pagos'] = $this->MRelPagos->obtenerRelPagos2Bit($cod);
        $id_perfil = $data['pagos'][0]->perfil_id;
        $id_usuario = $data['pagos'][0]->usuario_id;
        $datos2 = array(
            'codigo'=> $id_perfil,
            'estatus'=> 2,
        );
        // Actualizamos el perfil
        $result = $this->MReferidos->actualizarReferidos($datos2);
        // Registramos los cambios en la Bitacora
        if ($result) {
			// Primero actualizamos el link con la verificación del pago
			$datos3 = array(
				'referido_id'=> $id_usuario,
				'verif_pago'=> 1
			);
			$result = $this->MRelLinks->actualizarReferidoLinks($datos3);
			
			// Consultamos los datos del usuario
			$data_usuario = $this->ModelsBusqueda->obtenerRegistro('usuarios', 'id', $id_usuario);
			// Enviamos email de confirmación de pago
			$datos_reg = array(
				'email' => $data_usuario->email
			);
			$this->MPagoConfirm->enviarMailPago($datos_reg);
			
            $param = array(
                'tabla' => 'ref_perfil',
                'codigo' => $id_perfil,
                'accion' => 'Actualización de Perfil',
                'fecha' => date('Y-m-d'),
                'hora' => date("h:i:s a"),
                'usuario' => $this->session->userdata['logged_in']['id'],
            );
            $this->MAuditoria->add($param);
        }
    }
    
    // Método para negar el pago
    function negar($cod){
        // Armamos la data a actualizar
        $data = array(
            'codigo' => $cod,
            'estatus' => 3,
            'operador_id' => $this->session->userdata['logged_in']['codigo'],
            'fecha_verificacion' => date('Y-m-d'),
            'motivo_negacion' => $this->input->post('motivo'),
        );
        // Actualizamos el pago con los datos armados
        $result = $this->MLPagos->actualizarPagoBit($data);
        // Registramos los cambios en la Bitacora
        if ($result) {
			// Capturamos el id del usuario
			$data['pagos'] = $this->MRelPagos->obtenerRelPagos2Bit($cod);
			$id_usuario = $data['pagos'][0]->usuario_id;
			// Consultamos los datos del usuario
			$data_usuario = $this->ModelsBusqueda->obtenerRegistro('usuarios', 'id', $id_usuario);
			// Envío de correo según motivo
			$datos_reg = array(
				'email' => $data_usuario->email
			);
			if($this->input->post('motivo') == "No se refleja el pago"){
				//~ echo "Enviando correo 1...";
				$this->MMotivoNegacion1->enviarMailNegacion($datos_reg);
			}else if($this->input->post('motivo') == "Pago Insuficiente"){
				//~ echo "Enviando correo 2...";
				$this->MMotivoNegacion2->enviarMailNegacion($datos_reg);
			}else{
				echo $this->input->post('motivo');
			}
			
            $param = array(
                'tabla' => 'ref_rel_pagos_bitcoins',
                'codigo' => $cod,
                'accion' => 'Negación de Pago',
                'fecha' => date('Y-m-d'),
                'hora' => date("h:i:s a"),
                'usuario' => $this->session->userdata['logged_in']['id'],
            );
            $this->MAuditoria->add($param);
        }
    }
    
    // Método para retornar una lista de pagos pendientes
    function pagos_pendientes(){
        // Consultamos los pagos pendientes
        $result = $this->MLPagos->obtenerPagosBitPendientes();
        // Retornamos un json con los pagos
        echo json_encode($result);
    }
}

