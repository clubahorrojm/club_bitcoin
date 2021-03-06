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
                Asignación de montos
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>index.php" style="color:#3C8DBC"><i class="fa fa-home"></i> Inicio</a></li>
                <li>Administrador</li>
                <li class="active">Asignación de montos</li>
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
                                <legend><H4 style="color:#3C8DBC">Asignación de montos de los referidos</H4></legend>
                            </div>
                            <div class="box-tools pull-right">

                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <form id="form_asig_montos">
                                <label class="control-label" >Nivel 1</label>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <input type="text" placeholder="Ej: 10" maxlength="5" id="porcentaje1" value="<?php echo $editar->porcentaje1 ?>" name="porcentaje1"  class="form-control" onkeyup="validaFloat(this.value), suma()"  >
                                        <span class="input-group-addon">%</span>
                                    </div> 
                                </div>
                                <br><br>
                                <label class="control-label" >Nivel 2</label>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <input type="text" placeholder="Ej: 10" maxlength="5" id="porcentaje2" value="<?php echo $editar->porcentaje2 ?>" name="porcentaje2"  class="form-control" onKeyUp="suma();">
                                        <span class="input-group-addon">%</span>
                                    </div> 
                                </div>
                                <br><br>
                                <label class="control-label" >Nivel 3</label>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <input type="text" placeholder="Ej: 10" maxlength="5" id="porcentaje3" value="<?php echo $editar->porcentaje3 ?>" name="porcentaje3"  class="form-control" onKeyUp="suma();">
                                        <span class="input-group-addon">%</span>
                                    </div> 
                                </div>
                                <br><br>
                                <label class="control-label" >Nivel 4</label>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <input type="text" placeholder="Ej: 10" maxlength="5" id="porcentaje4" value="<?php echo $editar->porcentaje4 ?>" name="porcentaje4"  class="form-control" onKeyUp="suma();">
                                        <span class="input-group-addon">%</span>
                                    </div> 
                                </div>
                                <br><br>
                                <label class="control-label" >Nivel 5</label>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <input type="text" placeholder="Ej: 10" maxlength="5" id="porcentaje5" value="<?php echo $editar->porcentaje5 ?>" name="porcentaje5"  class="form-control" onKeyUp="suma();">
                                        <span class="input-group-addon">%</span>
                                    </div> 
                                </div>
                                <br><br>
                                <label class="control-label" >Nivel 6</label>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <input type="text" placeholder="Ej: 10" maxlength="5" id="porcentaje6" value="<?php echo $editar->porcentaje6 ?>" name="porcentaje6"  class="form-control" onKeyUp="suma();">
                                        <span class="input-group-addon">%</span>
                                    </div> 
                                </div>
                                <br><br>
                                <label class="control-label" >Nivel 7</label>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <input type="text" placeholder="Ej: 10" maxlength="5" id="porcentaje7" value="<?php echo $editar->porcentaje7 ?>" name="porcentaje7"  class="form-control" onKeyUp="suma();">
                                        <span class="input-group-addon">%</span>
                                    </div> 
                                </div>
                                <br><br>
                                <label class="control-label" >Nivel 8 (Empresa)</label>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <input type="text" placeholder="Ej: 10" maxlength="5" id="porcentaje8" value="<?php echo $editar->porcentaje8 ?>" name="porcentaje8" readonly="readonly" class="form-control" >
                                        <span class="input-group-addon">%</span>
                                    </div> 
                                </div>
                                <br><br>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <label class="control-label" >Clave de Seguridad</label>
                                        <input type="password" placeholder="********" maxlength="8" id="codigo"  name="codigo"  class="form-control" >
                                    </div> 
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12" style="text-align: center ">
                                        <input class="form-control"  type='hidden' id="id" name="id" value="1"/>
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
        <strong>Network C. A.</strong> 
    </footer>


    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->


