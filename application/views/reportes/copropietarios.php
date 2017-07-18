<?php
if (isset($this->session->userdata['logged_in'])) {
$username = ($this->session->userdata['logged_in']['username']);
$email = ($this->session->userdata['logged_in']['email']);
$tipouser = ($this->session->userdata['logged_in']['tipo_usuario']);
} else {
redirect(base_url());
}
?>
  
<?php if ($tipouser == 'Administrador'){
	
 } else {
    redirect(base_url());
 }?>   
<div class="wrapper">
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" style="min-height: 1156px;">
          <br/>
        <br/>
        <br/>
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Pagos
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> Inicio</a></li>
            <li>Procesos</li>
            <li class="active">Pagos</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              
          
              <div class="box box-primary">
                <div class="box-header" style="text-align: center">
                  <h3 >Reportes Por Copropietarios</h3>
                  
                  <div class="col-md-12" style="text-align: center">
                      <div class="col-md-3 " style="text-align: center">
                      </div>
                      <div class="col-md-3 " style="text-align: center">
                        <div class="info-box bg-yellow ">
                          <a>
                            <span class="info-box-icon">
                              <i class="fa fa-file-pdf-o " style="color: white"></i>
                            </span>
                            <div class="info-box-content " style="color: white">
                                <span style="font-weight: bold">Analisis de cuenta</span>
                                <span> Resumen de pagos realizados por un propietario </span>
                            </div>
                          </a>
                        </div>
                      </div>
                      <div class="col-md-3 " style="text-align: center">
                        <div class="info-box bg-yellow ">
                          <a>
                            <span class="info-box-icon">
                              <i class="fa fa-file-pdf-o" style="color: white"></i>
                            </span>
                            <div class="info-box-content" style="color: white">
                                <span style="font-weight: bold">Estado de cuenta</span>
                                <span> Resumen de pagos en base a un rango de fecha  </span>
                            </div>
                          </a>
                        </div>
                      </div>
                  </div>

                  <br>
                  <h3 >Reportes Por Inmuebles</h3>
                  <div class="col-md-12" style="text-align: center">
                      <div class="col-md-3 " style="text-align: center">
                        <div class="info-box bg-green ">
                          <a>
                            <span class="info-box-icon">
                              <i class="fa fa-file-pdf-o" style="color: white"></i>
                            </span>
                            <div class="info-box-content" style="color: white">
                                <span style="font-weight: bold">Deuda Total</span>
                                <span> Resumen de Deuda Total en base a un rango de fecha </span>
                            </div>
                          </a>
                        </div>
                      </div>
                      <div class="col-md-3 " style="text-align: center">
                        <div class="info-box bg-green ">
                          <a>
                            <span class="info-box-icon">
                              <i class="fa fa-file-pdf-o" style="color: white"></i>
                            </span>
                            <div class="info-box-content" style="color: white">
                                <span style="font-weight: bold">Gastos</span><br>
                                <span> Resumen de gastos en base a un rango de fecha </span>
                            </div>
                          </a>
                        </div>
                      </div>
                      <div class="col-md-3 " style="text-align: center">
                        <div class="info-box bg-green ">
                          <a>
                            <span class="info-box-icon">
                              <i class="fa fa-file-pdf-o" style="color: white"></i>
                            </span>
                            <div class="info-box-content" style="color: white">
                                <span style="font-weight: bold">Ingresos</span><br>
                                <span> Resumen de Ingresos en base a un rango de fecha </span>
                            </div>
                          </a>
                        </div>
                      </div>
                      <div class="col-md-3 " style="text-align: center">
                        <div class="info-box bg-green ">
                          <a>
                            <span class="info-box-icon">
                              <i class="fa fa-file-pdf-o" style="color: white"></i>
                            </span>
                            <div class="info-box-content" style="color: white">
                                <span style="font-weight: bold">Pagos</span><br>
                                <span> Resumen de Pagos en base a un rango de fecha </span>
                            </div>
                          </a>
                        </div>
                      </div>
                  </div>
                  
                  <br>
                  <h3 >Reportes Internos de la Empresa</h3>
                  <div class="col-md-12" style="text-align: center">
                      <div class="col-md-3 " style="text-align: center">
                        <div class="info-box bg-red ">
                          <a>
                            <span class="info-box-icon">
                              <i class="fa fa-file-text-o" style="color: white"></i>
                            </span>
                            <div class="info-box-content" style="color: white">
                                <span style="font-weight: bold">Bancos</span><p>
                                <span>Listado de Bancos registrados</span>
                            </div>
                          </a>
                        </div>
                      </div>
                      <div class="col-md-3 " style="text-align: center">
                        <div class="info-box bg-red ">
                          <a>
                            <span class="info-box-icon">
                              <i class="fa fa-file-text-o" style="color: white"></i>
                            </span>
                            <div class="info-box-content" style="color: white">
                                <span style="font-weight: bold">Conceptos</span><br>
                                <span>Listado de Conceptos registrados</span>
                            </div>
                          </a>
                        </div>
                      </div>
                      <div class="col-md-3 " style="text-align: center">
                        <div class="info-box bg-red ">
                          <a>
                            <span class="info-box-icon">
                              <i class="fa fa-file-text-o" style="color: white"></i>
                            </span>
                            <div class="info-box-content" style="color: white">
                                <span style="font-weight: bold">Inmuebles</span><br>
                                <span>Listado de Inmuebles registrados</span>
                            </div>
                          </a>
                        </div>
                      </div>
                      <div class="col-md-3 " style="text-align: center">
                        <div class="info-box bg-red ">
                          <a>
                            <span class="info-box-icon">
                              <i class="fa fa-file-text-o" style="color: white"></i>
                            </span>
                            <div class="info-box-content" style="color: white">
                                <span style="font-weight: bold">Tipos de Inmuebles</span>
                                <span>Listado de Tipos de Inmuebles registrados</span>
                            </div>
                          </a>
                        </div>
                      </div>


                  </div>


                </div><!-- /.box-header -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0.0
        </div>
         <img  src="<?= base_url() ?>/static/img/footer.png"/>
      </footer>
