<?php include dirname(__FILE__) . "./header.php"; ?>
<div ng-controller="controladorprincipal">
    <div class="container principal" ng-cloak>
        Página Principal       
    </div>
    <div class="container nocentrado">
        <a href="clientes.php" class="btn btn-default">Clientes</a>
        <a href="presupuestos.php" class="btn btn-default">Presupuestos</a>
        <a href="facturas.php" class="btn btn-default">Facturas</a>
        <a href="contratos.php" class="btn btn-default">Contratos</a>
    </div>
</div>
<?php include dirname(__FILE__) . "./footer.php"; ?>
