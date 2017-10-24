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
          <h1 style="color:#3C8DBC" >
           Grupos de Usuarios
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php"  style="color:#3C8DBC"><i class="fa fa-home"></i> Inicio</a></li>
            <li style="color:#3C8DBC">Configuraciones</li>
            <li class="active">Grupos de Usuarios</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              
          
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title" style="color:#3C8DBC">Listado de Grupos de Usuarios</h3>
                </div><!-- /.box-header -->
                <!--<button role="button" class="btn btn-primary" style="font-weight: bold;font-size: 13px; color: white " id="enviar"  >
                    
                    &nbsp;<span class="glyphicon glyphicon-plus"></span>&nbsp;Agregar Grupo de Usuario
                </button>-->
                <br/>
                <div class="box-body">
                  <table id="tab_grupos" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='text-align: center'>Item</th>
                        <th style='text-align: center'>Grupo de Usuario</th>
<!--                        <th style='text-align: center'>Activar/Desactivar</th>
                        <th style='text-align: center'>Editar</th>
                        <th style='text-align: center'>Borrar</th>-->
                      </tr>
                    </thead>
                      <tbody >    
                            <?php $i = 1; ?>

                            <?php foreach ($listar as $grup_user) { ?>
                                <tr style="font-size: 16px;text-align: center" class="{% cycle 'impar' 'par' %}" >
                                    <td>
                                        <?php echo $i; ?>
                                    </td>
                                     <td>
                                        <?php echo $grup_user->name; ?>
                                    </td>    
                                     <!--<td style='text-align: center'>
                                <?php if ($grup_user->activo == 't') {?>
                                    <input class='activar_desactivar' id='<?php echo $grup_user->id; ?>' type="checkbox" title='Desactivar el usuario <?php echo $grup_user->id;?>' checked="checked"/>
                                    <?php }else if ($grup_user->activo == 'f'){ ?>
                                    <input class='activar_desactivar' id='<?php echo $grup_user->id; ?>' type="checkbox" title='Activar el usuario <?php echo $grup_user->id;?>'/>
                                    <?php } ?>
                            </td>
                               
                                    <td style='text-align: center'>
                                        <a title="Editar" href="<?php echo base_url() ?>index.php/configuracion/grupos_usuarios/ControllersGrupoUsuarios/editar/<?= $grup_user->id; ?>"><i class="fa fa-pencil"></i></a>
                                    </td>
                                    <td style='text-align: center'>

                                        <a class='borrar' id='<?php echo $grup_user->id; ?>' title="Borrar" href="<?php echo base_url() ?>index.php/configuracion/prioridades/ControllersPrioridades/eliminar/<?= $grup_user->id; ?>"><i class="fa fa-trash"></i></a>
                                    </td>-->
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
            <b>Version</b> 1.0
        </div>
        <strong>Network C. A.</strong> 
    </footer>
</div><!-- /wrapper -->
    

   
    <script>
        
               
            //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].activar_desactivar, input[type="radio"].activar_desactivar').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });


    // Función para activar/desactivar un usuario
	$("table#tab_grupos").on('ifChanged', 'input.activar_desactivar', function (e) {
		e.preventDefault();

		var id = this.getAttribute('id');
		//alert(id)
		
		var check = $(this);
		
		//~ alert(check.prop('checked'));
		
		var accion = '';
		if (check.is(':checked')) {
            accion = 'activar';
        }else{
			accion = 'desactivar';
		}
		
		//~ var padre = $(this).closest('tr');
		//~ var nRow  = padre[0];
		bootbox.confirm("¿Desea "+accion+" el Grupo de Usuario?", function(result) {
			if (result) {
				$("#motivo_anulacion").val('');
				$("#accion").val(accion);
				
				var mensaje = "";
				if (accion == 'desactivar'){
					mensaje = "desactivado";
				}else{
					mensaje = "activado";
				}
				
				//~ alert("código de la factura: "+$("#codfactura").val());
				//~ alert("motivo de la anulación: "+$("#motivo_anulacion").val());
				
				$.post('<?php echo base_url(); ?>index.php/configuracion/grupos_usuarios/ControllersGrupoUsuarios/activar_desactivar/' + id, {'accion':accion}, function(response) {
					bootbox.alert("El Grupo de usuario fue "+mensaje+" exitosamente", function () {
					}).on('hidden.bs.modal', function (event) {
						location.reload();
					});
				})
				
			}
		}); 
	   
	   
	});
        
      
    
       var Tusuarios = $('#tab_grupos').dataTable({
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
            // {"sClass": "registro center", "sWidth": "20%"},
            //{"sWidth": "3%", "bSortable": false, "sClass": "center sorting_false", "bSearchable": false},
            //{"sWidth": "3%", "bSortable": false, "sClass": "center sorting_false", "bSearchable": false}
        ]
    });
    


    
       
     // Validacion para borrar
            $("table#tab_grupos").on('click', 'a.borrar', function (e) {
                e.preventDefault();
                var id = this.getAttribute('id');
															bootbox.prompt({
																			message: "¿Desea eliminar este grupo de usuario?",
                   title: "Borrar registro",
																			inputType: 'password',
																			size: 'small',
																			callback: function (result) {
																							console.log(result);
																							var codigo_seg = result;
																								$.post('<?php echo base_url(); ?>index.php/configuracion/grupos_usuarios/ControllersGrupoUsuarios/eliminar/' + id + '-' +codigo_seg, function (response) {
																											
																											if (response[0] == '1') {
																															bootbox.alert("Disculpe, código de seguridad invalido", function () {
																															}).on('hidden.bs.modal', function (event) {
																																			$("#codigo").parent('div').addClass('has-error')
																																			$("#codigo").focus();
																															});
																											}else if (response[0] == "e") {
																															bootbox.alert("Disculpe, el grupo de usuario que desea eliminar se encuentra asociado a un usuario", function () {
																															}).on('hidden.bs.modal', function (event) {
																															});
																											} else {
																															bootbox.alert("Se elimino con exito", function () {
																															}).on('hidden.bs.modal', function (event) {
																																			url = '<?php echo base_url(); ?>index.php/configuracion/grupos_usuarios/ControllersGrupoUsuarios';
																																			window.location = url;
																															});
																											}
																							});
																			}
															});
                //bootbox.dialog({
                //    message: "¿Desea eliminar este grupo de usuario?",
                //    title: "Borrar registro",
                //    buttons: {
                //        success: {
                //            label: "Descartar",
                //            className: "btn-primary",
                //            callback: function () {
                //
                //            }
                //        },
                //        danger: {
                //            label: "Procesar",
                //            className: "btn-warning",
                //            callback: function () {
                //                alert(id);
                //                //$.post('<?php echo base_url(); ?>index.php/configuracion/grupos_usuarios/ControllersGrupoUsuarios/eliminar/' + id + '', function (response) {
                //                //    
                //                //    if (response[0] == "e") {
                //                //
                //                //        bootbox.alert("Disculpe, el grupo de usuario que desea eliminar se encuentra asociado a un usuario", function () {
                //                //        }).on('hidden.bs.modal', function (event) {
                //                //        });
                //                //
                //                //    } else {
                //                //        bootbox.alert("Se elimino con exito", function () {
                //                //        }).on('hidden.bs.modal', function (event) {
                //                //            url = '<?php echo base_url(); ?>index.php/configuracion/grupos_usuarios/ControllersGrupoUsuarios';
                //                //            window.location = url;
                //                //        });
                //                //    }
                //                //});
                //            }
                //        }
                //    }
                //});
            });
            
            $('#enviar').click(function () {
                url = '<?php echo base_url() ?>index.php/configuracion/grupos_usuarios/ControllersGrupoUsuarios/registrar';
                window.location = url;
            });
            
  
	
	
	


    </script>
