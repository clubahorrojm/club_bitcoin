<!DOCTYPE html>
<?php
if (isset($this->session->userdata['logged_in'])) {
    $username = ($this->session->userdata['logged_in']['username']);
    $email = ($this->session->userdata['logged_in']['email']);
    $id = ($this->session->userdata['logged_in']['id']);
    $tipouser = ($this->session->userdata['logged_in']['tipo_usuario']);
    $picture = ($this->session->userdata['logged_in']['picture']);
    $cargo = ($this->session->userdata['logged_in']['cargo']);
} else {
    header("location: facturacion");
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Sistema Administrativo | Version 0.1</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="<?= base_url() ?>static/bootstrap/css/bootstrap.min.css">
  
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

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





        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <header class="main-header" style="position: absolute; width: 100%" >
                <!-- Logo -->
                <a href="<?php echo base_url(); ?>index.php/" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>S</b>A</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Sistema</b>Administrativo</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <div class="navbar-custom-menu" style=" z-index: 100;">
                        <ul class="nav navbar-nav">
                            <!-- Messages: style can be found in dropdown.less-->
                            <li class="dropdown messages-menu">
                                
                            </li>
                            <!-- Notifications: style can be found in dropdown.less -->
                            <li class="dropdown notifications-menu">
                                
                            </li>
                            <!-- Tasks: style can be found in dropdown.less -->
                            <li class="dropdown tasks-menu">
                                
                                
                            </li>
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?php echo base_url(); ?>uploads/images/<?php echo $picture ?>" class="user-image" alt="User Image">
                                    <span class="hidden-xs"><?php echo"$username ($tipouser)" ?> </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="<?php echo base_url(); ?>uploads/images/<?php echo $picture ?>" class="img-circle" alt="User Image">
                                        <p>
                                            <?php echo"$username" ?> - <?php echo "$cargo" ?>
                                            <small>Member since Nov. 2012</small>
                                        </p>
                                    </li>
                                    <!-- Menu Body -->
                                    <li class="user-body">
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Followers</a>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Sales</a>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Friends</a>
                                        </div>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="#" class="btn btn-default btn-flat">Perfil</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="<?php echo base_url(); ?>index.php/User_Authentication/logout/<?php echo $id ?>" class="btn btn-default btn-flat">Cerrar Sesión</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!-- Control Sidebar Toggle Button -->
                            <li>
                                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
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
                            <img src="<?php echo base_url(); ?>uploads/images/<?php echo $picture ?>" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p><?php echo"$username ($tipouser)" ?></p>
                            <a href="#"><i class="fa fa-circle text-success"></i> En Linea</a>
                        </div>
                    </div>
                    <!-- search form -->
<!--                    <form action="#" method="get" class="sidebar-form">
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
                        <li class="active treeview">
                            <a href="#">
                                <i class="fa fa-wrench"></i> <span>Configuraciones</span> <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url(); ?>index.php/configuracion/cargos/ControllersCargos"><i class="fa fa-circle-o"></i> Cargos</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/configuracion/departamentos/ControllersDepartamentos"><i class="fa fa-circle-o"></i>Departamentos</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/configuracion/unidad_departamentos/ControllersUnidadDepartamentos"><i class="fa fa-circle-o"></i>Unidades Departamentos</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/configuracion/periodos_fiscales/ControllersPeriodosFiscales"><i class="fa fa-circle-o"></i> Periodos Fiscales</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/configuracion/identidad_fiscal/ControllersIdentidadFiscal"><i class="fa fa-circle-o"></i> Identidad Fiscal</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/configuracion/prioridades/ControllersPrioridades"><i class="fa fa-circle-o"></i> Prioridades</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/configuracion/tipos_cuentas_bancos/ControllersTiposCuentasBancos"><i class="fa fa-circle-o"></i>Tipos de Cuenta</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/configuracion/tipos_entes/ControllersTiposEntes"><i class="fa fa-circle-o"></i>Tipos de Entes</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/configuracion/sector_economico/ControllersSectorEconomico"><i class="fa fa-circle-o"></i>Sector Económico</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/configuracion/formas_juridicas/ControllersFormasJuridicas"><i class="fa fa-circle-o"></i>Formas Jurídicas</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/configuracion/unidad_tributaria/ControllersUnidadTributaria"><i class="fa fa-circle-o"></i>Unidad Tributaria</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/configuracion/unidad_medida/ControllersUnidadMedida"><i class="fa fa-circle-o"></i>Unidades de Medida</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/configuracion/organos_administrativos/ControllersOrganosAdministrativos"><i class="fa fa-circle-o"></i>Órganos Administrativos</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/configuracion/bancos/ControllersBancos"><i class="fa fa-circle-o"></i>Bancos</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/configuracion/tipos_proyectos/ControllersTiposProyectos"><i class="fa fa-circle-o"></i>Tipos Proyectos</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/configuracion/tipos_accion_centralizada/ControllersTiposAccionCentralizada"><i class="fa fa-circle-o"></i>Tipos Acción Centralizada</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/configuracion/tipos_accion_especifica/ControllersTiposAccionEspecifica"><i class="fa fa-circle-o"></i>Tipos Acción Específica</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/configuracion/bienes_servicios/ControllersBienesServicios"><i class="fa fa-circle-o"></i>Bienes Servicios</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/configuracion/actividades_economicas/ControllersActividadesEconomicas"><i class="fa fa-circle-o"></i>Actividades Económicas</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/configuracion/actividades_presupuesto/ControllersActividadesPresupuesto"><i class="fa fa-circle-o"></i>Actividades Presupuesto</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/configuracion/modulos/ControllersModulos"><i class="fa fa-circle-o"></i>Modulos</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/configuracion/formularios/ControllersFormularios"><i class="fa fa-circle-o"></i>Formularios</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/configuracion/estatus/ControllersEstatus"><i class="fa fa-circle-o"></i>Estatus</a></li>
                                <li><a href="#"><i class="fa fa-circle-o"></i> Grupos de Usuarios</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/configuracion/usuarios/usuarios"><i class="fa fa-circle-o"></i>Gestión de Usuarios</a></li>
                                <li>
                                    <a href="#"><i class="fa fa-circle-o"></i>Topologia <i class="fa fa-angle-left pull-right"></i></a>
                                    <ul class="treeview-menu">
                                        <li><a href="<?php echo base_url(); ?>index.php/topologia/ControllersEstado"><i class="fa fa-circle-o"></i> Estado</a></li>
                                        <li><a href="<?php echo base_url(); ?>index.php/topologia/ControllersMunicipio"><i class="fa fa-circle-o"></i> Municipio</a></li>
                                        <li><a href="<?php echo base_url(); ?>index.php/topologia/ControllersParroquia"><i class="fa fa-circle-o"></i> Parroquia</a></li>
                                    </ul>
                                   
                                </li>
                            </ul>
                        </li>

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-laptop"></i>
                                <span>Presupuesto</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i>Partidas Presupuestarias</a></li>
                                <li><a href="pages/UI/icons.html"><i class="fa fa-circle-o"></i> Bienes o Servicios</a></li>
                                <li><a href="pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Acción Centralizada</a></li>
                                <li><a href="pages/UI/sliders.html"><i class="fa fa-circle-o"></i> Planificación Presupuestaria</a></li>
              
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-edit"></i> <span>Compras</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="pages/forms/general.html"><i class="fa fa-circle-o"></i> Regla de Control Interno</a></li>
                                <li><a href="pages/forms/advanced.html"><i class="fa fa-circle-o"></i> Requerimientos</a></li>
                                <li><a href="pages/forms/editors.html"><i class="fa fa-circle-o"></i> Consulta de Precios</a></li>
                                <li><a href="pages/forms/editors.html"><i class="fa fa-circle-o"></i> LICITACIÓN</a></li>
           
                            </ul>
                        </li>
                       
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
         

        <!-- jQuery 2.1.4 -->
        <script src="<?= base_url() ?>static/plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.5 -->
        <script src="<?= base_url() ?>static/bootstrap/js/bootstrap.min.js"></script>
        <!-- datatables -->
        <script src="<?= base_url() ?>static/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?= base_url() ?>static/plugins/datatables/dataTables.bootstrap.min.js"></script>
        <!-- Morris.js charts -->
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>-->
        <!--<script src="<?= base_url() ?>static/plugins/morris/morris.min.js"></script>-->
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
        <!--<script src="<?= base_url() ?>static/dist/js/pages/dashboard.js"></script>-->
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
    </body>
</html>
