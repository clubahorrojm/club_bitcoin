<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControllersClientes
 *
 * @authors fmedina, jsolorzano
 */
class ControllersAutoconsumo extends CI_Controller
{

    public function __construct()
    {


        parent::__construct();

// Load form helper library
        $this->load->helper('form');

        $this->load->helper(array('url'));

        $this->load->view('base');

// Load form validation library
        $this->load->library('form_validation');

// Load session library
        $this->load->library('session');

// Load database
        $this->load->model('administracion/MAuditoria');
        $this->load->model('autoconsumo/ModelsAutoconsumo');
        $this->load->model('productos/ModelsProductos');
        $this->load->model('impuesto/ModelsImpuesto');
        $this->load->model('topologia/ModelsEstado');
        $this->load->model('topologia/ModelsMunicipio');
        $this->load->model('topologia/ModelsParroquia');
        $this->load->model('busquedas_ajax/ModelsBusqueda');
        
    }

    function index()
    {

        $data['listar'] = $this->ModelsAutoconsumo->obtenerAutoconsumos();
        //~ $data['list_iva'] = $this->ModelsImpuesto->obtenerImpuestos();
        //~ $data['ultimo_id'] = $this->ModelsBusqueda->count_all_table('facturas');
        //~ $data['cod_factura'] = '';
        //~ if ($data['ultimo_id'] > 0){
			//~ $data['cod_factura'] = $this->ModelsAutoconsumo->obtenerFactura($data['ultimo_id']);
		//~ }
        $this->load->view('autoconsumo/lista.php', $data);
    }
    
    function autoconsumo()
    {

        $data['listar'] = $this->ModelsAutoconsumo->obtenerClientes();
        $data['list_iva'] = $this->ModelsImpuesto->obtenerImpuestos();
        $data['hora']= time();
        $data['ultimo_id'] = $this->ModelsBusqueda->count_all_table('autoconsumo');
        $data['cod_autoconsumo'] = '';
        if ($data['ultimo_id'] > 0){
			$data['cod_autoconsumo'] = $this->ModelsAutoconsumo->obtenerAutoconsumo($data['ultimo_id']);
		}
        $this->load->view('autoconsumo/autoconsumo.php', $data);
    }

