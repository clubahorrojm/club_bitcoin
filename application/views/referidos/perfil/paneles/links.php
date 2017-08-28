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
                Links de invitación
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>index.php"  style="color:#3C8DBC"><i class="fa fa-home"></i> Inicio</a></li>
                <li class="active">Links de invitación</li>
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
                                <legend><H4  style="color:#3C8DBC">Links para referir tu cuenta</H4></legend>
                            </div>
                            <table id="tab_rel_links" class="table table-bordered table-striped table-hover table-condensed dt-responsive table-responsive">
                                <thead>
                                    <tr class="info">
                                        <th style='text-align: center'>#</th>
                                        <th style='text-align: center'>Links</th>
                                        <th style='text-align: center'>Estatus</th>
                                        <th style='text-align: center'>Referido</th>
                                        <th style='text-align: center'>Cant. Sub-Referidos</th>
                                        <th style='text-align: center'>¿Pagó?</th>
                                    </tr>
                                </thead>
                                <tbody >       
                                    <?php $i = 1; ?>
                                    <?php foreach ($listar_links as $links) { ?>
                                    <tr style="font-size: 16px;text-align: center" class="{% cycle 'impar' 'par' %}" >
                                        <td><?php echo $links->num_link; ?></td>
                                        <td><?php echo $links->links; ?></td>
                                        <td><?php if ($links->estatus == 1) {?>
                                                <label style="font-weight:bold; color: blue">Disponible</label>
                                            <?php }else if ($links->estatus == 2){ ?>
                                                <label style="font-weight:bold; color: green">Ocupado</label>
                                            <?php }else if ($links->estatus == 3){ ?>
                                                <label style="font-weight:bold; color: red">Caduco</label>
                                            <?php }else if ($links->estatus == 4){ ?>
                                                <label style="font-weight:bold; color: green">Ocupado <span style="color:red">(*)</span></label>
                                            <?php } ?>
                                        </td>
                                        <td><?php foreach($listar_usuarios as $usuario){
                                                if($usuario->codigo == $links->referido_id){
                                                    echo $usuario->first_name;
                                                    echo ' ';
                                                    echo $usuario->last_name;
                                                }
                                            }?> 
                                        </td>
                                        <td><?php foreach($listar_cant_links as $usuario_link){
                                                if($usuario_link->usuario_id == $links->referido_id){
                                                    echo $usuario_link->cantidad;
                                                    echo ' /5';
                                                }
                                            }?> 
                                        </td>
                                        <td><?php if ($links->verif_pago == 1) {?>
                                                <label style="font-weight:bold; color: blue">SI</label>
                                            <?php }else{ ?>
                                                <label style="font-weight:bold; color: red">No</label>
                                            <?php } ?>
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
            {"sClass": "registro center", "sWidth": "1%"},
            {"sClass": "registro center", "sWidth": "5%"},
            {"sClass": "registro center", "sWidth": "5%"},
            {"sClass": "registro center", "sWidth": "1%"},
        ],        
    });
     

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

    
    $('#generar_links').click(function(e){
        e.preventDefault();
        //Para validar campos vacios
        usuario_id = $('#usuario_id').val()
        $.post('<?php echo base_url(); ?>index.php/referidos/CRelLinks/guardar',
               $.param({'usuario_id': usuario_id}), function (response){
                // alert(response[0])
                if (response[0] == 1) {
                    bootbox.alert("Disculpe, ya generó sus links de invitación", function () {
                    }).on('hidden.bs.modal', function (event) {
                        $("#monto_retiro").parent('div').addClass('has-error')
                        $("#monto_retiro").focus();
                    });
                } else {
                    bootbox.alert("Sus link han sido generados satisfactoriamente", function (){
                        window.location = '<?php echo base_url(); ?>index.php/referidos/CRelLinks/'
                    });
                }
            
        });
    })

</script>