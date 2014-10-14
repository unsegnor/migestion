<?php

include_once dirname(__FILE__) . "./../core/funciones.php";


try {

    $peticion = json_decode($_REQUEST['p']);

    $funcionesPermitidas = array(
        'getClientes'
        ,'addCliente'
        ,'addFactura'
        ,'getFacturas'
        ,'getInfoFacturas'
        ,'getInfoFactura'
        ,'getServiciosFactura'
        ,'getClientesID'
        ,'addServicioFactura'
    );
    
    $funcionesProhibidas = array(
    );


//Si está permitida la ejecutamos y delvolvemos el resultado
    if (in_array($peticion->id_funcion, $funcionesPermitidas)
            && !in_array($peticion->id_funcion, $funcionesProhibidas)) {

        //Si tenemos parámetros los enviamos
        if (isset($peticion->parametros)) {
            $resultado = call_user_func_array($peticion->id_funcion, $peticion->parametros);
        } else {
            $resultado = call_user_func($peticion->id_funcion);
        }
    } else {
        throw new Exception("Función no permitida $peticion->id_funcion.");
    }

    $respuesta = new stdClass();
    $respuesta->hayerror = false;
    $respuesta->resultado = $resultado;
    
} catch (Exception $e) {
    $respuesta = new stdClass();
    $respuesta->hayerror = true;
    $respuesta->errormsg = $e->getMessage();
}

echo json_encode($respuesta);

