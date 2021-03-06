<html>
    <?php
    if (isset($this->session->userdata['logged_in'])) {

        header("location: http://localhost/club_bitcoin/index.php/User_Authentication/user_login_process");
    }
    
    $codigo = 'vacío';
    $link = 'vacío';
    if (isset($_GET['codigo'],$_GET['link'])) {
		if($_GET['codigo'] != '' && $_GET['link'] != ''){
			$codigo = $_GET['codigo'];
			$link = $_GET['link'];
			//~ echo "Variables correctas";
		}else{
			$codigo = 'vacío';
			$link = 'vacío';
			//~ echo "Variables erróneas";
		}
	}else{
		$codigo = 'vacío';
		$link = 'vacío';
		//~ echo "Variables erróneas";
	}
	
	//~ echo "Código: ".$codigo;
	//~ echo "<br>";
    //~ echo "Link: ".$link;
    
    ?>
    <head><link  href="<?= base_url() ?>static/img/login_adm/logo-01.png" rel='shortcut icon' type='image/png'/>
        <title>Criptozone</title>
        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">-->
        <link rel="stylesheet" href="<?= base_url() ?>static/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>static/plugins/datepicker/datepicker3.css">
        <link rel="stylesheet" href="<?= base_url() ?>static/plugins/daterangepicker/daterangepicker-bs3.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>static/css/select2.css"/>
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>static/css/select2-bootstrap.css"/>
        <!--<script src="<?= base_url() ?>static/js/jquery-1.11.2.min.js"></script>-->
        <script src="<?= base_url() ?>static/plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <script src="<?= base_url() ?>static/bootstrap/js/bootstrap.min.js"></script>

        <script src="<?= base_url() ?>static/plugins/datepicker/bootstrap-datepicker.js"></script>
        <script src="<?= base_url() ?>static/js/bootstrap-datepicker.js"></script>
        <script src="<?= base_url() ?>static/js/bootstrap-datepicker.es.min.js"></script>
        <script src="<?= base_url() ?>static/js/select2.js"></script>
        <script src="<?= base_url() ?>static/js/select2_locale_es.js"></script>

        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>static/css/animate.css"/>
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>static/css/apprise.css"/>
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>static/css/estilo.css"/>

		<link rel="stylesheet" type="text/css" href="<?= base_url() ?>static/css/AdminLTE.min.css"/>
		

        <link rel="stylesheet" type="text/css" href="<?php echo base_url('static/css/style.css'); ?>">
		<!-- Jquery numeric -->
        <script src="<?= base_url() ?>static/js/jquery.numeric.js"></script>  
        <!-- Jquery alphanumeric -->
        <script src="<?= base_url() ?>static/js/jquery.alphanumeric.js"></script>
		<script src="<?= base_url() ?>static/js/bootbox.js"></script>
		
		
		<script>
			$(document).ready(function () {

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

                //$("select").select2();
                
				$('#fecha_na').numeric({allow: "/"});
				$('#username').alphanumeric();
				$('#password').alphanumeric({allow: "+-/#@*"});
				
				$('#fecha_na').datepicker({
					format: "dd/mm/yyyy",
					language: "es",
					autoclose: true,
				})
				
				// CAMBIO DE COLOR DE TEXBOX
				//
				//document.getElementById("username").addEventListener("click", function() {
				//	document.getElementById('username').style.backgroundColor ='#FFFFFF';
				//	document.getElementById('username').style.color ='#000000';
				//	document.getElementById('password').style.backgroundColor ='#22274b';
				//	document.getElementById('password').style.color ='#edd727';
				//	//document.getElementById("username").className += " placOn";
				//	//document.getElementById("password").className += " placOff";
				//}, false);
				//document.getElementById("password").addEventListener("click", function() {
				//	document.getElementById('password').style.backgroundColor ='#FFFFFF';
				//	document.getElementById('password').style.color ='#000000';
				//	document.getElementById('username').style.backgroundColor ='#22274b';
				//	document.getElementById('username').style.color ='#edd727';
				//	//document.getElementById("username").className += " placOff";
				//	//document.getElementById("password").className += " placOn";
				//}, false);
				
                // Pre-carga de la lista de tipos de moneda
                $('#tipo_moneda').find('option:gt(0)').remove().end().select2('val', '0');
				$.get('<?php echo base_url(); ?>index.php/busquedas_ajax/ControllersBusqueda/monedas/', function (data) {
					var option = "";
					$.each(data, function (i) {
						option += "<option value=" + data[i]['codigo'] + ">" + data[i]['descripcion'] + "</option>";
					});
					$('#tipo_moneda').append(option);

				}, 'json');				
				
				//~ alert($("#codigo").val().trim());
				//~ alert($("#link").val().trim());
				// Habilitar/Deshabilitar campos y botones de sesión
				if($("#codigo").val().trim() != 'vacío' && $("#link").val().trim() != 'vacío')
				{
					// Validar existencia y estatus del enlace
					var cod = $("#codigo").val();
					var num_link = $("#link").val();
					$.get('<?php echo base_url(); ?>index.php/busquedas_ajax/ControllersBusqueda/busqueda_enlace/'+cod+'/'+num_link, function (data) {
						//~ alert(data.length);
						// Validamos si el enlace existe
						if(data.length > 0){
							var estatus = 0;
							$.each(data, function (i) {
								estatus = data[i]['estatus'];
							});
							// Validamos el estatus del enlace
							if(estatus == 1 || estatus == 3){
								$("#username").css("display","none");
								$("#password").css("display","none");
								$("#submit").css("display","none");
								$("#registrarse").css("display","none");
								$("#registrar_referido").css("display","block");
								$("#rec_password").css("display","none");
							}else{
								alert("El enlace ya no está disponible");
								url = '<?php echo base_url(); ?>index.php/';
								window.location = url;
							}
						}else{
							alert("El enlace es erroneo");
							url = '<?php echo base_url(); ?>index.php/';
							window.location = url;
						}
					}, 'json');
					
				}else{
					$("#username").css("display","block");
					$("#password").css("display","block");
					$("#submit").css("display","block");
					$("#registrar_referido").css("display","none");
					$("#rec_password").css("display","block");
				}
				
				// Activar modal al hacer click en el enlace de recuperación
				$("#registrar_referido").click(function (e) {
					e.preventDefault();  // Para evitar que se envíe por defecto
					$("#modal_registrar").modal('show');
				});				
				
				// Validar formulario de registro de usuario referido
				$("#registrar").click(function (e) {
					e.preventDefault();  // Para evitar que se envíe por defecto
					// Expresion regular para validar el correo
					var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
					
					if($("#username_reg").val() == ''){
						bootbox.alert('<h4>Error: Ingrese su nombre de usuario</h4>', function () {
							$("#username_reg").parent('div').addClass('has-error');
							$("#username_reg").val('');
							$("#username_reg").focus();	
						});
					} else if($("#password_reg").val() == ''){
						bootbox.alert('<h4>Error: Ingrese su contraseña</h4>', function () {
							$("#password_reg").parent('div').addClass('has-error');
							$("#password_reg").val('');
							$("#password_reg").focus();
						});
					} else if($("#correo").val() == ''){
						bootbox.alert('<h4>Error: Ingrese su correo</h4>', function () {
							$("#password_reg").parent('div').addClass('has-error');
							$("#password_reg").val('');
							$("#password_reg").focus();
						});
					}else if(!(regex.test($('#correo').val().trim()))){
						bootbox.alert('<h4>Error: Ha introducido una dirección de correo electrónico inválida</h4>', function () {
							$("#correo").parent('div').addClass('has-error');
							$("#correo").val('');
							$("#correo").focus();
						});
					} else {
						// Registramos el nuevo usuario
						$.post('<?php echo base_url(); ?>index.php/User_Authentication/registrar_referido/', $("#f_reg_usuario").serialize(), function(response) {
							//~ alert(response.trim());
							if (response.trim() == "1"){
								bootbox.alert('<h4>Disculpe, el usuario ya está registrado...<h4>', function () {
									
								});
								//~ location.reload();
							}else{
								// Generamos el perfil del nuevo usuario
								$.post('<?php echo base_url(); ?>index.php/User_Authentication/registrar_perfil/', $("#f_reg_usuario").serialize(), function(response) {
									console.log(response);
								});
								bootbox.alert('<h4>Su registro se ha llevado a cabo con éxito, espere un mensaje de confirmación en el correo electrónico proporcionado<h4>', function () {
									url = '<?php echo base_url(); ?>index.php/'
									window.location = url
								});
								
							}
						});
					}
				});
				
				// Generar enlace para registro de nuevo usuario
				$("#registrarse").click(function (e) {
					e.preventDefault();  // Para evitar que se envíe por defecto
					$.post('<?php echo base_url(); ?>index.php/User_Authentication/enlace_disponible2/', function(response) {
						//alert(response.trim());
						if (response.trim() == 1){
							bootbox.alert('<h4>Disculpe, en este momento no hay links disponibles', function () {
								url = '<?php echo base_url(); ?>index.php/'
								window.location = url;
							});
						}else{
							var cadena = response.split("@@@");
							var cod_link = cadena[0];
							//var userd_id = cadena[1];
							var num_link = cadena[1];
							$("#codigo").val(cod_link.trim());
							$("#link").val(num_link);
							$("#modal_registrar").modal('show'); 
						}
						
					});
				});
				
				// Activar modal al hacer click en el enlace de recuperación
				$("#rec_password").click(function (e) {
					e.preventDefault();  // Para evitar que se envíe por defecto
					$("#modal_clave").modal('show');
				});
				
				// Validar formulario
				$("#cambiar").click(function (e) {
					e.preventDefault();  // Para evitar que se envíe por defecto
					
					if($("#username_rec").val() == ''){
						bootbox.alert("Introdúzca el Usuario", function () {
						}).on('hidden.bs.modal', function (event) {
							$("#username_rec").parent('div').addClass('has-error')
							$("#username_rec").val('');
							$("#username_rec").focus();
						});
					} else {
						//~ alert($("#username_rec").val());
						$.post('<?php echo base_url(); ?>index.php/User_Authentication/recuperar_basico/', $("#f_change_key").serialize(), function(response) {
							//~ alert(response.trim());
							if (response.trim() != "Usuario inexistente."){
								bootbox.alert("<h4>Se ha generado su nueva clave con éxito, espere un mensaje de confirmación en su correo electrónico.</h4>", function () {
								}).on('hidden.bs.modal', function (event) {
									location.reload();
								});
							}else{
								bootbox.alert("<h4>"+response.trim()+"</h4>", function () {
								}).on('hidden.bs.modal', function (event) {
									
								});
							}
						});
					}
				});
			});
		</script>
		
		
		<style type="text/css">
		
			#modal_registrar input{
				opacity: 0.5;
				border-bottom-right-radius: 5px;
				border-top-right-radius: 5px;
				background-color: #4451A3;
				width: 100%;
				color: white !important;
				border-color: #4451A3;
				font-weight: bold;

				
			}
			#modal_registrar span{
				opacity: 0.5;
				background-size: 100%;
				background-repeat: no-repeat;
				border-top-left-radius: 5px;
				border-bottom-left-radius: 5px;
				background-color: #4451A3;
				border-color: #4451A3;
			}
			#modal_registrar select{
				background-color: #FFFFFF;
				border-color: #FFFFFF;
			}
			#modal_registrar div{
				border: hidden;
				
			}
			::-moz-placeholder {
				color: white !important;
				font-size: 14px;
				font-weight: bold;
			}
			input{
				font-size: 14px;
				font-weight: bold;
			}
		</style>
		
    </head>
    <body >

		<!--<div align="center">
            <img src="<?= base_url() ?>static/img/TOPE-SISTEM-ADMIN-003.jpg" style="width: 100%;"/>
        </div>-->


        <?php
        if (isset($logout_message)) {
            echo "</br><div class='alert alert-dismissible alert-success' style='text-align: center'>";
            echo "<button type='button' class='close' data-dismiss='alert'>X</button>";
            echo $logout_message;
            echo "</div>";
        }
        ?>
        <?php
        if (isset($message_display)) {
            echo "<div class='alert alert-dismissible alert-success' style='text-align: center'>";
            echo "<button type='button' class='close' data-dismiss='alert'>X</button>";
            echo $message_display;
            echo "</div>";
        }
        ?>
        <?php
        if (isset($error_message)) {
            echo "<div class='alert alert-dismissible alert-danger' style='text-align: center'>";
            echo "<button type='button' class='close' data-dismiss='alert'>X</button>";
            echo $error_message;
           
        }
           
