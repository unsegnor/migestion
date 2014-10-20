<?php include dirname(__FILE__) . "./header.php"; ?>
<?php
$id = filter_input(INPUT_GET, 'id');
?>
<div ng-controller="controladordetallefactura" ng-init="init(<?php echo $id ?>)">
    <div class="container nocentrado">
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label>Cliente</label>
                    <select class="form-control" 
                            ng-model="factura.cliente_idcliente" 
                            ng-options="c.idcliente as c.razon_social for c in clientes">
                    </select>  
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Otros</label>
                    <textarea class="form-control"
                              ng-model="factura.otros"
                              placeholder="otros"></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <button class="btn btn-success pull-right" ng-click="guardarFactura()">Guardar</button>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <label>Concepto</label>
            </div>
            <div class="col-sm-3">
                <label>Fecha prestación</label>
            </div>
            <div class="col-sm-2">
                <label>Base imponible</label>
            </div>
            <div class="col-sm-2">
                <label>Tipo Impositivo</label>
            </div>
        </div>
        <div class="row" ng-repeat="servicio in servicios">
            <div class="col-sm-4">
                <input type="text" class="form-control" ng-model="servicio.concepto">
            </div>
            <div class="col-sm-3">
                <input type="datetime-local" class="form-control" ng-model="servicio.fecha_prestacion">
            </div>
            <div class="col-sm-2">
                <input type="number" step="0.01" min="0" class="form-control" ng-model="servicio.base_imponible">
            </div>
            <div class="col-sm-2">
                <input type="number" step="0.01" min="0" class="form-control" ng-model="servicio.tipo_impositivo">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <input type="text" class="form-control" ng-model="nuevoservicio.concepto">
            </div>
            <div class="col-sm-3">
                <input type="datetime-local" class="form-control" ng-model="nuevoservicio.fecha_prestacion">
            </div>
            <div class="col-sm-2">
                <input type="number" step="0.01" min="0" class="form-control" ng-model="nuevoservicio.base_imponible">
            </div>
            <div class="col-sm-2">
                <input type="number" step="0.01" min="0" class="form-control" ng-model="nuevoservicio.tipo_impositivo">
            </div>
            <div class="col-sm-1">
                <button class="btn btn-success pull-right" ng-click="addServicio()"><span class="glyphicon glyphicon-plus"></span></button>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <button class="btn btn-default" href="./../server/docugen/verFacturaPDF.php?id={{id}}" target="_blank">Emitir</button>
            </div>
        </div>
    </div>
</div>
<?php include dirname(__FILE__) . "./footer.php"; ?>