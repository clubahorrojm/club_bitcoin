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
class CLRetiros extends CI_Controller
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
        $this->load->model('procesos/MLRetiros');
        $this->load->model('configuracion/usuarios/Usuarios_model');
        $this->load->model('administracion/MComisionRetiro');
        $this->load->model('referidos/MReferidos');
        $this->load->model('busquedas_ajax/ModelsBusqueda');
        $this->load->model('administracion/MAuditoria');
        
    }

    function index()
    {
        //Validacion de configuracion de primer uso
        //Al no existir registros por defecto carga algunos genéricos
        $data['listar'] = '';
        $ultimo_id = $this->ModelsBusqueda->count_all_table('ref_rel_retiros');
        if ($ultimo_id > 0){
            $data['listar'] = $this->MLRetiros->obtenerRetiros();
        }
        else{
            //~ $this->MCuentas->cargarCSV();
            //~ redirect('configuracion/CCuentas');
            $data['listar'] = [];
        }
        $data['listar_usuarios'] = $this->Usuarios_model->obtenerUsuarios();
        $this->load->view('procesos/retiros/lista2', $data);
    }
    
    // Método para aprobar un retiro
    function aprobar($cod){
		
		$fecha = $this->input->post('fecha_verificacion');
		$fecha = explode("/",$fecha);
		$fecha = $fecha[2]."-".$fecha[1]."-".$fecha[0];
		
		// Capturamos el monto del porcentaje de comisión por retiro registrado en el sistema
		$comision = $this->ModelsBusqueda->obtenerRegistro('adm_comision_retiro', 'codigo', 1);
        
        // Armamos la data a actualizar
        $data = array(
            'codigo' => $cod,
            'estatus' => 2,
            'operador_id' => $this->session->userdata['logged_in']['codigo'],
            'num_pago' => $this->input->post('num_pago'),
            'fecha_verificacion' => $fecha,
            'porcentaje_comision' => $comision->porcentaje_comision,
        );
        
        // Actualizamos el tipo de cuenta con los datos armados
        $result = $this->MLRetiros->actualizarRetiro($data);
        
        // Registramos los cambios en la Bitacora
		$param = array(
			'tabla' => 'ref_rel_retiros',
			'codigo' => $cod,
			'accion' => 'Aprobación de Retiro',
			'fecha' => date('Y-m-d'),
			'hora' => date("h:i:s a"),
			'usuario' => $this->session->userdata['logged_in']['id'],
		);
		$this->MAuditoria->add($param);
		
		// Actualizamos la disponibilidad (restamos el monto del retiro a la disponibilidad) del perfil del usuario
		// Primero obtenemos el id de usuario y el monto del retiro actual
		$retiro = $this->MLRetiros->obtenerRetiro($cod);
		$id_usu_retiro = $retiro[0]->usuario_id;
		$monto_retiro = $retiro[0]->monto;
		//Buscamos el porcentaje de comisión por retiro y se lo sumamos al monto de retiro
		$comision = $this->ModelsBusqueda->obtenerRegistro('adm_comision_retiro', 'codigo', 1);
		$comision = $comision->porcentaje_comision;
		$comision = $monto_retiro*$comision/100;
		$monto_retiro += $comision;
		// Ahora buscamos el perfil que corresponda al usuario
		$perfil = $this->MReferidos->obtenerReferido($id_usu_retiro);
		$cod_perfil = $perfil[0]->codigo;
		$disp_perfil = $perfil[0]->disponible;
		// Por último actualizamos la disponibilidad aplicando la resta del monto del retiro a la disponibilidad
		$nueva_disp_perfil = $disp_perfil - $monto_retiro;  // Cálculo de la nueva disponibilidad
		$data_perfil = array(
			'codigo' => $cod_perfil,
			'disponible' => $nueva_disp_perfil,
		);
		$update_perfil = $this->MReferidos->actualizarReferidos($data_perfil);
		// Registramos los cambios en la Bitacora
        if ($result) {
            $param = array(
                'tabla' => 'ref_perfil',
                'codigo' => $cod_perfil,
                'accion' => 'Actualización de Perfil',
                'fecha' => date('Y-m-d'),
                'hora' => date("h:i:s a"),
                'usuario' => $this->session->userdata['logged_in']['id'],
            );
            $this->MAuditoria->add($param);
        }
            
    }
}

