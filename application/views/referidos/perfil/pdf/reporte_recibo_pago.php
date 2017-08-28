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
$this->pdf->SetFont('Arial','B',20);
$this->pdf->Ln(10);
//////////////// LOGO NOMBRE REPORTE
$this->pdf->Image(base_url().'static/img/logo4.png',15,15,45);
$this->pdf->Cell(190,5,"",'',1,'C',0);
$this->pdf->Cell(190,5,utf8_decode("RECIBO DE PAGO"),'',1,'C',0);
$this->pdf->Ln(15);
////////////// CABECERA DE TABLA
$this->pdf->SetFillColor(0,26,90); # COLOR DE BOLDE DE LA CELDA
$this->pdf->SetDrawColor(0,26,90); 
$this->pdf->SetTextColor(255,255,255); # COLOR DEL TEXTO
$this->pdf->SetFont('Arial','B',10);
$this->pdf->Cell(190,5,utf8_decode("Información"),'LBTR',1,'C',1);
$this->pdf->SetFont('Arial','',10);
$this->pdf->SetFillColor(255,255,255); # COLOR DE BOLDE DE LA CELDA
$this->pdf->SetTextColor(0,0,0); # COLOR DEL TEXTO

////////////////  INFORMACION DEL USUARIO
$nombre = $usuario[0]->first_name.' '.$usuario[0]->last_name;
$username = $usuario[0]->username;
$this->pdf->Cell(155,5,"Usuario: $username",'LT',0,'L',1);
$codigo = str_pad($pago[0]->codigo, 5, '0',STR_PAD_LEFT);

$fe = explode('-',$pago[0]->fecha_pago);
$fecha = $fe[2].'-'.$fe[1].'-'.$fe[0];
$this->pdf->Cell(35,5,utf8_decode("Código: P-$codigo"),'TR',1,'L',1);
$this->pdf->Cell(155,5,utf8_decode("Nombre Completo: $nombre"),'L',0,'L',1);
$this->pdf->Cell(35,5,utf8_decode("Fecha: $fecha"),'R',1,'L',1);
$correo = $usuario[0]->email;
$this->pdf->Cell(190,5,"Correo: $correo",'LR',1,'L',1);
$pais_id = $usuario[0]->pais_id;
foreach ($listar_paises as $paises){
    if ($paises->codigo == $pais_id){
        $pais = $paises->descripcion;
    }
}
$this->pdf->Cell(145,5,utf8_decode("País: $pais"),'LB',0,'L',1);
$operador_id = $pago[0]->operador_id;
foreach ($listar_usuarios as $usuarios){
    if ($usuarios->codigo == $operador_id){
        $operador = $usuarios->username;
    }
}
$this->pdf->Cell(45,5,utf8_decode("Operador: $operador"),'RB',1,'R',1);


/////////////// PAGO
$this->pdf->Ln(5);
$this->pdf->SetFont('Arial','B',10);
$this->pdf->Cell(10,5,utf8_decode("#"),'B',0,'C',1);
$this->pdf->Cell(150,5,utf8_decode("Monedero"),'B',0,'C',1);
$this->pdf->Cell(30,5,utf8_decode("Monto"),'B',1,'C',1);

$this->pdf->SetFont('Arial','',10);
$monto = $pago[0]->monto;
$total = number_format($monto, 2, ',', '.');
$dir_monedero = $pago[0]->dir_monedero;
$this->pdf->Cell(10,5,utf8_decode("1"),'B',0,'C',1);
$this->pdf->Cell(130,5,utf8_decode("$dir_monedero"),'B',0,'L',1);
$this->pdf->Cell(50,5,"$total $moneda",'B',1,'R',1);

$this->pdf->SetFont('Arial','B',10);
$this->pdf->Cell(10,5,utf8_decode(""),'T',0,'L',1);
$this->pdf->Cell(150,5,utf8_decode("Total "),'T',0,'R',1);
$this->pdf->Cell(30,5,utf8_decode("$total ".trim($moneda)),'T',1,'R',1);







//~ $tipo_pago = $pago[0]->tipo_pago;
//~ if ($tipo_pago ==1){
    //~ $tipo_pago = 'Desposito';
//~ }else{
    //~ $tipo_pago = 'Transferencia';
//~ }
//~ $this->pdf->Cell(50,5,"Tipo de Pago: $tipo_pago",'LBTR',0,'L',1);

//~ $banco_id = $listar_cuenta[0]->banco_id;
//~ foreach ($listar_bancos as $bancos){
    //~ if ($bancos->codigo == $banco_id){
        //~ $banco = $bancos->descripcion;
    //~ }
//~ }
//~ $this->pdf->Cell(75,5,utf8_decode("Banco: $banco"),'LBTR',1,'L',1);

//~ $num_cuenta = $listar_cuenta[0]->descripcion;
//~ $tipo_cuenta_id = $listar_cuenta[0]->tipo_cuenta_id;
//~ foreach ($listar_t_cuentas as $t_cuenta){
    //~ if ($t_cuenta->codigo == $tipo_cuenta_id){
        //~ $t_cuenta_nombre = $t_cuenta->descripcion;
    //~ }
//~ }



$this->pdf->Ln(10);
$linea = '--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------';
$this->pdf->Cell(190,5,$linea,'',1,'C',1);

$this->pdf->Output("Recibo de Pago.pdf", 'I');
