<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MCuentas
 *
 * @author Ing. José Solorzano
 */
class MLPagos extends CI_Model {
    //put your code here


    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //Metodo público para obterner una lista de las cuentas
    public function obtenerPagos() {
        //~ $result = $this->db->where('estatus !=', 99);
        //~ $query = $this->db->order_by('estatus asc, id asc');
        //~ $query = $this->db->get('ref_rel_pagos');
        $sql = "SELECT rrp.codigo, usu.username, monto, cftm.abreviatura, cfc.descripcion AS cuenta, num_pago, rrp.estatus FROM ref_rel_pagos AS rrp ";
        $sql .= "INNER JOIN ref_perfil AS rpf ON rrp.perfil_id=rpf.id ";
        $sql .= "INNER JOIN usuarios AS usu ON rrp.usuario_id=usu.id ";
        $sql .= "INNER JOIN conf_cuentas AS cfc ON rrp.cuenta_id=cfc.id ";
        $sql .= "INNER JOIN conf_tipos_monedas AS cftm ON rpf.t_moneda_id=cftm.id ";
        $query = $this->db->query($sql);
        if($query->num_rows()>0) return $query->result();
         else return $query->result();
    }

    //Metodo público para obterner una lista de las cuentas
    public function obtenerPagosBit() {
        //~ $result = $this->db->where('estatus !=', 99);
        //~ $query = $this->db->order_by('estatus asc, id asc');
        //~ $query = $this->db->get('ref_rel_pagos');
        $sql = "SELECT rrpb.codigo, usu.username, monto, cftm.abreviatura, rrpb.dir_monedero, rrpb.estatus, rrpb.fecha_pago, rrpb.hora_pago FROM ref_rel_pagos_bitcoins AS rrpb ";
        $sql .= "INNER JOIN ref_perfil AS rpf ON rrpb.perfil_id=rpf.id ";
        $sql .= "INNER JOIN usuarios AS usu ON rrpb.usuario_id=usu.id ";
        $sql .= "INNER JOIN conf_tipos_monedas AS cftm ON rpf.t_moneda_id=cftm.id ORDER BY rrpb.id DESC";
        $query = $this->db->query($sql);
        if($query->num_rows()>0) return $query->result();
         else return $query->result();
    }
    
    // Metodo público, para actualizar un registro 
    public function actualizarPago($datos) {
		$result = $this->db->where('codigo', $datos['codigo']);
		$result = $this->db->update('ref_rel_pagos', $datos);
    }
    
    // Metodo público, para actualizar un registro 
    public function actualizarPagoBit($datos) {
		$result = $this->db->where('codigo', $datos['codigo']);
		$result = $this->db->update('ref_rel_pagos_bitcoins', $datos);
    }
    
    // Método público para listar pagos específicos
    public function obtenerPagosEsp($cuenta,$estatus,$desde,$hasta)
    {
		$query = "";
		$sql = "";
		
		$condicion = " WHERE ";
		$fecha = "";
		
		$filtros = array(
		'cuenta_id' => $cuenta,
		'estatus' => $estatus);
		
		while ($filtro = current($filtros)) {
			if($filtro != 'xxx'){
				if($condicion == " WHERE "){
					$condicion .= key($filtros).'='.$filtro;
				}else{
					$condicion .= " AND ".key($filtros).'='.$filtro;
				}
			}
			
			next($filtros);
		}
		
		if($desde != "xxx" and $hasta != "xxx"){
			$fecha = " AND fecha_pago BETWEEN '".$desde."' AND '".$hasta."'";
		}
		
		$condicion .= $fecha;
		
		//~ echo "Condición: ".$condicion;
		
		$sql = "SELECT * FROM ref_rel_pagos".$condicion;
		
		//~ echo $sql;
		
		// La consulta se hace dependiendo de los parámetros de búsqueda
		//~ if($estatus != "xxx" and $desde == "xxx" and $hasta == "xxx"){
			//~ $sql = "SELECT * FROM ref_rel_pagos WHERE estatus=".$estatus;
		//~ }else if($estatus != "xxx" and $desde != "xxx" and $hasta != "xxx"){
			//~ $sql = "SELECT * FROM ref_rel_pagos WHERE estatus=".$estatus." AND fecha BETWEEN '".$desde."' AND '".$hasta."'";
		//~ }else if($estatus == "xxx" and $desde != "xxx" and $hasta != "xxx"){
			//~ $sql = "SELECT * FROM ref_rel_pagos WHERE fecha BETWEEN '".$desde."' AND '".$hasta."'";
		//~ }
		
		$query = $this->db->query($sql);
        //~ $query = $this->db->get('ref_rel_pagos');  No es necesario cuando se usa db->query()
        //~ 
        if ($query->num_rows() > 0)
			return $query->result();
        else
            echo '0';
    }
    
    // Método público para listar pagos específicos
    public function obtenerPagosEspBit($estatus,$desde,$hasta)
    {
		$query = "";
		$sql = "";
		
		$condicion = " WHERE ";
		$fecha = "";
		
		$filtros = array(
		//~ 'cuenta_id' => $cuenta,
		'estatus' => $estatus);
		
		while ($filtro = current($filtros)) {
			if($filtro != 'xxx'){
				if($condicion == " WHERE "){
					$condicion .= key($filtros).'='.$filtro;
				}else{
					$condicion .= " AND ".key($filtros).'='.$filtro;
				}
			}
			
			next($filtros);
		}
		
		if($desde != "xxx" and $hasta != "xxx"){
			$fecha = " AND fecha_pago BETWEEN '".$desde."' AND '".$hasta."'";
		}
		
		$condicion .= $fecha;
		
		//~ echo "Condición: ".$condicion;
		
		$sql = "SELECT * FROM ref_rel_pagos_bitcoins".$condicion;
		
		//~ echo $sql;
		
		// La consulta se hace dependiendo de los parámetros de búsqueda
		//~ if($estatus != "xxx" and $desde == "xxx" and $hasta == "xxx"){
			//~ $sql = "SELECT * FROM ref_rel_pagos_bitcoins WHERE estatus=".$estatus;
		//~ }else if($estatus != "xxx" and $desde != "xxx" and $hasta != "xxx"){
			//~ $sql = "SELECT * FROM ref_rel_pagos_bitcoins WHERE estatus=".$estatus." AND fecha BETWEEN '".$desde."' AND '".$hasta."'";
		//~ }else if($estatus == "xxx" and $desde != "xxx" and $hasta != "xxx"){
			//~ $sql = "SELECT * FROM ref_rel_pagos_bitcoins WHERE fecha BETWEEN '".$desde."' AND '".$hasta."'";
		//~ }
		
		$query = $this->db->query($sql);
        //~ $query = $this->db->get('ref_rel_pagos_bitcoins');  No es necesario cuando se usa db->query()
        //~ 
        if ($query->num_rows() > 0)
			return $query->result();
        else
            echo '0';
    }
    
}

