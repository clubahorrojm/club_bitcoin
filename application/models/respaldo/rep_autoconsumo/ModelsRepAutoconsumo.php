<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelsRepAutoconsumo
 *
 * @author jsolorzano
 */
class ModelsRepAutoconsumo extends CI_Model
{
    //put your code here}
    private $table = NULL;
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->table= 'facturas';
    }
    
    // Metodo publico, forma de obtener un cliente por su código
    public function obtenerClienteCod($cod)
    {
        $this->db->where('codigo', $cod);
        $query = $this->db->get('cliente');
        return $query->row();
    }
    
    // Método público para listar las ventas generales
    public function obtenerVentas()
    {                                                                                      
        $query = $this->db->get('facturas');                        

        if ($query->num_rows() > 0)
            return $query->result();
        else
            return $query->result();
    }
    
    // Método público para listar ventas específicas
    public function obtenerConsumosEsp($tratamiento,$desde,$hasta)
    {
		$query = "";
		$sql = "";
		
		if ($desde != 'xxx' && $hasta != 'xxx'){
			$desde = explode('-',$desde);
			$desde = $desde[2]."-".$desde[1]."-".$desde[0];
			
			$hasta = explode('-',$hasta);
			$hasta = $hasta[2]."-".$hasta[1]."-".$hasta[0];
		}
		
		// La consulta se hace dependiendo de los parámetros de búsqueda
		if((int)$tratamiento != 3 and $desde == "xxx" and $hasta == "xxx"){
			$sql = "SELECT * FROM autoconsumo WHERE tipo_tratamiento='".$tratamiento."'";
		}else if((int)$tratamiento != 3 and $desde != "xxx" and $hasta != "xxx"){
			$sql = "SELECT * FROM autoconsumo WHERE tipo_tratamiento='".$tratamiento."' AND fecha_emision BETWEEN '".$desde."' AND '".$hasta."'";
		}else if((int)$tratamiento == 3 and $desde != "xxx" and $hasta != "xxx"){
			$sql = "SELECT * FROM autoconsumo WHERE fecha_emision BETWEEN '".$desde."' AND '".$hasta."'";
		}else if((int)$tratamiento == 3 and $desde == "xxx" and $hasta == "xxx"){
			$sql = "SELECT * FROM autoconsumo";
		}
		//~ echo $sql;
		$query = $this->db->query($sql);
        //~ $query = $this->db->get('autconsumo');  No es necesario cuando se usa db->query()
        
        if ($query->num_rows() > 0)
			return $query->result();
        else
            echo '0';
    }
    
}
