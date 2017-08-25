<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MLRetiros
 *
 * @author Ing. José Solorzano
 */
class MLRetiros extends CI_Model {
    //put your code here


    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //Metodo público para obterner una lista de las cuentas
    public function obtenerRetiros() {
		//~ $query = $this->db->order_by('estatus asc, id asc');
        //~ $query = $this->db->get('ref_rel_retiros');
        $sql = "SELECT rrr.codigo, usu.username, monto, cftm.abreviatura, num_pago, rrr.estatus, rpf.dir_monedero, rrr.fecha_verificacion , rrr.fecha_solicitud  FROM ref_rel_retiros AS rrr ";
        $sql .= "INNER JOIN ref_perfil AS rpf ON rrr.usuario_id=rpf.usuario_id ";
        $sql .= "INNER JOIN usuarios AS usu ON rrr.usuario_id=usu.id ";
        $sql .= "INNER JOIN conf_tipos_monedas AS cftm ON rpf.t_moneda_id=cftm.id ";
        $query = $this->db->query($sql);
        if($query->num_rows()>0) return $query->result();
         else return $query->result();
    }
    
    // Método público para obtener los datos de un retiro por código
    public function obtenerRetiro($cod) {
        $this->db->where('codigo', $cod);
        $query = $this->db->get('ref_rel_retiros');
        if($query->num_rows()>0)
            return $query->result();
        else
            return false;
    }
    
    // Metodo público, para actualizar un registro 
    public function actualizarRetiro($datos) {
		$result = $this->db->where('codigo', $datos['codigo']);
		$result = $this->db->update('ref_rel_retiros', $datos);
    }
    
    // Método público para listar retiros específicos
    public function obtenerRetirosEsp($estatus,$desde,$hasta)
    {
		$query = "";
		$sql = "";
		
		// La consulta se hace dependiendo de los parámetros de búsqueda
		if($estatus != "xxx" and $desde == "xxx" and $hasta == "xxx"){
			//~ $this->db->where('usuario', $usuario);
			$sql = "SELECT * FROM ref_rel_retiros WHERE estatus=".$estatus;
		}else if($estatus != "xxx" and $desde != "xxx" and $hasta != "xxx"){
			$sql = "SELECT * FROM ref_rel_retiros WHERE estatus=".$estatus." AND fecha_solicitud BETWEEN '".$desde."' AND '".$hasta."'";
		}else if($estatus == "xxx" and $desde != "xxx" and $hasta != "xxx"){
			$sql = "SELECT * FROM ref_rel_retiros WHERE fecha_solicitud BETWEEN '".$desde."' AND '".$hasta."'";
		}
		//~ echo $sql;
		$query = $this->db->query($sql);
        //~ $query = $this->db->get('ref_rel_pagos');  No es necesario cuando se usa db->query()
        
        if ($query->num_rows() > 0)
			return $query->result();
        else
            echo '0';
    }

}

