<?php include 'include/Encabezado.php' ?>
<?php include 'include/BarraDeNavegacion.php' ?>


<!-- Page Content -->
<div class="container">


    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <?php
            include 'include/BaseDeDatos.php';
            if (isset($_GET['id'])) :
                $Busqueda = $_GET['id'];
                // $Busqueda = mysqli_real_escape_string($conexion, $Busqueda);
                $stmt = mysqli_prepare(
                    $conexion,
                    "SELECT post_id,post_titulo,post_autor,post_fecha,post_imagen,post_contenido
                 FROM post WHERE post_id_categoria =?"
                );
                mysqli_stmt_bind_param($stmt, "i", $Busqueda);
                if (!$r = mysqli_stmt_execute($stmt)) {
                    echo 'Eror consulta';
                }

                $result =  mysqli_stmt_get_result($stmt);
                if (mysqli_num_rows($result) == 0) :
                    echo '<h1>No encontrado</h1>';
                else :
                    while ($fila = mysqli_fetch_assoc($result)) :
                        $PostId = $fila['post_id'];
                        $PostTitulo = $fila['post_titulo'];
                        $PostAutor = $fila['post_autor'];
                        $PostFecha = $fila['post_fecha'];
                        $PostImagen = $fila['post_imagen'];
                        $PostContenido = $fila['post_contenido'];
            ?>
                       <?php echo "<h2><a href='/cms/post/$PostId'>$PostTitulo</a></h2>" ?>

                        <p class="lead">
                            Por <a href="index.php"><?php echo $PostAutor ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> <?php echo $PostFecha ?></p>
                        <hr>
                        <img class="img-responsive" src="/cms/imagenes/<?php echo $PostImagen ?>" alt="">
                        <hr>
                        <p><?php echo $PostContenido ?></p>
                        <a class="btn btn-primary" href="#">Leer Mas <span class="glyphicon glyphicon-chevron-right"></span></a>
                        <hr>
                    <?php endwhile ?>
                <?php endif ?>
            <?php endif ?>

            <!-- Pager -->
            <ul class="pager">
                <li class="previous">
                    <a href="#">&larr; Antiguos</a>
                </li>
                <li class="next">
                    <a href="#">Nuevos &rarr;</a>
                </li>
            </ul>

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