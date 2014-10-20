<?php

require('/fpdf/pdf.php');

include_once dirname(__FILE__) . "./../core/funciones.php";

class facturaPDF extends FPDF {

    //Variable factura
    var $factura;

    function setFactura($objeto_factura) {
        $this->factura = $objeto_factura;
    }

    function Header() {

        $this->Ln(5);
        $this->SetFont('Arial', 'B', 25);
        $this->left("FACTURA");
        
        //Logo
        $this->Image("./logotexto.png", 150, 8, 50, 17);
        //Salto de Línea
        $this->Ln(15);

        $this->SetFont('Arial', 'B', 12);

        //$this->Cell(190, 10, t("CALATI"), 0, 1, 'C');
        //$this->Ln(10);
        $this->SetFont('Arial', 'B', 10);
        $this->left("Calle Veleta , 43");
        $this->SetFont('Arial', 'B', 10);
        $this->right("Víctor Calatayud Asensio");
        //$this->SetFont('Arial', '', 10);
        $this->Ln(5);
        $this->left("18015 GRANADA");
        $this->SetFont('Arial', 'B', 10);
        $this->right("Móvil: 692 27 93 18");
        //$this->SetFont('Arial', '', 10);
        $this->Ln(5);
        $this->left("CIF: 47661755M");
        $this->SetFont('Arial', 'B', 10);
        $this->right("e.mail: lacuentadevictor@gmail.com");
        $this->SetFont('Arial', '', 10);
        $this->Ln(5);
        $this->SetFont('Arial', '', 10);
        $this->Ln(5);
        $this->campo("Nº Factura", sprintf('%08d', $this->factura['numero_factura']));
        $this->Ln(5);
        $this->campo("Fecha", f_php2str($this->factura['fecha_expedicion']));
        $this->Ln(5);
        $this->campo("N.I.F. Cliente", '12345678K');
        //$this->Ln(5);


        //Colocamos los datos del receptor para que se vean por la ventana del sobre
        $this->SetFont('Arial', '', 10);
        $x = 98.5;
        $y = 50;
        $ancho = 90;

        $datos_envio_receptor = 'razon_social_receptor'
                . "\n"
                . 'domicilio_receotir';

        $this->SetXY($x, $y);
        $this->MultiCell($ancho, 5, t($datos_envio_receptor));
        $this->Ln(10);
        //Construimos el encabezado de la tabla
        $this->Cell(150, 5, "Concepto", 1, 0, 'C');
        $this->Cell(40, 5, "Importe", 1, 0, 'C');
    }

    function Footer() {
        // Posición a 1,5 cm del final
        $this->SetY(-35);
        //Garantía
        $this->SetFont('Arial', 'B', 8);
        $this->MultiCell(0, 3, t("LA POSESIÓN DE ESTA FACTURA NO IMPLICA EL PAGO DE LA MISMA. PARA ACREDITARLO SERÁ NECESARIO DOCUMENTO BANCARIO O RECIBÍ QUE LO JUSTIFIQUE."), 0, 'C');
        $this->SetFont('Arial', 'B', 7);
        $this->MultiCell(0, 3, t("Víctor Calatayud Asensio con C.I.F 47661755M, inscrito en el Registro Mercantil de Granada al tomo 67, folio 178, de la Sección General, inscripción 1ª de la hoja registral CR-1892."), 0, 'C');
        $this->MultiCell(0, 3, t("De acuerdo con lo que establece la Ley Orgánica de Protección de Datos (LOPD) 15/1999, le informamos que los datos personales recogidos en este documento serán incluidos en un fichero bajo la responsabilidad de Víctor Calatayud Asensio, con la finalidad de cumplir los compromisos entre las partes. Puede ejercer sus derechos de acceso, cancelación, rectificación y oposición en Calle Veleta 43, 18015, Granada (Granada)"), 0, 'C');
    }

    function campo($nombre, $valor) {
        $ancho_nombre = max(array(strlen($nombre) * 3, 40));
        $ancho_valor = max(array(strlen($valor) * 3, 40));
        $this->SetFont('Arial', 'B', 10);
        $this->Cell($ancho_nombre, 5, t($nombre . ":"), 0, 0, '');
        $this->SetFont('Arial', '', 10);
        $this->Cell($ancho_valor, 5, t($valor), 0, 0, '');
    }

