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
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>



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
                                <img style="width: 30%" src="<?= base_url() ?>static/img/logo4.png"/>
                            </div>
                            <div class="col-md-6 text-right" >
                                <h3 style="font-weight:bold; color:#3C8DBC">Hola, <?php echo $usuario[0]->first_name ?>
                                <?php echo $usuario[0]->last_name ?></h3>
                                <label style="color:#3C8DBC" >nro. de usuario: <?php echo str_pad($editar[0]->codigo, 5, '0',STR_PAD_LEFT) ?></label>
                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <form id="form_empresa">
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <div class="col-md-1"> </div><!-- /.form-group -->
                                        <div class="col-md-10 text-center">
                                            <div class="text-center">
                                                <h1 style="color:#3C8DBC">Nivel</h1>
                                                <img id="nivel" class="img-circle" src="<?= base_url() ?>static/img/iconos_medianos/Nivel <?php echo $editar[0]->nivel ?>.png" style="width: 40%;" />
                                            </div><!-- /.form-group -->
                                            <span style="font-weight: bold"><?php echo $porcentaje ?>% Completado</span>
                                            <div  class="progress progress-md active " style="background-color: #E5E3E3 ">
                                                <div class="progress-bar progress-bar-success progress-bar-striped" style="width: <?php echo $porcentaje ?>%; "
                                                     aria-valuemax="100" aria-valuemin="0" aria-valuenow="<?php echo $porcentaje ?>" role="progressbar">
                                                    
                                                </div>
                                            </div>
                                            
                                            <div class="text-center">
                                                <label style="color:#3C8DBC">Progreso de nivel</label>
                                            </div><!-- /.form-group -->
                                        </div>
                                        <div class="col-md-1"> </div><!-- /.form-group -->
                                    </div><!-- /.form-group -->
                                    <div class="col-md-9">
                                        <div class="col-md-1"> </div><!-- /.form-group -->
                                        <div class="col-md-5">
                                            <br><br>
                                            <div class="small-box" style="background-color: #C9B72E">
                                                <div >
                                                  <span style="color: white; font-size: 150%">MÁXIMO A COBRAR</span>
                                                </div>
                                                <div class="text-right" >
                                                    <img class="img-circle" src="<?= base_url() ?>static/img/maximo-01.png" style="width: 25%;" />
                                                </div>
                                                <div >
                                                    <div class="col-md-6 text-left" style="background-color: #47411D; ">
                                                        <span style="font-weight:bold;color: white">BIT <?php echo number_format($editar[0]->maximo, 2, ',', '.')?></span>
                                                    </div><!-- /.form-group -->
                                                    <div class="col-md-6 text-right" style="background-color: #47411D; ">
                                                        <span style="font-weight:bold;color: white"><?php echo number_format($editar[0]->maximo, 2, ',', '.')?> $</span>
                                                    </div><!-- /.form-group -->
                                                </div>
                                              </div>
                                        </div><!-- /.form-group -->
                                        <div class="col-md-5">
                                            <br><br>
                                            <div class="small-box" style="background-color: #22274b">
                                                <div >
                                                  <span style="color: white; font-size: 150%">DISPONIBLE</span>
                                                </div>
                                                <div class="text-right" >
                                                    <img class="img-circle" src="<?= base_url() ?>static/img/disponible-01.png" style="width: 25%;" />
                                                </div>
                                                <div >
                                                    <div class="col-md-6 text-left" style="background-color: #000000; ">
                                                        <span style="font-weight:bold;color: white">BIT <?php echo number_format($editar[0]->disponible, 2, ',', '.')?></span>
                                                    </div><!-- /.form-group -->
                                                    <div class="col-md-6 text-right" style="background-color: #000000; ">
                                                        <span style="font-weight:bold;color: white"><?php echo number_format($editar[0]->disponible, 2, ',', '.')?> $</span>
                                                    </div><!-- /.form-group -->
                                                </div>
                                              </div>
                                        </div><!-- /.form-group -->
                                        <div class="col-md-1"> </div><!-- /.form-group -->
                                        <div class="col-md-6"> </div><!-- /.form-group -->
                                        <div class="col-md-5">
                                            <br><span style="font-weight:bold;color: #001A5A">Comprobante de Aporte</span>
                                            <img src="<?= base_url() ?>static/img/reporte.png" style="width: 15%;" />
                                        </div><!-- /.form-group -->
                                        <div class="col-md-1">
                                            
                                            <input class="form-control"  type='hidden' id="id" name="id" value="<?php echo $editar[0]->codigo ?>"/>
                                            <input class="form-control"  type='hidden' id="disponible" name="disponible" value="<?php echo $editar[0]->disponible ?>"/>
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
                    
                    <div class="col-md-12 box box-primary">
                        <div class="col-md-1"> </div><!-- /.form-group -->
                        <div class="chart col-md-10">
                            <br><br>
                            <!-- Sales Chart Canvas -->
                            <canvas id="salesChart" style="height: 180px;"></canvas>
                        </div>
                        <div class="col-md-1"> </div><!-- /.form-group -->
                    </div><!-- /.box-body-primary -->

                </div><!-- /.col -->
                <!-- PESTAÑAS -->
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

