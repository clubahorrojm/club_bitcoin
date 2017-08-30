<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControllersBusqueda
 *
 * @author fmedina
 */
class ControllersBusqueda extends CI_Controller {
    
     public function __construct()
    {


        parent::__construct();
        $this->load->model('busquedas_ajax/ModelsBusqueda');
        $this->load->model('configuracion/MTiposMonedas');
    }
    
    // Método publico para traer las lineas estrategicas segun la asociacion con el plan de la nacion
    public function ajax_mun($id)
    {                                          #Campo         #Tabla                #ID
        $result = $this->ModelsBusqueda->search('estado', 'conf_municipio', $id);
        echo json_encode($result);
    }
    
     public function ajax_contacto($id)
    {                                          #Campo         #Tabla                #ID
        $result = $this->ModelsBusqueda->search('idcontacto', 'contacto', $id);
        echo json_encode($result);
    }
    

    
     public function ajax_parr($id_est, $id_mun)
    {                                          #Campo         #Tabla                #ID
        $result = $this->ModelsBusqueda->search_multiple_two('estado', 'municipio', 'conf_parroquia', $id_est, $id_mun);
        echo json_encode($result);
    }

    
      // 
    public function cargos($id)
    {            
        #Campo         #Tabla                #ID

        $result = $this->ModelsBusqueda->search_estatus_unidad($id);
        echo json_encode($result);
    }
    
    
     public function pais($id)
    {            
        #Campo         #Tabla                #ID

        $result = $this->ModelsBusqueda->pais($id);
        echo json_encode($result);
    }
    
      public function ciudadpais($id)
    {            
        #Campo         #Tabla                #ID

        $result = $this->ModelsBusqueda->CiudadPais($id);
        echo json_encode($result);
    }
    
    

    
      public function estado($id)
    {            
        #Campo         #Tabla                #ID

        $result = $this->ModelsBusqueda->Estado($id);
        echo json_encode($result);
    }
    
      
    public function BusquedaCiudad($id)
    {            
        #Campo         #Tabla                #ID

        $result = $this->ModelsBusqueda->Ciudad($id);
        echo json_encode($result);
    }
    
    public function Busq($id)
    {            
        #Campo         #Tabla                #ID

        $result = $this->ModelsBusqueda->Busq($id);
        echo json_encode($result);
    }

// Controlador para cargar lista general de productos
    public function producto()
    {                                       

        $result = $this->ModelsProductos->obtenerProductos();
        echo json_encode($result);
    }
    
    // Controlador para cargar la lista de productos para terminales
    public function productos_terminales()
    {     
        $result = $this->ModelsProductos->obtenerProductosTerminales();
        echo json_encode($result);
    }
    
    // Controlador para cargar lista de productos con existencia
    public function productos_existencia()
    {                                       

        $result = $this->ModelsProductos->obtenerProductosExistencia();
        echo json_encode($result);
    }
    
    // Controlador para cargar lista general de servicios
     public function servicios()
    {                                       

        $result = $this->ModelsServicios->obtenerServicios();
        echo json_encode($result);
    }
    
    // Método para obtener los datos de un producto/servicio específico
    public function datos_ps()
    {                                       
		$tabla = $this->input->post('tabla'); 
		$campo = $this->input->post('campo'); 
		$valor = $this->input->post('valor');
		
		//~ echo "Tabla: ".$tabla;
		//~ echo "Campo: ".$campo;
		//~ echo "Valor: ".$valor;
		
        $result = $this->ModelsBusqueda->obtenerRegistro($tabla, $campo, $valor);
        echo json_encode($result);
    }
         // Controlador para cargar lista general de servicios (BIENES)
     public function sub_grupos($id)
    {                                       
        $result = $this->ModelsBusqueda->search_sub_grupo($id);
        echo json_encode($result);
    }
       // Controlador para cargar lista general de servicios (BIENES)
     public function sub_categorias($id)
    {                                       
        $result = $this->ModelsBusqueda->search_sub_categorias($id);
        echo json_encode($result);
    }
    //(BIENES)
    public function topo_municipios($id)
    {                                       
        $result = $this->ModelsBusqueda->search_topo_municipios($id);
        echo json_encode($result);
    }
    // (BIENES)
     public function topo_parroquias($est, $mun)
    {
          $result = $this->ModelsBusqueda->search_topo_parroquias($est,$mun);
          echo json_encode($result);
    }
    //(BIENES)
     public function topo_ciudades($est, $mun)
    {                                       
        $result = $this->ModelsBusqueda->search_topo_ciudades($est, $mun);
        echo json_encode($result);
    }
    //(BIENES)
    public function bus_dependencias($id)
    {                                       
        $result = $this->ModelsBusqueda->search_bus_dependencias($id);
        echo json_encode($result);
    }
    //(BIENES)
    public function bus_unidades($org, $dep)
    {                                       
        $result = $this->ModelsBusqueda->search_bus_unidades($org, $dep);
        echo json_encode($result);
    }
     //(BIENES)
    public function bienes_modelos($id)
    {                                       
        $result = $this->ModelsBusqueda->search_bienes_modelos($id);
        echo json_encode($result);
    }
     //(BIENES)
    public function sub_clases($gru, $sub_gru)
    {                                       
        $result = $this->ModelsBusqueda->search_sub_clase($gru, $sub_gru);
        echo json_encode($result);
    }
     public function sub_cate_esp($cate, $sub_cate)
    {                                       
        $result = $this->ModelsBusqueda->search_sub_cate_esp($cate, $sub_cate);
        echo json_encode($result);
    }
      //(BIENES)
    public function bus_responsable($uni)
    {                                       
        $result = $this->ModelsBusqueda->search_bus_responsable($uni);
        echo json_encode($result);
    }
    //(BIENES)
    public function busqueda_serial($serial, $id_b)
    {                                       
        $result = $this->ModelsBusqueda->search_bus_serial($serial, $id_b);
        echo json_encode($result);
    }
    //(CONDOMINIOS)
    public function cod_recibo($inm)
    {                                       
        $result = $this->ModelsBusqueda->search_bus_codigo($inm);
        echo json_encode($result);
    }
    //(CONDOMINIOS)
    public function list_copro($inm)
    {                                       
        $result = $this->ModelsBusqueda->search_bus_copropietarios($inm);
        echo json_encode($result);
    }
    //(CONDOMINIOS)
    public function tot_deuda($copro)
    {                                       
        $result = $this->ModelsBusqueda->search_bus_deudas($copro);
        echo json_encode($result);
    }
    
    // Método para cargar lista de tipos de moneda
    public function monedas()
    {                                       
        $result = $this->MTiposMonedas->obtenerTipoMoneda();
        echo json_encode($result);
    }
    
    // Método para cargar lista de tipos de moneda
    public function busqueda_enlace($cod, $link)
    {
		$enlace = base_url().'index.php?codigo='.$cod.'&link='.$link;
		//~ echo $enlace;
        $result = $this->ModelsBusqueda->search_bus_link($enlace);
        echo json_encode($result);
    }
    public function busqueda_notificaciones(){
          $usuario = $this->session->userdata['logged_in']['id'];
          $result = 
          $data['lista_notificaciones'] = $this->ModelsBusqueda->search_notificaciones($usuario);
          echo json_encode($result);
    }
    public function actualizar_notifiaciones(){
          $usuario = $this->session->userdata['logged_in']['id'];
          $result = 
          $data['lista_notificaciones'] = $this->ModelsBusqueda->actualizar_notifiaciones($usuario);
          echo json_encode($result);
    }
}
