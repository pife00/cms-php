<div class="container-fluid">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Sobre Nombre</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Rol</th>
                </tr>
            <tbody>
                <!---Tabla de Categorias--->
                <?php
                $stmt = mysqli_prepare($conexion, 
                "SELECT usuario_id,usuario_sobre_nombre,usuario_nombre,usuario_apellido,usuario_correo,usuario_imagen,usuario_rol FROM usuarios");
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt,$ID,$SobreNombre,$Nombre,$Apellido,$Correo,$Imagen,$Rol);

                while (mysqli_stmt_fetch($stmt)) :
                   
                ?>

                    <tr>
                        <td><?php echo $ID ?></td>
                        <td><?php echo $SobreNombre ?></td>
                        <td><?php echo $Nombre ?></td>
                        <td><?php echo $Apellido ?></td>
                        <td><?php echo $Correo ?></td>
                        <td><?php echo "<img width='40' src='../imagenes/$Imagen'></img>" ?></td>
                        <td><?php echo $Rol ?></td>
                        <?php echo "<td><a href='usuarios.php?recurso=EditarUsuario&usuario_id={$ID}'>Editar</a></td>" ?>
                        <?php echo "<td><a href='usuarios.php?delete={$ID}'>Eliminar</a></td>" ?>
                    </tr>
                <?php endwhile ?>
            </tbody>
            </thead>
        </table>
        <?php
        if (isset($_GET['delete'])) {
            if ($_SESSION['usuario_rol'] == 'Administrador') {
                $eliminar = mysqli_real_escape_string($conexion,$_GET['delete']) ;
                $solicitud = mysqli_query($conexion, "DELETE FROM usuarios WHERE usuario_id ='$eliminar'");
                if (!$solicitud) {
                    die('error ' . mysqli_error($conexion));
                } else {
                    header('Location:usuarios.php');
                }
            }
        }

        if (isset($_GET['comentario_estado'])) {
            $Estado = $_GET['comentario_estado'];
            $ID_comentario = $_GET['comentario_id'];
            $Solicitud_estado_comentario = mysqli_query($conexion, "UPDATE comentarios SET comentario_estado='$Estado'
            WHERE comentario_id='$ID_comentario'");
            header('Location:usuarios.php');
        }
        ?>
    </div>

    <!-- Navigation -->
    <!-- /.container-fluid -->
    <?php include 'include/PieDePagina.php' ?>
</div>
<!-- /#page-wrapper -->