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
class ModelsBusqueda extends CI_Model
{
    //put your code here}
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    // Método publico para traer las lineas estrategicas segun la asociacion con el plan de la nacion
    public function search($campo, $table, $id)
    {
        $result = $this->db->where($campo . '=', $id);
        $result = $this->db->get($table);
        return $result->result();
    }
    
    // Método publico para traer el objetivo nacional segun la asociacion con el plan de la patria y el objetivo Historico
    public function search_multiple_two($campoA, $campoB, $table, $idA,$idB)
    {
        $result = $this->db->where($campoA . '=', $idA, $campoB . '=', $idB);
        $result = $this->db->get($table);
        return $result->result();
    }
    
    
    // Método publico para traer el objetivo nacional segun la asociacion con el plan de la patria y el objetivo Historico
    public function search_multiple_three($campoA, $campoB, $campoC, $table, $idA,$idB,$idC)
    {
        $result = $this->db->where($campoA . '=', $idA, $campoB . '=', $idB, $campoC . '=', $idC);
        $result = $this->db->get($table);
        return $result->result();
    }
    
    // Método público para consultar el id del último registro de la tabla especificada
    public function count_all_table($table)
    {
        $query = $this->db->limit(1)->order_by("id", "desc")->get($table);
        foreach ($query->result() as $row)
        {
                return $row->id;
        }
       
        
    }
    
    // Método público para consultar si ya existe un determinado registro en una tabla específica a través de su nombre
    public function existe_registro($table, $camp_nom, $nom)  // Argumentos: tabla, campo, valor
    {
        $result = $this->db->where(''.$camp_nom.' =', $nom);
        $result = $this->db->get($table);
        
        if ($result->num_rows() > 0) {
            echo 'existe';
        } else {
			echo 'no existe';
        }
        
    }
    
    // Método público para consultar un registro específico de una tabla y un campo dado
    public function obtenerRegistro($table, $campo, $valor)
    {
        $result = $this->db->where($campo . '=', $valor);
        $result = $this->db->get($table);
        return $result->row();
    }
    
    // Método para buscar el departamento luego de haber seleccionado la unidad
    public function search_estatus_unidad($id)
    {

               
        $idB = 'true';
        $result = $this->db->where('depart.estatus =', $idB);
        $result = $this->db->where( 'unidep.id =', "$id");
        $result = $this->db->select('unidep.departamento, depart.estatus, depart.id, depart.departamento');
        $result = $this->db->from('conf_uni_depart as unidep');
        $result = $this->db->join('conf_depart as depart', 'unidep.departamento=depart.id');

        $result = $this->db->get();
        return $result->result();
    }
    
    
    // Método para buscar el pais luego de haber seleccionado la estado
    public function Pais($id)
    {

               
        $idB = 'true';
        $result = $this->db->where('pa.activo =', $idB);
        $result = $this->db->where( 'est.id =', "$id");
        $result = $this->db->select('est.pais, pa.activo, pa.id, pa.abreviatura, pa.pais');
        $result = $this->db->from('conf_estado as est');
        $result = $this->db->join('conf_pais as pa', 'est.pais=pa.id');
       
        $result = $this->db->get();
        return $result->result();
    }
    
     public function CiudadPais($id)
    {

               
        $idB = 'true';
        $result = $this->db->where('pa.activo =', $idB);
        $result = $this->db->where( 'ciu.id =', "$id");
        $result = $this->db->select('ciu.pais, pa.activo, pa.id, pa.abreviatura, pa.pais');
        $result = $this->db->from('conf_ciudad as ciu');
        $result = $this->db->join('conf_pais as pa', 'ciu.pais=pa.id');
        $result = $this->db->get();
        return $result->result();
    }
    
    // Método para buscar el pais luego de haber seleccionado la estado
    public function Estado($id)
    {

        $idB = 'true';
        $result = $this->db->where('est.activo =', $idB);
        $result = $this->db->where( 'ciu.id =', "$id");
        $result = $this->db->select('ciu.estado, est.activo, est.id, est.abreviatura, est.estado');
        $result = $this->db->from('conf_ciudad as ciu');
        $result = $this->db->join('conf_estado as est', 'ciu.estado=est.id');
        $result = $this->db->get();
        return $result->result();
    }
    
