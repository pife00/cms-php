<?php
if (isset($_GET['post_id'])) {
    $idParametro = escape($conexion,$_GET['post_id']) ;
    $query = mysqli_query($conexion, "SELECT * FROM post WHERE post_id = '$idParametro'");
    $fila = mysqli_fetch_assoc($query);

    $Titulo = escape($conexion, $fila['post_titulo']);
    $Autor = escape($conexion, $fila['post_autor']);
    $Categoria = escape($conexion,$fila['post_id_categoria']);
    $Fecha = escape($conexion,$fila['post_fecha']);
    $Etiquetas = escape($conexion,$fila['post_etiquetas']);
    $ImagenProvisional = escape($conexion,$fila['post_imagen']);
    $Contenido = escape($conexion,$fila['post_contenido']);
}
?>
<div id="mensaje" style="display: none;"   class="alert alert-success" role="alert">
  Post Actualizado presione <a href=<?php echo "../post.php?post_id='$idParametro'" ?>>aqui</a>
</div>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="">Titulo</label>
        <input value="<?php echo $Titulo ?>" name="post_titulo" class="form-control" type="text">
    </div>
    <div class="form-group">
        <label for="">Autor</label>
        <input name="post_autor" value="<?php echo $Autor ?>" class="form-control" type="text">
    </div>

    <div class="form-group">
        <label for="">Categoria</label>
        <select value="<?php echo $Categoria ?>" style="
    width: 50%;
    height: 34px;
    display: block;
    border: 1px solid #ccc;
    border-radius: 4px;
" name="post_id_categoria" class="custom-select" id="">
            <?php
            $solicitud = mysqli_query($conexion, "SELECT * FROM categorias");
            while ($fila = mysqli_fetch_assoc($solicitud)) {
                $ID = $fila['categoria_id'];
                $Titulo = $fila['categoria_titulo'];
                if ($ID == $Categoria) {
                    echo "<option selected='selected' value=$ID >$Titulo</option>";
                } else {
                    echo "<option value=$ID >$Titulo</option>";
                }
            }
            ?>
        </select>

    </div>
    <div class="form-group">
        <label for="">Fecha</label>
        <input name="post_fecha" value="<?php echo $Fecha ?>" style="
    display: block;
    border-radius: 0.3em;
    /* border-color: lightgray; */
    border: 1px solid #ccc;" type="date">
    </div>

    <div class="form-group">
        <label for="">Estado</label>
        <select style="
    width: 50%;
    height: 34px;
    display: block;
    border: 1px solid #ccc;
    border-radius: 4px;
" name="post_estado" class="custom-select" id="">
<option  value="Aprobado">Aprobado</option>
<option selected value="Denegado">Denegado</option>
        </select>

    </div>
    <div class="form-group">
        <label for="">Etiquetas</label>
        <input value="<?php echo $Etiquetas ?>" name="post_etiquetas" class="form-control" type="text">
    </div>
    <div class="form-group">
        <label for="">Contenido</label>
        <textarea name="post_contenido" class="form-control"><?php echo $Contenido ?></textarea>

    </div>
    <div class="form-group">
        <img width='40' src="../imagenes/<?php echo $ImagenProvisional; ?>" alt="">
        <input name="post_imagen" type="file" class="form-control-file">
    </div>
    <div class="form-group">
        <input type="submit" name="EnviarEditarPost" class="btn btn-primary" value="Enviar">
    </div>

    <?php
    if (isset($_POST['EnviarEditarPost'])) {
        $ID = $idParametro;
        $Titulo = escape($conexion,$_POST['post_titulo']);
        $Autor = escape($conexion, $_POST['post_autor']);
        $Categoria = escape($conexion, $_POST['post_id_categoria']);
        $Fecha = escape($conexion,$_POST['post_fecha']);
        $Estado = escape($conexion, $_POST['post_estado']);
        $Etiquetas = escape($conexion,$_POST['post_etiquetas']);
        $Imagen = $_FILES['post_imagen']['name'];
        $ImagenTemporal = $_FILES['post_imagen']['tmp_name'];
        $Contenido = escape($conexion,$_POST['post_contenido']);

        if (empty($Imagen)) {
            $Imagen = $ImagenProvisional;
        }
        move_uploaded_file($ImagenTemporal, "../imagenes/$Imagen");

        $EditarSolicitud = mysqli_query(
            $conexion,
            "UPDATE post SET 
        post_titulo='$Titulo',
        post_autor='$Autor',
        post_id_categoria='$Categoria',
        post_fecha='$Fecha',
        post_estado='$Estado',
        post_etiquetas='$Etiquetas',
        post_contenido='$Contenido',
        post_imagen='$Imagen'
        WHERE post_id='$ID'"
        );
        if (!$EditarSolicitud) {
            die(mysqli_error($conexion));
        } else {
            header('Location:./posts.php');
        }
    }
    ?>
</form>
<script>
    CKEDITOR.replace('post_contenido');   
</script>