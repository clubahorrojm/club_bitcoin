<?php
if (isset($this->session->userdata['logged_in'])) {
    $username = ($this->session->userdata['logged_in']['username']);
    $email = ($this->session->userdata['logged_in']['email']);
    $tipouser = ($this->session->userdata['logged_in']['tipo_usuario']);
    $id_user = ($this->session->userdata['logged_in']['id']);
} else {
    redirect(base_url());
}
?>

<?php
if ($tipouser == 'Administrador') {
    
} else {
    redirect(base_url());
}
?>  
<div class="wrapper">



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height: 1156px;">
        <br/>
        <br/>
        <br/>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 style="color:#3C8DBC">
                Monedero Digital
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>index.php" style="color:#3C8DBC"><i class="fa fa-home"></i> Inicio</a></li>
                <li>Administrador</li>
                <li class="active">Monedero Digital</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-xs-12">

                    <!-- SELECT2 EXAMPLE -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
							<div class="text-left">
                                <legend><H4 style="color:#3C8DBC">Monedero Digital</H4></legend>
                            </div>
                            <div class="box-tools pull-right">

                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <form id="form_monedero">
								<div class="col-md-12">
									
									<div class="col-md-4">
										<div class="input-group">
											<label class="control-label" >Cuenta de Monedero digital</label>
											<input type="text" placeholder="Ej: 10" maxlength="34" id="monedero" value="<?php echo $editar->monedero ?>" name="monedero"  class="form-control" >
										</div> 
									</div>
									
									<div class="col-md-2">
										<div class="input-group">
											<label class="control-label" >Clave de Seguridad</label>
											<input type="password" placeholder="********" maxlength="8" id="codigo"  name="codigo"  class="form-control" >
										</div> 
									</div>

									
									<div class="form-group">
										<div class="col-md-12" style="text-align: center ">
											
											<input class="form-control"  type='hidden' id="id" name="id" value="1"/>
                                            <br>
											<button type="submit" id="registrar" style="font-weight: bold;font-size: 13px" class="btn btn-success"/>
											&nbsp;<span class="glyphicon glyphicon-floppy-disk"></span>&nbsp;Actualizar
											</button>
										</div>
									</div>
								</div>
								
                            </form>
                        </div><!-- /.box-body -->
                    </div><!-- /.box-body-primary -->

                </div><!-- /.col -->

        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0
        </div>
        <strong>Network C. A.</strong> 
    </footer>


    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->


<script>
    $(".select2").select2();
    $('#monedero').alphanumeric();
	$('#codigo').alphanumeric({allow: "*+-.#"});
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
	$("#registrar").click(function (e) {
        e.preventDefault();  // Para evitar que se envíe por defecto
        if (($('#monedero').val().trim() == '')) {
            bootbox.alert('Disculpe, la cuenta no puede estar en blanco', function () {
                $('#monedero').parent('div').addClass('has-error');
            });
		} else if (($('#codigo').val().trim() == '')) {
            bootbox.alert('Disculpe, debe introducir el código de seguridad', function () {
                $('#codigo').parent('div').addClass('has-error');
            });
        } else if (($('#monedero').val().length  < 34)) {
            bootbox.alert('Disculpe, la cantidad de digitos no es valida', function () {
                $('#monedero').parent('div').addClass('has-error');
            });
        }else if (($('#codigo').val().length  < 8)) {
            bootbox.alert('Disculpe, la cantidad de digitos no es valida', function () {
                $('#codigo').parent('div').addClass('has-error');
            });
        } else {
            $.post('<?php echo base_url(); ?>index.php/administracion/CMonedero/actualizar', $('#form_monedero').serialize(), function (response) {
				//alert(response[0]);
				if (response[0] == '1') {
                    bootbox.alert("Disculpe, código de seguridad invalido", function () {
                    }).on('hidden.bs.modal', function (event) {
                        $("#codigo").parent('div').addClass('has-error')
                        $("#codigo").focus();
                    });
                }else {
                    bootbox.alert("Se registro con exito", function () {
                    }).on('hidden.bs.modal', function (event) {
                        url = '<?php echo base_url(); ?>index.php/administracion/CMonedero'
						window.location = url
                    });
				}
			});
		}
    });



</script>