    function textarea($nombre, $texto) {
        $ancho_nombre = max(array(strlen($nombre) * 3, 40));
        $ancho_valor = 95;
        $this->Cell($ancho_nombre, 5, t($nombre . ":"), 0, 1, '');
        $this->SetFont('Arial', 'B', 10);

        //Dividir el texto cada N caracteres

        $this->MultiCell(0, 5, t($texto));

        $this->SetFont('Arial', '', 10);
    }

    function linea($texto) {
        $this->Cell(190, 5, t($texto), 0, 1, '');
    }

    function texto($texto) {
        $this->Cell(strlen($texto) * 3, 5, t($texto), 0, 0, '');
    }

    function columna($texto) {
        $this->Cell(95, 5, t($texto), 0, 0, '');
    }

    function right($texto) {
        $this->Cell(95, 5, t($texto), 0, 0, 'R');
    }

    function left($texto) {
        $this->Cell(95, 5, t($texto), 0, 0, 'L');
    }

    function l() {
        $this->Ln(6);
    }

    function servicio($concepto, $importe) {
        $this->Cell(150, 5, t($concepto), 0, 0, 'L');
        if ($importe != null) {
            $this->Cell(40, 5, t($importe) . chr(128), 0, 0, 'R');
        }
    }

}

function generarFacturaPDF($id_factura) {


//obtenemos la factura
    $factura = getFacturaPorID($id_factura);


//obtenemos sus servicios 
    $servicios = getServiciosDeFactura($id_factura);


    $pdf = new facturaPDF();
    $pdf->setFactura($factura);
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 10);


    $pdf->Ln(6);

    $tipos_impositivos = array();

    foreach ($servicios as $servicio) {

        //Almacenamos los tipos impositivos distintos que aparecen
        $ti = $servicio['tipo_impositivo'];

        if (!isset($tipos_impositivos[$ti])) {
            $tipos_impositivos[$ti] = $ti;
        }

        //Inicializamos los subtotales por impuesto

        if (!isset($total_base[$ti])) {
            $total_base[$ti] = 0;
        }
        //Sumamos la base imponible para cada tipo impositivo
        $total_base[$ti] += $servicio['base_imponible'];

        if (!isset($total_cuota[$ti])) {
            $total_cuota[$ti] = 0;
        }
        $total_cuota[$ti] += $servicio['base_imponible'] * (($servicio['tipo_impositivo'] / 100));

        $pdf->MultiCell(150, 5, t($servicio['concepto']));
        //$pdf->Ln(5);
        $pdf->servicio("", $servicio['base_imponible']);
        $pdf->Ln(5);
    }

//Mostrar el resumen
    $suma_base = 0;
    $suma_cuota = 0;
    $suma_total = 0;


//Todo esto va abajo antes del pie
    $pdf->SetY(-60);
//Cabecera de los totales
    $pdf->Cell(190 / 4, 5, "Base", 1, 0, 'C');
    $pdf->Cell(190 / 4, 5, "I.V.A.", 1, 0, 'C');
    $pdf->Cell(190 / 4, 5, "Cuota", 1, 0, 'C');
    $pdf->Cell(190 / 4, 5, "Total", 1, 0, 'C');
    $pdf->Ln(5);


    foreach ($tipos_impositivos as $tipo_impositivo) {

        $tb = $total_base[$tipo_impositivo];
        $tc = $total_cuota[$tipo_impositivo];
        $suma_base += $tb;
        $suma_cuota += $tc;
        $suma_total += $tb + $tc;


        $pdf->Cell(190 / 4, 5, $tb . chr(128), 0, 0, 'C');
        $pdf->Cell(190 / 4, 5, $tipo_impositivo . "%", 0, 0, 'C');
        $pdf->Cell(190 / 4, 5, $tc . chr(128), 0, 0, 'C');
        $pdf->Cell(190 / 4, 5, "", 0, 0, 'C');
        $pdf->Ln(5);
    }

    $pdf->Cell(190 / 4, 5, "", 0, 0, 'C');
    $pdf->Cell(190 / 4, 5, "", 0, 0, 'C');
    $pdf->Cell(190 / 4, 5, "", 0, 0, 'C');
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(190 / 4, 5, $suma_total . chr(128), 0, 0, 'C');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Ln(5);


    return $pdf;
//$pdf->Output();
}
