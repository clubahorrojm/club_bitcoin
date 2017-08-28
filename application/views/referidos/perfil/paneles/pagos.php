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
<!--<script type="text/javascript" src="jquery.qrcode.min.js"></script>-->
<div class="wrapper">

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height: 1156px;">
        <br/>
        <br/>
        <br/>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1  style="color:#3C8DBC">
                Registrar Pago
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>index.php" style="color:#3C8DBC"><i class="fa fa-home"></i> Inicio</a></li>
                <li class="active">Registrar Pago</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header with-border col-md-12">
                                <h3 class="box-title" style="color:#3C8DBC">Información del pago</h3>
                            </div><!-- /.box-header -->
                            <div class="panel-body">
                                <div class="col-md-4">
									<div class="form-group">
										<label style="font-weight:bold">Dir. Monedero (desde la que realizó el pago)</label><br>
										<input type="text" placeholder="Ej: AxYz125cdJklmn14PqRs87Vwxy54Q7YcV4" maxlength="34" id="dir_monedero" value="<?php echo $pago[0]->dir_monedero ?>" class="form-control" readonly="true">
									</div>
								</div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label style="font-weight:bold">Fecha</label>
                                        <input type="text" placeholder="Ej: 01/10/2016" maxlength="10" id="fecha_pago"
                                            value="<?php if ($pago[0]->fecha_pago != ''){
                                                $fe = explode('-',$pago[0]->fecha_pago);
                                                $fecha = $fe[2].'/'.$fe[1].'/'.$fe[0];
                                                echo $fecha;
                                                }
                                            ?>" class="form-control" >
                                    </div><!-- /.form-group -->
                                </div><!-- /.form-group -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label style="font-weight:bold">Monto</label>
                                        <input type="text" placeholder="Ej: 50" maxlength="10" id="monto" disabled="disabled"  value="<?php echo $pago[0]->monto ?>" class="form-control" >
                                    </div><!-- /.form-group -->
                                </div><!-- /.form-group -->
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label style="font-weight:bold">Estatus</label><br>
                                        <?php if ($pago[0]->estatus == 1) {?>
                                            <label style="font-weight:bold; color: blue">En verificación</label>
                                        <?php }else if ($pago[0]->estatus == 2){ ?>
                                            <label style="font-weight:bold; color: green">Aprobado</label>
                                        <?php } ?>
                                    </div><!-- /.form-group -->
                                </div><!-- /.form-group -->
                                <?php if ($pago[0]->estatus == 2){ ?>
                                <div class="col-md-2">
                                    <div class="form-group text-left">
                                        <a class="btn btn-app ver" data-toggle="tab" id="recibo_pago" >
                                            <i class="fa fa-file-pdf-o text-red "></i>
                                            Recibo de Pago
                                        </a>
                                    </div><!-- /.form-group -->
                                </div><!-- /.form-group -->
                                <?php } ?>
                                <div class="col-md-12">
                                    <div class="form-group text-center">
                                        <input id="cod_perfil"  type='hidden' value="<?php echo $cod_perfil ?>" class="form-control" >
                                        <input id="cod_pago"  type='hidden' value="<?php echo $pago[0]->codigo ?>" class="form-control" >
                                        <input id="estatus"  type='hidden' value="<?php echo $pago[0]->estatus ?>" class="form-control" >
                                        <!--<input id="tipo_pago_id" type='hidden' value="<?php echo $pago[0]->tipo_pago ?>" class="form-control" >
                                        <input id="cuenta_id_id" type='hidden' value="<?php echo $pago[0]->cuenta_id ?>" class="form-control" >-->
                                    </div><!-- /.form-group -->
                                </div><!-- /.form-group -->
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

    //~ jQuery('#qrcodeTable').qrcode({
        //~ render  : "table",
        //~ text    : "1Az9K6WJrFXkjopNtsdLWKzCsehiAoNsux"
    //~ }); 
     
    $('#fecha_pago').numeric({allow: "/"});
    $('#num_pago').numeric();
    $('#monto').numeric({allow: "."});
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
    var tipo = $("#tipo_pago_id").val()
    var cuenta = $("#cuenta_id_id").val()
    $("#tipo_pago").val(tipo);
    $("#cuenta_id").val(cuenta);
    if ($("#estatus").val() == 99 || $("#estatus").val() == 1)  {
        $("#cuenta_id,#tipo_pago,#num_pago,#fecha_pago,#registrar_p").prop('disabled',false)
    }else{
        $("#cuenta_id,#tipo_pago,#num_pago,#fecha_pago,#registrar_p").prop('disabled',true)
    }
    
    $('#registrar_p').click(function(e){
        e.preventDefault();
        //Para validar campos vacios
        if ($("#cuenta_id").val() == 0 || $("#cuenta_id").val() == null) {
            bootbox.alert("Debe selecionar la cuenta a la cual realizo el pago", function () {
            }).on('hidden.bs.modal', function (event) {
                    $("#cuenta_id").parent('div').addClass('has-error')
                    $("#cuenta_id").focus();
            });
        }else if ($("#tipo_pago").val() == 0 || $("#tipo_pago").val() == null) {
            bootbox.alert("Debe selecionar el tipo de pago", function () {
            }).on('hidden.bs.modal', function (event) {
                    $("#tipo_pago").parent('div').addClass('has-error')
                    $("#tipo_pago").focus();
            });
        }else if ($("#num_pago").val() == '') {
            bootbox.alert("Debe colocar el número de pago", function () {
            }).on('hidden.bs.modal', function (event) {
                $("#num_pago").parent('div').addClass('has-error')
                $("#num_pago").focus();
            });
        }else if ($("#fecha_pago").val() == '') {
            bootbox.alert("Debe indicar la fecha de pago", function () {
            }).on('hidden.bs.modal', function (event) {
                    $("#fecha_pago").parent('div').addClass('has-error')
                    $("#fecha_pago").focus();
            });
        }else if ($("#monto").val() == 0) {
            bootbox.alert("Debe indicar el monto", function () {
            }).on('hidden.bs.modal', function (event) {
                    $("#monto").parent('div').addClass('has-error')
                    $("#monto").focus();
            });
        }else{
            cuenta_id = $('#cuenta_id').val()
            num_pago = $('#num_pago').val()
            tipo_pago = $('#tipo_pago').val()
            fecha_pago = $('#fecha_pago').val()
            $('#monto').prop('disabled',false);
            monto = $('#monto').val()
            pk_perfil = $('#cod_perfil').val()
            cod_pago = $('#cod_pago').val()
            $.post('<?php echo base_url(); ?>index.php/referidos/CRelPagos/actualizar',
                   $.param({'pk_perfil': pk_perfil})+'&'+$.param({'num_pago': num_pago})+'&'+$.param({'monto': monto})+'&'+$.param({'tipo_pago': tipo_pago})+'&'+
                   $.param({'fecha_pago': fecha_pago})+'&'+$.param({'cuenta_id': cuenta_id})+'&'+$.param({'cod_pago': cod_pago}), 
                   function (response){
                    if (response[0] == 1) {
                        bootbox.alert("Disculpe, este num_pago ya fue registrado con este recibo", function () {
                        }).on('hidden.bs.modal', function (event) {
                            $("#num_pago,#tipo_pago").parent('div').addClass('has-error')
                            $("#num_pago,#tipo_pago").focus();
                        });
                    } else {
                        bootbox.alert("Su Registro fue Exitoso ", function (){
                            window.location = '<?php echo base_url(); ?>index.php/referidos/CRelPagos/'
                        });
                    }
                
            });
	}
    })

    $("#recibo_pago").click(function (e) {
        e.preventDefault();  // Para evitar que se envíe por defecto
        // pk_perfil = $('#id').val()
        // alert(pk_perfil)
        URL = '<?php echo base_url(); ?>index.php/referidos/CRelPagos/pdf_recibo_pago/';
            $.fancybox.open({ padding : 0, href: URL, type: 'iframe',width: 1024, height: 520});
    });
    //~ $("#qrcode").qrcode({
         //~ 'render': 'canvas',
         //~ 'size': 250,
         //~ 'fill': '#1D82AF',
         //~ 'radius': 0.5,
         //~ 'background': '#ffffff',
         //~ 'text': 'http://www.finanser.es'
    //~ });

</script>
