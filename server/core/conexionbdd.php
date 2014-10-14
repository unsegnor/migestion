<?php

include_once dirname(__FILE__) . "/BDD.php";
include_once dirname(__FILE__) . "/ConfiguracionLocal.php";

//Generamos una conexión principal a bdd
$conn = new BDD(ConfiguracionLocal::host, ConfiguracionLocal::bdd_name, ConfiguracionLocal::user_name, ConfiguracionLocal::pass);

function getBDD() {
    global $conn;
    return $conn;
}

function ejecutar($consulta) {
    global $conn;
    return $conn->ejecutar($consulta);
}

function escape($string) {
        global $conn;
        return $conn->escape($string);
}

function insert_id($consulta) {
    global $conn;
    return $conn->insert_id($consulta);
}

function toArray($resultado) {
    global $conn;
    return $conn->toArray($resultado);
}

function toArrayID($resultado, $id) {
    global $conn;
    return $conn->toArrayID($resultado, $id);
}

function iniciar_transaccion() {
    global $conn;
    return $conn->iniciar_transaccion();
}

function validar_transaccion() {
    global $conn;
    return $conn->validar_transaccion();
}

function cancelar_transaccion() {
    global $conn;
    return $conn->cancelar_transaccion();
}

?>
