<?php include 'include/Encabezado.php' ?>
<?php include 'include/BarraDeNavegacion.php' ?>

<?php
if (isset($_POST['BusquedaBlog'])) {
    $Busqueda = $_POST['BarraDeBusqueda'];
}
?>


<!-- Page Content -->
<div class="container">

    <div class="row">
        <div class="col-md-8">
            <?php
            if (isset($_GET['pagina'])) {
                $pagina = $_GET['pagina'];
            } else {
                $pagina = '';
            }
            if ($pagina == 1 || $pagina == '') {
                $PaginaReal = 0;
            } else {
                $PaginaReal = ($pagina * 5) - 5;
            }

            $stmt = mysqli_prepare(
                $conexion,
                "SELECT post_id,post_titulo,post_autor,post_fecha,post_imagen,post_contenido
                 FROM post WHERE post_autor =? AND post_estado='Aprobado'"
            );
            mysqli_stmt_bind_param($stmt, "s", $Busqueda);
            if (!$r = mysqli_stmt_execute($stmt)) {
                echo 'Eror consulta';
            }

            $result =  mysqli_stmt_get_result($stmt);
            $NumeroPost = mysqli_num_rows($result);
            $Paginas = ceil($NumeroPost / 10);

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
            <ul class="pagination">
                <?php
                for ($i = 1; $i <= $Paginas; $i++) {
                    if ($i == $pagina) {
                        echo "<li class='page-item active'><a href='busqueda.php?pagina=$i' class='page-link'>$i</a></li>";
                    } else {
                        echo "<li class='page-item'><a href='busqueda.php?pagina=$i' class='page-link'>$i</a></li>";
                    }
                }
                ?>
            </ul>

        </div>
        <?php include 'include/BarraLateral.php' ?>



        <?php include 'include/PieDePagina.php' ?>


        </html>