<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CLDesvincular
 *
 * @author Ing. José Solorzano
 */
class CLDesvincular extends CI_Controller
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
		$this->load->model('procesos/MLDesvincular');
        $this->load->model('configuracion/usuarios/Usuarios_model');
        $this->load->model('busquedas_ajax/ModelsBusqueda');
        $this->load->model('administracion/MAuditoria');
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

    public function index()
    {
        $this->load->view('base');
        $perfiles = $this->MLDesvincular->obtenerPerfilesIniciados();  // Obtenemos los perfiles en estatus 1, 2 y 3.
        
        $perfiles_inactivos = array();  // Preparamos el contenedor de los perfiles a mostrar
        
        //~ print_r($perfiles_inactivos);
        
        foreach ($perfiles as $perfil) {
			
			$tiempo = $this->tiempo_registro($perfil->fecha);  // Con esta línea calculamos el tiempo del registro
			$tiempo = explode('-',$tiempo);
			$anyos = explode(' ',$tiempo[0]);  // Años del registro
			$meses = explode(' ',$tiempo[1]);  // Meses del registro
			$dias = explode(' ',$tiempo[2]);  // Días del registro
			
			// Incluimos el perfil en la nueva lista sólo si tiene más de 15 días de inactividad luego de registrado
			if($anyos[0] > 0 || $meses[0] > 0 || $dias[0] > 15){
				//~ echo "Cumplió el plazo";
				$perfiles_inactivos[] = $perfil;
			}
		}
		
		//~ print_r($perfiles_inactivos);
        
        $data['perfiles'] = $perfiles_inactivos;  // Perfiles inactivos durante más de 15 días
        
        $this->load->view('procesos/desvinculacion/lista',$data);
    }
    
    //metodo para desvincular el usuario del link asociado, además de desactivar el perfil y el pago asociados a él.
    public function desvincular_usuario($id)
    {
		// Capturamos los datos básicos del usuario a desvincular para guardarlos en una tabla de resplados
		$datos_usuario = $this->ModelsBusqueda->obtenerRegistro('usuarios', 'id', $id);
		$datos_perfil = $this->ModelsBusqueda->obtenerRegistro('ref_perfil', 'usuario_id', $id);
		$datos_pago = $this->ModelsBusqueda->obtenerRegistro('ref_rel_pagos', 'usuario_id', $id);
		
		// Actualizamos el pago asociado al usuario
		$data_pago = array(
			'estatus' => 0,
        );
        
        $update_pago = $this->MLDesvincular->actualizarPago($id,$data_pago);
		if ($update_pago) {
			$param = array(
				'tabla' => 'ref_rel_pagos',
				'codigo' => $id,
				'accion' => 'Desvinculación de Pago',
				'fecha' => date('Y-m-d'),
				'hora' => date("h:i:s a"),
				'usuario' => $this->session->userdata['logged_in']['id'],
			);
			$this->MAuditoria->add($param);
		}
		
		// Actualizamos el link asociado al usuario
		$data_link = array(
			'referido_id' => null,
        );
        
        $update_link = $this->MLDesvincular->actualizarLink($id,$data_link);
        if ($update_link) {
			$param = array(
				'tabla' => 'ref_rel_links',
				'codigo' => $id,
				'accion' => 'Desvinculación de Link',
				'fecha' => date('Y-m-d'),
				'hora' => date("h:i:s a"),
				'usuario' => $this->session->userdata['logged_in']['id'],
			);
			$this->MAuditoria->add($param);
		}
		
		// Actualizamos el perfil asociado al usuario
		$data_perfil = array(
			'estatus' => 0,
        );
        
        $update_perfil = $this->MLDesvincular->actualizarPerfil($id,$data_perfil);
		if ($update_perfil) {
			$param = array(
				'tabla' => 'ref_perfil',
				'codigo' => $id,
				'accion' => 'Desvinculación de Perfil',
				'fecha' => date('Y-m-d'),
				'hora' => date("h:i:s a"),
				'usuario' => $this->session->userdata['logged_in']['id'],
			);
			$this->MAuditoria->add($param);
		}
		 
		// Desactivar el usuario
        $data_usuario = array(
			'estatus' => False,
        );
        
        $update_usuario = $this->Usuarios_model->actualizar($id,$data_usuario);
        if ($update_usuario) {
			$param = array(
				'tabla' => 'Usuario',
				'codigo' => $id,
				'accion' => 'Desvinculación de Usuario',
				'fecha' => date('Y-m-d'),
				'hora' => date("h:i:s a"),
				'usuario' => $this->session->userdata['logged_in']['id'],
			);
			$this->MAuditoria->add($param);
		}
		
		// Registramos el usuario desvinculado
		$ultimo_id_desvinculado = $this->ModelsBusqueda->count_all_table('usuarios_desvinculados');
		
		$data_usu = array(
			'id' => $ultimo_id_desvinculado + 1,
            'usuario' => $datos_usuario->username,
            'operador_id' => $this->session->userdata['logged_in']['codigo'],
            'fecha_desvinculacion' => date('Y-m-d H:i:s'),
            'estatus_perfil' => $datos_perfil->estatus,
            'estatus_pago' => $datos_pago->estatus,
        );
        
        $guardar_usu = $this->MLDesvincular->guardarDesvinculado($data_usu);
        if ($guardar_usu) {
			$param = array(
				'tabla' => 'Usuarios Desvinculados',
				'codigo' => $id,
				'accion' => 'Registro de Nuevo Usuario Desvinculado',
				'fecha' => date('Y-m-d'),
				'hora' => date("h:i:s a"),
				'usuario' => $this->session->userdata['logged_in']['id'],
			);
			$this->MAuditoria->add($param);
		}
		
		
    }
    
    //metodo para eliminar el usuario y el perfil asociado, además de eliminar el pago asociados a él.
    public function eliminar_usuario($id)
    {
		// Capturamos los datos básicos del usuario a eliminar para guardarlos en una tabla de resplados
		$datos_usuario = $this->ModelsBusqueda->obtenerRegistro('usuarios', 'id', $id);
		
		// Eliminamos el pago asociado al usuario
		$delete_pago = $this->MLDesvincular->eliminarPago($id);
		if ($delete_pago) {
			$param = array(
				'tabla' => 'ref_rel_pagos',
				'codigo' => $id,
				'accion' => 'Eliminación de Pago',
				'fecha' => date('Y-m-d'),
				'hora' => date("h:i:s a"),
				'usuario' => $this->session->userdata['logged_in']['id'],
			);
			$this->MAuditoria->add($param);
		}
		
		// Eliminamos el perfil asociado al usuario
		$delete_perfil = $this->MLDesvincular->eliminarPerfil($id);
		if ($delete_perfil) {
			$param = array(
				'tabla' => 'ref_perfil',
				'codigo' => $id,
				'accion' => 'Eliminación de Perfil',
				'fecha' => date('Y-m-d'),
				'hora' => date("h:i:s a"),
				'usuario' => $this->session->userdata['logged_in']['id'],
			);
			$this->MAuditoria->add($param);
		}
		 
		// Eliminamos el usuario
        $delete_usuario = $this->Usuarios_model->eliminar($id);
        if ($delete_usuario) {
			$param = array(
				'tabla' => 'Usuario',
				'codigo' => $id,
				'accion' => 'Eliminación de Usuario',
				'fecha' => date('Y-m-d'),
				'hora' => date("h:i:s a"),
				'usuario' => $this->session->userdata['logged_in']['id'],
			);
			$this->MAuditoria->add($param);
		}
		
		// Registramos el usuario eliminado
		$ultimo_id_eliminado = $this->ModelsBusqueda->count_all_table('usuarios_eliminados');
		
		$data_usu = array(
			'id' => $ultimo_id_eliminado + 1,
            'usuario' => $datos_usuario->username,
            'operador_id' => $this->session->userdata['logged_in']['codigo'],
            'fecha_eliminacion' => date('Y-m-d H:i:s'),
        );
        
        $guardar_usu = $this->MLDesvincular->guardarEliminado($data_usu);
        if ($guardar_usu) {
			$param = array(
				'tabla' => 'Usuarios Eliminados',
				'codigo' => $id,
				'accion' => 'Registro de Nuevo Usuario Eliminado',
				'fecha' => date('Y-m-d'),
				'hora' => date("h:i:s a"),
				'usuario' => $this->session->userdata['logged_in']['id'],
			);
			$this->MAuditoria->add($param);
		}
		
		
    }
    
    // Método para listar los links disponibles para re-vinculación de un usuario dado
    public function links_disponibles($id_usu)
    {
		$result = $this->MLDesvincular->linksDisponibles($id_usu);
		echo json_encode($result);
	}
    
    // Método para desvincular el usuario del link asociado, además de desactivar el perfil y el pago asociados a él.
    public function revincular_usuario($id_usu,$id_link)
    {
		// Capturamos los datos básicos del usuario a re-vincular para guardarlos en una tabla de resplados
		$datos_usuario = $this->ModelsBusqueda->obtenerRegistro('usuarios', 'id', $id_usu);
		$estatus_anterior = $this->MLDesvincular->buscarDesvinculado($datos_usuario->username);
		
		print_r($estatus_anterior);
		
		// Actualizamos el pago asociado al usuario
		$data_pago = array(
			'estatus' => $estatus_anterior[0]->estatus_pago,
        );
        
        $update_pago = $this->MLDesvincular->actualizarPago($id_usu,$data_pago);
		if ($update_pago) {
			$param = array(
				'tabla' => 'ref_rel_pagos',
				'codigo' => $id,
				'accion' => 'Re-vinculación de Pago',
				'fecha' => date('Y-m-d'),
				'hora' => date("h:i:s a"),
				'usuario' => $this->session->userdata['logged_in']['id'],
			);
			$this->MAuditoria->add($param);
		}
		
		// Actualizamos el link asociado al usuario
		$data_link = array(
			'referido_id' => $id_usu,
        );
        
        $update_link = $this->MLDesvincular->vincularLink($id_link,$data_link);
        if ($update_link) {
			$param = array(
				'tabla' => 'ref_rel_links',
				'codigo' => $id,
				'accion' => 'Re-vinculación de Link',
				'fecha' => date('Y-m-d'),
				'hora' => date("h:i:s a"),
				'usuario' => $this->session->userdata['logged_in']['id'],
			);
			$this->MAuditoria->add($param);
		}
		
		// Actualizamos el perfil asociado al usuario
		$data_perfil = array(
			'estatus' => $estatus_anterior[0]->estatus_perfil,
        );
        
        $update_perfil = $this->MLDesvincular->actualizarPerfil($id_usu,$data_perfil);
		if ($update_perfil) {
			$param = array(
				'tabla' => 'ref_perfil',
				'codigo' => $id,
				'accion' => 'Activación de Perfil',
				'fecha' => date('Y-m-d'),
				'hora' => date("h:i:s a"),
				'usuario' => $this->session->userdata['logged_in']['id'],
			);
			$this->MAuditoria->add($param);
		}
		 
		// Activar el usuario
        $data_usuario = array(
			'estatus' => True,
        );
        
        $update_usuario = $this->Usuarios_model->actualizar($id_usu,$data_usuario);
        if ($update_usuario) {
			$param = array(
				'tabla' => 'Usuario',
				'codigo' => $id,
				'accion' => 'Activación de Usuario',
				'fecha' => date('Y-m-d'),
				'hora' => date("h:i:s a"),
				'usuario' => $this->session->userdata['logged_in']['id'],
			);
			$this->MAuditoria->add($param);
		}
		
		// Registramos el usuario vinculado
		$ultimo_id_vinculado = $this->ModelsBusqueda->count_all_table('usuarios_revinculados');
		
		$data_usu = array(
			'id' => $ultimo_id_vinculado + 1,
            'usuario' => $datos_usuario->username,
            'operador_id' => $this->session->userdata['logged_in']['codigo'],
            'fecha_revinculacion' => date('Y-m-d H:i:s'),
        );
        
        $guardar_usu = $this->MLDesvincular->guardarRevinculado($data_usu);
        if ($guardar_usu) {
			$param = array(
				'tabla' => 'Usuarios Re-activado',
				'codigo' => $id,
				'accion' => 'Registro de Nuevo Usuario Re-activado',
				'fecha' => date('Y-m-d'),
				'hora' => date("h:i:s a"),
				'usuario' => $this->session->userdata['logged_in']['id'],
			);
			$this->MAuditoria->add($param);
		}
		
		
    }
    
}

