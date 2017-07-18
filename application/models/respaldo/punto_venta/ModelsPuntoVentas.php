<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelsPuntoVentas
 *
 * @author jsolorzano
 */
class ModelsPuntoVentas extends CI_Model {
    //put your code here


    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
	
	// Metodo público, forma de consultar los datos de todas las terminales
    public function obtenerTerminales() {
		$query = $this->db->select('t.id, t.codigo, t.nombre, u.username');
		$query = $this->db->from('terminal t');
		$query = $this->db->join('usuarios u', 'u.id = t.usuario');
		$query = $this->db->get();
		
        //~ $query = $this->db->get('terminal');
        
        if($query->num_rows()>0) return $query->result();
         else return $query->result();
    }
    
    // Metodo público, forma de consultar los datos de todos los usuarios de tipo Vendedor
    public function obtenerUsuarios() {
		$query = $this->db->where('tipo_usuario=', 'Vendedor');
        $query = $this->db->get('usuarios');
        
        if($query->num_rows()>0) return $query->result();
         else return $query->result();
    }
    
    // Metodo público, forma de consultar el id de un producto en la tabla de 'detalle_terminal' por su 'cod_terminal' y su 'cod_producto'
    public function obtenerIdDetalle($datos) {
		$query = $this->db->where('cod_terminal=', $datos['cod_terminal']);
		$query = $this->db->where('cod_producto=', $datos['cod_producto']);
        $query = $this->db->get('detalle_terminal');
        
        return $query->row();
    }
    
    // Metodo publico, forma de obtener una lista de todos los productos/servicios asociados a una factura
    public function obtenerProductosServicios($cod_factura)
    {                                                                                      
        $result = $this->db->where('codfactura', $cod_factura);
        $result = $this->db->get('facturas_ps');
        return $result->result();
    }
    
    // Metodo público, forma de consultar los datos de todos los productos asociados a una terminal
    public function obtenerDetalles($cod) {
		$query = $this->db->where('cod_terminal=', $cod);
        $query = $this->db->get('detalle_terminal');
        
        if($query->num_rows()>0) return $query->result();
         else return $query->result();
    }
    
    // Metodo público, forma de consultar los códigos de todas las facturas realizadas en una sesión determinada
    public function obtenerDetallesSesion($cod) {
		$query = $this->db->where('cod_sesion=', $cod);
        $query = $this->db->get('detalle_sesion');
        
        if($query->num_rows()>0) return $query->result();
         else return $query->result();
    }
    
    // Metodo público, forma de insertar los datos de un nuevo registro
    public function insertarSesion($datos)
    {
		$result = $this->db->insert("sesiones", $datos);
		return $result;
    }
    
    // Metodo público, forma de insertar las facturas de una sesión
    public function insertarDetalleSesion($datos)
    {
		$result = $this->db->insert("detalle_sesion", $datos);
		return $result;
    }
    
    // Metodo publico, forma de insertar los detalles o productos asociados a una terminal 
    public function insertar_dt($data)
    {
		$result = $this->db->insert("detalle_terminal", $data);
		return $result;
    } 
    
    // Metodo público, forma de consultar los datos de un registro
    public function obtenerSesion($user){
        $result = $this->db->where('user_create_id=',$user);
        $result = $this->db->where('estatus=','1');    
        $result = $this->db->get('sesiones');        
        return $result->row();
    }
    
    // Metodo público, forma de consultar los datos de una sesión específica
    public function datosSesion($cod){
        $result = $this->db->where('codigo=',$cod);    
        $result = $this->db->get('sesiones');        
        return $result->row();
    }
    
    // Metodo público, forma de consultar los datos de una sesión específica
    public function datosTerminal($cod){
        $result = $this->db->where('codigo=',$cod);    
        $result = $this->db->get('terminal');        
        return $result->row();
    }
    
    // Metodo público, forma de consultar los datos de una sesión específica
    public function datosUsuario($id){
        $result = $this->db->where('id=',$id);    
        $result = $this->db->get('usuarios');        
        return $result->row();
    }
    
    // Metodo público, forma de actualizar los datos de un registro
    public function actualizarSesion($datos) {
        
        //~ print_r($datos);
        $result = $this->db->where('codigo', $datos['codigo']);
        $result = $this->db->update('sesiones', $datos);
        return $result;

    }
    
