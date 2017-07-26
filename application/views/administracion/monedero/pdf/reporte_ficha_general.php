<?php

$this->pdf   = new Pdf($orientation = 'L', $unit = 'mm', $format = 'A4');
// Agregamos una página
$this->pdf->AddPage();
// Define el alias para el número de página que se imprimirá en el pie
$this->pdf->AliasNbPages();

#$this->pdf->set_title(title)
$this->pdf->SetAuthor('Marcel Arcuri');
//~ $this->pdf->AliasNbPages() # LLAMADA DE PAGINACIÓN
//~ $this->pdf->add_page() # AÑADE UNA NUEVA PAGINACIÓN
#$this->pdf->SetFont('Times','',10) # TAMAÑO DE LA FUENTE
$this->pdf->SetFont('Arial','B',15);
$this->pdf->SetFillColor(157,188,201); # COLOR DE BOLDE DE LA CELDA
$this->pdf->SetTextColor(24,29,31); # COLOR DEL TEXTO
$this->pdf->SetMargins(10,15,10); # MARGEN DEL DOCUMENTO
#$this->pdf->ln(20) # Saldo de línea
# 10 y 50 eje x y y 200 dimensión

$this->pdf->SetFillColor(255,255,255);
$this->pdf->SetFont('Arial','B',14);
$this->pdf->Ln(1);
//$pdf->Image('/static/img/logo_condominios.jpg' , 80 ,22, 35 , 38,'JPG', 'http://localhost:8080/SistemaCondominios');
$this->pdf->Image('http://localhost/SistemaCondominios/static/img/logo_condominios.jpg',15,10,40);
$this->pdf->Cell(190,5,"",'',1,'C',1);
$this->pdf->Cell(40,5,utf8_decode(''),'',0,'C',0);
$this->pdf->Cell(150,5,utf8_decode('L.G. Administradora'),'',1,'C',1);
$this->pdf->SetFont('Arial','',10);

$this->pdf->Cell(40,5,utf8_decode(''),'',0,'C',0);
$this->pdf->Cell(150,5,utf8_decode("Teléfonos: 0414-0522952 / 02432456350"),'',1,'C',1);
$this->pdf->Cell(40,5,utf8_decode(''),'',0,'C',0);
$this->pdf->Cell(150,4,utf8_decode("Correo: admcond11@gmail.com"),'',1,'C',1);
$this->pdf->Ln(5);
$this->pdf->Cell(60,5,utf8_decode('Edificio: Morichal Norte'),'LBTR',0,'L',1);
$this->pdf->Cell(130,5,utf8_decode('Rif: J-31373607-4'),'LBTR',1,'L',1);
$texto = 'Direccion: MARACAY. URB. CALICANTO - MARACAY. EDIF. MORICHAL NORTE';
$this->pdf->MultiCell(190,5,utf8_decode($texto),'LBTR','L',0);
$this->pdf->Ln(5);

$this->pdf->SetFillColor(0,0,0);
$this->pdf->SetTextColor(255,255,255);
$this->pdf->Cell(190,5,utf8_decode('Cuentas'),'LBTR',1,'C',1);

$this->pdf->SetFillColor(191,191,191);
$this->pdf->SetTextColor(24,29,31);
$this->pdf->Cell(10,5,utf8_decode('#'),'LBTR',0,'C',0);
$this->pdf->Cell(75,5,utf8_decode('Banco'),'LBTR',0,'C',0);
$this->pdf->Cell(25,5,utf8_decode('Tipo'),'LBTR',0,'C',0);
$this->pdf->Cell(50,5,utf8_decode('Concepto'),'LBTR',0,'C',0);
$this->pdf->Cell(30,5,utf8_decode('Bs.'),'LBTR',1,'C',0);
$this->pdf->SetFillColor(255,255,255); # COLOR DE BORDE DE LA CELDA
$this->pdf->SetFont('Arial','',9);
$this->pdf->Cell(10,5,utf8_decode('1'),'LBTR',0,'C',0);
$this->pdf->Cell(75,5,utf8_decode('BANCO DE VENEZUELA'),'LBTR',0,'C',0);
$this->pdf->Cell(25,5,utf8_decode('CORRIENTE'),'LBTR',0,'C',0);
$this->pdf->Cell(50,5,utf8_decode('FONDO DE RESERVA'),'LBTR',0,'C',0);
$this->pdf->Cell(30,5,utf8_decode('170.670.88'),'LBTR',1,'C',0);

