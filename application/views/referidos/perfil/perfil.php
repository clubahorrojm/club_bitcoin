<?php
    if (isset($this->session->userdata['logged_in'])) {
        $username = ($this->session->userdata['logged_in']['username']);
        $email = ($this->session->userdata['logged_in']['email']);
        $tipouser = 'Administrador';
        $id_user = ($this->session->userdata['logged_in']['id']);
    } else {
        redirect(base_url());
    }

?>


<div class="wrapper">



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height: 1156px;">
        <br/>
        <br/>
        <br/>
        <!-- Content Header (Page header) -->
        <!--<section class="content-header">
            <h1>
                Perfil de Usuario
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-home"></i> Inicio</a></li>
                <li class="active">Perfil</li>
            </ol>
        </section>-->

        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-xs-12">

                    <!-- SELECT2 EXAMPLE -->
                    <div class="box box-primary">
                        <div class="box-header with-border col-md-12">
                            <div class="col-md-6">
                                <h3 class="box-title" style="font-weight:bold; color:#3C8DBC">Información de cuenta</h3>
                            </div>
                            <div class="col-md-6 text-right" >
                                <h3 class="box-title" style="font-weight:bold; color:#3C8DBC">Código: <?php echo str_pad($editar[0]->codigo, 5, '0',STR_PAD_LEFT) ?></h3>
                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <form id="form_empresa">
                                <div class="col-md-12">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <img id="logo_info" class="img-circle" src="<?= base_url() ?>static/img/logo4.png"/>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.form-group -->
                                    <div class="col-md-10">
                                        <div class="col-md-8">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <h3 class="box-title" style="font-weight:bold; color:#3C8DBC">Hola de nuevo, <?php echo $usuario[0]->first_name ?>
                                                    <?php echo $usuario[0]->last_name ?></h3>
                                                </div><!-- /.form-group -->
                                            </div>
                                            <div class="col-md-3">
                                                <label style="color:#3C8DBC">Estatus para el siguiente nivel: </label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="progress progress-md active  ">
                                                    <div class="progress-bar progress-bar-success progress-bar-striped" style="width: <?php echo $porcentaje ?>%;"
                                                         aria-valuemax="100" aria-valuemin="0" aria-valuenow="<?php echo $porcentaje ?>" role="progressbar">
                                                        <span style="font-weight: bold"><?php echo $porcentaje ?>% Completado (<?php echo $cant_ref.'/'.$cant_ref_necesarios ?>)</span>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <h1 style="color:#3C8DBC">Nivel</h1>
                                                    <img id="nivel" class="img-circle" src="<?= base_url() ?>static/img/iconos_medianos/Nivel<?php echo $editar[0]->nivel ?>-01.png" style="width: 25%;" />
                                                    <!--<button id="nivel" class="img-circle" type="button"><?php echo $editar[0]->nivel; ?></button>-->
                                                </div><!-- /.form-group -->
                                            </div>
                                        </div><!-- /.form-group -->
                                        <div class="col-md-4">
                                            <div class="col-md-6">
                                                <div class="text-center">
                                                    <img id="logo_maximo" class="img-circle" src="<?= base_url() ?>static/img/maximo-01.png" style="width: 70%" />
                                                </div><!-- /.form-group -->
                                                <div class="form-group">
                                                    <h3 class="box-title" style="font-weight:bold;">
                                                        <p style="font-weight:bold; color:#3C8DBC">Máximo</p>
                                                    </h3>
                                                    <h5><label style="font-weight:bold;"><?php echo number_format($editar[0]->maximo, 2, ',', '.')?> <?php echo $moneda ?> <span id="span_convert1"></span></label></h5>
                                                </div><!-- /.form-group -->
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="text-center">
                                                        <img id="logo_disponible" class="img-circle" src="<?= base_url() ?>static/img/disponible-01.png" style="width: 70%;" />
                                                    </div>
                                                    <div class="form-group">
                                                        <h3 class="box-title" style="font-weight:bold; color:#3C8DBC">
                                                            <p style="font-weight:bold">Disponible</p>
                                                        </h3>
                                                        <h5><label style="font-weight:bold"><?php echo number_format($editar[0]->disponible, 2, ',', '.')?> <?php echo $moneda ?> <span id="span_convert2"></span></label></h5>
                                                    </div><!-- /.form-group -->
                                                </div><!-- /.form-group -->
                                            </div>
                                            <input class="form-control"  type='hidden' id="id" name="id" value="<?php echo $editar[0]->codigo ?>"/>
                                            <input class="form-control"  type='hidden' id="cant_ref" name="cant_ref" value="<?php echo $editar[0]->cant_ref ?>"/>
                                            <input id="estatus_perfil" type='hidden' value="<?php echo $editar[0]->estatus ?>" class="form-control" >
                                            <input class="form-control"  type='hidden' id="usuario_id" name="usuario_id" value="<?php echo $usuario[0]->codigo ?>"/>
                                            <input class="form-control"  type='hidden' id="convert1" value="<?php echo $editar[0]->maximo; ?>"/>
                                            <input class="form-control"  type='hidden' id="convert2" value="<?php echo $editar[0]->disponible; ?>"/>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.form-group -->
                                </div><!-- /.form-group -->
                            </form>
                        </div><!-- /.box-body -->
                    </div><!-- /.box-body-primary -->

                </div><!-- /.col -->
                <!-- PESTAÑAS -->
                <div class="col-xs-6">
                    <div class="box box-primary">
                        <div class="box-header with-border col-md-6">
                            <h3 class="box-title" style="font-weight:bold; color:#3C8DBC">Pagos de referidos recibidos</h3>
                        </div><!-- /.box-header -->
                        <div class="col-md-6 text-right" >
                            <button type="button" id="res_pagos" style="font-weight: bold;font-size: 13px" class="btn btn-success btn-xs " >
                                &nbsp;<span class="fa fa-file-text"></span>&nbsp;Resumen de pagos
                            </button>
                        </div>
                            <div class="panel-body">
                                <table id="tab_rel_links" class="table table-bordered table-striped table-hover table-condensed dt-responsive table-responsive">
                                    <thead>
                                        <tr class="info">
                                            <th style='text-align: center'>#</th>
                                            <th style='text-align: center'>Usuario</th>
                                            <th style='text-align: center'>Monto</th>
                                        </tr>
                                    </thead>
                                    <tbody >       
                                        <?php $i = 1; ?>
                                        <?php foreach ($listar_distribuciones as $debitado) { ?>
                                        <tr style="font-size: 16px;text-align: center" class="{% cycle 'impar' 'par' %}" >
                                            <td><?php echo $i; ?></td>
                                            <td><?php foreach($listar_usuarios as $usuario){
                                                    if($usuario->codigo == $debitado->usuario_id){
                                                        echo $usuario->first_name;
                                                        echo ' ';
                                                        echo $usuario->last_name;
                                                    }
                                                }?> 
                                            </td>
                                            <td><?php echo $debitado->monto; ?> <?php echo $moneda ?></td>
                                        </tr>
                                        <?php $i++ ?>
                                        <?php } ?>
                                    </tbody>
                                </table>

                            </div>
                        </div><!-- /.box-body -->
                </div><!-- /.box-body-primary -->

                <div class="col-xs-6">
                    <div class="box box-primary">
                        <div class="box-header with-border col-md-6">
                            <h3 class="box-title" style="font-weight:bold; color:#3C8DBC">Retiros</h3>
                        </div><!-- /.box-header -->
                        <div class="col-md-6 text-right" >
                            <button type="button" id="res_retiros" style="font-weight: bold;font-size: 13px" class="btn btn-success btn-xs " >
                                &nbsp;<span class="fa fa-file-text"></span>&nbsp;Resumen de retiros
                            </button>
                        </div>
                            <div class="panel-body">
                                <table id="tab_rel_retiros" class="table table-bordered table-striped table-hover table-condensed dt-responsive table-responsive">
                            <thead>
                                <tr class="info">
                                    <th style='text-align: center'>#</th>
                                    <th style='text-align: center'>Fecha</th>
                                    <th style='text-align: center'>Monto</th>
                                    <th style='text-align: center'>Estatus</th>
                                </tr>
                            </thead>
