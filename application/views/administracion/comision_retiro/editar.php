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
if ($tipouser == 'Administrador' || $tipouser == 'OPERADOR') {
    
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
                Comision por Retiro
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>index.php"  style="color:#3C8DBC"><i class="fa fa-home"></i> Inicio</a></li>
                <li style="color:#3C8DBC">Configuraciones</li>
                <li class="active">Comision por Retiro</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-xs-12">

                    <!-- SELECT2 EXAMPLE -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title" style="color:#3C8DBC">Actualizar Comisión por Retiro</h3>
                            <div class="box-tools pull-right">

                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <form id="form_comision">
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label style="font-weight:bold">Código</label>
                                        <input type="text" autofocus="" placeholder="Ej: 8" maxlength="2" id="codigo" value="<?php echo $editar->codigo ?>" readonly="true" name="codigo"  class="form-control">
                                    </div><!-- /.form-group -->
                                </div><!-- /.form-group -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label style="font-weight:bold">Porcentaje</label>
                                        <div class="input-group" style="width: 50%">
                                            <input style="text-align: right;" type="text" placeholder="10.5" maxlength="4" id="porcentaje_comision" name="porcentaje_comision" value="<?php echo $editar->porcentaje_comision; ?>" class="form-control">
                                            <span class="input-group-addon">%</span>
                                        </div>
                                        
                                    </div><!-- /.form-group -->
                                </div><!-- /.form-group -->
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <label class="control-label" >Clave de Seguridad</label>
                                        <input type="password" placeholder="********" maxlength="8" id="clave"  name="clave"  class="form-control" >
                                    </div> 
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12" style="text-align: center">
                                        <input class="form-control"  type='hidden' id="id" name="id" value="<?php echo $editar->id ?>"/>
                                        <a class="btn btn-app " data-toggle="tab" id="volver">
                                            <i class="glyphicon glyphicon-chevron-left text-orange"></i>Volver
                                        </a>
                                        <a class="btn btn-app " type="reset" id="limpiar" data-toggle="tab" >
                                            <i class="glyphicon glyphicon-retweet text-blue"></i>Limpiar
                                        </a>
                                        <a class="btn btn-app " type="submit" id="registrar" data-toggle="tab" >
                                            <i class="glyphicon glyphicon-floppy-disk text-green"></i>Actualizar
                                        </a>
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
    $('#codigo').numeric();
    $('#porcentaje_comision').numeric({allow: "."});
    $('input').on({
        keypress: function () {
            $(this).parent('div').removeClass('has-error');
        }
    });

    $('#volver').click(function () {
        url = '<?php echo base_url() ?>index.php/configuracion/CBancos/'
        window.location = url
    })


    $("#registrar").click(function (e) {
        e.preventDefault();  // Para evitar que se envíe por defecto
        if (($('#porcentaje_comision').val().trim() == '')) {
            bootbox.alert('Disculpe, debe colocar el porcentaje de comisión', function () {
                $('#porcentaje_comision').parent('div').addClass('has-error');
            });
        } else if (($('#porcentaje_comision').val().trim() > 10)) {
            bootbox.alert('Disculpe, el pocentaje de comision no puede ser mayor a 10', function () {
                $('#porcentaje_comision').parent('div').addClass('has-error');
            });
        }else if (($('#clave').val().trim() == '')) {
            bootbox.alert('Disculpe, debe introducir el código de seguridad', function () {
                $('#clave').parent('div').addClass('has-error');
            });
        }else if (($('#clave').val().length  < 8)) {
            bootbox.alert('Disculpe, la cantidad de digitos no es valida', function () {
                $('#clave').parent('div').addClass('has-error');
            });
        }else {
            $.post('<?php echo base_url(); ?>index.php/administracion/CComisionRetiro/actualizar', $('#form_comision').serialize(), function (response) {
                if (response[0] == '1') {
                    bootbox.alert("Disculpe, código de seguridad invalido", function () {
                    }).on('hidden.bs.modal', function (event) {
                        $("#clave").parent('div').addClass('has-error')
                        $("#clave").focus();
                    });
                }else {
                    bootbox.alert("Se actualizó con exito", function () {
                    }).on('hidden.bs.modal', function (event) {
                        url = '<?php echo base_url(); ?>index.php/administracion/CComisionRetiro'
                        window.location = url
                    });
                }

            });
        }
    });



</script>
