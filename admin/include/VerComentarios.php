<div class="container-fluid">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Post</th>
                    <th scope="col">Autor</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Comentario</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Respuesta A</th>
                    <th scope="col">Aprobar</th>
                    <th scope="col">No Aprobar</th>
                    <th scope='col'>Operacion</th>
                </tr>
            <tbody>
                <!---Tabla de Categorias--->
                <?php
                $Comentarios = mysqli_query($conexion, 'SELECT * FROM comentarios');
                
                while ($fila = mysqli_fetch_assoc($Comentarios)) :
                    $ID = $fila['comentario_id'];
                    $ID_post = $fila['comentario_id_post'];
                    $Autor = $fila['comentario_autor'];
                    $Fecha = $fila['comentario_fecha'];
                    $Estado = $fila['comentario_estado'];
                    $Comentario = $fila['comentario_contenido'];
                    $Correo = $fila['comentario_correo'];  
                    
                    $Aprobado = 'aprobado';
                    $No_Aprobado = 'no aprobado';
                ?>
               
                    <tr>
                        <td><?php echo $ID ?></td>
                        <td><?php echo $ID_post?></td>
                        <td><?php echo $Autor ?></td>
                        <td><?php echo $Correo ?></td>
                        <td><?php echo $Comentario ?></td>
                        <td><?php echo $Fecha ?></td>
                        <td><?php echo $Estado ?></td>
                        <td>
                            <?php 
                            $IdentificadorPost = mysqli_query($conexion,"SELECT * FROM post WHERE post_id='$ID_post'");
                            while($fila = mysqli_fetch_assoc($IdentificadorPost)){
                                $Post_ID = $fila['post_id'];
                                $Post_titulo = $fila['post_titulo'];
                                echo "<a href='../post.php?post_id=$Post_ID' >$Post_titulo</a>";
                            } 
                            ?>
                        </td>
                        <?php echo "<td><a href='comentarios.php?comentario_estado={$Aprobado}&comentario_id={$ID}'>Aprobar</a></td>"?>
                        <?php echo "<td><a href='comentarios.php?comentario_estado={$No_Aprobado}&comentario_id={$ID}'>No Aprobar</a></td>"?>
                        <?php echo "<td><a href='comentarios.php?delete={$ID}'>Eliminar</a></td>" ?>
                    </tr>
                <?php endwhile ?>
            </tbody>
            </thead>
        </table>
        <?php 
        if(isset($_GET['delete'])){
            $eliminar = $_GET['delete'];
            $solicitud = mysqli_query($conexion, "DELETE FROM comentarios WHERE comentario_id ='$eliminar'");
            if (!$solicitud) {
                die('error ' . mysqli_error($conexion));
            } else {
                header('Location:comentarios.php');
            }
        }

        if(isset($_GET['comentario_estado'])){
            $Estado = $_GET['comentario_estado'];
            $ID_comentario = $_GET['comentario_id'];
            $Solicitud_estado_comentario = mysqli_query($conexion,"UPDATE comentarios SET comentario_estado='$Estado'
            WHERE comentario_id='$ID_comentario'");
             header('Location:comentarios.php');
        }
        ?>
    </div>

    <!-- Navigation -->
    <!-- /.container-fluid -->
    <?php include 'include/PieDePagina.php' ?>
</div>
<!-- /#page-wrapper -->