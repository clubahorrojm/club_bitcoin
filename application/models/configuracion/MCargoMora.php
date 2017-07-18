<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MCargoMora
 *
 * @author Ing. José Solorzano
 */
class MCargoMora extends CI_Model {
    //put your code here


    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //Metodo publico para obterner la unidad de medida
    public function obtenerCargoMora($ultimo_id) {
        $this->db->where('id',$ultimo_id);    
        $query = $this->db->get('conf_cargo_mora');        
        if($query->num_rows()>0)
            return $query->row();
        else
            return $query->row();
    }
    public function obtenerCargoMora2() {
        $query = $this->db->get('conf_cargo_mora');        
        if($query->num_rows()>0)
            return $query->result();
        else
            return $query->result();
    }
    
    // Metodo publico, forma de insertar los datos
    public function insertarCargoMora($datos){
        $result = $this->db->insert("conf_cargo_mora", $datos);
        return $result;
    }
    
   // Metodo publico, para actualizar un registro 
    public function actualizarCargoMora($datos) {
        $result = $this->db->where('id', 1);
        $result = $this->db->update('conf_cargo_mora', $datos);
        return $result;
    }
  
}
