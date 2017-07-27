<?php
if (isset($this->session->userdata['logged_in'])) {
    $username = ($this->session->userdata['logged_in']['username']);
    $email = ($this->session->userdata['logged_in']['email']);
    $tipouser = 'Administrador';
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
<div class="bg-red ui-draggable ui-draggable-handle text-center" style="position: relative; font-weight: bold; ">
    Datos personales del Usuario
</div>

<div class="wrapper">

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height: 1156px;">
        <br/>
        <br/>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 style="color:#3C8DBC">
                Información Personal
            </h1>
            <ol class="breadcrumb" >
                <li><a href="<?php echo base_url(); ?>index.php"  style="color:#3C8DBC"><i class="fa fa-home"></i > Inicio</a></li>
                <li class="active"  >Información Personal</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-xs-12">

                    <!-- SELECT2 EXAMPLE -->
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="text-left">
                                <legend><H4  style="color:#3C8DBC">Datos Personales</H4></legend>
                            </div>

                                <?php if ($editar[0]->estatus == 1) {?>
                                <div class="text-center">
                                    <span  style="font-weight: bold; color:red">**Disculpe, debe registrar su pago primero y ser verificado por un operador antes de proseguir con el llenado de su perfil**</span>
                                </div>
                                <br>
                                <?php } ?>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label style="font-weight:bold">Cédula</label>
                                        <input type="text" placeholder="Cédula del usuario" value="<?php echo $usuario[0]->cedula ?>" maxlength="8" id="cedula" class="form-control"  >
                                    </div><!-- /.form-group -->
                                </div><!-- /.form-group -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label style="font-weight:bold">Nombre</label>
                                        <input type="text" placeholder="Nombre del usuario" value="<?php echo $usuario[0]->first_name ?>" maxlength="50" id="nombre" class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                    </div><!-- /.form-group -->
                                </div><!-- /.form-group -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label style="font-weight:bold">Apellido</label>
                                        <input type="text" placeholder="Apellido del usuario" value="<?php echo $usuario[0]->last_name ?>" maxlength="50" id="apellido" class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" >
                                    </div><!-- /.form-group -->
                                </div><!-- /.form-group -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label style="font-weight:bold">Correo</label>
                                        <input type="text" placeholder="Correo electrónico del usuario" value="<?php echo $usuario[0]->email ?>" maxlength="50" id="correo" class="form-control" >
                                    </div><!-- /.form-group -->
                                </div><!-- /.form-group -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label style="font-weight:bold">Telefono</label>
                                        <input type="text" class="form-control" placeholder="(0243) 999-9999" value="<?php echo $usuario[0]->telefono ?>" id="telefono" data-inputmask='"mask": "(9999) 999-9999"' data-mask>
                                    </div><!-- /.form-group -->
                                </div><!-- /.form-group -->
                                
                                <div class="text-left">
                                    <legend><H4  style=" color:#3C8DBC">Datos de Monedero</H4></legend>
                                </div>

                                <div class="col-md-10">
									<div class="form-group">
										<label style="font-weight:bold">Dir. Monedero Personal</label>
										<input type="text" class="form-control" placeholder="Ej: AxYz125cdJklmn14PqRs87Vwxy54Q7YcV4" value="<?php echo $editar[0]->dir_monedero ?>" maxlength="34" id="dir_monedero_per2" >
									</div><!-- /.form-group -->
								</div><!-- /.form-group -->
                                
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <br>
                                        <button type="button" id="agregar4" style="font-weight: bold;font-size: 13px" class="btn btn-info " >
                                            &nbsp;<span class="glyphicon glyphicon-floppy-disk"></span>&nbsp;Actualizar
                                        </button>
                                        <input id="cod_perfil"  type='hidden' value="<?php echo $cod_perfil ?>" class="form-control" >
                                        <input id="estatus_perfil"  type='hidden' value="<?php echo $estatus_perfil ?>" class="form-control" >
                                        <input id="tipo_cuenta_id_id" type='hidden' value="<?php echo $editar[0]->tipo_cuenta_id ?>" class="form-control" >
                                        <input id="banco_usu_id_id" type='hidden' value="<?php echo $editar[0]->banco_usu_id ?>" class="form-control" >
                                        <input class="form-control"  type='hidden' id="usuario_id" name="usuario_id" value="<?php echo $usuario[0]->codigo ?>"/>
                                    </div><!-- /.form-group -->
                                </div><!-- /.form-group -->

                        </div><!-- /.box-body -->
                    </div><!-- /.box-body-primary -->
                    </div><!-- /.box-body -->
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
     
    $('#fecha_pago').numeric({allow: "/"});
    $('#num_pago').numeric();
    $('#num_cuenta_usu').numeric();
    $('#monto').numeric({allow: "."});
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
    $('#fecha_pago').datepicker({
        format: "dd/mm/yyyy",
        language: "es",
        autoclose: true,
    })
    var tipo = $("#tipo_cuenta_id_id").val()
    var cuenta = $("#banco_usu_id_id").val()
    $("#tipo_cuenta_id").val(tipo);
    $("#banco_usu_id").val(cuenta);
    if ($("#estatus_perfil").val() == '1'){
        $("#cedula,#nombre,#apellido,#correo,#tipo_cuenta_id,#num_cuenta_usu,#banco_usu_id,#telefono,#agregar4").attr('disabled',true)
    }else{
        $("#cedula,#nombre,#apellido,#correo,#tipo_cuenta_id,#num_cuenta_usu,#banco_usu_id,#telefono,#agregar4").attr('disabled',false)
    }

    
    $('#agregar4').click(function(e){
        e.preventDefault();
        //Para validar campos vacios
        if ($("#cedula").val() == '') {
            bootbox.alert("Debe colocar su cedula", function () {
            }).on('hidden.bs.modal', function (event) {
                    $("#cedula").parent('div').addClass('has-error')
                    $("#cedula").focus();
            });
        }else if ($("#nombre").val() == '') {
            bootbox.alert("Debe colocar su nombre", function () {
            }).on('hidden.bs.modal', function (event) {
                    $("#nombre").parent('div').addClass('has-error')
                    $("#nombre").focus();
            });
        }else if ($("#apellido").val() == '') {
            bootbox.alert("Debe colocar su apellido", function () {
            }).on('hidden.bs.modal', function (event) {
                $("#apellido").parent('div').addClass('has-error')
                $("#apellido").focus();
            });
        }else if ($("#correo").val() == '') {
            bootbox.alert("Debe colocar su correo electrónico", function () {
            }).on('hidden.bs.modal', function (event) {
                    $("#correo").parent('div').addClass('has-error')
                    $("#correo").focus();
            });
        }else if ($("#telefono").val() == '') {
            bootbox.alert("Debe colocar su telefono", function () {
            }).on('hidden.bs.modal', function (event) {
                    $("#telefono").parent('div').addClass('has-error')
                    $("#telefono").focus();
            });
        }/*else if ($("#tipo_cuenta_id").val() == 0 || $("#tipo_cuenta_id").val() == null) {
            bootbox.alert("Debe seleccionar el tipo de su cuenta bancaria", function () {
            }).on('hidden.bs.modal', function (event) {
                    $("#tipo_cuenta_id").parent('div').addClass('has-error')
                    $("#tipo_cuenta_id").focus();
            });
        }else if ($("#num_cuenta_usu").val() == '' || $("#num_cuenta_usu").val() == 0) {
            bootbox.alert("Debe colocar su nùmero de cuenta bancaria", function () {
            }).on('hidden.bs.modal', function (event) {
                    $("#num_cuenta_usu").parent('div').addClass('has-error')
                    $("#num_cuenta_usu").focus();
                    $("#num_cuenta_usu").val('');
            });
        }else if ($("#banco_usu_id").val() == 0 || $("#banco_usu_id").val() == null) {
            bootbox.alert("Debe colocar su banco", function () {
            }).on('hidden.bs.modal', function (event) {
                    $("#banco_usu_id").parent('div').addClass('has-error')
                    $("#banco_usu_id").focus();
            });
        }*/else if ($("#dir_monedero_per2").val() == '' || $("#dir_monedero_per2").val() == 0) {
            bootbox.alert("Debe colocar su dirección de monedero personal", function () {
            }).on('hidden.bs.modal', function (event) {
                    $("#dir_monedero_per2").parent('div').addClass('has-error')
                    $("#dir_monedero_per2").focus();
                    $("#dir_monedero_per2").val('');
            });
        }else if ($("#dir_monedero_per2").val().trim().length < 34) {
            bootbox.alert("La longitud de la dirección no puede ser menor a 34 dígitos", function () {
            }).on('hidden.bs.modal', function (event) {
                    $("#dir_monedero_per2").parent('div').addClass('has-error')
                    $("#dir_monedero_per2").focus();
            });
        }else{
            cedula = $('#cedula').val()
            nombre = $('#nombre').val()
            apellido = $('#apellido').val()
            correo = $('#correo').val()
            telefono = $('#telefono').val()
            //~ tipo_cuenta_id = $('#tipo_cuenta_id').val()
            usuario_id = $('#usuario_id').val()
            //~ num_cuenta_usu = $('#num_cuenta_usu').val()
            //~ banco_usu_id = $('#banco_usu_id').val()
            dir_monedero_per = $('#dir_monedero_per2').val()
            pk_perfil = $('#cod_perfil').val()
            $.post('<?php echo base_url(); ?>index.php/referidos/CRelInformacion/actualizar',
                   $.param({'cedula': cedula})+'&'+$.param({'nombre': nombre})+'&'+$.param({'apellido': apellido})+'&'+
                   $.param({'pk_perfil': pk_perfil})+'&'+$.param({'correo': correo})+'&'+$.param({'telefono': telefono})+'&'+
                   $.param({'usuario_id': usuario_id})+'&'+$.param({'dir_monedero_per': dir_monedero_per}), 
                   function (response){
                    if (response[0] == 1) {
                        bootbox.alert("Disculpe, este num_pago ya fue registrado con este recibo", function () {
                        }).on('hidden.bs.modal', function (event) {
                            $("#num_pago,#tipo_pago").parent('div').addClass('has-error')
                            $("#num_pago,#tipo_pago").focus();
                        });
                    } else {
                        bootbox.alert("Se actualizó su información personal con Exito ", function (){
                            window.location = '<?php echo base_url(); ?>index.php/referidos/CRelInformacion/'
                        });
                    }
                
            });
    }
    })

</script>
