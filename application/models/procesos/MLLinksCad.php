<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MLLinksCad
 *
 * @author Ing. José Solorzano
 */
class MLLinksCad extends CI_Model {
    //put your code here


    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //Metodo público para obterner una lista de los links vencidos
    public function obtenerLinksCad() {
		
        $result = $this->db->where('estatus=', 3);
        $query = $this->db->get('ref_rel_links');
        
        if($query->num_rows()>0) return $query->result();
         else return $query->result();
    }
    
    // Metodo público, para actualizar un registro 
    public function actualizarPago($datos) {
		$result = $this->db->where('codigo', $datos['codigo']);
		$result = $this->db->update('ref_rel_pagos', $datos);
    }
    
}

