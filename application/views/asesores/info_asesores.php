<html>
    <?php
    if (isset($this->session->userdata['logged_in'])) {

        header("location: http://localhost/club_bitcoin/index.php/User_Authentication/user_login_process");
    }
    
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
		<script type="text/javascript" src="<?= base_url() ?>static/js/jquery.stepyform.js"></script>
		<script type="text/javascript" src="static/js/jquery-ui.min.js"></script>
		<link rel="stylesheet" href="<?= base_url() ?>static/css/slider.css">
		<script src="<?= base_url() ?>static/js/bootstrap-slider.js"></script>
		
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
				$("form").stepyform({
					navButtonsAttrs: {
						"class":"navigate"
					},
					nextButtonsClass: "next",
					prevButtonsClass: "prev",
					onChangeStep: function(){
						console.log(this);
					}
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
			});
		</script>
		
		
		<style type="text/css">
		
/*			body{
				font-family: Verdana;
				font-size: 14px;
				height: 700px;
			}*/
			
			form
			{
				/*border:1px solid gray;*/
				height: auto;
				background-image: url('<?= base_url() ?>static/img/modal_registro/fondo.png');
				background-size: 100%;
				background-repeat: no-repeat;
				margin-top: 40px;
				margin-left: auto;
				margin-right: auto;
				max-width: 80%;
				padding: 20px;
				padding-right: 40px;
				padding-bottom: 40px;
			}
			
			form input
			{
				display: block;
				height: 30px;
				margin-bottom: 10px;
				padding-left: 10px;
				width: 100%;
			}
			
			/*Custom Styles*/
			.navigate{
				background-color: #E6E6E6;
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
							 
			
			                    <!-- SELECT2 EXAMPLE -->							
                            	<form style="width: 70%; margin-top: 2%; margin-left: 15%; ">
									<h3 style="margin-top: 1% ">ASESORES</h3>
									<br>
									<label style="color: #000000; font-size: 12px; text-align: justify">
										Los Asesores, hacen parte vital de nuestra plataforma criptozone, porque gracias a su colaboracion podemos atraer
										día a día mayor cantidad de referidos, bla bla bla bla.
										Si estas interesado en ser parte de la familia criptozone, primero lee detenidamente los requerimientos o recaudos
										que necesitamos de ti, bla bla bla.
										Ya que con ellos garantizamos tu seguridad y la de todos los usuarios, bla bla bla.
										Si tienes todos los recaudos solicitados y la informacion a la mano, solo basta hacer clic en el boton registrar,
										muchas gracias por querer pertenecer a nuestra familia
									</label>
									<div class="stepy-step">
										<h4>Paso 1: Documentos de Identidad</h4>
										<label style="color: #000000; font-size: 12px; text-align: justify">
											Aqui se le solicitara proporcionar el documento con el cual desea identificarse contando con las opciones de
											pasaporte, documento de identidad o carné de conducir, asi como la fecha de registro de los mismos y país.
										</label>
										<h4>Paso 2: Informacion personal</h4>
										<label style="color: #000000; font-size: 12px; text-align: justify">
											Aqui se le solicitara proporcionar su nombre, apellido, fecha de nacimiento y pais donde nacio.
										</label>
										<h4>Paso 3: Registro de direcciones</h4>
										<label style="color: #000000; font-size: 12px; text-align: justify">
											En este paso los aspirantes deben completar la información actualizada sobre su dirección (actual)
											residencial y dirección permanente. Si su dirección residencial (actual) coincide con su dirección
											permanente, puede marcar "Igual que residencial" junto a la dirección permanente a la derecha.
											Es importante que tomes en cuenta que si señalan que su dirección actual es igual a la permanente,
											está debe ser la misma que la dirección de facturación utilizada para la correspondencia oficial.
										</label>
										<h4>Paso 4: Escaneo de Documentos</h4>
										<label style="color: #000000; font-size: 12px; text-align: justify">
											En este paso se procede a la carga de los documentos que autentifiquen su identidad.
											Las imágenes a escanear deben cumplir con los siguientes parámetros:
											<br>
											•	Los documentos deben estar vigentes, es decir válidos por según el caso por la fecha de emisión y expiración; <br>
											•	Los documentos deben ser escaneos y cargados por ambos lados, en los casos necesarios; <br>
											•	Las imágenes escaneadas deben ser en color y en alta resolución (al menos 300 ppp); <br>
											•	Formatos permitidos: JPG, GIF, PNG, TIFF o PDF; <br>
											•	El tamaño del archivo no debe ser más de 15 MB; <br>
											•	Las fotos escaneadas no deben tener más de 3 meses; <br>
											•	Los documentos deben ser emitidos usando caracteres del alfabeto latino o tienen transliteración latina de los campos principales. <br>


										</label>
									</div>

									<div class="stepy-step">
										<h2>Paso 3: Registro de Direcciones</h2>
										<div class="col-sm-6">
											<div class="form-group">
												<label style="font-weight:bold; color: #513085">Lugar de nacimiento</label>
												<select class="form-control select2" id="pais_id" maxlength="7" name="pais_id">
													<option value="0">Seleccione</option>
													<?php foreach ($listar_paises as $pais) { ?>
														<option value="<?php echo $pais->codigo;?>"><?php echo $pais->descripcion;?></option>
													 <?php }?> 
												</select>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label style="font-weight:bold; color: #513085">Lugar de nacimiento</label>
												<select class="form-control select2" id="pais_id" maxlength="7" name="pais_id">
													<option value="0">Seleccione</option>
													<?php foreach ($listar_paises as $pais) { ?>
														<option value="<?php echo $pais->codigo;?>"><?php echo $pais->descripcion;?></option>
													 <?php }?> 
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label style="font-weight:bold">Código postal</label>
												<input type="text" placeholder="" value="<?php echo $usuario[0]->first_name ?>" maxlength="30" id="nombre" class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label style="font-weight:bold">Código postal</label>
												<input type="text" placeholder="" value="<?php echo $usuario[0]->first_name ?>" maxlength="30" id="nombre" class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label style="font-weight:bold">Ciudad</label>
												<input type="text" placeholder="" value="<?php echo $usuario[0]->first_name ?>" maxlength="30" id="nombre" class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label style="font-weight:bold">Ciudad</label>
												<input type="text" placeholder="" value="<?php echo $usuario[0]->first_name ?>" maxlength="30" id="nombre" class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label style="font-weight:bold">Avenida / Calle</label>
												<input type="text" placeholder="" value="<?php echo $usuario[0]->first_name ?>" maxlength="30" id="nombre" class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label style="font-weight:bold">Avenida / Calle</label>
												<input type="text" placeholder="" value="<?php echo $usuario[0]->first_name ?>" maxlength="30" id="nombre" class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label style="font-weight:bold">Apartamento / Casa</label>
												<input type="text" placeholder="" value="<?php echo $usuario[0]->first_name ?>" maxlength="30" id="nombre" class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label style="font-weight:bold">Apartamento / Casa</label>
												<input type="text" placeholder="" value="<?php echo $usuario[0]->first_name ?>" maxlength="30" id="nombre" class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
											</div>
										</div>
										<input type="submit" value="Send">
									</div>
									&nbsp;
									<footer >

										<!--<strong>Network C. A.</strong> -->
									</footer>&nbsp;
								</form>
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

		
	</body>
</html>

