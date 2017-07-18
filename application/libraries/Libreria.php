<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Libreria
 *
 * @author Ing. Francis Medina
 */
class Libreria {

    protected $ci;

    public function __construct() {
        $this->ci = & get_instance();
        if (!isset($this->ci->session)) {
            $this->ci->load->library('session');
        }
        $this->ci->load->library('encryption');
        $encripinit = array('cipher' => 'aes-256', 'mode' => 'ctr', 'key' => '2ye4r*xbWRN?G$_sa3j@uya-w&KgJC#V');
        $this->ci->encryption->initialize($encripinit);
    }

    //public function menu($modulo_ids) {
    //
    //    $this->ci->db->select('id, modulo, modulo_id, route');
    //    $this->ci->db->order_by("posicion", "asc");
    //    $this->ci->db->where('modulo_id', 0);
    //    $this->ci->db->where('activo', TRUE);
    //    if (count($modulo_ids) > 0) {
    //        $this->ci->db->where_in('id', $modulo_ids);
    //    }
    //
    //    $query = $this->ci->db->get('conf_modulo');
    //    
    //    return $query->result();
    //}

    //public function submenu($id) {
    //    $this->ci->db->select('m.id, m.modulo, m.route');
    //    $this->ci->db->from('conf_modulo AS m');
    //    //$this->ci->db->join('se_permissions p', 'm.id=p.modulo_id', 'inner');
    //    $this->ci->db->where('activo', TRUE);
    //    $this->ci->db->where_in('m.modulo_id', $id);
    //    $this->ci->db->order_by("m.posicion", "asc");
    //    $query = $this->ci->db->get();
    //    return $query->result();
    //}

}
