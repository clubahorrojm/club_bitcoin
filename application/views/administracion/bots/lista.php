<?php
if (isset($this->session->userdata['logged_in'])) {
$username = ($this->session->userdata['logged_in']['username']);
$email = ($this->session->userdata['logged_in']['email']);
$tipouser = ($this->session->userdata['logged_in']['tipo_usuario']);
} else {
redirect(base_url());
}
?>
  
<?php if ($tipouser == 'Administrador'){
	
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
           Cuentas Bot
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php" style="color:#3C8DBC"><i class="fa fa-home"></i> Inicio</a></li>
            <li>Administración</li>
            <li class="active">Cuentas Bot</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              
          
              <div class="box box-primary">
                <div class="box-header">
					<div class="text-left">
						<legend><H4  style="color:#3C8DBC">Cuentas Bot</H4></legend>
					</div>
                </div><!-- /.box-header -->
                
                <br/>
                <div class="box-body">
					<form id="form_bots">
						<div class="col-md-2">
							<div class="form-group">
								<label style="font-weight:bold">Moneda</label>
								<select id="moneda" name="moneda" class="form-control" >
									<option value="0">Seleccione</option>
									<?php foreach ($monedas as $moneda) { ?>
										<?php if ($moneda->id == 1) { ?>
											<option value="<?php echo $moneda->id ?>"><?php echo $moneda->descripcion ?></option>
										<?php } ?>
									<?php } ?>
								</select>
							</div><!-- /.form-group -->
						</div><!-- /.form-group --> 
						<div class="col-md-2">
							<div class="form-group">
								<label style="font-weight:bold">Monto de pago</label>
								<input type="text" placeholder="0000" id="monto_pago" name="monto_pago" maxlength="6" class="form-control">
							</div><!-- /.form-group -->
						</div><!-- /.form-group --> 
						<div class="col-md-2">
							<div class="form-group">
								<label style="font-weight:bold">Monto mínimo de retiro</label>
								<input type="text" placeholder="0000" id="monto_retiro_minimo" name="monto_retiro_minimo" maxlength="4" class="form-control">
							</div><!-- /.form-group -->
						</div><!-- /.form-group --> 
						<div class="col-md-2">
							<div class="form-group">
								<label style="font-weight:bold">Cargo por Mora</label>
								<input type="text" placeholder="0000" id="cargo_mora" name="cargo_mora" maxlength="4" class="form-control">
							</div><!-- /.form-group -->
						</div><!-- /.form-group -->
						<div class="col-md-2">
							<div class="input-group">
								<label class="control-label" >Clave de Seguridad</label>
								<input type="password" placeholder="*******" maxlength="8" id="codigo"  name="codigo"  class="form-control" >
							</div> 
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label style="font-weight:bold"></label>
								<br>
								<button role="button" class="btn btn-primary" style="font-weight: bold;font-size: 13px; color: white" id="crear">
									&nbsp;<span class="glyphicon glyphicon-plus"></span>&nbsp;Generar
								</button>
							</div><!-- /.form-group -->
						</div><!-- /.form-group -->
					</form>
					
                  <table id="tab_bots" class="table table-bordered table-striped table-hover table-condensed dt-responsive table-responsive">
                    <thead>
                      <tr>
                        <th style='text-align: center'>Item</th>
                        <th style='text-align: center'>Moneda</th>
                        <th style='text-align: center'>Monto de pago</th>
                        <th style='text-align: center'>Monto mínimo de retiro</th>
                        <th style='text-align: center'>Cargo por mora</th>
                        <th style='text-align: center'>Fecha</th>
                        <th style='text-align: center'>Usuario</th>
                        <th style='text-align: center'>Links</th>
                      </tr>
                    </thead>
                      <tbody >    
                            <?php $i = 1; ?>

                            <?php foreach ($listar as $cuenta_bot) { ?>
                                <tr style="font-size: 16px;text-align: center" class="{% cycle 'impar' 'par' %}" >
                                    <td>
                                        <?php echo $i; ?>
                                    </td>
                                     <td>
                                        <?php
                                        foreach($monedas as $moneda)
                                        {
											if($moneda->id == $cuenta_bot->moneda)
											{
												echo $moneda->descripcion;
											}
										} 
                                        ?>
                                    </td>                                 
                                    <td style='text-align: center'>
									  <?php echo $cuenta_bot->monto_pago; ?>
									</td>
                                    <td style='text-align: center'>
									  <?php echo $cuenta_bot->monto_retiro_minimo; ?>
									</td>
									</td>
                                    <td style='text-align: center'>
									  <?php echo $cuenta_bot->cargo_mora; ?>
									</td>
									<td style='text-align: center'>
									   <?php echo $cuenta_bot->fecha; ?>
									</td>
									<td style='text-align: center'>
									   <?php
                                        foreach($usuarios as $usuario)
                                        {
											if($usuario->id == $cuenta_bot->user_create)
											{
												echo $usuario->username;
											}
										} 
                                       ?>
									</td>
									<td style='text-align: center'>
									   <?php
										echo "</br>";
                                        foreach($links as $link)
                                        {
											if($link->bot_id == $cuenta_bot->id)
											{
												echo $link->links;
												if($link->estatus == 1){
													echo " (<span style='color:green'>Disponible</span>)</br>";
												}else{
													echo " (<span style='color:red'>Ocupado</span>)</br>";
												}
											}
										} 
                                       ?>
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
         <!-- <img  src="<?= base_url() ?>/static/img/footer.png"/> -->
      </footer>
</div><!-- /wrapper -->
<!-- MODAL INFORMACION -->
<div class="modal" id="myModal">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header" style="background-color: #f56954; color: white">
			  <h4 class="modal-title" style="font-weight: bold">Generar Bots</h4>
			</div>
			<div class="modal-body">
				<p class="text-justify">¿Está seguro que desea generar bots con los parámetros indicados?, si quiere proseguir haga click en el botón
				<span class="label label-danger ">Procesar</span>, de lo contrario si desea cancelar esta acción click en
				<span class="label label-warning"> Descartar</span>.
				</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-warning" id="descartar" class="close" style="font-weight: bold" >Descartar</button>
				<button type="button" class="btn btn-danger " id="procesar" style="font-weight: bold">Procesar</button>
			</div>
		</div>
	</div>
</div>

    <script>
    
       var Tusuarios = $('#tab_bots').dataTable({
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
            {"sClass": "registro center", "sWidth": "20%"},
            {"sClass": "registro center", "sWidth": "20%"},
            {"sClass": "registro center", "sWidth": "20%"},
            {"sClass": "registro center", "sWidth": "10%"},
            {"sClass": "registro center", "sWidth": "10%"},
            {"sClass": "none", "sWidth": "20%"}
        ]
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
	$("#monto_pago").numeric(); //sólo permite valores numericos
	$("#monto_retiro_minimo").numeric(); //sólo permite valores numericos
	$("#cargo_mora").numeric(); //sólo permite valores numericos
   
	$('#crear').click(function(e){
	   e.preventDefault();
	   if ($('#moneda').val() == '0' || $('#moneda').val() == '') {
			bootbox.alert("Seleccione la moneda", function () {
			}).on('hidden.bs.modal', function (event) {
				$("#moneda").parent('div').addClass('has-error')
				$("#moneda").focus();
			});
		}else if ($('#monto_pago').val() == '0' || $('#monto_pago').val() == '') {
			bootbox.alert("Indique el monto", function () {
			}).on('hidden.bs.modal', function (event) {
				$("#monto_pago").parent('div').addClass('has-error')
				$('#monto_pago').val('');
				$("#monto_pago").focus();
			});
		}else if ($('#monto_retiro_minimo').val() == '0' || $('#monto_retiro_minimo').val() == '') {
			bootbox.alert("Indique el monto", function () {
			}).on('hidden.bs.modal', function (event) {
				$("#monto_retiro_minimo").parent('div').addClass('has-error')
				$('#monto_retiro_minimo').val('');
				$("#monto_retiro_minimo").focus();
			});
		}else if ($('#cargo_mora').val() == '0' || $('#cargo_mora').val() == '') {
			bootbox.alert("Indique el monto para el cargo por mora", function () {
			}).on('hidden.bs.modal', function (event) {
				$("#cargo_mora").parent('div').addClass('has-error')
				$('#cargo_mora').val('');
				$("#cargo_mora").focus();
			});
		}else if (parseFloat($('#monto_retiro_minimo').val()) > parseFloat($('#monto_pago').val())) {
			bootbox.alert("El monto mínimo de retiro no puede ser mayor al monto de pago", function () {
			}).on('hidden.bs.modal', function (event) {
				$("#monto_retiro_minimo").parent('div').addClass('has-error');
				$("#monto_retiro_minimo").focus();
			});
		}else if (parseFloat($('#cargo_mora').val()) > diez_por_ciento($('#monto_pago').val())) {
			bootbox.alert("El monto de cargo por mora no puede ser mayor al 10 % del monto de pago", function () {
			}).on('hidden.bs.modal', function (event) {
				$("#cargo_mora").parent('div').addClass('has-error');
				$("#cargo_mora").focus();
			});
		}else{
			$("#myModal").modal("show");
		}
		
	});
   
	$('#descartar').click(function(e){
	   $("#myModal").modal("hide");
	});
    
    $('#procesar').click(function(e){
        var id = this.getAttribute('value');
        var pk_id = $('#id').val()
        //alert(id)
	//$('#myModal').modal('keyboard')
        $.post('<?php echo base_url(); ?>index.php/administracion/CBots/guardar/', $('#form_bots').serialize(), function (response) {
			if (response.trim() == 1) {
				bootbox.alert("Disculpe, ya existen bots con la moneda y el monto de pago especificado", function () {
				}).on('hidden.bs.modal', function (event) {
					
				});
			} else {
				$.post('<?php echo base_url(); ?>index.php/administracion/CBots/generar/', $('#form_bots').serialize(), function (response2) {
					//~ alert(response2);
					bootbox.alert("Se registró con exito", function () {
					}).on('hidden.bs.modal', function (event) {
						window.location = '<?php echo base_url(); ?>index.php/administracion/CBots/';
					});
				});
				
			}
        });
    });
    
    function diez_por_ciento(monto){
		diez = parseFloat(monto)*10/100;
		return diez;
	}

    </script>