    public function guardar()
    {	
		$ultimo_id = $this->ModelsBusqueda->count_all_table('autoconsumo');
		// Preparamos los datos generales de la factura
		$descuento = 0;
		if ($this->input->post('descuento') != ''){
			$descuento = $this->input->post('descuento');
		}
		// Formateamos la fecha de emisión a un formato manipulable en sql (Y-m-d)
		$fecha_emision = explode("-",$this->input->post('fecha_emision'));
		$fecha_emision = $fecha_emision[2]."-".$fecha_emision[1]."-".$fecha_emision[0];
		$data_consumo = array(
			'id' => $ultimo_id + 1,
			'codautoconsumo' => trim($this->input->post('codautoconsumo')),
			//~ 'pre_cod_factura' => trim($this->input->post('pre_cod_factura')),
			'codente' => $this->input->post('codente'),
			'ente' => $this->input->post('ente'),
			'base_imponible' => $this->input->post('base_imponible'),
			'monto_exento' => $this->input->post('monto_exento'),
			'monto_desc' => $this->input->post('monto_desc'),
			'monto_iva' => $this->input->post('monto_iva'),
			'iva' => $this->input->post('iva'),
			'descuento' => $descuento,
			'tipo_tratamiento' => $this->input->post('tipo_tratamiento'),
			'subtotal' => $this->input->post('subtotal'),
			'totalautoconsumo' => $this->input->post('totalautoconsumo'),
			'observaciones' => $this->input->post('observaciones'),
			'estado' => 1,
			'fecha_emision' => $fecha_emision,
			'hora_emision' => date("h:i:s a"),
			//~ 'fecha_vencimiento' => $this->input->post('fecha_vencimiento'),
        );
        
		// Guardamos los datos generales de la factura
		$result = $this->ModelsAutoconsumo->insertar($data_consumo);
		
		// Guardado en el módulo de auditoría
		if ($result) {

            $param = array(
                'tabla' => 'autoconsumo',
                'codigo' => trim($this->input->post('codautoconsumo')),
                'accion' => 'Nuevo Autoconsumo/Avería',
                'fecha' => date('Y-m-d'),
                'hora' => date("h:i:s a"),
                'usuario' => $this->session->userdata['logged_in']['id'],
            );
            $this->MAuditoria->add($param);
            //~ redirect('presupuesto/ControllersPresupuesto');
        }
        
        $data_autoconsumo_ps = $this->input->post('data');
        
        foreach ($data_autoconsumo_ps as $campos){
            print_r($campos);
            //Construcción del correlativo para el nuevo registro
            $ultimo_id = $this->ModelsBusqueda->count_all_table('autoconsumo_ps');
            //~ echo $ultimo_id;
            $correlativo_ps = str_pad($ultimo_id+1, 8, "0", STR_PAD_LEFT);  //Rellenamos con ceros a la izquierda
            //~ echo $correlativo_ps;
            
            // Registro del nuevo producto/servicio
            $data_f_ps = array(
				'id' => $ultimo_id + 1,
				'codautoconsumops' => $correlativo_ps,
				'codautoconsumo' => $campos['cod_autoconsumo'],
				'tipo' => $campos['tipo'],
				'cod_producto_servicio' => $campos['id'],
				'producto_servicio' => $campos['id_servicio'],
				'precio' => $campos['precio'],
				'monto_iva' => $campos['monto_iva'],
				'cantidad' => $campos['cantidad'],
				'importe' => $campos['importe'],
            );
            
			// Guardamos los datos de los productos/servicios del autoconsumo
            $result = $this->ModelsAutoconsumo->insertar_ps($data_f_ps);
        }
		//~ echo json_encode($data_autoconsumo_ps);
		//~ 
		
		
		// PROCESO DE DESCUENTO EN EL STOCK DE LOS PRODUCTOS
		// Consultamos los productos asociados al autoconsumo/avería
		$productos_servicios = $this->ModelsAutoconsumo->obtenerProductosServicios(trim($this->input->post('codautoconsumo')));  // Productos/Servicios asociados al autoconsumo/avería
		
		//~ print_r($productos_servicios);
		
		// Recorremos los productos/servicios
		foreach ($productos_servicios as $campos){
			
			// Primero validamos si el registro es un producto
			if ($campos->tipo == 1){
				//~ echo "El registro es un producto";
				//~ echo "Código del producto: ".$campos->cod_producto_servicio;
				
				// Obtenemos la existencia y el stock requerido actuales del producto
				$datos_producto = $this->ModelsBusqueda->obtenerRegistro('producto', 'codigo', $campos->cod_producto_servicio);
				
				// Preparamos la nueva existencia y stock requerido para el producto
				$id_produc = $datos_producto->id;
				$nueva_existencia = (int)$datos_producto->existencia-(int)$campos->cantidad;
				$nuevo_stock_req = (int)$datos_producto->stock_max-(int)$nueva_existencia;
				
				if ($nueva_existencia < 0){
					$nueva_existencia = 0;
				}
				
				if ($nuevo_stock_req < 0){
					$nuevo_stock_req = 0;
				}
				
				// Asignamos la nueva existencia y stock requerido para el producto
				$data_producto = array(
					'id' => $id_produc,
					'existencia' => $nueva_existencia,
					'stock_req' => $nuevo_stock_req,
				);
				
				// Actualizamos el stock del producto
				$result = $this->ModelsProductos->actualizarProducto($data_producto);
			}
        }
		
		redirect('autoconsumo/ControllersAutoconsumo');

    }
    

    function editar()
    {
        $data['codautoconsumo'] = $this->uri->segment(4);
        $data['editar'] = $this->ModelsBusqueda->obtenerRegistro('autoconsumo', 'codautoconsumo', $data['codautoconsumo']);  // Datos de la factura
        $data['listar'] = $this->ModelsAutoconsumo->obtenerClientes();  // Lista de clientes
        $data['list_iva'] = $this->ModelsImpuesto->obtenerImpuestos();  // Lista de tipos de IVA
        $data['hora']= time();  //Hora actual
        $data['listar_ps'] = $this->ModelsAutoconsumo->obtenerProductosServicios($data['codautoconsumo']);  // Lista de productos/servicios
        
        $this->load->view('autoconsumo/editar', $data);
    }


    function actualizar()
    
