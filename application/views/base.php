<!DOCTYPE html>
<?php
if (isset($this->session->userdata['logged_in'])) {
    $username = ($this->session->userdata['logged_in']['username']);
    $email = ($this->session->userdata['logged_in']['email']);
    $id = ($this->session->userdata['logged_in']['id']);
    $tipouser = ($this->session->userdata['logged_in']['tipo_usuario']);
    $picture = ($this->session->userdata['logged_in']['picture']);
    //$cargo = ($this->session->userdata['logged_in']['cargo']);
    $fecha = ($this->session->userdata['logged_in']['fecha_create']);
	//echo "HOLAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA".$id;
	// Velidacion para las alertas de notificaciones al usuario
	//$this->load->model('busquedas_ajax/ModelsBusqueda');
	$tipo_usuario = $this->ModelsBusqueda->search_tipo_usuario($id);
	
	$tipo_usuario = $tipo_usuario[0]->tipo_usuario;
	// Si es tipo basico se buscan las notifiaciones
	if ($tipo_usuario == 3 ){
		$hoy = date('Y-m-d');
		$lista_notificaciones = $this->ModelsBusqueda->search_notificaciones($id, $hoy);
		$lista_new_notificaciones = $this->ModelsBusqueda->search_new_notificaciones($id);
		
		$notificaciones = count($lista_new_notificaciones);
		
		if ($notificaciones == 0){
			$cant_notif = '';
		}else{
			$cant_notif = $notificaciones;
		}
	}
	
	
// Arreglo con la data de sesión para pasarla al menú
    $datos_sesion = array(
	'username' => $username,
	'email' => $email,
	'id' => $id,
	'tipouser' => $tipouser,
	'picture' => $picture,
	//'cargo' => $cargo,
	'fecha' => $fecha
    );

} else {
    header("location: base_url() ");
}
?>
<html>
    <head><link  href="<?= base_url() ?>static/img/login_adm/logo-01.png" rel='shortcut icon' type='image/png'/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Criptozone | Version 0.1</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="<?= base_url() ?>static/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->

		<link rel="stylesheet" href="<?= base_url() ?>static/font-awesome/css/font-awesome.css">
		<link rel="stylesheet" href="<?= base_url() ?>static/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
        <!-- Morris chart -->
        <link rel="stylesheet" href="<?= base_url() ?>static/plugins/morris/morris.css">
        <!-- jvectormap -->
        <link rel="stylesheet" href="<?= base_url() ?>static/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
        <!-- Date Picker -->
        <link rel="stylesheet" href="<?= base_url() ?>static/plugins/datepicker/datepicker3.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="<?= base_url() ?>static/plugins/daterangepicker/daterangepicker-bs3.css">
        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="<?= base_url() ?>static/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="<?= base_url() ?>static/plugins/datatables/dataTables.bootstrap.css">
        <!-- Select2 -->
        <link rel="stylesheet" href="<?= base_url() ?>static/plugins/select2/select2.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?= base_url() ?>static/dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?= base_url() ?>static/dist/css/skins/_all-skins.min.css">
        <!-- Bootstrap Color Picker -->
        <link rel="stylesheet" href="<?= base_url() ?>static/plugins/colorpicker/bootstrap-colorpicker.min.css">
        <!-- Bootstrap time Picker -->
        <link rel="stylesheet" href="<?= base_url() ?>static/plugins/timepicker/bootstrap-timepicker.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="<?= base_url() ?>static/plugins/iCheck/flat/blue.css">
        <!-- iCheck for checkboxes and radio inputs -->
        <link rel="stylesheet" href="<?= base_url() ?>static/plugins/iCheck/all.css">
        <!-- File input -->
        <link rel="stylesheet" href="<?= base_url() ?>static/bootstrap/css/fileinput.min.css">

   
       <link rel="stylesheet" type="text/css" href="<?= base_url() ?>static/css/select2.css"/>
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>static/css/select2-bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>static/css/dataTables.responsive.css"/>
   
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>static/css/fancybox/jquery.fancybox.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>static/css/bootstrap-datepicker.css"/>

		<link rel="stylesheet" href="<?= base_url() ?>static/inc/TimeCircles.css" />



        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
		
		<link rel="stylesheet" type="text/css" href="<?= base_url() ?>static/css/news_styles.css"/>

    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <header class="main-header" style="position: absolute; width: 100%" >
                <!-- Logo -->
                <a href="<?php echo base_url(); ?>index.php/" class="logo">
				<img src="<?php echo base_url(); ?>static/img/logo4.png" style="width: 100%;height:50px;" >
                <!--<a href="<?php echo base_url(); ?>index.php/" class="logo">-->
                    <!--<span class="logo-mini"><b>CA</b></span>
                    <span class="logo-lg"><b>Criptozone</b></span>-->
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
<!--                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>-->
                    <div class="navbar-custom-menu" style=" z-index: 100;">
                        <ul class="nav navbar-nav">
                            <li class="dropdown messages-menu">
								<?php if ($tipo_usuario == 3 ): ?>
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" onclick="limpiar();">
									  <i class="fa fa-bell-o"></i>
									  <span class="label label-danger" id="cant_notif"><?php echo $cant_notif ?></span>
									</a>
									<ul class="dropdown-menu">
										<li class="header" style="color: white">Tiene <?php echo $notificaciones ?> notificaciones nuevas</li>
										<li>
										
										
										<!-- inner menu: contains the actual data -->
										<ul class="menu">
											
												<?php foreach ($lista_notificaciones as $retiros) { ?>
													<?php if($retiros->dias == 0){
														$tiempo = 'Hoy';
													}else if($retiros->dias == 1){
														$tiempo = $retiros->dias.' Día';
													}else{
														$tiempo = $retiros->dias.' Días';
													}?>
													<?php if ($retiros->tipo == 1) {?>
														<li ><!-- ###############  NOTIFICACION DE PAGO #############-->
															<a href="#" >
																<div class="pull-left">
																	<img src="<?php echo base_url(); ?>static/img/menu_usuario/pago.png" style="background-color: #22274b" class="img-circle" alt="User Image">
																</div>
																<h4>
																	Pago de referido
																	<small><i class="fa fa-clock-o"></i><span id="myspan"></span>&nbsp;<?php echo $tiempo ?></small>
																</h4>
																<p><?php echo $retiros->accion ?></p>
															</a>
														</li>
													<?php }else if ($retiros->tipo == 2){ ?>
														<li><!-- ###############  NOTIFICACION DE RETIRO ############# -->
															<a href="<?php echo base_url(); ?>index.php/referidos/CRelRetiros/" >
																<div class="pull-left">
																	<img src="<?php echo base_url(); ?>static/img/menu_usuario/retiros.png" style="background-color: #FF5C00" class="img-circle" alt="User Image">
																</div>
																<h4>
																	Retiro canalizado
																	<small><i class="fa fa-clock-o"></i><span id="myspan"></span>&nbsp;<?php echo $tiempo ?></small>
																</h4>
																<p><?php echo $retiros->accion ?></p>
															</a>
														</li>
													<?php }else if ($retiros->tipo == 3){ ?>
														<li><!-- ###############  NOTIFICACION DE Soporte a usuario ############# -->
															<a href="<?php echo base_url(); ?>index.php/referidos/CRelAyudas/" >
																<div class="pull-left">
																	<img src="<?php echo base_url(); ?>static/img/menu_usuario/invitados.png" style="background-color: #edd727" class="img-circle" alt="User Image">
																</div>
																<h4>
																	Soporte a usuario
																	<small><i class="fa fa-clock-o"></i><span id="myspan"></span>&nbsp;<?php echo $tiempo ?></small>
																</h4>
																<p><?php echo $retiros->accion ?></p>
															</a>
														</li>
													<?php }else if ($retiros->tipo == 4){ ?>
														<li><!-- ###############  NOTIFICACION DE NUEVO NIVEL ############# -->
															<a href="#" >
																<div class="pull-left">
																	<img src="<?php echo base_url(); ?>static/img/menu_usuario/ranking.png" style="background-color: #37BA16" class="img-circle" alt="User Image">
																</div>
																<h4>
																	Nuevo nivel alcanzado
																	<small><i class="fa fa-clock-o"></i><span id="myspan"></span>&nbsp;<?php echo $tiempo ?></small>
																</h4>
																<p><?php echo $retiros->accion ?></p>
															</a>
														</li>
													<?php } ?>
												<?php }?>
											
											
											<!-- end message -->
											
											
											
											
											
										</ul>
									</li>
									
								</ul>
								<?php endif; ?>
							</li>
                            
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <p style="color:#FFFFFF !important"><?php echo"$username ($tipouser)" ?> <i class="fa fa-circle text-success"></i></p>
<!--
                            <a href="<?php echo base_url(); ?>index.php/User_Authentication/logout/<?php echo $id ?>"><i class="glyphicon glyphicon-log-out"></i> Cerrar Sesión</a>
