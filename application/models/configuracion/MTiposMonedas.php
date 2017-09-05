<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelsTiposMonedas
 *
 * @author Ing. Marcel Arcuri
 */
class MTiposMonedas extends CI_Model {
    //put your code here


    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //Metodo publico para obterner la unidad de medida
    public function obtenerTipoMoneda() {
        $query = $this->db->get('conf_tipos_monedas');
        
        if($query->num_rows()>0) return $query->result();
         else return $query->result();
    }
    
    // Metodo publico, forma de insertar los datos
    public function insertarTiposMonedas($datos){
        $result = $this->db->where('codigo =', $datos['codigo']);
        $result = $this->db->get('conf_tipos_monedas');
        
        $result2 = $this->db->where('descripcion =', $datos['descripcion']);
        $result2 = $this->db->get('conf_tipos_monedas');

        if ($result->num_rows() > 0) {
            echo '1';
        }else if ($result2->num_rows() > 0) {
            echo '2';
        }else{
            $result = $this->db->insert("conf_tipos_monedas", $datos);
            return $result;
        }
    }
    
    // Metodo publico, para obterner la unidad de medida por id
    public function obtenerTiposMonedas($id){
        $this->db->where('id',$id);    
        $query = $this->db->get('conf_tipos_monedas');        
        if($query->num_rows()>0) return $query->result();
        else return $query->result();
    }

    
   // Metodo publico, para actualizar un registro 
    public function actualizarTiposMonedas($datos) {
        $result = $this->db->where('codigo =', $datos['codigo']);
        $result = $this->db->where('id !=', $datos['id']);
        $result = $this->db->get('conf_tipos_monedas');
        
        $result2 = $this->db->where('descripcion =', $datos['descripcion']);
        $result2 = $this->db->where('id !=', $datos['id']);
        $result2 = $this->db->get('conf_tipos_monedas');

        
        if ($result->num_rows() > 0) {
            echo '1';
        }else if ($result2->num_rows() > 0){
            echo '2';
        }else {
            $result = $this->db->where('id', $datos['id']);
            $result = $this->db->update('conf_tipos_monedas', $datos);
            return $result;
        }
    }

    // Metodo publico, para eliminar un registro 
    public function eliminarTiposMonedas($id) {
        //$result = $this->db->where('banco_id', $id);
        //$result = $this->db->get('conf_rel_tipos_monedas');
        //
        //if ($result->num_rows() > 0) {
        //    echo 'e';
        //}else {
        $result = $this->db->delete('conf_tipos_monedas', array('id'=>$id));
        return $result; 
        //}
            
    }
    // METODO PARA LA CARGA DE ARCHIVOS .CSV 
    public function cargarCSV() {
        
        $ruta = getcwd();  // Obtiene el directorio actual en donde se esta trabajando
        echo $ruta;
        $nombre_archivo = "tipos_monedas.csv";
        $ubicacion_archivo = $ruta."/application/models/scripts/".$nombre_archivo;
        // CREAR TABLA TEMPORAL
        $sql_temp ="CREATE TEMP TABLE conf_tipos_monedas_temp (id serial NOT NULL, codigo integer NOT NULL, descripcion character varying(150) NOT NULL, activo boolean, abreviatura character varying(10))";
        $query1 = $this->db->query($sql_temp);
        // SE COPIA DATA DEL CSV A LA TABLA TEMPORAL
        $sql_up  = "copy conf_tipos_monedas_temp (codigo, descripcion, activo, abreviatura)";
        $sql_up .= "from '".$ubicacion_archivo."' DELIMITERS ';' CSV";
        $query2 = $this->db->query($sql_up);
        // SE CONSULTA EL ULTIMO ID DE LA TABLA ORIGINAL
        $sql = "SELECT id FROM conf_tipos_monedas ORDER BY id ASC";
        $query1 = $this->db->query($sql);
        $query_id = $query1->row();
        $tot = count($query_id); //CANTIDAD DE REGISTROS ENCONTRADOS EN LA CONSULTA
        //VALIDACION SI ES PRIMERA VEZ QUE SE IMPORTA O NO
        if ($tot > 0){ //SI ES NO LA PRIMERA VEZ
            $sql_tmp_2 = "SELECT * FROM conf_tipos_monedas_temp ORDER BY id ASC";  // Consultamos los registros de la tabla temporal de ASEGURADORAS
            $query_tmp_2 = $this->db->query($sql_tmp_2);
            $query_tmp_2 = $query_tmp_2->result();
            // Efectuamos la actualización del campo ID registro por registro (TABLA TEMPORAL)
            $j = 1;
            foreach ($query_tmp_2 as $sesion_tmp){
                            
                $nuevo_id = array('id' => $j+$query_id->id);  // Preparamos el nuevo id
                $update = $this->db->where('id', $sesion_tmp->id);
                $update = $this->db->update('conf_tipos_monedas_temp', $nuevo_id);
                        
                $j += 1;
            }
            $sql_insert  = "INSERT INTO conf_tipos_monedas SELECT * FROM conf_tipos_monedas_temp ";
            $sql_insert .= " WHERE codigo NOT IN (SELECT codigo FROM conf_tipos_monedas) ";
            $query3 = $this->db->query($sql_insert);
            //~ $sql_upd = "UPDATE conf_tipos_monedas SET activo=True";
            //~ $query4 = $this->db->query($sql_upd);
        }else{ //SI ES LA PRIMERA VEZ
            $sql_insert  = "INSERT INTO conf_tipos_monedas SELECT * FROM conf_tipos_monedas_temp ";
            $query3 = $this->db->query($sql_insert);
            //~ $sql_upd = "UPDATE conf_tipos_monedas SET activo=True";
            //~ $query4 = $this->db->query($sql_upd);
        }
    }
}
