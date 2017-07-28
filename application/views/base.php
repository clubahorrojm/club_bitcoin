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
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Club del Ahorro | Version 0.1</title>
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




        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

	<style>
	    .fancybox-overlay-fixed {
                z-index: 1000;
            }

            a{
                cursor:pointer;
            }
        </style>

    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <header class="main-header" style="position: absolute; width: 100%" >
                <!-- Logo -->
                <a href="<?php echo base_url(); ?>index.php/" class="logo">
				<img src="<?php echo base_url(); ?>static/img/logo3.png" style="width: 100%" >
                <!--<a href="<?php echo base_url(); ?>index.php/" class="logo">-->
                    <!--<span class="logo-mini"><b>CA</b></span>
                    <span class="logo-lg"><b>Club del Ahorro</b></span>-->
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <!--<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <div class="navbar-custom-menu" style=" z-index: 100;">
                        <ul class="nav navbar-nav">
                            <li class="dropdown messages-menu">

                            </li>
                            <li class="dropdown notifications-menu">

                            </li>
                            <li class="dropdown tasks-menu">


                            </li>
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                   
                                    
                                     <?php if ($picture == '') { ?>
                                            <img src="<?php echo base_url(); ?>static/img/default.gif" class="user-image" alt="User Image">
                                        <?php } else { ?>
                                            <img src="<?php echo base_url(); ?>uploads/images/<?php echo $picture ?>" class="user-image" alt="User Image">
                                        <?php } ?> 
                                    <span class="hidden-xs"><?php echo"$username ($tipouser)" ?> </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="user-header">
                                       
                                        
                                         <?php if ($picture == '') { ?>
                                            <img src="<?php echo base_url(); ?>static/img/default.gif" class="img-circle" alt="User Image">
                                        <?php } else { ?>
                                            <img src="<?php echo base_url(); ?>uploads/images/<?php echo $picture ?>" class="img-circle" alt="User Image">
                                        <?php } ?> 
                                        <p>
                                            <?php echo"$username" ?> 

                                             <small> Registrado desde <?php 
                                            
                                            $fecha_new = date("d M Y", strtotime($fecha));
                                           //echo"($fecha_new)" ?>
                                            </small>
                                        </p>
                                    </li>

                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="<?php echo base_url()?>index.php/configuracion/usuarios/usuarios/perfil/<?= $id; ?>" class="btn btn-default btn-flat">Perfil</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="<?php echo base_url(); ?>index.php/User_Authentication/logout/<?php echo $id ?>" class="btn btn-default btn-flat">Cerrar Sesión</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                            </li>
                        </ul>
                    </div>-->
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <?php if ($picture == '') { ?>
								<img src="<?php echo base_url(); ?>static/img/default.gif" class="img-circle" alt="User Image">
							<?php } else { ?>
								<img src="<?php echo base_url(); ?>uploads/images/<?php echo $picture ?>" class="img-circle" alt="User Image">
							<?php } ?> 
                        </div>
                        <div class="pull-left info">
                            <p><?php echo"$username ($tipouser)" ?> <i class="fa fa-circle text-success"></i></p>
                            <a href="<?php echo base_url(); ?>index.php/User_Authentication/logout/<?php echo $id ?>"><i class="glyphicon glyphicon-log-out"></i> Cerrar Sesión</a>
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
                        <li class="header">Menú</li>
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

 
        <script>
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
						//~ bootbox.alert("Introduzca el Usuario", function () {
						//~ }).on('hidden.bs.modal', function (event) {
							//~ $("#username_rec").parent('div').addClass('has-error')
							//~ $("#username_rec").val('');
							//~ $("#username_rec").focus();
						//~ });
						alert("Error: Introduzca el Usuario");
						$("#username_rec").parent('div').addClass('has-error')
						$("#username_rec").val('');
						$("#username_rec").focus();
					} else if($("#password_rec").val() == ''){
						//~ bootbox.alert("Introduzca la Clave Maestra", function () {
						//~ }).on('hidden.bs.modal', function (event) {
							//~ $("#password_rec").parent('div').addClass('has-error')
							//~ $("#password_rec").val('');
							//~ $("#password_rec").focus();
						//~ });
						alert("Error: Introduzca la Clave Maestra");
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
				
			});
        </script>
    </body>
</html>
