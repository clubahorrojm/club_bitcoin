<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelsRelPagos
 *
 * @author Ing. Marcel Arcuri
 */
class MRelPagos extends CI_Model {
    //put your code here


    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //Metodo publico para obterner la unidad de medida
    public function obtenerBanco() {
        $query = $this->db->get('ref_rel_pagos');
        
        if($query->num_rows()>0) return $query->result();
         else return $query->result();
    }
    // //Metodo publico para obterner la unidad de medida
    // public function obtenerRelPagosOcupados() {
    //     $result = $this->db->select('banco_id');
    //     $result = $this->db->group_by('banco_id'); 
    //     $result = $this->db->get('conf_rel_RelPagos');
        
    //     if($result->num_rows()>0) return $result->result();
    //      else return $result->result();
    // }
    
    // Metodo publico, forma de insertar los datos
    public function insertarRelPagos($datos){
        $result = $this->db->where('codigo =', $datos['codigo']);
        $result = $this->db->where('usuario_id =', $datos['usuario_id']);
        $result = $this->db->get('ref_rel_pagos');

        if ($result->num_rows() > 0) {
            echo '1';
        }else{

            $result = $this->db->insert("ref_rel_pagos", $datos);
            return $result;
        }
    }
    
    // Metodo publico, para obterner la unidad de medida por id
    public function obtenerRelPagos($id){
        $this->db->where('usuario_id',$id);    
        $query = $this->db->get('ref_rel_pagos');        
        if($query->num_rows()>0) return $query->result();
        else return $query->result();
    }
    // Metodo publico, para obterner la unidad de medida por id
    public function obtenerRelPagos2($cod){
        $this->db->where('codigo',$cod);    
        $query = $this->db->get('ref_rel_pagos');        
        if($query->num_rows()>0) return $query->result();
        else return $query->result();
    }

    
   // Metodo publico, para actualizar un registro 
    public function actualizarRelPagos($datos) {

        $result = $this->db->where('codigo', $datos['codigo']);
        $result = $this->db->update('ref_rel_pagos', $datos);
        return $result;

    }

    // Metodo publico, para eliminar un registro 
    public function eliminarRelPagos($id) {
        $result = $this->db->where('banco_id', $id);
        $result = $this->db->get('conf_rel_RelPagos');
        
        if ($result->num_rows() > 0) {
            echo 'e';
        }else {
            $result = $this->db->delete('ref_rel_pagos', array('id'=>$id));
            return $result; 
        }
            
    }
}
