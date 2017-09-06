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
<div class="wrapper">

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height: 1156px;">
        <br/>
        <br/>
        <br/>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 style="color:#3C8DBC">
                Retiros
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>index.php"  style="color:#3C8DBC"><i class="fa fa-home"></i> Inicio</a></li>
                <li class="active">Solicitar Retiro</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <!-- SELECT2 EXAMPLE -->
                    <div class="col-xs-7">
                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="text-left">
                                    <legend><H4  style="color:#3C8DBC">Solicitud de retiro</H4></legend>
                                </div>
                                <?php if ($editar[0]->estatus < 4) {?>
                                <br>
                                <div class="text-center">
                                    <span  style="font-weight: bold; color:red">**Disculpe, su perfil debe estar al 100% completado para poder realizar retiros **</span>
                                </div>
                                <br>
                                <?php } ?>
                                <div class="col-md-12 text-center">
                                    <div class="form-group">
                                        <label style="font-size: 20px">Monto disponible: </label>
                                        <span style="font-size: 16px">&nbsp;&nbsp;<?php echo number_format($editar[0]->disponible, 2, ',', '.')?> $</span>
                                        <span style="font-size: 16px">&nbsp;&nbsp;<?php echo number_format($editar[0]->disponible, 2, ',', '.')?> BTC</span>
                                        <br>
                                        <button type="button" id="agregar_r" style="font-weight: bold;font-size: 13px" class="btn btn-info " >
                                            &nbsp;<span class="glyphicon glyphicon-floppy-disk"></span>&nbsp;Solicitud de retiro
                                        </button>
                                        <br>
                                        <span class="text-danger"  >*El monto mínimo para retirar es de <?php echo $monto_minimo ?> <?php echo $moneda ?></span>
                                    </div><!-- /.form-group -->
                                </div><!-- /.form-group -->
                            
                                <div class="col-md-12">
                                    <div class="form-group">
                                        
                                        <input type="hidden" placeholder="Ej: 011494191" maxlength="10" id="monto_minimo" value="<?php echo $monto_minimo ?>" class="form-control" >
                                        <input type="hidden" placeholder="Ej: 011494191" maxlength="10" id="estatus_perfil" value="<?php echo $editar[0]->estatus ?>" class="form-control" >
                                        <input id="cod_perfil"  type='hidden' value="<?php echo $cod_perfil ?>" class="form-control" >
                                        <input class="form-control"  type='hidden' id="usuario_id" name="usuario_id" value="<?php echo $usuario[0]->codigo ?>"/>
                                    </div><!-- /.form-group -->
                                </div><!-- /.form-group -->

                                <table id="tab_rel_retiros" class="table table-bordered table-striped table-hover table-condensed dt-responsive table-responsive">
                                    <thead>
                                        <tr style="background-color: #001a5a">
                                            <th style='text-align: center; color: white'>#</th>
                                            <th style='text-align: center; color: white'>Código</th>
                                            <th style='text-align: center; color: white'>Monto</th>
                                            <th style='text-align: center; color: white'>Fecha Solicitado</th>
                                            <th style='text-align: center; color: white'>Fecha Cancelado</th>
                                            <th style='text-align: center; color: white'>Estatus</th>
                                            <th style='text-align: center; color: white'>Recibo</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th colspan="2" style="text-align:right; font-size: 16px">Total retirado:</th>
                                            <th colspan="2"></th>
                                        </tr>
                                    </tfoot>
                                    <tbody >       
                                        <?php $i = 1; ?>
                                        <?php foreach ($listar_retiros as $retiros) { ?>
                                        <tr style="font-size: 16px;text-align: center" class="{% cycle 'impar' 'par' %}" >
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $retiros->codigo; ?></td>
                                            <td><?php echo number_format($retiros->monto, 2, ',', '.') ; ?><i class="fa fa-btc"></i></td>
                                            <td><?php
                                                $fe = explode('-',$retiros->fecha_solicitud);
                                                $fecha = $fe[2].'-'.$fe[1].'-'.$fe[0];
                                                echo $fecha;
                                            ?></td>
                                            <td><?php if ($retiros->fecha_verificacion != '') {?>
                                                    <?php $fe = explode('-',$retiros->fecha_verificacion);
                                                    $fecha2 = $fe[2].'-'.$fe[1].'-'.$fe[0];
                                                    echo $fecha2;?>
                                                <?php }
                                                
                                            ?></td>
                                            <td><?php if ($retiros->estatus == 1) {?>
                                                    <label style="font-weight:bold; color: blue">Solicitado</label>
                                                <?php }else if ($retiros->estatus == 2){ ?>
                                                    <label style="font-weight:bold; color: green">Procesado</label>
                                                <?php } ?>
                                            </td>
                                            <td style='text-align: center' >
                                                <?php if ($retiros->estatus == 2) {?>
                                                    <a title="Recibo Retiro" class="pdf_retiro" id="<?php echo $retiros->id; ?>" ><i class="fa fa-file-pdf-o text-red"></i></a>
                                                <?php } ?>
                                                
                                            </td>
                                        </tr>
                                        <?php $i++ ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <br>
                                <span class="text-default"  >Su solicitud sera procesada en un máximo de 72 horas</span>
                            </div><!-- /.box-body -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box-body-primary -->
                    
                    <div class="col-xs-5 text-center">
                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="text-left">
                                    <legend><H4  style="color:#3C8DBC">% Retirado</H4></legend>
                                </div>
                                <input type=hidden id="max_disp_retiro" value="<?php echo $editar[0]->maximo?>">
                                <input type=hidden id="sum_retiros" value="<?php echo $sum_retiros?>">
                                <div id="canvas-holder">
                                    <canvas id="chart-area" width="300" height="300"/>
                                </div>
                                <i class="fa fa-square" style="color: #c3b01c" ></i>&nbsp;Retirado
                                <i class="fa fa-square" style="color: #001A5A" ></i>&nbsp;Disponible
                            </div>
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




<script>

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
            {"sClass": "registro center", "sWidth": "5%"},
            {"sClass": "registro center", "sWidth": "5%"},
            {"sClass": "registro center", "sWidth": "1%"},
        ],
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
            // Remove the formatting to get integer data for summation
            var numVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace('.', ''):
                    typeof i === 'number' ?
                        i : 0.0;
            };
            var floatVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(',', '.'):
                    typeof i === 'number' ?
                        i : 0.0;
            };
            // Total over all pages
            total = api
                .column( 2 )
                .data()
                .reduce( function (a, b) {
                    a = numVal(a);
                    b = numVal(b);
                    return parseFloat(floatVal(a)) + parseFloat(floatVal(b));
                }, 0 );
            
            // Total over this page
            pageTotal = api
                .column( 2, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    a = numVal(a);
                    b = numVal(b);
                    //alert(b)
                    return parseFloat(floatVal(a)) + parseFloat(floatVal(b));
                }, 0 );
            // Update footer;
            $( api.column( 2 ).footer() ).html(
                '<spam style="font-size:16px"><spam style="color: red">'+(pageTotal.toLocaleString('de-DE'))+'</spam> <i class="fa fa-btc"></i>'+' (<spam style="color: red;">'+(total.toLocaleString('de-DE')) +'</spam> <i class="fa fa-btc"></i> en total)</spam>'
            );
        }
        
        
    });

    var sum_retiros = $("#sum_retiros").val();
    var max_disp_retiro =  $("#max_disp_retiro").val();
    var resto = parseFloat(max_disp_retiro) - parseFloat(sum_retiros);
    var pieData = [
        {
            value: sum_retiros,
            color:"#c3b01c",
            highlight: "#C9BC5E",
            label: "Retirado"
        },
        {
            value: resto,
            color: "#001A5A",
            highlight: "#264489",
            label: "Disponible"
        },
    ];

    window.onload = function(){
        var ctx = document.getElementById("chart-area").getContext("2d");
        window.myPie = new Chart(ctx).Pie(pieData);
    };
     
    $('#fecha_pago').numeric({allow: "/"});
    $('#num_pago').numeric();
    $('#monto_retiro').numeric({allow: "."});
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
    if ($("#estatus_perfil").val() >= 4)  {
        $("#monto_retiro,#agregar_r").prop('disabled',false)
    }else{
        $("#monto_retiro,#agregar_r").prop('disabled',true)
    }
    
    $('#agregar_r').click(function(e){
        e.preventDefault();
        //Para validar campos vacios
        var min = $("#monto_minimo").val();
        var monto = $("#monto_retiro").val();
        if ($("#monto_retiro").val() == 0) {
            bootbox.alert("Debe indicar el monto", function () {
            }).on('hidden.bs.modal', function (event) {
                    $("#monto_retiro").parent('div').addClass('has-error')
                    $("#monto_retiro").focus();
            });
        }else if (parseFloat(min) > parseFloat(monto)) {
            bootbox.alert("El monto debe ser mayor al mínimo establecido", function () {
            }).on('hidden.bs.modal', function (event) {
                    $("#monto_retiro").parent('div').addClass('has-error')
                    $("#monto_retiro").focus();
            });
        }else{
            usuario_id = $('#usuario_id').val()
            monto_retiro = $('#monto_retiro').val()
            pk_perfil = $('#cod_perfil').val()
            $.post('<?php echo base_url(); ?>index.php/referidos/CRelRetiros/guardar',
                   $.param({'pk_perfil': pk_perfil})+'&'+$.param({'usuario_id': usuario_id})+'&'+$.param({'monto': monto_retiro}), 
                   function (response){
                    if (response[0] == 1) {
                        bootbox.alert("Disculpe, el monto que intenta solicitar es superior al que tiene disponible", function () {
                        }).on('hidden.bs.modal', function (event) {
                            $("#monto_retiro").parent('div').addClass('has-error')
                            $("#monto_retiro").focus();
                        });
                    }else if (response[0] == 2) {
                        bootbox.alert("Disculpe, no puede solicitar otro retiro mientras aun tiene uno en estatus 'solicitado'", function () {
                        }).on('hidden.bs.modal', function (event) {
                            $("#num_pago,#tipo_pago").parent('div').addClass('has-error')
                            $("#num_pago,#tipo_pago").focus();
                        });
                    } else {
                        bootbox.alert("Su solicitud de retiro fue Exitoso", function (){
                            window.location = '<?php echo base_url(); ?>index.php/referidos/CRelRetiros/'
                        });
                    }
                
            });
    }
    })
    $(".pdf_retiro").click(function (e) {
        e.preventDefault();  // Para evitar que se envíe por defecto
        var id = this.getAttribute('id');
        URL = '<?php echo base_url(); ?>index.php/referidos/CRelRetiros/pdf_recibo_retiro/' + id + '';
           $.fancybox.open({ padding : 0, href: URL, type: 'iframe',width: 1024, height: 520});
    });

</script>