<input id="latitud" type="hidden"/>
<input id="longitud" type="hidden"/>
<input id="tipo_user" type="hidden" value="<?php echo $this->session->userdata['logged_in']['tipo_usuario'];?>"/>

<script>
    $.post('<?php echo base_url(); ?>index.php/User_Authentication/cargar_grafica_pagos/', function(response) {
        var lista = response;
        //alert(lista);
          // -----------------------
        // - MONTHLY SALES CHART -
        // -----------------------
      
        // Get context with jQuery - using jQuery's .get() method.
        var salesChartCanvas = $('#salesChart').get(0).getContext('2d');
        // This will get the first returned node in the jQuery collection.
        var salesChart       = new Chart(salesChartCanvas);
      
        var salesChartData = {
            labels  : ['2017-07-31', '2017-08-10', '2017-09-10', '2017-10-10'],
            datasets: [
                {
                  label               : 'Digital Goods',
                  fillColor           : '#002d81',
                  strokeColor         : 'rgba(60,141,188,0.8)',
                  pointColor          : '#002d81',
                  pointStrokeColor    : 'rgba(60,141,188,1)',
                  pointHighlightFill  : '#fff',
                  pointHighlightStroke: 'rgba(60,141,188,1)',
                  data                : [400, 300, 100, 200]
                }
            ]
        };
      
        var salesChartOptions = {
            // Boolean - If we should show the scale at all
            showScale               : true,
            // Boolean - Whether grid lines are shown across the chart
            scaleShowGridLines      : false,
            // String - Colour of the grid lines
            scaleGridLineColor      : 'rgba(0,0,0,.05)',
            // Number - Width of the grid lines
            scaleGridLineWidth      : 1,
            // Boolean - Whether to show horizontal lines (except X axis)
            scaleShowHorizontalLines: true,
            // Boolean - Whether to show vertical lines (except Y axis)
            scaleShowVerticalLines  : true,
            // Boolean - Whether the line is curved between points
            bezierCurve             : true,
            // Number - Tension of the bezier curve between points
            bezierCurveTension      : 0.3,
            // Boolean - Whether to show a dot for each point
            pointDot                : false,
            // Number - Radius of each point dot in pixels
            pointDotRadius          : 4,
            // Number - Pixel width of point dot stroke
            pointDotStrokeWidth     : 1,
            // Number - amount extra to add to the radius to cater for hit detection outside the drawn point
            pointHitDetectionRadius : 20,
            // Boolean - Whether to show a stroke for datasets
            datasetStroke           : true,
            // Number - Pixel width of dataset stroke
            datasetStrokeWidth      : 2,
            // Boolean - Whether to fill the dataset with a color
            datasetFill             : true,
            // String - A legend template
            legendTemplate          : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<datasets.length; i++){%><li><span style=\'background-color:<%=datasets[i].lineColor%>\'></span><%=datasets[i].label%></li><%}%></ul>',
            // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio     : true,
            // Boolean - whether to make the chart responsive to window resizing
            responsive              : true
        };
        // Create the line chart
        salesChart.Line(salesChartData, salesChartOptions);
    });
    
    
    // Show the Modal on load
    if($("#cant_ref").val() == 78125 && $("#estatus_perfil").val() == 4){
        $("#modal_felictaciones").modal("show");
    }
    // Show the Modal on load
    //if($("#disponible").val() >= 60 ){
    //    bootbox.alert('Felicitaciones, ya puedes retirar tu dinero', function () {    
    //    });
    //}
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
	
	// Ejecutamos la captura de la localización
	getLocation();
	
	// Registramos las coordenadas capturadas si el usuario logueado es de tipo BÁSICO
	if($('#tipo_user').val().trim() == "BÁSICO"){
		//~ alert("Usuario básico");
		$.post('<?php echo base_url(); ?>index.php/User_Authentication/registrar_coord/', {'latitud':$('#latitud').val(), 'longitud':$('#longitud').val()}, function(response) {
			
		});
	}
	
	var x = document.getElementById("demo");
	
	function getLocation() {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(showPosition);
		} else { 
			x.innerHTML = "Geolocation is not supported by this browser.";
		}
	}
	
	function showPosition(position) {
		//~ latitud = (position.coords.latitude);
		//~ longitud = (position.coords.longitude);
//~ 
		//~ x.innerHTML = "Latitude: " + latitud + 
		//~ "<br>Longitude: " + longitud;
		$('#latitud').val(position.coords.latitude);
		$('#longitud').val(position.coords.longitude);
	}

</script>
