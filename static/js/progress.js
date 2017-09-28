$(document).ready(function () {
	
	base_url = $("#base_url").val();  // url base del sistema
	user_id = $("#user_id").val();  // url base del sistema
	
	//~ // Soporte para tipos de cambio sobre bitcoins (dólares en este caso) usando la api de blockchain Exchange Rates API
	//~ $.post('https://blockchain.info/ticker', function (response) {
		//~ var convert3;
				//~ 
		//~ // Colocamos los valores actuales de conversión entre dólares y bitcoins y viceversa en la modal de pago
		//~ convert3 = 1 / parseFloat(response['USD']['last']);
		//~ $('#precio_bitcoin').text('1 $  =  '+convert3.toFixed(6)+' ฿    -    '+'1 ฿  =  '+parseFloat(response['USD']['last'])+' $');
	//~ }, 'json');
	
	$("#modal_registrar").modal('show');
	
	// Configuración de campos
	$('#fecha_na').numeric({allow: "/"});
	$('#fecha_pago').numeric({allow: "/"});
    $('#dir_monedero').alphanumeric();
    $('#dir_monedero_per').alphanumeric();
    $('#cedula').numeric();
    $('#num_pago').numeric();
    $('#num_cuenta_usu').numeric();
    $('#monto').numeric({allow: "."});
    $("[data-mask]").inputmask();
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
    $('#fecha_pago').datepicker({
        format: "dd/mm/yyyy",
        language: "es",
        autoclose: true,
    })
    $('#fecha_na').datepicker({
        format: "dd/mm/yyyy",
        language: "es",
        autoclose: true,
    })
    
    //~ // Carga del cronómetro de registro y validación de cuando éste llegue a cero
    //~ regCoord = setTimeout(function(){
		//~ // alert($("#progressbar_pago").attr('class'));
		//~ if($("#progressbar_pago").attr('class') == "active"){
			//~ $("#CountDownTimer").TimeCircles({ time: { Days: { show: false }, Hours: { show: false },  }});
		//~ }
	//~ }, 3000);
    //~ 
    //~ var v_t = setInterval(function(){
		//~ var get_minutes = $("#CountDownTimer").find(".time_circles").find(".textDiv_Minutes").find("span").text();
		//~ var get_seconds = $("#CountDownTimer").find(".time_circles").find(".textDiv_Seconds").find("span").text();
		//~ 
		//~ if(get_minutes == "0" && get_seconds == "0"){
			//~ $("#tiempo_limite").val("alcanzado");  // Indicamos que se alcanzó el límite
		//~ }
	//~ },1000);  // Validamos el tiempo cada segundo
	//~ 
	//~ var v_t2 = setInterval(function(){
		//~ if($("#tiempo_limite").val() == "alcanzado"){
			//~ clearInterval(v_t);
			//~ clearInterval(v_t2);
			//~ bootbox.alert("Se a agotado el tiempo de registro, por favor inicie sesión e intentelo nuevamente", function (){
			//~ }).on('hidden.bs.modal', function (event) {
				//~ window.location = base_url+'index.php/User_Authentication/logout/'+user_id;
			//~ });
		//~ }
	//~ },90000);  // Checqueamos el campo de límite de tiempo cada minuto con 30 segundos
    
    // Carga de datos
    var tipo = $("#tipo_pago_id").val();
    var cuenta = $("#cuenta_id_id").val();
    var tipo_cuenta = $("#tipo_cuenta_id_id").val();
    var banco = $("#banco_usu_id_id").val();
    $("#tipo_pago").val(tipo);
    $("#num_cuenta_usu").val(cuenta);
    $("#tipo_cuenta_id").val(tipo_cuenta);
    $("#banco_usu_id").val(banco);
    //~ alert($("#estatus_perfil").val());
    if ($("#estatus_perfil").val() == 99 || $("#estatus_perfil").val() < 2)  {
        $("#num_cuenta_usu,#tipo_pago,#num_pago,#fecha_pago,#registrar_p").prop('readonly',false)
    }else{
        $("#tipo_pago,#num_pago,#fecha_pago,#registrar_p").prop('readonly',true)
    }
    
    var pais_id = $("#pais_id_id").val()
    var patrocinador_id = $("#patrocinador_id_id").val()
    $("#pais_id").val(pais_id);
    $("#patrocinador_id").val(patrocinador_id);
    
    // Validar las secciones a mostrar u ocultar
    if($("#estatus_perfil").val() == 1){
		$("#fieldset_pago").show();
		$("#progressbar_pago").addClass('active');  // Activamos el numerador de pago
		$("#fieldset_personal").hide();
		$("#fieldset_distribucion").hide();
		$("#fieldset_finalizado").hide();
	}else if($("#estatus_perfil").val() == 2){
		$("#fieldset_pago").hide();
		$("#fieldset_personal").show();
		$("#progressbar_personal").addClass('active');  // Activamos el numerador de datos personales
		$("#fieldset_distribucion").hide();
		$("#fieldset_finalizado").hide();
	}else if($("#estatus_perfil").val() == 3){
		$("#fieldset_pago").hide();
		$("#fieldset_personal").hide();
		$("#fieldset_distribucion").show();
		$("#progressbar_distribucion").addClass('active'); // Activamos el numerador de distribución de capital
		$("#fieldset_finalizado").hide();
	}else if($("#estatus_perfil").val() == 4){
		$("#fieldset_pago").hide();
		$("#fieldset_personal").hide();
		$("#fieldset_distribucion").hide();
		$("#fieldset_finalizado").show();
		$("#progressbar_finalizar").addClass('active'); // Activamos el numerador de finalizar
	}
	
	// Ejecutar las validaciones y el guardado
	$(".next").click(function(){
		if($(this).attr('id') == 'info_pago'){
			
			valida_pago();  // Validar datos personales (ver detalles al final)
			
		}else if($(this).attr('id') == 'info_personal'){
			
			valida_personal();  // Validar datos personales (ver detalles al final)
			
		}else if($(this).attr('id') == 'distribucion'){
			
			if ($("#estatus_perfil").val() < 4) {
				bootbox.alert("Aún no ha realizado todos los pagos correspondientes.", function () {
				}).on('hidden.bs.modal', function (event) {
					
				});
			}else{
				window.location = base_url+'index.php/referidos/CReferidos/';
			}
			
		}
	});

	$(".submit").click(function(){
		return false;
	})
	
	$("#cerrar_modal").click(function(){
		window.location = base_url+'index.php/referidos/CReferidos/';
	})
	
	var Tusuarios = $('#tab_rel_distribucion').dataTable({
        "paging": true,
        "lengthChange": false,
        "autoWidth": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "iDisplayLength": 10,
        "iDisplayStart": 0,
        "sPaginationType": "full_numbers",
        "aLengthMenu": [10,15],
        "oLanguage": {"sUrl": base_url+"/static/js/es.txt"},
        "decimal": ",",
        "thousands": ".",
        "aoColumns": [
            {"sClass": "registro center", "sWidth": "1%"},
            {"sClass": "registro center", "sWidth": "5%"},
            {"sClass": "registro center", "sWidth": "5%"},
        ],
        "order": [[ 2, "desc" ]]     
    });
     

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
    
    $('.pagar').click(function(e){
        e.preventDefault();
        //Se captura el value de ID del boton
        var val = this.getAttribute('id');
        val = val.split('-') //Se corta el value en 2 partes
        id_ref = val[0] // Id del referido
        nivel_ref = val[1] // nivel del referido

        $.post(base_url+'index.php/referidos/CRelDistribucion/pagar',
               $.param({'id_ref': id_ref})+'&'+$.param({'nivel_ref': nivel_ref}), function (response){

                if (response[0] == 1) {
                   bootbox.alert("Disculpe, ya generó sus links de invitación", function () {
                   }).on('hidden.bs.modal', function (event) {
                       $("#monto_retiro").parent('div').addClass('has-error')
                       $("#monto_retiro").focus();
                   });
                } else {
                   bootbox.alert("Su pago de referido ha sido generado satisfactoriamente", function (){
                       window.location = base_url+'index.php/referidos/CReferidos/';
                   });
                }
            
        });
    });
    
    // Control de eventos de cierre de sesión
    $('.cerrar_sesion').click(function(e){
		e.preventDefault();
		window.location = base_url+'index.php/User_Authentication/logout/'+user_id+'?t_u=3';
	});
    
});

