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
            <h1 style="color:#3C8DBC" >
                Grupos de Usuarios
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>index.php"  style="color:#3C8DBC"><i class="fa fa-home"></i> Inicio</a></li>
                <li style="color:#3C8DBC">Configuraciones</li>
                <li class="active">Prioridades</li>
                <li class="active">Editar Grupo de Usuario</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-xs-12">

                    <!-- SELECT2 EXAMPLE -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title" style="color:#3C8DBC">Editar Grupo de Usuario <strong></strong></h3>
                            <div class="box-tools pull-right">

                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <form id="form_grupos">
								<div class="col-md-1">
                                    <div class="form-group">
                                        <label style="font-weight:bold">Código</label>
                                        <input type="text" autofocus="" placeholder="Ej: 8" maxlength="2"  readonly="true" value="<?php echo $editar[0]->codigo ?>" name="codigo"  class="form-control">
                                    </div><!-- /.form-group -->
                                </div><!-- /.form-group -->
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label style="font-weight:bold">Grupo de Usuario</label>
                                        <input type="text" placeholder="Introduzca Prioridad" maxlength="80" id="name" value="<?php echo $editar[0]->name ?>" name="name" style="text-transform:uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase();" class="form-control">
                                    </div><!-- /.form-group -->
                                </div><!-- /.form-group -->
								<div class="col-md-2">
										<div class="input-group">
											<label class="control-label" >Clave de Seguridad</label>
											<input type="password" placeholder="********" maxlength="8" id="codigo_seg"  name="codigo_seg"  class="form-control" >
										</div> 
									</div>
                                <div class="form-group">
                                    <div class="col-md-12">

                                        <input class="form-control"  type='hidden' placeholder="id" id="id" name="id" value="<?php echo $id ?>"/>
                                        <button type="button" id="volver" style="font-weight: bold;font-size: 13px" class="btn btn-danger " >
                                            &nbsp;<span class="glyphicon glyphicon-chevron-left"></span>&nbsp;Volver
                                        </button>
                                        <button type="submit" id="registrar" style="font-weight: bold;font-size: 13px" class="btn btn-success"/>
                                        &nbsp;<span class="glyphicon glyphicon-floppy-disk"></span>&nbsp;Actualizar
                                        </button>

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
            <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
    </footer>


    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->


<script>

    //Initialize Select2 Elements
    $(".select2").select2();

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

    $('#volver').click(function () {
        url = '<?php echo base_url() ?>index.php/configuracion/grupos_usuarios/ControllersGrupoUsuarios'
        window.location = url
    })


    $("#registrar").click(function (e) {
        e.preventDefault();  // Para evitar que se envíe por defecto

        if (($('#name').val().trim() == '')) {
            bootbox.alert('Disculpe, Debe Colocar la el grupo de Usuario', function () {
                $('#name').parent('div').addClass('has-error');
            });
        }else if (($('#codigo_seg').val().length  < 8)) {
            bootbox.alert('Disculpe, la cantidad de digitos no es valida', function () {
                $('#codigo_seg').parent('div').addClass('has-error');
            });
        } else {

            $.post('<?php echo base_url(); ?>index.php/configuracion/grupos_usuarios/ControllersGrupoUsuarios/actualizar', $('#form_grupos').serialize(), function (response) {
				if (response[0] == '1') {
                    bootbox.alert("Disculpe, código de seguridad invalido", function () {
                    }).on('hidden.bs.modal', function (event) {
                        $("#codigo").parent('div').addClass('has-error')
                        $("#codigo").focus();
                    });
                }else if (response[0] == '2') {
                    bootbox.alert("Disculpe, Este Grupo de usuario ya se encuentra registrado", function () {
                    }).on('hidden.bs.modal', function (event) {
                        $("#name").parent('div').addClass('has-error')
                        //$('#abreviatura').val('')
                        $("#name").focus();

                    });
                } else {
                    bootbox.alert("Se Actualizo con exito", function () {
                    }).on('hidden.bs.modal', function (event) {
                        url = '<?php echo base_url(); ?>index.php/configuracion/grupos_usuarios/ControllersGrupoUsuarios'
                        window.location = url
                    });
                }

            });
        }
    });


</script>
