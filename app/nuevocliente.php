<?php include dirname(__FILE__) . "./header.php"; ?>
<div ng-controller="controladornuevocliente">
    <div class="container nocentrado">
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label>Nif/Cif</label>
                    <input type="text" 
                           class="form-control"
                           ng-model="nuevocliente.nif_cif"
                           placeholder="nif/cif"/>    
                </div>
            </div>
            <div class="col-sm-9">
                <div class="form-group">
                    <label>Razón Social</label>
                    <input type="text" 
                           class="form-control"
                           ng-model="nuevocliente.razon_social"
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
                           ng-model="nuevocliente.domicilio"
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
                           ng-model="nuevocliente.telefono"
                           placeholder="teléfono"/>    
                </div>
            </div>
            <div class="col-sm-9">
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" 
                           class="form-control"
                           ng-model="nuevocliente.email"
                           placeholder="email"/>    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Otros</label>
                    <textarea class="form-control"
                              ng-model="nuevocliente.otros"
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