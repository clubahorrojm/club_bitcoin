<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelsTerminales
 *
 * @author jsolorzano
 */
class ModelsTerminales extends CI_Model {
    //put your code here


    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
	
	// Metodo público, forma de consultar los datos de todos los registros
    public function obtenerTerminales() {
		//~ $query = $this->db->select('t.id, t.codigo, t.nombre, t.estatus, u.username');
		//~ $query = $this->db->from('terminal t');
		//~ $query = $this->db->join('usuarios u', 'u.id = t.usuario');
		//~ $query = $this->db->get();
         
        $query = $this->db->get('terminal');
        
        if($query->num_rows()>0) return $query->result();
        else return $query->result();
    }
    
    // Metodo público, forma de consultar los datos de todos los registros
    public function obtenerUsuarios() {
		$query_tipo = $this->db->where('name=', 'VENDEDOR');
        $query_tipo = $this->db->get('conf_grupo_user');
        $tipo_user = $query_tipo->row();
        
		$query = $this->db->where('tipo_usuario=', $tipo_user->id);
        $query = $this->db->get('usuarios');
        
        if($query->num_rows()>0) return $query->result();
         else return $query->result();
    }
    
    // Metodo público, forma de consultar los datos de todos los productos asociados a una terminal
    public function obtenerDetalles($cod) {
		$query = $this->db->where('cod_terminal=', $cod);
        $query = $this->db->get('detalle_terminal');
        
        if($query->num_rows()>0) return $query->result();
         else return $query->result();
    }
    
    // Metodo público, forma de insertar los datos de un nuevo registro
    public function insertarTerminal($datos)
    {
		$result = $this->db->where('nombre =', $datos['nombre']);
        $result = $this->db->get('terminal');
        
        $result2 = $this->db->where('usuario =', $datos['usuario']);
        $result2 = $this->db->get('terminal');
        
        if ($result->num_rows() > 0) {
            #echo "CORRECTO";
            echo '1';
        } else if ($result2->num_rows() > 0) {
            #echo "CORRECTO";
            echo '2';
        } else {
            $result = $this->db->insert("terminal", $datos);
			return $result;
        }
    }
    
    // Metodo publico, forma de insertar los detalles o productos asociados a una terminal 
    public function insertar_dt($data)
    {
		$result = $this->db->insert("detalle_terminal", $data);
		return $result;
    } 
    
    // Metodo público, forma de consultar los datos de un registro
    public function obtenerTerminal($cod){
        $this->db->where('codigo',$cod);    
        $query = $this->db->get('terminal');        
        if($query->num_rows()>0) return $query->result();
        else return $query->result();
    }
    
    // Metodo público, forma de actualizar los datos de un registro
    public function actualizarTerminal($datos) {
        
        //~ print_r($datos);
        
        $result = $this->db->where('nombre =', $datos['nombre']);
        $result = $this->db->where('codigo !=', $datos['codigo']);
        $result = $this->db->get('terminal');
        
        $result2 = $this->db->where('usuario =', $datos['usuario']);
        $result2 = $this->db->where('codigo !=', $datos['codigo']);
        $result2 = $this->db->get('terminal');
        
        if ($result->num_rows() > 0) {
            #echo "CORRECTO";
            echo '1';
        } else if ($result2->num_rows() > 0) {
            #echo "CORRECTO";
            echo '2';
        } else {
            $result = $this->db->where('codigo', $datos['codigo']);
			$result = $this->db->update('terminal', $datos);
			return $result;
        }

    }
    
    // Metodo público, forma de actualizar el estatus de una terminal
    public function actualizarEstatusTerminal($datos) {

        $result = $this->db->where('id', $datos['id']);
        $result = $this->db->update('terminal', $datos);
        return $result;

    }

	// Metodo público, forma de eliminar un registro
    public function eliminarTerminal($cod) {
	// Primero buscamos si existe un cliente asociado al código del tipo de cliente que queremos eliminar
	$result = $this->db->where('terminal =', $cod);
        $result = $this->db->get('cliente');
        
        if ($result->num_rows() > 0) {
            echo 'existe';
        } else {
			// Procedemos a borrar el tipo de servicio si no está asociado a un servicio
            $result = $this->db->delete('terminal', array('cod_tipo'=>$cod));
            return $result;
        }
    }
    
    public function eliminarProducto($cod)
    {
        $result = $this->db->delete('detalle_terminal', array('cod_detalle'=>$cod));
        return $result;
    }
    
}
