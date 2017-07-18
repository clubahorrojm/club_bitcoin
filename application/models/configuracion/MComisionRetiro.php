<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MComisionRetiro
 *
 * @author Ing. José Solorzano
 */
class MComisionRetiro extends CI_Model {
    //put your code here


    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //Metodo publico para obterner la unidad de medida
    public function obtenerComisionRetiro($ultimo_id) {
        $this->db->where('id',$ultimo_id);    
        $query = $this->db->get('conf_comision_retiro');        
        if($query->num_rows()>0)
            return $query->row();
        else
            return $query->row();
    }
    public function obtenerComisionRetiro2() {
        $query = $this->db->get('conf_comision_retiro');        
        if($query->num_rows()>0)
            return $query->result();
        else
            return $query->result();
    }
    
    // Metodo publico, forma de insertar los datos
    public function insertarComisionRetiro($datos){
        $result = $this->db->insert("conf_comision_retiro", $datos);
        return $result;
    }
    
   // Metodo publico, para actualizar un registro 
    public function actualizarComisionRetiro($datos) {
        $result = $this->db->where('id', 1);
        $result = $this->db->update('conf_comision_retiro', $datos);
        return $result;
    }
 
}
