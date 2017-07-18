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

Class Login_Database extends CI_Model {



// Read data using username and password
    public function login($data) {

        $condition = "username =" . "'" . $data['username'] . "' AND " . "password =" . "'" . $data['password'] . "' AND " . "estatus = 't'";
        $this->db->select('*');
        $this->db->from('usuarios');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

// Read data from database to show data in admin page
    public function read_user_information($username) {

        $condition = "username =" . "'" . $username . "'";
        $this->db->select('*');
        $this->db->from('usuarios');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    public function obtenerUsuarios() {
        $query = $this->db->get('usuarios');
        
        if($query->num_rows()>0) return $query;
        else return false;
    }
    
    public function obtenerUsuario($id){
        $this->db->where('id',$id);    
        $query = $this->db->get('usuarios');        
        if($query->num_rows()>0) return $query;
        else return false;
    }
    
    public function actualizarUsuario($id,$data) {
        $datos = array(
            'username' => $data['username'],
            'email' => $data['email'],
            'cedula' => $data['cedula'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'fecha_update' => $data['fecha_update']
            
        );
        $this->db->where('id',$id);
        $query= $this->db->update('usuarios', $datos);
        
    }
    
    public function actualizarPasswd($id, $passwd){
		$datos = array(
			'password' => $passwd,
			//~ 'change_id' => 0,
		);

        $result = $this->db->where('id', $id);
        $result = $this->db->update('usuarios', $datos);
        return $result;
    }
    
    public function eliminarUsuario($id) {
        $this->db->delete('usuarios', array('id'=>$id));
    }
    
    // Método público para obtener datos de un usuario por su nombre
    public function obtenerUsuarioName($username){
        $this->db->where('username',$username);    
        $query = $this->db->get('usuarios');        
        return $query->row();
    }
    
    // Método público para obtener datos de la clave maestra
    public function obtenerClave($clave){
        $this->db->where('clave',$clave);    
        $query = $this->db->get('adm_claves_sistema');        
        return $query->row();
    }

}
?>

