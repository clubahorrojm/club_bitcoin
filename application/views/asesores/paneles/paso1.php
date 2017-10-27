<div class="bg-yellow ui-draggable ui-draggable-handle text-center" style="position: relative; font-weight: bold"><h4>Documentos de Identidad</h4></div>
	<div class="col-sm-6">
		<div class="form-group">
			<label style="font-weight:bold; color: #513085">País</label>
			<select class="form-control select2" id="pais_doc_id"  name="pais_doc_id">
				<option value="0">Seleccione</option>
				<?php foreach ($listar_paises as $pais) { ?>
					<option value="<?php echo $pais->codigo;?>"><?php echo $pais->descripcion;?></option>
				 <?php }?> 
			</select>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label style="font-weight:bold">Número del documento</label>
			<input type="text" placeholder="N° de serie del documento de identidad" maxlength="20" id="num_documento" name="num_documento" class="form-control " style="text-transform:uppercase; width: 100%" onkeyup="javascript:this.value=this.value.toUpperCase();">
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label style="font-weight:bold; color: #513085">Tipo de Documento</label>
			<select class="form-control select2" id="tipo_doc_id" maxlength="7" name="tipo_doc_id">
				<option value="0">Seleccione</option>
				<option value="1">Pasaporte</option>
				<option value="2">Tarjeta de Identidad</option>
				<option value="3">Licencia de Conducir</option>
			</select>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label style="font-weight:bold; color: #513085">Fecha de emisión del documento</label>
			<br>
			<select class="form-control select2" id="dia_doc_id" name="dia_doc_id" style="width: 25%">
				<option value="0">Dia</option>
				<?php foreach ($dias as $dia) { ?>
					<option value="<?php echo $dia?>"><?php echo $dia;?></option>
				 <?php }?> 
			</select>
			<select class="form-control select2" id="mes_doc_id" name="mes_doc_id" style="width: 42%">
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
			<select class="form-control select2" id="year_doc_id" maxlength="7" name="year_doc_id" style="width: 30%">
				<option value="0">Año</option>
				<?php foreach ($year as $years) { ?>
					<option value="<?php echo $years?>"><?php echo $years;?></option>
				 <?php }?> 
			</select>
		</div>
	</div>
<script>
    $('#monto').numeric({allow: "."});
   

</script>