// Función para validar los datos del pago del usuario
function valida_pago(){
	
	/*if ($("#cuenta_id").val() == 0 || $("#cuenta_id").val() == null) {
		bootbox.alert("Debe selecionar la cuenta a la cual realizo el pago", function () {
		}).on('hidden.bs.modal', function (event) {
				$("#cuenta_id").parent('div').addClass('has-error')
				$("#cuenta_id").focus();
		});
	}else if ($("#tipo_pago").val() == 0 || $("#tipo_pago").val() == null) {
		bootbox.alert("Debe selecionar el tipo de pago", function () {
		}).on('hidden.bs.modal', function (event) {
				$("#tipo_pago").parent('div').addClass('has-error')
				$("#tipo_pago").focus();
		});
	}else if ($("#num_pago").val() == '') {
		bootbox.alert("Debe colocar el número de pago", function () {
		}).on('hidden.bs.modal', function (event) {
			$("#num_pago").parent('div').addClass('has-error')
			$("#num_pago").focus();
		});
	}*/
	if ($("#dir_monedero").val() == '') {
		bootbox.alert("Debe indicar la dirección de su monedero", function () {
		}).on('hidden.bs.modal', function (event) {
				$("#dir_monedero").parent('div').addClass('has-error')
				$("#dir_monedero").focus();
		});
	}/*else if ($("#fecha_pago").val() == '') {
		bootbox.alert("Debe indicar la fecha de pago", function () {
		}).on('hidden.bs.modal', function (event) {
				$("#fecha_pago").parent('div').addClass('has-error')
				$("#fecha_pago").focus();
		});
	}else if ($("#monto").val() == 0) {
		bootbox.alert("Debe indicar el monto", function () {
		}).on('hidden.bs.modal', function (event) {
				$("#monto").parent('div').addClass('has-error')
				$("#monto").focus();
		});
	}*/else{
		//~ cuenta_id = $('#cuenta_id').val()
		//~ num_pago = $('#num_pago').val()
		//~ tipo_pago = $('#tipo_pago').val()
		dir_monedero = $('#dir_monedero').val()
		//~ fecha_pago = $('#fecha_pago').val()
		//~ $('#monto').prop('disabled',false);
		//~ monto = $('#monto').val()
		pk_perfil = $('#cod_perfil').val()
		cod_pago = $('#cod_pago').val()
		
		//~ // Inspeccionamos la dirección de la empresa para comprobar pago desde la dirección indicada por el usuario
		//~ var blockrAPI = "https://blockexplorer.com/api/addr/1JGQko7DZfuNqgyPkiSM6TKJBmAMCHhZL7";
		//~ var status, address, num_trans, search_address_paid, search_amount, search_date;
		//~ // Definimos dinámicamente los valores que serán indicados por parte del usuario
		//~ search_address_paid = dir_monedero;
		//~ search_amount = monto;
		//~ search_date = fecha_pago;
		//~ $.ajax({
			//~ url : blockrAPI,
			//~ type : 'GET',
			//~ async: false,  // Para que no proceda con las siguientes instrucciones hasta terminar la petición
			//~ dataType : 'json',
			//~ beforeSend:function(objeto){ 
				//~ $('#resultado').css({display:'block'});
				//~ $('#info_pago').prop('disabled',true);
			//~ },
			//~ success : function(data) {
				//~ address = data['addrStr'];
				//~ num_trans = data['txApperances'];
				//~ // alert("Dirección: " + address + ", Número de transacciones: " + num_trans);
				//~ var check_payment = 0;
				//~ var contador_trans = 0;
				//~ $.each(data['transactions'], function (i){
					//~ var hash_tx = data['transactions'][i];  // Código hash de la transacción
					//~ 
					//~ // Filtramos sólo los pagos recibidos y descartamos los pagos hechos
					//~ // if(!(monto < 0)){
						//~ var blockrAPIDetails = "https://blockexplorer.com/api/tx/"+hash_tx;  // (Detalles de la transacción con http://blockexplorer.com)
						//~ // Consultamos los detalles de la transacción para verificar las direcciones y ver si alguna coincide con la del usuario
						//~ $.ajax({
							//~ url : blockrAPIDetails,
							//~ type : 'GET',
							//~ async: false,  // Para que no proceda con las siguientes instrucciones hasta terminar la petición
							//~ dataType : 'json',
							//~ success : function(data2) {
								//~ var fecha = data2['time'];
								//~ var format_fecha = new Date(fecha*1000);
								//~ var day = (format_fecha.getDate() < 10 ? '0' : '') + format_fecha.getDate();
								//~ var month = (format_fecha.getMonth() < 9 ? '0' : '') + (format_fecha.getMonth() + 1);
								//~ var year = format_fecha.getFullYear();
								//~ format_fecha = day + '/' + month + '/' + year;
								//~ // alert(format_fecha);
								//~ var monto = data2['valueIn'];
								//~ var address_paid = data2['vin'][0]['addr'];
								//~ 
								//~ // alert("Dirección: " + address_paid + "Fecha: " + fecha + ", Monto: " + monto);
						//~ 
								//~ // Si los detalles del pago coinciden con los indicados por el usuario, entonces lo validamos
								//~ if(search_address_paid == address_paid && search_amount == monto && search_date == format_fecha){
									//~ check_payment += 1;
									//~ // $("#input_resultado").val(check_payment);
								//~ }
								//~ contador_trans += 1;  // Una transacción más verificada
								//~ // alert(check_payment);
							//~ }
						//~ });
					//~ // }					
					//~ 
				//~ })
				//~ 
				//~ $('#resultado').css({display:'none'});
				//~ $('#info_pago').prop('disabled',false);
				//~ 
				//~ // Si el pago fue validado
				//~ // alert(check_payment);
				//~ // alert(contador_trans);
				//~ if(check_payment > 0){
					//~ // alert("Su pago fue validado");
					//~ $.post(base_url+'index.php/referidos/CRelPagos/actualizar',
					   //~ $.param({'pk_perfil': pk_perfil})+'&'+$.param({'dir_monedero': dir_monedero})+'&'+$.param({'monto': monto})+'&'+
					   //~ $.param({'fecha_pago': fecha_pago})+'&'+$.param({'cod_pago': cod_pago}), 
					   //~ function (response){
					$.post(base_url+'index.php/referidos/CRelPagos/actualizar_dir',
					$.param({'pk_perfil': pk_perfil})+'&'+$.param({'dir_monedero': dir_monedero})+'&'+$.param({'cod_pago': cod_pago}), 
					function (response){
						if (response[0] == 1) {
							bootbox.alert("Disculpe, esta dirección ya fue registrada con este usuario", function () {
							}).on('hidden.bs.modal', function (event) {
								$("#dir_monedero").parent('div').addClass('has-error')
								$("#dir_monedero").focus();
							});
						} else {
							//~ bootbox.alert("Se validó y registró su pago con Éxito", function (){
							bootbox.alert("Espere un mensaje de confirmación de pago en su correo en un máximo de 72 horas, de no recibirlo por favor comunicarse a nuestro correo support@criptozone.com", function (){
							}).on('hidden.bs.modal', function (event) {
								//~ //window.location = '<?php echo base_url(); ?>index.php/referidos/CRelPagos/';
								window.location = base_url+'index.php/referidos/CReferidos/';
								$("#reg_data_pago").val(1);
							});
							
						}
						
					});
				//~ }else{
					//~ alert("Su pago no ha sido comprobado, por favor intente el registro más tarde");
				//~ }
			//~ },
		//~ });
		
	}
}

