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
           Gestión de Usuarios
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php"  style="color:#3C8DBC"><i class="fa fa-home"></i> Inicio</a></li>
            <li style="color:#3C8DBC">Configuraciones</li>
            <li class="active">Gestión de Usuarios</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              
          
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title" style="color:#3C8DBC">Listado de Usuarios</h3>
                </div><!-- /.box-header -->
                <button role="button" class="btn btn-primary" style="font-weight: bold;font-size: 13px; color: white " id="enviar"  >
                    
                    &nbsp;<span class="glyphicon glyphicon-plus"></span>&nbsp;Agregar Usuario
                </button>
                <br/>
                <div class="box-body">
                  <table id="tab_usuarios" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='text-align: center'>Item</th>
                        <th style='text-align: center'>Usuario</th>
                        <th style='text-align: center'>Cedula</th>
                        <th style='text-align: center'>Nombre y Apellido</th>
                        <th style='text-align: center'>Tipo Usuario</th>
                        <th style='text-align: center'>Activar/Desactivar</th>
                        <th style='text-align: center'>Editar</th>
                        
                      </tr>
                    </thead>
                     <tbody >    
                        <?php $i=1; ?>
                       <?php foreach ($listar as $usuario) { ?>
																							<?php if ($usuario->tipo_usuario == 1 || $usuario->tipo_usuario == 2) {?>
                        <tr style="font-size: 16px;text-align: center">
                            <td>
                             <?php echo $i;?>
                            </td>
                            <td>
                                <?php echo $usuario->username; ?>
                            </td>
                            <td>
                                <?php echo $usuario->cedula; ?>
                            </td>
                            <td>
                             <?php echo $usuario->first_name; ?> <?php echo $usuario->last_name; ?>
                            </td>
                            <td>
                            <?php
                            if($usuario->tipo_usuario == 4){
																													echo "Bots";
																												}else{
																													foreach ($grupos_usuarios as $grupo) {
																														if ($usuario->tipo_usuario == $grupo->codigo)
																														{
																															echo $grupo->name;
																														}
																													}
																												}
                            ?>
                            </td>
                         
                            <td style='text-align: center'>
                                <?php if ($usuario->estatus == 't') {?>
                                    <input class='activar_desactivar' id='<?php echo $usuario->id; ?>' type="checkbox" title='Desactivar el usuario <?php echo $usuario->id;?>' checked="checked"/>
                                    <?php }else if ($usuario->estatus == 'f'){ ?>
                                    <input class='activar_desactivar' id='<?php echo $usuario->id; ?>' type="checkbox" title='Activar el usuario <?php echo $usuario->id;?>'/>
                                    <?php } ?>
                            </td>


                            <td style='text-align: center'>
                                <a href="<?php echo base_url()?>index.php/configuracion/usuarios/usuarios/editar/<?= $usuario->id; ?>" title="Editar"><i class="fa fa-pencil"></i></a>
                            </td>
                            
                        </tr>
																								<?php } ?>
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

 
    
       var Tusuarios = $('#tab_usuarios').dataTable({
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
            {"sClass": "registro center", "sWidth": "5%"},
            {"sClass": "registro center", "sWidth": "10%"},
            {"sClass": "registro center", "sWidth": "20%"},
            {"sClass": "registro left","sWidth": "3%" },
            {"sWidth": "3%", "bSortable": false, "sClass": "center sorting_false", "bSearchable": false},
            {"sWidth": "3%", "bSortable": false, "sClass": "center sorting_false", "bSearchable": false}
        ]
    });
      
    $('#enviar').click(function(){
        url = '<?php echo base_url()?>index.php/configuracion/usuarios/usuarios/registrar'
        window.location = url
    })
    
    //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].activar_desactivar, input[type="radio"].activar_desactivar').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });

	
	
	// Función para activar/desactivar un usuario
	$("table#tab_usuarios").on('ifChanged', 'input.activar_desactivar', function (e) {
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
		bootbox.confirm("¿Desea "+accion+" el Usuario?", function(result) {
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
				
				$.post('<?php echo base_url(); ?>index.php/configuracion/usuarios/Usuarios/activar_desactivar/' + id, {'accion':accion}, function(response) {
					bootbox.alert("El usuario fue "+mensaje+" exitosamente", function () {
					}).on('hidden.bs.modal', function (event) {
						location.reload();
					});
				})
				
			}
		}); 
	   
	   
	});
        
        
       

 
     

    </script>
