

<div class="bg-primary ui-draggable ui-draggable-handle text-center" style="position: relative; font-weight: bold"><h4>Información personal</h4></div>			
	<div class="col-md-6">
		<div class="form-group">
			<label style="font-weight:bold">Nombre</label>
			<input type="text" placeholder="Nombre del usuario" maxlength="30" id="nombre" class="form-control input-sm" style="text-transform:uppercase; width: 100%"  onkeyup="javascript:this.value=this.value.toUpperCase();">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label style="font-weight:bold">Apellido</label>
			<input type="text" placeholder="Apellido del usuario" maxlength="30" id="apellido" class="form-control input-sm" style="text-transform:uppercase; width: 100%"  onkeyup="javascript:this.value=this.value.toUpperCase();" >
		</div>
	</div>
		<div class="col-sm-6">
		<div class="form-group">
			<label style="font-weight:bold; color: #513085">Fecha de nacimiento</label>
			<br>
			<select class="form-control select2" id="dia_nac_id" name="dia_nac_id" style="width: 25%">
				<option value="0">Dia</option>
				<?php foreach ($dias as $dia) { ?>
					<option value="<?php echo $dia?>"><?php echo $dia;?></option>
				 <?php }?> 
			</select>
			<select class="form-control select2" id="mes_nac_id" name="mes_nac_id" style="width: 42%">
				<option value="0">Mes</option>
				<option value="1">Enero</option>
				<option value="2">Febrero</option>
				<option value="3">Marzo</option>
				<option value="4">Abril</option>
				<option value="5">Mayo</option>
				<option value="6">Junio</option>
				<option value="7">Julio</option>
				<option value="8">Agosto</option>
				<option value="9">Septiembre</option>
				<option value="10">Octubre</option>
				<option value="11">Noviembre</option>
				<option value="12">Diciembre</option>
			</select>
			<select class="form-control select2" id="year_nac_id" name="year_nac_id" style="width: 30%">
				<option value="0">Dia</option>
				<?php foreach ($year as $years) { ?>
					<option value="<?php echo $years?>"><?php echo $years;?></option>
				 <?php }?> 
			</select>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label style="font-weight:bold; color: #513085">Lugar de nacimiento</label>
			<select class="form-control select2" id="pais_nac_id" name="pais_nac_id">
				<option value="0">Seleccione</option>
				<?php foreach ($listar_paises as $pais) { ?>
					<option value="<?php echo $pais->codigo;?>"><?php echo $pais->descripcion;?></option>
				 <?php }?> 
			</select>
		</div>
	</div>
<script>
 
    $('#monto2').numeric({allow: "."});
    

</script>
