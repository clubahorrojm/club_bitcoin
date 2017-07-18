    <?php
    if (isset($this->session->userdata['logged_in'])) {
        $username = ($this->session->userdata['logged_in']['username']);
        $email = ($this->session->userdata['logged_in']['email']);
        $id_user = ($this->session->userdata['logged_in']['id']);
    } else {
        header("location: login");
    }
    ?>

        <script>
            $(document).ready(function () {

                

                $('select').on({
                    change: function () {
                        $(this).parent('div').removeClass('has-error');
                    }
                });
                $('input').on({
                    keypress: function () {
                        $(this).parent('div').removeClass('has-error');
                    }
                });

                $("select").select2();
                $("#desde").numeric({allow: "/"}); //Valida solo permite valores numéricos
                $("#hasta").numeric({allow: "/"}); //Valida solo permite valores numéricos
                //~ $('#email').alphanumeric({allow: "@-_."});
                
                $('#desde').datepicker({
					format: "dd/mm/yyyy",
					endDate: 'today',
					minDate: "-1D",
					maxDate: "-1D",
					language: "es",
					autoclose: true,
				})
				
				$('#hasta').datepicker({
					format: "dd/mm/yyyy",
					endDate: 'today',
					minDate: "-1D",
					maxDate: "-1D",
					language: "es",
					autoclose: true,
				})
                
                // Función para validar por nombre si ya existe el tipo de servicio
                //~ $("#tipo_servicio").change(function (event) {
//~ 
                    //~ var tipo_servicio = $('#tipo_servicio').val();
                    //~ $.post('<?php echo base_url(); ?>index.php/tipo_servicio/ControllersTipoServicio/consultar/', $('#form_tiposervicio').serialize(), function (response) {
						//~ if (response[0] == 'e') {
							//~ bootbox.alert("El tipo de servicio ya existe", function () {
							//~ }).on('hidden.bs.modal', function (event) {
								//~ $('#tipo_servicio').parent('div').addClass('has-error');
								//~ $('#tipo_servicio').val('');
								//~ $('#tipo_servicio').focus();
							//~ });
						//~ }
//~ 
					//~ });
                //~ });
                
                // Función para validar por nombre si ya existe el tipo de servicio
                $("#desde,#hasta").change(function (event) {
					
                });

                $("#generar").click(function (e) {
                    e.preventDefault();  // Para evitar que se envíe por defecto
                    
                    if($('#usuario').val().trim() == '' && $('#desde').val().trim() == '' && $('#hasta').val().trim() == ''){
						bootbox.alert("Debe indicar algún parámetro de búsqueda", function () {
						}).on('hidden.bs.modal', function (event) {
							$('#usuario').parent('div').addClass('has-error');
							$('#desde').parent('div').addClass('has-error');
							$('#hasta').parent('div').addClass('has-error');
						});
					}else if(($('#desde').val().trim() != '' && $('#hasta').val().trim() == '') || ($('#desde').val().trim() == '' && $('#hasta').val().trim() != '')){
						bootbox.alert("Debe completar el rango de fechas", function () {
						}).on('hidden.bs.modal', function (event) {
							$('#usuario').parent('div').addClass('has-error');
							$('#desde').parent('div').addClass('has-error');
							$('#hasta').parent('div').addClass('has-error');
						});
					}else{
						
						var usuario = $('#usuario').val().trim();
						var desde = $('#desde').val().trim();
						var hasta = $('#hasta').val().trim();
						
						if (usuario == ""){
							usuario = "xxx";
						}
						if(desde == "" && hasta == ""){
							desde = "xxx";
							hasta = "xxx";
						}else{
							desde = desde.split("/");
							desde = desde[2]+"-"+desde[1]+"-"+desde[0];
							hasta = hasta.split("/");
							hasta = hasta[2]+"-"+hasta[1]+"-"+hasta[0];
						}
						//~ alert("Generar PDF");
						//~ alert("Usuario: "+usuario+", Desde: "+desde+", Hasta: "+hasta);
						
						// Función para validar si hay registros para la búsqueda especificada
		
						$.post('<?php echo base_url(); ?>index.php/auditoria/CAuditoria/obtenerAuditorias/' + usuario + '/' + desde + '/' + hasta + '', function (response) {
							//~ alert(response);
							if (response[1] == '0') {
								bootbox.alert("No hay registros para la consulta especificada", function () {
								}).on('hidden.bs.modal', function (event) {
									
								});
							}else{
								URL = '<?php echo base_url(); ?>index.php/auditoria/CAuditoria/pdf_auditoria/' + usuario + '/' + desde + '/' + hasta + '';
								$.fancybox.open({ padding : 0, href: URL, type: 'iframe',width: 1024, height: 860, });
							}
						});
                        
                    } 
                });


			});


		</script>
    </head>
    <body>

        </br>
        </br>
        </br>
        </br>
        </br>
        </br>

        <div class="row-fluid text-center" >
            <div class="mainbody-section">


                <div class="container" style="width:90%;">
                    <div class="row">

                        </br>

                        <div class="col-lg-12">
                            <div class="well bs-component">
				<div class="box-body">
                                <form class="form-horizontal" id="form_tiposervicio">
                                    <fieldset>
                                        <legend>Generar Reporte de Auditoría</legend>
                                           <br/>
                                        <div class="form-group">
                                            <div class="col-xs-1">Usuario</div>
                                            <div class="col-lg-5">
                                                <select class="form-control" autofocus="" id="usuario" maxlength="7" name="usuario">
													<option value="">Seleccione</option>
													<?php foreach ($usuarios as $usuario) { ?>
														<option value="<?php echo $usuario->id;?>"><?php echo $usuario->username;?></option>
													<?php }?>
												</select>
                                            </div>
											<div class="col-xs-1" >Desde</div>
                                            <div class="col-lg-2">
                                               	<input class="form-control" type='text' placeholder="Fecha de inicio" id="desde" name="desde" maxlength="10"/>
                                            </div>
											<div class="col-xs-1" >Hasta</div>
                                            <div class="col-lg-2">
                                               	<input class="form-control" type='text' placeholder="Fecha Final" id="hasta" name="hasta" maxlength="10"/>
                                            </div>
                                        </div>
   
                                        <br/>

                                        <div class="form-group">
                                            <div class="col-lg-12">
												<!--<input class="form-control"  type='hidden' placeholder="user" id="user_create_id" name="user_create_id" value="<?php echo $id_user ?>"/>-->
<!--
												<input class="form-control"  type='hidden' id="rango" name="rango"/>
-->
                                                <button type="submit" id="generar" style="font-weight: bold;font-size: 13px" class="btn btn-danger"/>
                                                &nbsp;<span class="glyphicon glyphicon-file"></span>&nbsp;Generar
                                                </button>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
			    </div>
                                <div class="btn btn-primary btn-xs" id="source-button" style="display: none;">&lt; &gt;</div></div>
                        </div>

                    </div>
                </div>

            </div>
        </div>



    </body>
</html>

<div id='footer' style='text-align:center; margin-left: 20%'>
    <img style="width: 100%;" src="<?= base_url() ?>/static/img/footer.png"/>
</div>
</body>
</html>




