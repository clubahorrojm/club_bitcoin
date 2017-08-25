<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelStandard
 *
 * @author jesus
 */
class MAuditoria extends CI_Model
{
    //put your code here}
    private $table = NULL;
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->table= 'auditoria';
    }
    
    // Módulo auditoría
    public function add($param)
    {

        $result = $this->db->insert("auditoria", $param);
        return $result;
    }
    
    // Método público para listar las auditorías generales
    public function obtenerAuditorias(){
        $query = $this->db->order_by("id", "desc");
        $query = $this->db->get('auditoria');     
            

        if ($query->num_rows() > 0)
            return $query->result();
        else
            return $query->result();
    }
    
    // Método público para listar auditorías específicas
    public function obtenerAuditoriasEsp($usuario,$desde,$hasta)
    {
		$query = "";
		$sql = "";
		
		// La consulta se hace dependiendo de los parámetros de búsqueda
		if($usuario != "xxx" and $desde == "xxx" and $hasta == "xxx"){
			//~ $this->db->where('usuario', $usuario);
			$sql = "SELECT * FROM auditoria WHERE usuario=".$usuario;
		}else if($usuario != "xxx" and $desde != "xxx" and $hasta != "xxx"){
			$sql = "SELECT * FROM auditoria WHERE usuario=".$usuario." AND fecha BETWEEN '".$desde."' AND '".$hasta."'";
		}else if($usuario == "xxx" and $desde != "xxx" and $hasta != "xxx"){
			$sql = "SELECT * FROM auditoria WHERE fecha BETWEEN '".$desde."' AND '".$hasta."'";
		}
		//~ echo $sql;
		$query = $this->db->query($sql);
        //~ $query = $this->db->get('auditoria');  No es necesario cuando se usa db->query()
        
        if ($query->num_rows() > 0)
			return $query->result();
        else
            echo '0';
    }
    
}
