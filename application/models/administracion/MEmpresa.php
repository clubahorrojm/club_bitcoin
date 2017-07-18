<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelsEmpresa
 *
 * @author Ing. Marcel Arcuri
 */
class MEmpresa extends CI_Model {
    //put your code here


    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //Metodo publico para obterner la unidad de medida
    public function obtenerEmpresa($ultimo_id) {
        $this->db->where('id',$ultimo_id);    
        $query = $this->db->get('adm_empresa');        
        if($query->num_rows()>0)
            return $query->row();
        else
            return $query->row();
    }
    public function obtenerEmpresa2() {
        $query = $this->db->get('adm_empresa');        
        if($query->num_rows()>0)
            return $query->result();
        else
            return $query->result();
    }
    
    // Metodo publico, forma de insertar los datos
    public function insertarEmpresa($datos){
        $result = $this->db->insert("adm_empresa", $datos);
        return $result;
    }
    
    // Metodo publico, para obterner la unidad de medida por id
    public function obtenerCopropietario($id){
        $this->db->where('id',$id);    
        $query = $this->db->get('adm_empresa');        
        if($query->num_rows()>0) return $query->result();
        else return $query->result();
    }
    
   // Metodo publico, para actualizar un registro 
    public function actualizarEmpresa($datos) {
        $result = $this->db->where('id', 1);
        $result = $this->db->update('adm_empresa', $datos);
        return $result;
    }

    // Metodo publico, para eliminar un registro 
    public function eliminarEmpresa($id) {
            $result = $this->db->delete('adm_empresa', array('id'=>$id));
            return $result; 
    }   
}
