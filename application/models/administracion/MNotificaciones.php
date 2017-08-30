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
class MNotificaciones extends CI_Model
{
    //put your code here}
    private $table = NULL;
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->table= 'notificaciones';
    }
    
	// Metodo publico, para obterner la unidad de medida por id
    public function obtener_user_id_ayuda($cod_ayuda){
        $sql = "SELECT usuario_id FROM ref_rel_ayudas Where codigo =".$cod_ayuda;
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
            return $query->result();
        else
            return $query->result();
    }
	
	// Metodo publico, para obterner la unidad de medida por id
    public function obtener_user_id_retiro($cod_ayuda){
        $sql = "SELECT usuario_id FROM ref_rel_retiros Where codigo =".$cod_ayuda;
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
            return $query->result();
        else
            return $query->result();
    }
	

	
	// Metodo publico, forma de insertar los datos
    public function insertarNotificacion($datos){
        $result = $this->db->insert("notificaciones", $datos);
        return $result;
    }
    
}
