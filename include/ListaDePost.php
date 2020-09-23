<?php
include 'include/BaseDeDatos.php';
$NumeroPost = mysqli_query($conexion, "SELECT * FROM post");
$NumeroPost = mysqli_num_rows($NumeroPost);
echo $Pages = ceil($NumeroPost / 10);

$Solicitud = "SELECT * FROM post WHERE post_estado ='Aprobado' ORDER BY post_id DESC";
$TodosLosPost = mysqli_query($conexion, $Solicitud);
while ($fila = mysqli_fetch_assoc($TodosLosPost)) :
    $PostID =  $fila['post_id'];
    $PostTitulo = $fila['post_titulo'];
    $PostAutor = $fila['post_autor'];
    $PostFecha = $fila['post_fecha'];
    $PostImagen = $fila['post_imagen'];
    $PostContenidoEnviar = $fila['post_contenido'];
    $PostContenido = substr($fila['post_contenido'], 0, 100);
?>
    <!-- First Blog Post -->
    <?php
    echo
        "<h2><a href='./post.php?post_id=$PostID'>$PostTitulo</a></h2>";

    ?>
    <p class="lead">
        Por <a href=<?php echo "filtro_autor.php?post_autor=$PostAutor" ?>><?php echo $PostAutor ?></a>
    </p>
    <p><span class="glyphicon glyphicon-time"></span> <?php echo $PostFecha ?></p>
    <hr>
    <a href='./post.php?post_id=<?php echo $PostID ?>'>
        <img class="img-responsive" src="imagenes/<?php echo $PostImagen ?>" alt="">
    </a>

    <hr>
    <p><?php echo $PostContenido ?></p>
    <?php
    echo 
        "<a class='btn btn-primary' href='./post.php?post_id=$PostID'>Leer Mas 
        <span class='glyphicon glyphicon-chevron-right'></span></a>"
    ?>
    <hr>
<?php endwhile ?>