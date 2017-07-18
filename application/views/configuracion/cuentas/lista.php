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
          <h1 style="color:#3C8DBC" >
           Cuentas
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php"  style="color:#3C8DBC"><i class="fa fa-home"></i> Inicio</a></li>
            <li style="color:#3C8DBC">Configuraciones</li>
            <li class="active">Cuentas</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              
          
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title" style="color:#3C8DBC">Listado de Cuentas</h3>
                </div><!-- /.box-header -->
                <button role="button" class="btn btn-primary" style="font-weight: bold;font-size: 13px; color: white " id="enviar"  >
                    
                    &nbsp;<span class="glyphicon glyphicon-plus"></span>&nbsp;Agregar Cuenta
                </button>
                <br/>
                <div class="box-body">
                  <table id="tab_cuentas" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='text-align: center'>Item</th>
                        <th style='text-align: center'>Cuenta</th>
                        <th style='text-align: center'>Tipo</th>
                        <th style='text-align: center'>Banco</th>
                        <th style='text-align: center'>Activar/Desactivar</th>
                        <th style='text-align: center'>Editar</th>
                        <th style='text-align: center'>Borrar</th>
                      </tr>
                    </thead>
                      <tbody >    
                            <?php $i = 1; ?>

                            <?php foreach ($listar as $cuenta) { ?>
                                <tr style="font-size: 16px;text-align: center" class="{% cycle 'impar' 'par' %}" >
                                    <td>
                                        <?php echo $i; ?>
                                    </td>
                                    <td>
                                        <?php echo $cuenta->descripcion; ?>
                                    </td> 
                                    <td>
                                        <?php
                                        foreach($listar_t_cuentas as $t_cuenta)
                                        {
											if($t_cuenta->codigo == $cuenta->tipo_cuenta_id)
											{
												echo $t_cuenta->descripcion;
											}
										} 
                                        ?>
                                    </td> 
                                    <td>
										<?php
                                        foreach($listar_bancos as $banco)
                                        {
											if($banco->codigo == $cuenta->banco_id)
											{
												echo $banco->descripcion;
											}
										} 
                                        ?>
                                    </td>                                 
                                    <td style='text-align: center'>
									  <?php if ($cuenta->activo == 't') {?>
									  <input class='activar_desactivar' id='<?php echo $cuenta->id; ?>' type="checkbox" title='Desactivar el tipo de cuenta <?php echo $cuenta->id;?>' checked="checked"/>
									  <?php }else if ($cuenta->activo == 'f'){ ?>
									  <input class='activar_desactivar' id='<?php echo $cuenta->id; ?>' type="checkbox" title='Activar el tipo de cuenta <?php echo $cuenta->id;?>'/>
									  <?php } ?>
									</td>
									<td style='text-align: center'>
									   <a title="Editar" href="<?php echo base_url() ?>index.php/configuracion/CCuentas/editar/<?= $cuenta->id; ?>"><i class="fa fa-pencil text-orange"></i></a>
									</td>
									<td style='text-align: center'>
									   <a data-toggle="modal" data-target="#myModal" class='levantar' id='<?php echo $cuenta->id; ?>' title="Borrar" ><i class="fa fa-trash text-black"></i></a>
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

    <script>

 
    
       var TTCuentas = $('#tab_cuentas').dataTable({
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
            {"sWidth": "3%", "bSortable": false, "sClass": "center sorting_false", "bSearchable": false}
        ]
    });
      
   // Validacion para borrar
   $('.levantar').click(function(e){
        var id = this.getAttribute('id');
        $("#procesar").val(id);
    });
    $('#procesar').click(function(e){
        var id = this.getAttribute('value');
        var pk_id = $('#id').val()
        //alert(id)
		//$('#myModal').modal('keyboard')
        $.post('<?php echo base_url(); ?>index.php/configuracion/CCuentas/eliminar/' + id + '', function (response) {
	    if (response[0] == "e") {
                bootbox.alert("Disculpe, el registro que desea eliminar se encuentra asociada a 1 o más registros", function () {
                }).on('hidden.bs.modal', function (event) {
		 window.location = '<?php echo base_url(); ?>index.php/configuracion/CCuentas'
                });
            } else {
                bootbox.alert("Se eliminó con exito", function () {
                }).on('hidden.bs.modal', function (event) {
                    window.location = '<?php echo base_url(); ?>index.php/configuracion/CCuentas'
                });
            }
        });
    });
    $('#enviar').click(function () {
	url = '<?php echo base_url() ?>index.php/configuracion/CCuentas/registrar';
	window.location = url;
    });


            
         //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].activar_desactivar, input[type="radio"].activar_desactivar').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });

	
	
	// Función para activar/desactivar un tipo de cuenta
	$("table#tab_cuentas").on('ifChanged', 'input.activar_desactivar', function (e) {
	    e.preventDefault();
 
	    var id = this.getAttribute('id');
	    //alert(id)
	    
	    var check = $(this);
	    
	    //alert(check.prop('checked'));
	    
	    var accion = '';
	    if (check.is(':checked')) {
	      accion = 'activar';
	    }else{
	      accion = 'desactivar';
	    }

		bootbox.confirm("¿Desea "+accion+" esta cuenta?", function(result) {
			if (result) {
				$("#motivo_anulacion").val('');
				$("#accion").val(accion);
				
				var mensaje = "";
				if (accion == 'desactivar'){
					mensaje = "desactivada";
				}else{
					mensaje = "activada";
				}

				$.post('<?php echo base_url(); ?>index.php/configuracion/CCuentas/activar_desactivar/' + id, {'accion':accion}, function(response) {
					bootbox.alert("La Cuenta fue "+mensaje+" exitosamente", function () {
					}).on('hidden.bs.modal', function (event) {
						location.reload();
					});
				})
				
			}
		}); 
	   
	   
	});
        
        
        
       

 
     

    </script>
