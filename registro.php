<?php include 'include/Encabezado.php' ?>
<?php include 'include/BarraDeNavegacion.php' ?>
<?php include 'include/BaseDeDatos.php' ?>



<!-- Page Content -->
<div class="container">

    <div class="row">
        <?php
        if (isset($_POST['nuevoRegistro'])) {
            $Usuario = $_POST['usuario'];
            $Correo = $_POST['correo'];
            $Contraseña = $_POST['contraseña'];

            if (!empty($Usuario) && !empty($Correo) && !empty($Contraseña)) {

                $Usuario = mysqli_real_escape_string($conexion, $Usuario);
                $Correo = mysqli_real_escape_string($conexion, $Correo);
                $Contraseña = mysqli_real_escape_string($conexion, $Contraseña);

                $Contraseña = password_hash($Contraseña, PASSWORD_BCRYPT, array('cost' => 10));

                if (usuario_existe($conexion, $Usuario)) {
                    $Mensaje = 'Usuario ya existe';
                } elseif (correo_existe($conexion, $Correo)) {
                    $Mensaje = 'Correo ya existe';
                } else {
                    $querry = mysqli_query(
                        $conexion,
                        "INSERT INTO usuarios (usuario_sobre_nombre,usuario_clave,usuario_correo,usuario_rol)
                            VALUES ('$Usuario','$Contraseña','$Correo','Suscritor')"
                    );
                    if (!$querry) {
                        die(mysqli_error($conexion));
                    }
                    $Mensaje = 'Usuario Registrado';
                }
            } else {
                $Mensaje = 'Los campos deben ser llenados';
            }
        } else {
            $Mensaje = '';
        }
        ?>

        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                    <h6 style="text-align: center;"><?php echo $Mensaje ?></h6>
                    <h1>Registro</h1>
                    <form role="form" action="registro.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="" class="">Usuario</label>
                            <input type="text" name="usuario" id="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="" class="">Correo</label>
                            <input type="email" name="correo" id="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="" class="">Contraseña</label>
                            <input type="password" name="contraseña" id="key" class="form-control">
                        </div>

                        <input type="submit" name="nuevoRegistro" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Registrar">
                    </form>

                </div>
            </div> <!-- /.col-xs-12 -->
        </div>
        <?php include 'include/BarraLateral.php' ?>
        <!-- Side Widget Well -->
        <div class="well">
            <h4>Side Widget Well</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
        </div>

    </div>

</div>
<!-- /.row -->
<hr>
<?php include 'include/PieDePagina.php' ?>


</html>