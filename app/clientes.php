<?php include dirname(__FILE__) . "./header.php"; ?>
<div ng-controller="controladorclientes">
    <div class="container nocentrado">
        <div class="row">
            <div class="col-sm-12">
                <a href="nuevocliente.php" class="btn btn-default">Nuevo</a>        
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <hr>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Clientes
                    </div>
                    <input type="text"
                           class="form-control"
                           ng-model="filtrocliente.razon_social"
                           placeholder="filtrar..."/>
                    <div class="list-group">
                        <a class="list-group-item"
                           ng-repeat="cliente in clientes| filter:filtrocliente"
                           href="detallecliente.php?id={{cliente.idcliente}}">
                            {{cliente.razon_social}} 
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include dirname(__FILE__) . "./footer.php"; ?>