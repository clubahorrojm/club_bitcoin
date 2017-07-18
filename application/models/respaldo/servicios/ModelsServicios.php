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
class ModelsServicios extends CI_Model
{

    //put your code here


    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function obtenerServicios()
    {
		// NUEVA FORMA
		$query = $this->db->select('s.id, s.codigo, ts.tipo_servicio, s.descripcion, s.precio_unitario');
		$query = $this->db->from('servicio s');
		$query = $this->db->join('tipo_servicio ts', 'ts.cod_servicio = s.tipo_servicio');
		$query = $this->db->get();
		
        //~ $query = $this->db->get('servicio'); FORMA ANTERIOR                        

        if ($query->num_rows() > 0)
            return $query->result();
        else
            return $query->result();
    }

    // Metodo publico, forma de insertar los datos
    public function insertar($data)
    {
        $result = $this->db->where('descripcion =', $data['descripcion']);
        $result = $this->db->get('servicio');

        if ($result->num_rows() > 0) {
            #echo "CORRECTO";
            echo '1';
        } else {
            $result = $this->db->insert("servicio", $data);
            return $result;
        }
        
    }
    
    
    public function obtenerServicio($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('servicio');
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return $query->result();
    }
    

    public function actualizarServicio($datos)
    {
        
        $result = $this->db->where('id', $datos['id']);
        $result = $this->db->update('servicio', $datos);
        return $result;
    }
    


    public function eliminarServicio($id)
    {
        
           // Primero buscamos si existe un cliente asociado a la factura que queremos eliminar
	$result = $this->db->where('cod_producto_servicio =', $id);
        $result = $this->db->get('facturas_ps');
       
        if ($result->num_rows() > 0) {
            echo 'existe';
        } else {

			// Procedemos a borrar el tipo de servicio si no está asociado a un servicio
             $result = $this->db->delete('servicio', array('codigo'=>$id));
 
            return $result;
        }
        
        


    }
    


}
