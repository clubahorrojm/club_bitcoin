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
        <section style="font-weight:bold; color:#29274b" class="content-header">
            <h1 >
                Ranking Top 100
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>index.php"  ><i class="fa fa-home"></i> Inicio</a></li>
                <li class="active">Rankings</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header with-border col-md-6">
                                <h3 class="box-title" style="font-weight:bold; color:#29274b">Más dinero recaudado</h3>
                            </div><!-- /.box-header -->
                            <div class="panel-body">
                                <table id="tab_top_disp" class="table table-bordered table-striped table-hover table-condensed dt-responsive table-responsive">
                                <thead style="color:white" bgcolor='#29274b' >
                                  <tr >
                                    <th style='text-align: center '  >Item</th>
                                    <th style='text-align: center'>Usuario</th>
                                    <th style='text-align: center'>Saldo Disponible</th>
                                    <!-- <th style='text-align: center'>Nivel</th> -->
                                  </tr>
                                </thead>
                                <tbody >    
                                    <?php $i = 1; ?>
                                        <?php foreach ($listar_top_disp as $top_dips) { ?>
                                            <tr style="font-size: 16px;text-align: center" class="{% cycle 'impar' 'par' %}" >
                                                <td <?php if($i < 11){ echo " bgcolor='#edd727'"; }?>><?php echo $i; ?></td>
                                                <td><?php foreach($listar_usuarios as $usuario){
                                                    if($usuario->codigo == $top_dips->usuario_id){
                                                        echo $usuario->first_name;
                                                        echo ' ';
                                                        echo $usuario->last_name;
                                                    }}?>
                                                </td>
                                                <td><?php echo $top_dips->disponible;?> $</td>    
                                            </tr>
                                        <?php $i++ ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                            </div><!-- /.box-body -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box-body-primary -->
            </div><!-- /.box-body-primary -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0
        </div>
        <strong>Copyright Criptozone 2017</strong>
    </footer>




<script>

    var TTCuentas = $('#tab_top_disp').dataTable({
        "paging": true,
        "lengthChange": false,
        "autoWidth": false,
        "searching": false,
        "ordering": false,
        "info": true,
        "iDisplayLength": 15,
        "iDisplayStart": 0,
        "sPaginationType": "full_numbers",
        "aLengthMenu": [5,10,15],
        "oLanguage": {"sUrl": "<?= base_url() ?>/static/js/es.txt"},
        "aoColumns": [
            {"sClass": "registro center", "sWidth": "5%"},
            {"sClass": "registro center", "sWidth": "60%"},
            {"sClass": "registro center", "sWidth": "30%"},
            // {"sClass": "registro center", "sWidth": "3%"},
                                                
        ]
    });

    var TTCuentas = $('#tab_top_ref').dataTable({
        "paging": true,
        "lengthChange": false,
        "autoWidth": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "iDisplayLength": 15,
        "iDisplayStart": 0,
        "sPaginationType": "full_numbers",
        "aLengthMenu": [5,10,15],
        "oLanguage": {"sUrl": "<?= base_url() ?>/static/js/es.txt"},
        "aoColumns": [
            {"sClass": "registro center", "sWidth": "5%"},
            {"sClass": "registro center", "sWidth": "60%"},
            {"sClass": "registro center", "sWidth": "30%"},
            // {"sClass": "registro center", "sWidth": "3%"},
                                                
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