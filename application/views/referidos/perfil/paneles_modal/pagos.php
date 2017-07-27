<fieldset id="fieldset_pago" style="display:block">
	<h2 class="fs-title">Información del pago</h2>
	<h3 class="fs-subtitle">Indica los datos de tu pago</h3>
	<h3 class="fs-subtitle">( Usted debe realizar el pago a la dirección de nuestra empresa: <span style="color:#296293;"><?php $direccion = $monedero_emp->monedero; echo $direccion; ?></span> )</h3>
	
	<!-- Main content -->
	<section class="content">

		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<div class="panel-body">
						
						<!--<div class="col-md-12">
							<div class="form-group">
								<label style="font-weight:bold">Cuenta</label><br>
								<select id="cuenta_id" class="form-control select2" <?php if ($pago[0]->estatus == 2){echo "disabled='disabled'";}?>>
									<?php foreach ($listar_cuentas as $cuentas) { ?>
										<option value="<?php echo $cuentas->codigo?>">
											<?php foreach ($listar_t_cuentas as $t_cuenta) { ?>
												<?php if ($t_cuenta->codigo == $cuentas->tipo_cuenta_id): ?>
													CTA. <?php echo $t_cuenta->descripcion?> 
											   <?php endif; ?>
											<?php }?>
											<?php foreach ($listar_bancos as $bancos) { ?>
												<?php if ($bancos->codigo == $cuentas->banco_id): ?>
													 <?php echo $bancos->descripcion?> 
											   <?php endif; ?>
											<?php }?>
											<?php echo $cuentas->descripcion?>
										</option>
									<?php }?>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label style="font-weight:bold">Tipo de Pago</label><br>
								<select id="tipo_pago" class="form-control select2" >
									<option value=1>DEPOSITO</option>
									<option value=2>TRANSFERENCIA</option>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label style="font-weight:bold">Nº Pago</label>
								<input type="text" placeholder="Ej: 011494191" maxlength="8" id="num_pago" value="<?php echo $pago[0]->num_pago ?>" class="form-control" >
							</div>
						</div>-->
						<div class="col-md-12">
							<div class="form-group">
								<label style="font-weight:bold">Dir. Monedero (desde la que realizó el pago)</label><br>
								<input type="text" placeholder="Ej: AxYz125cdJklmn14PqRs87Vwxy54Q7YcV4" maxlength="34" id="dir_monedero" value="<?php echo $pago[0]->dir_monedero ?>" class="form-control" >
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label style="font-weight:bold">Fecha</label>
								<input type="text" placeholder="Ej: 01/10/2016" maxlength="10" id="fecha_pago"
									value="<?php if ($pago[0]->fecha_pago != ''){
										$fe = explode('-',$pago[0]->fecha_pago);
										$fecha = $fe[2].'/'.$fe[1].'/'.$fe[0];
										echo $fecha;
										}
									?>" class="form-control" >
							</div><!-- /.form-group -->
						</div><!-- /.form-group -->
						<div class="col-md-4">
							<div class="form-group">
								<label style="font-weight:bold">Monto</label>
								<input type="text" placeholder="Ej: 50" maxlength="10" id="monto" disabled="disabled"  value="<?php echo $monto_pago ?>" class="form-control" >
							</div><!-- /.form-group -->
						</div><!-- /.form-group -->
						<div class="col-md-4">
							<div class="form-group">
								<label style="font-weight:bold">Estatus</label><br>
								<?php if ($pago[0]->estatus == 1) {?>
									<label style="font-weight:bold; color: blue">En verificación</label>
								<?php }else if ($pago[0]->estatus == 2){ ?>
									<label style="font-weight:bold; color: green">Aprobado</label>
								<?php }else if ($pago[0]->estatus == 99){ ?>
									<label style="font-weight:bold; color: grey">Pendiente</label>
								<?php } ?>
							</div><!-- /.form-group -->
						</div><!-- /.form-group -->
						<?php if ($pago[0]->estatus == 2){ ?>
						   <div class="col-md-4">
							<div class="form-group text-left">
								<a class="btn btn-app ver" data-toggle="tab" id="recibo_pago" >
									<i class="fa fa-file-pdf-o text-red "></i>
									Recibo de Pago
								</a>
							</div><!-- /.form-group -->
						</div><!-- /.form-group -->
						<?php } ?>
						<div class="col-md-12">
							<div class="form-group text-center">
								<br>
								<!--<button type="button" id="registrar_p" style="font-weight: bold;font-size: 13px" class="btn btn-info " >
									&nbsp;<span class="glyphicon glyphicon-floppy-disk"></span>&nbsp;Registrar
								</button>-->
								<input id="cod_perfil"  type='hidden' value="<?php echo $cod_perfil ?>" class="form-control" >
								<input id="cod_pago"  type='hidden' value="<?php echo $pago[0]->codigo ?>" class="form-control" >
								<input id="estatus"  type='hidden' value="<?php echo $pago[0]->estatus ?>" class="form-control" >
								<!--<input id="tipo_pago_id" type='hidden' value="<?php echo $pago[0]->tipo_pago ?>" class="form-control" >
								<input id="cuenta_pago_id" type='hidden' value="<?php echo $pago[0]->cuenta_id ?>" class="form-control" >-->
								<input id="base_url" type='hidden' value="<?php echo base_url(); ?>">
								<input id="reg_data_pago" type='hidden' value="0">
							</div><!-- /.form-group -->
						</div><!-- /.form-group -->
							
				</div><!-- /.box-body -->
			</div><!-- /.box-body-primary -->
		</div><!-- /.col -->
	</section><!-- /.content -->
	
	<!--<input type="button" name="previous" class="previous action-button" value="Previous"/>-->
	<input type="button" name="next" class="next action-button" id="info_pago" value="Siguiente"/>
</fieldset>
