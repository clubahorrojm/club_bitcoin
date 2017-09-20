<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuarios
 *
 * @author Ing. Francis Medina
 */
class Usuarios extends CI_Controller {

    public function __construct() {
        parent::__construct();

// Load form helper library
        $this->load->helper('form');

        $this->load->helper(array('url'));

        $this->load->view('base2');

// Load form validation library
        $this->load->library('form_validation');

// Load session library
        $this->load->library('session');

// Load database
        $this->load->model('Login_database');
        $this->load->model('configuracion/usuarios/Usuarios_model');
        $this->load->model('administracion/MAuditoria');
        $this->load->model('busquedas_ajax/ModelsBusqueda');
        $this->load->model('configuracion/grupos_usuarios/ModelsGruposUsuarios');
    }

    function index() {
        $data['listar'] = $this->Usuarios_model->obtenerUsuarios();
        $data['grupos_usuarios'] = $this->ModelsGruposUsuarios->obtenerGrupoUsuario();
        $this->load->view('configuracion/usuarios/lista', $data);
    }

    function registrar() {
        //$data['list_cargos'] = $this->ModelsCargos->estatus_cargos();
        $data['ultimo_id'] = $this->ModelsBusqueda->count_all_table('usuarios');
        $data['list_grupos'] = $this->ModelsGruposUsuarios->obtenerGrupoUsuario();
        $this->load->view('configuracion/usuarios/registrar', $data);
    }

    function editar() {

        $data['id'] = $this->uri->segment(5);

        $data['password'] = sha1(('password'));
        //$data['list_cargos'] = $this->ModelsCargos->estatus_cargos();
        $data['list_grupos'] = $this->ModelsGruposUsuarios->obtenerGrupoUsuario();
        $data['editar'] = $this->Usuarios_model->obtenerUsuario($data['id']);
        $this->load->view('configuracion/usuarios/editar', $data);
    }
    
    
    
    function perfil() {

        $data['id'] = $this->uri->segment(5);
        $data['list_cargos'] = $this->ModelsCargos->estatus_cargos();
        $data['list_grupos'] = $this->ModelsGruposUsuarios->obtenerGrupoUsuario();
        $data['editar'] = $this->Usuarios_model->obtenerUsuario($data['id']);
        $this->load->view('configuracion/usuarios/perfil', $data);
    }

    function eliminar() {
        $id = $this->uri->segment(5);
        $this->Usuarios_model->eliminar($id);
        $param = array(
            'tabla' => 'usuarios',
            'codigo' => $id,
            'accion' => 'Eliminación de Usuario',
            'fecha' => date('Y-m-d'),
            'hora' => date("h:i:s a"),
            'usuario' => $this->session->userdata['logged_in']['id'],
        );
        $this->MAuditoria->add($param);
        redirect('configuracion/usuarios/Usuarios/');
    }

    // Método para anular o activar un usuario
    function activar_desactivar($id) {
        //~ echo "Id: ".$id;

        $accion = $this->input->post('accion');
        $estatus = true;

        if ($accion == 'desactivar') {
            $estatus = false;
        }

        // Armamos la data a actualizar
        $data_usuario = array(
            'id' => $id,
            'estatus' => $estatus,
            'fecha_update' => date('Y-m-d'),
        );

        // Actualizamos el usuario con los datos armados
        $result = $this->Usuarios_model->actualizar($id, $data_usuario);

//		 Guardado en el módulo de auditoría
        if ($result) {

            $param = array(
                'tabla' => 'Usuarios',
                'codigo' => $id,
                'accion' => "Se desactivo el usuario",
                'fecha' => date('Y-m-d'),
                'hora' => date("h:i:s a"),
                'usuario' => $this->session->userdata['logged_in']['id'],
            );
            $this->MAuditoria->add($param);
        }
    }

