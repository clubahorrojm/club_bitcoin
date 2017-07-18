<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MBots
 *
 * @author Ing. José Solorzano
 */
class MBots extends CI_Model {
    //put your code here


    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //Metodo publico para obterner la unidad de medida
    public function obtenerBots() {
        $query = $this->db->get('adm_cuentas_bot');
        
        if($query->num_rows()>0) return $query->result();
         else return $query->result();
    }
    //Metodo publico para obterner la unidad de medida
    public function obtenerBancosOcupados() {
        $result = $this->db->select('banco_id');
        $result = $this->db->group_by('banco_id'); 
        $result = $this->db->get('conf_rel_bancos');
        
        if($result->num_rows()>0) return $result->result();
         else return $result->result();
    }
    
    // Metodo publico, forma de insertar los datos
    public function insertarBots($datos){
        $result = $this->db->where('moneda =', $datos['moneda']);
        $result = $this->db->where('monto_pago =', $datos['monto_pago']);
        $result = $this->db->get('adm_cuentas_bot');

        if ($result->num_rows() > 0) {
            echo '1';
        }else{
            $result = $this->db->insert("adm_cuentas_bot", $datos);
            return $result;
        }
    }  
}