    // Metodo publico, forma de actualizar los datos de un producto en la tabla de 'detalle_terminal'
    public function actualizarProductoTerminal($datos)
    {
        
        $result = $this->db->where('cod_detalle', $datos['cod_detalle']);
        $result = $this->db->update('detalle_terminal', $datos);
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
    
    // Método público para consultar un cliente en base de datos
    public function obtenerCliente($table, $tipo, $cedula)
    {
        $result = $this->db->where('tipocliente=', $tipo);
        $result = $this->db->where('cirif=', $cedula);
        $result = $this->db->get($table);
        return $result->row();
    }
    
    // Método público para listar ventas específicas
    public function obtenerVentas($facturas)
    {
		$query = "";
		$sql = "";
		
		// La consulta se hace dependiendo de la lista de facturas
		$sql = "select producto_servicio, precio, SUM(cantidad) cant, SUM(importe+monto_iva) total from facturas_ps where codfactura ".$facturas." group by producto_servicio, precio";
		//~ echo $sql;
		$query = $this->db->query($sql);
        //~ $query = $this->db->get('autconsumo');  No es necesario cuando se usa db->query()
        
        if ($query->num_rows() > 0)
			return $query->result();
        else
            echo '0';
    }
    
    // Metodo público para generar un respaldo de toda la información de ventas
    public function respaldo_ventas() {
		
		// En este método generamos un arreglo con los datos de todas las tablas necesarias de ventas (sesione, detalle_sesiones, facturas, facturas_ps)
		$query = $this->db->order_by('id asc');
        $query = $this->db->get('sesiones');
        
        $query2 = $this->db->order_by('id asc');
        $query2 = $this->db->get('detalle_sesion');
        
        $query3 = $this->db->order_by('id asc');
        $query3 = $this->db->get('facturas');
        
        $query4 = $this->db->order_by('id asc');
        $query4 = $this->db->get('facturas_ps');
        
        $query5 = $this->db->order_by('id asc');
        $query5 = $this->db->get('terminal');
        
        $query6 = $this->db->order_by('id asc');
        $query6 = $this->db->get('detalle_terminal');
        
        $query7 = $this->db->order_by('id asc');
        $query7 = $this->db->get('producto');
        
        return array($query->result(), $query2->result(), $query3->result(), $query4->result(), $query5->result(), $query6->result(), $query7->result());
    }
    
    // Método público para cargar datos de los respaldos a la base de datos
    public function carga_respaldo($nombre_comprimido) {
		
		// Obtenemos la fecha del archivo comprimido
		$fecha = explode("_",$nombre_comprimido);
		$fecha = explode(".",$fecha[1]);
		$fecha = $fecha[0];
		
		$query = "";
		$sql = "";
		$var = "id, codigo, cod_terminal, monto_caja, ventas_dia, fecha_inicio,"; 
		$var .= "fecha_cierre, estatus, user_create_id, hora_inicio, hora_cierre";
		$ruta = getcwd();  // Obtiene el directorio actual en donde se esta trabajando
		
		// Generamos los nombres de los archivos de respaldo
        $nombre_archivo = "sesiones_".$fecha.".csv";
        $nombre_archivo2 = "detalle_sesiones_".$fecha.".csv";
        $nombre_archivo3 = "facturas_".$fecha.".csv";
        $nombre_archivo4 = "facturas_ps_".$fecha.".csv";
        $nombre_archivo5 = "terminales_".$fecha.".csv";
        $nombre_archivo6 = "detalle_terminales_".$fecha.".csv";
        $nombre_archivo7 = "productos_".$fecha.".csv";
		
		// Preparamos los archivos de respaldo a leer
        $ubicacion_archivo = $ruta."/respaldos/".$nombre_archivo;
        $ubicacion_archivo2 = $ruta."/respaldos/".$nombre_archivo2;
        $ubicacion_archivo3 = $ruta."/respaldos/".$nombre_archivo3;
        $ubicacion_archivo4 = $ruta."/respaldos/".$nombre_archivo4;
        $ubicacion_archivo5 = $ruta."/respaldos/".$nombre_archivo5;
        $ubicacion_archivo6 = $ruta."/respaldos/".$nombre_archivo6;
        $ubicacion_archivo7 = $ruta."/respaldos/".$nombre_archivo7;
		
		// Consultas de inserción con COPY para las sesiones
		$sql = "copy sesiones_temp (id, codigo, cod_terminal, monto_caja, ventas_dia, fecha_inicio,"; 
        $sql .= "fecha_cierre, estatus, user_create_id, hora_inicio, hora_cierre) from '".$ubicacion_archivo."' DELIMITERS ';' CSV";
		//~ echo $sql;
		$query = $this->db->query($sql);
		
		// Consultas de inserción con COPY para los detalles de sesión
        $sql2 = "copy detalle_sesion_temp (id, cod_sesion, cod_factura) from '".$ubicacion_archivo2."' DELIMITERS ';' CSV";
		//~ echo $sql2;
		$query2 = $this->db->query($sql2);
		
		// Consultas de inserción con COPY para las facturas
		$sql3 = "copy facturas_temp (id, pre_cod_factura, codfactura, codcliente, cliente, base_imponible, ";
		$sql3 .= "iva, monto_iva, descuento, totalfactura, observaciones, motivo_anulacion, estado, fecha_emision, "; 
		$sql3 .= "hora_emision, monto_desc, condicion_pago, monto_exento, subtotal, num_cheque, num_recibo, num_transf, num_control) ";
		$sql3 .= "from '".$ubicacion_archivo3."' DELIMITERS ';' CSV";
		//~ echo $sql3;
		$query3 = $this->db->query($sql3);
		
		// Consultas de inserción con COPY para los detalles de factura
		$sql4 = "copy facturas_ps_temp (id, codfacturaps, codfactura, tipo, cod_producto_servicio, producto_servicio, ";
		$sql4 .= "precio, cantidad, importe, monto_iva) from '".$ubicacion_archivo4."' DELIMITERS ';' CSV";
		//~ echo $sql4;
		$query4 = $this->db->query($sql4);
		
		// Consultas de inserción con COPY para los terminales
		$sql5 = "copy terminal_temp (id, codigo, nombre, usuario, fecha_create, fecha_update, user_create_id)";
		$sql5 .= "from '".$ubicacion_archivo5."' DELIMITERS ';' CSV";
		//~ echo $sql5;
		$query5 = $this->db->query($sql5);
		
		// Consultas de inserción con COPY para los detalles de terminales
		$sql6 = "copy detalle_terminal_temp (id, cod_detalle, cod_terminal, cod_producto, producto, precio, ";
        $sql6 .= "existencia, iva, monto_iva) from '".$ubicacion_archivo6."' DELIMITERS ';' CSV";
        //~ echo $sql6;
		$query6 = $this->db->query($sql6);
		
		// Consultas de inserción con COPY para los productos
		$sql7 = "copy producto_temp (id, codigo, tipoproducto, nombre, descripcion, cantidad, stock_max, ";
        $sql7 .= "stock_min, stock_req, ganancia, precio_unitario, iva, unidad_medida, "; 
        $sql7 .= "tiempo_utilidad, proveedor, monto_iva, precio_total, existencia) from '".$ubicacion_archivo7."' DELIMITERS ';' CSV";
        //~ echo $sql7;
		$query7 = $this->db->query($sql7);
		
		// Consulta de actualización del campo id_nuevo para las sesiones temporales
		$sql_id = "SELECT id,codigo FROM sesiones ORDER BY id DESC LIMIT 1";  // Buscamos el id de la última sesión
		$query_id = $this->db->query($sql_id);
		$query_id = $query_id->row();
		//~ echo $query_id->id;
		$sql_sesiones_tmp = "SELECT * FROM sesiones_temp ORDER BY id ASC";  // Consultamos los registros de la tabla temporal de sesiones
		$query_sesiones_tmp = $this->db->query($sql_sesiones_tmp);
		$query_sesiones_tmp = $query_sesiones_tmp->result();
		// Efectuamos la actualización del campo id_nuevo registro por registro
		$j = 1;
		foreach ($query_sesiones_tmp as $sesion_tmp){
			//~ echo $sesion_tmp->id;
			// Actualizamos también los códigos de sesión
			//~ $n_codigo = explode('SS',$query_id->codigo);
			//~ $n_codigo = (int)$n_codigo[1];
			//~ $n_codigo = "SS".str_pad($j+$n_codigo, 8, '0', STR_PAD_LEFT);
			//~ $nuevo_id = array('id_nuevo' => $j+$query_id->id,'codigo' => $n_codigo);  // Preparamos el nuevo id y el nuevo código
			$nuevo_id = array('id_nuevo' => $j+$query_id->id);  // Preparamos el nuevo id y el nuevo código
			$update = $this->db->where('id', $sesion_tmp->id);
			$update = $this->db->update('sesiones_temp', $nuevo_id);
			//~ $nuevo_codigo = array('cod_sesion' => $n_codigo);
			//~ echo "Codigo actual: ".$sesion_tmp->codigo;
			//~ echo "Codigo nuevo: ";
			//~ print_r($nuevo_codigo);
			//~ $sql_update_dt = "UPDATE detalle_sesion_temp SET cod_sesion = '".$n_codigo."' WHERE cod_sesion = '".$sesion_tmp->codigo."'";
			//~ $this->db->query($sql_update_dt);
			//~ echo $this->db->last_query();  // Mostrar el sql de la última consulta
			$j += 1;
		}
		
		// Consulta de actualización del campo id_nuevo para los detalles de sesiones temporales
		$sql_id2 = "SELECT id FROM detalle_sesion ORDER BY id DESC LIMIT 1";  // Buscamos el id del último detalle de sesión
		$query_id2 = $this->db->query($sql_id2);
		$query_id2 = $query_id2->row();
		//~ echo $query_id2->id;
		$sql_dtsesion_tmp = "SELECT * FROM detalle_sesion_temp ORDER BY id ASC";  // Consultamos los registros de la tabla temporal de detalles de sesiones
		$query_dtsesion_tmp = $this->db->query($sql_dtsesion_tmp);
		$query_dtsesion_tmp = $query_dtsesion_tmp->result();
		// Efectuamos la actualización del campo id_nuevo registro por registro
		$k = 1;
		foreach ($query_dtsesion_tmp as $dtsesion_tmp){
			//~ echo $dtsesion_tmp->id;
			$nuevo_id2 = array('id_nuevo' => $k+$query_id2->id);
			$update2 = $this->db->where('id', $dtsesion_tmp->id);
			$update2 = $this->db->update('detalle_sesion_temp', $nuevo_id2);
			$k += 1;
		}
		
		// Consulta de actualización del campo id_nuevo para las facturas temporales
		$sql_id3 = "SELECT id,codfactura FROM facturas ORDER BY id DESC LIMIT 1";  // Buscamos el id de la última factura
		$query_id3 = $this->db->query($sql_id3);
		$query_id3 = $query_id3->row();
		//~ echo $query_id3->id;
		$sql_facturas_tmp = "SELECT * FROM facturas_temp ORDER BY id ASC";  // Consultamos los registros de la tabla temporal de facturas
		$query_facturas_tmp = $this->db->query($sql_facturas_tmp);
		$query_facturas_tmp = $query_facturas_tmp->result();
		// Efectuamos la actualización del campo id_nuevo registro por registro
		$l = 1;
		foreach ($query_facturas_tmp as $factura_tmp){
			//~ echo $factura_tmp->id;
			// Actualizamos también los códigos de las facturas
			//~ $n_codigo = (int)$query_id3->codfactura;
			//~ $n_codigo = str_pad($l+$n_codigo, 8, '0', STR_PAD_LEFT);
			//~ $nuevo_id3 = array('id_nuevo' => $l+$query_id3->id,'codfactura' => $n_codigo);
			$nuevo_id3 = array('id_nuevo' => $l+$query_id3->id);
			$update3 = $this->db->where('id', $factura_tmp->id);
			$update3 = $this->db->update('facturas_temp', $nuevo_id3);
			//~ $sql_update_dtf = "UPDATE facturas_ps_temp SET codfactura = '".$n_codigo."' WHERE codfactura = '".$factura_tmp->codfactura."'";
			//~ $this->db->query($sql_update_dtf);
			//~ $sql_update_dts = "UPDATE detalle_sesion_temp SET cod_factura = '".$n_codigo."' WHERE cod_factura = '".$factura_tmp->codfactura."'";
			//~ $this->db->query($sql_update_dts);
			//~ echo $this->db->last_query();  // Mostrar el sql de la última consulta
			$l += 1;
		}
		
		// Consulta de actualización del campo id_nuevo para los detalles de facturas temporales
		$sql_id4 = "SELECT id,codfacturaps FROM facturas_ps ORDER BY id DESC LIMIT 1";  // Buscamos el id del último detalle de factura
		$query_id4 = $this->db->query($sql_id4);
		$query_id4 = $query_id4->row();
		//~ echo $query_id4->id;
		$sql_facturasps_tmp = "SELECT * FROM facturas_ps_temp ORDER BY id ASC";  // Consultamos los registros de la tabla temporal de facturas
		$query_facturasps_tmp = $this->db->query($sql_facturasps_tmp);
		$query_facturasps_tmp = $query_facturasps_tmp->result();
		// Efectuamos la actualización del campo id_nuevo registro por registro
		$m = 1;
		foreach ($query_facturasps_tmp as $facturaps_tmp){
			//~ echo $facturaps_tmp->id;
			// Actualizamos también los códigos de los detalles de facturas
			//~ $n_codigo = (int)$query_id4->codfacturaps;
			//~ $n_codigo = str_pad($m+$n_codigo, 8, '0', STR_PAD_LEFT);
			//~ $nuevo_id4 = array('id_nuevo' => $m+$query_id4->id,'codfacturaps' => $n_codigo);
			$nuevo_id4 = array('id_nuevo' => $m+$query_id4->id);
			$update4 = $this->db->where('id', $facturaps_tmp->id);
			$update4 = $this->db->update('facturas_ps_temp', $nuevo_id4);
			$m += 1;
		}
		
		// Consulta de actualización del campo id_nuevo para los terminales temporales
		$sql_id5 = "SELECT id, codigo FROM terminal ORDER BY id DESC LIMIT 1";  // Buscamos el id y código del último terminal
		$query_id5 = $this->db->query($sql_id5);
		$query_id5 = $query_id5->row();
		//~ echo $query_id6->id;
		$sql_terminales_tmp = "SELECT * FROM terminal_temp ORDER BY id ASC";  // Consultamos los registros de la tabla temporal de terminales
		$query_terminales_tmp = $this->db->query($sql_terminales_tmp);
		$query_terminales_tmp = $query_terminales_tmp->result();
		// Efectuamos la actualización del campo id_nuevo registro por registro
		$n = 1;
		foreach ($query_terminales_tmp as $terminal_tmp){
			$nuevo_id5 = array('id_nuevo' => $n+$query_id5->id);
			$update5 = $this->db->where('id', $terminal_tmp->id);
			$update5 = $this->db->update('terminal_temp', $nuevo_id5);
			$n += 1;
		}
		
		// Consulta de actualización del campo id_nuevo para los detalles de terminales temporales
		$sql_id6 = "SELECT id, cod_detalle FROM detalle_terminal ORDER BY id DESC LIMIT 1";  // Buscamos el id y código del último detalle de terminal
		$query_id6 = $this->db->query($sql_id6);
		$query_id6 = $query_id6->row();
		//~ echo $query_id6->id;
		$sql_dtterminal_tmp = "SELECT * FROM detalle_terminal_temp ORDER BY id ASC";  // Consultamos los registros de la tabla temporal de detalles de terminales
		$query_dtterminal_tmp = $this->db->query($sql_dtterminal_tmp);
		$query_dtterminal_tmp = $query_dtterminal_tmp->result();
		// Efectuamos la actualización del campo id_nuevo registro por registro
		$o = 1;
		foreach ($query_dtterminal_tmp as $dtterminal_tmp){
			$nuevo_id6 = array('id_nuevo' => $o+$query_id6->id);
			$update6 = $this->db->where('id', $dtterminal_tmp->id);
			$update6 = $this->db->update('detalle_terminal_temp', $nuevo_id6);
			$o += 1;
		}
		
		// Consulta de actualización del campo id_nuevo para los productos temporales
		$sql_id7 = "SELECT id, codigo FROM producto ORDER BY id DESC LIMIT 1";  // Buscamos el id y código del último producto
		$query_id7 = $this->db->query($sql_id7);
		$query_id7 = $query_id7->row();
		//~ echo $query_id6->id;
		$sql_producto_tmp = "SELECT * FROM producto_temp ORDER BY id ASC";  // Consultamos los registros de la tabla temporal de detalles de terminales
		$query_producto_tmp = $this->db->query($sql_producto_tmp);
		$query_producto_tmp = $query_producto_tmp->result();
		// Efectuamos la actualización del campo id_nuevo registro por registro
		$o = 1;
		foreach ($query_dtterminal_tmp as $producto_tmp){
			// Actualizamos también los códigos de los productos
			//~ $n_codigo = (int)$query_id4->codfacturaps;
			//~ $n_codigo = str_pad($m+$n_codigo, 8, '0', STR_PAD_LEFT);
			//~ $nuevo_id4 = array('id_nuevo' => $m+$query_id4->id,'codfacturaps' => $n_codigo);
			$nuevo_id7 = array('id_nuevo' => $o+$query_id7->id);
			$update7 = $this->db->where('id', $producto_tmp->id);
			$update7 = $this->db->update('detalle_terminal_temp', $nuevo_id6);
			$o += 1;
		}
		
		// Ahora subimos los datos nuevos de las tablas temporales a las tablas fijas
		// Preparamos una variable para contar las inserciones ejecutadas
		$num_insert = 0;
		// Carga de sesiones
		$campos_sess = "id_nuevo, codigo, cod_terminal, monto_caja, ventas_dia, fecha_inicio, ";
		$campos_sess .= "fecha_cierre, estatus, user_create_id, hora_inicio, hora_cierre";
		$sql_insert_sess = "INSERT INTO sesiones SELECT ".$campos_sess." FROM sesiones_temp WHERE codigo NOT IN (SELECT codigo FROM sesiones)";
		$this->db->query($sql_insert_sess);
		$campos_sess2 = "codigo, monto_caja, ventas_dia, fecha_cierre, estatus, hora_cierre";
		$sql_select_sess = "SELECT ".$campos_sess2." FROM sesiones_temp WHERE codigo IN (SELECT codigo FROM sesiones)";
		$resul_select_sess = $this->db->query($sql_select_sess);
		// Actualizamos los datos de las sesiones
		foreach($resul_select_sess->result() as $campos){
			//~ echo "Monto: ".$campos->monto_caja." Venta del dia: ".$campos->ventas_dia;
			$sql_update_sess = "";
			$sql_update_sess = "UPDATE sesiones SET monto_caja=".$campos->monto_caja.", ventas_dia=".$campos->ventas_dia.", ";
			$sql_update_sess .= "fecha_cierre='".$campos->fecha_cierre."', estatus='".$campos->estatus."', hora_cierre='".$campos->hora_cierre."' ";
			$sql_update_sess .= "WHERE codigo='".$campos->codigo."'";
			$this->db->query($sql_update_sess);
			//~ echo $this->db->last_query();
		}
		if(count($this->db->query($sql_insert_sess)) == 1){
			$num_insert += 1;
		}		
		
		// Carga de los detalles de sesión
		$campos_dtsess = "id_nuevo, cod_sesion, cod_factura";
		$sql_insert_dtsess = "INSERT INTO detalle_sesion SELECT ".$campos_dtsess." FROM detalle_sesion_temp WHERE cod_sesion NOT IN (SELECT cod_sesion FROM detalle_sesion)";
		$this->db->query($sql_insert_dtsess);
		if(count($this->db->query($sql_insert_dtsess)) == 1){
			$num_insert += 1;
		}
		
		// Carga de las facturas
		$campos_fact = "id_nuevo, pre_cod_factura, codfactura, codcliente, cliente, base_imponible, ";
		$campos_fact .= "iva, monto_iva, descuento, totalfactura, observaciones, motivo_anulacion, ";
		$campos_fact .= "estado, fecha_emision, hora_emision, monto_desc, condicion_pago, ";
		$campos_fact .= "monto_exento, subtotal, num_cheque, num_recibo, num_transf, num_control ";
		$sql_insert_fact = "INSERT INTO facturas SELECT ".$campos_fact." FROM facturas_temp WHERE codfactura NOT IN (SELECT codfactura FROM facturas)";
		$this->db->query($sql_insert_fact);
		if(count($this->db->query($sql_insert_fact)) == 1){
			$num_insert += 1;
		}
		
		// Carga de los detalles de las facturas
		$campos_dtfact = "id_nuevo, codfacturaps, codfactura, tipo, cod_producto_servicio, producto_servicio, ";
		$campos_dtfact .= "precio, cantidad, importe, monto_iva";
		$sql_insert_dtfact = "INSERT INTO facturas_ps SELECT ".$campos_dtfact." FROM facturas_ps_temp WHERE codfacturaps NOT IN (SELECT codfacturaps FROM facturas_ps)";
		$this->db->query($sql_insert_dtfact);
		if(count($this->db->query($sql_insert_dtfact)) == 1){
			$num_insert += 1;
		}
		
		// Limpiamos las tablas temporales
		$sql_truncate = "TRUNCATE sesiones_temp, detalle_sesion_temp, facturas_temp, facturas_ps_temp, terminal_temp, detalle_terminal_temp, producto_temp RESTART IDENTITY";
		$this->db->query($sql_truncate);
		
		return $num_insert;
		
    }
    
}
