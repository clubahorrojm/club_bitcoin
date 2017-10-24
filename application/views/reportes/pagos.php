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
        <br/><br/><br/>
        <!-- Content Header (Page header) -->
        <section class="content-header">
	    <h1>
		Reporte de Pagos
	    </h1>
	    <ol class="breadcrumb">
	      <li><a href="#"><i class="fa fa-home"></i> Inicio</a></li>
	      <li>Reportes</li>
	      <li class="active">Reporte de Pagos</li>
	    </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-primary">
		<form class="form-horizontal" id="form_tiposervicio">
		    <fieldset>
			<legend>Generar Reporte de Pagos</legend>
			<!--<div class="col-md-3">
			    <div class="form-group">
				<label style="font-weight:bold">Cuenta</label>
				<select class="form-control" autofocus="" id="cuenta" maxlength="7" name="cuenta">
				    <option value="">Seleccione</option>
				    <?php foreach ($cuentas as $cuenta) { ?>
					<option value="<?php echo $cuenta->id;?>">
					<?php echo $cuenta->descripcion;?> - 
					<?php
					foreach ($bancos as $banco) {
						if($banco->id == $cuenta->banco_id){
							echo $banco->descripcion;
						}
					}
					?>
					</option>
				    <?php }?>
				</select>
			    </div>
			</div>-->
			<div class="col-md-3">
			    <div class="form-group">
				<label style="font-weight:bold">Estatus</label>
				<select class="form-control" autofocus="" id="estatus" maxlength="7" name="estatus">
				    <option value="">Seleccione</option>
					<option value="1">Pendiente</option>
					<option value="2">Validado</option>
				</select>
			    </div><!-- /.form-group -->
			</div><!-- /.form-group -->
			<div class="col-md-2">
			    <div class="form-group">
				<label style="font-weight:bold">Desde</label>
				<input class="form-control input-sm" type='text' placeholder="Fecha de inicio" id="desde" name="desde" maxlength="10"/>
			    </div><!-- /.form-group -->
			</div><!-- /.form-group -->
			<div class="col-md-2">
			    <div class="form-group">
				<label style="font-weight:bold">Hasta</label>
				<input class="form-control input-sm" type='text' placeholder="Fecha de conclusion" id="hasta" name="hasta" maxlength="10"/>
			    </div><!-- /.form-group -->
			</div><!-- /.form-group -->
			<div class="col-md-2">
			    <div class="form-group">
				<label style="font-weight:bold">&nbsp;</label><br>
				<button type="submit" id="generar_pdf_pago" style="font-weight: bold;font-size: 13px" class="btn btn-danger"/>
				&nbsp;<span class="glyphicon glyphicon-file"></span>&nbsp;Generar
				</button>
			    </div><!-- /.form-group -->
			</div><!-- /.form-group -->
		    </fieldset>
		</form>
                
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0
        </div>
        <strong>Network C. A.</strong> 
    </footer>
</div><!-- /wrapper -->
<script>
$(document).ready(function(){
      
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
    $("#desde").numeric({allow: "/"}); //Valida solo permite valores numéricos
    $("#hasta").numeric({allow: "/"}); //Valida solo permite valores numéricos
                
    $('#desde').datepicker({
		format: "dd/mm/yyyy",
		endDate: 'today',
		minDate: "-1D",
		maxDate: "-1D",
		language: "es",
		autoclose: true,
    });
		    
    $('#hasta').datepicker({
		format: "dd/mm/yyyy",
		endDate: 'today',
		minDate: "-1D",
		maxDate: "-1D",
		language: "es",
		autoclose: true,
    });
                

    $("#generar_pdf_pago").click(function (e) {
		e.preventDefault();  // Para evitar que se envíe por defecto
		
		//~ if($('#cuenta').val().trim() == '' && $('#estatus').val().trim() == '' && $('#desde').val().trim() == '' && $('#hasta').val().trim() == ''){
		if($('#estatus').val().trim() == '' && $('#desde').val().trim() == '' && $('#hasta').val().trim() == ''){
			bootbox.alert("Debe indicar algún parámetro de búsqueda", function () {
			}).on('hidden.bs.modal', function (event) {
				$('#cuenta').parent('div').addClass('has-error');
				$('#estatus').parent('div').addClass('has-error');
				$('#desde').parent('div').addClass('has-error');
				$('#hasta').parent('div').addClass('has-error');
			});
		}else if(($('#desde').val().trim() != '' && $('#hasta').val().trim() == '') || ($('#desde').val().trim() == '' && $('#hasta').val().trim() != '')){
			bootbox.alert("Debe completar el rango de fechas", function () {
			}).on('hidden.bs.modal', function (event) {
				$('#estatus').parent('div').addClass('has-error');
				$('#desde').parent('div').addClass('has-error');
				$('#hasta').parent('div').addClass('has-error');
			});
		}else{
			//~ var cuenta = $('#cuenta').val().trim();
			var estatus = $('#estatus').val().trim();
			var desde = $('#desde').val().trim();
			var hasta = $('#hasta').val().trim();
			//~ if (cuenta == ""){
				//~ cuenta = "xxx";
			//~ }
			if (estatus == ""){
				estatus = "xxx";
			}
			if(desde == "" && hasta == ""){
				desde = "xxx";
				hasta = "xxx";
			}else{
				desde = desde.split("/");
				desde = desde[2]+"-"+desde[1]+"-"+desde[0];
				hasta = hasta.split("/");
				hasta = hasta[2]+"-"+hasta[1]+"-"+hasta[0];
			}
			
			//~ alert(cuenta);
			// Función para validar si hay registros para la búsqueda especificada
			//~ $.post('<?php echo base_url(); ?>index.php/reportes/CRepPagos/obtenerPagos/' + cuenta + '/' + estatus + '/' + desde + '/' + hasta + '', function (response) {
			$.post('<?php echo base_url(); ?>index.php/reportes/CRepPagos/obtenerPagos/' + estatus + '/' + desde + '/' + hasta + '', function (response) {
				//~ alert(response.trim());
				if (response.trim() == '0') {
					bootbox.alert("No hay registros para la consulta especificada", function () {
					}).on('hidden.bs.modal', function (event) {    
					});
				}else{
					//~ URL = '<?php echo base_url(); ?>index.php/reportes/CRepPagos/pdf_pagos/' + cuenta + '/' + estatus + '/' + desde + '/' + hasta + '';
					URL = '<?php echo base_url(); ?>index.php/reportes/CRepPagos/pdf_pagos/' + estatus + '/' + desde + '/' + hasta + '';
					$.fancybox.open({ padding : 0, href: URL, type: 'iframe',width: 1024, height: 860, });
				}
			});
		} 
    });
});
</script>