<script>
    $(".select2").select2();
    $('#porcentaje1,#porcentaje2,#porcentaje3,#porcentaje4,#porcentaje5,#porcentaje6,#porcentaje7,#porcentaje8').numeric({allow: ", ."});
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

    function validaFloat(numero) {

        if (!/^([0-9])*[.]?[0-9]*$/.test(numero))
            bootbox.alert('Disculpe, El valor '+ numero +' no es un número', function () {
                // $('#porcentaje1').parent('div').addClass('has-error');
            });
    }


    function suma(){
        
        var sum1 = document.getElementById("porcentaje1");
        var sum2 = document.getElementById("porcentaje2");
        var sum3 = document.getElementById("porcentaje3");
        var sum4 = document.getElementById("porcentaje4");
        var sum5 = document.getElementById("porcentaje5");
        var sum6 = document.getElementById("porcentaje6");
        var sum7 = document.getElementById("porcentaje7");
        var diferencia = document.getElementById("porcentaje8");
        // var div = document.getElementById("resultado");
        if ($("#porcentaje1").val() == ''){
            $('#porcentaje1').parent('div').addClass('has-error');
        }
        if ($("#porcentaje2").val() == ''){
            $('#porcentaje2').parent('div').addClass('has-error');
        }
        if ($("#porcentaje3").val() == ''){
            $('#porcentaje3').parent('div').addClass('has-error');
        }
        if ($("#porcentaje4").val() == ''){
            $('#porcentaje4').parent('div').addClass('has-error');
        }
        if ($("#porcentaje5").val() == ''){
            $('#porcentaje5').parent('div').addClass('has-error');
        }
        if ($("#porcentaje6").val() == ''){
            $('#porcentaje6').parent('div').addClass('has-error');
        }
        if ($("#porcentaje6").val() == ''){
            $('#porcentaje6').parent('div').addClass('has-error');
        }
        
        resultado = parseFloat(sum1.value) + parseFloat(sum2.value) + parseFloat(sum3.value) + parseFloat(sum4.value) + parseFloat(sum5.value) + parseFloat(sum6.value) + parseFloat(sum7.value);
        diferencia = 100 - resultado;
        diferencia = diferencia.toFixed(2);
        $("#porcentaje8").val(diferencia);
        if (($('#porcentaje8').val().trim() <= 0)) {
            bootbox.alert('Disculpe, el nivel 8 no puede dar igual o menor a 0 por favor verifique los montos asignados', function () {
                $('#porcentaje8').parent('div').addClass('has-error');
            });
        }
    }


    $("#registrar").click(function (e) {
        e.preventDefault();  // Para evitar que se envíe por defecto
        var por1 = $('#porcentaje1').val()
        var por2 = $('#porcentaje2').val()
        var por3 = $('#porcentaje3').val()
        var por4 = $('#porcentaje4').val()
        var por5 = $('#porcentaje5').val()
        var por6 = $('#porcentaje6').val()
        var por7 = $('#porcentaje7').val()
        var por8 = $('#porcentaje8').val()
        var suma = parseInt(por1) + parseInt(por2) + parseInt(por3) + parseInt(por4) + parseInt(por5) + parseInt(por6) + parseInt(por7) + parseInt(por8)
        //alert(suma)
        if (($('#porcentaje1').val().trim() == '' || $('#porcentaje1').val().trim() == 0)) {
            bootbox.alert('Disculpe, Debe Colocar el porcentaje que se le otorgará al nivel 1', function () {
                $('#porcentaje1').parent('div').addClass('has-error');
            });
        }else if (($('#porcentaje2').val().trim() == '' || $('#porcentaje2').val().trim() == 0)) {
            bootbox.alert('Disculpe, Debe Colocar el porcentaje que se le otorgará al nivel 2', function () {
                $('#porcentaje2').parent('div').addClass('has-error');
            });
        }else if (($('#porcentaje3').val().trim() == '' || $('#porcentaje3').val().trim() == 0)) {
            bootbox.alert('Disculpe, Debe Colocar el porcentaje que se le otorgará al nivel 3', function () {
                $('#porcentaje3').parent('div').addClass('has-error');
            });
        }else if (($('#porcentaje4').val().trim() == '' || $('#porcentaje4').val().trim() == 0)) {
            bootbox.alert('Disculpe, Debe Colocar el porcentaje que se le otorgará al nivel 4', function () {
                $('#porcentaje4').parent('div').addClass('has-error');
            });
        }else if (($('#porcentaje5').val().trim() == '' || $('#porcentaje5').val().trim() == 0)) {
            bootbox.alert('Disculpe, Debe Colocar el porcentaje que se le otorgará al nivel 5', function () {
                $('#porcentaje5').parent('div').addClass('has-error');
            });
        }else if (($('#porcentaje6').val().trim() == '' || $('#porcentaje6').val().trim() == 0)) {
            bootbox.alert('Disculpe, Debe Colocar el porcentaje que se le otorgará al nivel 6', function () {
                $('#porcentaje6').parent('div').addClass('has-error');
            });
        }else if (($('#porcentaje7').val().trim() == '' || $('#porcentaje7').val().trim() == 0)) {
            bootbox.alert('Disculpe, Debe Colocar el porcentaje que se le otorgará al nivel 7', function () {
                $('#porcentaje7').parent('div').addClass('has-error');
            });
        }else if (($('#porcentaje8').val().trim() == 'NaN')) {
            bootbox.alert('Disculpe, Revise alguno de los porcentajes colocados debido a uno (1) o más campos estan vacios o con algun valor no válido ', function () {
                $('#porcentaje8').parent('div').addClass('has-error');
            });
        }else if (($('#porcentaje8').val().trim() <= 0)) {
            bootbox.alert('Disculpe, el nivel 8 no puede dar igual o menor a 0 por favor verifique los montos asignados', function () {
                $('#porcentaje8').parent('div').addClass('has-error');
            });
        }else if (($('#codigo').val().trim() == '')) {
            bootbox.alert('Disculpe, debe introducir el código de seguridad', function () {
                $('#codigo').parent('div').addClass('has-error');
            });
        }else if (($('#codigo').val().length  < 8)) {
            bootbox.alert('Disculpe, la cantidad de digitos no es valida', function () {
                $('#codigo').parent('div').addClass('has-error');
            });
        }else {
            //$('#codigo').prop('disabled',false);
            $.post('<?php echo base_url(); ?>index.php/administracion/CAMontos/actualizar', $('#form_asig_montos').serialize(), function (response) {
                if (response[0] == '1') {
                    bootbox.alert("Disculpe, código de seguridad invalido", function () {
                    }).on('hidden.bs.modal', function (event) {
                        $("#codigo").parent('div').addClass('has-error')
                        $("#codigo").focus();
                    });
                }else {
                    bootbox.alert("Se registro con exito", function () {
                    }).on('hidden.bs.modal', function (event) {
                        url = '<?php echo base_url(); ?>index.php/administracion/CAMontos'
                        window.location = url
                    });
                }
            });

        }
    });


</script>
