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
                Empresa
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>index.php" style="color:#3C8DBC"><i class="fa fa-home"></i> Inicio</a></li>
                <li>Administrador</li>
                <li class="active">Empresa</li>
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
                                <legend><H4  style="color:#3C8DBC">Administrar Empresa</H4></legend>
                            </div>
                            <div class="box-tools pull-right">

                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <form id="form_empresa">
                                <div class="col-md-12">
									
<!--
                                    <div class="col-md-3">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Imagen</label>
                                                <input id="logo" name="logo" type="file" multiple class="file-loading" >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="help-block file-error-message" id="errorBlock" style="display: none;"></div>
                                            </div>
                                        </div>
                                    </div>
-->
                                    
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label style="font-weight:bold">Código</label>
                                                <input type="text" autofocus="" placeholder="Ej: 8" maxlength="2" id="codigo" name="codigo" value="1" disabled="disabled"  class="form-control">
                                            </div><!-- /.form-group -->
                                        </div><!-- /.form-group -->
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <label style="font-weight:bold">Empresa</label>
                                                <input type="text" placeholder="Nombre de la empresa" maxlength="150" id="nombre_empresa" value="<?php echo $editar->nombre_empresa ?>" name="nombre_empresa"  class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                            </div><!-- /.form-group -->
                                        </div><!-- /.form-group -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label style="font-weight:bold">Rif</label>
                                                <input type="text" placeholder="Ej: J-19222111-6" maxlength="15" id="rif" name="rif"  class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                            </div><!-- /.form-group -->
                                        </div><!-- /.form-group -->
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label style="font-weight:bold">Dirección </label>
                                                <input type="text" placeholder="Indique la dirección de la empresa"  value="<?php echo $editar->direccion ?>" maxlength="40" id="direccion" name="direccion" class="form-control">
                                            </div><!-- /.form-group -->
                                        </div><!-- /.form-group -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label style="font-weight:bold">Correo</label>
                                                <input type="text" placeholder="Ej: propietario@mail.com"  value="<?php echo $editar->correo ?>" maxlength="40" id="correo" name="correo" class="form-control">
                                            </div><!-- /.form-group -->
                                        </div><!-- /.form-group -->

                                        <h3 class="box-title">Responsable de Empresa</h3>
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <label style="font-weight:bold">Cédula</label>
                                                <input type="text" placeholder="Ej: 12123456" maxlength="8" id="cedula" value="<?php echo $editar->cedula ?>" name="cedula" style='width:100%;' class="form-control">
                                            </div><!-- /.form-group -->
                                        </div><!-- /.form-group -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label style="font-weight:bold">Nombre</label>
                                                <input type="text" class="form-control" id="nombre" value="<?php echo $editar->nombre ?>" placeholder="Nombre del representante" name="nombre" maxlength="25" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" >
                                            </div><!-- /.form-group -->
                                        </div><!-- /.form-group -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label style="font-weight:bold">Apellido</label>
                                                <input type="text" placeholder="Apellido del representante" maxlength="25" id="apellido" value="<?php echo $editar->apellido ?>" name="apellido" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control">
                                            </div><!-- /.form-group -->
                                        </div><!-- /.form-group -->
                                        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label style="font-weight:bold">Teléfono 1</label>
                                                <input type="text" class="form-control" id="telefono1" value="<?php echo $editar->telefono1 ?>" placeholder="Teléfono principal" name="telefono1" data-inputmask='"mask": "(9999) 999-9999"' data-mask>
                                            </div><!-- /.form-group -->
                                        </div><!-- /.form-group -->
                                        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label style="font-weight:bold">Teléfono 2</label>
                                                <input type="text" class="form-control" id="telefono2" value="<?php echo $editar->telefono2 ?>" placeholder="Teléfono secundario" name="telefono2" data-inputmask='"mask": "(9999) 999-9999"' data-mask>
                                            </div><!-- /.form-group -->
                                        </div><!-- /.form-group -->
                                     </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12" style="text-align: center ">
                                        
                                        <input class="form-control"  type='hidden' id="id" name="id" value="1"/>
                                        <input class="form-control"  type='hidden' id="img_id" name="img_id"  value="<?php echo $editar->logo ?>"/>
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
    $(".select2").select2();
    $('#codigo,#cedula').numeric();
    $('#direccion').alphanumeric({allow: ", .#"});
    $('#correo').alphanumeric({allow: "_-.@"});
    $('#nombre,#apellido').alpha({allow: " "})
    $('#rif').alphanumeric({allow: "-"}); //Solo permite texto
    $("[data-mask]").inputmask();

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
    ////////////////// CONSULTA DE CEDULA A BASE DE DATOS ////////////////////
    $("#cedula").change(function (event) {
        var cedula = $('#cedula').val();
        var hosting = "consultaelectoral.bva.org.ve/cedula="
        if (hosting) {
            $.get("http://" + hosting + cedula, function (data) {
                var option = "";
                $.each(data, function (i) {
                    $("#nombre").val(data[i].p_nombre + " " + data[i].s_nombre)
                    $("#apellido").val(data[i].p_apellido + " " + data[i].s_apellido)
                });
                // Proceso para validar con la clase error 404 Not Found
            }, 'json');
        }
    });
    if ($("#img_id").val() == ''){
        imagen = '<img src="<?= base_url() ?>static/img/usuario.jpg" class="file-preview-image" >'
    }else{
        imagen = '<img id="logo" name="logo" src="<?php echo base_url(); ?>foto/<?php echo $editar->logo ?>" class="img-responsive"  width="170" height="90" >'
    }
    $("#logo").fileinput({
        initialPreview: [imagen],
        browseClass: "btn btn-primary btn-block",
        browseLabel: "Buscar Imagen",
        showCaption: false,
        showRemove: false,
        maxFileSize: 1000,
        showUpload: false,
        allowedFileExtensions: ["jpg", "png"],
        elErrorContainer: "#errorBlock",
        msgSizeTooLarge: 'Archivo muy pesado "{name}". (<b>{size} KB</b>) excede el tamaño máximo que es de <b>{maxSize} KB',
        msgInvalidFileExtension: 'Extensiones invalidad "{name}". Solo admite archivos"{extensions}".'
    });


    $("#registrar").click(function (e) {
        e.preventDefault();  // Para evitar que se envíe por defecto
        if (($('#nombre_empresa').val().trim() == '')) {
            bootbox.alert('Disculpe, Debe Colocar l o rif de la empresa', function () {
                $('#nombre_empresa').parent('div').addClass('has-error');
            });
        }else if (($('#telefono1').val().trim() == '')) {
            bootbox.alert('Disculpe, Debe Colocar el teléfono de la empresa', function () {
                $('#telefono1').parent('div').addClass('has-error');
            });
        }else if (($('#cedula').val().trim() == '')) {
            bootbox.alert('Disculpe, Debe Colocar la cédula o rif de la empresa', function () {
                $('#apto').parent('div').addClass('has-error');
            });
        }else if (($('#nombre').val().trim() == 0)) {
            bootbox.alert('Disculpe, Debe Colocar el nombre del representante de la empresa', function () {
                $('#nombre').parent('div').addClass('has-error');
            });
        }else if (($('#apellido').val().trim() == 0)) {
            bootbox.alert('Disculpe, Debe Colocar el apellido del representante de la empresa', function () {
                $('#apellido').parent('div').addClass('has-error');
            });
        }else {
            $('#codigo').prop('disabled',false);
            var formData = new FormData(document.getElementById("form_empresa"));
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/administracion/CEmpresa/actualizar/',
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            }).done(function(res){				
                var respuesta = res.split('<!DOCTYPE html>');
                rep = respuesta[0].trim()
                //alert(rep)
                if (rep == 'fallo') {
                    bootbox.alert("Error al cargar archivos", function () {
                    }).on('hidden.bs.modal', function (event) {
                        
                    });
                }else if(rep == 'registrado'){
                    // Si dentro de la cadena de respuesta viene la palabra 'num_insert4', es porque no hubo error al cargar la data
                    bootbox.alert("Se registró exitosamente", function () {
                    }).on('hidden.bs.modal', function (event) {
                        url = '<?php echo base_url(); ?>index.php/administracion/CEmpresa/'
                        window.location = url
                    });
                }
            });
        }
    });


</script>
