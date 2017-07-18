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
 * @author fmedina
 */
class ControllersProveedores extends CI_Controller {

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
        $this->load->model('proveedores/ModelsProveedores');
        $this->load->model('tipo_proveedor/ModelsTipoProveedor');
        $this->load->model('topologia/ModelsEstado');
        $this->load->model('topologia/ModelsMunicipio');
        $this->load->model('topologia/ModelsParroquia');
        $this->load->model('busquedas_ajax/ModelsBusqueda');
    }

    function index() {
        $data['listar'] = $this->ModelsProveedores->obtenerProveedores();
        $this->load->view('proveedores/lista', $data);
    }

    function registrar() {
        $data['detalles_lista'] = $this->ModelsBusqueda->count_all_table('proveedor');
        $data['list_tipo'] = $this->ModelsTipoProveedor->obtenerTiposProveedores();
        $data['list_estado'] = $this->ModelsEstado->obtenerEstados();
        $this->load->view('proveedores/registrar', $data);
    }

    public function guardar() {

        $estatus = $this->input->post('estatus');
        if ($estatus == '') {
            $is_active = 'False';
        } else {
            $is_active = 'True';
        }
        $rif = $this->input->post('rif');
        if ($rif == '') {
            $rif = 'False';
        } else {
            $rif = 'True';
        }
        $acta_constitutiva = $this->input->post('acta_constitutiva');
        if ($acta_constitutiva == '') {
            $acta = 'False';
        } else {
            $acta = 'True';
        }
        $cedula_represen = $this->input->post('cedula_represen');
        if ($cedula_represen == '') {
            $representante = 'False';
        } else {
            $representante = 'True';
        }
        $autorizacion_represen = $this->input->post('autorizacion_represen');
        if ($autorizacion_represen == '') {
            $autorizacion = 'False';
        } else {
            $autorizacion = 'True';
        }
        $solvencia_laboral = $this->input->post('solvencia_laboral');
        if ($solvencia_laboral == '') {
            $solvencia = 'False';
        } else {
            $solvencia = 'True';
        }
        $snc = $this->input->post('snc');
        if ($snc == '') {
            $snc = 'False';
        } else {
            $snc = 'True';
        }
        $rcn = $this->input->post('rcn');
        if ($rcn == '') {
            $rcn = 'False';
        } else {
            $rcn = 'True';
        }
        $solvencia_ince = $this->input->post('solvencia_ince');
        if ($solvencia_ince == '') {
            $solvencia_ince = 'False';
        } else {
            $solvencia_ince = 'True';
        }
        $solvencia_sso = $this->input->post('solvencia_sso');
        if ($solvencia_sso == '') {
            $solvencia_sso = 'False';
        } else {
            $solvencia_sso = 'True';
        }

        $data = array(
            'codigo' => $this->input->post('codigo'),
            'tipo_proveedor' => $this->input->post('t_proveedor'),  // Tipo de proveedor
            'cirif' => $this->input->post('cirif'),
            'tipoproveedor' => $this->input->post('tipoproveedor'),  // Tipo de identificación
            'nombre' => $this->input->post('nombre'),
            'estado' => $this->input->post('estado'),
            'municipio' => $this->input->post('municipio'),
            'parroquia' => $this->input->post('parroquia'),
            'direccion' => $this->input->post('direccion'),
            'tlf' => $this->input->post('tlf'),
            'email' => $this->input->post('email'),
            'fechacreacion' => date('Y-m-d H:i:s'),
            'estatus' => $is_active,
            'rif' => $rif,
            'venc_cirif' => $this->input->post('venc_cirif'),
            'acta_constitutiva' => $acta,
            'cedula_represen' => $representante,
            'autorizacion_represen' => $autorizacion,
            'solvencia_laboral' => $solvencia,
            'venc_solvencia_laboral' => $this->input->post('venc_solvencia_laboral'),
            'snc' => $snc,
            'rcn' => $rcn,
            'venc_rcn' => $this->input->post('venc_rcn'),
            'solvencia_ince' => $solvencia_ince,
            'venc_solvencia_ince' => $this->input->post('venc_solvencia_ince'),
            'solvencia_sso' => $solvencia_sso,
            'venc_solvencia_sso' => $this->input->post('venc_solvencia_sso'),
//                'puntuacion' => $this->input->post('puntuacion'),
        );

        $datos = array(
            'idcontacto' => $this->input->post('codigo'),
            'nacionalidad' => $this->input->post('nacionalidad'),
            'cedula' => $this->input->post('cedula'),
            'nombres' => $this->input->post('nombres'),
            'apellidos' => $this->input->post('apellidos'),
            'telefono' => $this->input->post('telefono'),
            'correo' => $this->input->post('correo'),
            'fechacreacion' => date('Y-m-d H:i:s'),
        );
//        $result = $this->ModelsProveedores->insertarContacto($datos);
        $result = $this->ModelsProveedores->insertar($data, $datos);


        if ($result) {
            $param = array(
                'tabla' => 'proveedor',
                'codigo' => $this->input->post('codigo'),
                'accion' => 'Nuevo Proveedor',
                'fecha' => date('Y-m-d'),
                'hora' => date("h:i:s a"),
                'usuario' => $this->session->userdata['logged_in']['id'],
            );
            $this->MAuditoria->add($param);
            //redirect('proveedores/ControllersProveedores');
        }
    }

    function editar() {
        $data['id'] = $this->uri->segment(4);
        $data['editar'] = $this->ModelsProveedores->obtenerProveedor($data['id']);
        $data['list_tipo'] = $this->ModelsTipoProveedor->obtenerTiposProveedores();
        $data['list_estado'] = $this->ModelsEstado->obtenerEstados();
        $data['list_municipio'] = $this->ModelsMunicipio->obtenerMunicipios();
        $data['list_parroquia'] = $this->ModelsParroquia->obtenerParroquias();

        $this->load->view('proveedores/editar', $data);
    }

    function eliminar($id) {
        $result = $this->ModelsProveedores->eliminarProveedor($id);
        $param = array(
                'tabla' => 'proveedor',
                'codigo' => $id,
                'accion' => 'Eliminar Proveedor',
                'fecha' => date('Y-m-d'),
                'hora' => date("h:i:s a"),
                'usuario' => $this->session->userdata['logged_in']['id'],
            );
            $this->MAuditoria->add($param);
        if ($result) {

            
            redirect('proveedores/ControllersProveedores');
        }
    }

    function actualizar() {
        $estatus = $this->input->post('estatus');
        $codigo = $this->input->post('codigo');
        $estatus = $this->input->post('estatus');
        if ($estatus == '') {
            $is_active = 'False';
        } else {
            $is_active = 'True';
        }
        $rif = $this->input->post('rif');
        if ($rif == '') {
            $rif = 'False';
        } else {
            $rif = 'True';
        }
        $acta_constitutiva = $this->input->post('acta_constitutiva');
        if ($acta_constitutiva == '') {
            $acta = 'False';
        } else {
            $acta = 'True';
        }
        $cedula_represen = $this->input->post('cedula_represen');
        if ($cedula_represen == '') {
            $representante = 'False';
        } else {
            $representante = 'True';
        }
        $autorizacion_represen = $this->input->post('autorizacion_represen');
        if ($autorizacion_represen == '') {
            $autorizacion = 'False';
        } else {
            $autorizacion = 'True';
        }
        $solvencia_laboral = $this->input->post('solvencia_laboral');
        if ($solvencia_laboral == '') {
            $solvencia = 'False';
        } else {
            $solvencia = 'True';
        }
        $snc = $this->input->post('snc');
        if ($snc == '') {
            $snc = 'False';
        } else {
            $snc = 'True';
        }
        $rcn = $this->input->post('rcn');
        if ($rcn == '') {
            $rcn = 'False';
        } else {
            $rcn = 'True';
        }
        $solvencia_ince = $this->input->post('solvencia_ince');
        if ($solvencia_ince == '') {
            $solvencia_ince = 'False';
        } else {
            $solvencia_ince = 'True';
        }
        $solvencia_sso = $this->input->post('solvencia_sso');
        if ($solvencia_sso == '') {
            $solvencia_sso = 'False';
        } else {
            $solvencia_sso = 'True';
        }

        $data = array(
            'id' => $this->input->post('id'),
            'codigo' => $this->input->post('codigo'),
            'tipo_proveedor' => $this->input->post('t_proveedor'),  // Tipo de proveedor
            'cirif' => $this->input->post('cirif'),
            'tipoproveedor' => $this->input->post('tipoproveedor'),  // Tipo de identificación
            'nombre' => $this->input->post('nombre'),
            'estado' => $this->input->post('estado'),
            'municipio' => $this->input->post('municipio'),
            'parroquia' => $this->input->post('parroquia'),
            'direccion' => $this->input->post('direccion'),
            'tlf' => $this->input->post('tlf'),
            'email' => $this->input->post('email'),
            'fechacreacion' => date('Y-m-d H:i:s'),
            'estatus' => $is_active,
            'rif' => $rif,
            'venc_cirif' => $this->input->post('venc_cirif'),
            'acta_constitutiva' => $acta,
            'cedula_represen' => $representante,
            'autorizacion_represen' => $autorizacion,
            'solvencia_laboral' => $solvencia,
            'venc_solvencia_laboral' => $this->input->post('venc_solvencia_laboral'),
            'snc' => $snc,
            'rcn' => $rcn,
            'venc_rcn' => $this->input->post('venc_rcn'),
            'solvencia_ince' => $solvencia_ince,
            'venc_solvencia_ince' => $this->input->post('venc_solvencia_ince'),
            'solvencia_sso' => $solvencia_sso,
            'venc_solvencia_sso' => $this->input->post('venc_solvencia_sso'),
//                'puntuacion' => $this->input->post('puntuacion'),
        );

        $datos = array(
            'idcontacto' => $this->input->post('codigo'),
            'nacionalidad' => $this->input->post('nacionalidad'),
            'cedula' => $this->input->post('cedula'),
            'nombres' => $this->input->post('nombres'),
            'apellidos' => $this->input->post('apellidos'),
            'telefono' => $this->input->post('telefono'),
            'correo' => $this->input->post('correo'),
            'fechacreacion' => date('Y-m-d H:i:s'),
        );
        $result = $this->ModelsProveedores->actualizarContacto($datos);
        $result = $this->ModelsProveedores->actualizarCliente($data);


        if ($result) {
            $param = array(
                'tabla' => 'proveedor',
                'codigo' => $this->input->post('codigo'),
                'accion' => 'Editar Proveedor',
                'fecha' => date('Y-m-d'),
                'hora' => date("h:i:s a"),
                'usuario' => $this->session->userdata['logged_in']['id'],
            );
            $result = $this->MAuditoria->add($param);
            redirect('proveedores/ControllersProveedores');
        }
    }

}