$this->pdf->Ln(5);
$this->pdf->SetFillColor(0,0,0);
$this->pdf->SetTextColor(255,255,255);
$this->pdf->Cell(190,5,utf8_decode('Propietarios'),'LBTR',1,'C',1);
$this->pdf->SetFillColor(191,191,191);
$this->pdf->SetTextColor(24,29,31);
$this->pdf->Cell(10,5,utf8_decode('#'),'LBTR',0,'C',0);
$this->pdf->Cell(70,5,utf8_decode('Nombre y Apellido'),'LBTR',0,'C',0);
$this->pdf->Cell(15,5,utf8_decode('Apto'),'LBTR',0,'C',0);
$this->pdf->Cell(45,5,utf8_decode('Teléfonos'),'LBTR',0,'C',0);
$this->pdf->Cell(50,5,utf8_decode('Correo'),'LBTR',1,'C',0);
$this->pdf->SetFillColor(255,255,255); # COLOR DE BORDE DE LA CELDA
$this->pdf->SetFont('Arial','',8);
$this->pdf->Cell(10,5,utf8_decode('1'),'LBTR',0,'C',0);
$this->pdf->Cell(70,5,utf8_decode('MARCEL ROBERT ARCURI GOMEZ'),'LBTR',0,'C',0);
$this->pdf->Cell(15,5,utf8_decode('7-B'),'LBTR',0,'C',0);
$this->pdf->Cell(45,5,utf8_decode('0243-2456350 / 0424-3707675'),'LBTR',0,'C',0);
$this->pdf->Cell(50,5,utf8_decode('MARCEL.ARCURI@GMAIL.COM'),'LBTR',1,'C',0);
$this->pdf->Cell(10,5,utf8_decode('2'),'LBTR',0,'C',0);
$this->pdf->Cell(70,5,utf8_decode('MARCEL ROBERT ARCURI GOMEZ'),'LBTR',0,'C',0);
$this->pdf->Cell(15,5,utf8_decode('7-B'),'LBTR',0,'C',0);
$this->pdf->Cell(45,5,utf8_decode('0243-2456350 / 0424-3707675'),'LBTR',0,'C',0);
$this->pdf->Cell(50,5,utf8_decode('MARCEL.ARCURI@GMAIL.COM'),'LBTR',1,'C',0);
$this->pdf->Cell(10,5,utf8_decode('3'),'LBTR',0,'C',0);
$this->pdf->Cell(70,5,utf8_decode('MARCEL ROBERT ARCURI GOMEZ'),'LBTR',0,'C',0);
$this->pdf->Cell(15,5,utf8_decode('7-B'),'LBTR',0,'C',0);
$this->pdf->Cell(45,5,utf8_decode('0243-2456350 / 0424-3707675'),'LBTR',0,'C',0);
$this->pdf->Cell(50,5,utf8_decode('MARCEL.ARCURI@GMAIL.COM'),'LBTR',1,'C',0);


//$fecha = date('d/m/Y');
//$hora = date("h:i:s a");
//$this->pdf->Cell(30,5,"FECHA: $fecha",'B',0,'L',1);
//$this->pdf->Cell(30,5,"",'B',0,'L',1);
//$this->pdf->Cell(30,5,"HORA: $hora",'B',0,'L',1);
//$this->pdf->Cell(95,5,"",'B',1,'R',1);

//if ($usuario != "xxx"){
//	$usuario = $usuario->username;
//}else{
//	$usuario = 'Todos';
//}
//
//if ($desde != "xxx" && $hasta != "xxx"){
//	$desde = explode("-",$desde);
//	$desde = $desde[2]."-".$desde[1]."-".$desde[0];
//	$hasta = explode("-",$hasta);
//	$hasta = $hasta[2]."-".$hasta[1]."-".$hasta[0];
//}

