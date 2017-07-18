
    <?php
    if (isset($this->session->userdata['logged_in'])) {

        header("location: http://localhost/ClubAhorro/index.php/User_Authentication/user_login_process");
    }
    ?>
    <head>
        <title>.:: Club del Ahorro ::.</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>static/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>static/css/select2.css"/>
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>static/css/select2-bootstrap.css"/>
        <script src="<?= base_url() ?>static/js/jquery-1.11.2.min.js"></script>
        <script src="<?= base_url() ?>static/js/bootstrap.min.js"></script>

        <script src="<?= base_url() ?>static/js/bootstrap-datepicker.js"></script>
        <script src="<?= base_url() ?>static/js/bootstrap-datepicker.es.min.js"></script>

        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>static/css/animate.css"/>
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>static/css/apprise.css"/>
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>static/css/estilo.css"/>


        <link rel="stylesheet" type="text/css" href="<?php echo base_url('static/css/style.css'); ?>">
     
		<script>
			$(document).ready(function () {
					
				// Activar modal al hacer click en el enlace de recuoperación
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
    </head>
    <body>

<!--        <div align="center">
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

               
		<h1>Club del Ahorro</h1>
		
		 <?php echo form_open('User_Authentication/user_login_process'); ?>
		<form id="frmlogin" class="form-horizontal"  method="POST" enctype="multipart/form-data" autocomplete="off" role="form">
		   
			<div class="col-lg-12">
				<div class="col-lg-3"></div>
				 <div class="col-lg-6"><img class="img-circle" src="<?= base_url() ?>static/img/default.gif" style="width: 80%" /></div> 
				<div class="col-lg-3"></div>
		   </div> 
           <div class="col-lg-12">
			<input type="text" id="username" name="username" placeholder="Usuario" >
			<input type="password" id="password" name="password" placeholder="Contraseña">
			<button  type="submit" value=" Ingresar " name="submit">Entrar</button>
			</br></br>
			<button type="button" id="rec_password" name="recpassword">Rec: Clave de Acceso</button>
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


<!--        <div style="display: table;clear: both;"></div>

        <div class="container" >
            <div class="content animated fadeIn" style='box-shadow: 0 1px 5px rgba(0,0,0,.85) '>
                <div class="row" >
                    <div class="login login-form" id="login" >
                        <?php echo form_open('User_Authentication/user_login_process'); ?>
                        <form id="frmlogin" class="form-horizontal"  method="POST" enctype="multipart/form-data" autocomplete="off" role="form">
                            
                            
                            

                            <div class="col-lg-6">
                                <img src="<?= base_url() ?>static/img/default.gif" style="width: 100%;" />
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group " >
                                    <br/>
                                    <br/>
                                    <br/>
                                    <div id="div_usuario" class='input-group col-sm-12' >
                                        <span class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </span>
                                        <input type="text" class="form-control input-sm letras" style="width: 90%; " id="username" name="username"placeholder="Usuario" autofocus="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div id="div_contrasena" class="input-group col-sm-12">
                                        <span class="input-group-addon">
                                            <i class="fa fa-lock"></i>

                                        </span>
                                        <input style="width: 90%;" type="password" class="form-control input-sm letras" id="password" name="password" placeholder="Contrase&ntilde;a"/>
                                    </div>
                                </div>
                                <input type='hidden' id='user_accion' name='user_accion' value=' <?php echo"$username" ?>'>
                                <div class="form-group" style='width:90%'>
                                    <div class="col-sm-offset-62">

                                        <input type="submit" value=" Ingresar " name="submit" class="btn btn-block btn-danger"/><br />

                                    </div>
                                </div>

                            </div>



                        </form>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>-->
        <script>
//             $("#login-button").click(function(event){
//		 event.preventDefault();
//	 
//	 $('form').fadeOut(500);
//	 $('.wrapper').addClass('form-success');
//});

            </script>
