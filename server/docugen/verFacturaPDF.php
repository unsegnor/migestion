<?php

include_once dirname(__FILE__) . "./facturaPDF.php";

//leemos el id de la factura
$id_factura = $_REQUEST['id'];

//Generamos el pdf
$facturaPDF = generarFacturaPDF($id_factura);

//Mostramos el PDF
$facturaPDF->Output();
