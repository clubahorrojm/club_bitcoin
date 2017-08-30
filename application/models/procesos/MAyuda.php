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
        $sql = "SELECT codigo, usuario_id, motivo, fecha_pre, pregunta, estatus, operador_id, respuesta ";
		$sql .= "FROM ref_rel_ayudas ORDER BY estatus ";
        $query = $this->db->query($sql);
        if($query->num_rows()>0) return $query->result();
         else return $query->result();
    }
    

    
    // Metodo público, para actualizar un registro 
    public function actualizarConsulta($datos) {
		$result = $this->db->where('codigo', $datos['codigo']);
		$result = $this->db->update('ref_rel_ayudas', $datos);
    }
    
}

