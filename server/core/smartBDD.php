<?php

include_once dirname(__FILE__) . "./conexionbdd.php";
include_once dirname(__FILE__) . "./constantes.php";

//Función que recibe el nombre de la tabla, el objeto y un array con 
//los campos y tipos de los campos que se van a insertar
//para realizar la inserción
function smart_insert($tabla, $objeto, $array_campo_tipo_conversion) {
    $consulta = "INSERT INTO " . escape($tabla) . " SET ";

    //Si el objeto es null es que viene sin campos
    if ($objeto == null) {
        throw new Exception("No hay datos que insertar.");
    }

    //Leemos los campos del objeto y sólo si coinciden con un campo del array
    //entonces lo tratamos según el tipo y lo insertamos en la consulta convertido
    $primero = true;
    foreach (get_object_vars($objeto) as $nombre => $valor) {

        //Si está entre los campos que aceptamos
        if (isset($array_campo_tipo_conversion[$nombre])) {

            $valorBDD;
            $valido = false;
            //Entonces lo tratamos según el tipo
            $tipo = $array_campo_tipo_conversion[$nombre];

            if ($tipo === 'str') {
                //Si es cadena lo tratamos como tal
                $valorBDD = "'" . escape($valor) . "'";
                $valido = true;
            } else if ($tipo === 'int') {
                $valorBDD = escape($valor);
                $valido = true;
            } else if ($tipo === 'fyh') {
                $valorBDD = "STR_TO_DATE('".escape($valor)."', '".Constantes::formato_fecha_mysql."')";
                $valido = true;
            }

            //Si es de un tipo válido
            if ($valido) {

                //Añadimos comas o lo que necesitemos en función de si es o no el primero
                if ($primero) {
                    $primero = false;
                } else {
                    $consulta.= ",";
                }

                //Añadimos el campo con su valor
                $consulta.= " " . escape($nombre) . " = ".$valorBDD;
            }
        }
    }

    //Si primero sigue siendo true es que ningún campo era válido y lanzamos una excepción
    if ($primero) {
        throw new Exception("Faltan campos por rellenar.");
    }

    //Ejecutamos la consulta
    return insert_id($consulta);
}