//$this->pdf->Cell(30,5,"DATOS DEL REPORTE",'T',1,'L',1);
////~ $this->pdf->Cell(35,5,"RIF/CI: ".$cliente->tipocliente."-".$cliente->cirif,'',0,'L',1);
////$this->pdf->Cell(35,5,utf8_decode("USUARIO: $usuario"),'',0,'L',1);
////$this->pdf->Cell(60,5,utf8_decode("FECHA INICIAL: $desde"),'',0,'L',1);
////$this->pdf->Cell(60,5,utf8_decode("FECHA FINAL: $hasta"),'',1,'L',1);
//
//
//$this->pdf->Cell(30,5,"Modelo",'TB',0,'L',1);
//$this->pdf->Cell(30,5,utf8_decode("Código"),'TB',0,'C',1);
//$this->pdf->Cell(85,5,utf8_decode("Acción"),'TB',0,'L',1);
//$this->pdf->Cell(20,5,"Fecha ",'TB',0,'L',1);
//$this->pdf->Cell(20,5,"Hora",'TB',1,'R',1);
//
//$j = 0;  # Contador para el salto de página
//
//foreach ($auditoria as $auditoria){
//	
//	#Sección para el salto de página
//	if ($j == 45){
//		$this->pdf->AddPage();
//		$this->pdf->SetFillColor(255,255,255);
//		$this->pdf->SetFont('Arial','B',14);
//		$this->pdf->Ln(1);
//		$this->pdf->Cell(190,5,"",'',1,'C',1);
//		$this->pdf->MultiCell(190,5,utf8_decode('A.C BIBLIOTECAS VIRTUALES DE ARAGUA'),'','C',0);
//		$this->pdf->SetFont('Arial','',8);
//		//~ $this->pdf->Cell(30,5,"RIF:",'',0,'C',1);
//		$this->pdf->Cell(190,5,"RIF:   G-20010539-9",'',1,'C',1);
//		$texto = 'AV. SUCRE. URB. SAN ISIDRO - MARACAY. EDIF. BIBLIOTECA VIRTUAL. NRO. 26';
//		//$this->pdf->MultiCell(190,5,utf8_decode($texto),'','C',0);
//		$fecha = date('d/m/Y');
//		$hora = date("h:i:s a");
//		$this->pdf->Cell(30,5,"FECHA: $fecha",'B',0,'L',1);
//		$this->pdf->Cell(30,5,"",'B',0,'L',1);
//		$this->pdf->Cell(30,5,"HORA: $hora",'B',0,'L',1);
//		$this->pdf->Cell(95,5,"",'B',1,'R',1);
//		
//		$this->pdf->Cell(30,5,"DATOS DEL REPORTE",'T',1,'L',1);
//		//~ $this->pdf->Cell(35,5,"RIF/CI: ".$cliente->tipocliente."-".$cliente->cirif,'',0,'L',1);
//		//$this->pdf->Cell(35,5,utf8_decode("USUARIO: $usuario"),'',0,'L',1);
//		//$this->pdf->Cell(60,5,utf8_decode("FECHA INICIAL: $desde"),'',0,'L',1);
//		//$this->pdf->Cell(60,5,utf8_decode("FECHA FINAL: $hasta"),'',1,'L',1);
//
//
//		$this->pdf->Cell(30,5,"Modelo",'TB',0,'L',1);
//		$this->pdf->Cell(30,5,utf8_decode("Código"),'TB',0,'C',1);
//		$this->pdf->Cell(85,5,utf8_decode("Acción"),'TB',0,'L',1);
//		$this->pdf->Cell(20,5,"Fecha ",'TB',0,'L',1);
//		$this->pdf->Cell(20,5,"Hora",'TB',1,'R',1);
//
//		#pdf.ln(60)
//		$j = 0;
//	}
//	
//	//$fecha_auditoria = explode("-",$auditoria->fecha);
//	//$fecha_auditoria = $fecha_auditoria[2]."-".$fecha_auditoria[1]."-".$fecha_auditoria[0];
//	//$this->pdf->Cell(30,5,utf8_decode("$auditoria->tabla"),'',0,'L',1);
//	//$this->pdf->Cell(30,5,"$auditoria->codigo",'',0,'C',1);
//	//$this->pdf->Cell(85,5,utf8_decode("$auditoria->accion"),'',0,'L',1);
//	//$this->pdf->Cell(20,5,"$fecha_auditoria",'',0,'L',1);
//	//$this->pdf->Cell(20,5,"$auditoria->hora",'',1,'R',1);
//	
//	$j += 1;
//}
$this->pdf->Cell(190,1,"",'T',1,'R',1);  // Cierre de bloque de productos/servicios

// Salida del Formato PDF
$this->pdf->Output("FICHA.pdf", 'I');
