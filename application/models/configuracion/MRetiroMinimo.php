<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MRetiroMinimo
 *
 * @author Ing. José Solorzano
 */
class MRetiroMinimo extends CI_Model {
    //put your code here


    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //Metodo publico para obterner la unidad de medida
    public function obtenerRetiroMinimo($ultimo_id) {
        $this->db->where('id',$ultimo_id);    
        $query = $this->db->get('conf_retiro_minimo');        
        if($query->num_rows()>0)
            return $query->row();
        else
            return $query->row();
    }
    public function obtenerRetiroMinimo2() {
        $query = $this->db->get('conf_retiro_minimo');        
        if($query->num_rows()>0)
            return $query->result();
        else
            return $query->result();
    }
    
    // Metodo publico, forma de insertar los datos
    public function insertarRetiroMinimo($datos){
        $result = $this->db->insert("conf_retiro_minimo", $datos);
        return $result;
    }
    
   // Metodo publico, para actualizar un registro 
    public function actualizarRetiroMinimo($datos) {
        $result = $this->db->where('id', 1);
        $result = $this->db->update('conf_retiro_minimo', $datos);
        return $result;
    }
  
}
