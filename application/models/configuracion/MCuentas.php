<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MCuentas
 *
 * @author Ing. José Solorzano
 */
class MCuentas extends CI_Model {
    //put your code here


    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //Metodo público para obterner una lista de las cuentas
    public function obtenerCuentas() {
        $query = $this->db->get('conf_cuentas');
        
        if($query->num_rows()>0) return $query->result();
         else return $query->result();
    }
    
    // Metodo público, forma de insertar los datos
    public function insertarCuenta($datos){
        $result = $this->db->where('codigo =', $datos['codigo']);
        $result = $this->db->get('conf_cuentas');
        
        $result2 = $this->db->where('descripcion =', $datos['descripcion']);
        $result2 = $this->db->get('conf_cuentas');

        if ($result->num_rows() > 0) {
            echo '1';
        }else if ($result2->num_rows() > 0) {
            echo '2';
        }else{
            $result = $this->db->insert("conf_cuentas", $datos);
            return $result;
        }
    }
    
    // Metodo público, para obterner una cuenta por id
    public function obtenerCuenta($id){
        $this->db->where('id',$id);    
        $query = $this->db->get('conf_cuentas');        
        if($query->num_rows()>0) return $query->result();
        else return $query->result();
    }

    
   // Metodo público, para actualizar un registro 
    public function actualizarCuenta($datos) {
        $result = $this->db->where('codigo =', $datos['codigo']);
        $result = $this->db->where('id !=', $datos['id']);
        $result = $this->db->get('conf_cuentas');
        
        $result2 = $this->db->where('descripcion =', $datos['descripcion']);
        $result2 = $this->db->where('id !=', $datos['id']);
        $result2 = $this->db->get('conf_cuentas');

        
        if ($result->num_rows() > 0) {
            echo '1';
        }else if ($result2->num_rows() > 0){
            echo '2';
        }else {
            $result = $this->db->where('id', $datos['id']);
            $result = $this->db->update('conf_cuentas', $datos);
            return $result;
        }
    }

    // Metodo público, para eliminar un registro 
    public function eliminarCuenta($id) {
        $result = $this->db->where('cuenta_id', $id);
        $result = $this->db->get('ref_rel_pagos');
        
        if ($result->num_rows() > 0) {
            echo 'e';
        }else {
            $result = $this->db->delete('conf_cuentas', array('id'=>$id));
            return $result; 
        }
            
    }

}

