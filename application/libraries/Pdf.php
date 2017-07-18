<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
// Incluimos el archivo fpdf
require_once APPPATH . "/third_party/fpdf/fpdf.php";

//Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
class Pdf extends FPDF
{

    public function __construct()
    {
        parent::__construct();
    }
    
    public function Header()
    {   /*Y = Eje izquierdo
        # Z = Arriba / Abajo
        # D = Dimencion de la imagen */
                                                      # Y  Z D
        //~ $this->Image(base_url().'script/image/Home.png',15,7,20);
    }
    
    // El pie del pdf
    public function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'R');
    }

    function Format_number($decimal)
    {
        $result = str_replace('', '', number_format($decimal, 2, ",", "."))." Bs";
        return $result;
    }

}

// Clase para el reporte de ventas
class PdfVentas extends FPDF
{

    public function __construct()
    {
        parent::__construct();
    }
    
    public function Header()
    {   /*Y = Eje izquierdo
        # Z = Arriba / Abajo
        # D = Dimencion de la imagen */
                                                      # Y  Z D
        //~ $this->Image(base_url().'script/image/Home.png',15,7,20);
    }
    
    // El pie del pdf
    public function Footer()
    {
        $this->SetY(-30);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(55,5,"",'',0,'C',1);
		$this->Cell(75,5,"Firma",'T',0,'C',1);
		$fecha_actual = date('d/m/Y');
		$this->Cell(55,5,"Fecha: $fecha_actual",'',1,'R',1);
		$this->SetY(-15);
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'R');
    }

    function Format_number($decimal)
    {
        $result = str_replace('', '', number_format($decimal, 2, ",", "."))." Bs";
        return $result;
    }

}

// Clase para el reporte de auto-consumo
class PdfAutoconsumo extends FPDF
{

    public function __construct()
    {
        parent::__construct();
    }
    
    public function Header()
    {   /*Y = Eje izquierdo
        # Z = Arriba / Abajo
        # D = Dimencion de la imagen */
                                                      # Y  Z D
        //~ $this->Image(base_url().'script/image/Home.png',15,7,20);
    }
    
    // El pie del pdf
    public function Footer()
    {
        $this->SetY(-30);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(75,5,utf8_decode("Gerente de Admnistración"),'T',0,'C',1);
		$this->Cell(35,5,"",'',0,'C',1);
		//~ $fecha_actual = date('d/m/Y');
		$this->Cell(75,5,"Presidente",'T',1,'C',1);
		$this->SetY(-15);
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'R');
    }

    function Format_number($decimal)
    {
        $result = str_replace('', '', number_format($decimal, 2, ",", "."))." Bs";
        return $result;
    }

}

// Clase para el reporte de auto-consumo
class PdfInventario extends FPDF
{

    public function __construct()
    {
        parent::__construct();
    }
    
    public function Header()
    {   /*Y = Eje izquierdo
        # Z = Arriba / Abajo
        # D = Dimencion de la imagen */
                                                      # Y  Z D
        //~ $this->Image(base_url().'script/image/Home.png',15,7,20);
    }
    
    // El pie del pdf
    public function Footer()
    {
        $this->SetY(-30);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(75,5,utf8_decode("Gerente de Administración"),'T',0,'C',1);
		$this->Cell(35,5,"",'',0,'C',1);
		//~ $fecha_actual = date('d/m/Y');
		$this->Cell(75,5,"Presidente",'T',1,'C',1);
		$this->SetY(-15);
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'R');
    }

    function Format_number($decimal)
    {
        $result = str_replace('', '', number_format($decimal, 2, ",", "."))." Bs";
        return $result;
    }

}

// Clase para el reporte de auto-consumo
class PdfInventarioTerminal extends FPDF
{

    public function __construct()
    {
        parent::__construct();
    }
    
    public function Header()
    {   /*Y = Eje izquierdo
        # Z = Arriba / Abajo
        # D = Dimencion de la imagen */
                                                      # Y  Z D
        //~ $this->Image(base_url().'script/image/Home.png',15,7,20);
    }
    
    // El pie del pdf
    public function Footer()
    {
        $this->SetY(-30);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(75,5,utf8_decode("Gerente de Comercialización"),'T',0,'C',1);
		$this->Cell(35,5,"",'',0,'C',1);
		//~ $fecha_actual = date('d/m/Y');
		$this->Cell(75,5,"Presidente",'T',1,'C',1);
		$this->SetY(-15);
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'R');
    }

    function Format_number($decimal)
    {
        $result = str_replace('', '', number_format($decimal, 2, ",", "."))." Bs";
        return $result;
    }

}

?>
