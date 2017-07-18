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
class ControllersPresupuesto extends CI_Controller
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
        $this->load->model('presupuesto/ModelsPresupuesto');
        $this->load->model('impuesto/ModelsImpuesto');
        $this->load->model('topologia/ModelsEstado');
        $this->load->model('topologia/ModelsMunicipio');
        $this->load->model('topologia/ModelsParroquia');
        $this->load->model('busquedas_ajax/ModelsBusqueda');
        
    }

    function index()
    {

        $data['listar'] = $this->ModelsPresupuesto->obtenerPresupuestos();
        //~ $data['list_iva'] = $this->ModelsImpuesto->obtenerImpuestos();
        //~ $data['ultimo_id'] = $this->ModelsBusqueda->count_all_table('presupuesto');
        //~ $data['cod_presupuesto'] = '';
        //~ if ($data['ultimo_id'] > 0){
			//~ $data['cod_presupuesto'] = $this->ModelsPresupuesto->obtenerPresupuesto($data['ultimo_id']);
		//~ }
        $this->load->view('presupuesto/lista.php', $data);
    }
    function presupuesto()
    {

        $data['listar'] = $this->ModelsPresupuesto->obtenerClientes();
        $data['list_iva'] = $this->ModelsImpuesto->obtenerImpuestos();
        $data['hora']= time();
        $data['ultimo_id'] = $this->ModelsBusqueda->count_all_table('presupuesto');
        $data['cod_presupuesto'] = '';
        if ($data['ultimo_id'] > 0){
			$data['cod_presupuesto'] = $this->ModelsPresupuesto->obtenerPresupuesto($data['ultimo_id']);
		}
        $this->load->view('presupuesto/presupuesto', $data);
    }

    public function guardar()
    {	
		// Preparamos los datos generales del presupuesto
		$descuento = 0;
		if ($this->input->post('descuento') != ''){
			$descuento = $this->input->post('descuento');
		}
		$data_presupuesto = array(
                'codpresupuesto' => trim($this->input->post('codpresupuesto')),
                //~ 'pre_cod_presupuesto' => trim($this->input->post('pre_cod_presupuesto')),
                'codcliente' => $this->input->post('codcliente'),
                'cliente' => $this->input->post('cliente'),
                'base_imponible' => $this->input->post('base_imponible'),
                'monto_exento' => $this->input->post('monto_exento'),
                'monto_desc' => $this->input->post('monto_desc'),
                'monto_iva' => $this->input->post('monto_iva'),
                'iva' => $this->input->post('iva'),
                'descuento' => $descuento,
                //~ 'condicion_pago' => $this->input->post('condicion_pago'),
                'subtotal' => $this->input->post('subtotal'),
                'totalpresupuesto' => $this->input->post('totalpresupuesto'),
                'observaciones' => $this->input->post('observaciones'),
                'estado' => 1,
                'fecha_emision' => $this->input->post('fecha_emision'),
                'hora_emision' => date("h:i:s a"),
                //~ 'fecha_vencimiento' => $this->input->post('fecha_vencimiento'),
        );
        
		// Guardamos los datos generales de la presupuesto
		$result = $this->ModelsPresupuesto->insertar($data_presupuesto);
		
		// Guardado en el módulo de auditoría
		if ($result) {

            $param = array(
                'tabla' => 'presupuesto',
                'codigo' => trim($this->input->post('codpresupuesto')),
                'accion' => 'Nuevo Presupuesto',
                'fecha' => date('Y-m-d'),
                'hora' => date("h:i:s a"),
                'usuario' => $this->session->userdata['logged_in']['id'],
            );
            $this->MAuditoria->add($param);
            //~ redirect('presupuesto/ControllersPresupuesto');
        }
        
        $data_presupuesto_ps = $this->input->post('data');
        
        //~ print_r($data_presupuesto_ps);
        
        foreach ($data_presupuesto_ps as $campos){
            //~ print_r($campos);
            //Construcción del correlativo para el nuevo registro
            $ultimo_id = $this->ModelsBusqueda->count_all_table('presupuesto_ps');
            //~ echo $ultimo_id;
            $correlativo_ps = str_pad($ultimo_id+1, 8, "0", STR_PAD_LEFT);  //Rellenamos con ceros a la izquierda
            //~ echo $correlativo_ps;
            
            // Registro del nuevo producto/servicio
            $data_p_ps = array(
				'codpresupuestops' => $correlativo_ps,
				'codpresupuesto' => $campos['cod_presupuesto'],
				'tipo' => $campos['tipo'],
				'cod_producto_servicio' => $campos['id'],
				'producto_servicio' => $campos['id_servicio'],
				'precio' => $campos['precio'],
				'monto_iva' => $campos['monto_iva'],
				'cantidad' => $campos['cantidad'],
				'importe' => $campos['importe'],
            );
            
			// Guardamos los datos de los productos/servicios del presupuesto
            $result = $this->ModelsPresupuesto->insertar_ps($data_p_ps);
        }
		//~ echo json_encode($data_presupuesto_ps);
		//~ 
		
		//redirect('presupuesto/ControllersPresupuesto');

    }

    function editar()
    {
        $data['codpresupuesto'] = $this->uri->segment(4);
        $data['editar'] = $this->ModelsBusqueda->obtenerRegistro('presupuesto', 'codpresupuesto', $data['codpresupuesto']);  // Datos del presupuesto
        $data['listar'] = $this->ModelsPresupuesto->obtenerClientes();  // Lista de clientes
        $data['list_iva'] = $this->ModelsImpuesto->obtenerImpuestos();  // Lista de tipos de IVA
        $data['hora']= time();  //Hora actual
        $data['listar_ps'] = $this->ModelsPresupuesto->obtenerProdustosServicios($data['codpresupuesto']);  // Lista de productos/servicios
        
        $this->load->view('presupuesto/editar', $data);
    }


    function actualizar()
    
    {
        // Preparamos los datos generales de la presupuesto
		$descuento = 0;
		if ($this->input->post('descuento') != ''){
			$descuento = $this->input->post('descuento');
		}
		
		$regs_eliminar = $this->input->post('codigos_des');  // Productos/Servicios a desvincular del presupuesto
		
		$data_presupuesto = array(
                'codpresupuesto' => trim($this->input->post('codpresupuesto')),
                //~ 'pre_cod_presupuesto' => trim($this->input->post('pre_cod_presupuesto')),
                'codcliente' => $this->input->post('codcliente'),
                'cliente' => $this->input->post('cliente'),
                'base_imponible' => $this->input->post('base_imponible'),
                'monto_exento' => $this->input->post('monto_exento'),
                'monto_desc' => $this->input->post('monto_desc'),
                'monto_iva' => $this->input->post('monto_iva'),
                'iva' => $this->input->post('iva'),
                'descuento' => $descuento,
                //~ 'condicion_pago' => $this->input->post('condicion_pago'),
                'subtotal' => $this->input->post('subtotal'),
                'totalpresupuesto' => $this->input->post('totalpresupuesto'),
                'observaciones' => $this->input->post('observaciones'),
                'estado' => 1,
                'fecha_emision' => $this->input->post('fecha_emision'),
                //~ 'hora_emision' => date("h:i:s a"),
                //~ 'fecha_vencimiento' => $this->input->post('fecha_vencimiento'),
        );
        
		// Actualizamos los datos generales de la presupuesto
		$result = $this->ModelsPresupuesto->actualizarPresupuesto($data_presupuesto);
		
		// Guardado en el módulo de auditoría
		if ($result) {

            $param = array(
                'tabla' => 'presupuesto',
                'codigo' => trim($this->input->post('codpresupuesto')),
                'accion' => 'Editar Presupuesto',
                'fecha' => date('Y-m-d'),
                'hora' => date("h:i:s a"),
                'usuario' => $this->session->userdata['logged_in']['id'],
            );
            $this->MAuditoria->add($param);
            //~ redirect('presupuesto/ControllersPresupuesto');
        }
        
        $data_presupuesto_ps = $this->input->post('data');
        
        //~ print_r($data_presupuesto_ps);
        
        // Verificamos si hay productos/servicios para asociar (registrar en presupuesto_ps)
        foreach ($data_presupuesto_ps as $campos){
			
			// Primero validamos si el producto/servicio ya tiene código, si es así entonces es que ya está asociado
			if ($campos['cod_f_ps'] == ""){
				echo "producto/servicio no existente";
				//Construcción del correlativo para el nuevo registro
				$ultimo_id = $this->ModelsBusqueda->count_all_table('presupuesto_ps');
				//~ echo $ultimo_id;
				$correlativo_ps = str_pad($ultimo_id+1, 8, "0", STR_PAD_LEFT);  // Rellenamos con ceros a la izquierda hasta completar 8 dígitos
				echo $correlativo_ps;
				
				// Registro del nuevo producto/servicio
				$data_p_ps = array(
					'codpresupuestops' => $correlativo_ps,
					'codpresupuesto' => $campos['cod_presupuesto'],
					'tipo' => $campos['tipo'],
					'cod_producto_servicio' => $campos['cod_ps'],
					'producto_servicio' => $campos['nom_ps'],
					'precio' => $campos['precio'],
					'monto_iva' => $campos['monto_iva'],
					'cantidad' => $campos['cantidad'],
					'importe' => $campos['importe'],
				);
				
				// Guardamos los datos de los nuevos productos/servicios del presupuesto
				$result = $this->ModelsPresupuesto->insertar_ps($data_p_ps);
			}else{
				echo "producto/servicio existente";
			}
        }
        
        // Verificamos si hay productos/servicios para eliminar
        if($regs_eliminar != ''){
			$regs_eliminar = explode(",",$regs_eliminar);
			
			// Desvinculamos (eliminamos de la tabla presupuesto_ps)
			foreach ($regs_eliminar as $reg){
				//~ echo "Código: ".$reg;
				
				// Eliminamos la asociación de la tabla presupuesto_ps
				$result = $this->ModelsPresupuesto->eliminarProductoServicio($reg);
			}
		}
        
    }
    
    //~ // Método para anular o activar una factura
    //~ function anular($cod)
    //~ {
		//~ echo "Código: ".$cod;
		//~ echo "Acción: ".$this->input->post('accion');
		//~ echo "Motivo: ". $this->input->post('motivo');
		//~ 
		//~ $accion = $this->input->post('accion');
		//~ $estado = 1;
		//~ 
		//~ if ($accion == 'anular'){
			//~ $estado = 3;
		//~ }
		//~ 
		//~ // Armamos la data a actualizar
        //~ $data_presupuesto = array(
			//~ 'codpresupuesto' => $cod,
			//~ 'estado' => $estado,
			//~ 'motivo_anulacion' => $this->input->post('motivo'),
        //~ );
        //~ 
		//~ // Actualizamos el presupuesto con los datos armados
		//~ $result = $this->ModelsPresupuesto->actualizarPresupuesto($data_presupuesto);
    //~ }
    
    function pdf_presupuesto($cod)
    {
        $data['presupuesto'] = $this->ModelsPresupuesto->obtenerPresupuestoCod($cod);  // Datos generales del presupuesto
        $data['cliente'] = $this->ModelsPresupuesto->obtenerClienteCod($data['presupuesto']->codcliente);  // Datos del cliente
        $data['impuesto'] = $this->ModelsBusqueda->obtenerRegistro('impuesto', 'id', $data['presupuesto']->iva);  // Datos del cliente
        //~ print_r($data['presupuesto']);
        //~ echo $data['presupuesto']->codpresupuesto;
        $data['productos_servicios'] = $this->ModelsPresupuesto->obtenerProdustosServicios($data['presupuesto']->codpresupuesto);  // Productos/Servicios asociados al presupuesto
        //~ foreach ($data['productos_servicios'] as $campos){
			//~ print_r($campos);
		//~ }
        
        $this->load->view('presupuesto/pdf/reporte_presupuesto', $data);
    }
}
