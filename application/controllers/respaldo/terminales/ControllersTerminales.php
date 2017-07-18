<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControllersTopologia
 *
 * @author fmedina
 */
class ControllersTerminales extends CI_Controller {

    public function __construct() {


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
        $this->load->model('terminales/ModelsTerminales');
        $this->load->model('productos/ModelsProductos');
        $this->load->model('usuarios/Usuarios_model');
        $this->load->model('busquedas_ajax/ModelsBusqueda');  // Librería de consultas extra
    }

    function index() {
		$data['usuarios'] = $this->Usuarios_model->obtenerUsuarios();
        $data['listar'] = $this->ModelsTerminales->obtenerTerminales();
        $this->load->view('terminales/lista', $data);
    }

    function registrar() {
        $data['ultimo_id'] = $this->ModelsBusqueda->count_all_table('terminal');
        $data['usuarios'] = $this->ModelsTerminales->obtenerUsuarios();
        $data['productos'] = $this->ModelsProductos->obtenerProductosTerminales();
        $this->load->view('terminales/registrar', $data);
    }

    public function guardar() {
		$ultimo_id = $this->ModelsBusqueda->count_all_table('terminal');
		// Datos generales del terminal
		$data_terminal = array(
			'id' => $ultimo_id + 1,
			'codigo' => trim($this->input->post('codigo')),
			//~ 'pre_cod_presupuesto' => trim($this->input->post('pre_cod_presupuesto')),
			'nombre' => $this->input->post('nombre'),
			'usuario' => $this->input->post('usuario'),
			'fecha_create' => date('d-m-Y'),
			'user_create_id' => $this->session->userdata['logged_in']['id'],
        );

        $result = $this->ModelsTerminales->insertarTerminal($data_terminal);

        if ($result) {

            $param = array(
                'tabla' => 'terminal',
                'codigo' => trim($this->input->post('codigo')),
                'accion' => 'Nueva Terminal',
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
				//Construcción del correlativo para el nuevo registro
				$ultimo_id = $this->ModelsBusqueda->count_all_table('detalle_terminal');
				//~ echo $ultimo_id;
				$correlativo_ter = str_pad($ultimo_id+1, 8, "0", STR_PAD_LEFT);  // Rellenamos con ceros a la izquierda hasta completar 8 dígitos
				//~ echo $correlativo_ter;
				
				$iva = substr($campos['iva'], 0, -2);
				
				// Registro del nuevo producto
				$data_dt_ps = array(
					'id' => $ultimo_id + 1,
					'cod_detalle' => $campos['cod_terminal']."-".$correlativo_ter,
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
				
				// PROCESO DE DESCUENTO EN EL STOCK DE LOS PRODUCTOS
				// Obtenemos la existencia y el stock requerido actuales del producto
				$datos_producto = $this->ModelsBusqueda->obtenerRegistro('producto', 'codigo', $campos['cod_prod']);
				
				// Preparamos la nueva existencia y stock requerido para el producto
				$id_produc = $datos_producto->id;
				$nueva_existencia = (int)$datos_producto->existencia-(int)$campos['existencia'];
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
        //~ redirect('terminales/ControllersTerminales');
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
						'id' => $ultimo_id + 1,
						'cod_detalle' => $campos['cod_terminal']."-".$correlativo_ter,
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
					
					// PROCESO DE DESCUENTO EN EL STOCK DE LOS PRODUCTOS
					// Obtenemos la existencia y el stock requerido actuales del producto
					$datos_producto = $this->ModelsBusqueda->obtenerRegistro('producto', 'codigo', $campos['cod_prod']);
					
					// Preparamos la nueva existencia y stock requerido para el producto
					$id_produc = $datos_producto->id;
					$nueva_existencia = (int)$datos_producto->existencia-(int)$campos['existencia'];
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
    
    // Método para anular o activar una terminal
    function activar_desactivar($id)
    {
		//~ echo "Id: ".$id;
		
		$accion = $this->input->post('accion');
		$estatus = true;
		
		if ($accion == 'desactivar'){
			$estatus = false;
		}
		
		// Armamos la data a actualizar
        $data_terminal = array(
			'id' => $id,
			'estatus' => $estatus,
			'fecha_update' => date('d-m-Y'),
        );
        
		// Actualizamos el terminal con los datos armados
		$result = $this->ModelsTerminales->actualizarEstatusTerminal($data_terminal);
        
    }

}
