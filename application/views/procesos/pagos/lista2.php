<?php
if (isset($this->session->userdata['logged_in'])) {
$username = ($this->session->userdata['logged_in']['username']);
$email = ($this->session->userdata['logged_in']['email']);
$tipouser = ($this->session->userdata['logged_in']['tipo_usuario']);
$id_user = ($this->session->userdata['logged_in']['id']);
$codigo = ($this->session->userdata['logged_in']['codigo']);
} else {
redirect(base_url());
}
?>
  
<?php if ($tipouser == 'Administrador' || $tipouser == 'OPERADOR'){
	
 } else {
    redirect(base_url());
 }?>   
<div class="wrapper">
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" style="min-height: 1156px;">
          <br/>
        <br/>
        <br/>
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1 style="color:#3C8DBC">
           Pagos
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php" style="color:#3C8DBC"><i class="fa fa-home"></i> Inicio</a></li>
            <li>Procesos</li>
            <li class="active">Pagos</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              
          
              <div class="box box-primary">
                <div class="box-header">
					<div class="text-left">
						<legend><H4  style="color:#3C8DBC">Listado de Pagos</H4></legend>
					</div>
                </div>
                <div class="box-body">
                  <table id="tab_pagos" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='text-align: center'>Item</th>
                        <th style='text-align: center'>Usuario</th>
                        <th style='text-align: center'>Monto</th>
                        <!--<th style='text-align: center'>Cuenta</th>
                        <th style='text-align: center'>N. Pago</th>-->
                        <th style='text-align: center'>Dir. Monedero</th>
                        <th style='text-align: center'>Fecha</th>
                        <th style='text-align: center'>Estatus</th>
                        <th style='text-align: center'>Validar</th>
                        <th style='text-align: center'>Negar</th>
                      </tr>
                    </thead>
                      <tbody >    
                            <?php $i = 1; ?>

                            <?php foreach ($listar as $pago) { ?>
                                <tr style="font-size: 16px;text-align: center" class="{% cycle 'impar' 'par' %}" >
                                    <td>
                                        <?php echo $i; ?>
                                    </td>
                                    <td><?php echo $pago->username;?></td> 
                                    <td><?php echo $pago->monto;?> <?php echo $pago->abreviatura;?></td> 
                                    <!--<td><?php echo $pago->cuenta;?></td>                                 
                                    <td><?php echo $pago->num_pago;?></td>-->
                                    <td><?php echo $pago->dir_monedero;?></td>
                                    <td><?php echo $pago->fecha_pago." ".$pago->hora_pago;?></td>
									<td>
										<?php 
										if($pago->estatus == 1){
											echo "<span style='color:red'>Pendiente</span>";
										}else if($pago->estatus == 2){
											echo "<span style='color:green'>Validado</span>";
										}else if($pago->estatus == 3){
											echo "<span style='color:grey'>Negado</span>";
										}else if($pago->estatus == 0){
											echo "<span style='color:grey'>Inhabilitado</span>";
										}else{
											echo "";
										}
										?>
									</td>
									<td style='text-align: center'>
										<?php if ($pago->estatus == 2) {?>
										<input class='validar' type="checkbox" checked="checked" disabled="disabled"/>
										<?php }else if ($pago->estatus == 1){ ?>
										<input class='validar' id='<?php echo $pago->codigo; ?>' type="checkbox" title='Validar el pago <?php echo $pago->codigo;?>'/>
										<?php }else if ($pago->estatus == 3){ ?>
										<input class='validar' type="checkbox" checked="checked" disabled="disabled"/>
										<?php } ?>
									</td>
									<td style='text-align: center'>
										<?php if ($pago->estatus == 2) {?>
										<input class='negar' type="checkbox" checked="checked" disabled="disabled"/>
										<?php }else if ($pago->estatus == 1 || $pago->estatus == 3){ ?>
										<input class='negar' id='<?php echo $pago->codigo; ?>' type="checkbox" title='Negar el pago <?php echo $pago->codigo;?>'/>
										<?php } ?>
									</td>
                                </tr>
                                <?php $i++ ?>
                            <?php } ?>

                        </tbody>

                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0.0
        </div>
         <img  src="<?= base_url() ?>/static/img/footer.png"/>
      </footer>
</div><!-- /wrapper -->

    <script>

 
    
       var TTCuentas = $('#tab_pagos').dataTable({
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
            {"sClass": "registro center", "sWidth": "20%"},
            //~ {"sClass": "registro center", "sWidth": "50%"},
            {"sClass": "registro center", "sWidth": "20%"},
            {"sClass": "registro center", "sWidth": "20%"},
            {"sClass": "registro center", "sWidth": "30%"},
            {"sClass": "registro center", "sWidth": "3%"},
            {"sWidth": "3%", "bSortable": false, "sClass": "center sorting_false", "bSearchable": false},
            {"sWidth": "3%", "bSortable": false, "sClass": "center sorting_false", "bSearchable": false}
        ]
    });
            
	//iCheck for checkbox and radio inputs
	$('input[type="checkbox"].validar, input[type="radio"].validar').iCheck({
	  checkboxClass: 'icheckbox_minimal-blue',
	  radioClass: 'iradio_minimal-blue'
	});
	
	//iCheck for checkbox and radio inputs
	$('input[type="checkbox"].negar, input[type="radio"].negar').iCheck({
	  checkboxClass: 'icheckbox_minimal-blue',
	  radioClass: 'iradio_minimal-blue'
	});
	
	// Función para activar/desactivar un tipo de cuenta
	$("table#tab_pagos").on('ifChanged', 'input.negar', function (e) {
	    e.preventDefault();
 
	    var cod = this.getAttribute('id');
	    //alert(cod)

		bootbox.confirm("¿Desea negar este pago?", function(result) {
			if (result) {

				$.post('<?php echo base_url(); ?>index.php/procesos/CLPagos/negar/' + cod, function(response) {
					bootbox.alert("El pago fue negado exitosamente", function () {
					}).on('hidden.bs.modal', function (event) {
						location.reload();
					});
				})
				
			} else {
				this.prop('checked','false');
			}
		}); 
	   
	   
	});

    </script>
