<?php


//Evita las inyecciones de MYSQL

function escape($DB,$data){
    return mysqli_real_escape_string($DB,trim(strip_tags($data)));
}

//Usuarios En Linea
function usuariosEnLina($conexion){
    $sesion = session_id();
    $tiempo = time();
    $tiempo_terminado_en_segundos = 60;
    $tiempo_culminado = time() - $tiempo_terminado_en_segundos;

    $query = mysqli_query($conexion,"SELECT * FROM usuarios_online WHERE sesion='$sesion'"); 
    $conteo = mysqli_num_rows($query);
    if($conteo == NULL){
        mysqli_query($conexion,"INSERT INTO usuarios_online(sesion,tiempo) VALUES ('$sesion','$tiempo')");
    }else{
        mysqli_query($conexion,"UPDATE usuarios_online SET tiempo = '$tiempo' WHERE sesion = '$sesion'");
    }
    $usuarios_online = mysqli_query($conexion,"SELECT * FROM usuarios_online WHERE tiempo > '$tiempo_culminado'"); 
    return $usuario_conteo = mysqli_num_rows($usuarios_online);
}

//Añadir Categoria
function añadirCategoria(){
    if (isset($_POST['AñadirCategoria'])) {
        include 'include/CompareCategoria.php';
        $CategoriaTitulo = $_POST['CategoriaTitulo'];
        if ($CategoriaTitulo != '') {
            $CategoriaTitulo = mysqli_real_escape_string($conexion, $CategoriaTitulo);
            $Comparacion = Comparacion($CategoriaTitulo);
            if ($Comparacion == 'Existe') {
                echo '<h1>Ya existe esta Categoria</h1>';
            } else {
                $AñadirCategoria =
                    mysqli_query($conexion, "INSERT INTO categorias (categoria_titulo) VALUES ('$CategoriaTitulo') ");
                if (!$AñadirCategoria) {
                    die('error' . mysqli_error($conexion));
                } else {
                    echo '<h1>Añadido</h1>';
                }
            }
        } else {
            echo '<h1>Categoria debe ser llenado</h1>';
        }
    }
}
//Eliminar Categoria
function eliminarCategoria($conexion){
    if (isset($_GET['delete'])) {
        
        $eliminar = $_GET['delete'];
        $solicitud = mysqli_query($conexion, "DELETE FROM categorias WHERE categoria_id ='$eliminar'");
        if (!$solicitud) {
            die('error ' . mysqli_error($conexion));
        } else {
            header('Location:categorias.php');
        }
    }
}
//Editar categoria
function editarCategoria($conexion){
    if (isset($_GET['edit'])) {
        $editar = $_GET['edit'];
        $solicitud = mysqli_query($conexion, "SELECT * FROM categorias WHERE categoria_id='$editar'");
        if (!$solicitud) {
            die(mysqli_error($conexion));
        } else {
            $fila = mysqli_fetch_assoc($solicitud);
            $idCategoria = $fila['categoria_id'];
            $titulo = $fila['categoria_titulo'];
            //llamado para mostrar la barra de entrada y boton
            echo
                "<form action='' method='post'>
                 <div class='form-group'>
                <label for='EditarCategoria'>Editar Categoria</label>
                <input value='$titulo' class='form-control' type='text' name='EditarCategoriaTitulo'>
                </div>
                <div class='form-group'>
                <input class='btn btn-primary' type='submit' name='EditarCategoria' value='Editar Categoria'>
                </div>
                </form>";
        }
    }
    
            if (isset($_POST['EditarCategoria'])) {
            $editarCategoriaTitulo = $_POST['EditarCategoriaTitulo'];
            $EditarCategoriaSolicitud = mysqli_query($conexion, "UPDATE categorias SET 
            categoria_titulo ='$editarCategoriaTitulo' WHERE categoria_id=$idCategoria ");
            if (!$EditarCategoriaSolicitud) {
            die(mysqli_error($conexion));
            } else {
            header('location:categorias.php');
            }
         }
}

function eliminarPost($conexion){
    if (isset($_GET['delete'])) {
        
        $eliminar = $_GET['delete'];
        $solicitud = mysqli_query($conexion, "DELETE FROM post WHERE post_id ='$eliminar'");
        if (!$solicitud) {
            die('error ' . mysqli_error($conexion));
        } else {
            header('Location:posts.php');
        }
    }
}


