<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelsClientes
 *
 * @author fmedina
 */
class ModelsAutoconsumo extends CI_Model
{

    //put your code here


    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    // Metodo publico, forma de obtener una lista de todas las facturas
    public function obtenerAutoconsumos()
    {                                                                                      
        $query = $this->db->get('autoconsumo');                        

        if ($query->num_rows() > 0)
            return $query->result();
        else
            return $query->result();
    }
    
    // Metodo publico, forma de obtener una lista de todos los productos/servicios asociados a una factura
    public function obtenerProductosServicios($cod_autoconsumo)
    {                                                                                      
        $result = $this->db->where('codautoconsumo', $cod_autoconsumo);
        $result = $this->db->get('autoconsumo_ps');
        return $result->result();
    }

	// Metodo publico, forma de obtener una lista de todos los clientes
    public function obtenerClientes()
    {                                                                                      
        $query = $this->db->get('cliente');                        

        if ($query->num_rows() > 0)
            return $query->result();
        else
            return $query->result();
    }
    
    // Metodo publico, forma de obtener un cliente por su código
    public function obtenerClienteCod($cod)
    {
        $this->db->where('codigo', $cod);
        $query = $this->db->get('cliente');
        return $query->row();
    }

    // Metodo publico, forma de insertar los datos
    //~ public function insertar($data,$datos)
    public function insertar($data)
    {
        //~ $result = $this->db->where('cirif =', $datos['cirif']);
        //~ $result = $this->db->get('cliente');

		$result = $this->db->insert("autoconsumo", $data);
		//~ $result = $this->db->insert("cliente", $data);
		return $result;
        
    }
    
    // Metodo publico, forma de insertar los datos
    //~ public function insertar($data,$datos)
    public function insertar_ps($data)
    {
        //~ $result = $this->db->where('cirif =', $datos['cirif']);
        //~ $result = $this->db->get('cliente');

		$result = $this->db->insert("autoconsumo_ps", $data);
		//~ $result = $this->db->insert("cliente", $data);
		return $result;
        
    }    
    
    public function obtenerAutoconsumo($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('autoconsumo');
        return $query->row();
    }
    
    public function obtenerAutoconsumoCod($cod)
    {
        $this->db->where('codautoconsumo', $cod);
        $query = $this->db->get('autoconsumo');
        return $query->row();
    }   

    public function actualizarAutoconsumo($datos)
    {
        
        $result = $this->db->where('codautoconsumo', $datos['codautoconsumo']);
        $result = $this->db->update('autoconsumo', $datos);
        return $result;
    }
    
    public function actualizarContacto($datos)
    {

        $result = $this->db->where('idcontacto', $datos['idcontacto']);
        $result = $this->db->update('contacto', $datos);
        return $result;
    }

    public function eliminarProductoServicio($cod)
    {
        $result = $this->db->delete('autoconsumo_ps', array('codautoconsumops'=>$cod));
        return $result;
    }

}