        public function Ciudad($id)
    {
              
        $idB = 'true';
        $result = $this->db->where('ciu.activo =', $idB);
        $result = $this->db->where( 'mu.id =', "$id");
        $result = $this->db->select('mu.ciudad, ciu.activo, ciu.id, ciu.abreviatura, ciu.ciudad');
        $result = $this->db->from('conf_municipio as mu');
        $result = $this->db->join('conf_ciudad as ciu', 'mu.ciudad=ciu.id');
        $result = $this->db->get();
        return $result->result();
    }
    
         public function Busq($id)
    {
              
        $idB = 'true';
        $result = $this->db->where('ciu.activo =', $idB);
        $result = $this->db->where( 'mun.id =', "$id");
        $result = $this->db->select('mun.id as municipio_id ,mun.municipio, pa.id as pais_id ,pa.pais, pa.abreviatura, est.id as estado_id, est.estado ,est.abreviatura, ciu.id as ciudad_id, ciu.abreviatura, ciu.ciudad');
        $result = $this->db->from('conf_municipio as mun');
        $result = $this->db->join('conf_ciudad as ciu', 'mun.ciudad=ciu.id');
        $result = $this->db->join('conf_estado as est','mun.estado=est.id');
        $result = $this->db->join('conf_pais as pa', 'mun.pais=pa.id');
        $result = $this->db->get();
        return $result->result();
    }

