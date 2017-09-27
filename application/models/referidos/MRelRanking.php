<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelsRelAyudas
 *
 * @author Ing. Marcel Arcuri
 */
class MRelRanking extends CI_Model {
    //put your code here


    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    
    // Metodo publico, para obterner el top 100 de Usuarios con mayor cantidad de ingresos disponibles
    public function obtenerTopCantDisp(){
        $sql = "SELECT id, codigo, usuario_id, disponible, nivel ";
		$sql .= "FROM ref_perfil WHERE estatus >= 4 AND usuario_id = (SELECT id FROM usuarios WHERE tipo_usuario = '3')";
		$sql .= " ORDER BY disponible DESC LIMIT 100";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
            return $query->result();
        else
            return $query->result();
    }
    // Metodo publico, para obterner el top 100 de Usuarios con mayor cantidad de referidos
    public function obtenerTopCantRef(){
        $sql = "SELECT id, codigo, usuario_id, cant_ref, nivel ";
        $sql .= "FROM ref_perfil WHERE estatus >= 4";
        $sql .= " ORDER BY cant_ref DESC LIMIT 100";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
            return $query->result();
        else
            return $query->result();
    }
}

  
