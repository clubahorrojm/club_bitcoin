<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelsMonedero
 *
 * @author Ing. Marcel Arcuri
 */
class MMonedero extends CI_Model {
    //put your code here


    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //Metodo publico para obterner la unidad de medida
    public function obtenerMonedero($ultimo_id) {
        $this->db->where('id',$ultimo_id);    
        $query = $this->db->get('adm_monedero');        
        if($query->num_rows()>0)
            return $query->row();
        else
            return $query->row();
    }
    public function obtenerMonedero2() {
        $query = $this->db->get('adm_monedero');        
        if($query->num_rows()>0)
            return $query->result();
        else
            return $query->result();
    }
    
    // Metodo publico, forma de insertar los datos
    public function insertarMonedero($datos){
        $result = $this->db->insert("adm_monedero", $datos);
        return $result;
    }
    
    
   // Metodo publico, para actualizar un registro 
    public function actualizarMonedero($datos) {
        $result = $this->db->where('clave =', $datos['codigo']);
        $result = $this->db->get('adm_claves_sistema');
        
        //$result2 = $this->db->where('monedero =', $datos['monedero']);
        //$result2 = $this->db->get('adm_monedero');
        //print_r($result2);
        if ($result->num_rows() == 1) {
            $update = array("monedero" => $datos['monedero']);
            $result = $this->db->where('id', 1);
            $result = $this->db->update('adm_monedero', $update);
            return $result;
        }else{
            echo '1';
            
        }
        
        
    }
}
