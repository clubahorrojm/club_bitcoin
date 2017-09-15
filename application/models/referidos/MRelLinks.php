<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelsRelLinks
 *
 * @author Ing. Marcel Arcuri
 */
class MRelLinks extends CI_Model {
    //put your code here


    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //Metodo publico para obterner la unidad de medida
    public function obtenerLinks() {
        $query = $this->db->get('ref_rel_links');
        
        if($query->num_rows()>0) return $query->result();
         else return $query->result();
    }

    
    // Metodo publico, forma de insertar los datos
    public function insertarRelLinks($datos){

        $result = $this->db->insert("ref_rel_links", $datos);
        return $result;
        // }
    }
    
    // Metodo publico, para obterner la unidad de medida por id
    public function obtenerRelLinks($id){
		$sql_select = "SELECT count(links) as total FROM ref_rel_links WHERE usuario_id=".$id." AND estatus = 1";
        $query3 = $this->db->query($sql_select);
		return $query3->result(); 
    }
	    // Metodo publico, para obterner la unidad de medida por id
    public function obtenerDisRelLink($id){
        $this->db->where('usuario_id',$id);    
        $query = $this->db->get('ref_rel_links');        
        if($query->num_rows()>0) return $query->result();
        else return $query->result();
    }

    
   // Metodo publico, para actualizar un registro 
    public function actualizarRelLinks($datos) {

        $result = $this->db->where('codigo', $datos['codigo']);
        $result = $this->db->update('ref_rel_links', $datos);
        return $result;

    }
    
    // Metodo publico alternativo, para actualizar un registro por el link completo 
    public function actualizarRelLinks2($datos) {
		
        $result = $this->db->where('links', $datos['links']);
        $result = $this->db->update('ref_rel_links', $datos);
        return $result;

    }
       // Metodo publico, para actualizar un registro 
    public function actualizarReferidoLinks($datos) {

        $result = $this->db->where('referido_id', $datos['referido_id']);
        $result = $this->db->update('ref_rel_links', $datos);
        return $result;

    }
        // Metodo publico, para obterner la unidad de medida por id
    public function obtenerCantRelLinks(){
        
        $sql_select = "SELECT usuario_id, count(usuario_id) cantidad FROM ref_rel_links WHERE estatus = 2 GROUP BY usuario_id";
        $query3 = $this->db->query($sql_select);
        return $query3->result(); 
    }
        // Metodo publico, para obterner la unidad de medida por id
    public function obtenerLinksDisp(){
        
        $sql_select = "SELECT id, codigo, usuario_id, links, fecha FROM ref_rel_links WHERE estatus = 1";
        $query3 = $this->db->query($sql_select);
        return $query3->result(); 
    }

}
