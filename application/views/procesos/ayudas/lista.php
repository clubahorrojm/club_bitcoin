<?php
if (isset($this->session->userdata['logged_in'])) {
$username = ($this->session->userdata['logged_in']['username']);
$email = ($this->session->userdata['logged_in']['email']);
$tipouser = ($this->session->userdata['logged_in']['tipo_usuario']);
} else {
redirect(base_url());
}
?>
  
<?php if ($tipouser == 'Administrador' || $tipouser == 'OPERADOR'){
	
 } else {
    redirect(base_url());
 }?>   
<div class="wrapper">
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" style="min-height: 1156px;">
          <br/>
        <br/>
        <br/>
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1 style="color:#3C8DBC">
           Soporte a Usuarios
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php" style="color:#3C8DBC"><i class="fa fa-home"></i> Inicio</a></li>
            <li>Procesos</li>
            <li class="active">Soporte a Usuarios</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              
          
              <div class="box box-primary">
                <div class="box-header">
					<div class="text-left">
						<legend><H4  style="color:#3C8DBC">Listado de Soportes a Usuarios</H4></legend>
					</div>
                </div><!-- /.box-header -->
                <br/>
                <div class="box-body">
                  <table id="tab_retiros" class="table table-bordered table-striped table-hover table-condensed dt-responsive table-responsive">
                    <thead>
                      <tr>
                        <th style='text-align: center'>Item</th>
                        <th style='text-align: center'>Usuario</th>
                        <th style='text-align: center'>Motivo</th>
						<th style='text-align: center'>Fecha</th>
                        <th style='text-align: center'>Estatus</th>
                        <th style='text-align: center'>Aprobar</th>
						<th style='text-align: center'>Consulta</th>
						<th style='text-align: center'>Respuesta</th>
						<th style='text-align: center'>Operador</th>
                      </tr>
                    </thead>
                      <tbody >    
                            <?php $i = 1; ?>

                            <?php foreach ($listar as $ayuda) { ?>
                                <tr style="font-size: 16px;text-align: center" class="{% cycle 'impar' 'par' %}" >
                                    <td>
                                        <?php echo $i; ?>
                                    </td>
                                    <td><?php foreach($listar_usuarios as $usuario){
                                            if($usuario->codigo == $ayuda->usuario_id){
                                                echo $usuario->first_name;
                                                echo ' ';
                                                echo $usuario->last_name;
                                            }
                                        }?>
                                    </td>
											<td>
											<?php 
												if($ayuda->motivo == 1){
													echo "<span style='color:blue'>Pregunta</span>";
												}else if($ayuda->motivo == 2){
													echo "<span style='color:red'>Reclamos</span>";
												}else if($ayuda->motivo == 3){
													echo "<span style='color:green'>Sugerencias</span>";
												}else{
													echo "";
												}
												?>
											</td>
											<td><?php
                                                $fe = explode('-',$ayuda->fecha_pre);
                                                $fecha = $fe[2].'-'.$fe[1].'-'.$fe[0];
                                                echo $fecha;
                                                ?>
                                            </td>
											<td>
												<?php 
												if($ayuda->estatus == 1){
													echo "<span style='color:red'>Pendiente</span>";
												}else if($ayuda->estatus == 2){
													echo "<span style='color:green'>Atendido</span>";
												}else{
													echo "";
												}
												?>
											</td>
											<td style='text-align: center'>
												<?php if ($ayuda->estatus == 2) {?>
												<input class='aprobar' type="checkbox" checked="checked" disabled="disabled"/>
												<?php }else if ($ayuda->estatus == 1){ ?>
												<input class='aprobar' id='<?php echo $ayuda->codigo; ?>@@@<?php echo $ayuda->pregunta; ?>' type="checkbox" title='Desea responder la siguiente pregunta?'/>
												<?php } ?>
											</td>
											<td><?php echo $ayuda->pregunta;?></td>
											<td>
														<?php 
														if($ayuda->estatus == 1){
															echo "";
														}else if($ayuda->estatus == 2){
															echo $ayuda->respuesta;
														}?>
												</td>
											<td><?php 
												if($ayuda->estatus == 1){
													echo "";
												}else if($ayuda->estatus == 2){
													foreach($listar_usuarios as $usuario){
                                                        if($usuario->codigo == $ayuda->operador_id){
                                                            echo $usuario->first_name;
                                                            echo ' ';
                                                            echo $usuario->last_name;
                                                        }
                                                    }
												}?>
										</td>
								</tr>
                                <?php $i++ ?>
                            <?php } ?>

                        </tbody>

                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0.0
        </div>
         <img  src="<?= base_url() ?>/static/img/footer.png"/>
      </footer>
</div><!-- /wrapper -->