-->
                            <a href="<?php echo base_url(); ?>index.php/User_Authentication/logout/<?php echo $id."?t_u=".$tipo_usuario; ?>"><img src="<?php echo base_url(); ?>static/img/cerrar-sesion-01.png" style="width:20px;"> Cerrar Sesión</a>
                        </div>
                        <div class="pull-left info">
                           <!-- <p style="color:#FFFFFF !important"><?php echo"$username ($tipouser)" ?> <i class="fa fa-circle text-success"></i></p>
                            <a href="<?php echo base_url(); ?>index.php/User_Authentication/logout/<?php echo $id ?>"><i class="glyphicon glyphicon-log-out"></i> Cerrar Sesión</a>

                            <a href="<?php echo base_url(); ?>index.php/User_Authentication/logout/<?php echo $id."?t_u=".$tipo_usuario; ?>"><img src="<?php echo base_url(); ?>static/img/cerrar-sesion-01.png" style="width:20px;"> Cerrar Sesión</a>-->
                        </div>
                    </div>
                    <!-- search form -->
                    <!--<form action="#" method="get" class="sidebar-form">
						<div class="input-group">
							<input type="text" name="q" class="form-control" placeholder="Buscar...">
							<span class="input-group-btn">
								<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
							</span>
						</div>
					</form>-->
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="header" style="color: white">Menú</li>
                        <?php echo menu($datos_sesion); ?>

                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>



            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Create the tabs -->
                <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                    <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
                    <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- Home tab content -->
                    <div class="tab-pane" id="control-sidebar-home-tab">
                        <h3 class="control-sidebar-heading">Recent Activity</h3>
                        <ul class="control-sidebar-menu">
                            <li>
                                <a href="javascript::;">
                                    <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                                        <p>Will be 23 on April 24th</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript::;">
                                    <i class="menu-icon fa fa-user bg-yellow"></i>
                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
                                        <p>New phone +1(800)555-1234</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript::;">
                                    <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
                                        <p>nora@example.com</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript::;">
                                    <i class="menu-icon fa fa-file-code-o bg-green"></i>
                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
                                        <p>Execution time 5 seconds</p>
                                    </div>
                                </a>
                            </li>
                        </ul><!-- /.control-sidebar-menu -->

                        <h3 class="control-sidebar-heading">Tasks Progress</h3>
                        <ul class="control-sidebar-menu">
                            <li>
                                <a href="javascript::;">
                                    <h4 class="control-sidebar-subheading">
                                        Custom Template Design
                                        <span class="label label-danger pull-right">70%</span>
                                    </h4>
                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript::;">
                                    <h4 class="control-sidebar-subheading">
                                        Update Resume
                                        <span class="label label-success pull-right">95%</span>
                                    </h4>
                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript::;">
                                    <h4 class="control-sidebar-subheading">
                                        Laravel Integration
                                        <span class="label label-warning pull-right">50%</span>
                                    </h4>
                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript::;">
                                    <h4 class="control-sidebar-subheading">
                                        Back End Framework
                                        <span class="label label-primary pull-right">68%</span>
                                    </h4>
                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                                    </div>
                                </a>
                            </li>
                        </ul><!-- /.control-sidebar-menu -->

                    </div><!-- /.tab-pane -->
                    <!-- Stats tab content -->
                    <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
                    <!-- Settings tab content -->
                    <div class="tab-pane" id="control-sidebar-settings-tab">
                        <form method="post">
                            <h3 class="control-sidebar-heading">General Settings</h3>
                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Report panel usage
                                    <input type="checkbox" class="pull-right" checked>
                                </label>
                                <p>
                                    Some information about this general settings option
                                </p>
                            </div><!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Allow mail redirect
                                    <input type="checkbox" class="pull-right" checked>
                                </label>
                                <p>
                                    Other sets of options are available
                                </p>
                            </div><!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Expose author name in posts
                                    <input type="checkbox" class="pull-right" checked>
                                </label>
                                <p>
                                    Allow the user to show his name in blog posts
                                </p>
                            </div><!-- /.form-group -->

                            <h3 class="control-sidebar-heading">Chat Settings</h3>

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Show me as online
                                    <input type="checkbox" class="pull-right" checked>
                                </label>
                            </div><!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Turn off notifications
                                    <input type="checkbox" class="pull-right">
                                </label>
                            </div><!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Delete chat history
                                    <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                                </label>
                            </div><!-- /.form-group -->
                        </form>
                    </div><!-- /.tab-pane -->
                </div>
            </aside><!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div><!-- ./wrapper -->
		
		<!-- Modal para recuperación de clave de usuarios generales -->
		<div class="modal" id="modal_clave">
		   <div class="modal-dialog">
			  <div class="modal-content">
				 <div class="modal-header" style="background-color:#296293">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">
					   <center><span class="glyphicon glyphicon-search"></span>
					   &nbsp;Introdúzca el Usuario y la Clave Maestra para Generar una Nueva Clave de Acceso</center>
					</h4>
				 </div>
				 <div class="modal-body">
					<form id="f_rec_usuario" name="f_rec_usuario" action="" method="post">
					   <div class="form-group">
							<div class="col-sm-12">
								<input type="text" class="form-control" style="width: 100%; " id="username_rec" name="username_rec" placeholder="Usuario" autofocus="true">
							</div>
							</br></br></br>
							<div class="col-sm-12">
								<input style="width: 100%;" type="password" class="form-control" id="password_rec" name="password_rec" placeholder="Clave Maestra"/>
							</div>
							</br></br>
							<div class="col-sm-12" align="right">
								<span class="input-btn">
									<button class="btn btn-primary" type="button" id="generar">
										Generar&nbsp;<span class="glyphicon glyphicon-share-alt"></span>
									</button>
								</span>
							</div>
							</br></br>
					   </div>
					</form>
				 </div>
				 
			  </div>
		   </div>
		</div>
		<!-- Cierre Modal para recuperación de clave de usuarios generales -->
		
		<!-- Modal para cambio de clave de usuarios básicos -->
		<div class="modal" id="modal_clave_basico">
		   <div class="modal-dialog">
			  <div class="modal-content">
				 <div class="modal-header" style="background-color:#296293">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">
					   <center><span class="glyphicon glyphicon-search"></span>
					   &nbsp;Introdúzca su clave actual y la nueva clave que desee</center>
					</h4>
				 </div>
				 <div class="modal-body">
					<form id="f_rec_usuario_basico" name="f_rec_usuario_basico" action="" method="post">
					   <div class="form-group">
							<div class="col-sm-12">
								<input type="password" class="form-control" style="width: 100%; " id="clave_actual" name="clave_actual" placeholder="Clave Actual" autofocus="true">
							</div>
							</br></br></br>
							<div class="col-sm-12">
								<input style="width: 100%;" type="password" class="form-control" id="rep_clave_actual" name="rep_clave_actual" placeholder="Repita su Clave Actual"/>
							</div>
							</br></br></br>
							<div class="col-sm-12">
								<input type="password" class="form-control" style="width: 100%; " id="nueva_clave" name="nueva_clave" placeholder="Nueva Clave" autofocus="true">
							</div>
							</br></br></br>
							<div class="col-sm-12">
								<input style="width: 100%;" type="password" class="form-control" id="rep_nueva_clave" name="rep_nueva_clave" placeholder="Repita su Nueva Clave"/>
							</div>
							</br></br>
							<div class="col-sm-12" align="right">
								<span class="input-btn">
									<button class="btn btn-primary" type="button" id="cambiar">
										Generar&nbsp;<span class="glyphicon glyphicon-share-alt"></span>
									</button>
								</span>
							</div>
							</br></br>
					   </div>
					</form>
				 </div>
				 
			  </div>
		   </div>
		</div>
		<!-- Cierre Modal para cambio de clave de usuarios básicos -->

        <!-- jQuery 2.1.4 -->
        <script src="<?= base_url() ?>static/plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <!-- <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script> -->
        
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            //$.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.5 -->
        <script src="<?= base_url() ?>static/bootstrap/js/bootstrap.min.js"></script>
        <!-- datatables -->
        <script src="<?= base_url() ?>static/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?= base_url() ?>static/plugins/datatables/dataTables.bootstrap.min.js"></script>
        <!-- Morris.js charts -->
