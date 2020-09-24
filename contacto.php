<?php include 'include/Encabezado.php' ?>
<?php include 'include/BarraDeNavegacion.php' ?>
<?php include 'include/BaseDeDatos.php' ?>

<!-- Page Content -->
<div class="container">

    <div class="row">
        <?php
        if (isset($_POST['nuevoMensaje'])) {
            $Correo = mysqli_real_escape_string($conexion, $_POST['correo']);
            $Tema = mysqli_real_escape_string($conexion, $_POST['tema']);
            $Contenido = mysqli_real_escape_string($conexion, $_POST['contenido']);

            
            if (mail('pife00@hotmail.com', $Tema, $Mensaje)) {
                echo "<h2>Mensaje Enviado</h2>";
            } else {
                echo "<h2>Error intentelo mas tarde</h2>";
            }
        } else {
            $Respuesta = '';
        }
        ?>

        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                    <h6 style="text-align: center;"><?php //echo $Mensaje 
                                                    ?></h6>
                    <h1>Contacto</h1>
                    <form role="form" action="contacto.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="" class="">Correo</label>
                            <input placeholder="correo" type="email" name="correo" id="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="" class="">Tema</label>
                            <input type="text" name="tema" id="key" class="form-control">
                        </div>

                        <div class="form-group">
                            <textarea name="contenido" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>

                        </div>
                        <input type="submit" name="nuevoMensaje" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Enviar">
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