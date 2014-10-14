<?php include dirname(__FILE__) . "./header.php"; ?>
<div ng-controller="controladornuevafactura">
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
    </div>
</div>
<?php include dirname(__FILE__) . "./footer.php"; ?>