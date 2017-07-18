<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControllersPuntoVentas
 *
 * @author jsolorzano
 */
class ControllersPuntoVentas extends CI_Controller {

    public function __construct() {


        parent::__construct();

// Load form helper library
        $this->load->helper('form');

        $this->load->helper(array('download', 'file', 'url', 'html', 'form'));

        $this->load->view('base');

// Load form validation library
        $this->load->library('form_validation');

// Load session library
        $this->load->library('session');

// Load database
        $this->load->model('administracion/MAuditoria');
        $this->load->model('punto_venta/ModelsPuntoVentas');
        $this->load->model('factura/ModelsFacturar');
        $this->load->model('productos/ModelsProductos');
        $this->load->model('usuarios/Usuarios_model');
        $this->load->model('busquedas_ajax/ModelsBusqueda');  // Librería de consultas extra
    }
    
	
	// Método a ejecutar por defecto al cargar el módulo de punto de ventas
    function index() {
		
		// Procedemos a generar la data de la factura (correlativo y lista de productos relacionados a la terminal del usuario en sesión)
        $data['ultimo_id_factura'] = $this->ModelsBusqueda->count_all_table('facturas');
        
        $usuario = $this->session->userdata['logged_in']['id'];  // Id de usuario logueado
        $data['data_terminal'] = $this->ModelsBusqueda->obtenerRegistro('terminal', 'usuario', $usuario);
        $data['productos'] = $this->ModelsPuntoVentas->obtenerDetalles($data['data_terminal']->codigo);  // Lista general de productos
        $data['ultimo_cod_factura'] = $this->ModelsBusqueda->correlativo_pre('facturas',$data['data_terminal']->codigo);
        //~ $data['cod_factura'] = '';
        //~ if ($data['ultimo_id_factura'] > 0){
			//~ $data['cod_factura'] = $this->ModelsFacturar->obtenerFactura($data['ultimo_id_factura']);
		//~ }
		
		// Vemos si hay alguna sesion activa del usuario logueado
        $data['ultimo_id_sesion'] = $this->ModelsBusqueda->count_all_table('sesiones');
        $data['cod_sesion'] = "";
        $data['monto_caja'] = 0;
        $data['ventas_dia'] = 0;
        $data['monto_caja_total'] = 0;
        if($data['ultimo_id_sesion'] == 0){
			$correlativo_ss = $data['data_terminal']->codigo."-".str_pad($data['ultimo_id_sesion']+1, 8, "0", STR_PAD_LEFT);  //Rellenamos con ceros a la izquierda
			$data['cod_sesion'] = $correlativo_ss;
			$data_sesion = array(
				'id' => $data['ultimo_id_sesion']+1,
				'codigo' => $correlativo_ss,
				'cod_terminal' => $data['data_terminal']->codigo,
				'monto_caja' => 0,
				'ventas_dia' => 0,
				'fecha_inicio' => date("d-m-Y"),
				'hora_inicio' => date("h:i:s a"),
				'estatus' => 1,
				'user_create_id' => $this->session->userdata['logged_in']['id'],
			);
			$result_sesion = $this->ModelsPuntoVentas->insertarSesion($data_sesion);
		}else{
			$busqueda_sesion = $this->ModelsPuntoVentas->obtenerSesion($this->session->userdata['logged_in']['id']);
			if($busqueda_sesion){
				// Cargamos los montos de la caja
				$data['monto_caja'] = $busqueda_sesion->monto_caja;  // Monto inicial cargado en la caja
				$data['ventas_dia'] = $busqueda_sesion->ventas_dia;  // Monto de las ventas de la sesión actual
				$data['monto_caja_total'] = $busqueda_sesion->monto_caja+$busqueda_sesion->ventas_dia;  // Monto total sumando monto inicial de caja y el total de las ventas actuales
				$data['cod_sesion'] = $busqueda_sesion->codigo;
			}else{
				$correlativo_ss = $data['data_terminal']->codigo."-".str_pad($data['ultimo_id_sesion']+1, 8, "0", STR_PAD_LEFT);  //Rellenamos con ceros a la izquierda
				$data['cod_sesion'] = $correlativo_ss;
				$data['monto_caja'] = 0;
				$data['ventas_dia'] = 0;
				$data['monto_caja_total'] = 0;
				$data_sesion = array(
					'id' => $data['ultimo_id_sesion']+1,
					'codigo' => $correlativo_ss,
					'cod_terminal' => $data['data_terminal']->codigo,
					'monto_caja' => 0,
					'ventas_dia' => 0,
					'fecha_inicio' => date("d-m-Y"),
					'hora_inicio' => date("h:i:s a"),
					'estatus' => 1,
					'user_create_id' => $this->session->userdata['logged_in']['id'],
				);
				$result_sesion = $this->ModelsPuntoVentas->insertarSesion($data_sesion);
			}
		}
		
		// Llamamos a la vista
        $this->load->view('punto_venta/registrar', $data);
    }
    

