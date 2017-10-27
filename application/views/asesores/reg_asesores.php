<html>
    <?php
    if (isset($this->session->userdata['logged_in'])) {

        header("location: http://localhost/club_bitcoin/index.php/User_Authentication/user_login_process");
    }
    
    ?>
    <head><link  href="<?= base_url() ?>static/img/login_adm/logo-01.png" rel='shortcut icon' type='image/png'/>
        <title>Criptozone</title>
        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">-->
		<link rel="stylesheet" href="<?= base_url() ?>static/font-awesome/css/font-awesome.css">
		<link rel="stylesheet" href="<?= base_url() ?>static/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>static/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>static/plugins/datepicker/datepicker3.css">
        <link rel="stylesheet" href="<?= base_url() ?>static/plugins/daterangepicker/daterangepicker-bs3.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>static/css/select2.css"/>
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>static/css/select2-bootstrap.css"/>
        <!--<script src="<?= base_url() ?>static/js/jquery-1.11.2.min.js"></script>-->
        <script src="<?= base_url() ?>static/plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <script src="<?= base_url() ?>static/bootstrap/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="<?= base_url() ?>static/dist/css/AdminLTE.min.css">
		<!--stepyform-->
		<script type="text/javascript" src="<?= base_url() ?>static/js/jquery.stepyform.js"></script>
		<script type="text/javascript" src="<?= base_url() ?>static/js/jquery-ui.min.js"></script>
		<script src="<?= base_url() ?>static/js/bootstrap-slider.js"></script>
		
        <script src="<?= base_url() ?>static/plugins/datepicker/bootstrap-datepicker.js"></script>
        <script src="<?= base_url() ?>static/js/bootstrap-datepicker.js"></script>
        <script src="<?= base_url() ?>static/js/bootstrap-datepicker.es.min.js"></script>
        <script src="<?= base_url() ?>static/js/select2.js"></script>
        <script src="<?= base_url() ?>static/js/select2_locale_es.js"></script>

        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>static/css/animate.css"/>
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>static/css/apprise.css"/>
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>static/css/estilo.css"/>

		<!--<link rel="stylesheet" type="text/css" href="<?= base_url() ?>static/css/AdminLTE.min.css"/>-->
		

        <link rel="stylesheet" type="text/css" href="<?php echo base_url('static/css/style.css'); ?>">
		<!-- Jquery numeric -->
        <script src="<?= base_url() ?>static/js/jquery.numeric.js"></script>  
        <!-- Jquery alphanumeric -->
        <script src="<?= base_url() ?>static/js/jquery.alphanumeric.js"></script>
		<script src="<?= base_url() ?>static/js/bootbox.js"></script>
		
		
		<script>
		$(document).ready(function () {
				// 
				$("#paso1").click(function (e) {
					
					e.preventDefault();
					document.getElementById('paso1').className ='btn btn-app text-red';
					document.getElementById('paso2').className ='btn btn-app text-black';
					document.getElementById('paso3').className ='btn btn-app text-black';
					document.getElementById('paso4').className ='btn btn-app text-black';
					
					
				});
				$("#paso2").click(function (e) {
					e.preventDefault();
					
					document.getElementById('paso2').className ='btn btn-app text-red';
					document.getElementById('paso1').className ='btn btn-app text-black';
					document.getElementById('paso3').className ='btn btn-app text-black';
					document.getElementById('paso4').className ='btn btn-app text-black';
				});
				$("#paso3").click(function (e) {
					e.preventDefault();
					document.getElementById('paso3').className ='btn btn-app text-red';
					document.getElementById('paso1').className ='btn btn-app text-black';
					document.getElementById('paso2').className ='btn btn-app text-black';
					document.getElementById('paso4').className ='btn btn-app text-black';
				});
				$("#paso4").click(function (e) {
					e.preventDefault();
					document.getElementById('paso4').className ='btn btn-app text-red';
					document.getElementById('paso1').className ='btn btn-app text-black';
					document.getElementById('paso2').className ='btn btn-app text-black';
					document.getElementById('paso3').className ='btn btn-app text-black';
				});

				$('select').on({
                    change: function () {
                        $(this).parent('div').removeClass('has-error');
                    }
                });
                $('input').on({
                    keypress: function () {
                        $(this).parent('div').removeClass('has-error');
                    }
                });

                $("select").select2();
                
				$('#fecha_na').numeric({allow: "/"});
				$('#username').alphanumeric();
				$('#password').alphanumeric({allow: "+-/#@*"});
			
			$("#registrar").click(function (e) {
				e.preventDefault();
				////////////////////////////////////////////////////////
				////////// Validacion de campos vacios PASO 1 //////////
				if ($("#pais_doc_id").val() == 0) {
					bootbox.alert("Debe seleccionar el país del documento a registrar", function () {
						$('.nav-tabs a[href=#tabs_A]').tab('show');
						document.getElementById('paso1').className ='btn btn-app text-red';
						document.getElementById('paso2').className ='btn btn-app text-black';
						document.getElementById('paso3').className ='btn btn-app text-black';
						document.getElementById('paso4').className ='btn btn-app text-black';
					}).on('hidden.bs.modal', function (event) {
						$("#pais_doc_id").parent('div').addClass('has-error');
						$("#pais_doc_id").focus();
					});
				}else if ($("#num_documento").val() == '') {
					bootbox.alert("Debe introducir el número del documento", function () {
						$('.nav-tabs a[href=#tabs_A]').tab('show');
						document.getElementById('paso1').className ='btn btn-app text-red';
						document.getElementById('paso2').className ='btn btn-app text-black';
						document.getElementById('paso3').className ='btn btn-app text-black';
						document.getElementById('paso4').className ='btn btn-app text-black';
					}).on('hidden.bs.modal', function (event) {
							$("#num_documento").parent('div').addClass('has-error');
							$("#num_documento").focus();
					});
				}else if ($("#tipo_doc_id").val() == '0') {
					bootbox.alert("Debe seleccionar el tipo de documento a registrar", function () {
						$('.nav-tabs a[href=#tabs_A]').tab('show');
						document.getElementById('paso1').className ='btn btn-app text-red';
						document.getElementById('paso2').className ='btn btn-app text-black';
						document.getElementById('paso3').className ='btn btn-app text-black';
						document.getElementById('paso4').className ='btn btn-app text-black';
					}).on('hidden.bs.modal', function (event) {
							$("#tipo_doc_id").parent('div').addClass('has-error');
							$("#tipo_doc_id").focus();
					});
				}else if ($("#dia_doc_id").val() == '0') {
					bootbox.alert("Debe seleccionar el día de emisión del documento", function () {
						$('.nav-tabs a[href=#tabs_A]').tab('show');
						document.getElementById('paso1').className ='btn btn-app text-red';
						document.getElementById('paso2').className ='btn btn-app text-black';
						document.getElementById('paso3').className ='btn btn-app text-black';
						document.getElementById('paso4').className ='btn btn-app text-black';
					}).on('hidden.bs.modal', function (event) {
							$("#dia_doc_id").parent('div').addClass('has-error');
							$("#dia_doc_id").focus();
					});
				}else if ($("#mes_doc_id").val() == '0') {
					bootbox.alert("Debe seleccionar el mes de emisión del documento", function () {
						$('.nav-tabs a[href=#tabs_A]').tab('show');
						document.getElementById('paso1').className ='btn btn-app text-red';
						document.getElementById('paso2').className ='btn btn-app text-black';
						document.getElementById('paso3').className ='btn btn-app text-black';
						document.getElementById('paso4').className ='btn btn-app text-black';
					}).on('hidden.bs.modal', function (event) {
							$("#mes_doc_id").parent('div').addClass('has-error');
							$("#mes_doc_id").focus();
					});
				}else if ($("#year_doc_id").val() == '0') {
					bootbox.alert("Debe seleccionar el año de emisión del documento", function () {
						$('.nav-tabs a[href=#tabs_A]').tab('show');
						document.getElementById('paso1').className ='btn btn-app text-red';
						document.getElementById('paso2').className ='btn btn-app text-black';
						document.getElementById('paso3').className ='btn btn-app text-black';
						document.getElementById('paso4').className ='btn btn-app text-black';
					}).on('hidden.bs.modal', function (event) {
							$("#year_doc_id").parent('div').addClass('has-error');
							$("#year_doc_id").focus();
					});
				/////////////////////////////////   PASO 2   //////////////////////////////////
				}else if ($("#year_doc_id").val() == '0') {
					bootbox.alert("Debe seleccionar el año de emisión del documento", function () {
						$('.nav-tabs a[href=#tabs_A]').tab('show');
						document.getElementById('paso1').className ='btn btn-app text-red';
						document.getElementById('paso2').className ='btn btn-app text-black';
						document.getElementById('paso3').className ='btn btn-app text-black';
						document.getElementById('paso4').className ='btn btn-app text-black';
					}).on('hidden.bs.modal', function (event) {
							$("#year_doc_id").parent('div').addClass('has-error');
							$("#year_doc_id").focus();
					});
				}else{}
			});
		});
	</script>
		
		
		<style type="text/css">
		
