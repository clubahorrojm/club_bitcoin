<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('static_url()'))
{
    function static_url($ruta='')
    {

        $rut = base_url().'static/';
        if($ruta != ''){
            $rut = base_url('static/'.$ruta);
        }
        return $rut;
    }
}
