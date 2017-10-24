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
        <br/><br/><br/>
        <!-- Content Header (Page header) -->
        <section class="content-header">
	    <h1 style="color:#3C8DBC">
		Bitácora
	    </h1>
	    <ol class="breadcrumb">
	      <li><a href="<?php echo base_url(); ?>index.php" style="color:#3C8DBC"><i class="fa fa-home"></i> Inicio</a></li>
	      <li>Administración</li>
	      <li class="active">Bitácora</li>
	    </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-primary">
		<form class="form-horizontal" id="form_tiposervicio">
		    <fieldset>
				<div class="text-left">
					<legend><H4 style="color:#3C8DBC">Generar Reporte de Acciones</H4></legend>
				</div>
			<div class="col-md-3">
			    <div class="form-group">
				<label style="font-weight:bold">Usuario</label>
				<select class="form-control" autofocus="" id="usuario" maxlength="7" name="usuario">
				    <option value="">Seleccione</option>
				    <?php foreach ($usuarios as $usuario) { ?>
					<option value="<?php echo $usuario->id;?>"><?php echo $usuario->username;?></option>
				    <?php }?>
				</select>
			    </div><!-- /.form-group -->
			</div><!-- /.form-group -->
			<div class="col-md-2">
			    <div class="form-group">
				<label style="font-weight:bold">Desde</label>
				<input class="form-control" type='text' placeholder="Fecha de inicio" id="desde" name="desde" maxlength="10"/>
			    </div><!-- /.form-group -->
			</div><!-- /.form-group -->
			<div class="col-md-2">
			    <div class="form-group">
				<label style="font-weight:bold">Hasta</label>
				<input class="form-control" type='text' placeholder="Fecha de conclusion" id="hasta" name="hasta" maxlength="10"/>
			    </div><!-- /.form-group -->
			</div><!-- /.form-group -->
			<div class="col-md-2">
			    <div class="form-group">
				<label style="font-weight:bold">&nbsp;</label><br>
				<button type="submit" id="generar_pdf_auditoria" style="font-weight: bold;font-size: 13px" class="btn btn-danger"/>
				&nbsp;<span class="glyphicon glyphicon-file"></span>&nbsp;Generar
				</button>
			    </div><!-- /.form-group -->
			</div><!-- /.form-group -->
		    </fieldset>
		</form>
                <div class="box-header">
					<div class="text-left">
						<legend><H4 style="color:#3C8DBC">Listado de Acciones</H4></legend>
					</div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="tab_bitacora" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='text-align: center'>#</th>
			<th style='text-align: center'>Tabla</th>
			<th style='text-align: center'>Código</th>
			<th style='text-align: center'>Acción</th>
			<th style='text-align: center'>Usuario</th>
			<th style='text-align: center'>Fecha</th>
                      </tr>
                    </thead>
                      <tbody >    
                        <?php $i=1; ?>
                       <?php foreach ($listar as $auditoria) { ?>
                        <tr style="font-size: 16px;text-align: center">
                            <td><?php echo $i;?></td>
                            <td><?php echo $auditoria->tabla; ?></td>
                            <td><?php echo $auditoria->codigo; ?></td>
							<td><?php echo $auditoria->accion; ?></td>
							<td>
							<?php
							foreach($usuarios as $usuario){
								if($usuario->id == $auditoria->usuario){
									echo $usuario->username;
								}
							}
							?>
							</td>
							<td>
							<?php echo $auditoria->fecha; ?> <?php echo $auditoria->hora; ?> 
							</td>     
                        </tr>
                        <?php $i++ ?>
                        <?php }?>
                        
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
            <b>Version</b> 1.0
        </div>
        <strong>Network C. A.</strong> 
    </footer>
</div><!-- /wrapper -->
<script>
$(document).ready(function(){
    var Tusuarios = $('#tab_bitacora').dataTable({
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
            {"sClass": "registro center", "sWidth": "1%"},
            {"sClass": "registro center", "sWidth": "10%"},
            {"sClass": "registro center", "sWidth": "1%"},
            {"sClass": "registro center", "sWidth": "10%"},
            {"sClass": "registro center", "sWidth": "5%"},
            {"sClass": "registro left","sWidth": "5%" },
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
    $("#desde").numeric({allow: "/"}); //Valida solo permite valores numéricos
    $("#hasta").numeric({allow: "/"}); //Valida solo permite valores numéricos
                
    $('#desde').datepicker({
	format: "dd/mm/yyyy",
	endDate: 'today',
	minDate: "-1D",
	maxDate: "-1D",
	language: "es",
	autoclose: true,
    })
		    
    $('#hasta').datepicker({
	format: "dd/mm/yyyy",
	endDate: 'today',
	minDate: "-1D",
	maxDate: "-1D",
	language: "es",
	autoclose: true,
    })
                
                

    $("#generar_pdf_auditoria").click(function (e) {
		e.preventDefault();  // Para evitar que se envíe por defecto
		
		if($('#usuario').val().trim() == '' && $('#desde').val().trim() == '' && $('#hasta').val().trim() == ''){
			bootbox.alert("Debe indicar algún parámetro de búsqueda", function () {
			}).on('hidden.bs.modal', function (event) {
				$('#usuario').parent('div').addClass('has-error');
				$('#desde').parent('div').addClass('has-error');
				$('#hasta').parent('div').addClass('has-error');
			});
		}else if(($('#desde').val().trim() != '' && $('#hasta').val().trim() == '') || ($('#desde').val().trim() == '' && $('#hasta').val().trim() != '')){
			bootbox.alert("Debe completar el rango de fechas", function () {
			}).on('hidden.bs.modal', function (event) {
				$('#usuario').parent('div').addClass('has-error');
				$('#desde').parent('div').addClass('has-error');
				$('#hasta').parent('div').addClass('has-error');
			});
		}else{
			var usuario = $('#usuario').val().trim();
			var desde = $('#desde').val().trim();
			var hasta = $('#hasta').val().trim();
			if (usuario == ""){
				usuario = "xxx";
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
			// Función para validar si hay registros para la búsqueda especificada
			$.post('<?php echo base_url(); ?>index.php/administracion/CAuditoria/obtenerAuditorias/' + usuario + '/' + desde + '/' + hasta + '', function (response) {
				//~ alert(response);
				if (response[1] == '0') {
				bootbox.alert("No hay registros para la consulta especificada", function () {
				}).on('hidden.bs.modal', function (event) {    
				});
				}else{
				URL = '<?php echo base_url(); ?>index.php/administracion/CAuditoria/pdf_auditoria/' + usuario + '/' + desde + '/' + hasta + '';
				$.fancybox.open({ padding : 0, href: URL, type: 'iframe',width: 1024, height: 860, });
				}
			});
		} 
    });
});
</script>
