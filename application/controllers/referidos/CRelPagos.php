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
class CRelPagos extends CI_Controller
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
        $this->load->model('configuracion/usuarios/Usuarios_model');
        $this->load->model('administracion/MEmpresa');
        $this->load->model('configuracion/MTiposMonedas');
        $this->load->model('configuracion/MCuentas');
        $this->load->model('configuracion/MBancos');
        $this->load->model('configuracion/MTiposCuenta');
        $this->load->model('configuracion/MMontoPago');
        
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
        
        $data['listar_cuentas'] = $this->MCuentas->obtenerCuentas(); // Listado de cuentas de la pagina
        $data['listar_bancos'] = $this->MBancos->obtenerBanco(); // Listado de Bancos
        $data['listar_t_cuentas'] = $this->MTiposCuenta->obtenerTiposCuenta(); // Listado de Tipo de cuentas
        $data['pago'] = $this->MRelPagos->obtenerRelPagos($cod_user); // Informacion del pago de ingreso al sistema
        $data['monto_pago'] = $data['editar'][0]->monto_pago; // Captura del monto del pago de ingreso al sistema
        $this->load->view('referidos/perfil/paneles/pagos',$data);
    }
    
    //metodo para guardar un nuevo registro
    public function guardar(){
        $result = $this->MRelPagos->insertarRelPagos($datos);
        if ($result) {
            $param = array(
                'tabla' => 'Rel Pagos',
                'codigo' => $this->input->post('cod_pago'),
                'accion' => 'Registro de nuevo Pago al sistema',
                'fecha' => date('Y-m-d'),
                'hora' => date("h:i:s a"),
                'usuario' => $this->session->userdata['logged_in']['id'],
            );
            $this->MAuditoria->add($param);
        }
    }
    function editar()
    {
        
        $datos = $this->input->post('id');
        $result = $this->MRelPagos->obtenerCuenta($datos);
        echo json_encode($result);
    }

    //metodo para guardar un nuevo registro
    public function actualizar(){
        $fecha = explode('/',$this->input->post('fecha_pago'));
        $fecha = $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
        $id_user = ($this->session->userdata['logged_in']['id']); // ID usuario
        $data['pago'] = $this->MRelPagos->obtenerRelPagos($id_user); // Informacion del pago de ingreso al sistema
        $status_pago = $data['pago'][0]->estatus; // Estatus del pago
        if($status_pago == 2){
			$status_pago = 2;
		}else{
			$status_pago = 1;
		}
        $datos = array(
            'codigo' => $this->input->post('cod_pago'),
            'cuenta_id' => $this->input->post('cuenta_id'),
            'num_pago' => $this->input->post('num_pago'),
            'tipo_pago'=> $this->input->post('tipo_pago'),
            'fecha_pago'=> $fecha,
            'monto'=> $this->input->post('monto'),
            'perfil_id'=> $this->input->post('pk_perfil'),
            'estatus'=> $status_pago,
        );
        //print_r($datos);
        $result = $this->MRelPagos->actualizarRelPagos($datos);
        $datos2 = array(
            'id'=> $this->input->post('pk_perfil'),
            'estatus'=> 2,
        );
        $result = $this->MReferidos->actualizarReferidos($datos2);
        if ($result) {
            $param = array(
                'tabla' => 'RelPagos',
                'codigo' => $this->input->post('cod_pago'),
                'accion' => 'Actualización Pago al sistema',
                'fecha' => date('Y-m-d'),
                'hora' => date("h :i:s a"),
                'usuario' => $this->session->userdata['logged_in']['id'],
            );
            $this->MAuditoria->add($param);
            //redirect('configuracion/CRelPagos');
        }
    }


    // Generación de reporte de auditoría
    function pdf_recibo_pago(){
        $id_user = ($this->session->userdata['logged_in']['id']); // ID usuario
        $data['usuario'] = $this->Usuarios_model->obtenerUsuario($id_user);
        $cod_user = $data['usuario'][0]->codigo; // Codigo del Usuario
        $data['pago'] = $this->MRelPagos->obtenerRelPagos($cod_user); // Informacion del pago de ingreso al sistema
        $cuenta_id = $data['pago'][0]->cuenta_id;
        $perfil = $this->MReferidos->obtenerReferido($cod_user);
        
        $data['empresa'] = $this->MEmpresa->obtenerEmpresa(1);
        $data['editar'] = $this->MReferidos->obtenerReferido($cod_user);
        $id_moneda = $data['editar'][0]->t_moneda_id; // ID Tipo de moneda
        $data['monedas'] = $this->MTiposMonedas->obtenerTiposMonedas($id_moneda);
        $data['moneda'] = $data['monedas'][0]->abreviatura; // Abreviatura de moneda

        $data['listar_cuenta'] = $this->MCuentas->obtenerCuenta($cuenta_id); // Listado de cuentas de la pagina
        $data['listar_bancos'] = $this->MBancos->obtenerBanco(); // Listado de Bancos
        $data['listar_t_cuentas'] = $this->MTiposCuenta->obtenerTiposCuenta(); // Listado de Tipo de cuentas
        $data['listar_usuarios'] = $this->Usuarios_model->obtenerUsuarios(); // Listado de usuarios
        
        $id_moneda = $perfil[0]->t_moneda_id; // ID Tipo de moneda
        $data['monedas'] = $this->MTiposMonedas->obtenerTiposMonedas($id_moneda);
        $data['moneda'] = $data['monedas'][0]->abreviatura; // Abreviatura de moneda
        $this->load->view('referidos/perfil/pdf/reporte_recibo_pago', $data);
    }
    
}
