<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelsGruposUsuarios
 *
 * @author Ing. Francis Medina
 */
class ModelsGruposUsuarios extends CI_Model {
    //put your code here


    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //Metodo publico para obterner la unidad de medida
    public function obtenerGrupoUsuario() {
        $query = $this->db->get('conf_grupo_user');
        
        if($query->num_rows()>0) return $query->result();
         else return $query->result();
    }
    
    // Metodo publico, forma de insertar los datos
    public function insertar($datos){
        $result = $this->db->where('name =', $datos['name']);
        $result = $this->db->get('conf_grupo_user');
        if ($result->num_rows() > 0) {
            echo '1';
        }
        else {
            $result = $this->db->insert("conf_grupo_user", $datos);
            return $result;
        }
    }
    
    // Metodo publico, para obterner la unidad de medida por id
    public function obtenerGrupoUsuarios($id){
        $this->db->where('codigo',$id);    
        $query = $this->db->get('conf_grupo_user');        
        if($query->num_rows()>0) return $query->result();
        else return $query->result();
    }
    
   // Metodo publico, para actualizar un registro 
    public function actualizar($datos) {
        $result = $this->db->where('name =', $datos['name']);
        $result = $this->db->where('id !=', $datos['id']);
        $result = $this->db->get('conf_grupo_user');
        
        if ($result->num_rows() > 0) {
            echo '1';
        }
        else {
            $result = $this->db->where('id', $datos['id']);
            $result = $this->db->update('conf_grupo_user', $datos);
            return $result;
        }
    }
    
    public function actualizarEstatus($id, $datos) {

        $result = $this->db->where('id', $id);
        $result = $this->db->update('conf_grupo_user', $datos);
        return $result;
    }

    // Metodo publico, para eliminar un registro 
    public function eliminar($id) {

 	$result = $this->db->where('tipo_usuario =', $id);
        $result = $this->db->get('usuarios');

        echo print_r($result);
        return true;

        if ($result->num_rows() > 0) {
            #echo "CORRECTO";
            echo 'existe';
        } else {

            $result = $this->db->delete('conf_grupo_user', array('id'=>$id));
            return $result;
 

        }
        
            $result = $this->db->delete('conf_grupo_user', array('id'=>$id));
            return $result;
        
    }
    
    
}
