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
class ModelsProveedores extends CI_Model
{

    //put your code here


    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function obtenerProveedores()
    {                                                                                      
        $query = $this->db->get('proveedor');                        

        if ($query->num_rows() > 0)
            return $query->result();
        else
            return $query->result();
    }

    // Metodo publico, forma de insertar los datos
    public function insertar($data,$datos)
    {
        $result = $this->db->where('cirif =', $data['cirif']);
        $result = $this->db->get('proveedor');

        if ($result->num_rows() > 0) {
            #echo "CORRECTO";
            echo '1';
        } else {
            $result = $this->db->insert("proveedor", $data);
            $result = $this->db->insert("contacto", $datos);
            return $result;
        }
        
    }
    


    public function obtenerProveedor($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('proveedor');
        if ($query->num_rows() > 0)
            return $query->result();
        else
            return $query->result();
    }
    

    public function actualizarCliente($datos)
    {
        
        $result = $this->db->where('id', $datos['id']);
        $result = $this->db->update('proveedor', $datos);
        return $result;
    }
    
    public function actualizarContacto($datos)
    {

        $result = $this->db->where('idcontacto', $datos['idcontacto']);
        $result = $this->db->update('contacto', $datos);
        return $result;
    }

    public function eliminarProveedor($id)
    {
        
          // Primero buscamos si existe un cliente asociado a la factura que queremos eliminar
	$result = $this->db->where('proveedor =', $id);
        $result = $this->db->get('producto');
        
        if ($result->num_rows() > 0) {
            echo 'existe',$result->num_rows();
        } else {
			// Procedemos a borrar el tipo de servicio si no está asociado a un servicio
            $result = $this->db->delete('proveedor', array('codigo'=>$id));
            $result = $this->db->delete('contacto', array('idcontacto'=>$id));
            return $result;
        }
        
        
    }
    


}