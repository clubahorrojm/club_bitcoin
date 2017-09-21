<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuarios_model
 *
 * @author Ing. Francis Medina
 */
Class Usuarios_model extends CI_Model {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->tableName = 'users';
        $this->primaryKey = 'id';
    }

    // Metodo publico, forma de insertar los datos
    public function insertar($codigo_seg, $datos) {
		//echo $codigo_seg;
		$result = $this->db->where('clave =', $codigo_seg);
        $result = $this->db->get('adm_claves_sistema');
		if ($result->num_rows() == 1) {
			$result = $this->db->where('username =', $datos['username']);
			$result = $this->db->get('usuarios');
			if ($result->num_rows() > 0) {
				echo '2';
			} else {
				$result = $this->db->insert("usuarios", $datos);
				return $result;
			}
		}else{
            echo '1';  
        } 
    }
	// Metodo publico, forma de insertar los datos
    public function insertar2($datos) {
		//echo $codigo_seg;
		$result = $this->db->where('username =', $datos['username']);
		$result = $this->db->get('usuarios');
		if ($result->num_rows() > 0) {
			echo '2';
		} else {
			$result = $this->db->insert("usuarios", $datos);
			return $result;
		}
    }

    public function insert($data = array()) {
        if (!array_key_exists("created", $data)) {
            $data['created'] = date("Y-m-d H:i:s");
        }
        if (!array_key_exists("modified", $data)) {
            $data['modified'] = date("Y-m-d H:i:s");
        }
        $insert = $this->db->insert($this->tableName, $data);
        if ($insert) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
    
    // Método público, forma de insertar los datos de perfil
    public function insertar_perfil($datos)
    {
		$result = $this->db->insert("ref_perfil", $datos);
		//~ return $result;
    }

    public function obtenerUsuarios() {
        $query = $this->db->get('usuarios');

        if ($query->num_rows() > 0)
            return $query->result();
        else
            return $query->result();
    }

    public function obtenerUsuario($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('usuarios');
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return false;
    }

    public function actualizar($codigo_seg, $id, $datos) {
		$result = $this->db->where('clave =', $codigo_seg);
        $result = $this->db->get('adm_claves_sistema');
		if ($result->num_rows() == 1) {
			$result = $this->db->where('username =', $datos['username']);
			$result = $this->db->where('id !=', $datos['id']);
			$result = $this->db->get('usuarios');
			
			if ($result->num_rows() > 0) {
				echo '2';
			}else {
				$result = $this->db->where('id', $datos['id']);
				$result = $this->db->update('usuarios', $datos);
				return $result;
			}
		}else{
            echo '1';  
        }
    }

    public function eliminar($id) {
        $this->db->delete('usuarios', array('id' => $id));
    }
    
    // Metodo publico, forma de insertar los datos de coordenadas
    public function insertarCoord($datos)
    {
		$result = $this->db->insert("usuarios_ubicacion", $datos);
		return $result;
    }

}