<div class="modal" id="modal_aprobar">
   <div class="modal-dialog">
					<div class="modal-content">
					<div class="modal-header" style="background-color:#296293;color:white;">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">
									<center><span class="glyphicon glyphicon-search"></span>
									&nbsp;Ingrese el número de transferencia y la fecha de su realización</center>
						</h4>
					</div>
					<div class="modal-body">
						<form id="f_aprobacion" name="f_aprobacion" action="" method="post">
									<div class="form-group">
											<div class="col-sm-12">
												<input type="hidden" id="codigo" name="codigo">
												<span id="preguntas" name="preguntas" style="font-weight: bold; color: #3C8DBC"></span>
												</br></br>
												<textarea type="text" class="form-control"  rows="3" style="width: 100%; " id="respuestas" name="respuestas" placeholder="Respuesta al usuario" autofocus="true"></textarea>
											</div>
											</br></br></br>
											<div class="col-sm-12" align="center">
												<span class="input-btn">
													</br>
													<button class="btn btn-primary" type="button" id="enviar">
														Responder&nbsp;<span class="glyphicon glyphicon-share-alt"></span>
													</button>
												</span>
											</div>
									</div>
						</form>
						</br></br></br></br></br></br></br></br>
					</div>
					
					</div>
   </div>
</div>

    <script>
    
       var TTCuentas = $('#tab_retiros').dataTable({
        "paging": true,
        "lengthChange": false,
        "autoWidth": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "iDisplayLength": 5,
        "iDisplayStart": 0,
        "sPaginationType": "full_numbers",
        "aLengthMenu": [5,10,15],
        "oLanguage": {"sUrl": "<?= base_url() ?>/static/js/es.txt"},
        "aoColumns": [
            {"sClass": "registro center", "sWidth": "5%"},
            {"sClass": "registro center", "sWidth": "20%"},
												{"sClass": "registro center", "sWidth": "10%"},
            {"sClass": "registro center", "sWidth": "10%"},
            {"sClass": "registro center", "sWidth": "3%"},
            {"sWidth": "3%", "bSortable": false, "sClass": "center sorting_false", "bSearchable": false},
												{"sClass": "none", "sWidth": "20%"},
												{"sClass": "none", "sWidth": "20%"},
												{"sClass": "none", "sWidth": "20%"},
												
        ]
    });
    
    $('#fecha_verificacion').datepicker({
					format: "dd/mm/yyyy",
					startDate: 'today',
					//~ minDate: "-1D",
					//~ maxDate: "+1D",
					language: "es",
					autoclose: true,
				})
	
	$('#fecha_verificacion').numeric({allow: "/"});
	$('#num_pago').numeric();
            
	//iCheck for checkbox and radio inputs
	$('input[type="checkbox"].aprobar, input[type="radio"].aprobar').iCheck({
	  checkboxClass: 'icheckbox_minimal-blue',
	  radioClass: 'iradio_minimal-blue'
	});	
	
	// Función para activar/desactivar un tipo de cuenta
	$("table#tab_retiros").on('ifChanged', 'input.aprobar', function (e) {
	    e.preventDefault(e);

					var cadena = this.getAttribute('id');
					var cadena = cadena.split("@@@");
					var cod = cadena[0];
					var pregunta = cadena[1];
					//alert(pregunta)
			
					bootbox.confirm("¿Desea contestar esta pregunta ("+pregunta+")?", function(result) {
							if (result) {
									$("#codigo").val(cod);
									//Se captura el elemento en la modal cuyo ID sea preguntas y se le agrega el texto 
									document.getElementById('preguntas').innerHTML = "Consulta: "+pregunta;
									// Activar modal para los datos de la aprobación
									$("#modal_aprobar").modal('show');				
							}else{
									this.prop('checked','false');
							}
					});
	   
	});
	
	// Activar modal al hacer click en el enlace de recuperación
	$("#enviar").click(function (e) {
					e.preventDefault();  // Para evitar que se envíe por defecto
					
					if($("#respuestas").val() == ''){
								alert("Disculpe, aun no a respondido");
								$("#respuestas").parent('div').addClass('has-error');
								$("#respuestas").focus();
					}else if ($("#respuestas").val().trim().length < 10){
                        bootbox.alert("Su respuesta debe ser mayor a diez (10) caracteres, para ser valida", function () {
                        }).on('hidden.bs.modal', function (event) {
                                $("#respuestas").parent('div').addClass('has-error')
                                $("#respuestas").focus();
                        });
                    } else {
							var cod = $("#codigo").val();
							$.post('<?php echo base_url(); ?>index.php/procesos/CAyuda/responder/', {'respuestas':$("#respuestas").val(), 'codigo':+ cod}, function(response) {
									bootbox.alert("La respuesta se envio exitosamente", function () {
									}).on('hidden.bs.modal', function (event) {
										location.reload();
									});
							})
					}
	});
	
	

    </script>