    {
        // Preparamos los datos generales de la factura
		$descuento = 0;
		if ($this->input->post('descuento') != ''){
			$descuento = $this->input->post('descuento');
		}
		
		// Formateamos la fecha de emisión a un formato manipulable en sql (Y-m-d)
		$fecha_emision = explode("-",$this->input->post('fecha_emision'));
		$fecha_emision = $fecha_emision[2]."-".$fecha_emision[1]."-".$fecha_emision[0];
		
		$regs_eliminar = $this->input->post('codigos_des');  // Productos/Servicios a desvincular del autoconsumo
		
		$data_consumo = array(
			'codautoconsumo' => trim($this->input->post('codautoconsumo')),
			//~ 'pre_cod_factura' => trim($this->input->post('pre_cod_factura')),
			'codente' => $this->input->post('codente'),
			'ente' => $this->input->post('ente'),
			'base_imponible' => $this->input->post('base_imponible'),
			'monto_exento' => $this->input->post('monto_exento'),
			'monto_desc' => $this->input->post('monto_desc'),
			'monto_iva' => $this->input->post('monto_iva'),
			'iva' => $this->input->post('iva'),
			'descuento' => $descuento,
			'tipo_tratamiento' => $this->input->post('tipo_tratamiento'),
			'subtotal' => $this->input->post('subtotal'),
			'totalautoconsumo' => $this->input->post('totalautoconsumo'),
			'observaciones' => $this->input->post('observaciones'),
			'estado' => 1,
			'fecha_emision' => $fecha_emision,
			//~ 'hora_emision' => date("h:i:s a"),
			//~ 'fecha_vencimiento' => $this->input->post('fecha_vencimiento'),
        );
        
		// Actualizamos los datos generales de la factura
		$result = $this->ModelsAutoconsumo->actualizarAutoconsumo($data_consumo);
		
		// Guardado en el módulo de auditoría
		if ($result) {

            $param = array(
                'tabla' => 'autoconsumo',
                'codigo' => trim($this->input->post('codautoconsumo')),
                'accion' => 'Editar Autoconsumo',
                'fecha' => date('Y-m-d'),
                'hora' => date("h:i:s a"),
                'usuario' => $this->session->userdata['logged_in']['id'],
            );
            $this->MAuditoria->add($param);
            //~ redirect('presupuesto/ControllersPresupuesto');
        }
        
        $data_autoconsumo_ps = $this->input->post('data');
        
        //~ print_r($data_autoconsumo_ps);
        
        // Verificamos si hay productos/servicios para asociar (registrar en autoconsumo_ps)
        foreach ($data_autoconsumo_ps as $campos){
			
			// Primero validamos si el producto/servicio ya tiene código, si es así entonces es que ya está asociado
			if ($campos['cod_f_ps'] == ""){
				echo "producto/servicio no existente";
				//Construcción del correlativo para el nuevo registro
				$ultimo_id = $this->ModelsBusqueda->count_all_table('autoconsumo_ps');
				//~ echo $ultimo_id;
				$correlativo_ps = str_pad($ultimo_id+1, 8, "0", STR_PAD_LEFT);  // Rellenamos con ceros a la izquierda hasta completar 8 dígitos
				//~ echo $correlativo_ps;
				
				// Registro del nuevo producto/servicio
				$data_f_ps = array(
					'id' => $ultimo_id + 1,
					'codautoconsumops' => $correlativo_ps,
					'codautoconsumo' => $campos['cod_autoconsumo'],
					'tipo' => $campos['tipo'],
					'cod_producto_servicio' => $campos['cod_ps'],
					'producto_servicio' => $campos['nom_ps'],
					'precio' => $campos['precio'],
					'monto_iva' => $campos['monto_iva'],
					'cantidad' => $campos['cantidad'],
					'importe' => $campos['importe'],
				);
				
				// Guardamos los datos de los nuevos productos/servicios del autoconsumo
				$result = $this->ModelsAutoconsumo->insertar_ps($data_f_ps);
				
				// PROCESO DE DESCUENTO EN EL STOCK DEL NUEVO PRODUCTO ASOCIADO
				// Primero validamos si el registro es un producto
				if ($campos['tipo'] == 1){
					//~ echo "El registro es un producto";
					//~ echo "Código del producto: ".$campos->cod_producto_servicio;
					
					// Obtenemos la existencia y el stock requerido actuales del producto
					$datos_producto = $this->ModelsBusqueda->obtenerRegistro('producto', 'codigo', $campos['cod_ps']);
					
					// Preparamos la nueva existencia y stock requerido para el producto
					$id_produc = $datos_producto->id;
					$nueva_existencia = (int)$datos_producto->existencia-(int)$campos['cantidad'];
					$nuevo_stock_req = (int)$datos_producto->stock_max-(int)$nueva_existencia;
					
					if ($nueva_existencia < 0){
						$nueva_existencia = 0;
					}
					
					if ($nuevo_stock_req < 0){
						$nuevo_stock_req = 0;
					}
					
					// Asignamos la nueva existencia y stock requerido para el producto
					$data_producto = array(
						'id' => $id_produc,
						'existencia' => $nueva_existencia,
						'stock_req' => $nuevo_stock_req,
					);
					
					// Actualizamos el stock del producto
					$result = $this->ModelsProductos->actualizarProducto($data_producto);
				}
			}else{
				echo "producto/servicio existente";
			}
        }
        
        // Verificamos si hay productos/servicios para eliminar
        if($regs_eliminar != ''){
			$regs_eliminar = explode(",",$regs_eliminar);
			
			// Desvinculamos (eliminamos de la tabla autoconsumo_ps)
			foreach ($regs_eliminar as $reg){
				//~ echo "Código: ".$reg;
				
				// Obtenemos los datos del producto/servicio
				$datos_ps = $this->ModelsBusqueda->obtenerRegistro('autoconsumo_ps', 'codautoconsumops', $reg);
				
				// Primero validamos si el registro es un producto
				if ($datos_ps->tipo == 1){
					//~ echo "El registro es un producto";
					//~ echo "Código del producto: ".$campos->cod_producto_servicio;
					
					// PROCESO DE REINTEGRO EN EL STOCK DEL PRODUCTO
					// Obtenemos la existencia y el stock requerido actuales del producto
					$datos_producto_e = $this->ModelsBusqueda->obtenerRegistro('producto', 'codigo', $datos_ps->cod_producto_servicio);
					
					// Preparamos la nueva existencia y stock requerido para el producto
					$id_produc = $datos_producto_e->id;
					$nueva_existencia = (int)$datos_producto_e->existencia+(int)$datos_ps->cantidad;
					$nuevo_stock_req = (int)$datos_producto_e->stock_max-(int)$nueva_existencia;
					
					if ($nueva_existencia < 0){
						$nueva_existencia = 0;
					}
					
					if ($nuevo_stock_req < 0){
						$nuevo_stock_req = 0;
					}
					
					// Asignamos la nueva existencia y stock requerido para el producto
					$data_producto = array(
						'id' => $id_produc,
						'existencia' => $nueva_existencia,
						'stock_req' => $nuevo_stock_req,
					);
					
					// Actualizamos el stock del producto
					$result = $this->ModelsProductos->actualizarProducto($data_producto);
				}
				
				// Eliminamos la asociación de la tabla autoconsumo_ps
				$result = $this->ModelsAutoconsumo->eliminarProductoServicio($reg);
			}
		}
        
    }
    
