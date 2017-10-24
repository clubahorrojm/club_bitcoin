<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MLDesvincular
 *
 * @author Ing. José Solorzano
 */
class MLDesvincular extends CI_Model {
    //put your code here


    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Método público para obterner una lista de los perfiles en estatus 1
    public function obtenerPerfilesIniciados() {
        $this->db->select('usuarios.id, usuarios.username, usuarios.first_name, usuarios.last_name, usuarios.email, ref_perfil.codigo as codigo_perfil, ref_perfil.estatus as estatus_perfil, ref_perfil.fecha');
		$this->db->from('usuarios');
		$this->db->join('ref_perfil', 'usuarios.id = ref_perfil.usuario_id');
		$this->db->where('ref_perfil.estatus<4');
		
		$query = $this->db->get();
        
        return $query->result();
    }
    
    // Método público, para actualizar un pago 
    public function actualizarPago($id_usu,$datos) {
		$result = $this->db->where('usuario_id', $id_usu);
		$result = $this->db->update('ref_rel_pagos', $datos);
    }
    
    // Método público, para actualizar un link 
    public function actualizarLink($id_usu,$datos) {
		$result = $this->db->where('referido_id', $id_usu);
		$result = $this->db->update('ref_rel_links', $datos);
    }
    
    // Método público, para actualizar un perfil 
    public function actualizarPerfil($id_usu,$datos) {
		$result = $this->db->where('usuario_id', $id_usu);
		$result = $this->db->update('ref_perfil', $datos);
    }
    
    // Método público para guardar los datos básicos de un usuario desvinculado
    public function guardarDesvinculado($datos) {
		$result = $this->db->insert("usuarios_desvinculados", $datos);
		return $result;
    }
    
    // Método público para eliminar un pago asociado a un usuario dado
    public function eliminarPago($usu) {
		$this->db->delete('ref_rel_pagos', array('usuario_id' => $usu));
    }
    
    // Método público para eliminar un perfil asociado a un usuario dado
    public function eliminarPerfil($usu) {
		$this->db->delete('ref_perfil', array('usuario_id' => $usu));
    }
    
    // Método público para guardar los datos básicos de un usuario eliminado
    public function guardarEliminado($datos) {
		$result = $this->db->insert("usuarios_eliminados", $datos);
		return $result;
    }
    
    // Método público para buscar el último registro de un usuario en la tabla de usuarios_desvinculados
    public function buscarDesvinculado($usuario) {
		$result = $this->db->where('usuario =', $usuario);
		$result = $this->db->order_by("id", "desc");
		$result = $this->db->limit(1);
		$result = $this->db->get('usuarios_desvinculados');
		return $result->result();
	}
	
	// Método público para buscar los links disponibles para revincular al usuario indicado
	public function linksDisponibles($id_usu)
	{
		$result = $this->db->where('usuario_id !=', $id_usu);
		$result = $this->db->where('estatus =', 1);
		$result = $this->db->get('ref_rel_links');
		return $result->result();
	}
	
	// Método público, para vincular un link a un usuario dado
    public function vincularLink($id,$datos) {
		$result = $this->db->where('id', $id);
		$result = $this->db->update('ref_rel_links', $datos);
    }
    
    // Método público para guardar los datos básicos de un usuario revinculado
    public function guardarRevinculado($datos) {
		$result = $this->db->insert("usuarios_revinculados", $datos);
		return $result;
    }
    
}