    function registrar() {
        $data['ultimo_id'] = $this->ModelsBusqueda->count_all_table('terminal');
        $data['usuarios'] = $this->ModelsTerminales->obtenerUsuarios();
        $data['productos'] = $this->ModelsProductos->obtenerProductos();
        $this->load->view('terminales/registrar', $data);
    }
	
	// Método de guardado de facturas desde las terminales de venta
    public function guardar_venta() {
		
		// Generamos el id para la siguiente factura
		$ultimo_id = $this->ModelsBusqueda->count_all_table('facturas');
		
		// Obtenemos el código de la terminal de venta asociada al usuario logueado para generar el prefijo del correlativo
		$usuario = $this->session->userdata['logged_in']['id'];  // Id de usuario logueado
        $data_terminal = $this->ModelsBusqueda->obtenerRegistro('terminal', 'usuario', $usuario);
		
		// Preparamos los datos generales de la factura
		$data_factura = array(
			'id' => $ultimo_id+1,
			'codfactura' => $data_terminal->codigo."-".trim($this->input->post('codfactura')),
			//~ 'pre_cod_factura' => trim($this->input->post('pre_cod_factura')),
			'codcliente' => $this->input->post('codcliente'),
			'cliente' => $this->input->post('cliente'),
			'base_imponible' => $this->input->post('base_imponible'),
			//~ 'monto_exento' => $this->input->post('monto_exento'),
			//~ 'monto_desc' => $this->input->post('monto_desc'),
			'monto_iva' => $this->input->post('monto_iva'),
			//~ 'iva' => $this->input->post('iva'),
			//~ 'descuento' => $descuento,
			'condicion_pago' => '5',
			'subtotal' => $this->input->post('subtotal'),
			'totalfactura' => $this->input->post('totalfactura'),
			//~ 'observaciones' => $this->input->post('observaciones'),
			'estado' => 2,
			'fecha_emision' => date("d-m-Y"),
			'hora_emision' => date("h:i:s a"),
			//~ 'fecha_vencimiento' => $this->input->post('fecha_vencimiento'),
        );

        // Guardamos los datos generales de la factura
		$result = $this->ModelsFacturar->insertar($data_factura);

        if ($result) {
			
			// Guardamos el historial en la bitacora
            $param = array(
                'tabla' => 'facturas',
                'codigo' => $data_terminal->codigo."-".trim($this->input->post('codfactura')),
                'accion' => 'Nueva Factura',
                'fecha' => date('Y-m-d'),
                'hora' => date("h:i:s a"),
                'usuario' => $this->session->userdata['logged_in']['id'],
            );
            $this->MAuditoria->add($param);
            
            // PRODUCTOS A ASOCIAR
			$data_factura_ps = $this->input->post('data');
        
			foreach ($data_factura_ps as $campos){
				//~ print_r($campos);
				//Construcción del correlativo para el nuevo registro
				$ultimo_id = $this->ModelsBusqueda->count_all_table('facturas_ps');
				//~ echo $ultimo_id;
				$correlativo_ps = $data_terminal->codigo."-".str_pad($ultimo_id+1, 8, "0", STR_PAD_LEFT);  //Rellenamos con ceros a la izquierda
				//~ echo $correlativo_ps;
				
				// Registro del nuevo producto
				$data_f_ps = array(
					'id' => $ultimo_id+1,
					'codfacturaps' => $correlativo_ps,
					'codfactura' => $data_terminal->codigo."-".$campos['cod_factura'],
					'tipo' => 1,
					'cod_producto_servicio' => $campos['cod_prod'],
					'producto_servicio' => $campos['producto'],
					'precio' => $campos['precio'],
					'monto_iva' => $campos['monto_iva'],
					'cantidad' => $campos['cantidad'],
					'importe' => $campos['precio']*$campos['cantidad'],
				);
				
				// Guardamos los datos de los productos de la factura en la tabla 'factura_ps'
				$result = $this->ModelsFacturar->insertar_ps($data_f_ps);
				
				// PROCESO DE DESCUENTO DEL STOCK DE LOS PRODUCTOS EN LA TABLA DE 'detalles_terminal'
				// Datos de consulta del producto
				$cons_producto = array(
					'cod_terminal' => $data_terminal->codigo,
					'cod_producto' => $campos['cod_prod'],
				);
				// Consultamos los datos (existencia actual) del producto a descontarle la existencia
				$datos_producto = $this->ModelsPuntoVentas->obtenerIdDetalle($cons_producto);  // Datos del producto de 'detalle_terminal'
				
				// Preparamos la nueva existencia para el producto
				$id_produc = $datos_producto->id; 
				$cod_produc = $datos_producto->cod_detalle;
				$nueva_existencia = (int)$datos_producto->existencia-(int)$campos['cantidad'];
				
				if ($nueva_existencia < 0){
					$nueva_existencia = 0;
				}
				
				// Asignamos la nueva existencia para el producto en la tabla de 'detalles_terminal'
				$data_producto = array(
					'cod_detalle' => $cod_produc,
					'existencia' => $nueva_existencia,
				);
				
				// Actualizamos la nueva existencia del producto en la tabla de 'detalles_terminal'
				$result = $this->ModelsPuntoVentas->actualizarProductoTerminal($data_producto);
			}
			
			// Actualizamos los datos básicos de la sesión
            $busqueda_sesion = $this->ModelsPuntoVentas->obtenerSesion($this->session->userdata['logged_in']['id']);  // Datos de la sesión actual
            $datos_sesion = array(
                'codigo' => $this->input->post('cod_sesion'),
				//~ 'cod_terminal' => $this->input->post('cod_terminal'),
				'monto_caja' => $this->input->post('monto_caja'),
				'ventas_dia' => $busqueda_sesion->ventas_dia + $this->input->post('totalfactura'),
				//~ 'estatus' => 1,
				//~ 'user_create_id' => $this->session->userdata['logged_in']['id'],
            );
            //~ print_r($datos_sesion);
            $this->ModelsPuntoVentas->actualizarSesion($datos_sesion);
            
            // Registramos la factura en el detalle de la sesión (tabla 'detalle_sesion')
            $ultimo_iddts = $this->ModelsBusqueda->count_all_table('detalle_sesion');  //Último id de la tabla 'detalle_sesion'
            $factura_sesion = array(
				'id' => $ultimo_iddts+1,
                'cod_sesion' => $this->input->post('cod_sesion'),
                'cod_factura' => $data_terminal->codigo."-".trim($this->input->post('codfactura')),
            );
            //~ print_r($fatura_sesion);
            $this->ModelsPuntoVentas->insertarDetalleSesion($factura_sesion);
        }
        
        //~ redirect('terminales/ControllersTerminales');
    }
    
    
    // Método de cerrado de caja
    function cierre_caja() {
        // Registramos la factura en el detalle de la sesión (tabla 'detalle_sesion')
		$datos_sesion = array(
			'codigo' => $this->input->post('cod_sesion'),
			'fecha_cierre' => date("d-m-Y"),
			'hora_cierre' => date("h:i:s a"),
			'estatus' => '2',
		);
        $this->ModelsPuntoVentas->actualizarSesion($datos_sesion);
    }

