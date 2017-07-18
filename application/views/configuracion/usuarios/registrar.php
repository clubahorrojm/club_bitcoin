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
        <br/><br/><br/>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 style="color:#3C8DBC" >
                Gestión de Usuarios
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>index.php"  style="color:#3C8DBC"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li><a href="<?php echo base_url(); ?>index.php"  style="color:#3C8DBC">Configuraciones</a></li>
                <li class="active">Gestión de Usuarios</li>
                <li class="active">Agregar Usuarios</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-xs-12">

                    <!-- SELECT2 EXAMPLE -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title" style="color:#3C8DBC">Registro de Agregar Usuario</h3>
                            <div class="box-tools pull-right">

                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body">



                            <form id="form_usuarios" method="post" accept-charset="utf-8" class="putImages" action="<?php echo base_url(); ?>index.php/configuracion/usuarios/usuarios/add" enctype='multipart/form-data'>
                                <div class="col-lg-2">

                                    <div class="form-group">
                                        <label class="control-label">Imagen</label>
                                        <input id="picture" name="picture" type="file" multiple class="file-loading" >
                                    </div> <!--/.form-group -->

                                </div>
                                <div class="col-lg-10">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label style="font-weight:bold">Código</label>
                                            <input type="text" id="codigo" name="codigo" readonly="true" value="<?php echo $ultimo_id + 1; ?>" class="form-control">
                                        </div> <!--/.form-group -->
                                    </div><!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label style="font-weight:bold">Usuario</label>
                                            <input type="text" placeholder="Introduzca su Usuario" id="username" name="username" class="form-control">
                                        </div> <!--/.form-group -->
                                    </div><!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputPassword" style="font-weight:bold">Contraseña</label>
                                            <input type="password" placeholder="Introduzca su Contraseña"  id="password"  name="password" class="form-control">
                                            <!--/.form-group -->

                                        </div>

                                    </div><!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label style="font-weight:bold">Cédula</label>
                                            <input type="text" placeholder="Introduzca su Cédula" style="text-transform:uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase();" id="cedula" name="cedula"  class="form-control" maxlength="8">
                                        </div>
                                    </div><!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label style="font-weight:bold">Nombre</label>
                                            <input type="text" placeholder="Introduzca su Nombre" style="text-transform:uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase();" id="first_name" maxlength="70" name="first_name" class="form-control">

                                        </div> <!--/.form-group -->
                                    </div><!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label style="font-weight:bold">Apellido</label>
                                            <input type="text" placeholder="Introduzca su Apellido" style="text-transform:uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase();" id="last_name" maxlength="70"  name="last_name" class="form-control">
                                        </div>
                                    </div><!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label style="font-weight:bold">Email</label>

                                            <input type="text" placeholder="Introduzca su Email" style="text-transform:uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase();" id="email" maxlength="75" name="email" class="form-control">
                                        </div> <!--/.form-group -->
                                    </div><!-- /.col -->
                                    <div class="col-md-6">
                                        <!--phone mask -->
                                        <div class="form-group">
                                            <label>Teléfono:</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-phone"></i>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Introduzca su Teléfono" id="telefono" style="text-transform:uppercase;" onkeyup="javascript:this.value = this.value.toUpperCase();" name="telefono" data-inputmask='"mask": "(9999) 999-9999"' data-mask>
                                            </div><!-- /.input group -->
                                        </div> <!--/.form group -->
                                    </div><!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label style="font-weight:bold">Tipo usuario</label>

                                            <select id="tipo_usuario" name="tipo_usuario" class="form-control select2" style="width: 100%;">

                                                <option selected="" value="0">Seleccione</option>
                                                <?php foreach ($list_grupos as $grupos) { ?>
                                                    <option value="<?php echo $grupos->id ?>"><?php echo $grupos->name ?></option>
                                                <?php } ?>
                                            </select>

                                        </div> <!--/.form-group -->
                                    </div><!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label style="font-weight:bold">&nbsp;Estátus</label>

                                            <select id='estatus' name="estatus"  class="form-control select2" style="width: 100%;">
                                                <option value='0'>Seleccione</option>
                                                <option value='TRUE'>Activo</option>
                                                <option value='FALSE'>Inactivo</option>
                                            </select>
                                        </div> <!--/.form-group -->
                                    </div><!-- /.col -->
                                </div><!-- /.col -->
								<div class="form-group">
                                    <div class="col-md-12" style="text-align: center">
                                        <input class="form-control"  type='hidden' placeholder="user" id="user_create_id" name="user_create_id" value="<?php echo"$id_user" ?>"/>
                                        <input class="form-control"  type='hidden' id="id" name="id" value="<?php echo $ultimo_id +1 ?>"/>
                                        <a class="btn btn-app " data-toggle="tab" id="volver">
                                            <i class="glyphicon glyphicon-chevron-left text-orange"></i>Volver
                                        </a>
                                        <a class="btn btn-app " type="reset" id="limpiar" data-toggle="tab" >
                                            <i class="glyphicon glyphicon-retweet text-blue"></i>Limpiar
                                        </a>
                                        <a class="btn btn-app " type="submit" id="registrar" data-toggle="tab" >
                                            <i class="glyphicon glyphicon-floppy-disk text-green"></i>Registrar
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
          <b>Version</b> 1.0.0
        </div>
         <!-- <img  style="text-align:center; margin-left: 10%;" src="<?= base_url() ?>/static/img/footer.png"/> -->
      </footer>


    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->


