<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * && $cant_ref open the template in the editor.
 */

/**
 * Description of ControllersReferidos
 *
 * @author Ing. Marcel Arcuri
 */
class CReferidos extends CI_Controller
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
        $this->load->model('referidos/MReferidos');
        $this->load->model('busquedas_ajax/ModelsBusqueda');
        $this->load->model('administracion/MAuditoria');
		$this->load->model('configuracion/usuarios/Usuarios_model');
        $this->load->model('configuracion/MTiposMonedas');
        // $this->load->model('configuracion/MCuentas');
        // $this->load->model('configuracion/MBancos');
        // $this->load->model('configuracion/MTiposCuenta');
        $this->load->model('referidos/MRelPagos');
        $this->load->model('referidos/MRelRetiros');
        $this->load->model('referidos/MRelLinks');
		$this->load->model('referidos/MRelDistribucion');
		// $this->load->model('configuracion/MMontoPago');
		$this->load->model('referidos/MRelDistribucion');
		// $this->load->model('configuracion/MRetiroMinimo');
		$this->load->model('administracion/MEmpresa');

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
		$data['estatus_perfil']  = $data['editar'][0]->estatus; // Estatus del perfil del Usuario
        $cod_perfil = $data['editar'][0]->codigo; // Codigo del Usuario
        // $data['listar_t_cuentas'] = $this->MTiposCuenta->obtenerTiposCuenta(); // Listado de Tipo de cuentas
        // $data['listar_cuentas'] = $this->MCuentas->obtenerCuentas(); // Listado de cuentas de la pagina
        // $data['listar_bancos'] = $this->MBancos->obtenerBanco(); // Listado de Bancos
        $data['monto_pago'] = $data['editar'][0]->monto_pago; // Captura del monto del pago de ingreso al sistema
		
        ////////// Metodo para la actualizacion del nivel del usuario en base a la cantidad de sub referidos/////////////
        $cant_ref = $data['editar'][0]->cant_ref; // Cantidad de sub referidos
        if ($cant_ref < 6){
          $niveles = array(
            'codigo' => $cod_perfil,
            'nivel' => 1,
          );
          $result = $this->MReferidos->actualizarReferidos($niveles);
        }else if ($cant_ref > 5 && $cant_ref < 26){
          $niveles = array(
            'codigo' => $cod_perfil,
            'nivel' => 2,
          );
          $result = $this->MReferidos->actualizarReferidos($niveles);
        }else if ($cant_ref > 25 && $cant_ref < 126){
          $niveles = array(
            'codigo' => $cod_perfil,
            'nivel' => 3,
          );
          $result = $this->MReferidos->actualizarReferidos($niveles);
        }else if ($cant_ref > 125 && $cant_ref < 626){
          $niveles = array(
            'codigo' => $cod_perfil,
            'nivel' => 4,
          );
          $result = $this->MReferidos->actualizarReferidos($niveles);
        }else if ($cant_ref > 625 && $cant_ref < 3126){
          $niveles = array(
            'codigo' => $cod_perfil,
            'nivel' => 5,
          );
          $result = $this->MReferidos->actualizarReferidos($niveles);
        }else if ($cant_ref > 3125 && $cant_ref < 15626){
          $niveles = array(
            'codigo' => $cod_perfil,
            'nivel' => 6,
          );
          $result = $this->MReferidos->actualizarReferidos($niveles);
        }else if ($cant_ref > 15625 && $cant_ref < 78126){
          $niveles = array(
            'codigo' => $cod_perfil,
            'nivel' => 7,
          );
          $result = $this->MReferidos->actualizarReferidos($niveles);
        }
        /////////////////////////////////////////////////////////////////////////////////////////
        $id_moneda = $data['editar'][0]->t_moneda_id; // ID Tipo de moneda
        $data['monedas'] = $this->MTiposMonedas->obtenerTiposMonedas($id_moneda);
        $data['moneda'] = $data['monedas'][0]->abreviatura; // Abreviatura de moneda
        $data['listar_usuarios'] = $this->Usuarios_model->obtenerUsuarios(); // Listado de usuarios

        /////// Al ingresar por primera vez se genera un registro vacio (pre-pago) del pago a la pag
        $data['existe_pago'] = count($this->MRelPagos->obtenerRelPagosBit($cod_user));
        if ($data['existe_pago'] == 0){
          $datos = array(
            'id' => $this->ModelsBusqueda->count_all_table('ref_rel_pagos_bitcoins') + 1,
            'codigo' => $this->ModelsBusqueda->count_all_table('ref_rel_pagos_bitcoins') + 1,
            'usuario_id' => $cod_user,
            'estatus' => 99,
          );
          $result = $this->MRelPagos->insertarRelPagosBit($datos);
        }
        //////////////////////////////////////////////////////////////////////////////////////////////////////
		
		$data['pago'] = $this->MRelPagos->obtenerRelPagosBit($cod_user); // Informacion del pago de ingreso al sistema
		
        $data['listar_retiros'] = $this->MRelRetiros->obtenerRelRetiros($cod_user); // Listado de Retiros solicitados
        $num_distri = $this->MRelDistribucion->obtenerDistribuciones($cod_user);
        // Si el numero de pagos por este usuario es igual a 8 (cantidad maxima) y el estatus es menor a 4 (debido a que en 4 ya es 100% y en 5 culmino y creo otra cuenta)
		if ($data['estatus_perfil'] < 4 && count($num_distri) == 8){
			//if (count($num_distri) == 8){//Se procede a la actualizacion de estatus de perfil a 100%
			$datos_act_est_perfil = array(
				'estatus'=> 4,
				'codigo'=> $cod_perfil,
			);
			$result = $this->MReferidos->actualizarReferidos($datos_act_est_perfil);
		}
        
        /////////// Generacion de usuarios referidos padres  //////////////////////////////////////////////////////
        $cod_ref = $cod_user; //Se declara una variable con el codigo del usuario
        $datos2 = array(); // Se declara un diccionario
        for ($i=1; $i<8; $i++){ // Ciclo for donde se cargan los 7 usuarios de nivel superior del usuario logueado
			$nombre = ''; //
			$data['refrido'] = $this->MReferidos->obtenerReferido($cod_ref); 
			$cod_ref = $data['refrido'][0]->referido_id; // Se captura el codigo del referido DEL REFERIDO
			$data['padre_usuario'] = $this->Usuarios_model->obtenerUsuario($cod_ref);
			$nombre = $data['padre_usuario'][0]->first_name.' '.$data['padre_usuario'][0]->last_name; // Nombre completo del referido del referido XD
			// Se arma un diccionario con el Codigo, nombre completo y nivel de cada referido padre
			$datos = array(
			  'codigo' => $cod_ref,
			  'nombre' => $nombre,
			  'nivel' => $i,
			);
            $datos2[] = $datos; // Se arma una lista de una lista
        }
        // Por ultimo se le anexa a la lista el referido "EMPRESA"
		$datos3 = array(
			'codigo' => '99',
			'nombre' => 'Empresa',
			'nivel' => 8,
		);
		$datos2[] = $datos3;

        $data['listar_padres'] = $datos2; // Lista de referidos padres
        
        ///////////////////////////////////////////////////////////////////////////////////////////////////////
        $data['listar_distribuciones'] = $this->MRelDistribucion->obtenerDistribucion($cod_user); //Listado de distribuciones realizadas
        
        // Datos del monedero bitcoin de la empresa
        $data['monedero_emp'] = $this->ModelsBusqueda->obtenerRegistro('adm_monedero', 'id', 1);

        // La ruta a la vista a cargar
        $vista = "";
		if ($data['estatus_perfil'] < 3){
			$vista = 'referidos/perfil/reg_perfil';
		}else{
			$vista = 'referidos/perfil/perfil';
		}

		// Carga de la vista
		$this->load->view($vista,$data);
    }
	
	// Generación de reporte de auditoría
    function pdf_resumen_pagos(){
        $id_user = ($this->session->userdata['logged_in']['id']); // ID usuario
        $data['usuario'] = $this->Usuarios_model->obtenerUsuario($id_user);
        $cod_user = $data['usuario'][0]->codigo; // Codigo del Usuario
		$data['listar_distribuciones'] = $this->MRelDistribucion->obtenerDistribucion($cod_user); //Listado de distribuciones realizadas
        
        $data['empresa'] = $this->MEmpresa->obtenerEmpresa(1);
        $data['editar'] = $this->MReferidos->obtenerReferido($cod_user);
        $id_moneda = $data['editar'][0]->t_moneda_id; // ID Tipo de moneda
        $data['monedas'] = $this->MTiposMonedas->obtenerTiposMonedas($id_moneda);
        $data['moneda'] = $data['monedas'][0]->abreviatura; // Abreviatura de moneda

        //$data['listar_cuenta'] = $this->MCuentas->obtenerCuenta($cuenta_id); // Listado de cuentas de la pagina
        //$data['listar_bancos'] = $this->MBancos->obtenerBanco(); // Listado de Bancos
        //$data['listar_t_cuentas'] = $this->MTiposCuenta->obtenerTiposCuenta(); // Listado de Tipo de cuentas
        $data['listar_usuarios'] = $this->Usuarios_model->obtenerUsuarios(); // Listado de usuarios
        $data['listar_distribuciones'] = $this->MRelDistribucion->obtenerDistribucion($cod_user); //Listado de distribuciones realizadas

        $this->load->view('referidos/perfil/pdf/reporte_resumen_pagos', $data);
    }
		// Generación de reporte de auditoría
    function pdf_resumen_retiros(){
        $id_user = ($this->session->userdata['logged_in']['id']); // ID usuario
        $data['usuario'] = $this->Usuarios_model->obtenerUsuario($id_user);
        $cod_user = $data['usuario'][0]->codigo; // Codigo del Usuario
		$data['listar_distribuciones'] = $this->MRelDistribucion->obtenerDistribucion($cod_user); //Listado de distribuciones realizadas
        
        $data['empresa'] = $this->MEmpresa->obtenerEmpresa(1);
        $data['editar'] = $this->MReferidos->obtenerReferido($cod_user);
        $id_moneda = $data['editar'][0]->t_moneda_id; // ID Tipo de moneda
        $data['monedas'] = $this->MTiposMonedas->obtenerTiposMonedas($id_moneda);
        $data['moneda'] = $data['monedas'][0]->abreviatura; // Abreviatura de moneda

        //$data['listar_cuenta'] = $this->MCuentas->obtenerCuenta($cuenta_id); // Listado de cuentas de la pagina
        //$data['listar_bancos'] = $this->MBancos->obtenerBanco(); // Listado de Bancos
        //$data['listar_t_cuentas'] = $this->MTiposCuenta->obtenerTiposCuenta(); // Listado de Tipo de cuentas
        $data['listar_usuarios'] = $this->Usuarios_model->obtenerUsuarios(); // Listado de usuarios
        $data['listar_retiros'] = $this->MRelRetiros->obtenerRelRetiros($cod_user); // Listado de Retiros solicitados

        $this->load->view('referidos/perfil/pdf/reporte_resumen_retiros', $data);
    }
   
}
