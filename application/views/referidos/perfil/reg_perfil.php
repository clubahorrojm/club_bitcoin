<head>
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>static/css/progress.css">
	<script src="<?= base_url() ?>static/js/progress.js"></script>
</head>
<body>
	
	<!--
	Cambie el tamaño del modal añadiendo la clase .modal-sm para los modales pequeños o la clase .modal-lg para los modales grandes.
	Agregue la clase de tamaño al elemento <div> con la clase .modal-dialog:
	-->
	<div class="modal" id="modal_registrar" data-backdrop="static">
	   <div class="modal-dialog modal-lg" style="height:auto">
		  <div class="modal-content">
			 <div class="modal-header" style="background-color:#296293;color:#fff">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">
				   <center>
				   &nbsp;Introdúzca los siguientes datos para completar su perfil</center>
				</h4>
			 </div>
			 <div class="modal-body">
				 <!-- multistep form -->
				<form id="msform">
				  <!-- progressbar -->
				  <ul id="progressbar">
					<li id="progressbar_pago">Información del pago</li>
					<li id="progressbar_personal">Información Personal</li>
					<!--<li id="progressbar_distribucion">Distribución de capital</li>-->
					<li id="progressbar_finalizar">Finalizar</li>
					<!--<li>Retiros</li>-->
				  </ul>
				  <!-- fieldsets -->
				  <?php include("paneles_modal/pagos.php");?>
				  <?php include("paneles_modal/informacion_personal.php");?>
				  <?php //include("paneles_modal/distribucion.php");?>
				  <?php include("paneles_modal/finalizado.php");?>
				  <input type="hidden" id="id_user" value="<?php echo $this->session->userdata['logged_in']['id'];?>"/>
				  <input id="latitud" type="hidden"/>
					<input id="longitud" type="hidden"/>
					<input id="tipo_user" type="hidden" value="<?php echo $this->session->userdata['logged_in']['tipo_usuario'];?>"/>
				</form>
			 </div>
			 
		  </div>
	   </div>
	</div>

</body>