    function actualizar() {
        echo "ACTUALIZAR";

        $u = $this->input->post('cedula');
        
        //$mi_archivo = 'picture';
        //$config['upload_path'] = "uploads";
        //$config['allowed_types'] = 'gif|jpg|png';
        //$config['allowed_types'] = "*";
        //print_r($_FILES['picture']['name']);

        //if (($_FILES['picture']['name']) == '') {
            

//            $data = array(
//                'id' => $this->input->post('id'),
//                'username' => $this->input->post('username'),
//                'email' => $this->input->post('email'),
//                'password' => 'pbkdf2_sha256$12000$' . hash("sha256", $this->input->post('password')),
//                'cedula' => $this->input->post('cedula'),
//                'first_name' => $this->input->post('first_name'),
//                'last_name' => $this->input->post('last_name'),
//                'tipo_usuario' => $this->input->post('tipo_usuario'),
//                'cargo' => $this->input->post('cargo'),
//                'telefono' => $this->input->post('telefono'),
//                'estatus' => $this->input->post('estatus'),
//                'fecha_create' => date('Y-m-d H:i:s'),
//                'fecha_update' => date('Y-m-d H:i:s'),
//                'user_create_id' => $this->input->post('user_create_id'),
//      
//            );
//
////            print_r($data);
//         
//            $codigo_seg = 'pbkdf2_sha256$12000$'.hash( "sha256", $this->input->post('codigo_seg'));
//            $result = $this->Usuarios_model->actualizar($codigo_seg, $data['id'], $data);
//            
//            if ($result) {
//                $param = array(
//                    'tabla' => 'usuarios',
//                    'codigo' => $this->input->post('id'),
//                    'accion' => 'Edición de Usuario',
//                    'fecha' => date('Y-m-d'),
//                    'hora' => date("h:i:s a"),
//                    'usuario' => $this->session->userdata['logged_in']['id'],
//                );
//                $this->MAuditoria->add($param);
//                redirect('configuracion/usuarios/usuarios');
//            }
//        } else {
//            $u = $this->input->post('cedula');
//
//            $mi_archivo = 'picture';
//            $config['upload_path'] = "uploads";
//            $config['allowed_types'] = 'gif|jpg|png';
//            $config['allowed_types'] = "*";
//            if (!empty($_FILES['picture']['name'])) {
//                $config['upload_path'] = 'uploads/images/';
//                $config['allowed_types'] = 'gif|jpg|png';
//                $config['overwrite'] = TRUE;
//                $config['max_size'] = '100';
//                $config['max_width'] = '1024';
//                $config['max_height'] = '768';
//
//                $config['file_name'] = $u . $_FILES['name'];
//
//                // Cargamos la configuración del Archivo 1
//                $this->upload->initialize($config);
//
//                // Subimos archivo 1
//                if ($this->upload->do_upload('picture')) {
//                    $data = $this->upload->data();
//                    $picture = $data['file_name'];
//                } else {
//                    $picture = '';
//                    echo $this->upload->display_errors();
//                    return;
//                }
//            } else {
//                echo 'Exitoso';
//                $picture = '';
//            }


            $data = array(
                'id' => $this->input->post('id'),
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'password' => 'pbkdf2_sha256$12000$' . hash("sha256", $this->input->post('password')),
                'cedula' => $this->input->post('cedula'),
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'tipo_usuario' => $this->input->post('tipo_usuario'),
                'cargo' => $this->input->post('cargo'),
                'telefono' => $this->input->post('telefono'),
                'estatus' => $this->input->post('estatus'),
                'fecha_create' => date('Y-m-d H:i:s'),
                'fecha_update' => date('Y-m-d H:i:s'),
                'user_create_id' => $this->input->post('user_create_id'),
                //'picture' => $picture,
            );
            
            $codigo_seg = 'pbkdf2_sha256$12000$'.hash( "sha256", $this->input->post('codigo_seg'));
            $result = $this->Usuarios_model->actualizar($codigo_seg, $data['id'], $data);

            if ($result) {
                $param = array(
                    'tabla' => 'usuarios',
                    'codigo' => $this->input->post('id'),
                    'accion' => 'Edición de Usuario',
                    'fecha' => date('Y-m-d'),
                    'hora' => date("h:i:s a"),
                    'usuario' => $this->session->userdata['logged_in']['id'],
                );
                $this->MAuditoria->add($param);
                redirect('configuracion/usuarios/usuarios');
            }
        //}
    }
    