/*			body{
				font-family: Verdana;
				font-size: 14px;
				height: 700px;
			}*/
			
			/*form*/
			/*{*/
			/*	border:1px solid gray;*/
			/*	height: auto;*/
			/*	background-image: url('<?= base_url() ?>static/img/modal_registro/fondo.png');*/
			/*	background-size: 100%;*/
			/*	background-repeat: no-repeat;*/
			/*	margin-top: 40px;*/
			/*	margin-left: auto;*/
			/*	margin-right: auto;*/
			/*	max-width: 80%;*/
			/*	padding: 20px;*/
			/*	padding-right: 40px;*/
			/*	padding-bottom: 40px;*/
			/*}*/
			
			form input
			{
				display: block;
				height: 30px;
				margin-bottom: 10px;
				padding-left: 10px;
				width: 100%;
			}
			form label{
				color: #4451A3 !important;
				/*border-color: #4451A3;*/
				font-weight: bold;

				
			}

			/*Custom Styles*/
			.navigate{
				background-color: #513085;
				color: white !important;
				border: 0px none transparent;
				border-radius: 2px;
				box-sizing: border-box;
				color: rgba(0, 0, 0, 0.8);
				cursor: pointer;
				display: inline-block;
				font-family: inherit;
				font-size: 100%;
				line-height: normal;
				padding: 0.5em 1em;
				text-align: center;
				text-decoration: none;
				vertical-align: middle;
				white-space: nowrap;
				-moz-user-select: none;
			}
			
			.next{
				float: right;
			}
			
			.prev{
				float: left;
			}
		</style>
		
    </head>
	
    <body class="hold-transition skin-blue sidebar-mini">

		<!--<div align="center">
            <img src="<?= base_url() ?>static/img/TOPE-SISTEM-ADMIN-003.jpg" style="width: 100%;"/>
        </div>-->               

		<div class="wrapper" >			 
			<div class="box box-primary" style="width: 80%; margin-top: 2%; margin-left: 10%; background-color: #FFFFFF">
				<div class="box-body" style="margin-top: -2% ">
			        <!-- SELECT2 EXAMPLE -->
					<legend><h2>Registro de Asesor</h2></legend>
					<label style="color: #000000; text-align: justify">
						Por razones de seguridad, en pro de garantizar la confiabilidad de nuestros usuarios en sus operaciones,
						le pediremos que nos brinde cierta información personal y documentos de respaldo, para prevenir y
						mitigar los posibles riesgos de que Criptozone se involucre en cualquier tipo de actividad ilegal.
						Sin embargo, la verificación en Criptozone es sencilla e intuitiva, compuesta por cuatro (04) pasos.
					</label><br><br>
						<form  style="margin-top: 0%; ">
							<div class="panel-body" style="background-color: #F2F2F2;">
								<!-- Apertura de Tabs (Secciones) -->
								<ul class="nav nav-tabs" >
									<li id="tagpaso1" class="active " data-toggle="popover" data-trigger="focus" title="Documentos de Identidad" data-placement="top">
										<a style="background-color: #D8D2D2;" id="paso1" class="btn btn-app text-red" data-toggle="tab" href="#tabs_A">
											<span class="badge bg-yellow" style="font-weight: bold"><?php echo $cant_ingresos?></span>
											<i class="fa fa-address-card "></i>
											PASO 1
										</a>
									</li>
									<li id="tagpaso2"  data-toggle="popover" data-trigger="focus" title="Datos del Bien" data-content="En este panel se ingresan los datos principales de la empresa" data-placement="top">
										<a style="background-color: #D8D2D2;" id="paso2" class="btn btn-app text-black" data-toggle="tab" href="#tabs_B">
											<span class="badge bg-blue " style="font-weight: bold"><?php echo $cant_gastos_comunes?></span>
											<i class="fa fa-user-circle"></i>
											PASO 2
										</a>
									</li>
									<li id="tagpaso3"  data-toggle="popover" data-trigger="focus" title="Imagenes" data-content='En este panel se selecciona la clasificación del bien' data-placement="top">
										
										<a style="background-color: #D8D2D2;" id="paso3"class="btn btn-app text-black" data-toggle="tab" href="#tabs_C">
											<span class="badge bg-green" style="font-weight: bold"><?php echo $cant_gastos_no_comunes?></span>
											<i class="fa fa-street-view"></i>
											PASO 3
										</a>
									</li>
									<li id="tagpaso4"  data-toggle="popover" data-trigger="focus" title="Imagenes" data-content='En este panel se selecciona la clasificación del bien' data-placement="top">
										
										<a style="background-color: #D8D2D2;" id="paso4" class="btn btn-app text-black" data-toggle="tab" href="#tabs_D">
											<span class="badge bg-red" style="font-weight: bold"><?php echo $cant_cargos?></span>
											<i class="fa fa-files-o"></i>
											PASO 4
										</a>
									</li>
								</ul>
								<div class="tab-content ">
									<div id="tabs_A" class="tab-pane fade in active  ">             
										<?php include("paneles/paso1.php"); ?>
									</div>
									<div id="tabs_B" class="tab-pane">             
										<?php include("paneles/paso2.php"); ?>
									</div>
									<div id="tabs_C" class="tab-pane">             
										<?php include("paneles/paso3.php"); ?>
									</div>
									<div id="tabs_D" class="tab-pane">             
										<?php include("paneles/paso4.php"); ?>
									</div>
								</div>
							</div>
						</form>
				</div>
			</div>
		</div>
	</body>
</html>