<script>

    $("#cedula").numeric(); //Valida solo permite valores numericos
    $('#email').alphanumeric({allow: "@-_."});


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
        url = '<?php echo base_url() ?>index.php/configuracion/usuarios/usuarios/'
        window.location = url
    })

    $("#cedula").change(function (event) {

        var cedula = $('#cedula').val();
        //var hosting = $('#id_hosting').val(); // Captura del hosting (dominio)
        var hosting = "consultaelectoral.bva.org.ve/cedula="
        if (hosting) {
            $.get("http://" + hosting + cedula, function (data) {
                var option = "";
                $.each(data, function (i) {
                    $("#first_name").val(data[i].p_nombre + " " + data[i].s_nombre)
                    $("#last_name").val(data[i].p_apellido + " " + data[i].s_apellido)
                });
                // Proceso para validar con la clase error 404 Not Found
            }, 'json');
        }
    });


    $("#picture").fileinput({
        initialPreview: [
            '<img src="<?= base_url() ?>static/img/usuario.jpg" class="file-preview-image" alt="Usuario" title="Usuario">',
        ],
        browseClass: "btn btn-primary btn-block",
        browseLabel: "Buscar Imagen",
        showCaption: false,
        showRemove: false,
        maxFileSize: 50,
        showUpload: false,
        allowedFileExtensions: ["jpg", "png"],
        elErrorContainer: "#errorBlock",
        msgSizeTooLarge: 'Archivo muy pesado "{name}". (<b>{size} KB</b>) excede el tamaño máximo que es de <b>{maxSize} KB',
        msgInvalidFileExtension: 'Extensiones invalidad "{name}". Solo admite archivos"{extensions}".'

    });

    $("#registrar").click(function (e) {
        e.preventDefault();  // Para evitar que se envíe por defecto

        if ($('#username').val().trim() == '') {

            bootbox.alert("Rellene el campo de usuario", function () {
            }).on('hidden.bs.modal', function (event) {
                $("#username").parent('div').addClass('has-error')
                $('#username').val('')
                $("#username").focus();
            });

        } else if ($('#password').val() == '') {

            bootbox.alert("El campo contraseña no puede estar en blanco", function () {
            }).on('hidden.bs.modal', function (event) {
                $("#password").parent('div').addClass('has-error')
                $('#password').val('')
                $("#password").focus();
            });

        } else if ($('#cedula').val().trim() == '' || $('#cedula').val().trim() == 0) {
            bootbox.alert("Rellene el campo de cédula", function () {
            }).on('hidden.bs.modal', function (event) {
                $("#cedula").parent('div').addClass('has-error')
                $('#cedula').val('')
                $("#cedula").focus();
            });


        } else if ($('#cedula').val().length < 6) {


            bootbox.alert("La cédula está incompleta", function () {
            }).on('hidden.bs.modal', function (event) {
                $("#cedula").parent('div').addClass('has-error')
                $('#cedula').val('')
                $("#cedula").focus();
            });

        } else if ($('#first_name').val().trim() == '') {

            bootbox.alert("Rellene el campo de nombres", function () {
            }).on('hidden.bs.modal', function (event) {
                $("#first_name").parent('div').addClass('has-error')
                $('#first_name').val('')
                $("#first_name").focus();
            });

        } else if ($('#last_name').val().trim() == '') {

            bootbox.alert("Rellene el campo de apellidos", function () {
            }).on('hidden.bs.modal', function (event) {
                $("#last_name").parent('div').addClass('has-error')
                $('#last_name').val('')
                $("#last_name").focus();
            });

        } else if ($('#email').val().trim() == '') {

            bootbox.alert("Rellene el campo de Email", function () {
            }).on('hidden.bs.modal', function (event) {
                $("#email").parent('div').addClass('has-error')
                $('#email').val('')
                $("#email").focus();
            });
        } else if ($('#telefono').val().trim() == '') {

            bootbox.alert("Rellene el campo de Email", function () {
            }).on('hidden.bs.modal', function (event) {
                $("#telefono").parent('div').addClass('has-error')
                $('#telefono').val('')
                $("#telefono").focus();
            });
        } else if ($('#tipo_usuario').val() == '0') {

            bootbox.alert("Introduzca el tipo de Usuario", function () {
            }).on('hidden.bs.modal', function (event) {
                $("#tipo_usuario").parent('div').addClass('has-error')
                $('#tipo_usuario').val('')
                $("#tipo_usuario").focus();
            });

        } else if ($('#estatus').val() == '0') {

            bootbox.alert("Introduzca el estatus del usuario", function () {
            }).on('hidden.bs.modal', function (event) {
                $("#estatus").parent('div').addClass('has-error')
                $('#estatus').val('')
                $("#estatus").focus();
            });



        } else {

            $('#form_usuarios').submit();
            bootbox.alert("Se registro con exito", function () {
            }).on('hidden.bs.modal', function (event) {
                url = '<?php echo base_url(); ?>index.php/configuracion/usuarios/usuarios'
                window.location = url
            });

//                                $.post('<?php echo base_url(); ?>index.php/configuracion/usuarios/usuarios/add', $('#form_usuarios').serialize(), function (response) {
//                        
//                                     
//                        
//                                    if (response[4] == '1') {
//                                        bootbox.alert("Disculpe, El Usuario ya se encuentra registrado", function () {
//                                        }).on('hidden.bs.modal', function (event) {
//                                            $("#valor").parent('div').addClass('has-error')
//                                            $('#valor').val('')
//                                            $("#valor").focus();
//                        
//                                        });
//                        
//                                    } else {
//                                        bootbox.alert("Se registro con exito", function () {
//                                        }).on('hidden.bs.modal', function (event) {
//                                            url = '<?php echo base_url(); ?>index.php/configuracion/usuarios/usuarios'
//                                            window.location = url
//                                        });
//                                    }
//                        
//                                });
        }



    });


</script>
