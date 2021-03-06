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
class CRelRetiros extends CI_Controller
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
        $this->load->model('referidos/MRelRetiros');
        $this->load->model('busquedas_ajax/ModelsBusqueda');
        $this->load->model('administracion/MAuditoria');
        $this->load->model('configuracion/usuarios/Usuarios_model');
        $this->load->model('configuracion/MTiposMonedas');
        $this->load->model('administracion/MPaises');
		$this->load->model('mails/MMailsSolRetiros');

        
    }
    // INDEX del modulo de perfil del referido
    function index(){
        $this->load->view('base');
        $id_user = ($this->session->userdata['logged_in']['id']); // ID usuario
        $data['usuario'] = $this->Usuarios_model->obtenerUsuario($id_user);
        $cod_user = $data['usuario'][0]->codigo; // Codigo del Usuario
        $data['editar'] = $this->MReferidos->obtenerReferido($cod_user);
        $data['cod_perfil'] = $data['editar'][0]->codigo;

        $data['listar_retiros'] = $this->MRelRetiros->obtenerRelRetiros($cod_user); // Listado de Retiros solicitados
        $id_moneda = $data['editar'][0]->t_moneda_id; // ID Tipo de moneda

        $data['monedas'] = $this->MTiposMonedas->obtenerTiposMonedas($id_moneda);
        $data['moneda'] = $data['monedas'][0]->abreviatura; // Abreviatura de moneda
        $data['monto_minimo'] = $data['editar'][0]->monto_retiro_minimo; // Listado de links de invitacion 
        ////////////// GRAFICA /////////////////////////////////
        $resultado = $this->MRelRetiros->obtener_grafica_retiros($cod_user);
		foreach($resultado as $r){
			$sum_retiros= $r->sum_retiros;
		}	
		$data['sum_retiros'] = $sum_retiros;
       
       
        $this->load->view('referidos/perfil/paneles/solicitud_retiro',$data);
    }
    //metodo para guardar un nuevo registro
    public function guardar(){
        $datos = array(
            'codigo' => $this->ModelsBusqueda->count_all_table('ref_rel_retiros')+1,
            'usuario_id' => $this->input->post('usuario_id'),
            'monto'=> $this->input->post('monto'),
            'fecha_solicitud'=> date('Y-m-d'),
            'estatus'=> 1,
        );
        $result = $this->MRelRetiros->insertarRelRetiros($datos);
		////////////////// CORREO//////////////////////////////
		$id_user = $this->input->post('usuario_id');
        $data['usuario'] = $this->Usuarios_model->obtenerUsuario($id_user);
        $correo = $data['usuario'][0]->email;
        $username = $data['usuario'][0]->username;
        $datos_reg = array(
            'username' => $username,
            'email' => $correo,
			'monto' => $this->input->post('monto'),
			'codigo' => $this->ModelsBusqueda->count_all_table('ref_rel_retiros')+1,
        );
        //print_r($datos_reg);
        $this->MMailsSolRetiros->enviarMailConfirm($datos_reg);
        if ($result) {
            $param = array(
                'tabla' => 'RelRetiros',
                'codigo' => $this->input->post('codigo'),
                'accion' => 'Nueva solicitud de retiro',
                'fecha' => date('Y-m-d'),
                'hora' => date("h:i:s a"),
                'usuario' => $this->session->userdata['logged_in']['id'],
            );
            $this->MAuditoria->add($param);
            //redirect('configuracion/CRelPagos');
        }
    }
    function editar()
    {
        
        $datos = $this->input->post('id');
        //print_r($id);
        $result = $this->MRelRetiros->obtenerCuenta($datos);
        //print_r($result);
        echo json_encode($result);
        // exit();
    }
    function pdf_recibo_retiro($cod_retiro){
        $id_user = ($this->session->userdata['logged_in']['id']); // ID usuario
        $data['usuario'] = $this->Usuarios_model->obtenerUsuario($id_user);
        $cod_user = $data['usuario'][0]->codigo; // Codigo del Usuario
        $perfil = $this->MReferidos->obtenerReferido($cod_user);
        $data['retiro'] = $this->MRelRetiros->obtenerPdfRetiro($cod_retiro); // Informacion del pago de ingreso al sistema
        //$cuenta_id = $data['retiro'][0]->cuenta_id;
        //$data['id'] = $this->MInmuebles->obtenerResumenInmueble($id);  // Datos generales de la factura
        // $data['empresa'] = $this->MEmpresa->obtenerEmpresa(1);
        
        //$data['listar_cuenta'] = $this->MCuentas->obtenerCuenta($cuenta_id); // Listado de cuentas de la pagina
/*        $data['listar_bancos'] = $this->MBancos->obtenerBanco(); // Listado de Bancos
        $data['listar_t_cuentas'] = $this->MTiposCuenta->obtenerTiposCuenta(); // Listado de Tipo de cuentas*/
        $data['listar_usuarios'] = $this->Usuarios_model->obtenerUsuarios(); // Listado de usuarios
        $data['listar_paises'] = $this->MPaises->obtenerPais(); // Listado de cuentas de la pagina
        $id_moneda = $perfil[0]->t_moneda_id; // ID Tipo de moneda
        $data['monedas'] = $this->MTiposMonedas->obtenerTiposMonedas($id_moneda);
        $data['moneda'] = $data['monedas'][0]->abreviatura; // Abreviatura de moneda

        $this->load->view('referidos/perfil/pdf/reporte_recibo_retiro', $data);
    }
    
}
