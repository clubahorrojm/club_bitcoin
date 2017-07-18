<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelsTopologia
 *
 * @author fmedina
 */
class ModelsTipoServicio extends CI_Model {
    //put your code here


    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
	
	// Metodo público, forma de consultar los datos de todos los registros
    public function obtenerTiposServicios() {
        $query = $this->db->get('tipo_servicio');
        
        if($query->num_rows()>0) return $query->result();
         else return $query->result();
    }
    
    // Metodo público, forma de insertar los datos de un nuevo registro
    public function insertarTipoServicio($datos)
    {
		//~ $this->input->post('')

        $result = $this->db->insert("tipo_servicio", $datos);
        return $result;
    }
    
    // Metodo público, forma de consultar los datos de un registro por su id
    public function obtenerTipoServicio($id){
        $this->db->where('id',$id);    
        $query = $this->db->get('tipo_servicio');        
        if($query->num_rows()>0) return $query->result();
        else return $query->result();
    }
    
    // Metodo público, forma de actualizar los datos de un registro
    public function actualizarTipoServicio($datos) {
        
        $result = $this->db->where('id', $datos['id']);
        $result = $this->db->update('tipo_servicio', $datos);
        return $result;

    }

	// Metodo público, forma de eliminar un registro
    public function eliminarTipoServicio($id) {
        // Primero buscamos si existe un servicio asociado al código del tipo de servicio que queremos eliminar
	$result = $this->db->where('tipo_servicio =', $id);
        $result = $this->db->get('servicio');
        
        if ($result->num_rows() > 0) {
            echo 'existe';
        } else {
			// Procedemos a borrar el tipo de servicio si no está asociado a un servicio
            $result = $this->db->delete('tipo_servicio', array('cod_servicio'=>$id));
            return $result;
        }
    }
    
}
