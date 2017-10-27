

<div class="bg-green ui-draggable ui-draggable-handle text-center" style="position: relative; font-weight: bold"><h4>Registro de Direcciones</h4></div>
	<div class="col-sm-6">
		<div class="form-group text-center">
			<h4 style="font-weight:bold; color: #513085">Residencia Actual</h4>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group text-center">
			<h4 style="font-weight:bold; color: #513085">Residencia Permanente</h4>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label style="font-weight:bold; color: #513085">País</label>
			<select class="form-control select2" id="pais_res_act_id" name="pais_res_act_id">
				<option value="0">Seleccione</option>
				<?php foreach ($listar_paises as $pais) { ?>
					<option value="<?php echo $pais->codigo;?>"><?php echo $pais->descripcion;?></option>
				 <?php }?> 
			</select>
		</div>
	</div>
	
	<div class="col-sm-6">
		<div class="form-group">
			<label style="font-weight:bold; color: #513085">País</label>
			<select class="form-control select2" id="pais_res_per_id" name="pais_res_per_id">
				<option value="0">Seleccione</option>
				<?php foreach ($listar_paises as $pais) { ?>
					<option value="<?php echo $pais->codigo;?>"><?php echo $pais->descripcion;?></option>
				 <?php }?> 
			</select>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label style="font-weight:bold">Código postal</label>
			<input type="text" placeholder=""  maxlength="10" id="cod_postal_act" class="form-control input-sm" style="text-transform:uppercase; width: 100%"  onkeyup="javascript:this.value=this.value.toUpperCase();">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label style="font-weight:bold">Código postal</label>
			<input type="text" placeholder=""  maxlength="10" id="cod_postal_per" class="form-control input-sm" style="text-transform:uppercase; width: 100%" onkeyup="javascript:this.value=this.value.toUpperCase();">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label style="font-weight:bold">Ciudad</label>
			<input type="text" placeholder=""  maxlength="30" id="ciudad_act" class="form-control input-sm" style="text-transform:uppercase; width: 100%" onkeyup="javascript:this.value=this.value.toUpperCase();">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label style="font-weight:bold">Ciudad</label>
			<input type="text" placeholder=""  maxlength="30" id="ciudad_per" class="form-control input-sm" style="text-transform:uppercase; width: 100%" onkeyup="javascript:this.value=this.value.toUpperCase();">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label style="font-weight:bold">Avenida / Calle</label>
			<input type="text" placeholder=""  maxlength="30" id="calle_act" class="form-control input-sm" style="text-transform:uppercase; width: 100%" onkeyup="javascript:this.value=this.value.toUpperCase();">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label style="font-weight:bold">Avenida / Calle</label>
			<input type="text" placeholder=""  maxlength="30" id="calle_per" class="form-control input-sm" style="text-transform:uppercase; width: 100%" onkeyup="javascript:this.value=this.value.toUpperCase();">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label style="font-weight:bold">Apartamento / Casa</label>
			<input type="text" placeholder=""  maxlength="10" id="casa_act" class="form-control input-sm" style="text-transform:uppercase; width: 100%" onkeyup="javascript:this.value=this.value.toUpperCase();">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label style="font-weight:bold">Apartamento / Casa</label>
			<input type="text" placeholder=""  maxlength="10" id="casa_per" class="form-control input-sm" style="text-transform:uppercase; width: 100%" onkeyup="javascript:this.value=this.value.toUpperCase();">
		</div>
	</div>
<script>
    
    $('#monto3').numeric({allow: "."});
</script>
