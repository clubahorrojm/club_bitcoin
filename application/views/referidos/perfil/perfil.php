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


<div class="wrapper">



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height: 1156px;">
        <br/>
        <br/>
        <br/>
        <!-- Content Header (Page header) -->
        <!--<section class="content-header">
            <h1>
                Perfil de Usuario
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-home"></i> Inicio</a></li>
                <li class="active">Perfil</li>
            </ol>
        </section>-->

        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-xs-12">

                    <!-- SELECT2 EXAMPLE -->
                    <div class="box box-primary">
                        <div class="box-header with-border col-md-12">
                            <div class="col-md-6">
                                <h3 class="box-title" style="font-weight:bold; color:#3C8DBC">Información de cuenta</h3>
                            </div>
                            <div class="col-md-6 text-right" >
                                <h3 class="box-title" style="font-weight:bold; color:#3C8DBC">Código: <?php echo str_pad($editar[0]->codigo, 5, '0',STR_PAD_LEFT) ?></h3>
                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <form id="form_empresa">
                                <div class="col-md-12">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <img class="img-circle" src="<?= base_url() ?>static/img/logo_usuario.jpg" style="width: 100%;" />
                                        </div><!-- /.form-group -->
                                    </div><!-- /.form-group -->
                                    <div class="col-md-10">
                                        <div class="col-md-8">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <h3 class="box-title" style="font-weight:bold; color:#3C8DBC">Hola de nuevo, <?php echo $usuario[0]->first_name ?>
                                                    <?php echo $usuario[0]->last_name ?></h3>
                                                </div><!-- /.form-group -->
                                            </div>
                                            <div class="col-md-3">
                                                <label style="color:#3C8DBC">Su Perfil está: </label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="progress progress-md active  ">
                                                    <?php if ($editar[0]->estatus == 1) {?>
                                                        <div class="progress-bar progress-bar-danger progress-bar-striped" style="width: 25%;"
                                                             aria-valuemax="100" aria-valuemin="0" aria-valuenow="25" role="progressbar">
                                                            <span style="font-weight: bold">25% Completado</span>
                                                        </div>
                                                    <?php }else if ($editar[0]->estatus == 2){ ?>
                                                        <div class="progress-bar progress-bar-warning progress-bar-striped" style="width: 50%;"
                                                             aria-valuemax="100" aria-valuemin="0" aria-valuenow="50" role="progressbar">
                                                            <span style="font-weight: bold">50% Completado</span>
                                                        </div>
                                                    <?php }else if ($editar[0]->estatus == 3){ ?>
                                                        <div class="progress-bar progress-bar-teal progress-bar-striped" style="width: 75%;"
                                                             aria-valuemax="100" aria-valuemin="0" aria-valuenow="75" role="progressbar">
                                                            <span style="font-weight: bold">75% Completado</span>
                                                        </div>
                                                    <?php }else if ($editar[0]->estatus == 4){ ?>
                                                        <div class="progress-bar progress-bar-success progress-bar-striped" style="width: 100%;"
                                                             aria-valuemax="100" aria-valuemin="0" aria-valuenow="100" role="progressbar">
                                                            <span style="font-weight: bold">100% Completado</span>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                <div class="text-center">
                                                    <h1 style="color:#3C8DBC">Nivel</h1>
                                                    <img class="img" src="<?= base_url() ?>static/img/iconos_medianos/nivel<?php echo $editar[0]->nivel ?>.jpg" style="width: 25%;" />
                                                </div><!-- /.form-group -->
                                            </div>
                                        </div><!-- /.form-group -->
                                        <div class="col-md-4">
                                            <div class="col-md-6">
                                                <div class="text-center">
                                                    <img class="img-circle" src="<?= base_url() ?>static/img/maximo.jpg" style="width: 70%" />
                                                </div><!-- /.form-group -->
                                                <div class="form-group">
                                                    <h3 class="box-title" style="font-weight:bold;">
                                                        <p style="font-weight:bold; color:#3C8DBC">Máximo</p>
                                                    </h3>
                                                    <h5><label style="font-weight:bold;"><?php echo number_format($editar[0]->maximo, 2, ',', '.')?> <?php echo $moneda ?></label></h5>
                                                </div><!-- /.form-group -->
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="text-center">
                                                        <img class="img-circle" src="<?= base_url() ?>static/img/disponibilidad.jpg" style="width: 70%;" />
                                                    </div>
                                                    <div class="form-group">
                                                        <h3 class="box-title" style="font-weight:bold; color:#3C8DBC">
                                                            <p style="font-weight:bold">Disponible</p>
                                                        </h3>
                                                        <h5><label style="font-weight:bold"><?php echo number_format($editar[0]->disponible, 2, ',', '.')?> <?php echo $moneda ?></label></h5>
                                                    </div><!-- /.form-group -->
                                                </div><!-- /.form-group -->
                                            </div>
                                            <input class="form-control"  type='hidden' id="id" name="id" value="<?php echo $editar[0]->codigo ?>"/>
                                            <input id="estatus_perfil" type='hidden' value="<?php echo $editar[0]->estatus ?>" class="form-control" >
                                            <input class="form-control"  type='hidden' id="usuario_id" name="usuario_id" value="<?php echo $usuario[0]->codigo ?>"/>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.form-group -->
                                </div><!-- /.form-group -->
                            </form>
                        </div><!-- /.box-body -->
                    </div><!-- /.box-body-primary -->

                </div><!-- /.col -->
                <!-- PESTAÑAS -->
                <div class="col-xs-6">
                    <div class="box box-primary">
                        <div class="box-header with-border col-md-6">
                            <h3 class="box-title" style="font-weight:bold; color:#3C8DBC">Pagos de referidos recibidos</h3>
                        </div><!-- /.box-header -->
                        <div class="col-md-6 text-right" >
                            <button type="button" id="res_pagos" style="font-weight: bold;font-size: 13px" class="btn btn-success btn-xs " >
                                &nbsp;<span class="fa fa-file-text"></span>&nbsp;Resumen de pagos
                            </button>
                        </div>
                            <div class="panel-body">
                                <table id="tab_rel_links" class="table table-bordered table-striped table-hover table-condensed dt-responsive table-responsive">
                                    <thead>
                                        <tr class="info">
                                            <th style='text-align: center'>#</th>
                                            <th style='text-align: center'>Usuario</th>
                                            <th style='text-align: center'>Monto</th>
                                        </tr>
                                    </thead>
                                    <tbody >       
                                        <?php $i = 1; ?>
                                        <?php foreach ($listar_distribuciones as $debitado) { ?>
                                        <tr style="font-size: 16px;text-align: center" class="{% cycle 'impar' 'par' %}" >
                                            <td><?php echo $i; ?></td>
                                            <td><?php foreach($listar_usuarios as $usuario){
                                                    if($usuario->codigo == $debitado->usuario_id){
                                                        echo $usuario->first_name;
                                                        echo ' ';
                                                        echo $usuario->last_name;
                                                    }
                                                }?> 
                                            </td>
                                            <td><?php echo $debitado->monto; ?> <?php echo $moneda ?></td>
                                        </tr>
                                        <?php $i++ ?>
                                        <?php } ?>
                                    </tbody>
                                </table>

                            </div>
                        </div><!-- /.box-body -->
                </div><!-- /.box-body-primary -->

                <div class="col-xs-6">
                    <div class="box box-primary">
                        <div class="box-header with-border col-md-6">
                            <h3 class="box-title" style="font-weight:bold; color:#3C8DBC">Retiros</h3>
                        </div><!-- /.box-header -->
                        <div class="col-md-6 text-right" >
                            <button type="button" id="res_retiros" style="font-weight: bold;font-size: 13px" class="btn btn-success btn-xs " >
                                &nbsp;<span class="fa fa-file-text"></span>&nbsp;Resumen de retiros
                            </button>
                        </div>
                            <div class="panel-body">
                                <table id="tab_rel_retiros" class="table table-bordered table-striped table-hover table-condensed dt-responsive table-responsive">
                            <thead>
                                <tr class="info">
                                    <th style='text-align: center'>#</th>
                                    <th style='text-align: center'>Fecha</th>
                                    <th style='text-align: center'>Monto</th>
                                    <th style='text-align: center'>Estatus</th>
                                </tr>
                            </thead>
<!--                             <tfoot>
                                <tr>
                                    <th colspan="2" style="text-align:right; font-size: 16px">Total retirado:</th>
                                    <th colspan="2"></th>
                                </tr>
                            </tfoot> -->
                            <tbody >       
                                <?php $i = 1; ?>
                                <?php foreach ($listar_retiros as $retiros) { ?>
                                <tr style="font-size: 16px;text-align: center" class="{% cycle 'impar' 'par' %}" >
                                    <td><?php echo $i; ?></td>
                                    <td><?php
                                    
                                    $fe = explode('-',$retiros->fecha_solicitud);
                                    $fecha = $fe[2].'-'.$fe[1].'-'.$fe[0];
                                    echo $fecha;
                                    ?></td>
                                    
                                    <td><?php echo number_format($retiros->monto, 2, ',', '.') ; ?> <?php echo $moneda ?></td>
                                    <td><?php if ($retiros->estatus == 1) {?>
                                            <label style="font-weight:bold; color: blue">Solicitado</label>
                                        <?php }else if ($retiros->estatus == 2){ ?>
                                            <label style="font-weight:bold; color: green">Procesado</label>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php $i++ ?>
                                <?php } ?>
                            </tbody>
                        </table>

                            </div>
                        </div><!-- /.box-body -->
                </div><!-- /.box-body-primary -->
            <!-- PESTAÑAS -->

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

    var Tusuarios = $('#tab_rel_links').dataTable({
        "paging": true,
        "lengthChange": false,
        "autoWidth": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "iDisplayLength": 5,
        "iDisplayStart": 0,
        "sPaginationType": "full_numbers",
        "aLengthMenu": [5,10,15],
        "oLanguage": {"sUrl": "<?= base_url() ?>/static/js/es.txt"},
        "decimal": ",",
        "thousands": ".",
        "aoColumns": [
            {"sClass": "registro center", "sWidth": "1%"},
            {"sClass": "registro center", "sWidth": "15%"},
            {"sClass": "registro center", "sWidth": "5%"},
        ],        
    });
        var Tusuarios = $('#tab_rel_retiros').dataTable({
        "paging": true,
        "lengthChange": false,
        "autoWidth": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "iDisplayLength": 10,
        "iDisplayStart": 0,
        "sPaginationType": "full_numbers",
        "aLengthMenu": [5,10,15],
        "oLanguage": {"sUrl": "<?= base_url() ?>/static/js/es.txt"},
        "decimal": ",",
        "thousands": ".",
        "aoColumns": [
            {"sClass": "registro center", "sWidth": "1%"},
            {"sClass": "registro center", "sWidth": "5%"},
            {"sClass": "registro center", "sWidth": "5%"},
            {"sClass": "registro center", "sWidth": "5%"},
        ],
        // "footerCallback": function ( row, data, start, end, display ) {
        //     var api = this.api(), data;
        //     // Remove the formatting to get integer data for summation
        //     var numVal = function ( i ) {
        //         return typeof i === 'string' ?
        //             i.replace('.', ''):
        //             typeof i === 'number' ?
        //                 i : 0.0;
        //     };
        //     var floatVal = function ( i ) {
        //         return typeof i === 'string' ?
        //             i.replace(',', '.'):
        //             typeof i === 'number' ?
        //                 i : 0.0;
        //     };
        //     // Total over all pages
        //     total = api
        //         .column( 2 )
        //         .data()
        //         .reduce( function (a, b) {
        //             a = numVal(a);
        //             b = numVal(b);
        //             return parseFloat(floatVal(a)) + parseFloat(floatVal(b));
        //         }, 0 );
            
        //     // Total over this page
        //     pageTotal = api
        //         .column( 2, { page: 'current'} )
        //         .data()
        //         .reduce( function (a, b) {
        //             a = numVal(a);
        //             b = numVal(b);
        //             //alert(b)
        //             return parseFloat(floatVal(a)) + parseFloat(floatVal(b));
        //         }, 0 );
        //     // Update footer;
        //     $( api.column( 2 ).footer() ).html(
        //         '<spam style="font-size:16px"><spam style="color: red">'+(pageTotal.toLocaleString('de-DE'))+'</spam> Bs'+' (<spam style="color: red;">'+(total.toLocaleString('de-DE')) +'</spam> Bs en total)</spam>'
        //     );
        // }
        
        
    });

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
    //$("#cedula").change(function (event) {
    //    var cedula = $('#cedula').val();
    //    var hosting = "consultaelectoral.bva.org.ve/cedula="
    //    if (hosting) {
    //        $.get("http://" + hosting + cedula, function (data) {
    //            var option = "";
    //            $.each(data, function (i) {
    //                $("#nombre").val(data[i].p_nombre + " " + data[i].s_nombre)
    //                $("#apellido").val(data[i].p_apellido + " " + data[i].s_apellido)
    //            });
    //            // Proceso para validar con la clase error 404 Not Found
    //        }, 'json');
    //    }
    //});
    
    $("#res_pagos").click(function (e) {
        e.preventDefault();  // Para evitar que se envíe por defecto
        // pk_perfil = $('#id').val()
        // alert(pk_perfil)
        URL = '<?php echo base_url(); ?>index.php/referidos/CReferidos/pdf_resumen_pagos/';
            $.fancybox.open({ padding : 0, href: URL, type: 'iframe',width: 1024, height: 520});
    });
    
    $("#res_retiros").click(function (e) {
        e.preventDefault();  // Para evitar que se envíe por defecto
        // pk_perfil = $('#id').val()
        // alert(pk_perfil)
        URL = '<?php echo base_url(); ?>index.php/referidos/CReferidos/pdf_resumen_retiros/';
            $.fancybox.open({ padding : 0, href: URL, type: 'iframe',width: 1024, height: 520});
    });



</script>
