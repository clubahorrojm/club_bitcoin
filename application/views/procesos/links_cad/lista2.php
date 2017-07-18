<?php
if (isset($this->session->userdata['logged_in'])) {
$username = ($this->session->userdata['logged_in']['username']);
$email = ($this->session->userdata['logged_in']['email']);
$tipouser = ($this->session->userdata['logged_in']['tipo_usuario']);
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
           Links Caducados
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php" style="color:#3C8DBC"><i class="fa fa-home"></i> Inicio</a></li>
            <li>Procesos</li>
            <li class="active">Links Caducados</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              
          
              <div class="box box-primary">
                <div class="box-header">
					<div class="text-left">
						<legend><H4  style="color:#3C8DBC">Listado de Links Caducados</H4></legend>
					</div>
                </div><!-- /.box-header -->
                <br/>
                <div class="box-body">
                  <table id="tab_links" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='text-align: center'>Item</th>
                        <th style='text-align: center'>Usuario</th>
                        <th style='text-align: center'>Link</th>
                        <th style='text-align: center'>Fecha</th>
                      </tr>
                    </thead>
                      <tbody >    
                            <?php $i = 1; ?>

                            <?php foreach ($listar as $link) { ?>
                                <tr style="font-size: 16px;text-align: center" class="{% cycle 'impar' 'par' %}" >
                                    <td>
                                        <?php echo $i; ?>
                                    </td>
                                    <td>
                                        <?php
                                        foreach($listar_usuarios as $usuario)
                                        {
											if($usuario->codigo == $link->usuario_id)
											{
												echo $usuario->username;
											}
										} 
                                        ?>
                                    </td> 
                                    <td>
                                        <?php echo $link->links; ?>
                                    </td>                                 
                                    <td>
										<?php echo $link->fecha; ?>
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

<div class="modal" id="modal_aprobar">
   <div class="modal-dialog">
	  <div class="modal-content">
		 <div class="modal-header" style="background-color:#296293;color:white;">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title">
			   <center><span class="glyphicon glyphicon-search"></span>
			   &nbsp;Ingrese el número de pago y la fecha de su realización</center>
			</h4>
		 </div>
		 <div class="modal-body">
			<form id="f_aprobacion" name="f_aprobacion" action="" method="post">
			   <div class="form-group">
					<div class="col-sm-12">
						<input type="hidden" id="codigo" name="codigo">
						<input type="text" class="form-control" style="width: 100%; " id="num_pago" name="num_pago" placeholder="Número de pago" autofocus="true">
					</div>
					</br></br></br>
					<div class="col-sm-12">
						<input style="width: 100%;" type="text" class="form-control" id="fecha_verificacion" name="fecha_verificacion" placeholder="Fecha de verificación" maxlength="10"/>
					</div>
					</br></br></br>
					<div class="col-sm-12" align="right">
						<span class="input-btn">
							<button class="btn btn-primary" type="button" id="enviar">
								Aprobar&nbsp;<span class="glyphicon glyphicon-share-alt"></span>
							</button>
						</span>
					</div>
					</br></br>
			   </div>
			</form>
		 </div>
		 
	  </div>
   </div>
</div>

    <script>
    
       var TTCuentas = $('#tab_links').dataTable({
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
            {"sClass": "registro center", "sWidth": "50%"},
            {"sClass": "registro center", "sWidth": "50%"},
            {"sClass": "registro center", "sWidth": "10%"},
        ]
    });	

    </script>
