<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelsReferidos
 *
 * @author Ing. Marcel Arcuri
 */
class MReferidos extends CI_Model {
    //put your code here


    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //Método público para obterner una lista general de referidos
    public function obtenerReferidos($ultimo_id) {
        $this->db->where('id',$ultimo_id);    
        $query = $this->db->get('ref_perfil');        
        if($query->num_rows()>0)
            return $query->row();
        else
            return $query->row();
    }
    
    //Método público para obterner un referido por su id
    public function obtenerReferido($id) {
        $this->db->where('usuario_id', $id);
        $query = $this->db->get('ref_perfil');        
        if($query->num_rows()>0)
            return $query->result();
        else
            return false;
    }

    // Método público, forma de insertar los datos
    public function insertarReferidos($datos){
        $result = $this->db->insert("ref_perfil", $datos);
        return $result;
    }
    
    
   // Método público, para actualizar un registro 
    public function actualizarReferidos($datos) {
        $result = $this->db->where('codigo', $datos['codigo']);
        $result = $this->db->update('ref_perfil', $datos);
        return $result;
    }
    
}
