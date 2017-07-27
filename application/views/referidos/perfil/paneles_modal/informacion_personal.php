<fieldset id="fieldset_personal" style="display:block">
	<h2 class="fs-title">Datos personales</h2>
	<h3 class="fs-subtitle">Indica tus datos personales</h3>
	
	<!-- Main content -->
	<section class="content">

		<div class="row">
			<div class="col-xs-12">

				<!-- SELECT2 EXAMPLE -->
				<div class="box box-primary">
					<div class="box-body">

						<div class="col-md-4">
							<div class="form-group">
								<label style="font-weight:bold">Cédula</label>
								<input type="text" placeholder="Cédula del usuario" value="<?php echo $usuario[0]->cedula ?>" maxlength="8" id="cedula" class="form-control">
							</div><!-- /.form-group -->
						</div><!-- /.form-group -->
						<div class="col-md-4">
							<div class="form-group">
								<label style="font-weight:bold">Nombre</label>
								<input type="text" placeholder="Nombre del usuario" value="<?php echo $usuario[0]->first_name ?>" maxlength="50" id="nombre" class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
							</div><!-- /.form-group -->
						</div><!-- /.form-group -->
						<div class="col-md-4">
							<div class="form-group">
								<label style="font-weight:bold">Apellido</label>
								<input type="text" placeholder="Apellido del usuario" value="<?php echo $usuario[0]->last_name ?>" maxlength="50" id="apellido" class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" >
							</div><!-- /.form-group -->
						</div><!-- /.form-group -->
						<div class="col-md-8">
							<div class="form-group">
								<label style="font-weight:bold">Correo</label>
								<input type="text" placeholder="Correo electrónico del usuario" value="<?php echo $usuario[0]->email ?>" maxlength="50" id="correo" class="form-control" >
							</div><!-- /.form-group -->
						</div><!-- /.form-group -->
						<div class="col-md-4">
							<div class="form-group">
								<label style="font-weight:bold">Telefono</label>
								<input type="text" class="form-control" placeholder="(0243) 999-9999" value="<?php echo $usuario[0]->telefono ?>" id="telefono" data-inputmask='"mask": "(9999) 999-9999"' data-mask>
							</div><!-- /.form-group -->
						</div><!-- /.form-group -->
						<div class="col-md-12">
							<div class="form-group">
								<label style="font-weight:bold">Dir. Monedero Personal</label>
								<input type="text" class="form-control" placeholder="Ej: AxYz125cdJklmn14PqRs87Vwxy54Q7YcV4" value="<?php echo $editar[0]->dir_monedero ?>" maxlength="34" id="dir_monedero_per" >
							</div><!-- /.form-group -->
						</div><!-- /.form-group -->

						<!--<div class="col-md-4">
							<div class="form-group">
								<label style="font-weight:bold">Tipo de cuenta</label>
								<select id="tipo_cuenta_id" class="form-control select2">
									<option value=0>SELECCIONE</option>
									<?php foreach ($listar_t_cuentas as $tipo) { ?>
										<option value="<?php echo $tipo->codigo?>"><?php echo $tipo->descripcion?></option>
									<?php }?>
								</select>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label style="font-weight:bold">Número de cuenta</label>
								<input type="text" placeholder="Introdúzca el número de la cuenta" maxlength="20" id="num_cuenta_usu" value="<?php echo $editar[0]->num_cuenta_usu ?>" class="form-control" >
							</div>
						</div>
						
						<div class="col-md-4">
							<div class="form-group">
								<label style="font-weight:bold">Banco</label>
								<select id="banco_usu_id" class="form-control select2" >
									<option value=0>SELECCIONE</option>
									<?php foreach ($listar_bancos as $banco) { ?>
										<option value="<?php echo $banco->codigo?>"><?php echo $banco->descripcion?></option>
									<?php }?>
								</select>
							</div>
						</div>-->
						
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
								<input class="form-control"  type='hidden' id="usuario_id" name="usuario_id" value="<?php echo $usuario[0]->codigo ?>"/>
								<input id="base_url" type='hidden' value="<?php echo base_url(); ?>">
								<input id="reg_data_personal" type='hidden' value="0">
							</div><!-- /.form-group -->
						</div><!-- /.form-group -->

					</div><!-- /.box-body -->
				</div><!-- /.box-body-primary -->
			</div><!-- /.col -->

	</section><!-- /.content -->
	
	<input type="button" name="next" class="next action-button" id="info_personal" value="Siguiente" />
</fieldset>
