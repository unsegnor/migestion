<?php

//Generamos el pdf
include_once dirname(__FILE__) . "/fpdf.php";


function t($texto) {
    return iconv('UTF-8', 'windows-1252', $texto);
}
