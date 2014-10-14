<?php include dirname(__FILE__) . "./header.php"; ?>
<?php 
$id = filter_input(INPUT_GET, 'id');
?>
<div ng-controller="controladordetallecliente" ng-init="init(<?php echo $id ?>)">
       <div class="container nocentrado">
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label>Nif/Cif</label>
                    <input type="text" 
                           class="form-control"
                           ng-model="cliente.nif_cif"
                           placeholder="nif/cif"/>    
                </div>
            </div>
            <div class="col-sm-9">
                <div class="form-group">
                    <label>Razón Social</label>
                    <input type="text" 
                           class="form-control"
                           ng-model="cliente.razon_social"
                           placeholder="razón social"/>    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Domicilio</label>
                    <input type="text" 
                           class="form-control"
                           ng-model="cliente.domicilio"
                           placeholder="domicilio"/>    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label>Teléfono</label>
                    <input type="text" 
                           class="form-control"
                           ng-model="cliente.telefono"
                           placeholder="teléfono"/>    
                </div>
            </div>
            <div class="col-sm-9">
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" 
                           class="form-control"
                           ng-model="cliente.email"
                           placeholder="email"/>    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Otros</label>
                    <textarea class="form-control"
                              ng-model="cliente.otros"
                              placeholder="otros"></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <button class="btn btn-success pull-right" ng-click="guardarCliente()">Guardar</button>
            </div>
        </div>
    </div>
</div>
<?php include dirname(__FILE__) . "./footer.php"; ?>