// Función para validar los datos personales del usuario
function valida_personal(){
	
	if ($("#estatus_perfil").val() < 2) {
		bootbox.alert("Su pago debe haber sido validado por un operador para continuar.", function () {
		}).on('hidden.bs.modal', function (event) {
				$("#cedula").parent('div').addClass('has-error')
				$("#cedula").focus();
		});
	}else if ($("#cedula").val() == '' || $("#cedula").val() == 0) {
		bootbox.alert("Debe colocar su cedula", function () {
		}).on('hidden.bs.modal', function (event) {
				$("#cedula").parent('div').addClass('has-error')
				$("#cedula").focus();
		});
	}/*else if ($("#nombre").val() == '') {
		bootbox.alert("Debe colocar su nombre", function () {
		}).on('hidden.bs.modal', function (event) {
				$("#nombre").parent('div').addClass('has-error')
				$("#nombre").focus();
		});
	}else if ($("#apellido").val() == '') {
		bootbox.alert("Debe colocar su apellido", function () {
		}).on('hidden.bs.modal', function (event) {
			$("#apellido").parent('div').addClass('has-error')
			$("#apellido").focus();
		});
	}else if ($("#correo").val() == '') {
		bootbox.alert("Debe colocar su correo", function () {
		}).on('hidden.bs.modal', function (event) {
				$("#correo").parent('div').addClass('has-error')
				$("#correo").focus();
		});
	}else if ($("#telefono").val() == '') {
		bootbox.alert("Debe colocar su teléfono", function () {
		}).on('hidden.bs.modal', function (event) {
				$("#telefono").parent('div').addClass('has-error')
				$("#telefono").focus();
		});
	}else if ($("#tipo_cuenta_id").val() == 0 || $("#tipo_cuenta_id").val() == null) {
		bootbox.alert("Debe seleccionar el tipo de su cuenta bancaria", function () {
		}).on('hidden.bs.modal', function (event) {
				$("#tipo_cuenta_id").parent('div').addClass('has-error')
				$("#tipo_cuenta_id").focus();
		});
	}else if ($("#num_cuenta_usu").val() == '') {
		bootbox.alert("Debe colocar su número de cuenta bancaria", function () {
		}).on('hidden.bs.modal', function (event) {
				$("#num_cuenta_usu").parent('div').addClass('has-error')
				$("#num_cuenta_usu").focus();
		});
	}else if ($("#banco_usu_id").val() == 0 || $("#banco_usu_id").val() == null) {
		bootbox.alert("Debe seleccionar su banco", function () {
		}).on('hidden.bs.modal', function (event) {
				$("#banco_usu_id").parent('div').addClass('has-error')
				$("#banco_usu_id").focus();
		});
	}else if ($("#fecha_na").val() == '') {
		bootbox.alert("Debe seleccionar su fecha de nacimiento", function () {
		}).on('hidden.bs.modal', function (event) {
				$("#fecha_na").parent('div').addClass('has-error')
				$("#fecha_na").focus();
		});
	}else if ($("#pais_id").val() == 0) {
		bootbox.alert("Debe seleccionar su país", function () {
		}).on('hidden.bs.modal', function (event) {
				$("#pais_id").parent('div').addClass('has-error')
				$("#pais_id").focus();
				$("#pais_id").val('0');
		});
	}else if ($("#patrocinador_id").val() == 0) {
		bootbox.alert("Debe indicar como nos conoció", function () {
		}).on('hidden.bs.modal', function (event) {
				$("#patrocinador_id").parent('div').addClass('has-error')
				$("#patrocinador_id").focus();
		});
	}*/else if ($("#dir_monedero_per").val() == '' || $("#dir_monedero_per").val() == 0) {
		bootbox.alert("Debe colocar su dirección de monedero personal", function () {
		}).on('hidden.bs.modal', function (event) {
				$("#dir_monedero_per").parent('div').addClass('has-error')
				$("#dir_monedero_per").focus();
				$("#dir_monedero_per").val('');
		});
	}else if ($("#dir_monedero_per").val().trim().length < 34) {
		bootbox.alert("La longitud de la dirección no puede ser menor a 34 dígitos", function () {
		}).on('hidden.bs.modal', function (event) {
				$("#dir_monedero_per").parent('div').addClass('has-error')
				$("#dir_monedero_per").focus();
				$("#dir_monedero_per").val('');
		});
	}else{
		// Recorrido de la tabla de referidos para distribuir el capital
		$("#tab_rel_distribucion tbody tr").each(function () {
			var id_niv;
			id_niv = $(this).find('td').eq(0).find('button').attr('id');  // Id y nivel del referido
			val = id_niv.split('-') //Se corta el value en 2 partes
			id_ref = val[0] // Id del referido
			nivel_ref = val[1] // nivel del referido
			
			//~ alert(id_ref+" - "+nivel_ref);
			// Pago a cada referido padre
			$.post(base_url+'index.php/referidos/CRelDistribucion/pagar',
				$.param({'id_ref': id_ref})+'&'+$.param({'nivel_ref': nivel_ref}), function (response){

				if (response[0] == 1) {
				   $("#dist_true").val(parseInt($("#dist_true").val())+0);
				} else {
				   $("#dist_true").val(parseInt($("#dist_true").val())+1);
				}
				
			});
		});
		
		// Actualización de la información personal
		cedula = $('#cedula').val()
		//~ nombre = $('#nombre').val()
		//~ apellido = $('#apellido').val()
		//~ correo = $('#correo').val()
		//~ // telefono = $('#telefono').val()
		//~ // tipo_cuenta_id = $('#tipo_cuenta_id').val()
		//~ fecha_na = $('#fecha_na').val()
		usuario_id = $('#usuario_id').val()
		//~ pais_id = $('#pais_id').val()
		//~ patrocinador_id = $('#patrocinador_id').val()
		// num_cuenta_usu = $('#num_cuenta_usu').val()
		// banco_usu_id = $('#banco_usu_id').val()
		dir_monedero_per = $('#dir_monedero_per').val()
		pk_perfil = $('#cod_perfil').val()
		
		//~ $.post(base_url+'index.php/referidos/CRelInformacion/actualizar',
		   //~ $.param({'cedula': cedula})+'&'+$.param({'nombre': nombre})+'&'+$.param({'apellido': apellido})+'&'+$.param({'pk_perfil': pk_perfil})+'&'+
		   //~ $.param({'correo': correo})+'&'+$.param({'usuario_id': usuario_id})+'&'+$.param({'dir_monedero_per': dir_monedero_per})+'&'+
		   //~ $.param({'pais_id': pais_id})+'&'+$.param({'patrocinador_id': patrocinador_id})+'&'+$.param({'fecha_na': fecha_na}), 
		   //~ function (response){
		$.post(base_url+'index.php/referidos/CRelInformacion/actualizar',
		   $.param({'cedula': cedula})+'&'+$.param({'pk_perfil': pk_perfil})+'&'+
		   $.param({'usuario_id': usuario_id})+'&'+$.param({'dir_monedero_per': dir_monedero_per}), 
		   function (response){
			if (response[0] == 1) {
				bootbox.alert("Disculpe, esta dirección ya fue registrada con este usuario", function () {
				}).on('hidden.bs.modal', function (event) {
					$("#cedula").parent('div').addClass('has-error')
					$("#cedula").focus();
				});
			} else {
				// Generación automática de links del usuario
				usuario_id = $('#id_user').val();
				$.post(base_url+'index.php/referidos/CRelLinks/guardar', $.param({'usuario_id': usuario_id}), function (response){
					
				});
				
				bootbox.alert("Se actualizó su información personal con Exito", function (){
				}).on('hidden.bs.modal', function (event) {
					//~ //window.location = '<?php echo base_url(); ?>index.php/referidos/CRelInformacion/';
					
					// Recarga de página
					window.location = base_url+'index.php/referidos/CReferidos/';
					$("#reg_data_personal").val(1);
				});
				
			}
			
		});
    }
    
}