<!--        <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="<?= base_url() ?>static/plugins/morris/morris.min.js"></script>-->
        <!-- Sparkline -->
        <script src="<?= base_url() ?>static/plugins/sparkline/jquery.sparkline.min.js"></script>
        <!-- jvectormap -->
        <script src="<?= base_url() ?>static/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="<?= base_url() ?>static/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <!-- jQuery Knob Chart -->
        <script src="<?= base_url() ?>static/plugins/knob/jquery.knob.js"></script>
        <!-- daterangepicker -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
        <script src="<?= base_url() ?>static/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- datepicker -->
        <script src="<?= base_url() ?>static/plugins/datepicker/bootstrap-datepicker.js"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="<?= base_url() ?>static/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
        <!-- Slimscroll -->
        <script src="<?= base_url() ?>static/plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="<?= base_url() ?>static/plugins/fastclick/fastclick.min.js"></script>
        <!-- Select2 -->
        <script src="<?= base_url() ?>static/plugins/select2/select2.full.min.js"></script>
        <!-- InputMask -->
        <script src="<?= base_url() ?>static/plugins/input-mask/jquery.inputmask.js"></script>
        <script src="<?= base_url() ?>static/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
        <script src="<?= base_url() ?>static/plugins/input-mask/jquery.inputmask.extensions.js"></script>
        <!-- AdminLTE App -->
        <script src="<?= base_url() ?>static/dist/js/app.min.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!--        <script src="<?= base_url() ?>static/dist/js/pages/dashboard.js"></script>-->
        <!-- BootBox -->
        <script src="<?= base_url() ?>static/js/bootbox.js"></script>  

        <!-- file input -->
        <script src="<?= base_url() ?>static/bootstrap/js/fileinput.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?= base_url() ?>static/dist/js/demo.js"></script>
        <!-- bootstrap time picker -->
        <script src="<?= base_url() ?>static/plugins/timepicker/bootstrap-timepicker.min.js"></script>
        <!-- bootstrap color picker -->
        <script src="<?= base_url() ?>static/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
        <!-- iCheck 1.0.1 -->
        <script src="<?= base_url() ?>static/plugins/iCheck/icheck.min.js"></script>


        <!--nuevo-->
        <!-- Jquery numeric -->
        <script src="<?= base_url() ?>static/js/jquery.numeric.js"></script>  
        <!-- Jquery alphanumeric -->
        <script src="<?= base_url() ?>static/js/jquery.alphanumeric.js"></script>  
        <!-- Page script -->
        <script src="<?= base_url() ?>static/js/fancybox/jquery.fancybox.js"></script>
        <script src="<?= base_url() ?>static/js/select2.js"></script>
        <script src="<?= base_url() ?>static/js/select2_locale_es.js"></script>
        <script src="<?= base_url() ?>static/js/jquery.dataTables.js"></script>
        <script src="<?= base_url() ?>static/js/dataTables.responsive.min.js"></script>
        <script src="<?= base_url() ?>static/js/bootstrap-datepicker.js"></script>
        <script src="<?= base_url() ?>static/js/bootstrap-datepicker.es.min.js"></script>

        <script src="<?= base_url() ?>static/js/jquery.qrcode.js"></script>
        <script src="<?= base_url() ?>static/js/qrcode.js"></script>
		
		<script src="<?= base_url() ?>static/js/jquery.countdown.js"></script>
		<script src="<?= base_url() ?>static/js/Chart.js"></script>
		
		<script type="text/javascript" src="<?= base_url() ?>static/inc/TimeCircles.js"></script>

