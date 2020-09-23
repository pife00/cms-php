<?php
include 'include/BaseDeDatos.php';
include 'admin/functions.php';
if (isset($_POST['BusquedaBlog'])) :
    $Busqueda = escape($conexion,$_POST['BarraDeBusqueda']);
    $Busqueda = mysqli_real_escape_string($conexion, $Busqueda);
    $solicitud = mysqli_query($conexion, "SELECT * FROM post WHERE post_etiquetas='$Busqueda' OR post_autor= '$Busqueda'");
    if (mysqli_num_rows($solicitud) == 0) :
        echo '<h2>No encontrado</h2>';
    else :
        while ($fila = mysqli_fetch_assoc($solicitud)) :
            $PostID =  escape($conexion, $fila['post_id']);
            $PostTitulo = escape($conexion,$fila['post_titulo']);
            $PostAutor = escape($conexion, $fila['post_autor']);
            $PostFecha =  escape($conexion,$fila['post_fecha']);
            $PostImagen = escape($conexion,$fila['post_imagen']);
            $PostContenido =  escape ($conexion,$fila['post_contenido']);
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