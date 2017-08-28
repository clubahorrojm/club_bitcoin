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
class CRelDistribucion extends CI_Controller
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
        $this->load->model('referidos/MRelDistribucion');
        $this->load->model('referidos/MReferidos');
		$this->load->model('administracion/MAMontos');
        $this->load->model('configuracion/usuarios/Usuarios_model');
        $this->load->model('busquedas_ajax/ModelsBusqueda');
        $this->load->model('administracion/MAuditoria');
		$this->load->model('referidos/MRelLinks');
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
		// $datos3 = array(
		// 	'codigo' => '99',
		// 	'nombre' => 'Empresa',
		// 	'nivel' => 8,
		// );
		// $datos2[] = $datos3;

        $data['listar_padres'] = $datos2; // Lista de referidos padres
        /////////////////////////////////////////////////////////////////////////////////////////////
		$data['listar_distribuciones'] = $this->MRelDistribucion->obtenerDistribuciones($cod_user); //Listado de distribuciones realizadas
        $this->load->view('referidos/perfil/paneles/distribucion',$data);
    }
	
    //////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////// METODO PARA EL PAGO A REFERIDOS PADRES //////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////
    public function pagar(){
        
        $nivel_ref = $this->input->post('nivel_ref'); //Nivel del referido a pagar
        $id_user = ($this->session->userdata['logged_in']['id']); //ID del usuario logueado
		$data['usuario'] = $this->Usuarios_model->obtenerUsuario($id_user); 
		$cod_user = $data['usuario'][0]->codigo; //Codigo del Usuario Logueado
        $ref_id = $this->input->post('id_ref'); //Codigo del referido a pagar
		$perfil = $this->MReferidos->obtenerReferido($cod_user);
        ////////////////// Verificacion para saber si existe el pago a este referido /////////////
        $result = $this->MRelDistribucion->obtenerDistribucion($cod_user, $ref_id);
        
        if (count($result) == 0){ // Si no existe se proce a generar el pago
            ////////////////////////////////////////////////
            // PASO 1 (registrar distribucion de capital)
            // Diccionario con los datos del pago a referido

            // Se arma una variable $por_lvl para identificar el % que se le pagara al referido
            $por_lvl = 'porcentaje'.$nivel_ref;
            $montos = $this->MAMontos->obtenerAMontos(1);
            $porcentaje = $montos->$por_lvl;  // Porcentaje a pagar al referido
            
            // Se consulta el monto estandar de pago para ingresar al sistema
			$monto_pago = $perfil[0]->monto_pago; // Captura del monto del pago de ingreso al sistema
            //$monto_pago = $this->MMontoPago->obtenerMontoPago(1);
            //$monto_pago = $monto_pago->monto_pago; // Monto estandar del sistema
            
            $pago = ($monto_pago * $porcentaje) / 100; //Cantidad a pagar al usuario
            $datos_distribucion = array(
               'codigo' => $this->ModelsBusqueda->count_all_table('ref_rel_distribucion')+1,
               'usuario_id' => $cod_user,
               'referido_id'=> $ref_id,
               'fecha' => date('Y-m-d'),
			   'monto' => $pago,
            );
            $result = $this->MRelDistribucion->insertarDistribucion($datos_distribucion);
            // Se Guarda en Bitacora el pago realizado
            if ($result) {
               $param = array(
                   'tabla' => 'Rel Distribución',
                   'codigo' => $this->ModelsBusqueda->count_all_table('ref_rel_distribucion')+1,
                   'accion' => 'Nueva Pago de distribucion de capital',
                   'fecha' => date('Y-m-d'),
                   'hora' => date("h:i:s a"),
                   'usuario' => $this->session->userdata['logged_in']['id'],
               );
               $this->MAuditoria->add($param);
            }
            if ($nivel_ref != 8){
                ////////////////////////////////////////////////
                // PASO 2 (Calculo de monto a pagar de acuerdo al nivel del referido)
                // Se captura el codigo del perfil del referido a pagar
    			$perfil = $this->MReferidos->obtenerReferido($ref_id);
    			$cod_perfil = $perfil[0]->codigo; // Codigo del perfil del referido
                // Se arma una variable $por_lvl para identificar el % que se le pagara al referido
    			$por_lvl = 'porcentaje'.$nivel_ref;
    			$montos = $this->MAMontos->obtenerAMontos(1);
    			$porcentaje = $montos->$por_lvl;  // Porcentaje a pagar al referido
    			
                // Se consulta el monto estandar de pago para ingresar al sistema
				$monto_pago = $perfil[0]->monto_pago;
    			
    			$pago = ($monto_pago * $porcentaje) / 100; //Cantidad a pagar al usuario

    			///////////////////////////////////////////////////////////////
                // PASO 3 (Actualizacion del perfil de cada referido padre)
                // Se arma un diccionario donde se actualizara el saldo disponible, cantida de referidos hijos y el codigo del perfil
    			$disponible = $perfil[0]->disponible + $pago; 
    			$cant_ref = $perfil[0]->cant_ref + 1;
    			$datos_ref_perfil = array(
    				'disponible'=> $disponible,
    				'codigo'=> $cod_perfil,
    				'cant_ref'=> $cant_ref,
    			);
                $result = $this->MReferidos->actualizarReferidos($datos_ref_perfil);
            }
            // PASO 4 (Verificacion para cambios de estatus del usuario)
            // Se consulta la cantidad de pagos/distribuciones realizadas
            $num_distri = $this->MRelDistribucion->obtenerDistribuciones($cod_user);
            // Si el numero de pagos por este usuario es igual a 8 (cantidad maxima)
            if (count($num_distri) >= 7){//Se procede a la actualizacion de estatus de perfil a 100%
               
                $perfil = $this->MReferidos->obtenerReferido($cod_user);
                $cod_perfil_usu = $perfil[0]->codigo; // Codigo del perfil del referido
                $datos_act_est_perfil = array(
                   'estatus'=> 4,
                   'codigo'=> $cod_perfil_usu,
               );
               $result = $this->MReferidos->actualizarReferidos($datos_act_est_perfil);
            }
            if ($nivel_ref == 1){
                ////////////////////////////////////////////////
                // PASO 6 (Notificacion del pago a tu padre referido principal)
                // Se actualiza el estatus en la tabla del padre de los links a pago
                $datos_links = array(
                    'verif_pago'=> 2,
                    'referido_id'=> $id_user,
                );
                $result = $this->MRelLinks->actualizarReferidoLinks($datos_links);
            }
        
        }else{ //Se notifica que ya fue pagado este usuario
            echo 1;
        }
    }

    
}
