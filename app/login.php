<?php include dirname(__FILE__) . "./head.php"; ?>
<div ng-controller="controladorlogin">
    <div class="container principal">
        <form class="form-signin" role="form">
            <h2 class="form-signin-heading">Identificación</h2>
            <input name="login" type="text" class="form-control" placeholder="usuario" required autofocus>
            <input name="pass" type="password" class="form-control" placeholder="contraseña" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Acceder</button>
        </form>
    </div> <!-- /container -->
</div>
<?php include dirname(__FILE__) . "./footer.php"; ?>