// Proceso de geolocalización
//~ var x = document.getElementById("demo");

function showPosition(position) {
	//~ latitud = (position.coords.latitude);
	//~ longitud = (position.coords.longitude);
//~ 
	//~ x.innerHTML = "Latitude: " + latitud + 
	//~ "<br>Longitude: " + longitud;
	$('#latitud').val(position.coords.latitude);
	$('#longitud').val(position.coords.longitude);
	//~ alert(position.coords.latitude);
	//~ alert(position.coords.longitude);
}

function getLocation() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(showPosition);
	} else { 
		alert("Geolocation is not supported by this browser.");
	}
}

// Ejecutamos la captura de la localización
getLocation();

function registrar_coord(){		
	
	// Registramos las coordenadas capturadas si el usuario logueado es de tipo BÁSICO
	if($('#tipo_user').val().trim() == "BÁSICO"){
		//~ alert("Usuario básico");
		if($('#latitud').val().trim() != "" && $('#longitud').val().trim() != ""){
			//~ alert($('#latitud').val());
			//~ alert($('#longitud').val());
			$.post(base_url+'index.php/User_Authentication/registrar_coord/', {'latitud':$('#latitud').val(), 'longitud':$('#longitud').val()}, function(response) {
				
			});
		}else{
			//~ alert($('#latitud').val());
			//~ alert($('#longitud').val());
			// Ejecutamos la captura de la localización nuevamente
			getLocation();
			if($('#latitud').val().trim() != "" && $('#longitud').val().trim() != ""){
				//~ alert($('#latitud').val());
				//~ alert($('#longitud').val());
				$.post(base_url+'index.php/User_Authentication/registrar_coord/', {'latitud':$('#latitud').val(), 'longitud':$('#longitud').val()}, function(response) {
					
				});
			}
		}
	}
}

//~ $(window).load(function() {
	//~ 
//~ });

//~ if (document.addEventListener) {
   //~ document.addEventListener("DOMContentLoaded", registrar_coord(), false);
//~ }

// Ejecutamos el registro de las coordenadas dando un pequeño lapso de tiempo de tres segundos antes de proceder
regCoord = setTimeout(registrar_coord, 5000);
