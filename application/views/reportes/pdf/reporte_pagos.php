<?php

$this->pdf   = new Pdf($orientation = 'L', $unit = 'mm', $format = 'A4');
// Agregamos una página
$this->pdf->AddPage();
// Define el alias para el número de página que se imprimirá en el pie
$this->pdf->AliasNbPages();

#$this->pdf->set_title(title)
$this->pdf->SetAuthor('José Solorzano');
//~ $this->pdf->AliasNbPages() # LLAMADA DE PAGINACIÓN
//~ $this->pdf->add_page() # AÑADE UNA NUEVA PAGINACIÓN
#$this->pdf->SetFont('Times','',10) # TAMAÑO DE LA FUENTE
$this->pdf->SetFont('Arial','B',15);
$this->pdf->SetFillColor(157,188,201); # COLOR DE BOLDE DE LA CELDA
$this->pdf->SetTextColor(24,29,31); # COLOR DEL TEXTO
$this->pdf->SetMargins(15,15,10); # MARGEN DEL DOCUMENTO
#$this->pdf->ln(20) # Saldo de línea
# 10 y 50 eje x y y 200 dimensión

$this->pdf->SetFillColor(255,255,255);
$this->pdf->SetFont('Arial','B',14);
$this->pdf->Ln(1);
$this->pdf->Cell(185,5,"",'',1,'C',1);
$this->pdf->MultiCell(185,5,utf8_decode("$empresa->nombre_empresa"),'','C',0);
$this->pdf->SetFont('Arial','',8);
//~ $this->pdf->Cell(30,5,"RIF:",'',0,'C',1);
$this->pdf->Cell(185,5,"RIF:   G-20010539-9",'',1,'C',1);
$texto = 'AV. SUCRE. URB. SAN ISIDRO - MARACAY. EDIF. BIBLIOTECA VIRTUAL. NRO. 26';
$this->pdf->MultiCell(185,5,utf8_decode("Teléfonos: $empresa->telefono1 / $empresa->telefono2"),'','C',0);
$fecha = date('d/m/Y');
$hora = date("h:i:s a");
$this->pdf->Cell(30,5,"FECHA: $fecha",'B',0,'L',1);
$this->pdf->Cell(30,5,"",'B',0,'L',1);
$this->pdf->Cell(30,5,"HORA: $hora",'B',0,'L',1);
$this->pdf->Cell(95,5,"",'B',1,'R',1);


if ($desde != "xxx" && $hasta != "xxx"){
	$desde = explode("-",$desde);
	$desde = $desde[2]."-".$desde[1]."-".$desde[0];
	$hasta = explode("-",$hasta);
	$hasta = $hasta[2]."-".$hasta[1]."-".$hasta[0];
}

$this->pdf->Cell(30,5,"DATOS DEL REPORTE (PAGOS)",'T',1,'L',1);
//~ $this->pdf->Cell(35,5,"RIF/CI: ".$cliente->tipocliente."-".$cliente->cirif,'',0,'L',1);
$this->pdf->Cell(35,5,utf8_decode("USUARIO: $usuario->username"),'',0,'L',1);
$this->pdf->Cell(60,5,utf8_decode("FECHA INICIAL: $desde"),'',0,'L',1);
$this->pdf->Cell(60,5,utf8_decode("FECHA FINAL: $hasta"),'',1,'L',1);


$this->pdf->Cell(30,5,"Usuario",'TB',0,'L',1);
$this->pdf->Cell(30,5,utf8_decode("Monto"),'TB',0,'C',1);
$this->pdf->Cell(85,5,utf8_decode("Dir. Monedero"),'TB',0,'L',1);
$this->pdf->Cell(20,5,"Fecha ",'TB',0,'L',1);
$this->pdf->Cell(20,5,"Estatus",'TB',1,'R',1);

$j = 0;  # Contador para el salto de página

