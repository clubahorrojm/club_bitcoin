<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelsRelRetiros
 *
 * @author Ing. Marcel Arcuri
 */
class MRelRetiros extends CI_Model {
    //put your code here


    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    // Metodo publico, forma de insertar los datos
    public function insertarRelRetiros($datos){

        $result = $this->db->where('usuario_id =', $datos['usuario_id']);
        $result = $this->db->where('estatus =', 1);
        $result = $this->db->get('ref_rel_retiros');

        $result2 = $this->db->where('usuario_id =', $datos['usuario_id']);
        $result2 = $this->db->where('disponible <', $datos['monto']);
        $result2 = $this->db->get('ref_perfil');

        if ($result2->num_rows() > 0) {
            echo '1';
        }else if ($result->num_rows() > 0) {
            echo '2';
        // }else if ($result3[0]['monto_retiro_minimo'] < $datos['monto']) {
        //     echo '3';
        }else{
            $result = $this->db->insert("ref_rel_retiros", $datos);
            return $result;
        }
    }
    
    // Metodo publico, para obterner la unidad de medida por id
    public function obtenerRelRetiros($id){
        $this->db->where('usuario_id',$id);    
        $query = $this->db->get('ref_rel_retiros');        
        if($query->num_rows()>0) return $query->result();
        else return $query->result();
    }
        // Metodo publico, para obterner la unidad de medida por id
    public function obtenerPdfRetiro($id){
        $this->db->where('id',$id);    
        $query = $this->db->get('ref_rel_retiros');        
        if($query->num_rows()>0) return $query->result();
        else return $query->result();
    }

    
   // Metodo publico, para actualizar un registro 
    public function actualizarRelRetiros($datos) {

        $result = $this->db->where('codigo', $datos['codigo']);
        $result = $this->db->update('ref_rel_retiros', $datos);
        return $result;

    }

    // Metodo publico, para eliminar un registro 
    public function eliminarRelRetiros($id) {
        $result = $this->db->where('banco_id', $id);
        $result = $this->db->get('conf_rel_RelRetiros');
        
        if ($result->num_rows() > 0) {
            echo 'e';
        }else {
            $result = $this->db->delete('ref_rel_retiros', array('id'=>$id));
            return $result; 
        }
            
    }
}
