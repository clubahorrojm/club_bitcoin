<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CTiposCuenta
 *
 * @author Ing. José Solorzano
 */
class CTiposCuenta extends CI_Controller
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
        $this->load->model('configuracion/MTiposCuenta');
        $this->load->model('busquedas_ajax/ModelsBusqueda');
        $this->load->model('administracion/MAuditoria');
        
    }

    function index()
    {
        //Validacion de configuracion de primer uso
        //Al no existir registros por defecto carga algunos genéricos
        $data['listar'] = '';
        $ultimo_id = $this->ModelsBusqueda->count_all_table('conf_tipo_cuentas');
        if ($ultimo_id > 0){
            $data['listar'] = $this->MTiposCuenta->obtenerTiposCuenta();
        }
        else{
            $this->generar();  // Pre-carga de los tipos de cuenta básicos
            $data['listar'] = $this->MTiposCuenta->obtenerTiposCuenta();
            //~ redirect('configuracion/CTiposCuenta');
            //~ $data['listar'] = [];
        }
        $this->load->view('configuracion/tiposcuenta/lista', $data);
    }

    function registrar()
    {
        $data['ultimo_id']   = $this->ModelsBusqueda->count_all_table('conf_tipo_cuentas');
        $this->load->view('configuracion/tiposcuenta/registrar', $data);
    }
    
    //metodo para guardar un nuevo registro
    public function guardar()
    {

        $result = $this->MTiposCuenta->insertarTipoCuenta($this->input->post());
        if ($result) {
            
            $param = array(
                'tabla' => 'Tipos de Cuenta',
                'codigo' => $this->input->post('codigo'),
                'accion' => 'Registro de nuevo Tipo de Cuenta: '.$this->input->post('descripcion'),
                'fecha' => date('Y-m-d'),
                'hora' => date("h:i:s a"),
                'usuario' => $this->session->userdata['logged_in']['id'],
            );
            $this->MAuditoria->add($param);
            //redirect('configuracion/CBancos');
        }
    }

    //método para editar
    function editar()
    {
        $data['id']     = $this->uri->segment(4);
        $data['editar'] = $this->MTiposCuenta->obtenerTipoCuenta($data['id']);
        $this->load->view('configuracion/tiposcuenta/editar', $data);
    }
    
    //método para eliminar
    function eliminar($id)
    {
        $data = $this->MTiposCuenta->obtenerTipoCuenta($id);
        $result = $this->MTiposCuenta->eliminarTipoCuenta($id);
        $param = array(
            'tabla' => 'Tipos de Cuenta',
            'codigo' => $data[0]->codigo,
            'accion' => 'Eliminación de Tipo de Cuenta: '.$data[0]->descripcion,
            'fecha' => date('Y-m-d'),
            'hora' => date("h:i:s a"),
            'usuario' => $this->session->userdata['logged_in']['id'],
        );
        $this->MAuditoria->add($param);
    }

    //Método para actualizar
    function actualizar()
    {
        $result = $this->MTiposCuenta->actualizarTipoCuenta($this->input->post());
        if ($result) {
            
            $param = array(
                'tabla' => 'Tipos de Cuenta',
                'codigo' => $this->input->post('codigo'),
                'accion' => 'Edición de Tipo de Cuenta: '.$this->input->post('descripcion'),
                'fecha' => date('Y-m-d'),
                'hora' => date("h:i:s a"),
                'usuario' => $this->session->userdata['logged_in']['id'],
            );
            $this->MAuditoria->add($param);
            //redirect('configuracion/CBancos');
        }
    }
    
     // Método para activar/desactivar
    function activar_desactivar($id){
        $accion = $this->input->post('accion');
        $activo = true;
        if ($accion == 'desactivar'){
            $activo = false;
        }
        // Armamos la data a actualizar
        $data = array(
            'id' => $id,
            'activo' => $activo,
        );
        // Actualizamos el tipo de cuenta con los datos armados
        $result = $this->MTiposCuenta->actualizarTipoCuenta($data);
    }
    
    // Método de registro inicial de tipos de cuenta
    public function generar()
    {
        // Lectura de archivo csv
        $ruta = getcwd();  // Obtiene el directorio actual en donde se está trabajando
        $nombre_archivo = "tipos_cuentas.csv";
        $ubicacion_archivo = $ruta."/application/models/scripts/".$nombre_archivo;
        
        $fila = 0;

		if (($archivo = fopen("$ubicacion_archivo","r")) !== FALSE) {
			
			while(($data = fgetcsv($archivo, 1000, ";")) !== FALSE){
				$num_columnas = count($data);
				
					//~ echo $fila."->".$data[0]."->".$data[1];
					$consulta = $this->ModelsBusqueda->obtenerRegistro('conf_tipo_cuentas','codigo',$data[1]);  // El id del último tipo de cuenta registrado
					
					if(count($consulta) == 0){
						// Registro de nuevo tipo de cuenta
						// Preparamos los datos del nuevo tipo de cuenta
						$data_tipo_cuenta = array(
							'id' => $data[0],
							'codigo' => $data[1],
							'descripcion' => $data[2],
							'activo' => $data[3],
						);
						// Registramos los datos del nuevo tipo de cuenta
						$reg_tipo_cuenta = $this->MTiposCuenta->insertarTipoCuenta($data_tipo_cuenta);
						if ($reg_tipo_cuenta) {
							
							$param = array(
								'tabla' => 'Tipos de Cuenta',
								'codigo' => $data[1],
								'accion' => 'Registro de Nuevo Tipo de Cuenta',
								'fecha' => date('Y-m-d'),
								'hora' => date("h:i:s a"),
								'usuario' => $this->session->userdata['logged_in']['id'],
							);
							$this->MAuditoria->add($param);
						}
					}	
				
				$fila += 1;
			}

		}else{
			echo "Falla de lectura";
		}
	}
}

