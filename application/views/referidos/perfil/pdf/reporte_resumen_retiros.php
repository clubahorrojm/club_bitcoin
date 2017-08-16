<?php

$this->pdf   = new Pdf($orientation = 'L', $unit = 'mm', $format = 'A4');
// Agregamos una página
$this->pdf->AddPage();
// Define el alias para el número de página que se imprimirá en el pie
$this->pdf->AliasNbPages();

#$this->pdf->set_title(title)
$this->pdf->SetAuthor('Marcel Arcuri');
$this->pdf->SetFont('Arial','B',15);
$this->pdf->SetFillColor(157,188,201); # COLOR DE BOLDE DE LA CELDA

$this->pdf->SetTextColor(24,29,31); # COLOR DEL TEXTO
$this->pdf->SetMargins(10,15,10); # MARGEN DEL DOCUMENTO
#$this->pdf->ln(20) # Saldo de línea
# 10 y 50 eje x y y 200 dimensión

$this->pdf->SetFillColor(255,255,255);
$this->pdf->SetFont('Arial','B',14);
$this->pdf->Ln(1);
$this->pdf->Image(base_url().'static/img/logo4.png',15,15,45);
$this->pdf->Cell(190,5,"",'',1,'C',1);
$this->pdf->Cell(30,5,utf8_decode(''),'',0,'C',0);
$this->pdf->Cell(140,5,utf8_decode("$empresa->nombre_empresa"),'',1,'C',0);
$this->pdf->SetFont('Arial','',10);
$this->pdf->Cell(30,5,utf8_decode(''),'',0,'C',0);
$this->pdf->Cell(140,5,utf8_decode("Teléfonos: $empresa->telefono1 / $empresa->telefono2"),'',1,'C',0);
$this->pdf->Cell(30,5,utf8_decode(''),'',0,'C',0);
$this->pdf->Cell(140,4,utf8_decode("Correo: $empresa->correo"),'',1,'C',0);
$this->pdf->Ln(5);
$this->pdf->SetFillColor(0,26,90); # COLOR DE BOLDE DE LA CELDA
$this->pdf->SetDrawColor(0,26,90); 
$this->pdf->SetTextColor(255,255,255); # COLOR DEL TEXTO
$this->pdf->SetFont('Arial','B',10);
$this->pdf->Cell(190,5,"Resumen de retiros realizados",'LBTR',1,'C',1);
$this->pdf->SetFont('Arial','',10);
$this->pdf->SetFillColor(255,255,255); # COLOR DE BOLDE DE LA CELDA
$this->pdf->SetTextColor(0,0,0); # COLOR DEL TEXTO
$username = $usuario[0]->username;
$this->pdf->Cell(65,5,"Usuario: $username",'LBTR',0,'L',1);
$nombre = $usuario[0]->first_name.' '.$usuario[0]->last_name;
$this->pdf->Cell(125,5,utf8_decode("Nombre Completo: $nombre"),'LBTR',1,'L',1);

