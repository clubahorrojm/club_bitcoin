<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
if (!function_exists('menu')) {

    function menu($datos_sesion) {
        $ci = & get_instance();

        $user_id = $ci->session->userdata('user_id');
        $modulo_ids = array();
        //$menu = $ci->libreria->menu($modulo_ids);
        //foreach ($menu as $value) {
        //    $submenu = $ci->libreria->submenu($value->id);
        //    ?>
        //    <!--<li class="active treeview">
        //        <a href="#">
        //            <i class="fa fa-wrench"></i> <span><?php echo $value->modulo; ?></span> <i class="fa fa-angle-left pull-right"></i>
        //        </a>
        //        <ul class="treeview-menu">
        //    <?php
        //    foreach ($submenu as $values) {
        //        ?>
        //                <li><a href="<?php echo base_url(); ?>index.php/<?php echo $values->route; ?>"><i class="fa fa-circle-o"></i><?php echo $values->modulo; ?></a></li>
        //
        //        <?php
        //    }
        //    ?>
        //
        //        </ul>
        //
        //    </li>-->
        //    <?php
        //}
        ?>
        <?php if ($datos_sesion['tipouser'] == 'BÁSICO' ): ?>
		<li class="treeview">
            <li><a href="<?php echo base_url(); ?>index.php/referidos/CReferidos"><i class="fa fa-star "></i>Perfil</a></li>
			<li><a href="<?php echo base_url(); ?>index.php/referidos/CRelPagos"><i class="fa fa-money "></i>Registrar Pago</a></li>
			<li><a href="<?php echo base_url(); ?>index.php/referidos/CRelInformacion"><i class="fa fa-user "></i>Información Personal</a></li>
			<li><a href="<?php echo base_url(); ?>index.php/referidos/CRelDistribucion"><i class="fa fa-angle-double-up "></i>Distribución de Capital</a></li>
			<li><a href="<?php echo base_url(); ?>index.php/referidos/CRelLinks"><i class="fa fa-envelope-o "></i>Links de Invitación</a></li>
            <li><a href="<?php echo base_url(); ?>index.php/referidos/CRelRetiros"><i class="fa fa-dollar "></i>Retiros</a></li> 
            <li><a href="<?php echo base_url(); ?>index.php/referidos/CRelAyudas"><i class="fa fa-info-circle "></i>Soporte a Usuarios</a></li> 
        </li>
        <?php endif; ?>
        
        <?php if ($datos_sesion['tipouser'] == 'Administrador' || $datos_sesion['tipouser'] == 'OPERADOR'): ?>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-file-text text-maroon"></i> <span>Reportes</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo base_url(); ?>index.php/reportes/CRepPagos"><i class="fa fa-file-pdf-o text-maroon"></i>Pagos</a></li>
                <li><a href="<?php echo base_url(); ?>index.php/reportes/CRepRetiros"><i class="fa fa-file-pdf-o text-maroon"></i>Retiros</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-puzzle-piece text-teal"></i><span>Procesos</span><i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
		        <li><a href="<?php echo base_url(); ?>index.php/procesos/CLPagos"><i class="fa fa-money text-teal"></i>Pagos</a></li>
                <li><a href="<?php echo base_url(); ?>index.php/procesos/CLRetiros"><i class="fa fa-cc-discover text-teal"></i>Retiros</a></li>
                <li><a href="<?php echo base_url(); ?>index.php/procesos/CLLinksCad"><i class="fa fa-unlink text-teal"></i>Links Caducados</a></li>
                <li><a href="<?php echo base_url(); ?>index.php/procesos/CLDesvincular"><i class="fa fa-user-times text-teal"></i>Desvinculación</a></li>
                <li><a href="<?php echo base_url(); ?>index.php/procesos/CAyuda"><i class="fa fa-info-circle text-teal"></i>Soporte a Usuarios</a></li>
            </ul>
        </li>
		<?php endif; ?>
		
	    <?php if ($datos_sesion['tipouser'] == 'Administrador'): ?>
	   <li class="treeview">
            <a href="#">
                <i class="fa fa-users text-gray"></i><span>Usuarios</span><i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
        		<li><a href="<?php echo base_url(); ?>index.php/configuracion/grupos_usuarios/ControllersGrupoUsuarios"><i class="fa fa-object-group text-gray"></i> Grupos de Usuarios</a></li>
                <li><a href="<?php echo base_url(); ?>index.php/configuracion/usuarios/usuarios"><i class="fa fa-user text-gray"></i>Gestión de Usuarios</a></li>

            </ul>
        </li>
	    <li class="treeview">
            <a href="#">
                <i class="fa fa-shield text-orange"></i><span>Administración</span><i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
				<li><a href="<?php echo base_url(); ?>index.php/administracion/CAMontos/"><i class="fa fa-dollar text-orange"></i>Asignación de Montos</a></li>
        		<li><a href="<?php echo base_url(); ?>index.php/administracion/CAuditoria"><i class="fa fa-book text-orange"></i>Bitacora</a></li>
                <li><a href="<?php echo base_url(); ?>index.php/administracion/CComisionRetiro"><i class="fa fa-circle text-orange" ></i>Comisión por Retiro</a></li>
				<li><a href="<?php echo base_url(); ?>index.php/administracion/CBots"><i class="fa fa-user-secret text-orange"></i>Cuentas Bot</a></li>
        		<li><a href="<?php echo base_url(); ?>index.php/administracion/CEmpresa/"><i class="fa fa-industry text-orange"></i>Empresa</a></li>
				<li><a href="<?php echo base_url(); ?>index.php/administracion/CMonedero"><i class="fa fa-btc text-orange"></i>Monedero</a></li>
                <li><a href="#" id="rec_password"><i class="fa fa-shield text-orange"></i>Rec: Clave de Acceso</a></li>
            </ul>
        </li>
        <?php endif; ?>


        <?php
    }

}
