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
					<div class="text-left">
						<!--<button role="button" class="btn btn-primary" style="font-weight: bold;font-size: 13px; color: white " id="validar">
							&nbsp;<span class="glyphicon glyphicon-plus"></span>&nbsp;Pre-Validar Pagos
						</button>-->
						<input type="hidden" id="monedero_emp" value="<?php echo $monedero_emp->monedero; ?>">
					</div>
					<!-- Imagen de carga -->
					<div class="col-md-12" style="display:none;" id="resultado">
						<div>
							<i class="fa fa-refresh fa-spin">
								
							</i>
							<span>Validando...</span>
						</div>
					</div>
					<!-- Imagen de carga -->
					</div>
					<!-- Imagen de carga -->
					<div class="col-md-12" style="display:none;" id="respuestas">
						<div>
							<span id="validados"></span>
							<span id="no_validados"></span>
						</div>
					</div>
					<!-- Imagen de carga -->
                </div>
                <br/>
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
										}/*else if($pago->estatus == 2){
											echo "<span style='color:green'>Pre-Validado</span>";
										}*/else if($pago->estatus == 2){
											echo "<span style='color:#337ab7;'>Validado</span>";
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
										<?php if ($pago->estatus == 2 || $pago->estatus == 3) {?>
										<input class='validar' type="checkbox" checked="checked" disabled="disabled"/>
										<?php }else if ($pago->estatus == 1){ ?>
										<input class='validar' id='<?php echo $pago->codigo; ?>' type="checkbox" title='Validar el pago <?php echo $pago->codigo;?>'/>
										<?php } ?>
									</td>
									<td style='text-align: center'>
										<?php if ($pago->estatus == 2 || $pago->estatus == 3) {?>
										<input class='negar' type="checkbox" checked="checked" disabled="disabled"/>
										<?php }else if ($pago->estatus == 1){ ?>
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
	
	// Función para validar un pago
	$("table#tab_pagos").on('ifChanged', 'input.validar', function (e) {
	    e.preventDefault();
 
	    var cod = this.getAttribute('id');
	    //alert(cod)

		bootbox.confirm("¿Desea validar este pago?", function(result) {
			if (result) {

				$.post('<?php echo base_url(); ?>index.php/procesos/CLPagos/validar/' + cod, function(response) {
					bootbox.alert("El pago fue validado exitosamente", function () {
					}).on('hidden.bs.modal', function (event) {
						location.reload();
					});
				})
				
			} else {
				this.prop('checked','false');
			}
		}); 
	   
	});
	
	// Función para negar un pago
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
	
	// Función para validar pagos pendientes tomando en cuenta sólo la dirección desde la que se haya hecho
	$("#validar").on('click', function (e) {
		//~ alert("Validando..."+$("#monedero_emp").val());
		var monedero_emp = $("#monedero_emp").val();
		$.post('<?php echo base_url(); ?>index.php/procesos/CLPagos/pagos_pendientes/', function (response){
			//~ alert(response.length);
			if(response.length > 0){  // Si hay pagos pendientes
				var validados = 0;
				var no_validados = 0;
				$.each(response, function (i){
					//~ alert(response[i]);
					// Inspeccionamos la dirección de la empresa para comprobar pago desde la dirección indicada por el usuario
					//~ var blockrAPI = "https://blockexplorer.com/api/addr/1JGQko7DZfuNqgyPkiSM6TKJBmAMCHhZL7";
					var blockrAPI = "https://blockexplorer.com/api/addr/"+monedero_emp;
					var status, address, num_trans, search_address_paid, search_amount, search_date;
					// Definimos dinámicamente los valores que serán indicados por parte del usuario
					search_address_paid = response[i]["dir_monedero"];
					pk_perfil = response[i]["perfil_id"];
					cod_pago = response[i]["codigo"];
					// search_amount = monto;
					// search_date = fecha_pago;
					$.ajax({
						url : blockrAPI,
						type : 'GET',
						async: false,  // Para que no proceda con las siguientes instrucciones hasta terminar la petición
						dataType : 'json',
						beforeSend:function(objeto){ 
							$('#resultado').css({display:'block'});
							$('#validar').prop('disabled',true);
						},
						success : function(data) {
							address = data['addrStr'];
							num_trans = data['txApperances'];
							// alert("Dirección: " + address + ", Número de transacciones: " + num_trans);
							var check_payment = 0;
							var contador_trans = 0;
							$.each(data['transactions'], function (i){
								var hash_tx = data['transactions'][i];  // Código hash de la transacción
								
								// Filtramos sólo los pagos recibidos y descartamos los pagos hechos
								// if(!(monto < 0)){
									var blockrAPIDetails = "https://blockexplorer.com/api/tx/"+hash_tx;  // (Detalles de la transacción con http://blockexplorer.com)
									// Consultamos los detalles de la transacción para verificar las direcciones y ver si alguna coincide con la del usuario
									$.ajax({
										url : blockrAPIDetails,
										type : 'GET',
										async: false,  // Para que no proceda con las siguientes instrucciones hasta terminar la petición
										dataType : 'json',
										success : function(data2) {
											var fecha = data2['time'];
											var format_fecha = new Date(fecha*1000);
											var day = (format_fecha.getDate() < 10 ? '0' : '') + format_fecha.getDate();
											var month = (format_fecha.getMonth() < 9 ? '0' : '') + (format_fecha.getMonth() + 1);
											var year = format_fecha.getFullYear();
											format_fecha = day + '/' + month + '/' + year;
											// alert(format_fecha);
											var monto = data2['valueIn'];
											var address_paid = data2['vin'][0]['addr'];
											
											// alert("Dirección: " + address_paid + "Fecha: " + fecha + ", Monto: " + monto);
									
											// Si los detalles del pago coinciden con los indicados por el usuario, entonces lo validamos
											// if(search_address_paid == address_paid && search_amount == monto && search_date == format_fecha){
											if(search_address_paid == address_paid){
												check_payment += 1;
												// $("#input_resultado").val(check_payment);
											}
											contador_trans += 1;  // Una transacción más verificada
											// alert(check_payment);
										}
									});
								// }					
								
							})
							
							$('#resultado').css({display:'none'});
							$('#validar').prop('disabled',false);
							
							// Si el pago fue validado
							// alert(check_payment);
							// alert(contador_trans);
							if(check_payment > 0){
								validados += 1;
								// alert("Su pago fue validado");
								//~ $.post(base_url+'index.php/referidos/CRelPagos/actualizar',
								   //~ $.param({'pk_perfil': pk_perfil})+'&'+$.param({'dir_monedero': dir_monedero})+'&'+$.param({'monto': monto})+'&'+
								   //~ $.param({'fecha_pago': fecha_pago})+'&'+$.param({'cod_pago': cod_pago}), 
								   //~ function (response){
								//~ alert("Perfil: "+pk_perfil+", dirección: "+search_address_paid+", Cod. Pago: "+cod_pago);
								$.post('<?php echo base_url(); ?>index.php/referidos/CRelPagos/actualizar',
								   $.param({'pk_perfil': pk_perfil})+'&'+$.param({'dir_monedero': search_address_paid})+'&'+$.param({'cod_pago': cod_pago}), 
								   function (response){
								   //~ 
							   });
							}else{
								no_validados += 1;
							}
						},
					});
				});
				
				// Impresión de resultados
				bootbox.alert("Pagos validados: "+validados+"... Pagos no validados: "+no_validados, function () {
				}).on('hidden.bs.modal', function (event) {
					location.reload();
				});
				
			}else{
				bootbox.alert("No hay pagos pendientes por validar", function () {
				}).on('hidden.bs.modal', function (event) {
					
				});
			}
		},'json');
		
	});

    </script>
