<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelsAMontos
 *
 * @author Ing. Marcel Arcuri
 */
class MAMontos extends CI_Model {
    //put your code here


    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //Metodo publico para obterner la unidad de medida
    public function obtenerAMontos($ultimo_id) {
        $this->db->where('id',$ultimo_id);    
        $query = $this->db->get('adm_asignacion_montos');        
        if($query->num_rows()>0)
            return $query->row();
        else
            return $query->row();
    }
    public function obtenerAMontos2() {
        $query = $this->db->get('adm_asignacion_montos');        
        if($query->num_rows()>0)
            return $query->result();
        else
            return $query->result();
    }
    
    // Metodo publico, forma de insertar los datos
    public function insertarAMontos($datos){
        $result = $this->db->insert("adm_asignacion_montos", $datos);
        return $result;
    }
    
    
   // Metodo publico, para actualizar un registro 
    public function actualizarAMontos($datos) {
        $result = $this->db->where('clave =', $datos['codigo']);
        $result = $this->db->get('adm_claves_sistema');

        if ($result->num_rows() == 1) {
            $update = array(
                            "porcentaje1" => $datos['porcentaje1'],
                            "porcentaje2" => $datos['porcentaje2'],
                            "porcentaje3" => $datos['porcentaje3'],
                            "porcentaje4" => $datos['porcentaje4'],
                            "porcentaje5" => $datos['porcentaje5'],
                            "porcentaje6" => $datos['porcentaje6'],
                            "porcentaje7" => $datos['porcentaje7'],
                            "porcentaje8" => $datos['porcentaje8'],
                            );
            $$result = $this->db->where('id', 1);
            $result = $this->db->update('adm_asignacion_montos', $update);
            return $result;
        }else{
            echo '1';  
        } 
        
    }
}
