<fieldset id="fieldset_personal" style="display:block">
	<h2 class="fs-title">REGISTRO DE BILLETERA PARA PAGOS</h2>
	<h3 class="fs-subtitle">Indique cuál es la dirección de Billetera en la cual usted desea recibir sus pagos</h3>
	
	<!-- Main content -->
	<section class="content">

		<div class="row">
			<div class="col-xs-12">

				<!-- SELECT2 EXAMPLE -->
				<div class="box box-primary">
					<div class="box-body">

						<div class="col-md-12">
							<div class="form-group">
								<label style="font-weight:bold">Dir. Monedero Personal</label>
								<input type="text" class="form-control" placeholder="Ej: AxYz125cdJklmn14PqRs87Vwxy54Q7YcV4" value="<?php echo $editar[0]->dir_monedero ?>" maxlength="34" id="dir_monedero_per" >
							</div>
						</div>
						
						<div class="col-md-4">
							<div class="form-group">
								<br>
								<!--<button type="button" id="agregar4" style="font-weight: bold;font-size: 13px" class="btn btn-info " >
									&nbsp;<span class="glyphicon glyphicon-floppy-disk"></span>&nbsp;Actualizar
								</button>-->
								<input id="cod_perfil"  type='hidden' value="<?php echo $cod_perfil ?>" class="form-control" >
								<input id="estatus_perfil"  type='hidden' value="<?php echo $estatus_perfil ?>" class="form-control" >
								<input id="tipo_cuenta_id_id" type='hidden' value="<?php echo $editar[0]->tipo_cuenta_id ?>" class="form-control" >
								<input id="cuenta_id_id" type='hidden' value="<?php echo $editar[0]->num_cuenta_usu ?>" class="form-control" >
								<input id="banco_usu_id_id" type='hidden' value="<?php echo $editar[0]->banco_usu_id ?>" class="form-control" >
								<input id="pais_id_id" type='hidden' value="<?php echo $usuario[0]->pais_id ?>" class="form-control" >
								<input id="patrocinador_id_id" type='hidden' value="<?php echo $usuario[0]->patrocinador_id ?>" class="form-control" >
								<input class="form-control"  type='hidden' id="usuario_id" name="usuario_id" value="<?php echo $usuario[0]->codigo ?>"/>
								<input id="base_url" type='hidden' value="<?php echo base_url(); ?>">
								<input id="reg_data_personal" type='hidden' value="0">
								<input id="dist_true" type='hidden' value="0">
							</div><!-- /.form-group -->
						</div><!-- /.form-group -->

					</div><!-- /.box-body -->
				</div><!-- /.box-body-primary -->
			</div><!-- /.col -->

	</section><!-- /.content -->
	
	<!-- Main content -->
	<section class="content" style="display:none;">

		<div class="row">
			<div class="col-xs-12">

				<!-- SELECT2 EXAMPLE -->
				<div class="box box-primary">
					<div class="box-body">
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
			</div><!-- /.col -->

	</section><!-- /.content -->
	
	<input type="button" name="next" class="next action-button" id="info_personal" value="Finalizar" />
	<input type="button" class="action-button cerrar_sesion" value="Cerrar Sesión"/>
</fieldset>
