<?php include dirname(__FILE__) . "./header.php"; ?>
<div ng-controller="controladorfacturas">
    <div class="container nocentrado">
        <div class="row">
            <div class="col-sm-12">
                <a href="nuevafactura.php" class="btn btn-default">Nueva</a>        
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <hr>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Facturas
                    </div>
                    <input type="text"
                           class="form-control"
                           ng-model="filtrofactura.numero_factura"
                           placeholder="filtrar..."/>
                    <div class="list-group">
                        <a class="list-group-item"
                           ng-repeat="factura in facturas| filter:filtrofactura"
                           href="detallefactura.php?id={{factura.idfactura}}">
                            Factura <strong>{{factura.numero_factura}}</strong> para <strong>{{factura.razon_social}}</strong>: {{factura.otros}}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include dirname(__FILE__) . "./footer.php"; ?>