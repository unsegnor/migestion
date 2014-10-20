<?php

include_once dirname(__FILE__) . "./constantes.php";
include_once dirname(__FILE__) . "./conexionbdd.php";
include_once dirname(__FILE__) . "./smartBDD.php";
include_once dirname(__FILE__) . "./utiles.php";

function getClientes() {
    return toArray(ejecutar("SELECT * FROM cliente"));
}

function addCliente($cliente) {
    $tabla = array();

    $tabla['nif_cif'] = 'str';
    $tabla['razon_social'] = 'str';
    $tabla['domicilio'] = 'str';
    $tabla['email'] = 'str';
    $tabla['telefono'] = 'str';
    $tabla['otros'] = 'str';

    return smart_insert('cliente', $cliente, $tabla);
}

function addFactura($factura) {
    $tabla = array();

    //Comprobamos cuántas facturas hay
    $nfacturas = getNFacturas();

    //Asignamos un número posterior
    $factura->numero_factura = $nfacturas + 1;

    $tabla['cliente_idcliente'] = 'int';
    $tabla['numero_factura'] = 'int';
    $tabla['otros'] = 'str';

    $idnuevo = smart_insert('factura', $factura, $tabla);
}

function getFacturas() {
    return toArray(ejecutar("SELECT * FROM factura"));
}

function getInfoFactura($id_factura) {
    $res = ejecutar("SELECT factura.*"
            . ", cliente.razon_social"
            . ", cliente.nif_cif"
            . " FROM factura"
            . " LEFT JOIN cliente ON factura.cliente_idcliente = cliente.idcliente"
            . " WHERE factura.idfactura = " . escape($id_factura));

    return $res->fetch_assoc();
}

function getInfoFacturas() {
    return toArray(ejecutar("SELECT factura.*"
                    . ", cliente.razon_social"
                    . ", cliente.nif_cif"
                    . " FROM factura"
                    . " LEFT JOIN cliente ON factura.cliente_idcliente = cliente.idcliente"));
}

function getNFacturas() {
    $res = ejecutar("SELECT COUNT(*) as num FROM factura");
    $fila = $res->fetch_assoc();
    return $fila['num'];
}

function getServiciosFactura($id_factura) {
    return toArray(ejecutar("SELECT * FROM servicio WHERE factura_idfactura = " . escape($id_factura)));
}

function addServicioFactura($id_factura, $servicio) {
    $servicio->factura_idfactura = $id_factura;

    $tabla['factura_idfactura'] = 'int';
    $tabla['concepto'] = 'str';
    $tabla['fecha_prestacion'] = 'fyh';    
    $tabla['base_imponible'] = 'str';
    $tabla['tipo_impositivo'] = 'str';    
    $tabla['otros'] = 'str';    

    return smart_insert('servicio', $servicio, $tabla);
}

function getFacturaPorID($id_factura){
    $consulta = "SELECT * FROM factura WHERE idfactura =".escape($id_factura);
    
    $res = ejecutar($consulta);
    
    $fila = $res->fetch_assoc();
    
    return $fila;
}

function getServiciosDeFactura($id_factura){
    $consulta = "SELECT * FROM servicio WHERE factura_idfactura =".escape($id_factura);
    
    return toArray(ejecutar($consulta));
}