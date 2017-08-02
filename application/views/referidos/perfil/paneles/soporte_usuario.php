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
                Soporte al Usuario
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>index.php"  style="color:#3C8DBC"><i class="fa fa-home"></i> Inicio</a></li>
                <li class="active">Soporte al Usuario</li>
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
                                <legend><H4  style="color:#3C8DBC">Solicitudes de Soportes al Usuario</H4></legend>
                            </div>
                        <?php if ($editar[0]->estatus != 4) {?>
                        <br>
                        <div class="text-center">
                            <span  style="font-weight: bold; color:red"></span>
                        </div>
                        <br>
                        <?php } ?>

                        <div class="col-md-2">
                        </div><!-- /.form-group -->
                        <div class="col-md-2">
                            <div class="form-group">
                                <label style="font-weight:bold">Seleccione el motivo</label>
                                <select id="motivo" class="form-control select2" >
                                    <option value=0 selected=selected>Seleccione</option>
                                    <option value=1>Pregunta</option>
                                    <option value=2>Reclamo</option>
                                    <option value=3>Sugerencia</option>
                                </select>
                            </div><!-- /.form-group -->
                        </div><!-- /.form-group -->
                         <div class="col-md-4">
                            <div class="form-group text-center">
                                <textarea type="text" class="form-control"  rows="3" maxlength="290" style="width: 100%; " id="preguntas" name="preguntas" placeholder="" autofocus="true"></textarea>
                                <br>
                                <button type="button" id="agregar_r" style="font-weight: bold;font-size: 13px" class="btn btn-info " >
                                    &nbsp;<span class="glyphicon glyphicon-floppy-disk"></span>&nbsp;Enviar
                                </button>
                            </div><!-- /.form-group -->
                        </div><!-- /.form-group -->
                        <div class="col-md-2">
                            <div class="form-group">
                                <br>
                                <input id="cod_perfil"  type='hidden' value="<?php echo $cod_perfil ?>" class="form-control" >
                                <input class="form-control"  type='hidden' id="usuario_id" name="usuario_id" value="<?php echo $usuario[0]->codigo ?>"/>
                            </div><!-- /.form-group -->
                        </div><!-- /.form-group -->

                        <table id="tab_retiros" class="table table-bordered table-striped table-hover table-condensed dt-responsive table-responsive">
                    <thead>
                      <tr>
                        <th style='text-align: center'>Item</th>
                        <th style='text-align: center'>Motivo</th>
                        <th style='text-align: center'>Fecha</th>
                        <th style='text-align: center'>Estatus</th>
                        <th style='text-align: center'>Consulta</th>
                        <th style='text-align: center'>Respuesta</th>
                        <th style='text-align: center'>Operador</th>
                      </tr>
                    </thead>
                      <tbody >    
                            <?php $i = 1; ?>

                            <?php foreach ($listar as $ayuda) { ?>
                                <tr style="font-size: 16px;text-align: center" class="{% cycle 'impar' 'par' %}" >
                                    <td>
                                        <?php echo $i; ?>
                                    </td>
                                        <td>
                                            <?php 
                                                if($ayuda->motivo == 1){
                                                    echo "<span style='color:blue'>Pregunta</span>";
                                                }else if($ayuda->motivo == 2){
                                                    echo "<span style='color:red'>Reclamos</span>";
                                                }else if($ayuda->motivo == 3){
                                                    echo "<span style='color:green'>Sugerencias</span>";
                                                }else{
                                                    echo "";
                                                }
                                                ?>
                                            </td>
                                            <td><?php
                                                $fe = explode('-',$ayuda->fecha_pre);
                                                $fecha = $fe[2].'-'.$fe[1].'-'.$fe[0];
                                                echo $fecha;
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                if($ayuda->estatus == 1){
                                                    echo "<span style='color:red'>Pendiente</span>";
                                                }else if($ayuda->estatus == 2){
                                                    echo "<span style='color:green'>Atendido</span>";
                                                }else{
                                                    echo "";
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo $ayuda->pregunta;?></td>
                                            <td>
                                                        <?php 
                                                        if($ayuda->estatus == 1){
                                                            echo "";
                                                        }else if($ayuda->estatus == 2){
                                                            echo $ayuda->respuesta;
                                                        }?>
                                                </td>
                                            <td><?php 
                                                    if($ayuda->estatus == 1){
                                                        echo "";
                                                    }else if($ayuda->estatus == 2){
                                                        foreach($listar_usuarios as $usuario){
                                                            if($usuario->codigo == $ayuda->operador_id){
                                                                echo $usuario->first_name;
                                                                echo ' ';
                                                                echo $usuario->last_name;
                                                            }
                                                        }
                                                    }?>
                                            </td>
                                    </tr>
                                <?php $i++ ?>
                            <?php } ?>

                        </tbody>

                  </table>

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

    var TTCuentas = $('#tab_retiros').dataTable({
        "paging": true,
        "lengthChange": false,
        "autoWidth": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "iDisplayLength": 5,
        "iDisplayStart": 0,
        "sPaginationType": "full_numbers",
        "aLengthMenu": [5,10,15],
        "oLanguage": {"sUrl": "<?= base_url() ?>/static/js/es.txt"},
        "aoColumns": [
            {"sClass": "registro center", "sWidth": "5%"},
            {"sClass": "registro center", "sWidth": "10%"},
            {"sClass": "registro center", "sWidth": "10%"},
            {"sClass": "registro center", "sWidth": "3%"},
            {"sClass": "none", "sWidth": "20%"},
            {"sClass": "none", "sWidth": "20%"},
            {"sClass": "none", "sWidth": "20%"},
                                                
        ]
    });
     
    $('#fecha_pago').numeric({allow: "/"});
    $('#num_pago').numeric();
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

    
    $('#agregar_r').click(function(e){
        e.preventDefault();
        //Para validar campos vacios preguntas
        bootbox.confirm("¿Desea enviar esta consulta al departamento de soporte al usuario?", function(result) {
            if (result) {
                    if ($("#motivo").val() == 0) {
                        bootbox.alert("Debe indicar el motivo", function () {
                        }).on('hidden.bs.modal', function (event) {
                                $("#motivo").parent('div').addClass('has-error')
                                $("#motivo").focus();
                        });
                    }else if ($("#preguntas").val() == ''){
                        bootbox.alert("Debe redactar su pregunta, reclamo o opinión", function () {
                        }).on('hidden.bs.modal', function (event) {
                                $("#preguntas").parent('div').addClass('has-error')
                                $("#preguntas").focus();
                        });
                    }else if ($("#preguntas").val().trim().length < 10){
                        bootbox.alert("Su consulta debe ser mayor a diez (10) caracteres, para ser valida", function () {
                        }).on('hidden.bs.modal', function (event) {
                                $("#preguntas").parent('div').addClass('has-error')
                                $("#preguntas").focus();
                        });
                    }else{
                        usuario_id = $('#usuario_id').val()
                        motivo = $('#motivo').val()
                        preguntas = $('#preguntas').val()
                        $.post('<?php echo base_url(); ?>index.php/referidos/CRelAyudas/guardar',
                               $.param({'preguntas': preguntas})+'&'+$.param({'usuario_id': usuario_id})+'&'+$.param({'motivo': motivo}), function (response){
                                    bootbox.alert("Su solicitud de soporte fue envidada Exitosamente", function (){
                                        window.location = '<?php echo base_url(); ?>index.php/referidos/CRelAyudas/'
                                    });
                        });
                    }			
            }else{
                    this.prop('checked','false');
            }
        });
        
    });
    $(".pdf_retiro").click(function (e) {
        e.preventDefault();  // Para evitar que se envíe por defecto
        var id = this.getAttribute('id');
        URL = '<?php echo base_url(); ?>index.php/referidos/CRelRetiros/pdf_recibo_retiro/' + id + '';
           $.fancybox.open({ padding : 0, href: URL, type: 'iframe',width: 1024, height: 520});
    });

</script>