//            echo  validation_errors();
            echo "</div>";

       
        ?>
                 

		<div class="wrapper" >
							 
			
			<div class="container" style="margin-top: -3%">
				<?php echo form_open(''); ?>
				</form>
				
				<?php echo form_open('User_Authentication/user_login_process'); ?>
				<form id="frmlogin" class="form-horizontal"  method="POST" enctype="multipart/form-data" autocomplete="off" role="form">
					<div class="login-box">
						<!-- /.login-logo -->
						<div  style=" background-image: url('<?= base_url() ?>static/img/login_adm/contenido.png'); background-size: 100%">
							<br>
							<div class="col-xs-12 text-left" ><img  src="<?= base_url() ?>static/img/login_adm/logo-01.png" style="width: 35%"/></div>
							<center>
								
							</center>
					  
							<form action="../../index2.html" method="post" class="text-center">
							  <div class="col-xs-1">&nbsp;</div>
							  <div class="col-xs-10">
								  <div class="input-group"  style="border-bottom: solid  2px ;  border-bottom-color: #513085; ">
									  
									  <span class="input-group-addon" style="background-color: transparent; border: none; background-image: url('<?= base_url() ?>static/img/login_adm/nombre.png'); background-size: 100%; background-repeat: no-repeat"></span>
									  <input style="background-color: transparent; border: none;" class="form-control" type="text" id="username" name="username" >
									  
								  </div>
								  <br>
								  <div class="input-group" style="border-bottom: solid  2px ;  border-bottom-color: #513085; ">
									  <span class="input-group-addon" style="background-color: transparent; border: none; background-image: url('<?= base_url() ?>static/img/login_adm/clave.png'); background-size: 100%; background-repeat: no-repeat"></span>
									  <input style="background-color: transparent; border: none;" class="form-control" type="password" id="password" name="password" placeholder="">
									  <input style="background-color: #22274b; width: 50%; color: #edd727; font-weight: bold "  type="hidden" id="type_user" name="type_user" value="BÁSICO">
								  </div>
								  <br>
								  <button type="submit" class="btn-sm  btn-block btn-flat" id="submit" name="submit" style="width: 45%; background-color: #001a5a; color: white; font-weight: bold  ">INICIAR SESIÓN</button>
								  <br>
								  <a href="#" id="rec_password" style="color: white">¿SE TE OLVIDÓ TU CONTRASEÑA?</a><br>
								  <button  type="button" id="registrar_referido" name="registrar_referido">Registrar</button>
								  
							  </div>
							  <div class="col-xs-1">&nbsp;</div>
							  <div class="row">
								  <div class="col-xs-8"></div>
							  </div>
							</form>
							  <br>		  
						 
						  
						</div>
						
						<div id="registrarse"  style=" background-image: url('<?= base_url() ?>static/img/login_adm/registrar.png'); background-size: 102%; background-repeat: no-repeat">
							<br>
							<div class="row">
								<a><h3 style="font-weight: bold; color: #513085;">REGISTRATE</h3></a><br>
							</div>
							<br><br>
						</div>
						<!-- /.login-box-body -->
					  </div>
					  <!-- /.login-box -->
				</form>
						
			</div>
			
			<ul class="bg-bubbles">
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
			</ul>
					 <?php echo form_close(); ?>
						   
		</div>

		<!-- Modal para registro de usuarios nuevos -->
		<div class="modal" id="modal_registrar" style="height:auto; margin-top: 3%">
		   <div class="modal-dialog" style="height:auto; background-image: url('<?= base_url() ?>static/img/modal_registro/fondo.png'); background-size: 100%; background-repeat: no-repeat">
			  <div style="height:auto;">
				 <div class="modal-header text-center" >
					<label style="color: #001a5a !important; font-size: 24px; font-weight: bold" >
					    Formulario de Registro
					</label>
				 </div>
				 <div class="modal-body" style="height:auto;">
					<form id="f_reg_usuario" name="f_reg_usuario" action="" method="post">
							<div class="col-sm-12" style="margin-top: -5%">
								<label style="color: #000000; font-weight: bold;" class="text-center">
									Llene los datos solicitados en el formulario, recuerde que los campos identificados con (*) son obligatorios,
									por lo tanto no pueden quedar en blanco.
								</label>
								<input type="hidden" id="codigo" name="codigo" value="<?php echo $codigo;?>">
								<input type="hidden" id="link" name="link" value="<?php echo $link;?>">
							</div>
							<div class="col-sm-6">
								<div class="input-group" >
									<span class="input-group-addon" style=" background-image: url('<?= base_url() ?>static/img/modal_registro/nombre.png'); "></span>
									<input type="text" class="form-control"  id="first_name" name="first_name" placeholder="NOMBRE" autofocus="true">
								</div>
							</div>
							
							<div class="col-sm-6">
								<div class="input-group">
									<span class="input-group-addon" style=" background-image: url('<?= base_url() ?>static/img/modal_registro/nombre.png'); "></span>
									<input type="text" class="form-control"  id="last_name" name="last_name" placeholder="APELLIDO" autofocus="true">
								</div>
							</div>
							<div class="col-sm-12">&nbsp;</div>
							<div class="col-sm-6">
								<div class="input-group" >
									<span class="input-group-addon" style=" background-image: url('<?= base_url() ?>static/img/modal_registro/fecha.png'); "></span>
									<input type="text" class="form-control"  id="fecha_na" name="fecha_na" placeholder="00/00/0000" autofocus="true">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="input-group" >
									<span class="input-group-addon" style=" background-image: url('<?= base_url() ?>static/img/modal_registro/correo.png'); "></span>
									<input type="text" class="form-control" id="correo" name="correo" placeholder="CORREO ELECTRONICO (*)"/>
								</div>
							</div>
							<div class="col-sm-12">&nbsp;</div>
							<div class="col-sm-6">
								<div class="input-group" >
									<span class="input-group-addon" style=" background-image: url('<?= base_url() ?>static/img/modal_registro/perfil.png'); "></span>
									<input type="text" class="form-control" id="username_reg" name="username_reg" placeholder="USUARIO (*)" autofocus="true">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="input-group" >
									<span class="input-group-addon" style=" background-image: url('<?= base_url() ?>static/img/modal_registro/pass.png'); "></span>
									<input type="password" class="form-control" id="password_reg" name="password_reg" placeholder="CONTRASEÑA (*)"/>
								</div>
							</div>
							<div class="col-sm-12">&nbsp;</div>
							<div class="col-md-6">
								<div class="form-group">
									<label style="font-weight:bold; color: #513085">PAÍS</label>
									<select class="form-control select2" id="pais_id" maxlength="7" name="pais_id">
										<option value="0">Seleccione</option>
										<?php foreach ($listar_paises as $pais) { ?>
											<option value="<?php echo $pais->codigo;?>"><?php echo $pais->descripcion;?></option>
										 <?php }?> 
									</select>
								</div><!-- /.form-group -->
							</div><!-- /.form-group -->
							<div class="col-md-6">
								<div class="form-group">
									<label style="font-weight:bold; color: #513085">LLEGASTE A NOSOTROS POR </label>
									<select class="form-control " id="patrocinador_id"  name="patrocinador_id" >
										<option value="0">Seleccione</option>
										<option value="1">Facebook</option>
										<option value="2">Twitter</option>
										<option value="3">Instagram</option>
										<option value="4">Google +</option>
										<option value="5">Página web</option>
										<option value="6">Por un amigo</option>
										<option value="7">Por Tv</option>
										<option value="8">Youtube</option>
									</select>
								</div><!-- /.form-group -->
							</div><!-- /.form-group -->
							<div class="col-md-12" align="center">
								<button class="btn" style="border-radius: 25px; background-color: #001a5a; width:25%; font-weight: bold; color: white" type="button" id="registrar">
									Registrar&nbsp;
								</button>
							</div>&nbsp;
					</form>
				 </div>
				 
			  </div>
		   </div>
		</div>
		<!-- Cierre Modal para registro de usuarios nuevos -->
		
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
					<form id="f_change_key" name="f_change_key" action="" method="post">
					   <div class="form-group">
							<div class="col-sm-12">
								<input type="text" class="form-control" style="width: 100%; " id="username_rec" name="username_rec" placeholder="Usuario" autofocus="true">
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
		<!-- Cierre Modal para recuperación de clave de usuarios generales -->
		
	</body>
</html>