<!--                             <tfoot>
                                <tr>
                                    <th colspan="2" style="text-align:right; font-size: 16px">Total retirado:</th>
                                    <th colspan="2"></th>
                                </tr>
                            </tfoot> -->
                            <tbody >       
                                <?php $i = 1; ?>
                                <?php foreach ($listar_retiros as $retiros) { ?>
                                <tr style="font-size: 16px;text-align: center" class="{% cycle 'impar' 'par' %}" >
                                    <td><?php echo $i; ?></td>
                                    <td><?php
                                    
                                    $fe = explode('-',$retiros->fecha_solicitud);
                                    $fecha = $fe[2].'-'.$fe[1].'-'.$fe[0];
                                    echo $fecha;
                                    ?></td>
                                    
                                    <td><?php echo number_format($retiros->monto, 2, ',', '.') ; ?> <?php echo $moneda ?></td>
                                    <td><?php if ($retiros->estatus == 1) {?>
                                            <label style="font-weight:bold; color: blue">Solicitado</label>
                                        <?php }else if ($retiros->estatus == 2){ ?>
                                            <label style="font-weight:bold; color: green">Procesado</label>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php $i++ ?>
                                <?php } ?>
                            </tbody>
                        </table>

                            </div>
                        </div><!-- /.box-body -->
                </div><!-- /.box-body-primary -->
            <!-- PESTAÑAS -->

        </section><!-- /.content -->
        
        <!-- Modal -->
        <div class="modal fade " id="modal_felictaciones" role="dialog">
          <div class="modal-dialog">
          
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header " style="background-color: #001a5a">
                <strong style="color: white">&nbsp;FELICITACIONES !!!&nbsp;</strong>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white">&times;</button>
              </div>
              <div class="modal-body " style="background-color: #FFFFFF">
                <p  align="justify">Muchas Felicitaciones, has alcanzado 
                el nivel <strong>7</strong> y obtenido el máximo de referidos de forma satisfactoria, te invitamos a retirar todo tu dinero en la opción de
                <strong style="background-color: #001a5a; color: white">&nbsp;<img src="<?php echo base_url(); ?>static/img/retiro-01.png" style="width:20px;">&nbsp;Retiros&nbsp;</strong>
                ubicada en el menú, y si desea jugar de nuevo desde cero, haga clic en el boton 
                <strong style="background-color: #edd727; color: white">&nbsp;<i class="fa fa-refresh"></i>&nbsp;Volver a Jugar&nbsp;</strong>
                 muchas gracias por haber participado.</p>
              </div>
              <div class="modal-footer " style="background-color: #c0c0c0" >
                    <button type="button" class="btn btn-success" data-dismiss="modal" id="volver_jugar"><i class="fa fa-refresh"></i>&nbsp; Volver a Jugar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="cerrar_modal">Cerrar</button>
              </div>
              
            </div>
            
          </div>
        </div>
        
        
        
        <div class="modal" id="modal_aprobar">
            <div class="modal-dialog">
					<div class="modal-content">
					<div class="modal-header" style="background-color:#296293;color:white;">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<center><strong style="color: white">&nbsp;Introdúzca su usuario y su contraseña para crear la cuenta&nbsp;</strong></center>
					</div>
					<div class="modal-body">
						<form id="f_reg_usuario" name="f_reg_usuario" action="" method="post">
									<div class="form-group">
											<div class="col-sm-12">
												<!--<input type="hidden" id="codigo" name="codigo">-->
                                                <input type="hidden" id="codigo" name="codigo" >
                                                <input type="hidden" id="link" name="link" >
                                                <input class="form-control"  type='hidden' id="pk_perfil" name="pk_perfil" value="<?php echo $editar[0]->codigo ?>"/>
												
											</div>
                                            <div class="col-sm-12"
                                                <div class="col-sm-12">
                                                    <label class="control-label" >Nombre de Usuario (Diferente al que ya esta usando)</label>
                                                    <input type="text" class="form-control" style="width: 100%; " id="username_reg" name="username_reg" placeholder="Usuario" autofocus="true">
                                                </div>
                                                </br></br></br>
                                                <div class="col-sm-12">
                                                    <label class="control-label" >Contraseña</label>
                                                    <input style="width: 100%;" type="password" class="form-control" id="password_reg" name="password_reg" placeholder="Contraseña"/>
                                                </div>
                                                </br></br></br>
                                                <div class="col-sm-12">
                                                    <label class="control-label" >Correo (Puede ser el que ya esta usando)</label>
                                                    <input style="width: 100%;" type="text" class="form-control" id="correo" name="correo" placeholder="ejemplo@correo.com"/>
                                                </div>
                                                </br></br></br>
                                            </div>
											<div class="col-sm-12" align="center">
												<span class="input-btn">
													</br>
													<button class="btn btn-primary" type="button" id="registrar">
														Registrar&nbsp;<span class="glyphicon glyphicon-share-alt"></span>
													</button>
												</span>
											</div>
									</div>
						</form>
						</br></br></br>
					</div>
					
					</div>
            </div>
        </div>
        
        
        
    </div><!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
    </footer>


    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->


<script>

    var Tusuarios = $('#tab_rel_links').dataTable({
        "paging": true,
        "lengthChange": false,
        "autoWidth": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "iDisplayLength": 5,
        "iDisplayStart": 0,
        "sPaginationType": "full_numbers",
        "aLengthMenu": [5,10,15],
        "oLanguage": {"sUrl": "<?= base_url() ?>/static/js/es.txt"},
        "decimal": ",",
        "thousands": ".",
        "aoColumns": [
            {"sClass": "registro center", "sWidth": "1%"},
            {"sClass": "registro center", "sWidth": "15%"},
            {"sClass": "registro center", "sWidth": "5%"},
        ],        
    });
        var Tusuarios = $('#tab_rel_retiros').dataTable({
        "paging": true,
        "lengthChange": false,
        "autoWidth": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "iDisplayLength": 10,
        "iDisplayStart": 0,
        "sPaginationType": "full_numbers",
        "aLengthMenu": [5,10,15],
        "oLanguage": {"sUrl": "<?= base_url() ?>/static/js/es.txt"},
        "decimal": ",",
        "thousands": ".",
        "aoColumns": [
            {"sClass": "registro center", "sWidth": "1%"},
            {"sClass": "registro center", "sWidth": "5%"},
            {"sClass": "registro center", "sWidth": "5%"},
            {"sClass": "registro center", "sWidth": "5%"},
        ],
    });
    
    
    // Show the Modal on load
    if($("#cant_ref").val() == 78125 && $("#estatus_perfil").val() == 4){
        $("#modal_felictaciones").modal("show");
    }
    // Generar enlace para registro de nuevo usuario
    $("#volver_jugar").click(function (e) {
        e.preventDefault();  // Para evitar que se envíe por defecto
                            
        // Registramos el nuevo usuario
        $.post('<?php echo base_url(); ?>index.php/User_Authentication/enlace_disponible2/', function(response) {
            //alert(response);
            var cadena = response.split("@@@");
            var cod_link = cadena[0];
            //var userd_id = cadena[1];
            var num_link = cadena[1];
            $("#codigo").val(cod_link);
            $("#link").val(num_link);
            $("#modal_aprobar").modal('show'); 
        });
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
        } else if($("#correo").val() == ''){
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
                        //console.log(response);
                    });
                    $.post('<?php echo base_url(); ?>index.php/User_Authentication/actualizar_perfil/', $("#f_reg_usuario").serialize(), function(response) {
                        //console.log(response);
                    });
                    alert('Nueva cuenta registrada exitosamente');
                    url = '<?php echo base_url(); ?>index.php/'
                    window.location = url
                }
            });
        }
    });

    
    
    $(".select2").select2();
    $('#codigo,#cedula').numeric();
    $('#direccion').alphanumeric({allow: ", .#"});
    $('#correo').alphanumeric({allow: "_-.@"});
    $('#nombre,#apellido').alpha({allow: " "})
    $('#rif').alphanumeric({allow: "-"}); //Solo permite texto
    $("[data-mask]").inputmask();

    $('input').on({
        keypress: function () {
            $(this).parent('div').removeClass('has-error');
        }
    });
    $('select').on({
        change: function () {
            $(this).parent('div').removeClass('has-error');
        }
    });

    
    $("#res_pagos").click(function (e) {
        e.preventDefault();  // Para evitar que se envíe por defecto
        // pk_perfil = $('#id').val()
        // alert(pk_perfil)
        URL = '<?php echo base_url(); ?>index.php/referidos/CReferidos/pdf_resumen_pagos/';
            $.fancybox.open({ padding : 0, href: URL, type: 'iframe',width: 1024, height: 520});
    });
    
    $("#res_retiros").click(function (e) {
        e.preventDefault();  // Para evitar que se envíe por defecto
        // pk_perfil = $('#id').val()
        // alert(pk_perfil)
        URL = '<?php echo base_url(); ?>index.php/referidos/CReferidos/pdf_resumen_retiros/';
            $.fancybox.open({ padding : 0, href: URL, type: 'iframe',width: 1024, height: 520});
    });
	
	// Soporte para tipos de cambio sobre bitcoins (dólares en este caso) usando la api de blockchain Exchange Rates API
	$.post('https://blockchain.info/ticker', function (response) {
		//~ alert(response['USD']['last']);
		//~ alert(response['USD']['symbol']);
		//~ $.each(response, function (i) {
			//~ $('#span_phone').text(response[i]['phone']);
			//~ $('#span_cellphone').text(response[i]['cell_phone']);
			//~ alert(response[i]);
		//~ });
		var convert1, conver2;
		
		convert1 = parseFloat($('#convert1').val())*parseFloat(response['USD']['last']);
		convert2 = parseFloat($('#convert2').val())*parseFloat(response['USD']['last']);
		$('#span_convert1').text(' ('+String(convert1)+' '+response['USD']['symbol']+')');
		$('#span_convert2').text(' ('+String(convert2)+' '+response['USD']['symbol']+')');
		
	}, 'json');

</script>
