<hr>
<?php
if (isset($_POST['checkBoxArray'])) {

    foreach ($_POST['checkBoxArray'] as $checkBox) {
        $estado = $_POST['post_estado'];
        switch ($estado) {
            case 'Aprobado':
                $query = mysqli_query($conexion, "UPDATE post SET post_estado ='$estado' WHERE post_id = '$checkBox' ");
                break;
            case 'Denegado':
                $query = mysqli_query($conexion, "UPDATE post SET post_estado ='$estado' WHERE post_id = '$checkBox' ");
                break;
            case 'Eliminar':
                $query = mysqli_query($conexion, "DELETE FROM post WHERE post_id = '$checkBox' ");
                break;
            case 'Clonar':
                $query = mysqli_query($conexion, "SELECT * FROM post WHERE post_id = '$checkBox' ");
                while ($fila = mysqli_fetch_assoc($query)) {
                    $Titulo = $fila['post_titulo'];
                    $Autor = $fila['post_autor'];
                    $Categoria = $fila['post_id_categoria'];
                    $Estado = $fila['post_estado'];
                    $Fecha = $fila['post_fecha'];
                    $Etiquetas = $fila['post_etiquetas'];
                    $Contenido = $fila['post_contenido'];
                    $Imagen = $fila['post_imagen'];
                }
                $Clonar = mysqli_query(
                    $conexion,
                    "INSERT INTO post (post_titulo,post_autor,post_id_categoria,post_fecha,post_estado,post_etiquetas,post_contenido,post_imagen)
                 VALUES ('$Titulo','$Autor','$Categoria','$Fecha','$Estado','$Etiquetas','$Contenido','$Imagen')"
                );
                if (!$Clonar) {
                    die(mysqli_error($conexion));
                } else {
                }
                break;
        }
    }
}
?>

<form action="" method="post">
    <div class="container-fluid">
        <div class="table-responsive">
            <table class="table">
                <select style="
                margin-left:1em;
                width: 25%;
                height: 34px;
                border: 1px solid #ccc;
                border-radius: 4px;
                " name="post_estado" class="custom-select" id="">
                    <option selected>Seleccione Opcion</option>
                    <option value="Aprobado">Aprobado</option>
                    <option value="Denegado">Denegado</option>
                    <option value="Eliminar">Eliminar</option>
                    <option value="Clonar">Clonar</option>
                </select>
                <input style="
                 margin-left: 0.5em;" value="Aplicar" name="submit" type="submit" class="btn btn-primary">

                <thead>
                    <tr>
                        <td><input onclick="Cajas(this)" id="seleccionTodos" type="checkbox"></td>
                        <th scope="col">ID</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Autor</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Comentarios</th>
                        <th scope="col">Vistas</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Imagen</th>
                        <th scope='col'>Operacion</th>
                    </tr>
                <tbody>
                    <!---Tabla de Categorias--->
                    <?php
                    $Filtro = 'Todos';
                    if (isset($_POST['Filtro'])) {
                        $Filtro = $_POST['post_filtro'];
                    }
                    if ($Filtro !== 'Todos') {
                        $Posts = mysqli_query($conexion, "SELECT * FROM post WHERE post_estado = '$Filtro'");
                    } else if ($Filtro == 'Todos') {
                        $Posts = mysqli_query($conexion, "SELECT * FROM post ORDER BY post_id DESC");
                    }

                    while ($fila = mysqli_fetch_assoc($Posts)) :
                        $ID = $fila['post_id'];
                        $Titulo = $fila['post_titulo'];
                        $Autor = $fila['post_autor'];
                        $Categoria = $fila['post_id_categoria'];
                        $Estado = $fila['post_estado'];
                        $Vistas = $fila['post_numero_vistas'];
                        $Fecha = $fila['post_fecha'];
                        $Etiquetas = $fila['post_etiquetas'];
                        $Contenido = $fila['post_contenido'];
                        $Imagen = $fila['post_imagen'];
                    ?>
                        <tr>
                            <td><input name="checkBoxArray[]" type="checkbox" value=<?php echo $ID ?>></td>
                            <td><?php echo $ID ?></td>
                            <td>
                                <?php
                                echo "<a href='../post.php?post_id=$ID' >$Titulo</a>";
                                ?>

                            </td>
                            <td><?php echo $Autor ?></td>
                            <td><?php echo $Categoria ?></td>
                            <td><?php echo $Estado ?></td>
                            <td>
                                <?php
                                $solicitudNumeroComentarios =
                                    mysqli_query($conexion, "SELECT * FROM comentarios WHERE comentario_id_post = '$ID' ");
                                if (!$solicitudNumeroComentarios) {
                                    die(mysqli_error($conexion));
                                } else {
                                    $num_filas = $solicitudNumeroComentarios->num_rows;
                                    print_r($num_filas);
                                }

                                ?>
                            </td>
                            <td><?php echo $Vistas ?></td>
                            <td><?php echo $Fecha ?></td>
                            <td><?php echo "<img width='40' src='../imagenes/$Imagen'></img>" ?></td>
                            <?php echo "<td><a href='posts.php?recurso=EditarPost&post_id=$ID'>Editar</a></td>" ?>
                            <td><a onclick="tomaId(<?php echo $ID ?>)" data-toggle='modal' data-target='#modalEliminar' href='#'>Eliminar</a></td>
                        </tr>
                    <?php endwhile ?>
                </tbody>
                </thead>
            </table>
</form>
<?php
eliminarPost($conexion);
?>
</div>

<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 style="text-align:center;" class="modal-title" id="exampleModalLabel">Eliminar Post</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3 style="text-align:center;">¿Desea elimnar este post?</h3>
                <p style="text-align:center;">Si lo elimina los datos no se podran recuperar</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <a id="eliminar" href="" type="button" class="btn btn-danger">Eliminar</a>
            </div>
        </div>
    </div>
</div>


<!-- Navigation -->
<!-- /.container-fluid -->
<?php include 'include/PieDePagina.php' ?>
</div>
<!-- /#page-wrapper -->