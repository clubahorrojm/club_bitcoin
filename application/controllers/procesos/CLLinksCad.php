<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CLLinksCad
 *
 * @author Ing. José Solorzano
 */
class CLLinksCad extends CI_Controller
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
		$this->load->model('procesos/MLLinksCad');
        $this->load->model('configuracion/usuarios/Usuarios_model');
        $this->load->model('busquedas_ajax/ModelsBusqueda');
        $this->load->model('administracion/MAuditoria');
		$this->load->model('administracion/MBots');
		$this->load->model('referidos/MRelLinks');
		$this->load->model('referidos/MReferidos');
    }
	    // Método estático para el cálculo del tiempo transcurrido entre una fecha fecha dada y la fecha actual
    public function tiempo_registro($fecha)
    {
        $fecha          = explode('-', $fecha);
        $fecha_actual   = date('Y-m-d');
        $fecha_actual   = explode('-', $fecha_actual);
        // Variable de fecha capturada
        $ano            = $fecha[0];
        $mes            = $fecha[1];
        $dia            = $fecha[2];
        // Variable de fecha actual
        $ano_actual     = $fecha_actual[0];
        $mes_actual     = $fecha_actual[1];
        $dia_actual     = $fecha_actual[2];
        // Diferencia de fechas
        $dia_diferencia = $dia_actual - $dia;
        $mes_diferencia = $mes_actual - $mes;
        $ano_diferencia = $ano_actual - $ano;

        # se suma dia_diferencia los dias que tiene el mes anterior de la fecha actual
        if ($dia_diferencia < 0) {
            $mes_diferencia = $mes_diferencia - 1;
            if ($mes_actual) {
                if ($mes_actual == 1 or $mes_actual == 3 or $mes_actual == 5 or $mes_actual == 7 or $mes_actual == 8 or $mes_actual == 10 or $mes_actual == 12) {
                    $dias_mes_anterior = 31;
                } else if ($mes_actual == 2) { # calculo si un año es bisiesto
                    if (((($ano_actual % 100) != 0) and ( ($ano_actual % 4) == 0)) or ( ($ano_actual % 400) == 0)) {
                        echo 'El año es Bisiesto';
                        $dias_mes_anterior = 29;
                    } else {
                        echo 'El año no es Bisiesto';
                        $dias_mes_anterior = 28;
                    }
                } else if ($mes_actual == 4 or $mes_actual == 6 or $mes_actual == 9 or $mes_actual == 11) {
                    $dias_mes_anterior = 30;
                }
                $dia_diferencia = $dia_diferencia + $dias_mes_anterior;
            }
        }if ($mes_diferencia < 0) {
            $ano_diferencia = $ano_diferencia - 1;
            $mes_diferencia = $mes_diferencia + 12;
            # Se valida si cumple un año se muestre año si es mayor de un año se muestre años
        }if ($ano_diferencia < 2) {
            $ano_diferencia = $ano_diferencia . " Año";
        } else if ($ano_diferencia > 1) {
            $ano_diferencia = $ano_diferencia . " Años";
        }if ($mes_diferencia < 2) {
            $mes_diferencia = $mes_diferencia . " Mes";
        } else if ($mes_diferencia > 1) {
            $mes_diferencia = $mes_diferencia . " Meses";
        }if ($dia_diferencia < 2) {
            $dia_diferencia = $dia_diferencia . " Dia";
        } else if ($dia_diferencia > 1) {
            $dia_diferencia = $dia_diferencia . " Dias";
        }
        //~ $time_reg = str_replace("-", "", $ano_diferencia) . " " . $mes_diferencia . " " . $dia_diferencia;  // Tiempo del registro
        //echo "TIEMPO DE SERVICIO: ".$time_service;
        $time_reg = $ano_diferencia . "-" . $mes_diferencia . "-" . $dia_diferencia;  // Tiempo del registro
        return $time_reg;
    }
    function index()
    {
        $this->load->view('base');
		$links_dispo = $this->MRelLinks->obtenerLinksDisp();  // Obtenemos los perfiles en estatus 1, 2 y 3.
        
        //~ $perfiles_inactivos = array();  // Preparamos el contenedor de los perfiles a mostrar
		//~ foreach ($links_dispo as $links) {
			//~ 
			//~ $tiempo = $this->tiempo_registro($links->fecha);  // Con esta línea calculamos el tiempo del registro
			//~ $tiempo = explode('-',$tiempo);
			//~ $anyos = explode(' ',$tiempo[0]);  // Años del registro
			//~ $meses = explode(' ',$tiempo[1]);  // Meses del registro
			//~ $dias = explode(' ',$tiempo[2]);  // Días del registro
			//~ 
			//~ //Incluimos el perfil en la nueva lista sólo si tiene más de 15 días de inactividad luego de registrado
			//~ if($anyos[0] > 0 || $meses[0] > 0 || $dias[0] > 8){
			//~ 
				//~ $usuario = $links->usuario_id;
				//~ $id_link = $links->codigo;
				//~ $perfil = $this->ModelsBusqueda->obtenerRegistro('ref_perfil', 'usuario_id', $usuario);
				//~ 
				//~ $disponible = $perfil->disponible - $perfil->cargo_mora;
				//~ $datos = array(
					//~ 'codigo' => $perfil->codigo,
					//~ 'disponible' => $disponible,
				//~ );
				//~ $result = $this->MReferidos->actualizarReferidos($datos);
				//~ 
				//~ $datos2 = array(
					//~ 'codigo' => $id_link,
					//~ 'estatus' => 3,
				//~ );
				//~ $result = $this->MRelLinks->actualizarRelLinks($datos2);
				//~ 
				//~ //$result = $this->MRelPagos->insertarRelPagos($datos);
				//~ //$perfiles_inactivos[] = $links;
				//~ //MBots
			//~ }
		//~ }
        //~ $data['listar'] = $this->MLLinksCad->obtenerLinksCad();
        $data['listar'] = $links_dispo;
        $data['listar_usuarios'] = $this->Usuarios_model->obtenerUsuarios();
        $this->load->view('procesos/links_cad/lista2', $data);
    }
    
    //~ // Método para validar el pago
    //~ function validar($cod){
        //~ // Armamos la data a actualizar
        //~ $data = array(
            //~ 'codigo' => $cod,
            //~ 'estatus' => 2,
            //~ 'operador_id' => $this->session->userdata['logged_in']['codigo'],
            //~ 'fecha_verificacion' => date('Y-m-d'),
        //~ );
        //~ // Actualizamos el pago con los datos armados
        //~ $result = $this->MLPagos->actualizarPago($data);
        //~ $data['pagos'] = $this->MRelPagos->obtenerRelPagos2($cod);
        //~ $id_pefil = $data['pagos'][0]->perfil_id;
        //~ $datos2 = array(
            //~ 'codigo'=> $id_pefil,
            //~ 'estatus'=> 2,
        //~ );
        //~ // print_r($datos2);
        //~ $result = $this->MReferidos->actualizarReferidos($datos2);
    //~ }
}

