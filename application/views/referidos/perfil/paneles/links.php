<?php
if (isset($this->session->userdata['logged_in'])) {
    $username = ($this->session->userdata['logged_in']['username']);
    $email = ($this->session->userdata['logged_in']['email']);
    $tipouser = 'Administrador';
    $id_user = ($this->session->userdata['logged_in']['id']);
} else {
    redirect(base_url());
}
?>

<?php
if ($tipouser == 'Administrador') {
    
} else {
    redirect(base_url());
}
?>
<div class="wrapper">

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height: 1156px;">
        <br/>
        <br/>
        <br/>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 style="color:#3C8DBC">
                Invitados
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>index.php"  style="color:#3C8DBC"><i class="fa fa-home"></i> Inicio</a></li>
                <li class="active">Links de invitación</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <!-- SELECT2 EXAMPLE -->
                    <div class="box box-primary">

                        <div class="box-body">
                            <div class="col-md-3 text-center">
                                <img style="width: 80%" src="<?= base_url() ?>static/img/logo4.png"/>
                                <label style="color:#001A5A" >nro. de usuario: <?php echo str_pad($editar[0]->codigo, 5, '0',STR_PAD_LEFT) ?></label>
                            </div><!-- /.form-group -->
                            <div class="col-md-8" style="width: 50%">
                                <br><br>
                                <canvas id="canvas" height="100" width="250"></canvas>
                            </div>
                            <div class="col-md-1"> </div><!-- /.form-group -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box-body-primary -->

                     <!-- PESTAÑAS -->
                    <div class="col-xs-8">
                        <div class="box box-primary">
                            <table id="tab_rel_links" class="table table-bordered table-striped table-hover table-condensed dt-responsive table-responsive">
                                <thead>
                                    <tr style="background-color: #001a5a">
                                        <th style='text-align: center; color: white'>Acción</th>
                                        <th style='text-align: center; color: white'>Links</th>
                                    </tr>
                                </thead>
                                <tbody >       
                                    <?php $i = 1; ?>
                                    <?php foreach ($listar_links as $links) { ?>
                                    <tr style="font-size: 16px;text-align: center" class="{% cycle 'impar' 'par' %}" >
                                        <td>
											<a title="Copiar" onclick="copiarAlPortapapeles('<?php echo 'input'.$i; ?>')"><img src="<?= base_url() ?>static/img/copiar.png" style="width: 40%;" /></a>
										</td>
                                        <td>
											<p id="input<?php echo $i; ?>"><?php echo $links->links; ?></p>
										</td>
                                    </tr>
                                    <?php $i++ ?>
                                    <?php } ?>
                                </tbody>
                            </table>    
                        </div><!-- /.box-body -->
                    </div><!-- /.box-body-primary -->
                    <div class="col-xs-4">
                        <div class="box box-primary">
                            <table id="tab_rel_distribucion" class="table table-bordered table-striped table-hover table-condensed dt-responsive table-responsive">
								<thead>
                                    <tr style="background-color: #001a5a">
										<th style='text-align: center; color: white'>Nivel</th>
										<th style='text-align: center; color: white'>Número de invitados</th>
									</tr>
								</thead>
								<tbody >       
									<?php $i = 1; ?>
									<?php foreach (range(0, 6) as $padres) { ?>
									<tr style="font-size: 16px;text-align: center" class="{% cycle 'impar' 'par' %}" >
										<td><img id="nivel" class="img-circle" src="<?= base_url() ?>static/img/iconos_medianos/Nivel <?php echo $i; ?>.png" style="width: 75%;"  /></td>
										<td><?php echo pow(5, $i) ?></td>
									</tr>
									<?php $i++ ?>
									<?php } ?>
								</tbody>
							</table>
                            <br>
                        </div><!-- /.box-body -->
                    </div><!-- /.box-body-primary -->


                </div><!-- /.col -->
                    
                    
                   
                    

            </div><!-- /.col -->
            
        
                
                
                
                
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
    </footer>



