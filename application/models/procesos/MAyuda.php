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
class MAyuda extends CI_Model {
    //put your code here


    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //Metodo público para obterner una lista de las cuentas
    public function obtenerAyuda() {
        $sql = "SELECT rrpb.codigo, usu.username, rrpb.motivo, rrpb.fecha_pre, rrpb.pregunta, rrpb.estatus, usa.username operador, respuesta ";
		$sql .= "FROM ref_rel_ayudas AS rrpb ";
		$sql .= "INNER JOIN usuarios AS usu ON rrpb.usuario_id=usu.id ";
        $sql .= "INNER JOIN usuarios AS usa ON rrpb.operador_id=usa.id ";
        $query = $this->db->query($sql);
        if($query->num_rows()>0) return $query->result();
         else return $query->result();
    }
    

    
    // Metodo público, para actualizar un registro 
    public function actualizarConsulta($datos) {
		$result = $this->db->where('codigo', $datos['codigo']);
		$result = $this->db->update('ref_rel_ayudas', $datos);
    }
   
    // Método público para listar pagos específicos
    public function obtenerPagosEspBit($cuenta,$estatus,$desde,$hasta)
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
		
		$sql = "SELECT * FROM ref_rel_ayudas".$condicion;
		
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

