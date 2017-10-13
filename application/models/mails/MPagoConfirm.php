<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class MPagoConfirm extends CI_Model {

	//configuración para gmail
	private $configGmail = array(
		'protocol' => 'smtp',
		'smtp_host' => 'ssl://smtp.gmail.com',
		'smtp_port' => 465,
		'smtp_user' => 'clubahorrojm@gmail.com',
		'smtp_pass' => 'clubahorrojm123**',
		'mailtype' => 'html',
		'crlf' => "\r\n",
		'charset' => 'utf-8',
		'newline' => "\r\n"
	);
	
	//configuracion para yahoo
	private $configYahoo = array(
		'protocol' => 'smtp',
		'smtp_host' => 'smtp.mail.yahoo.com',
		'smtp_port' => 587,
		'smtp_crypto' => 'tls',
		'smtp_user' => 'emaildeyahoo',
		'smtp_pass' => 'password',
		'mailtype' => 'html',
		'charset' => 'utf-8',
		'newline' => "\r\n"
	);
	
	//configuracion para mailtrap
	private $config = Array(
	  //~ 'protocol' => 'smtp',
	  //~ 'smtp_host' => 'smtp.mailtrap.io',
	  //~ 'smtp_port' => 2525,
	  //~ 'smtp_user' => '7070f0ddfd21e6',
	  //~ 'smtp_pass' => '0d07237bfd1f66',
	  'mailtype' => 'html',
	  'crlf' => "\r\n",
	  'newline' => "\r\n"
	);
		
    public function __construct() {
       
        parent::__construct();
        $this->load->database();
        
        //cargamos la librería email de ci
		$this->load->library("email");
		
    }
	
	// Public method to send a email of confirmation
    public function enviarMailPago($datos_reg) {
        // Varios destinatarios
		//~ $para = 'aidan@example.com' . ', '; // atención a la coma
		$para = $datos_reg['email'];

		// título
		$título = 'Criptozone: Pago realizado';

		// mensaje
		$mensaje = '
		<!DOCTYPE html>
		<html>
		  <head>
			<meta name="viewport" content="width=device-width">
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
			<title>Simple Transactional Email</title>
			<style type="text/css">
			/* -------------------------------------
				INLINED WITH https://putsmail.com/inliner
			------------------------------------- */
			/* -------------------------------------
				RESPONSIVE AND MOBILE FRIENDLY STYLES
			------------------------------------- */
			@media only screen and (max-width: 620px) {
			  table[class=body] h1 {
				font-size: 28px !important;
				margin-bottom: 10px !important; }
			  table[class=body] p,
			  table[class=body] ul,
			  table[class=body] ol,
			  table[class=body] td,
			  table[class=body] span,
			  table[class=body] a {
				font-size: 16px !important; }
			  table[class=body] .wrapper,
			  table[class=body] .article {
				padding: 10px !important; }
			  table[class=body] .content {
				padding: 0 !important; }
			  table[class=body] .container {
				padding: 0 !important;
				width: 100% !important; }
			  table[class=body] .main {
				border-left-width: 0 !important;
				border-radius: 0 !important;
				border-right-width: 0 !important; }
			  table[class=body] .btn table {
				width: 100% !important; }
			  table[class=body] .btn a {
				width: 100% !important; }
			  table[class=body] .img-responsive {
				height: auto !important;
				max-width: 100% !important;
				width: auto !important; }}
			/* -------------------------------------
				PRESERVE THESE STYLES IN THE HEAD
			------------------------------------- */
			@media all {
			  .ExternalClass {
				width: 100%; }
			  .ExternalClass,
			  .ExternalClass p,
			  .ExternalClass span,
			  .ExternalClass font,
			  .ExternalClass td,
			  .ExternalClass div {
				line-height: 100%; }
			  .apple-link a {
				color: inherit !important;
				font-family: inherit !important;
				font-size: inherit !important;
				font-weight: inherit !important;
				line-height: inherit !important;
				text-decoration: none !important; }
			  .btn-primary table td:hover {
				background-color: #34495e !important; }
			  .btn-primary a:hover {
				background-color: #34495e !important;
				border-color: #34495e !important; } }
			</style>
		  </head>
		  <body class="" style="background-color:#f6f6f6;font-family:sans-serif;-webkit-font-smoothing:antialiased;font-size:14px;line-height:1.4;margin:0;padding:0;-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%;">
			<table style="height:auto; background-image: url(\''.static_url().'img/correo/ficha.jpg\'); background-size: 100%; background-repeat: no-repeat; border-collapse:separate;mso-table-lspace:0pt;mso-table-rspace:0pt;background-color:#f6f6f6;width:100%;" border="0" cellpadding="0" cellspacing="0" class="body" >
			  <tr>
				<td style="font-family:sans-serif;font-size:14px;vertical-align:top;">&nbsp;</td>
				<td class="container" style="font-family:sans-serif;font-size:14px;vertical-align:top;display:block;max-width:580px;padding:10px;width:580px;Margin:0 auto !important;">
				  <div class="content" style="box-sizing:border-box;display:block;Margin:0 auto;max-width:580px;padding:10px;">
					<!-- START CENTERED WHITE CONTAINER -->
					<span class="preheader" style="color:transparent;display:none;height:0;max-height:0;max-width:0;opacity:0;overflow:hidden;mso-hide:all;visibility:hidden;width:0;">This is preheader text. Some clients will show this text as a preview.</span>
					<table class="main" style="border-collapse:separate;mso-table-lspace:0pt;mso-table-rspace:0pt;background:transparent;border-radius:3px;width:100%;">
					  <!-- START MAIN CONTENT AREA -->
					  <tr>
						<td class="wrapper" style="font-family:sans-serif;font-size:14px;vertical-align:top;box-sizing:border-box;padding:20px;">
						  <br><br><br><br><br><br>
						  <table border="0" cellpadding="0" cellspacing="0" style="backgroud-color:transparent; border-collapse:separate;mso-table-lspace:0pt;mso-table-rspace:0pt;width:100%;">
							<tr>
							  <td style="font-family:sans-serif;font-size:14px;vertical-align:top;">
								
								<p style="font-family:sans-serif;font-size:14px;font-weight:normal;margin:0;Margin-bottom:15px;text-align: justify;">
								Bienvenido oficialmente a la gran familia Criptozone, donde tú participación es la mejor opción y las posibilidades de emprender están a tu disposición.
								</p>
								
								<p style="font-family:sans-serif;font-size:14px;font-weight:normal;margin:0;Margin-bottom:15px;text-align: justify;">
								Su pago ha sido confirmado de forma satisfactoria, ya puede ingresar a www.criptozone.com con su usuario y contraseña, para comenzar a otorgar link de invitación a tus familiares, amigos y demás conocidos, además de ir consultando tu evolución en la plataforma.
								</p>
								
							  </td>
							</tr>
						  </table>
						</td>
					  </tr>
					  <!-- END MAIN CONTENT AREA -->
					</table>
					<!-- START FOOTER -->
					<div class="footer" style="clear:both;padding-top:10px;text-align:center;width:100%;">
					  <table border="0" cellpadding="0" cellspacing="0" style="border-collapse:separate;mso-table-lspace:0pt;mso-table-rspace:0pt;width:100%;">
						<tr>
						  <td class="content-block powered-by" style="font-family:sans-serif;font-size:14px;vertical-align:top;color:#999999;font-size:12px;text-align:center;">
							Powered by <a href="http://htmlemail.io" style="color:#3498db;text-decoration:underline;color:#999999;font-size:12px;text-align:center;text-decoration:none;">HTMLemail</a>.
						  </td>
						</tr>
					  </table>
					</div>
					<!-- END FOOTER -->
					<!-- END CENTERED WHITE CONTAINER -->
					<a href="https:/instagram.com/criptozone/"><img src="'.static_url().'img/correo/instagram.png" style="width: 5%;Margin-top:20px;Margin-left:550px;" /><a/>
					<a href="https:/twitter.com/criptozone/"><img src="'.static_url().'img/correo/facebook.png" style="width: 5%;Margin-top:10px;Margin-left:550px;" /><a/>
					<a href="https:/facebook.com/criptozone/"><img src="'.static_url().'img/correo/twitter.png" style="width: 5%;Margin-top:10px;Margin-left:550px;" /><a/>
				  </div>
				</td>
				<td style="font-family:sans-serif;font-size:14px;vertical-align:top;">&nbsp;</td>
			  </tr>
			</table>
		  </body>
		</html>
		';

		//~ //cargamos la configuración para enviar con mailtrap (config), gamil (configGmail) o yahoo (configYahoo)
		//~ $this->email->initialize($this->configGmail);
//~ 
		//~ $this->email->from('contacto@criptozone.com');
		//~ $this->email->to($para);
		//~ $this->email->subject($título);
		//~ $this->email->message($mensaje);
		//~ if($this->email->send()){
			//~ echo "Email enviado";
		//~ }else{
			//~ echo $this->email->print_debugger();
		//~ }
		//~ $this->email->send();
		//~ // con esto podemos ver el resultado
		//~ // var_dump($this->email->print_debugger());
		
		// Envío con la función nativa de emails (mail())
		$cabeceras = 'From: contacto@criptozone.com' . "\r\n" .
		'Reply-To: contacto@criptozone.com' . "\r\n" .
		'Content-type: text/html; charset=utf-8' . "\r\n".
		'X-Mailer: PHP/' . phpversion();

		if(mail($para, $título, $mensaje, $cabeceras)){
			echo "Email enviado";
		}else{
			echo "No se pudo enviar";
		}
	}

}
?>