</div><!-- /wrapper -->
    

   
    <script>

 
    
      
   $(".generar").click(function (e) {
     e.preventDefault();  // Para evitar que se envíe por defecto
     var id = this.getAttribute('id');
     //alert(id)
     URL = '<?php echo base_url(); ?>index.php/procesos/pagos/CPagos/pdf_ficha_inmueble/' + id + '';
	    $.fancybox.open({ padding : 0, href: URL, type: 'iframe',width: 860, height: 520});
   });
     // Validacion para borrar
            $("table#tab_inmuebles").on('click', 'a.borrar', function (e) {
                e.preventDefault();
                var id = this.getAttribute('id');
                //alert(id)

                bootbox.dialog({
                    message: "¿Desea eliminar este inmueble?",
                    title: "Borrar registro",
                    buttons: {
                        success: {
                            label: "Descartar",
                            className: "btn-primary",
                            callback: function () {

                            }
                        },
                        danger: {
                            label: "Procesar",
                            className: "btn-warning",
                            callback: function () {
                                //alert(id)
                                $.post('<?php echo base_url(); ?>index.php/procesos/pagos/CPagos/eliminar/' + id + '', function (response) {
                                    
                                    if (response[0] == "e") {

                                        bootbox.alert("Disculpe, el inmueble que desea eliminar se encuentra asociado", function () {
                                        }).on('hidden.bs.modal', function (event) {
                                        });

                                    } else {
                                        bootbox.alert("Se elimino con exito", function () {
                                        }).on('hidden.bs.modal', function (event) {
                                            url = '<?php echo base_url(); ?>index.php/procesos/pagos/CPagos';
                                            window.location = url;
                                        });
                                    }
                                });
                            }
                        }
                    }
                });
            });
            
            $('#enviar').click(function () {
                url = '<?php echo base_url() ?>index.php/procesos/pagos/CPagos/registrar';
                window.location = url;
            });


            
         //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].activar_desactivar, input[type="radio"].activar_desactivar').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });

	
	
	// Función para activar/desactivar un usuario
	$("table#tab_inmuebles").on('ifChanged', 'input.activar_desactivar', function (e) {
		e.preventDefault();

		var id = this.getAttribute('id');
		//alert(id)
		
		var check = $(this);
		
		//alert(check.prop('checked'));
		
		var accion = '';
		if (check.is(':checked')) {
            accion = 'activar';
        }else{
			accion = 'desactivar';
		}

		bootbox.confirm("¿Desea "+accion+" este inmueble?", function(result) {
			if (result) {
				$("#motivo_anulacion").val('');
				$("#accion").val(accion);
				
				var mensaje = "";
				if (accion == 'desactivar'){
					mensaje = "desactivado";
				}else{
					mensaje = "activado";
				}

				$.post('<?php echo base_url(); ?>index.php/procesos/pagos/CPagos/activar_desactivar/' + id, {'accion':accion}, function(response) {
					bootbox.alert("La Recibo fue "+mensaje+" exitosamente", function () {
					}).on('hidden.bs.modal', function (event) {
						location.reload();
					});
				})
				
			}
		}); 
	   
	   
	});
        
        
        
       

 
     

    </script>