<!--         // <script type="text/javascript" async="" src="http://www.google-analytics.com/ga.js"></script>
        // <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script> -->
 
        <script>

			
			function limpiar() {
				$.post('<?php echo base_url(); ?>index.php/busquedas_ajax/ControllersBusqueda/actualizar_notifiaciones/', function(response) {
				
				});
				document.getElementById("cant_notif").innerHTML="";
				//alert('Chupalo');
			}
			
			$(document).ready(function () {
							
				// Activar modal al hacer click en el enlace de recuperación
				$("#rec_password").click(function (e) {
					e.preventDefault();  // Para evitar que se envíe por defecto
					$("#modal_clave").modal('show');
				});
				
				// Validar formulario
				$("#generar").click(function (e) {
					e.preventDefault();  // Para evitar que se envíe por defecto
					
					if($("#username_rec").val() == ''){
						//~ bootbox.alert("Introdúzca el Usuario", function () {
						//~ }).on('hidden.bs.modal', function (event) {
							//~ $("#username_rec").parent('div').addClass('has-error')
							//~ $("#username_rec").val('');
							//~ $("#username_rec").focus();
						//~ });
						alert("Error: Introdúzca el Usuario");
						$("#username_rec").parent('div').addClass('has-error')
						$("#username_rec").val('');
						$("#username_rec").focus();
					} else if($("#password_rec").val() == ''){
						//~ bootbox.alert("Introdúzca la Clave Maestra", function () {
						//~ }).on('hidden.bs.modal', function (event) {
							//~ $("#password_rec").parent('div').addClass('has-error')
							//~ $("#password_rec").val('');
							//~ $("#password_rec").focus();
						//~ });
						alert("Error: Introdúzca la Clave Maestra");
						$("#password_rec").parent('div').addClass('has-error')
						$("#password_rec").val('');
						$("#password_rec").focus();
					} else {
						//~ alert($("#username_rec").val());
						$.post('<?php echo base_url(); ?>index.php/User_Authentication/recuperar/', $("#f_rec_usuario").serialize(), function(response) {
							//~ alert(response[3]);
							if (response[3] != "U"){
								alert("La Clave de Acceso para el Usuario "+$("#username_rec").val()+" ha sido recuperada exitosamente: "+response);
								location.reload();
								//~ bootbox.alert("La Clave de Acceso para el usuario "+$("#username_rec").val()+" ha sido cambiada exitosamente: "+response, function () {
								//~ }).on('hidden.bs.modal', function (event) {
									//~ location.reload();
								//~ });
							}else{
								alert(response);
								//~ bootbox.alert(response, function () {
								//~ }).on('hidden.bs.modal', function (event) {
									//~ 
								//~ });
							}
						});
					}
				});
				
				// Activar modal de cambio de contraseña de usuario básicos al hacer click en el enlace de cambio
				$("#change_password").click(function (e) {
					e.preventDefault();  // Para evitar que se envíe por defecto
					$("#modal_clave_basico").modal('show');
				});
				
				// Validar formulario de cambio de clave de usuarios básicos
				$("#cambiar").click(function (e) {
					e.preventDefault();  // Para evitar que se envíe por defecto
					
					if($("#clave_actual").val() == ''){
						alert("Error: Introdúzca su Clave Actual");
						$("#clave_actual").parent('div').addClass('has-error')
						$("#clave_actual").val('');
						$("#clave_actual").focus();
					} else if($("#rep_clave_actual").val() == ''){
						alert("Error: Repita su Clave Actual");
						$("#rep_clave_actual").parent('div').addClass('has-error')
						$("#rep_clave_actual").val('');
						$("#rep_clave_actual").focus();
					} else if($("#rep_clave_actual").val() != $("#clave_actual").val()){
						alert("Error: Error de claves, por favor repítalas");
						$("#clave_actual").parent('div').addClass('has-error')
						$("#clave_actual").val('');
						$("#rep_clave_actual").parent('div').addClass('has-error')
						$("#rep_clave_actual").val('');
						$("#clave_actual").focus();
					} else if($("#nueva_clave").val() == ''){
						alert("Error: Introdúzca su Nueva Clave");
						$("#nueva_clave").parent('div').addClass('has-error')
						$("#nueva_clave").val('');
						$("#nueva_clave").focus();
					} else if($("#rep_nueva_clave").val() == ''){
						alert("Error: Repita su Nueva Clave");
						$("#rep_nueva_clave").parent('div').addClass('has-error')
						$("#rep_nueva_clave").val('');
						$("#rep_nueva_clave").focus();
					} else if($("#rep_nueva_clave").val() != $("#nueva_clave").val()){
						alert("Error: Error de claves, por favor repítalas");
						$("#nueva_clave").parent('div').addClass('has-error')
						$("#nueva_clave").val('');
						$("#rep_nueva_clave").parent('div').addClass('has-error')
						$("#rep_nueva_clave").val('');
						$("#nueva_clave").focus();
					} else {
						$.post('<?php echo base_url(); ?>index.php/User_Authentication/cambiar_basico/', $("#f_rec_usuario_basico").serialize(), function(response) {
							//~ alert(response.trim());
							if (response.trim() != "Usuario inexistente."){
								bootbox.alert('<h4>Se ha generado su nueva clave con éxito, espere un mensaje de confirmación en su correo electrónico.</h4>', function () {
									location.reload();
								});
								
							}else{
								bootbox.alert('<h4>'+response.trim()+'</h4>', function () {
									
								});
							}
						});
					}
				});
				
			});
        </script>
    </body>
</html>
