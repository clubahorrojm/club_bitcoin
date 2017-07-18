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
            <h1 style="color:#3C8DBC" >
                Tipos de Monedas
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>index.php"  style="color:#3C8DBC"><i class="fa fa-home"></i> Inicio</a></li>
                <li style="color:#3C8DBC">Configuraciones</li>
                <li style="color:#3C8DBC">Tipos de Monedas</li>
                <li class="active">Editar Tipo de Moneda</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-xs-12">

                    <!-- SELECT2 EXAMPLE -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title" style="color:#3C8DBC">Editar Tipo de Moneda <strong></strong></h3>
                            <div class="box-tools pull-right">

                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <form id="form_bancos">
                                
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label style="font-weight:bold">Código</label>
                                        <input type="text" autofocus="" placeholder="Ej: 8" maxlength="2" id="codigo" disabled="disabled" value="<?php echo $editar[0]->codigo ?>" name="codigo"  class="form-control">
                                    </div><!-- /.form-group -->
                                </div><!-- /.form-group -->
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label style="font-weight:bold">Tipo Moneda</label>
                                        <input type="text" placeholder="Introduzca el nombre del banco" maxlength="50" id="descripcion" value="<?php echo $editar[0]->descripcion ?>" name="descripcion"  class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                    </div><!-- /.form-group -->
                                </div><!-- /.form-group -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label style="font-weight:bold">Símbolo</label>
                                        <input type="text" placeholder="Símbolo" maxlength="10" id="abreviatura" value="<?php echo $editar[0]->abreviatura ?>" name="abreviatura"  class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                    </div><!-- /.form-group -->
                                </div><!-- /.form-group -->
                                <div class="form-group">
                                    <div class="col-md-12" style="text-align: center">
                                        <input class="form-control"  type='hidden' placeholder="id" id="id" name="id" value="<?php echo $id ?>"/>
                                        <a class="btn btn-app " data-toggle="tab" id="volver">
                                            <i class="glyphicon glyphicon-chevron-left text-orange"></i>Volver
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
            <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
    </footer>


    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->


<script>

     $('#codigo').numeric();
    $('#descripcion').alphanumeric({allow: " "}); //Solo permite texto
    $('input').on({
        keypress: function () {
            $(this).parent('div').removeClass('has-error');
        }
    });

    $('#volver').click(function () {
        url = '<?php echo base_url() ?>index.php/configuracion/CTiposMonedas/'
        window.location = url
    })


    $("#registrar").click(function (e) {
        e.preventDefault();  // Para evitar que se envíe por defecto
        if (($('#descripcion').val().trim() == '')) {
            bootbox.alert('Disculpe, Debe Colocar la banco de la Tipo Moneda', function () {
                $('#descripcion').parent('div').addClass('has-error');
            });
        } else {
            $('#codigo').prop('disabled',false);
            $.post('<?php echo base_url(); ?>index.php/configuracion/CTiposMonedas/actualizar', $('#form_bancos').serialize(), function (response) {
                if (response[0] == '1') {
                    bootbox.alert("Disculpe, Esta código ya se encuentra registrado", function () {
                    }).on('hidden.bs.modal', function (event) {
                        $("#codigo").parent('div').addClass('has-error')
                        $("#codigo").focus();

                    });
                }else if (response[0] == '2') {
                    bootbox.alert("Disculpe, Esta banco ya se encuentra registrado", function () {
                    }).on('hidden.bs.modal', function (event) {
                        $("#descripcion").parent('div').addClass('has-error')
                        $("#descripcion").focus();
                    });
                }else {
                    bootbox.alert("Se registro con exito", function () {
                    }).on('hidden.bs.modal', function (event) {
                        url = '<?php echo base_url(); ?>index.php/configuracion/CTiposMonedas'
                        window.location = url
                    });
                }
                

            });
        }
    });


</script>
