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
           Retiros
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php" style="color:#3C8DBC"><i class="fa fa-home"></i> Inicio</a></li>
            <li>Procesos</li>
            <li class="active">Retiros</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              
          
              <div class="box box-primary">
                <div class="box-header">
					<div class="text-left">
						<legend><H4  style="color:#3C8DBC">Listado de Retiros</H4></legend>
					</div>
                </div><!-- /.box-header -->
                <br/>
                <div class="box-body">
                  <table id="tab_retiros" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='text-align: center'>Item</th>
                        <th style='text-align: center'>Usuario</th>
																								<th style='text-align: center'>Monedero</th>
																								<th style='text-align: center'>Fecha Solicitud</th>
                        <th style='text-align: center'>Monto</th>
                        <th style='text-align: center'>N. Transferencia</th>
																								<th style='text-align: center'>Fecha Cancelación</th>
                        <th style='text-align: center'>Estatus</th>
                        <th style='text-align: center'>Aprobar</th>
                      </tr>
                    </thead>
                      <tbody >    
                            <?php $i = 1; ?>

                            <?php foreach ($listar as $retiro) { ?>
                                <tr style="font-size: 16px;text-align: center" class="{% cycle 'impar' 'par' %}" >
                                    <td>
                                        <?php echo $i; ?>
                                    </td>
                                    <td><?php echo $retiro->username;?></td>
																																				<td><?php echo $retiro->dir_monedero;?></td>
																																				<td><?php
																																								$fe = explode('-',$retiro->fecha_solicitud);
																																								$fecha = $fe[2].'-'.$fe[1].'-'.$fe[0];
																																								echo $fecha;
																																								?>
																																				</td>
                                    <td><?php echo $retiro->monto;?> <?php echo $retiro->abreviatura;?></td>                                 
                                    <td><?php echo $retiro->num_pago;?></td>
																																				<td><?php
																																								$fe = explode('-',$retiro->fecha_verificacion);
																																								$fecha = $fe[2].'-'.$fe[1].'-'.$fe[0];
																																								echo $fecha;
																																								?>
																																				</td>
																																				<td>
																																					<?php 
																																					if($retiro->estatus == 1){
																																						echo "<span style='color:red'>Pendiente</span>";
																																					}else if($retiro->estatus == 2){
																																						echo "<span style='color:green'>Aprobado</span>";
																																					}else{
																																						echo "";
																																					}
																																					?>
																																				</td>
																																				<td style='text-align: center'>
																																					<?php if ($retiro->estatus == 2) {?>
																																					<input class='aprobar' type="checkbox" checked="checked" disabled="disabled"/>
																																					<?php }else if ($retiro->estatus == 1){ ?>
																																					<input class='aprobar' id='<?php echo $retiro->codigo; ?>' type="checkbox" title='aprobar el pago <?php echo $retiro->codigo;?>'/>
																																					<?php } ?>
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
			   <center><span class="glyphicon glyphicon-search" style="color: #FFFFFF; font-weight: bold"></span>
			   &nbsp;Ingrese el número de transferencia y la fecha de su realización</center>
		 </div>
		 <div class="modal-body">
			<form id="f_aprobacion" name="f_aprobacion" action="" method="post">
			   <div class="form-group">
					<div class="col-sm-12">
						<input type="hidden" id="codigo" name="codigo">
						<label style="font-weight:bold">Número de transferencia</label>
						<input type="text" class="form-control" style="width: 100%; " id="num_pago" name="num_pago" maxlength=10 placeholder="Número de transferencia" autofocus="true" onkeypress="return valida(event)">
					</div>
					</br></br></br>
					<div class="col-sm-12">
						<label style="font-weight:bold">Fecha de canalización del retiro</label>
						<input style="width: 100%;" type="text" class="form-control" id="fecha_verificacion" name="fecha_verificacion" placeholder="Fecha de verificación" maxlength="10"/>
					</div>
					</br></br></br></br>
					<div class="col-sm-12" align="right">
						<span class="input-btn">
							<button class="btn btn-primary" type="button" id="enviar">
								Aprobar&nbsp;<span class="glyphicon glyphicon-share-alt"></span>
							</button>
						</span>
					</div>
					</br>
			   </div>
			</form>
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
            {"sClass": "registro center", "sWidth": "15%"},
												{"sClass": "registro center", "sWidth": "25%"},
												{"sClass": "registro center", "sWidth": "10%"},
            {"sClass": "registro center", "sWidth": "20%"},
            {"sClass": "registro center", "sWidth": "10%"},
												{"sClass": "registro center", "sWidth": "10%"},
            {"sClass": "registro center", "sWidth": "3%"},
            {"sWidth": "3%", "bSortable": false, "sClass": "center sorting_false", "bSearchable": false}
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
	function valida(e){
				tecla = (document.all) ? e.keyCode : e.which;

				//Tecla de retroceso para borrar, siempre la permite
				if (tecla==8){
								return true;
				}
								
				// Patron de entrada, en este caso solo acepta numeros
				patron =/[0-9]/;
				tecla_final = String.fromCharCode(tecla);
				return patron.test(tecla_final);
	}
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
 
	    var cod = this.getAttribute('id');
	    //alert(cod)

		bootbox.confirm("¿Desea aprobar este retiro?", function(result) {
			if (result) {
				$("#codigo").val(cod);
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
		
		if($("#num_pago").val() == ''){
			alert("Error: Ingrese el número de pago");
			$("#num_pago").parent('div').addClass('has-error')
			$("#num_pago").val('');
			$("#num_pago").focus();
		} else if($("#fecha_verificacion").val() == ''){
			alert("Error: Ingrese la fecha de verificación");
			$("#fecha_verificacion").parent('div').addClass('has-error')
			$("#fecha_verificacion").val('');
			$("#fecha_verificacion").focus();
		} else {
			
			var cod = $("#codigo").val();
		
			$.post('<?php echo base_url(); ?>index.php/procesos/CLRetiros/aprobar/' + cod, {'num_pago':$("#num_pago").val(),'fecha_verificacion':$("#fecha_verificacion").val()}, function(response) {
				bootbox.alert("El retiro fue aprobado exitosamente", function () {
				}).on('hidden.bs.modal', function (event) {
					location.reload();
				});
			})
		}
	});
	
	

    </script>
