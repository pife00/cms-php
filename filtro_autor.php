<?php include 'include/Encabezado.php' ?>
<?php include 'include/BarraDeNavegacion.php' ?>


<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <?php
            if (isset($_GET['post_autor'])) :
                $Busqueda = $_GET['post_autor'];
                $Busqueda = mysqli_real_escape_string($conexion, $Busqueda);
                $solicitud = mysqli_query($conexion, "SELECT * FROM post WHERE post_etiquetas='$Busqueda' OR post_autor= '$Busqueda'");
                if (mysqli_num_rows($solicitud) == 0) :
                    echo '<h2>No encontrado</h2>';
                else :
                    while ($fila = mysqli_fetch_assoc($solicitud)) :
                        $PostID =  $fila['post_id'];
                        $PostTitulo = $fila['post_titulo'];
                        $PostAutor = $fila['post_autor'];
                        $PostFecha = $fila['post_fecha'];
                        $PostImagen = $fila['post_imagen'];
                        $PostContenido = $fila['post_contenido'];
            ?>
                        <?php
                        echo
                            "<h2><a href='./post.php?post_id=$PostID'>$PostTitulo</a></h2>";

                        ?>
                        <p class="lead">
                            Por <a href="index.php"><?php echo $PostAutor ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> <?php echo $PostFecha ?></p>
                        <hr>
                        <img class="img-responsive" src="imagenes/<?php echo $PostImagen ?>" alt="">
                        <hr>
                        <p><?php echo $PostContenido ?></p>
                        <?php
                        echo "
                 <a class='btn btn-primary' href='./post.php?post_id=$PostID'>Leer Mas 
                 <span class='glyphicon glyphicon-chevron-right'></span></a>
                 "
                        ?>
                        <hr>
                    <?php endwhile ?>
                <?php endif ?>
            <?php endif ?>

            <!-- First Blog Post -->
            <!-- Pager -->
            <ul class="pager">
                <li class="previous">
                    <a href="#">&larr; Older</a>
                </li>
                <li class="next">
                    <a href="#">Newer &rarr;</a>
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