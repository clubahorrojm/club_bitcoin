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
$this->pdf->Image(base_url().'static/img/logo_reporte.jpg',15,15,45);
$this->pdf->Cell(190,5,"",'',1,'C',1);
$this->pdf->Cell(30,5,utf8_decode(''),'',0,'C',0);
$this->pdf->Cell(140,5,utf8_decode("$empresa->nombre_empresa"),'',1,'C',0);
$this->pdf->SetFont('Arial','',10);
$this->pdf->Cell(30,5,utf8_decode(''),'',0,'C',0);
$this->pdf->Cell(140,5,utf8_decode("Teléfonos: $empresa->telefono1 / $empresa->telefono2"),'',1,'C',0);
$this->pdf->Cell(30,5,utf8_decode(''),'',0,'C',0);
$this->pdf->Cell(140,4,utf8_decode("Correo: $empresa->correo"),'',1,'C',0);
$this->pdf->Ln(5);
$this->pdf->SetFillColor(60,141,188); # COLOR DE BOLDE DE LA CELDA
$this->pdf->SetDrawColor(60,141,188); 
$this->pdf->SetTextColor(255,255,255); # COLOR DEL TEXTO
$this->pdf->SetFont('Arial','B',10);
$this->pdf->Cell(190,5,"Recibo de Pago",'LBTR',1,'C',1);
$this->pdf->SetFont('Arial','',10);
$this->pdf->SetFillColor(255,255,255); # COLOR DE BOLDE DE LA CELDA
$this->pdf->SetTextColor(0,0,0); # COLOR DEL TEXTO
$username = $usuario[0]->username;
$this->pdf->Cell(65,5,"Usuario: $username",'LBTR',0,'L',1);
$nombre = $usuario[0]->first_name.' '.$usuario[0]->last_name;
$this->pdf->Cell(125,5,utf8_decode("Nombre Completo: $nombre"),'LBTR',1,'L',1);
$monto = $pago[0]->monto;
$this->pdf->Cell(30,5,"Monto: $monto $moneda",'LBTR',0,'L',1);
$fe = explode('-',$pago[0]->fecha_pago);
$fecha = $fe[2].'-'.$fe[1].'-'.$fe[0];
$this->pdf->Cell(35,5,utf8_decode("Fecha: $fecha"),'LBTR',0,'L',1);
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
$dir_monedero = $pago[0]->dir_monedero;
$this->pdf->Cell(125,5,utf8_decode("Dir. monedero: $dir_monedero"),'LBTR',1,'L',1);

$operador_id = $pago[0]->operador_id;
foreach ($listar_usuarios as $usuario){
    if ($usuario->codigo == $operador_id){
        $operador = $usuario->username;
    }
}
$this->pdf->Cell(65,5,utf8_decode("Operador: $operador"),'LBTR',1,'L',1);
$this->pdf->Ln(1);
$linea = '--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------';
$this->pdf->Cell(190,5,$linea,'',1,'C',1);

$this->pdf->Output("Recibo de Pago.pdf", 'I');