    function editar() {
        $data['cod'] = $this->uri->segment(4);
        $data['usuarios'] = $this->ModelsTerminales->obtenerUsuarios();
        $data['productos'] = $this->ModelsTerminales->obtenerDetalles($data['cod']);
        $data['editar'] = $this->ModelsTerminales->obtenerTerminal($data['cod']);
        $this->load->view('terminales/editar', $data);
    }

    function eliminar($id) {
        $result = $this->ModelsTerminales->eliminarTerminal($id);
        $param = array(
                'tabla' => 'terminal',
                'codigo' => $id,
                'accion' => 'Eliminar Tipo de cliente',
                'fecha' => date('Y-m-d'),
                'hora' => date("h:i:s a"),
                'usuario' => $this->session->userdata['logged_in']['id'],
            );
            $this->MAuditoria->add($param);
        if ($result) {

            
            redirect('terminales/ControllersTerminales');
        }
    }

    function actualizar() {
		
		$regs_eliminar = $this->input->post('codigos_des');  // Productos a desvincular del terminal
		
		// Datos generales del terminal
		$data_terminal = array(
			'codigo' => trim($this->input->post('codigo')),
			//~ 'pre_cod_presupuesto' => trim($this->input->post('pre_cod_presupuesto')),
			'nombre' => $this->input->post('nombre'),
			'usuario' => $this->input->post('usuario'),
			'fecha_update' => date('d-m-Y'),
			'user_create_id' => $this->session->userdata['logged_in']['id'],
        );
		
        $result = $this->ModelsTerminales->actualizarTerminal($data_terminal);

        if ($result) {

            $param = array(
                'tabla' => 'terminal',
                'codigo' => $this->input->post('cod_tipo'),
                'accion' => 'Editar Terminal',
                'fecha' => date('Y-m-d'),
                'hora' => date("h:i:s a"),
                'usuario' => $this->session->userdata['logged_in']['id'],
            );
            $this->MAuditoria->add($param);
            
            // Productos a asociar
			$productos = $this->input->post('data');
			
			//~ print_r($productos);
			
			// Verificamos si hay productos para asociar (registrar en detalle_terminal)
			foreach ($productos as $campos){
				// Primero validamos si el producto ya tiene código, si es así entonces es que ya está asociado
				if ($campos['cod_dt'] == ""){
					echo "producto no existente";
					//Construcción del correlativo para el nuevo registro
					$ultimo_id = $this->ModelsBusqueda->count_all_table('detalle_terminal');
					//~ echo $ultimo_id;
					$correlativo_ter = str_pad($ultimo_id+1, 8, "0", STR_PAD_LEFT);  // Rellenamos con ceros a la izquierda hasta completar 8 dígitos
					//~ echo $correlativo_ter;
					
					$iva = substr($campos['iva'], 0, -2);
					
					// Registro del nuevo producto
					$data_dt_ps = array(
						'cod_detalle' => $correlativo_ter,
						'cod_terminal' => $campos['cod_terminal'],
						'cod_producto' => $campos['cod_prod'],
						'producto' => $campos['producto'],
						'precio' => $campos['precio'],
						'iva' => $iva,
						'monto_iva' => $campos['monto_iva'],
						'existencia' => $campos['existencia'],
					);
					
					// Guardamos los datos de los nuevos productos del terminal
					$result = $this->ModelsTerminales->insertar_dt($data_dt_ps);
				}else{
					echo "producto existente";
				}
			}
			
			// Verificamos si hay productos para eliminar
			if($regs_eliminar != ''){
				$regs_eliminar = explode(",",$regs_eliminar);
				
				// Desvinculamos (eliminamos de la tabla detalle_terminal)
				foreach ($regs_eliminar as $reg){
					//~ echo "Código: ".$reg;
					
					// Eliminamos la asociación de la tabla detalle_terminal
					$result = $this->ModelsTerminales->eliminarProducto($reg);
				}
			}
            
        }
    }

