<?php include "include/BaseDeDatos.php"; ?>
<?php include "include/Encabezado.php"; ?>
<?php include 'include/BarraDeNavegacion.php' ?>

<?php
$contraseñaCambio = false;
if (isset($_GET['correo']) && isset($_GET['token'])) {
    $correo = $_GET['correo'];
    $token = $_GET['token'];
} else {
    redireccion('/cms/index');
}

if (isset($_POST['cambiarContraseña'])) {
    $contraseña = $_POST['contraseña'];
    $segundaContraseña = $_POST['segundaContraseña'];

    if ($contraseña === $segundaContraseña) {
        $contraseña = password_hash($contraseña, PASSWORD_BCRYPT, array('cost' => 10));
        if ($stmt = mysqli_prepare(
            $conexion,
            "UPDATE usuarios SET usuario_clave=? WHERE usuario_correo=? AND token=?"
        )) {
            $contraseñaCambio = true;
            mysqli_stmt_bind_param($stmt, "sss", $contraseña, $correo, $token);
            if (!$r = mysqli_stmt_execute($stmt)) {
                echo 'Algo salio mal';
            }
            mysqli_stmt_close($stmt);
            redireccion('/cms/login');
        } else {
            echo mysqli_stmt_error($stmt);
        }
    } else {
        echo "<h2>Contraseñas no coinciden</h2>";
    }
}
?>

<!-- Page Content -->
<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
                            <?php if (!$contraseñaCambio) : ?>
                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Nueva Contraseña</h2>
                                <p>Escriba su nueva contraseña.</p>
                                <div class="panel-body">

                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-flash color-blue"></i></span>
                                                <input id="contraseña" name="contraseña" placeholder="Nueva contraseña" class="form-control" type="password">
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-ok color-blue"></i></span>
                                                <input id="segundaContraseña" name="segundaContraseña" placeholder="Confirmar contraseña" class="form-control" type="password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="recobrar-contraseña" class="btn btn-lg btn-primary btn-block" value="Reiniciar Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="cambiarContraseña" id="token" value="">
                                    </form>

                                </div><!-- Body-->

                            <?php else : ?>
                                <h2>Contraseña cambiada</h2>
                                <p>Seras enviado a la pagina principal</p>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "include/PieDePagina.php"; ?>

</div> <!-- /.container -->