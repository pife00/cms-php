<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="">Titulo</label>
        <input name="post_titulo" class="form-control" type="text">
    </div>
    <div class="form-group">
        <label for="">Autor</label>
        <input name="post_autor" class="form-control" type="text">
    </div>

    <div class="form-group">
        <label for="">Categoria</label>
        <select style="
    width: 50%;
    height: 34px;
    display: block;
    border: 1px solid #ccc;
    border-radius: 4px;
" name="post_id_categoria" class="custom-select" id="">
            <?php include 'CategoriaOpciones.php' ?>
        </select>

    </div>
    <div class="form-group">
        <label for="">Fecha</label>
        <input name="post_fecha" style="
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
        <input name="post_etiquetas" class="form-control" type="text">
    </div>
    <div class="form-group">
        <label for="">Contenido</label>
        <textarea name="post_contenido" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label for="exampleFormControlFile1">Imagen</label>
        <input name="post_imagen" type="file" class="form-control-file">
    </div>
    <div class="form-group">
        <input type="submit" name="EnviarNuevoPost" class="btn btn-primary" value="Enviar">
    </div>

    <?php
    if (isset($_POST['EnviarNuevoPost'])) {

        $Titulo = escape($conexion,$_POST['post_titulo']);
        $Autor = escape($conexion,$_POST['post_autor']) ;
        $Categoria = escape ($conexion,$_POST['post_id_categoria']);
        $Fecha = escape($conexion,$_POST['post_fecha']);
        $Estado = escape($conexion, $_POST['post_estado']);
        $Etiquetas = escape($conexion,$_POST['post_etiquetas']);
        $Imagen = $_FILES['post_imagen']['name'];
        $ImagenTemporal = $_FILES['post_imagen']['tmp_name'];
        $Contenido = escape($conexion, $_POST['post_contenido']);

        move_uploaded_file($ImagenTemporal, "../imagenes/$Imagen");

        $Solicitud = mysqli_query(
            $conexion,
            "INSERT INTO post (post_titulo,post_autor,post_id_categoria,post_fecha,post_estado,post_etiquetas,post_contenido,post_imagen)
    VALUES ('$Titulo','$Autor','$Categoria','$Fecha','$Estado','$Etiquetas','$Contenido','$Imagen')"
        );
        if (!$Solicitud) {
            die(mysqli_error($conexion));
        } else {
            echo '<h1>Post Enviado</h1>';
        }
    }
    ?>
</form>
<script>
    CKEDITOR.replace('post_contenido');
</script>