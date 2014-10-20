<?php

function f_php2bdd($fecha) {
    $respuesta = "NULL";
    if ($fecha != null) {
        $respuesta = "'" . escape($fecha->format(Formatos::formato_fechas_mysql)) . "'";
    }
    return $respuesta;
}

function f_bdd2php($fecha) {
    $respuesta = null;
    if ($fecha != null && $fecha != "" && $fecha != 0 && $fecha != "0") {
        $respuesta = new DateTime($fecha);
    }
    return $respuesta;
}

function f_php2html($fecha) {
    $respuesta = "";
    if ($fecha != null) {
        $respuesta = $fecha->format(Formatos::formato_fechas_html5);
    }
    return $respuesta;
}

function fyh_php2html($fecha) {
    $respuesta = "";
    if ($fecha != null) {
        $respuesta = $fecha->format(Formatos::formato_fechayhora_html5);
    }
    return $respuesta;
}

function numeric($array, $id) {
    $respuesta = 0;
    //Si no es numérico devolvemos cero
    if (isset($array[$id])) {
        $dato = $array[$id];
        if (is_numeric($dato)) {
            $respuesta = $dato;
        }
    }

    return $respuesta;
}

/**
 * Convierte el booleano desde bdd
 * @param type $dato
 * @return type
 */
function getOrZero($array, $id) {
    return isset($array[$id]) ? $array[$id] : 0;
}

function getOrNull($array, $id) {
    return isset($array[$id]) ? $array[$id] : null;
}

/**
 * Se utiliza para almacenar valores en la base de dato propagando el NULL como valor válido
 * @param type $dato
 * @return type
 */
function setOrNull($dato) {
    return $dato == null ? "NULL" : "'" . escape($dato) . "'";
}

/**
 * Se utiliza para almacenar valores en la base de datos poniendo un 0 si no hay nada como valor válido
 * @param type $dato
 * @return type
 */
function setOrZero($dato) {
    return $dato == null || $dato == "" ? 0 : "'" . escape($dato) . "'";
}

/**
 * Devuelve la fecha en el formato que queremos verla
 * @param type $fecha
 */
function f_php2str($fecha) {
    $respuesta = "";
    if ($fecha != null) {
        $respuesta = $fecha->format(Formatos::formato_fechas);
    }
    return $respuesta;
}

function fyh_php2str($fecha) {
    $respuesta = "";
    if ($fecha != null) {
        $respuesta = $fecha->format(Formatos::formato_fechayhora);
    }
    return $respuesta;
}

function fyh_bdd2html($fecha){
    return fyh_php2html(f_bdd2php($fecha));
}

function f_bdd2html($fecha) {
    return f_php2html(f_bdd2php($fecha));
}

function f_bdd2str($fecha) {
    return f_php2str(f_bdd2php($fecha));
}

function fyh_bdd2str($fecha){
    return fyh_php2str(f_bdd2php($fecha));
}

function f_json2bdd($fecha){
    return f_php2bdd(f_bdd2php($fecha));
}