    function update() {


        $u = $this->input->post('cedula');
        
        $mi_archivo = 'picture';
        $config['upload_path'] = "uploads";
        $config['allowed_types'] = 'gif|jpg|png';
        $config['allowed_types'] = "*";
        print_r($_FILES['picture']['name']);

        if (($_FILES['picture']['name']) == '') {
            

            $data = array(
                'id' => $this->input->post('id'),
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
//                'password' => 'pbkdf2_sha256$12000$' . hash("sha256", $this->input->post('password')),
                'cedula' => $this->input->post('cedula'),
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'tipo_usuario' => $this->input->post('tipo_usuario'),
                'cargo' => $this->input->post('cargo'),
                'telefono' => $this->input->post('telefono'),
                'estatus' => $this->input->post('estatus'),
                'fecha_create' => date('Y-m-d H:i:s'),
                'fecha_update' => date('Y-m-d H:i:s'),
                'user_create_id' => $this->input->post('user_create_id'),
      
            );

//            print_r($data);
            $codigo_seg = 'pbkdf2_sha256$12000$'.hash( "sha256", $this->input->post('codigo_seg'));
            $result = $this->Usuarios_model->actualizar($codigo_seg, $data['id'], $data);
            
            if ($result) {
                $param = array(
                    'tabla' => 'usuarios',
                    'codigo' => $this->input->post('id'),
                    'accion' => 'Edición de Usuario',
                    'fecha' => date('Y-m-d'),
                    'hora' => date("h:i:s a"),
                    'usuario' => $this->session->userdata['logged_in']['id'],
                );
                $this->MAuditoria->add($param);
                redirect('configuracion/usuarios/usuarios');
            }
        } else {
            $u = $this->input->post('cedula');

            $mi_archivo = 'picture';
            $config['upload_path'] = "uploads";
            $config['allowed_types'] = 'gif|jpg|png';
            $config['allowed_types'] = "*";
            if (!empty($_FILES['picture']['name'])) {
                $config['upload_path'] = 'uploads/images/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['overwrite'] = TRUE;
                $config['max_size'] = '100';
                $config['max_width'] = '1024';
                $config['max_height'] = '768';

                $config['file_name'] = $u . $_FILES['name'];

                // Cargamos la configuración del Archivo 1
                $this->upload->initialize($config);

                // Subimos archivo 1
                if ($this->upload->do_upload('picture')) {
                    $data = $this->upload->data();
                    $picture = $data['file_name'];
                } else {
                    $picture = '';
                    echo $this->upload->display_errors();
                    return;
                }
            } else {
                echo 'Exitoso';
                $picture = '';
            }


            $data = array(
                'id' => $this->input->post('id'),
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
//                'password' => 'pbkdf2_sha256$12000$' . hash("sha256", $this->input->post('password')),
                'cedula' => $this->input->post('cedula'),
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'tipo_usuario' => $this->input->post('tipo_usuario'),
                'cargo' => $this->input->post('cargo'),
                'telefono' => $this->input->post('telefono'),
                'estatus' => $this->input->post('estatus'),
                'fecha_create' => date('Y-m-d H:i:s'),
                'fecha_update' => date('Y-m-d H:i:s'),
                'user_create_id' => $this->input->post('user_create_id'),
                'picture' => $picture,
            );
            $codigo_seg = 'pbkdf2_sha256$12000$'.hash( "sha256", $this->input->post('codigo_seg'));
            $result = $this->Usuarios_model->actualizar($codigo_seg, $data['id'], $data);
            
            if ($result) {
                $param = array(
                    'tabla' => 'usuarios',
                    'codigo' => $this->input->post('id'),
                    'accion' => 'Edición de Usuario',
                    'fecha' => date('Y-m-d'),
                    'hora' => date("h:i:s a"),
                    'usuario' => $this->session->userdata['logged_in']['id'],
                );
                $this->MAuditoria->add($param);
                redirect('configuracion/usuarios/usuarios');
            }
        }
    }


    function add() {

        $u = $this->input->post('cedula');
        $mi_archivo = 'picture';
        $config['upload_path'] = "uploads";
        $config['allowed_types'] = 'gif|jpg|png';
        $config['allowed_types'] = "*";
        if (!empty($_FILES['picture']['name'])) {
            $config['upload_path'] = 'uploads/images/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '100';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';

            $config['file_name'] = $u . $_FILES['name'];

            // Cargamos la configuración del Archivo 1
            $this->upload->initialize($config);

            // Subimos archivo 1
            if ($this->upload->do_upload('picture')) {
                $data = $this->upload->data();
                $picture = $data['file_name'];
            } else {
                $picture = '';
                echo $this->upload->display_errors();
                return;
            }
        } else {
            echo 'Exitoso';
            $picture = '';
        }

		$ultimo_id = $this->ModelsBusqueda->count_all_table('usuarios');  // El id del último usuario registrado
        
        $data = array(
			'id' => $ultimo_id + 1,
			'codigo' => $this->input->post('codigo'),
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'password' => 'pbkdf2_sha256$12000$' . hash("sha256", $this->input->post('password')),
            'cedula' => $this->input->post('cedula'),
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'tipo_usuario' => $this->input->post('tipo_usuario'),
            'cargo' => $this->input->post('cargo'),
            'telefono' => $this->input->post('telefono'),
            'estatus' => $this->input->post('estatus'),
            'fecha_create' => date('Y-m-d H:i:s'),
            'fecha_update' => date('Y-m-d H:i:s'),
            'user_create_id' => $this->input->post('user_create_id'),
            'picture' => $picture,
        );       
        
        $codigo_seg = 'pbkdf2_sha256$12000$'.hash( "sha256", $this->input->post('codigo_seg'));

        $result = $this->Usuarios_model->insertar($codigo_seg, $data);
        if ($result) {
			$param = array(
				'tabla' => 'Usuarios',
				'codigo' => $this->input->post('id'),
				'accion' => 'Registro de nuevo Usuario',
				'fecha' => date('Y-m-d'),
				'hora' => date("h:i:s a"),
				'usuario' => $this->session->userdata['logged_in']['id'],
			);
			$this->MAuditoria->add($param);
		}

        //Storing insertion status message.
        if ($result) {
            $this->session->set_flashdata('success_msg', 'User data have been added successfully.');
        } else {
            $this->session->set_flashdata('error_msg', 'Some problems occured, please try again.');
        }

        //Form for adding user data
        redirect('configuracion/usuarios/Usuarios/');
    }

}