<script>
    
	function copiarAlPortapapeles(id_elemento) {
		// Crea un campo de texto "oculto"
		var aux = document.createElement("input");
	  
		// Asigna el contenido del elemento especificado al valor del campo
		aux.setAttribute("value", document.getElementById(id_elemento).innerHTML);
	  
		// Añade el campo a la página
		document.body.appendChild(aux);
	  
		// Selecciona el contenido del campo
		aux.select();
	  
		// Copia el texto seleccionado
		document.execCommand("copy");
	  
		// Elimina el campo de la página
		document.body.removeChild(aux);
	}
	


    var Tusuarios = $('#tab_rel_distribucion').dataTable({
        "paging": false,
        "lengthChange": false,
        "autoWidth": false,
        "searching": false,
        "ordering": true,
        "info": false,
        "iDisplayLength": 10,
        "iDisplayStart": 0,
        "sPaginationType": "full_numbers",
        "aLengthMenu": [5,10,15],
        "oLanguage": {"sUrl": "<?= base_url() ?>/static/js/es.txt"},
        "decimal": ",",
        "thousands": ".",
        "aoColumns": [
            {"sClass": "registro center", "sWidth": "1%"},
            {"sClass": "registro center", "sWidth": "15%"},
        ],        
    });
    
    var Tusuarios = $('#tab_rel_links').dataTable({
        "paging": true,
        "lengthChange": false,
        "autoWidth": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "iDisplayLength": 8,
        "iDisplayStart": 0,
        "sPaginationType": "full_numbers",
        "aLengthMenu": [5,10,15],
        "oLanguage": {"sUrl": "<?= base_url() ?>/static/js/es.txt"},
        "decimal": ",",
        "thousands": ".",
        "aoColumns": [
            {"sClass": "registro center", "sWidth": "1%"},
            {"sClass": "registro center", "sWidth": "15%"},
        ],        
    });
    var barChartData = {
        labels : ["Nivel 1","Nivel 2","Nivel 3","Nivel 4","Nivel 5","Nivel 6","Nivel 7"],
        datasets : [
            {// numero de referidos
                fillColor : "#c3b01c",
                strokeColor : "#c3b01c",
                highlightFill : "#e0d36d",
                highlightStroke : "#e0d36d",
                data : [8,22,53],
            }
        ]

    };
    window.onload = function(){
        var ctx = document.getElementById("canvas").getContext("2d");
        window.myBar = new Chart(ctx).Bar(barChartData, {
            responsive : true
        });
    };
     
    $.post('<?php echo base_url(); ?>index.php/User_Authentication/cargar_grafica_referidos/', function(response) {
        var lista = response;
        alert(lista);
    	var barChartData = {
            labels : ["Nivel 1","Nivel 2","Nivel 3","Nivel 4","Nivel 5","Nivel 6","Nivel 7"],
            datasets : [
                {// numero de referidos
                    fillColor : "#c3b01c",
                    strokeColor : "#c3b01c",
                    highlightFill : "#e0d36d",
                    highlightStroke : "#e0d36d",
                    data : lista,
                }
            ]
    
        };
        window.onload = function(){
            var ctx = document.getElementById("canvas").getContext("2d");
            window.myBar = new Chart(ctx).Bar(barChartData, {
                responsive : true
            });
        };
    }, 'json');


    
    
    $('input').on({
        keypress: function () {
            $(this).parent('div').removeClass('has-error');
        }
    });
    $('select').on({
        change: function () {
            $(this).parent('div').removeClass('has-error');
        }
    });

    
    $('#generar_links').click(function(e){
        e.preventDefault();
        //Para validar campos vacios
        usuario_id = $('#usuario_id').val()
        $.post('<?php echo base_url(); ?>index.php/referidos/CRelLinks/guardar',
               $.param({'usuario_id': usuario_id}), function (response){
                // alert(response[0])
                if (response[0] == 1) {
                    bootbox.alert("Disculpe, ya generó sus links de invitación", function () {
                    }).on('hidden.bs.modal', function (event) {
                        $("#monto_retiro").parent('div').addClass('has-error')
                        $("#monto_retiro").focus();
                    });
                } else {
                    bootbox.alert("Sus link han sido generados satisfactoriamente", function (){
                        window.location = '<?php echo base_url(); ?>index.php/referidos/CRelLinks/'
                    });
                }
            
        });
    })

</script>
