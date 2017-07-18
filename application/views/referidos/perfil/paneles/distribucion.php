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
<div class="bg-red ui-draggable ui-draggable-handle text-center" style="position: relative; font-weight: bold">
    Distribución de capital
</div>

<div class="wrapper">

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height: 1156px;">
        <br/>
        <br/>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 style="color:#3C8DBC">
                Distribución de Capital
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>index.php" style="color:#3C8DBC"><i class="fa fa-home"></i> Inicio</a></li>
                <li class="active">Distribución de Capital</li>
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
                                <legend><H4  style=" color:#3C8DBC">Por favor realice el pago a cada uno de sus referidos padres</H4></legend>
                            </div>
							<?php if ($editar[0]->estatus == 1 ) {?>
							<br>
							<div class="text-center">
								<span  style="font-weight: bold; color:red">**Disculpe, debe primero formalizar su pago en el sistema antes de poder distribuir el capital **</span>
							</div>
							<br>
							<?php } ?>
							<table id="tab_rel_distribucion" class="table table-bordered table-striped table-hover table-condensed dt-responsive table-responsive">
								<thead>
									<tr class="info">
										<th style='text-align: center'>Pagar</th>
										<th style='text-align: center'>Usuarios</th>
										<th style='text-align: center'>Niveles</th>
									</tr>
								</thead>
								<tbody >       
									<?php $i = 1; ?>
									<?php foreach ($listar_padres as $padres) { ?>
									<tr style="font-size: 16px;text-align: center" class="{% cycle 'impar' 'par' %}" >
										<td>
											<button type="button" id="<?php echo $padres["codigo"].'-'.$padres['nivel']; ?>" style="font-weight: bold;font-size: 13px"
												<?php foreach($listar_distribuciones as $distribuciones){
													if($distribuciones->referido_id == $padres['codigo']){
														echo 'disabled=disabled';
													}
												}
												?>
												<?php if ($editar[0]->estatus < 3) {?>
														   disabled='disabled'
												<?php } ?>
												class="btn btn-success pagar " 
												&nbsp;<span class="glyphicon glyphicon-floppy-disk"></span>&nbsp;Pagar
											</button>
										</td>
										<td><?php echo $padres['nombre']; ?></td>
										<td><span style="display: none"><?php echo $padres['nivel']; ?></span><img class="img-circle" src="<?= base_url() ?>static/img/iconos_pequeños/nivel<?php echo $padres['nivel']; ?>.jpg"  /></td>
										
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


    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->



<script>

    var Tusuarios = $('#tab_rel_distribucion').dataTable({
        "paging": true,
        "lengthChange": false,
        "autoWidth": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "iDisplayLength": 10,
        "iDisplayStart": 0,
        "sPaginationType": "full_numbers",
        "aLengthMenu": [10,15],
        "oLanguage": {"sUrl": "<?= base_url() ?>/static/js/es.txt"},
        "decimal": ",",
        "thousands": ".",
        "aoColumns": [
            {"sClass": "registro center", "sWidth": "1%"},
            {"sClass": "registro center", "sWidth": "5%"},
            {"sClass": "registro center", "sWidth": "5%"},
        ],
        "order": [[ 2, "desc" ]]     
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
    
    $('.pagar').click(function(e){
        e.preventDefault();
        //Se captura el value de ID del boton
        var val = this.getAttribute('id');
        val = val.split('-') //Se corta el value en 2 partes
        id_ref = val[0] // Id del referido
        nivel_ref = val[1] // nivel del referido

        $.post('<?php echo base_url(); ?>index.php/referidos/CRelDistribucion/pagar',
               $.param({'id_ref': id_ref})+'&'+$.param({'nivel_ref': nivel_ref}), function (response){

                if (response[0] == 1) {
                   bootbox.alert("Disculpe, ya generó sus links de invitación", function () {
                   }).on('hidden.bs.modal', function (event) {
                       $("#monto_retiro").parent('div').addClass('has-error')
                       $("#monto_retiro").focus();
                   });
                } else {
                   bootbox.alert("Su pago de referido ha sido generado satisfactoriamente", function (){
                       window.location = '<?php echo base_url(); ?>index.php/referidos/CRelDistribucion/'
                   });
                }
            
        });
    })

</script>