    // Método para anular o activar una factura
    function anular($cod)
    {
		//~ echo "Código: ".$cod;
		//~ echo "Acción: ".$this->input->post('accion');
		//~ echo "Motivo: ". $this->input->post('motivo');
		
		$accion = $this->input->post('accion');
		$estado = 1;
		
		if ($accion == 'anular'){
			$estado = 3;
		}
		
		// Armamos la data a actualizar
        $data_consumo = array(
			'codautoconsumo' => $cod,
			'estado' => $estado,
			'motivo_anulacion' => $this->input->post('motivo'),
        );
        
		// Actualizamos el autoconsumo con los datos armados
		$result = $this->ModelsAutoconsumo->actualizarAutoconsumo($data_consumo);
		
		// Guardado en el módulo de auditoría
		if ($result) {

            $param = array(
                'tabla' => 'autoconsumo',
                'codigo' => $cod,
                'accion' => 'Anular Autoconsumo',
                'fecha' => date('Y-m-d'),
                'hora' => date("h:i:s a"),
                'usuario' => $this->session->userdata['logged_in']['id'],
            );
            $this->MAuditoria->add($param);
            //~ redirect('autoconsumo/ControllersAutoconsumo');
        }
		
		
		// PROCESO DE REINTEGRO EN EL STOCK DE LOS PRODUCTOS
		// Consultamos los productos asociados al autoconsumo
		$productos_servicios = $this->ModelsAutoconsumo->obtenerProductosServicios($cod);  // Productos/Servicios asociados al autoconsumo
		
		//~ print_r($productos_servicios);
		
		// Recorremos los productos/servicios
		foreach ($productos_servicios as $campos){
			
			// Primero validamos si el registro es un producto
			if ($campos->tipo == 1){
				//~ echo "El registro es un producto";
				//~ echo "Código del producto: ".$campos->cod_producto_servicio;
				
				// Obtenemos la existencia y el stock requerido actuales del producto
				$datos_producto = $this->ModelsBusqueda->obtenerRegistro('producto', 'codigo', $campos->cod_producto_servicio);
				
				// Preparamos la nueva existencia y stock requerido para el producto
				$id_produc = $datos_producto->id;
				$nueva_existencia = (int)$datos_producto->existencia+(int)$campos->cantidad;
				$nuevo_stock_req = (int)$datos_producto->stock_max-(int)$nueva_existencia;
				
				if ($nueva_existencia < 0){
					$nueva_existencia = 0;
				}
				
				if ($nuevo_stock_req < 0){
					$nuevo_stock_req = 0;
				}
				
				// Asignamos la nueva existencia y stock requerido para el producto
				$data_producto = array(
					'id' => $id_produc,
					'existencia' => $nueva_existencia,
					'stock_req' => $nuevo_stock_req,
				);
				
				// Actualizamos el stock del producto
				$result = $this->ModelsProductos->actualizarProducto($data_producto);
			}
        }
    }
    
    
    // Método para pagar o activar una factura
    function ejecutar($cod)
    {
		//~ echo "Código: ".$cod;
		//~ echo "Acción: ".$this->input->post('accion');
		
		$accion = $this->input->post('accion');
		$estado = 1;
		
		if ($accion == 'ejecutar'){
			$estado = 2;
		}
		
		// Armamos la data a actualizar
        $data_consumo = array(
			'codautoconsumo' => $cod,
			'estado' => $estado,
			//~ 'condicion_pago' => $this->input->post('condicion'),
			//~ 'num_cheque' => $this->input->post('num_cheque'),
			//~ 'num_recibo' => $this->input->post('num_recibo'),
			//~ 'num_transf' => $this->input->post('num_transf'),
        );
        
		// Actualizamos el autoconsumo con los datos armados
		$result = $this->ModelsAutoconsumo->actualizarAutoconsumo($data_consumo);
		
		// Guardado en el módulo de auditoría
		if ($result) {

            $param = array(
                'tabla' => 'autoconsumo',
                'codigo' => $cod,
                'accion' => 'Ejecutar Autoconsumo',
                'fecha' => date('Y-m-d'),
                'hora' => date("h:i:s a"),
                'usuario' => $this->session->userdata['logged_in']['id'],
            );
            $this->MAuditoria->add($param);
            //~ redirect('presupuesto/ControllersPresupuesto');
        }
		
    }
    
    
    function pdf_autoconsumo($cod)
    {
        $data['autoconsumo'] = $this->ModelsAutoconsumo->obtenerAutoconsumoCod($cod);  // Datos generales del autoconsumo
        //~ $data['cliente'] = $this->ModelsAutoconsumo->obtenerClienteCod($data['autoconsumo']->codcliente);  // Datos del cliente
        $data['impuesto'] = $this->ModelsBusqueda->obtenerRegistro('impuesto', 'id', $data['autoconsumo']->iva);  // Datos del impuesto
        //~ print_r($data['autoconsumo']);
        //~ echo $data['autoconsumo']->codautoconsumo;
        $data['productos_servicios'] = $this->ModelsAutoconsumo->obtenerProductosServicios($data['autoconsumo']->codautoconsumo);  // Productos/Servicios asociados al autoconsumo
        //~ foreach ($data['productos_servicios'] as $campos){
			//~ print_r($campos);
		//~ }
        
        $this->load->view('autoconsumo/pdf/reporte_autoconsumo', $data);
    }
}
