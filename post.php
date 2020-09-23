<?php include "include/Encabezado.php"; ?>
<?php include "include/BarraDeNavegacion.php"; ?>


<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Post Content Column -->
        <div class="col-lg-8">

            <?php
            if (isset($_GET['post_id'])) {
                $ID = $_GET['post_id'];
                $solicitud = mysqli_query($conexion, "SELECT * FROM post WHERE post_id=$ID");
                $Vistas = mysqli_query($conexion,
                "UPDATE post SET post_numero_vistas = post_numero_vistas +1 WHERE post_id =$ID ");
                $fila = mysqli_fetch_assoc($solicitud);
                if(!$Vistas){
                    die(mysqli_error($conexion));
                }

                $Titulo = $fila['post_titulo'];
                $Autor = $fila['post_autor'];
                $Fecha = $fila['post_fecha'];
                $Imagen = $fila['post_imagen'];
                $Contenido = $fila['post_contenido'];
            }

            ?>
            <!-- Blog Post -->

            <!-- Title -->
            <h1><?php echo $Titulo ?></h1>

            <!-- Author -->
            <p class="lead">
                Por <a href="#"><?php echo $Autor ?></a>
            </p>

            <hr>

            <!-- Date/Time -->
            <p><span class="glyphicon glyphicon-time"></span> <?php echo $Fecha ?></p>

            <hr>

            <!-- Preview Image -->
            <img class="img-responsive" src="imagenes/<?php echo $Imagen ?>" alt="">

            <hr>

            <!-- Post Content -->
            <p><?php echo $Contenido ?></p>
            <hr>

            <!-- Blog Comments -->

            <?php
            if (isset($_POST['crearComentario'])) {
                $Autor = $_POST['autor'];
                $Correo = $_POST['correo'];
                $Comentario = $_POST['comentario'];
                if(!empty($Autor) && !empty($Correo) && !empty($Comentario)){
                    $solicitud = mysqli_query($conexion, "INSERT INTO comentarios
                    (comentario_id_post,comentario_autor,comentario_correo,comentario_contenido,comentario_estado
                    ,comentario_fecha) 
                    VALUES ('$ID','$Autor','$Correo','$Comentario','aprobado',now()) ");
                if (!$solicitud) {
                    die(mysqli_error($conexion));
                } else {
                }
                }else{
                    echo "<script>alert('Debe llenar los campos')</script>";    
                }
               
            }
            ?>

            <!-- Comments Form -->
            <div class="well">
                <h4>Deja tu comentario:</h4>
                <form method="post">
                    <div class="form-group">
                        <label>Usuario</label>
                        <input type="text" class="form-control" name="autor" required>
                    </div>
                    <div class="form-group">
                        <label>Correo</label>
                        <input type="email" class="form-control" name="correo" required>
                    </div>
                    <div class="form-group">
                        <label for="">Tu Comentario</label>
                        <textarea name="comentario" class="form-control" rows="3" required></textarea>
                    </div>
                    <button type="submit" name="crearComentario" class="btn btn-primary">Enviar</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->

            <!-- Comment -->
            <?php
            $MostrarComentario = mysqli_query(
                $conexion,
                "SELECT * FROM comentarios WHERE comentario_id_post='{$ID}'
            AND comentario_estado = 'aprobado' ORDER BY comentario_id DESC
            "
            );
            while ($fila = mysqli_fetch_assoc($MostrarComentario)) :
                $Comentario_Autor = $fila['comentario_autor'];
                $Comentario_fecha = $fila['comentario_fecha'];
                $comentario_contenido = $fila['comentario_contenido'];
            ?>
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $Comentario_Autor ?>
                            <small><?php echo $Comentario_fecha ?></small>
                        </h4>
                        <?php echo $comentario_contenido ?>
                    </div>
                </div>
            <?php endwhile ?>
            <?php //include 'include/Comentarios.php' 
            ?>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include 'include/BarraLateral.php' ?>

    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
    <footer>
        <div class="row">
            <div class="col-lg-12">
                <p>Copyright &copy; Your Website 2014</p>
            </div>
        </div>
        <!-- /.row -->
    </footer>

</div>
<!-- /.container -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>