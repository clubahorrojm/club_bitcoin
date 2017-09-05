<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelStandard
 *
 * @author jesus
 */
class MRelNivel extends CI_Model
{
    //put your code here}
    private $table = NULL;
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->table= 'notificaciones';
    }
    public function insertarRelNivel($datos){

        $result = $this->db->insert("ref_rel_nivel", $datos);
        return $result;
        // }
    }
	// Metodo publico, para el tiempo que tardo un usuario en lograr nuevo nivel
    public function obtener_dias_nivel($cod_user, $fecha){
        $sql = "SELECT date_part('DAY', TIMESTAMP '".$fecha."' - fecha::date) AS dias FROM ref_rel_nivel WHERE usuario_id = ".$cod_user." ORDER BY id ASC LIMIT 1";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
            return $query->result();
        else
            return $query->result();
    }
	// Metodo publico, para obterner la lista de niveles alcanzados hasta el momento
    public function obtener_grafica_tiempo_niveles($cod_user){
		
        $sql2 = "SELECT nivel, tiempo FROM ref_rel_nivel WHERE usuario_id = ".$cod_user." AND nivel!= 0 ORDER BY nivel";
        $query2 = $this->db->query($sql2);
        if($query2->num_rows()>0)
            return $query2->result();
        else
            return $query2->result();
    }
    
}
