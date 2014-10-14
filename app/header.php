
<?php
include_once dirname(__FILE__) . "./nav_functions.php";
include dirname(__FILE__) . "./head.php";
?>

<div class="navmenu navmenu-default navmenu-fixed-left offcanvas">
    <a class="navmenu-brand" href="<?php echo direcciones::principal ?>">Mi Gestión</a>
    <ul class="nav navmenu-nav">
        <li><a title="Clientes" href="<?php echo direcciones::clientes ?>"><span class="glyphicon glyphicon-user"> Clientes</span></a></li>
        <li><a title="Presupuestos" href="<?php echo direcciones::presupuestos ?>"><span class="glyphicon glyphicon-th-list"> Presupuestos</span></a></li>
        <li><a title="Contratos" href="<?php echo direcciones::contratos ?>"><span class="glyphicon glyphicon-retweet"> Contratos</span></a></li>
        <li><a title="Facturas" href="<?php echo direcciones::facturas ?>"><span class="glyphicon glyphicon-euro"> Facturas</span></a></li>
    </ul>
    <!--
    <ul class="nav navmenu-nav">
        <li><a href="#">Link</a></li>
        <li><a href="#">Link</a></li>
        <li><a href="#">Link</a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
            <ul class="dropdown-menu navmenu-nav">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
            </ul>
        </li>
    </ul>
    -->
</div>

<div class="navbar navbar-default navbar-fixed-top">
    <button type="button" class="navbar-toggle" data-toggle="offcanvas" data-target=".navmenu" data-canvas="body">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <div class="nav navbar-nav">
        <ol class="breadcrumb list-inline mio" id="migasdepan">
            
            
            
            <!--<li><a href="#">Home</a></li>
            <li><a href="#">Library</a></li>
            <li class="active">Data</li>-->
        </ol>
    </div>
</div>



