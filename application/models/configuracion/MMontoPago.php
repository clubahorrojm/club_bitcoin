<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MMontoPago
 *
 * @author Ing. José Solorzano
 */
class MMontoPago extends CI_Model {
    //put your code here


    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //Metodo publico para obterner la unidad de medida
    public function obtenerMontoPago($ultimo_id) {
        $this->db->where('id',$ultimo_id);    
        $query = $this->db->get('conf_monto_pago');        
        if($query->num_rows()>0)
            return $query->row();
        else
            return $query->row();
    }
    public function obtenerMontoPago2() {
        $query = $this->db->get('conf_monto_pago');        
        if($query->num_rows()>0)
            return $query->result();
        else
            return $query->result();
    }
    
    // Metodo publico, forma de insertar los datos
    public function insertarMontoPago($datos){
        $result = $this->db->insert("conf_monto_pago", $datos);
        return $result;
    }
    
   // Metodo publico, para actualizar un registro 
    public function actualizarMontoPago($datos) {
        $result = $this->db->where('id', 1);
        $result = $this->db->update('conf_monto_pago', $datos);
        return $result;
    }
  
}