    // Método público para traer la última factura según su prefijo 
    public function correlativo_pre($table, $pre)
    {
		$query = $this->db->like('codfactura',$pre);
        $query = $this->db->limit(1)->order_by("codfactura", "desc")->get($table);
        //~ echo $this->db->last_query();
        //~ echo count($query->result());
        //~ exit;
        
        if(count($query->result()) > 0){
			foreach ($query->result() as $row)
			{
				$c_factura = explode('-',$row->codfactura);
				$c_factura = (int)$c_factura[1];
				if ($c_factura + (int)1 > 99999999){
					$c_factura = $pre."-".str_pad(1, 8, "0", STR_PAD_LEFT);
				}else{
					$c_factura = $pre."-".str_pad($c_factura + 1, 8, "0", STR_PAD_LEFT);
				}
				return $c_factura;  // Retornamos sólo el código
			}
        }else{
			$c_factura = $pre."-".str_pad(1, 8, "0", STR_PAD_LEFT);
			return $c_factura;
		}
        
    }
    // Método para buscar el sub grupo luego de haber seleccionado el grupo (BIENES)
    public function search_sub_grupo($id)
    {
        $result = $this->db->where( 'grupo_id =', "$id");
        $result = $this->db->select('sub_grupo, nombre_sub_grupo');
        $result = $this->db->from('bienes_conf_sub_grupo');
        $result = $this->db->get();
        return $result->result();
    }
	// Método para buscar la categoria especifica luego de haber seleccionado (BIENES)
    public function search_sub_categorias($id)
    {
        $result = $this->db->where( 'categoria_id =', $id);
        $result = $this->db->select('codigo, sub_categoria');
        $result = $this->db->from('bienes_conf_sub_categorias');
        $result = $this->db->get();
        return $result->result();
    }
    // Método para buscar el municipio luego de haber seleccionado el estado (BIEN)
    public function search_topo_municipios($id)
    {
        $result = $this->db->where('estado_id =', $id);
        $result = $this->db->select('codigo, municipios');
        $result = $this->db->from('bienes_conf_municipio');
        $result = $this->db->get();
        return $result->result();
    }
	// Método para buscar el municipio luego de haber seleccionado el estado (BIEN)
    public function search_topo_parroquias($est, $mun)
    {
        $result = $this->db->where('estado_id =', $est);
		$result = $this->db->where('municipio_id =', $mun);
        $result = $this->db->select('codigo, parroquias');
        $result = $this->db->from('bienes_conf_parroquia');
        $result = $this->db->get();
        return $result->result();
    }
		// Método para buscar el municipio luego de haber seleccionado el estado (BIEN)
    public function search_topo_ciudades($est, $mun)
    {
        $result = $this->db->where('estado_id =', "$est");
		$result = $this->db->where('municipio_id =', "$mun");
        $result = $this->db->select('codigo, ciudades');
        $result = $this->db->from('bienes_conf_ciudad');
        $result = $this->db->get();
        return $result->result();
    }
    // Método para buscar el municipio luego de haber seleccionado el estado (BIEN)
    public function search_bus_dependencias($id)
    {
        $result = $this->db->where('organo_id =', $id);
        $result = $this->db->select('codigo, descripcion');
        $result = $this->db->from('bienes_adm_dependencia');
        $result = $this->db->get();
        return $result->result();
    }
	// Método para buscar el municipio luego de haber seleccionado el estado (BIEN)
    public function search_bus_unidades($org, $dep)
    {
        $result = $this->db->where('organo_id =', $org);
		$result = $this->db->where('dependencia_id =', $dep);
        $result = $this->db->select('codigo, nombre');
        $result = $this->db->from('bienes_adm_unidad_administrativa');
        $result = $this->db->get();
        return $result->result();
    }
	// Método para buscar el municipio luego de haber seleccionado el estado (BIEN)
    public function search_bienes_modelos($id)
    {
        $result = $this->db->where('marca_id =', $id);
        $result = $this->db->select('codigo, modelos');
        $result = $this->db->from('bienes_conf_modelos');
        $result = $this->db->get();
        return $result->result();
    }
	// Método para buscar el sub grupo luego de haber seleccionado el grupo (BIENES)
    public function search_sub_clase($gru, $sub_gru)
    {
        $result = $this->db->where( 'grupo_id =', "$gru");
		$result = $this->db->where( 'sub_grupo_id =', "$sub_gru");
        $result = $this->db->select('sub_clase, nombre_sub_clase');
        $result = $this->db->from('bienes_conf_sub_clase');
        $result = $this->db->get();
        return $result->result();
    }
    // Método para buscar el sub grupo luego de haber seleccionado el grupo (BIENES)
    public function search_sub_cate_esp($cate, $sub_cate)
    {
        $result = $this->db->where( 'categoria_id =', "$cate");
		$result = $this->db->where( 'sub_categoria_id =', "$sub_cate");
        $result = $this->db->select('codigo, cate_espefica');
        $result = $this->db->from('bienes_conf_cate_especifica');
        $result = $this->db->get();
        return $result->result();
    }
    // Método para buscar el sub grupo luego de haber seleccionado el grupo (BIENES)
    public function search_bus_responsable($uni)
    {
        $result = $this->db->where('unidad_id =', "$uni");
        $result = $this->db->select('cedula, nombre, apellido');
        $result = $this->db->from('bienes_adm_responsables');
        $result = $this->db->get();
        return $result->result();
    }
	//(BIENES)
	public function search_bus_serial($serial, $id_b)
    {
        $result = $this->db->where('serial =', "$serial");
		$result = $this->db->where('id !=', "$id_b");
        //$result = $this->db->from('bienes_conf_cate_especifica');
        $result = $this->db->get('bienes_reg_bienes_nacionales');
		if ($result->num_rows() > 0) {
            echo 'True';
        }else{
			echo 'False';
		}
    }
    //(CONDOMINIOS)
    public function search_bus_codigo($inm)
    {
		$result = $this->db->where('inmueble_id =', "$inm");
        $result = $this->db->select('codigo');
        $result = $this->db->from('pro_recibos');
		$result = $this->db->order_by("codigo", "asc");
		$result = $this->db->limit(1);
        $result = $this->db->get();
        //return $result->result();
		if ($result->num_rows() > 0) {
			$cod = $result->result();
			$codigo = $cod[0]->codigo + 1;
			return $codigo;
			}else{
			return '1';
		}
    }
	//(CONDOMINIOS)
    public function search_bus_copropietarios($inm)
    {
		$sql_select = "SELECT codigo, nombre, apellido, apto, ";
		$sql_select .= " CAST(split_part(apto,'-',1) AS float8) piso, split_part(apto,'-',2) AS lado ";
		$sql_select .= " FROM conf_copropietarios WHERE inmueble_id =".$inm." ORDER BY piso, lado ";
		$query3 = $this->db->query($sql_select);
		return $query3->result();
    }
	//(CONDOMINIOS)
    public function search_bus_deudas($cop)
    {
		$query = $this->db->select_sum('monto_pendiente', 'Monto');
        $query = $this->db->where('copropietario_id =', $cop);
        $query = $this->db->get('conf_rel_recibos');
        $result = $query->result();
        return $result[0]->Monto;
    }
    