    function consultar() {
        $result = $this->ModelsBusqueda->existe_registro('terminales', 'terminales', $this->input->post('terminales'));
    }
    
    
    // Método para obtener los datos de un cliente específico
    public function datos_cliente()
    {                                       
		$tabla = $this->input->post('tabla'); 
		$tipo = $this->input->post('tipocliente');
		$cedula = $this->input->post('cedula');
		
		//~ echo "Tabla: ".$tabla;
		//~ echo "Campo1: ".$campo1;
		//~ echo "Valor1: ".$valor1;
		//~ echo "Campo2: ".$campo2;
		//~ echo "Valor2: ".$valor2;
		
        $result = $this->ModelsPuntoVentas->obtenerCliente($tabla, $tipo, $cedula);
        echo json_encode($result);
    }
    
    // Generación de reporte de ventas por punto de ventas
    function pdf_ventas($cod)
    {
        $data['sesion'] = $this->ModelsPuntoVentas->datosSesion($cod);  // Datos generales de la sesión
        $data['facturas'] = $this->ModelsPuntoVentas->obtenerDetallesSesion($cod);  // Códigos de las facturas de la sesión
        $data['terminal'] = $this->ModelsPuntoVentas->datosTerminal($data['sesion']->cod_terminal);  // Datos de la terminal
        $data['usuario'] = $this->ModelsPuntoVentas->datosUsuario($data['sesion']->user_create_id);  // Datos del usuario
        // Generamos una cadena con la lista de los códigos de las facturas
        $lista_facturas = "";
        foreach ($data['facturas'] as $codigo_factura){
			$lista_facturas .= "'".$codigo_factura->cod_factura."',";
		}
		// Quitamos la última coma de la cadena
		$lista_facturas = substr($lista_facturas,0,-1);
		// Construimos el condicional para sql de los detalles de la factura con la clausula IN()
		$lista_facturas = "IN($lista_facturas)";
		
		// Listamos las ventas específicas agrupadas por producto
		$data['ventas'] = $this->ModelsPuntoVentas->obtenerVentas($lista_facturas);		
        
        $this->load->view('punto_venta/pdf/reporte_ventas', $data);
    }
    
    
    // Generación de respaldo de ventas en formato.csv
    function archivo_respaldo()
    {
        // Listamos los datos de las tablas relacionadas con las ventas (sesiones, detalle_sesion, facturas, facturas_ps, producto)
		list($data['sesiones'], $data['detalle_sesiones'], $data['facturas'], $data['facturas_ps'], $data['terminal'], $data['detalle_terminal'], $data['producto']) = $this->ModelsPuntoVentas->respaldo_ventas();
        $lista_sesiones = "";
        
        // Generamos los archivos de respaldo
        $nombre_archivo = "sesiones_".date('dmY').".csv";
        $nombre_archivo2 = "detalle_sesiones_".date('dmY').".csv";
        $nombre_archivo3 = "facturas_".date('dmY').".csv";
        $nombre_archivo4 = "facturas_ps_".date('dmY').".csv";
        $nombre_archivo5 = "terminales_".date('dmY').".csv";
        $nombre_archivo6 = "detalle_terminales_".date('dmY').".csv";
        $nombre_archivo7 = "productos_".date('dmY').".csv";
        //~ if(file_exists($nombre_archivo))
		//~ {
			//~ $mensaje = "El Archivo $nombre_archivo se ha modificado";
		//~ }
		//~ else
		//~ {
			//~ $mensaje = "El Archivo $nombre_archivo se ha creado";
		//~ }
		// Abrimos el archivo de las sesiones
		if($archivo = fopen($nombre_archivo, "a"))
		{
			foreach ($data['sesiones'] as $sesion){
				$lista_sesiones = $sesion->id.";".$sesion->codigo.";".$sesion->cod_terminal.";".$sesion->monto_caja.";".$sesion->ventas_dia.";".$sesion->fecha_inicio.";";
				$lista_sesiones .= $sesion->fecha_cierre.";".$sesion->estatus.";".$sesion->user_create_id.";".$sesion->hora_inicio.";".$sesion->hora_cierre; 
			
				//~ if(fwrite($archivo, date("d m Y H:m:s"). " ". $mensaje. "\n"))
				if(fwrite($archivo, $lista_sesiones."\n"))
				{
					echo "Se ha ejecutado correctamente";
				}
				else
				{
					echo "Ha habido un problema al crear el archivo";
				}
			}
			fclose($archivo);  // Cerramos el archivo
		}
		
		// Abrimos el archivo de los detalles de sesiones
		if($archivo2 = fopen($nombre_archivo2, "a"))
		{
			foreach ($data['detalle_sesiones'] as $detalle_S){
				$lista_detalless = $detalle_S->id.";".$detalle_S->cod_sesion.";".$detalle_S->cod_factura;
			
				//~ if(fwrite($archivo, date("d m Y H:m:s"). " ". $mensaje. "\n"))
				if(fwrite($archivo2, $lista_detalless."\n"))
				{
					echo "Se ha ejecutado correctamente";
				}
				else
				{
					echo "Ocurrió un problema al crear el archivo";
				}
			}
			fclose($archivo2);  // Cerramos el archivo
		}
		
		// Abrimos el archivo de las facturas
		if($archivo3 = fopen($nombre_archivo3, "a"))
		{
			foreach ($data['facturas'] as $factura){
				$lista_facturas = $factura->id.";".$factura->pre_cod_factura.";".$factura->codfactura.";".$factura->codcliente.";".$factura->cliente.";".$factura->base_imponible.";".$factura->iva.";".$factura->monto_iva.";";
				$lista_facturas .= $factura->descuento.";".$factura->totalfactura.";".$factura->observaciones.";".$factura->motivo_anulacion.";".$factura->estado.";";
				$lista_facturas .= $factura->fecha_emision.";".$factura->hora_emision.";".$factura->monto_desc.";".$factura->condicion_pago.";".$factura->monto_exento.";";
				$lista_facturas .= $factura->subtotal.";".$factura->num_cheque.";".$factura->num_recibo.";".$factura->num_transf.";".$factura->num_control; 
			
				//~ if(fwrite($archivo, date("d m Y H:m:s"). " ". $mensaje. "\n"))
				if(fwrite($archivo3, $lista_facturas."\n"))
				{
					echo "Se ha ejecutado correctamente";
				}
				else
				{
					echo "Ha habido un problema al crear el archivo";
				}
			}
			fclose($archivo3);  // Cerramos el archivo
		}
		
		// Abrimos el archivo de los detalles de la factura
		if($archivo4 = fopen($nombre_archivo4, "a"))
		{
			foreach ($data['facturas_ps'] as $detalle_F){
				$lista_detallesf = $detalle_F->id.";".$detalle_F->codfacturaps.";".$detalle_F->codfactura.";".$detalle_F->tipo.";".$detalle_F->cod_producto_servicio.";";
				$lista_detallesf .= $detalle_F->producto_servicio.";".$detalle_F->precio.";".$detalle_F->cantidad.";".$detalle_F->importe.";".$detalle_F->monto_iva; 
			
				//~ if(fwrite($archivo, date("d m Y H:m:s"). " ". $mensaje. "\n"))
				if(fwrite($archivo4, $lista_detallesf."\n"))
				{
					echo "Se ha ejecutado correctamente";
				}
				else
				{
					echo "Ha habido un problema al crear el archivo";
				}
			}
			fclose($archivo4);  // Cerramos el archivo
		}
		
		// Abrimos el archivo de los terminales de venta
		if($archivo5 = fopen($nombre_archivo5, "a"))
		{
			foreach ($data['terminal'] as $terminal){
				$lista_terminales = $terminal->id.";".$terminal->codigo.";".$terminal->usuario.";";
				$lista_terminales .= $terminal->fecha_create.";".$terminal->fecha_update; 
			
				//~ if(fwrite($archivo, date("d m Y H:m:s"). " ". $mensaje. "\n"))
				if(fwrite($archivo5, $lista_terminales."\n"))
				{
					echo "Se ha ejecutado correctamente";
				}
				else
				{
					echo "Ha habido un problema al crear el archivo";
				}
			}
			fclose($archivo5);  // Cerramos el archivo
		}
		
		// Abrimos el archivo de los detalles del terminal de venta
		if($archivo6 = fopen($nombre_archivo6, "a"))
		{
			foreach ($data['detalle_terminal'] as $detalle_T){
				$lista_detallest = $detalle_T->id.";".$detalle_T->cod_detalle.";".$detalle_T->cod_terminal.";".$detalle_T->cod_producto.";";
				$lista_detallest .= $detalle_T->producto.";".$detalle_T->precio.";".$detalle_T->existencia.";".$detalle_T->iva.";".$detalle_T->monto_iva;
			
				//~ if(fwrite($archivo, date("d m Y H:m:s"). " ". $mensaje. "\n"))
				if(fwrite($archivo6, $lista_detallest."\n"))
				{
					echo "Se ha ejecutado correctamente";
				}
				else
				{
					echo "Ha habido un problema al crear el archivo";
				}
			}
			fclose($archivo6);  // Cerramos el archivo
		}
		
		// Abrimos el archivo de los productos
		if($archivo7 = fopen($nombre_archivo7, "a"))
		{
			foreach ($data['producto'] as $producto){
				$lista_productos = $producto->id.";".$producto->codigo.";".$producto->tipoproducto.";".$producto->nombre.";";
				$lista_productos .= $producto->descripcion.";".$producto->cantidad.";".$producto->stock_max.";".$producto->stock_min.";";
				$lista_productos .= $producto->stock_req.";".$producto->ganancia.";".$producto->precio_unitario.";".$producto->iva.";";
				$lista_productos .= $producto->unidad_medida.";".$producto->tiempo_utilidad.";".$producto->proveedor.";".$producto->monto_iva.";";
				$lista_productos .= $producto->precio_total.";".$producto->existencia;
			
				//~ if(fwrite($archivo, date("d m Y H:m:s"). " ". $mensaje. "\n"))
				if(fwrite($archivo7, $lista_productos."\n"))
				{
					echo "Se ha ejecutado correctamente";
				}
				else
				{
					echo "Ha habido un problema al crear el archivo";
				}
			}
			fclose($archivo7);  // Cerramos el archivo
		}
		
		//~ print_r($lista_sesiones);
		
		// Creamos el archivo .zip para almacenar los archivos respaldados
		$zip = new ZipArchive;
		$zip->open("respaldos_".date('dmY').".zip",ZipArchive::CREATE);
		// Añadimos los archivos respaldados al archivo .zip
		$zip->addFile($nombre_archivo);
		$zip->addFile($nombre_archivo2);
		$zip->addFile($nombre_archivo3);
		$zip->addFile($nombre_archivo4);
		$zip->addFile($nombre_archivo5);
		$zip->addFile($nombre_archivo6);
		$zip->addFile($nombre_archivo7);
		// Cerramos el archivo comprimido
		$zip->close();
		
		// Eliminamos los archivos .csv puesto que ya no son necesarios 
		unlink($nombre_archivo);
		unlink($nombre_archivo2);
		unlink($nombre_archivo3);
		unlink($nombre_archivo4);
		unlink($nombre_archivo5);
		unlink($nombre_archivo6);
		unlink($nombre_archivo7);
		
		return "respaldos_".date('dmY').".zip";
		
    }
    
