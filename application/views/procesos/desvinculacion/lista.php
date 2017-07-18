<?php
if (isset($this->session->userdata['logged_in'])) {
$username = ($this->session->userdata['logged_in']['username']);
$email = ($this->session->userdata['logged_in']['email']);
$tipouser = ($this->session->userdata['logged_in']['tipo_usuario']);
$id_user = ($this->session->userdata['logged_in']['id']);
$codigo = ($this->session->userdata['logged_in']['codigo']);
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
           Perfiles inactivos
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php" style="color:#3C8DBC"><i class="fa fa-home"></i> Inicio</a></li>
            <li>Procesos</li>
            <li class="active">Perfiles inactivos</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              
          
              <div class="box box-primary">
                <div class="box-header">
					<div class="text-left">
						<legend><H4  style="color:#3C8DBC">Listado de Perfiles inactivos</H4></legend>
					</div>
                </div><!-- /.box-header -->
                <br/>
                <div class="box-body">
                  <table id="tab_links" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='text-align: center'>Item</th>
                        <th style='text-align: center'>Usuario</th>
                        <th style='text-align: center'>Nombre</th>
                        <th style='text-align: center'>Estatus</th>
                        <th style='text-align: center'>Fecha</th>
                        <th style='text-align: center'>Desvincular</th>
                        <th style='text-align: center'>Eliminar</th>
                        <th style='text-align: center'>Re-vincular</th>
                      </tr>
                    </thead>
                      <tbody >    
                            <?php $i = 1; ?>

                            <?php foreach ($perfiles as $perfil) { ?>
                                <tr style="font-size: 16px;text-align: center" class="{% cycle 'impar' 'par' %}" >
                                    <td>
                                        <?php echo $i; ?>
                                    </td>
                                    <td>
                                        <?php
										echo $perfil->username;
                                        ?>
                                    </td> 
                                    <td>
                                        <?php echo $perfil->first_name.' '.$perfil->last_name; ?>
                                    </td>                                 
                                    <td>
                                        <?php echo $perfil->estatus_perfil; ?>
                                    </td>                                 
                                    <td>
										<?php echo $perfil->fecha; ?>
									</td>
                                    <td style='text-align: center'>
										<?php if ($perfil->estatus_perfil == 2 || $perfil->estatus_perfil == 3) {?>
										<a data-toggle="modal" data-target="#myModal2" class='levantar2' id='<?php echo $perfil->id; ?>' title="Desvincular" ><i class="fa fa-user-times text-info"></i></a>
										<?php }else{ ?>
										<img style="width:20px;height: 20px" src="<?php echo base_url()?>static/img/block.png"/>
										<?php } ?>
									</td>
                                    <td style='text-align: center'>
										<?php if ($perfil->estatus_perfil == 1) {?>
										<a data-toggle="modal" data-target="#myModal" class='levantar' id='<?php echo $perfil->id; ?>' title="Borrar" ><i class="fa fa-trash text-primary"></i></a>
										<?php }else{ ?>
										<img style="width:20px;height: 20px" src="<?php echo base_url()?>static/img/block.png"/>
										<?php } ?>
									</td>
                                    <td style='text-align: center'>
										<?php if ($perfil->estatus_perfil == 0) {?>
										<a data-toggle="modal" data-target="#myModal3" class='levantar3' id='<?php echo $perfil->id; ?>' title="Revincular" ><i class="fa fa-user-plus text-primary"></i></a>
										<?php }else{ ?>
										<img style="width:20px;height: 20px" src="<?php echo base_url()?>static/img/block.png"/>
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
			<h4 class="modal-title">
			   <center><span class="glyphicon glyphicon-search"></span>
			   &nbsp;Ingrese el número de pago y la fecha de su realización</center>
			</h4>
		 </div>
		 <div class="modal-body">
			<form id="f_aprobacion" name="f_aprobacion" action="" method="post">
			   <div class="form-group">
					<div class="col-sm-12">
						<input type="hidden" id="codigo" name="codigo">
						<input type="text" class="form-control" style="width: 100%; " id="num_pago" name="num_pago" placeholder="Número de pago" autofocus="true">
					</div>
					</br></br></br>
					<div class="col-sm-12">
						<input style="width: 100%;" type="text" class="form-control" id="fecha_verificacion" name="fecha_verificacion" placeholder="Fecha de verificación" maxlength="10"/>
					</div>
					</br></br></br>
					<div class="col-sm-12" align="right">
						<span class="input-btn">
							<button class="btn btn-primary" type="button" id="enviar">
								Aprobar&nbsp;<span class="glyphicon glyphicon-share-alt"></span>
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

<div class="modal" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="background-color: #f56954; color: white">
              <h4 class="modal-title" style="font-weight: bold">Eliminar Registro</h4>
            </div>
            <div class="modal-body">
                <p class="text-justify">¿Está seguro que desea eliminar este registro?, si quiere eliminarlo haga click en el botón
                <span class="label label-danger ">Procesar</span>, de lo contrario si desea cancelar esta acción click en
                <span class="label label-warning"> Descartar</span>.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" class="close" data-dismiss="modal" style="font-weight: bold" >Descartar</button>
                <button type="button" class="btn btn-danger " id="procesar" style="font-weight: bold">Procesar</button>
                
            </div>
        </div>
    </div>
</div>

<div class="modal" id="myModal2" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="background-color: #f56954; color: white">
              <h4 class="modal-title" style="font-weight: bold">Desvincular Registro</h4>
            </div>
            <div class="modal-body">
                <p class="text-justify">¿Está seguro que desea desvincular este registro?, si quiere desvincularlo haga click en el botón
                <span class="label label-danger ">Procesar</span>, de lo contrario si desea cancelar esta acción click en
                <span class="label label-warning"> Descartar</span>.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" class="close" data-dismiss="modal" style="font-weight: bold" >Descartar</button>
                <button type="button" class="btn btn-danger " id="procesar2" style="font-weight: bold">Procesar</button>
                
            </div>
        </div>
    </div>
</div>

<div class="modal" id="myModal3" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="background-color: #f56954; color: white">
              <h4 class="modal-title" style="font-weight: bold">Re-vincular Registro</h4>
            </div>
            <div class="modal-body">
				<p>
					<label style="font-weight:bold">Links disponibles</label>
					<select id="id_links" name="id_links" class="form-control select2 input-sm" >
						<option value="">Seleccione</option>
					</select>
				</p>
                <p class="text-justify">¿Está seguro que desea re-vincular este registro?, si quiere re-vincularlo haga click en el botón
                <span class="label label-danger ">Procesar</span>, de lo contrario si desea cancelar esta acción click en
                <span class="label label-warning"> Descartar</span>.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" class="close" data-dismiss="modal" style="font-weight: bold" >Descartar</button>
                <button type="button" class="btn btn-danger " id="procesar3" style="font-weight: bold">Procesar</button>
                
            </div>
        </div>
    </div>
</div>

    <script>
    
	var TTCuentas = $('#tab_links').dataTable({
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
			{"sClass": "registro center", "sWidth": "50%"},
			{"sClass": "registro center", "sWidth": "50%"},
			{"sClass": "registro center", "sWidth": "50%"},
			{"sClass": "registro center", "sWidth": "10%"},
			{"sWidth": "3%", "bSortable": false, "sClass": "center sorting_false", "bSearchable": false},
			{"sWidth": "3%", "bSortable": false, "sClass": "center sorting_false", "bSearchable": false},
			{"sWidth": "3%", "bSortable": false, "sClass": "center sorting_false", "bSearchable": false},
		]
    });
    
    $('.levantar').click(function(e){
        var id = this.getAttribute('id');
        $("#procesar").val(id);
    });
    
    $('#procesar').click(function(e){
        var id = this.getAttribute('value');
        
        $.post('<?php echo base_url(); ?>index.php/procesos/CLDesvincular/eliminar_usuario/' + id + '', function (response) {
			bootbox.alert("Se elimino con exito", function () {
			}).on('hidden.bs.modal', function (event) {
				window.location = '<?php echo base_url(); ?>index.php/procesos/CLDesvincular'
			});
        });
    });
    
    $('.levantar2').click(function(e){
        var id = this.getAttribute('id');
        $("#procesar2").val(id);
    });
    
    $('#procesar2').click(function(e){
        var id = this.getAttribute('value');
        
        $.post('<?php echo base_url(); ?>index.php/procesos/CLDesvincular/desvincular_usuario/' + id + '', function (response) {
			bootbox.alert("Se desvinculó con exito", function () {
			}).on('hidden.bs.modal', function (event) {
				window.location = '<?php echo base_url(); ?>index.php/procesos/CLDesvincular'
			});
        });
    });
    
    $('.levantar3').click(function(e){
        var id = this.getAttribute('id');
        $("#procesar3").val(id);
        
		$('#id_links').find('option:gt(0)').remove().end().select2('val', '0');
		$.get('<?php echo base_url(); ?>index.php/procesos/CLDesvincular/links_disponibles/' + id + '', function (data) {
			var option = "";
			$.each(data, function (i) {
				option += "<option value=" + data[i]['id'] + ">" + data[i]['links'] + "</option>";
			});
			$('#id_links').append(option);
		}, 'json');
    });
    
    $('#procesar3').click(function(e){
        var id = this.getAttribute('value');
        
        if ($('#id_links').val() == '0' || $('#id_links').val() == '') {
			bootbox.alert("Seleccione el nuevo link para el usuario", function () {
			}).on('hidden.bs.modal', function (event) {
				$("#id_links").parent('div').addClass('has-error')
				$('#id_links').val('');
				$("#id_links").focus();
			});
		}else{
			$.post('<?php echo base_url(); ?>index.php/procesos/CLDesvincular/revincular_usuario/' + id + '/' + $('#id_links').val(), function (response) {
				bootbox.alert("Se re-asignó con exito", function () {
				}).on('hidden.bs.modal', function (event) {
					window.location = '<?php echo base_url(); ?>index.php/procesos/CLDesvincular'
				});
			});
		}
        
    });

    </script>
