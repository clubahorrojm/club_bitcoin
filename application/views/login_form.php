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
    <head>
        <title>.:: Club del Ahorro ::.</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>static/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>static/css/select2.css"/>
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>static/css/select2-bootstrap.css"/>
        <!--<script src="<?= base_url() ?>static/js/jquery-1.11.2.min.js"></script>-->
        <script src="<?= base_url() ?>static/plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <script src="<?= base_url() ?>static/js/bootstrap.min.js"></script>

        <script src="<?= base_url() ?>static/js/bootstrap-datepicker.js"></script>
        <script src="<?= base_url() ?>static/js/bootstrap-datepicker.es.min.js"></script>
        <script src="<?= base_url() ?>static/js/select2.js"></script>
        <script src="<?= base_url() ?>static/js/select2_locale_es.js"></script>

        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>static/css/animate.css"/>
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>static/css/apprise.css"/>
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>static/css/estilo.css"/>


        <link rel="stylesheet" type="text/css" href="<?php echo base_url('static/css/style.css'); ?>">
     
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

                $("select").select2();
                
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
						alert("Error: Ingrese su nombre de usuario");
						$("#username_reg").parent('div').addClass('has-error')
						$("#username_reg").val('');
						$("#username_reg").focus();
					} else if($("#password_reg").val() == ''){
						alert("Error: Ingrese su contraseña");
						$("#password_reg").parent('div').addClass('has-error')
						$("#password_reg").val('');
						$("#password_reg").focus();
					} /*else if($("#tipo_moneda").val() == '0'){
						alert("Error: Seleccione la moneda");
						$("#tipo_moneda").parent('div').addClass('has-error')
						$("#tipo_moneda").val('0');
						$("#tipo_moneda").focus();
					}*/ 
					else if($("#correo").val() == ''){
						alert("Error: Ingrese su correo");
						$("#correo").parent('div').addClass('has-error')
						$("#correo").val('');
						$("#correo").focus();
					}else if(!(regex.test($('#correo').val().trim()))){
						alert("Error: Ha introducido una dirección de correo electrónico inválida");
						$("#correo").parent('div').addClass('has-error')
						$("#correo").val('');
						$("#correo").focus();
					} else {
						//~ alert('Código: '+$("#codigo").val());
						// Registramos el nuevo usuario
						$.post('<?php echo base_url(); ?>index.php/User_Authentication/registrar_referido/', $("#f_reg_usuario").serialize(), function(response) {
							//~ alert(response.trim());
							if (response.trim() == "1"){
								alert("El usuario ya existe");
								location.reload();
							}else{
								// Generamos el perfil del nuevo usuario
								$.post('<?php echo base_url(); ?>index.php/User_Authentication/registrar_perfil/', $("#f_reg_usuario").serialize(), function(response) {
									console.log(response);
								});
								
								alert('Usuario registrado exitosamente');
								url = '<?php echo base_url(); ?>index.php/'
								window.location = url
							}
						});
					}
				});
				
				// Generar enlace para registro de nuevo usuario
				$("#registrarse").click(function (e) {
					e.preventDefault();  // Para evitar que se envíe por defecto
										
					// Registramos el nuevo usuario
					$.post('<?php echo base_url(); ?>index.php/User_Authentication/enlace_disponible/', function(response) {
						//~ alert(response.trim());
						if (response.trim() == "1"){
							alert("No hay enlaces disponibles");
							location.reload();
						}else{
							url = response.trim();
							window.location = url
						}
					});
				});
			});
		</script>
    </head>
    <body>

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
                 

		<div class="wrapper">
							 
			
			<div class="container">
				<?php echo form_open(''); ?>
				<div class="col-lg-12">
					<div class="col-lg-3"></div>
					 <div class="col-lg-3"></div> 
<!-- 					<div class="col-lg-6">
						<button class="text-center" id="registrarse" style="color:#126584;font-size:15px;font-weight:bold;cursor:pointer;" title="Usted será redirigido al área de registro">Solicitar link</button>
					</div> -->
				</div>
				</form>

				<h1>El juego del Ahorro</h1>
				
				<?php echo form_open('User_Authentication/user_login_process'); ?>
				<form id="frmlogin" class="form-horizontal"  method="POST" enctype="multipart/form-data" autocomplete="off" role="form">
							
					<div class="col-lg-12">
						<div class="col-lg-3"></div>
						 <div class="col-lg-6"><img class="img-circle" src="<?= base_url() ?>static/img/default.gif" style="width: 80%" /></div> 
						<div class="col-lg-3"></div>
				   </div> 
				   <div class="col-lg-12">
					<center>
					<input type="text" id="username" name="username" placeholder="Usuario" >
					<input type="password" id="password" name="password" placeholder="Contraseña">
					<button type="submit" id="submit" name="submit" style="width:25%">Entrar</button>
					<!--<button type="button" id="rec_password" name="rec_password">Rec: Clave de Acceso</button>-->
					</br></br>
					<button type="button" id="registrar_referido" name="registrar_referido">Registrar</button>
					<a class="text-center " id="registrarse" style="color: white;font-size:20px;font-weight:bold;cursor:pointer;text-decoration: underline" title="Usted será redirigido al área de registro">Solicitar link</a>


					</center>
				   </div> 
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

		
		<div class="modal" id="modal_registrar">
		   <div class="modal-dialog">
			  <div class="modal-content">
				 <div class="modal-header" style="background-color:#296293">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">
					   <center><span class="glyphicon glyphicon-search"></span>
					   &nbsp;Introdúzca su usuario y su contraseña para crear la cuenta</center>
					</h4>
				 </div>
				 <div class="modal-body">
					<form id="f_reg_usuario" name="f_reg_usuario" action="" method="post">
					   <div class="form-group">
							<div class="col-sm-12">
								<input type="hidden" id="codigo" name="codigo" value="<?php echo $codigo;?>">
								<input type="hidden" id="link" name="link" value="<?php echo $link;?>">
								<input type="text" class="form-control" style="width: 100%; " id="username_reg" name="username_reg" placeholder="Usuario" autofocus="true">
							</div>
							</br></br></br>
							<div class="col-sm-12">
								<input style="width: 100%;" type="password" class="form-control" id="password_reg" name="password_reg" placeholder="Contraseña"/>
							</div>
							</br></br></br>
							<div class="col-sm-12">
								<input style="width: 100%;" type="text" class="form-control" id="correo" name="correo" placeholder="ejemplo@correo.com"/>
							</div>
							<!--<div class="col-sm-12">
								<select style="width: 100%;" class="form-control" id="tipo_moneda" name="tipo_moneda">
									<option value="0">Seleccione</option>
								</select>
							</div>-->
							</br>
							<div class="col-sm-12" align="right">
								<span class="input-btn">
									<button class="btn btn-primary" type="button" id="registrar">
										Registrar&nbsp;<span class="glyphicon glyphicon-share-alt"></span>
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
		
	</body>
</html>

