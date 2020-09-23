<?php include 'include/Encabezado.php' ?>
<?php include 'include/BaseDeDatos.php' ?>
<div id="wrapper">

    <!-- Navigation -->
    <?php include 'include/BarraDeNavegacion.php' ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Bienvenido
                        <small><?php
                                echo $_SESSION['usuario'];
                                ?></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="index.html">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-file"></i> Blank Page
                        </li>
                    </ol>

                    <?php
                    if (isset($_SESSION['usuario'])) {
                        $IDParametro = $_SESSION['usuario_id'];
                        $Usuario = $_SESSION['usuario'];
                        $query = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario_sobre_nombre='$Usuario'");
                        if (!$query) {
                            die(mysqli_error($conexion));
                        } else {

                            $fila = mysqli_fetch_assoc($query);
                            $SobreNombre = $fila['usuario_sobre_nombre'];
                            $Contraseña = $fila['usuario_contraseña'];
                            $Nombre = $fila['usuario_nombre'];
                            $Apellido = $fila['usuario_apellido'];
                            $Correo = $fila['usuario_correo'];
                            $ImagenProvisional = $fila['usuario_imagen'];
                            $Rol = $fila['usuario_rol'];
                        }
                    }
                    ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">Nombre de Usuario</label>
                            <input name="usuario_sobre_nombre" class="form-control" type="text" value="<?php echo $SobreNombre ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Contraseña</label>
                            <input value="<?php echo $Contraseña ?>" name="usuario_contraseña" class="form-control" type="password">
                        </div>

                        <div class="form-group">
                            <label for="">Nombre</label>
                            <input value="<?php echo $Nombre ?>" name="usuario_nombre" class="form-control" type="text">
                        </div>

                        <div class="form-group">
                            <label for="">Apellido</label>
                            <input value="<?php echo $Apellido ?>" name="usuario_apellido" class="form-control" type="text">
                        </div>

                        <div class="form-group">
                            <label for="">correo</label>
                            <input value="<?php echo $Correo ?>" name="usuario_correo" class="form-control" type="email">
                        </div>


                        <div class="form-group">
                            <label for="exampleFormControlFile1">Imagen</label>
                            <img width='40' src="../imagenes/<?php echo $ImagenProvisional; ?>" alt="">
                            <input name="usuario_imagen" type="file" class="form-control-file">
                        </div>

                        <div class="form-group">
                            <label for="">Rol</label>
                            <input value="<?php echo $Rol ?>" name="usuario_rol" class="form-control" type="text">
                        </div>


                        <div class="form-group">
                            <input type="submit" name="EnviarEditarUsuario" class="btn btn-primary" value="Enviar">
                        </div>

                        <?php
                        if (isset($_POST['EnviarEditarUsuario'])) {
                            $ID = $IDParametro;
                            $SobreNombre = $_POST['usuario_sobre_nombre'];
                            $Contraseña = $_POST['usuario_contraseña'];
                            $Nombre = $_POST['usuario_nombre'];
                            $Apellido = $_POST['usuario_apellido'];
                            $Correo = $_POST['usuario_correo'];
                            $Imagen = $_FILES['usuario_imagen']['name'];
                            $ImagenTemporal = $_FILES['usuario_imagen']['tmp_name'];
                            $Rol = $_POST['usuario_rol'];


                            if (empty($Imagen)) {
                                $Imagen = $ImagenProvisional;
                            }
                            move_uploaded_file($ImagenTemporal, "../imagenes/$Imagen");

                            $Solicitud = mysqli_query($conexion, "UPDATE usuarios SET 
                            usuario_sobre_nombre='$SobreNombre', 
                            usuario_contraseña = '$Contraseña',
                            usuario_nombre='$Nombre',
                            usuario_apellido='$Apellido',
                            usuario_correo='$Correo',
                            usuario_imagen='$Imagen',
                            usuario_rol='$Rol'
                            WHERE usuario_id='$ID'");
                            if (!$Solicitud) {
                                die(mysqli_error($conexion));
                            } else {
                                header('Location:usuarios.php');
                            }
                        }
                        ?>
                    </form>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->
        <?php include 'include/PieDePagina.php' ?>
    </div>