<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelsRelAyudas
 *
 * @author Ing. Marcel Arcuri
 */
class MRelAyudas extends CI_Model {
    //put your code here


    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //Metodo publico para obterner la unidad de medida
    public function obtenerBanco() {
        $query = $this->db->get('ref_rel_ayudas');
        
        if($query->num_rows()>0) return $query->result();
         else return $query->result();
    }

    
    // Metodo publico, forma de insertar los datos
    public function insertarRelAyudas($datos){
        
        $result = $this->db->insert("ref_rel_ayudas", $datos);
        return $result;
    }
    
    // Metodo publico, para obterner la unidad de medida por id
    public function obtenerRelAyudas($id){
        $sql = "SELECT codigo, motivo, pregunta, estatus, fecha_pre, operador_id,  respuesta, fecha_res ";
		$sql .= "FROM ref_rel_ayudas AS ra ";
		$sql .= " Where ra.usuario_id =".$id."";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
            return $query->result();
        else
            return $query->result();
    }
}
