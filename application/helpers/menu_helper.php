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
            <!--<li><a href=""><i class="fa fa-exclamation-circle "></i>Ayuda</a></li>-->
        </li>
        <?php endif; ?>
        
        <?php if ($datos_sesion['tipouser'] == 'Administrador' || $datos_sesion['tipouser'] == 'OPERADOR'): ?>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-file-text text-success"></i> <span>Reportes</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo base_url(); ?>index.php/reportes/CRepPagos"><i class="fa fa-file-pdf-o text-success"></i>Pagos</a></li>
                <li><a href="<?php echo base_url(); ?>index.php/reportes/CRepRetiros"><i class="fa fa-file-pdf-o text-success"></i>Retiros</a></li>
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
            </ul>
        </li>
	   <li class="treeview">
            <a href="#">
                <i class="fa fa-cogs text-maroon"></i><span>Configuraciones</span><i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo base_url(); ?>index.php/configuracion/CBancos"><i class="fa fa-bank text-maroon"></i>Bancos</a></li>
				<!--<li><a href="<?php echo base_url(); ?>index.php/configuracion/CCargoMora"><i class="fa fa-circle-o text-maroon"></i>Cargo por Mora</a></li>-->
        		<li><a href="<?php echo base_url(); ?>index.php/configuracion/CComisionRetiro"><i class="fa fa-circle text-maroon" ></i>Comisión por Retiro</a></li>
                <li><a href="<?php echo base_url(); ?>index.php/configuracion/CCuentas"><i class="fa fa-creative-commons text-maroon"></i>Cuentas</a></li>
				<li><a href="<?php echo base_url(); ?>index.php/configuracion/CPaises"><i class="fa fa-globe text-maroon"></i>Paises</a></li>
				<li><a href="<?php echo base_url(); ?>index.php/configuracion/CTiposCuenta"><i class="fa fa-server text-maroon"></i>Tipos de Cuenta</a></li>
				<li><a href="<?php echo base_url(); ?>index.php/configuracion/CTiposMonedas"><i class="fa fa-eur text-maroon"></i>Tipos de Monedas</a></li>
				<!--<li><a href="<?php echo base_url(); ?>index.php/configuracion/CRetiroMinimo"><i class="fa fa-circle-o text-maroon"></i>Monto Min. Retiro</a></li>-->
        		<!--<li><a href="<?php echo base_url(); ?>index.php/configuracion/CMontoPago"><i class="fa fa-circle-o text-maroon"></i>Monto de Pago</a></li> -->
            </ul>
        </li>
		<?php endif; ?>
		
	    <?php if ($datos_sesion['tipouser'] == 'Administrador'): ?>
	    <li class="treeview">
            <a href="#">
                <i class="fa fa-shield text-orange"></i><span>Administración</span><i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
				<li><a href="<?php echo base_url(); ?>index.php/administracion/CAMontos/"><i class="fa fa-dollar text-orange"></i>Asignación de Montos</a></li>
        		<li><a href="<?php echo base_url(); ?>index.php/administracion/CAuditoria"><i class="fa fa-book text-orange"></i>Bitacora</a></li>
        		<li><a href="<?php echo base_url(); ?>index.php/administracion/CEmpresa/"><i class="fa fa-industry text-orange"></i>Empresa</a></li>
        		<li><a href="<?php echo base_url(); ?>index.php/configuracion/grupos_usuarios/ControllersGrupoUsuarios"><i class="fa fa-object-group text-orange"></i> Grupos de Usuarios</a></li>
                <li><a href="<?php echo base_url(); ?>index.php/configuracion/usuarios/usuarios"><i class="fa fa-user text-orange"></i>Gestión de Usuarios</a></li>
                <li><a href="<?php echo base_url(); ?>index.php/administracion/CBots"><i class="fa fa-user-secret text-orange"></i>Cuentas Bot</a></li>
                <li><a href="#" id="rec_password"><i class="fa fa-shield text-orange"></i>Rec: Clave de Acceso</a></li>
            </ul>
        </li>
        <?php endif; ?>


        <?php
    }

}