foreach ($pagos as $pago){
	
	#Sección para el salto de página
	if ($j == 45){
		$this->pdf->AddPage();
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->SetFont('Arial','B',14);
		$this->pdf->Ln(1);
		$this->pdf->Cell(185,5,"",'',1,'C',1);
		$this->pdf->MultiCell(185,5,utf8_decode("$empresa->nombre_empresa"),'','C',0);
		$this->pdf->SetFont('Arial','',8);
		//~ $this->pdf->Cell(30,5,"RIF:",'',0,'C',1);
		$this->pdf->Cell(185,5,"RIF:   G-20010539-9",'',1,'C',1);
		$texto = 'AV. SUCRE. URB. SAN ISIDRO - MARACAY. EDIF. BIBLIOTECA VIRTUAL. NRO. 26';
		$this->pdf->MultiCell(185,5,utf8_decode("Teléfonos: $empresa->telefono1 / $empresa->telefono2"),'','C',0);
		$fecha = date('d/m/Y');
		$hora = date("h:i:s a");
		$this->pdf->Cell(30,5,"FECHA: $fecha",'B',0,'L',1);
		$this->pdf->Cell(30,5,"",'B',0,'L',1);
		$this->pdf->Cell(30,5,"HORA: $hora",'B',0,'L',1);
		$this->pdf->Cell(95,5,"",'B',1,'R',1);
		
		$this->pdf->Cell(30,5,"DATOS DEL REPORTE (PAGOS)",'T',1,'L',1);
		//~ $this->pdf->Cell(35,5,"RIF/CI: ".$cliente->tipocliente."-".$cliente->cirif,'',0,'L',1);
		$this->pdf->Cell(35,5,utf8_decode("USUARIO: ".$usuario[0]->username),'',0,'L',1);
		$this->pdf->Cell(60,5,utf8_decode("FECHA INICIAL: $desde"),'',0,'L',1);
		$this->pdf->Cell(60,5,utf8_decode("FECHA FINAL: $hasta"),'',1,'L',1);


		$this->pdf->Cell(30,5,"Usuario",'TB',0,'L',1);
		$this->pdf->Cell(30,5,utf8_decode("Monto"),'TB',0,'C',1);
		$this->pdf->Cell(85,5,utf8_decode("Dir. Monedero"),'TB',0,'L',1);
		$this->pdf->Cell(20,5,"Fecha ",'TB',0,'L',1);
		$this->pdf->Cell(20,5,"Estatus",'TB',1,'R',1);

		#pdf.ln(60)
		$j = 0;
	}
	
	$fecha_pago = explode("-",$pago->fecha_pago);
	$fecha_pago = $fecha_pago[2]."-".$fecha_pago[1]."-".$fecha_pago[0];
	$usu = "";  // Variable para almacenar el nombre de usuario
	foreach($usuarios as $usuario){
		if($usuario->id == $pago->usuario_id){
			$usu = $usuario->username;
		}
	}
	//~ $cnt = "";  // Variable para almacenar el número de cuenta
	//~ foreach($cuentas as $cuenta){
		//~ if($cuenta->id == $pago->cuenta_id){
			//~ $cnt = $cuenta->descripcion;
		//~ }
	//~ }
	$est = "";  // Variable para almacenar la descripción del estatus
	if($pago->estatus == 1){
		$est = "Pendiente";
	}else if($pago->estatus == 2){
		$est = "Validado";
	}
	$this->pdf->Cell(30,5,utf8_decode("$usu"),'',0,'L',1);
	$this->pdf->Cell(30,5,"$pago->monto",'',0,'C',1);
	$this->pdf->Cell(85,5,utf8_decode("$pago->dir_monedero"),'',0,'L',1);
	$this->pdf->Cell(20,5,"$fecha_pago",'',0,'L',1);
	$this->pdf->Cell(20,5,"$est",'',1,'R',1);
	
	$j += 1;
}
$this->pdf->Cell(185,1,"",'T',1,'R',1);  // Cierre de bloque de pagos

// Salida del Formato PDF
$this->pdf->Output("pagos.pdf", 'I');
