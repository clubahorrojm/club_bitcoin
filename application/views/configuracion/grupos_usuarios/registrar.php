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
                <li class="active">Grupos de Usuarios</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-xs-12">

                    <!-- SELECT2 EXAMPLE -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title" style="color:#3C8DBC">Registro de Grupo de Usuario</h3>
                            <div class="box-tools pull-right">

                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <form id="form_grupos">
								<div class="col-md-1">
                                    <div class="form-group">
                                        <label style="font-weight:bold">Código</label>
                                        <input type="text" autofocus="" placeholder="Ej: 8" maxlength="2" id="codigo" value="<?php echo $ultimo_id +1; ?>" readonly="true" name="codigo"  class="form-control">
                                    </div><!-- /.form-group -->
                                </div><!-- /.form-group -->
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label style="font-weight:bold">Grupo de Usuario</label>
                                        <input type="text" placeholder="Introdúzca el Grupo de Usuario" maxlength="80" id="name" name="name" style="text-transform:uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase();" class="form-control">
                                    </div><!-- /.form-group -->
                                </div><!-- /.form-group -->                           
                                <div class="form-group">
                                    <div class="col-md-12">
										<input class="form-control"  type='hidden' placeholder="user" id="user_create" name="user_create" value="<?php echo"$id_user" ?>"/>
                                        <input class="form-control"  type='hidden' id="id" name="id" value="<?php echo $ultimo_id +1 ?>"/>
										<input type="hidden" id="activo" name="activo" value="t" class="form-control">
                                        <button type="button" id="volver" style="font-weight: bold;font-size: 13px" class="btn btn-danger " >
                                            &nbsp;<span class="glyphicon glyphicon-chevron-left"></span>&nbsp;Volver
                                        </button>
                                        <button type="reset" id="limpiar" style="font-weight: bold;font-size: 13px; color: white " class="btn btn-info"/>
                                        &nbsp;<span class="glyphicon glyphicon-retweet"></span>&nbsp;&nbsp;Limpiar
                                        </button>
                                        <button type="submit" id="registrar" style="font-weight: bold;font-size: 13px" class="btn btn-success"/>
                                        &nbsp;<span class="glyphicon glyphicon-floppy-disk"></span>&nbsp;Registrar
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
            <b>Version</b> 1.0
        </div>
        <strong>Network C. A.</strong> 
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
        url = '<?php echo base_url() ?>index.php/configuracion/grupos_usuarios/ControllersGrupoUsuarios/'
        window.location = url
    })


    $("#registrar").click(function (e) {
        e.preventDefault();  // Para evitar que se envíe por defecto

        if (($('#name').val().trim() == '')) {
            bootbox.alert('Disculpe, Debe indicar el grupo de usuario', function () {
                $('#name').parent('div').addClass('has-error');
            });
        } else {

            $.post('<?php echo base_url(); ?>index.php/configuracion/grupos_usuarios/ControllersGrupoUsuarios/guardar', $('#form_grupos').serialize(), function (response) {
                if (response[0] == '1') {
                    bootbox.alert("Disculpe, Este Grupo de Usuario ya se encuentra registrado", function () {
                    }).on('hidden.bs.modal', function (event) {
                        $("#prioridad").parent('div').addClass('has-error')
                        //$('#abreviatura').val('')
                        $("#prioridad").focus();

                    });
                } else {
                    bootbox.alert("Se registro con exito", function () {
                    }).on('hidden.bs.modal', function (event) {
                        url = '<?php echo base_url(); ?>index.php/configuracion/grupos_usuarios/ControllersGrupoUsuarios'
                        window.location = url
                    });
                }
            });
        }
    });





</script>