$this->pdf->Ln(5);
$this->pdf->SetFont('Arial','B',10);
$this->pdf->Cell(15,5,"#",'B',0,'C',1);
$this->pdf->Cell(35,5,utf8_decode("N° Pago"),'B',0,'C',1);
$this->pdf->Cell(35,5,"Fecha",'B',0,'C',1);
$this->pdf->Cell(35,5,"Monto",'B',0,'C',1);
$this->pdf->Cell(25,5,utf8_decode("Comisión"),'B',0,'C',1);
$this->pdf->Cell(45,5,"Sub Total",'B',1,'C',1);
$this->pdf->SetFont('Arial','',10);
$i=1;
$total = 0.0;
foreach ($listar_retiros as $retiros){
    #Sección para el salto de página
	if ($i == 20){
		$this->pdf->AddPage();
		$this->pdf->SetFillColor(255,255,255);
		$this->pdf->Image(base_url().'static/img/logo4.png',15,15,45);
        $this->pdf->Cell(190,5,"",'',1,'C',1);
        $this->pdf->Cell(40,5,utf8_decode(''),'',0,'C',0);
        $this->pdf->Cell(150,5,utf8_decode("$empresa->nombre_empresa"),'',1,'C',0);
        $this->pdf->SetFont('Arial','',10);
        $this->pdf->Cell(40,5,utf8_decode(''),'',0,'C',0);
        $this->pdf->Cell(150,5,utf8_decode("Teléfonos: $empresa->telefono1 / $empresa->telefono2"),'',1,'C',0);
        $this->pdf->Cell(40,5,utf8_decode(''),'',0,'C',0);
        $this->pdf->Cell(150,4,utf8_decode("Correo: $empresa->correo"),'',1,'C',0);
        $this->pdf->Ln(5);
        $this->pdf->SetFillColor(0,26,90); # COLOR DE BOLDE DE LA CELDA
        $this->pdf->SetDrawColor(0,26,90); 
        $this->pdf->SetTextColor(255,255,255); # COLOR DEL TEXTO
        $this->pdf->SetFont('Arial','B',10);
        $this->pdf->Cell(190,5,"Resumen de retiros realizados",'LBTR',1,'C',1);
        $this->pdf->SetFont('Arial','',10);
        $this->pdf->SetFillColor(255,255,255); # COLOR DE BOLDE DE LA CELDA
        $this->pdf->SetTextColor(0,0,0); # COLOR DEL TEXTO
        //$username = $usuario[0]->username;
        $this->pdf->Cell(65,5,"Usuario: $username",'LBTR',0,'L',1);
        //$nombre = $usuario[0]->first_name.' '.$usuario[0]->last_name;
        $this->pdf->Cell(125,5,utf8_decode("Nombre Completo: $nombre"),'LBTR',1,'L',1);
        
        $this->pdf->Ln(5);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(15,5,"#",'B',0,'C',1);
		$this->pdf->Cell(35,5,utf8_decode("N° Pago"),'B',0,'C',1);
		$this->pdf->Cell(35,5,"Fecha",'B',0,'C',1);
		$this->pdf->Cell(35,5,"Monto",'B',0,'C',1);
		$this->pdf->Cell(25,5,utf8_decode("Comisión"),'B',0,'C',1);
		$this->pdf->Cell(45,5,"Sub Total",'B',1,'C',1);
		$this->pdf->SetFont('Arial','',10);
		$i = 1;
	}
    $this->pdf->Cell(15,5,"$i",'',0,'C',1);
	$this->pdf->Cell(35,5,"$retiros->num_pago",'',0,'C',1);
	$fe = explode('-',$retiros->fecha_verificacion);
	$fecha = $fe[2].'-'.$fe[1].'-'.$fe[0];
	$this->pdf->Cell(35,5,"$fecha",'',0,'C',1);
	$monto = $retiros->monto;
	$monto_pdf = number_format($retiros->monto, 2, ',', '.');
    $this->pdf->Cell(35,5,"$monto_pdf ".trim($moneda),'',0,'R',1);
	$this->pdf->Cell(25,5,"$retiros->porcentaje_comision %",'',0,'C',1);
	$comision = ($monto * $retiros->porcentaje_comision) / 100;
	//$comision_pdf = number_format($comision, 2, ',', '.');
	$sub_total = $comision + $monto;
	$sub_total_pdf = number_format($sub_total, 2, ',', '.');
	$this->pdf->Cell(45,5,"$sub_total_pdf ".trim($moneda),'',1,'R',1);
    $total = $total + $sub_total;
    $i = $i +1;
}
$total = number_format($total, 2, ',', '.');
$this->pdf->SetFont('Arial','B',10);
$this->pdf->Cell(10,5,utf8_decode(""),'T',0,'L',1);
$this->pdf->Cell(135,5,utf8_decode("Total "),'T',0,'R',1);
$this->pdf->Cell(45,5,utf8_decode("$total ".trim($moneda)),'T',1,'R',1);


$this->pdf->Output("Resumen de pagos recibidos.pdf", 'I');
