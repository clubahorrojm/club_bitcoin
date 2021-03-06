<fieldset id="fieldset_pago" style="display:block">
	<!--<h3>Recuerde tiene 90 segundos para registrar su pago</h3>
	<center><div id="CountDownTimer" data-timer="90" style="width: 300px; height: 100px;"></div></center>-->
	<h2 class="fs-title">Información del pago</h2>
	<!--<h3 class="fs-subtitle">Indica los datos de tu pago</h3>-->
	<h3 class="fs-subtitle">( Usted debe realizar el pago a la dirección de nuestra empresa: <span style="color:#296293;"><?php $direccion = $monedero_emp->monedero; echo $direccion; ?></span> )</h3>
	<h3 class="fs-subtitle">Debe transferir el equivalente en Dólares convertidos a Bitcoin</h3>
	<!--<h3 class="fs-subtitle" style="color:red !important;font-size:20px;">( Valores actuales: <span id="precio_bitcoin"></span> )</h3>-->
	
	<!-- Main content -->
	<section class="content">

		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<div class="panel-body">
						
						<div class="col-md-8">
							<div class="form-group">
								<label style="font-weight:bold">Dirección del Monedero (desde el cual realizó el pago)</label><br>
								<input type="text" placeholder="Ej: AxYz125cdJklmn14PqRs87Vwxy54Q7YcV4" maxlength="34" id="dir_monedero" value="<?php echo $pago[0]->dir_monedero ?>" class="form-control" >
							</div>
						</div>
						<!--<div class="col-md-4">
							<div class="form-group">
								<label style="font-weight:bold">Fecha</label>
								<input type="text" placeholder="Ej: 01/10/2016" maxlength="10" id="fecha_pago"
									value="<?php if ($pago[0]->fecha_pago != ''){
										$fe = explode('-',$pago[0]->fecha_pago);
										$fecha = $fe[2].'/'.$fe[1].'/'.$fe[0];
										echo $fecha;
										}
									?>" class="form-control" >
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label style="font-weight:bold">Monto</label>
								<input type="text" placeholder="Ej: 50" maxlength="10" id="monto" class="form-control" value="<?php echo $pago[0]->monto ?>">
							</div>
						</div>-->
						<div class="col-md-4">
							<div class="form-group">
								<label style="font-weight:bold">Estatus</label><br>
								<?php if ($pago[0]->estatus == 1 || $pago[0]->estatus == 2) {?>
									<label style="font-weight:bold; color: blue">En verificación</label>
								<?php }else if ($pago[0]->estatus == 2){ ?>
									<label style="font-weight:bold; color: green">Aprobado</label>
								<?php }else if ($pago[0]->estatus == 99){ ?>
									<label style="font-weight:bold; color: grey">Pendiente</label>
								<?php } ?>
							</div><!-- /.form-group -->
						</div><!-- /.form-group -->
						<?php if ($pago[0]->estatus == 3){ ?>
						   <div class="col-md-4">
							<div class="form-group text-left">
								<a class="btn btn-app ver" data-toggle="tab" id="recibo_pago" >
									<i class="fa fa-file-pdf-o text-red "></i>
									Recibo de Pago
								</a>
							</div><!-- /.form-group -->
						</div><!-- /.form-group -->
						<?php } ?>
						<!-- Imagen de carga -->
						<div class="col-md-12" style="display:none;" id="resultado">
							<div>
								<i class="fa fa-refresh fa-spin">
									
								</i>
								<span>Validando...</span>
							</div>
						</div>
						<!-- Imagen de carga -->
						<div class="col-md-12">
							<div class="form-group text-center">
								<br>
								<!--<button type="button" id="registrar_p" style="font-weight: bold;font-size: 13px" class="btn btn-info " >
									&nbsp;<span class="glyphicon glyphicon-floppy-disk"></span>&nbsp;Registrar
								</button>-->
								<input id="cod_perfil"  type='hidden' value="<?php echo $cod_perfil ?>" class="form-control" >
								<input id="cod_pago"  type='hidden' value="<?php echo $pago[0]->codigo ?>" class="form-control" >
								<input id="estatus"  type='hidden' value="<?php echo $pago[0]->estatus ?>" class="form-control" >
								<input id="base_url" type='hidden' value="<?php echo base_url(); ?>">
								<input id="user_id" type='hidden' value="<?php echo $this->session->userdata['logged_in']['id']; ?>">
								<input id="tiempo_limite" type='hidden'>
								<input id="reg_data_pago" type='hidden' value="0">
							</div><!-- /.form-group -->
						</div><!-- /.form-group -->
							
				</div><!-- /.box-body -->
			</div><!-- /.box-body-primary -->
		</div><!-- /.col -->
	</section><!-- /.content -->
	<h3 class="fs-subtitle">Si no ha hecho el pago requerido presione el botón <strong>Cancelar</strong>, de lo contrario haga clic en <strong>Confirmar</strong></h3>
	<!--<input type="button" name="previous" class="previous action-button" value="Previous"/>-->
	<input type="button" name="next" class="next action-button" id="info_pago" value="Confirmar"/>
	<input type="button" class="action-button cerrar_sesion" value="Cancelar"/>
</fieldset>