    // Carga (importación) de respaldos de ventas en formato.csv
    function carga_archivo($nombre_archivo)
    {
		//~ echo $nombre_archivo;
		//~ echo getcwd();
		
		// Sección de carga del archivo en el servidor
		$ruta = getcwd();  // Obtiene el directorio actual en donde se esta trabajando
		
        //~ echo $nombre_archivo;
        
        //~ print_r($_POST);
        //~ print_r($_FILES['archivo']);
        
        if (move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta."/respaldos/".$nombre_archivo)) {
			echo "El fichero es válido y se subió con éxito.\n";
			// Sección para descompresión del archivo
			$zip = new ZipArchive;
			if ($zip->open($ruta."/respaldos/".$nombre_archivo) === TRUE) {
				$zip->extractTo($ruta."/respaldos/");  // Indicamos la ruta donde vamos a descomprimir los respaldos
				$zip->close();
				echo 'ok';
			} else {
				echo 'failed';
			}
		} else {
			echo "¡Posible ataque de subida de ficheros!\n";
		}
        
        // Leemos y cargamos los archivos en las tablas correspondientes en la base de datos
        // Lectura
        //~ $fp = fopen($ubicacion_archivo, "r");
//~ 
		//~ while(!feof($fp)) {
//~ 
		//~ $linea = fgets($fp);
//~ 
		//~ echo $linea . "\n";
//~ 
		//~ }
//~ 
		//~ fclose($fp);
		
		// Ejecutamos el método de carga de los csv
		$result = $this->ModelsPuntoVentas->carga_respaldo($nombre_archivo);
		
		echo "num_insert".$result;
	}

}
