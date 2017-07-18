<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelsDistribucion
 *
 * @author Ing. Marcel Arcuri
 */
class MRelDistribucion extends CI_Model {
    //put your code here


    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    // Metodo publico, forma de insertar los datos
    public function insertarDistribucion($datos){

        // $result = $this->db->where('usuario_id =', $datos['usuario_id']);
        // $result = $this->db->where('estatus =', 1);
        // $result = $this->db->get('ref_rel_distribucion');

        // $result2 = $this->db->where('usuario_id =', $datos['usuario_id']);
        // $result2 = $this->db->where('disponible <', $datos['monto']);
        // $result2 = $this->db->get('ref_perfil');

        // if ($result2->num_rows() > 0) {
        //     echo '1';
        // }else if ($result->num_rows() > 0) {
        //     echo '2';
        // }else{
        $result = $this->db->insert("ref_rel_distribucion", $datos);
        return $result;
        // }
    }
	// Metodo publico, para obterner la unidad de medida por id
    public function obtenerDistribuciones($id){
        $this->db->where('usuario_id',$id); 
        $query = $this->db->get('ref_rel_distribucion');        
        if($query->num_rows()>0) return $query->result();
        else return $query->result();
    }
    
    // Metodo publico, para obterner la unidad de medida por id
    public function obtenerDistribucion($id){
        // $this->db->where('usuario_id',$id);
		$this->db->where('referido_id',$id);  
        $query = $this->db->get('ref_rel_distribucion');        
        if($query->num_rows()>0) return $query->result();
        else return $query->result();
    }

    
   // Metodo publico, para actualizar un registro 
    public function actualizarDistribucion($datos) {

        $result = $this->db->where('codigo', $datos['codigo']);
        $result = $this->db->update('ref_rel_distribucion', $datos);
        return $result;

    }
    
    // Metodo publico alternativo, para actualizar un registro por el link completo 
    public function actualizarDistribucion2($datos) {
		
        $result = $this->db->where('links', $datos['links']);
        $result = $this->db->update('ref_rel_distribucion', $datos);
        return $result;

    }

    // Metodo publico, para eliminar un registro 
    public function eliminarDistribucion($id) {
        $result = $this->db->where('banco_id', $id);
        $result = $this->db->get('conf_rel_Distribucion');
        
        if ($result->num_rows() > 0) {
            echo 'e';
        }else {
            $result = $this->db->delete('ref_rel_distribucion', array('id'=>$id));
            return $result; 
        }
            
    }
}
