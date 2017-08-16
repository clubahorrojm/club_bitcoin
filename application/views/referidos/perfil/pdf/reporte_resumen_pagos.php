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
$this->pdf->Cell(190,5,"Resumen de pagos de referidos recibidos",'LBTR',1,'C',1);
$this->pdf->SetFont('Arial','',10);
$this->pdf->SetFillColor(255,255,255); # COLOR DE BOLDE DE LA CELDA
$this->pdf->SetTextColor(0,0,0); # COLOR DEL TEXTO
$username = $usuario[0]->username;
$this->pdf->Cell(65,5,"Usuario: $username",'LBTR',0,'L',1);
$nombre = $usuario[0]->first_name.' '.$usuario[0]->last_name;
$this->pdf->Cell(125,5,utf8_decode("Nombre Completo: $nombre"),'LBTR',1,'L',1);

$this->pdf->Ln(5);
$this->pdf->SetFont('Arial','B',10);
$this->pdf->Cell(10,5,"#",'B',0,'C',1);
$this->pdf->Cell(130,5,"Usuario",'B',0,'C',1);
$this->pdf->Cell(50,5,"Monto",'B',1,'C',1);
$this->pdf->SetFont('Arial','',10);
$i=1;
$total = 0.0;
foreach ($listar_distribuciones as $pagos){
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
        $this->pdf->Cell(190,5,"Resumen de pagos de referidos recibidos",'LBTR',1,'C',1);
        $this->pdf->SetFont('Arial','',10);
        $this->pdf->SetFillColor(255,255,255); # COLOR DE BOLDE DE LA CELDA
        $this->pdf->SetTextColor(0,0,0); # COLOR DEL TEXTO
        //$username = $usuario[0]->username;
        $this->pdf->Cell(65,5,"Usuario: $username",'LBTR',0,'L',1);
        //$nombre = $usuario[0]->first_name.' '.$usuario[0]->last_name;
        $this->pdf->Cell(125,5,utf8_decode("Nombre Completo: $nombre"),'LBTR',1,'L',1);
        
        $this->pdf->Ln(5);
        $this->pdf->SetFont('Arial','B',10);
        $this->pdf->Cell(10,5,"#",'B',0,'C',1);
        $this->pdf->Cell(130,5,"Usuario",'B',0,'C',1);
        $this->pdf->Cell(50,5,"Monto",'B',1,'C',1);
        $this->pdf->SetFont('Arial','',10);
		$i = 1;
	}
    
    $this->pdf->Cell(10,5,"$i",'',0,'C',1);
    foreach ($listar_usuarios as $usuario){
        if ($usuario->codigo == $pagos->usuario_id){
            $referido = $usuario->username;
        }
    }
    $this->pdf->Cell(130,5,"$referido",'',0,'C',1);
	$monto = number_format($pagos->monto, 2, ',', '.');
    $monto_pdf = number_format($pagos->monto, 2, ',', '.');
    $this->pdf->Cell(50,5,"$monto_pdf ".trim($moneda),'',1,'R',1);
    $total = $total + $monto;
    $i = $i +1;
}
$total = number_format($total, 2, ',', '.');
$this->pdf->SetFont('Arial','B',10);
$this->pdf->Cell(10,5,utf8_decode(""),'T',0,'L',1);
$this->pdf->Cell(130,5,utf8_decode("Total "),'T',0,'R',1);
$this->pdf->Cell(50,5,utf8_decode("$total ".trim($moneda)),'T',1,'R',1);


$this->pdf->Output("Resumen de pagos recibidos.pdf", 'I');