    //(LINKS)
    public function search_bus_link($enlace)
    {
        $query = $this->db->where('links =', $enlace);
        $query = $this->db->get('ref_rel_links');
        $result = $query->result();
        return $result;
    }
    
    public function search_next_link()
    {
		$result = $this->db->where('estatus =', 1);
        //~ $result = $this->db->select('codigo');
        $result = $this->db->from('ref_rel_links');
		$result = $this->db->order_by("id", "asc");
		$result = $this->db->limit(1);
        $result = $this->db->get();
        //return $result->result();
		if ($result->num_rows() > 0) {
			$data = $result->row();
			$new_link = $data->links;
			return $new_link;
		}else{
			return '1';
		}
    }
	public function search_next_link2()
    {
		$result = $this->db->where('estatus =', 1);
        //~ $result = $this->db->select('codigo');
        $result = $this->db->from('ref_rel_links');
		$result = $this->db->order_by("id", "asc");
		$result = $this->db->limit(1);
        $result = $this->db->get();
        //return $result->result();
		if ($result->num_rows() > 0) {
			$data = $result->row();
			$new_link = $data->usuario_id.'@@@'.$data->num_link;
			return $new_link;
		}else{
			return '1';
		}
    }
	public function search_punteros()
    {
		$sql_select = "SELECT usu.username, map.longitud, map.latitud ";
		$sql_select .= " FROM usuarios_ubicacion as map ";
		$sql_select .= " INNER JOIN usuarios as usu ON map.usuario_id=usu.id ";
		$query3 = $this->db->query($sql_select);
		return $query3->result();
    }
	
	public function search_notificaciones($usuario, $hoy){
		$sql_select = "SELECT tipo, accion, date_part('DAY', TIMESTAMP '".$hoy."' - fecha::date) AS dias FROM notificaciones ";
		$sql_select .= " WHERE usuario_id =".$usuario." ORDER BY id DESC LIMIT 10";
		$query3 = $this->db->query($sql_select);
		return $query3->result();
    }
	public function search_new_notificaciones($usuario){
		$sql_select = "SELECT tipo, accion FROM notificaciones ";
		$sql_select .= " WHERE usuario_id =".$usuario." AND estatus = 1 ORDER BY id DESC LIMIT 10";
		$query3 = $this->db->query($sql_select);
		return $query3->result();
    }
	// Metodo público, para actualizar un registro 
    public function actualizar_notifiaciones($usuario) {
		$sql_select = "UPDATE notificaciones  ";
		$sql_select .= " SET estatus=2  ";
		$sql_select .= " WHERE usuario_id =".$usuario;

		$query3 = $this->db->query($sql_select);
		//return $query3->result();
    }
	public function search_tipo_usuario($id){
		$sql_select = "SELECT tipo_usuario FROM usuarios ";
		$sql_select .= " WHERE id  =".$id;
		$query3 = $this->db->query($sql_select);
		return $query3->result();
    }
	public function search_pagos($id)
    {
		$sql_select = "SELECT fecha, count(referido_id) total";
		$sql_select .= " FROM ref_rel_distribucion ";
		$sql_select .= " WHERE usuario_id = ".$id." group by fecha ";
		//echo $sql_select;
		$query3 = $this->db->query($sql_select);
		return $query3->result();
    }
}
