<fieldset id="fieldset_distribucion" style="display:block">
	<h2 class="fs-title">Distribución de capital</h2>
	<h3 class="fs-subtitle">Distribuya su Capital</h3>
	
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
			</div><!-- /.col -->

	</section><!-- /.content -->
	
	<input type="button" name="next" class="next action-button" id="distribucion" value="Siguiente" />
</fieldset>
