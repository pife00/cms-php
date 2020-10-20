<?php

function IniciarSesion($conexion, $Usuario, $Contraseña)
{
    $Usuario = mysqli_real_escape_string($conexion, $Usuario);
    $Contraseña = mysqli_real_escape_string($conexion, $Contraseña);
    $SolicitudSesion = mysqli_query($conexion, "SELECT * FROM usuarios WHERE 
    usuario_sobre_nombre='$Usuario'");
    if (!$SolicitudSesion) {
        die(mysqli_error($conexion));
    }
    if ($SolicitudSesion->num_rows > 0) {
        $fila = mysqli_fetch_assoc($SolicitudSesion);
        $DB_usuario_id = $fila['usuario_id'];
        $DB_usuario = $fila['usuario_sobre_nombre'];
        $DB_contraseña = $fila['usuario_clave'];
        $DB_nombre = $fila['usuario_nombre'];
        $DB_apellido = $fila['usuario_apellido'];
        $DB_rol = $fila['usuario_rol'];


        // echo $Contraseña ." ".$DB_contraseña;
        if (password_verify($Contraseña, $DB_contraseña)) {
            $_SESSION['usuario_id'] = $DB_usuario_id;
            $_SESSION['usuario'] = $DB_usuario;
            $_SESSION['usuario_nombre'] = $DB_nombre;
            $_SESSION['usuario_apellido'] = $DB_apellido;
            $_SESSION['usuario_rol'] = $DB_rol;
            return true;
        } else {
            return false;
        }
    }
}

function redireccion($locacion)
{
    header("location:" . $locacion);
    exit;
}
function es_metodo($metodo = null)
{
    if ($_SERVER['REQUEST_METHOD'] == strtoupper($metodo)) {
        return true;
    } else {
        return false;
    }
}

function iniciado()
{
    if (isset($_SESSION['usuario_rol'])) {
        return true;
    }
    return false;
}

function iniciadoYredireccionado($locacion = null)
{
    if (iniciado()) {
        redireccion($locacion);
    }
}

function usuariolike($conexion,$post_id,$usuario_id){
    if($query = mysqli_query($conexion,"SELECT * FROM likes WHERE post_id='$post_id' AND usuario_id='$usuario_id' ")){
        $resuldato = mysqli_fetch_assoc($query);
        if ($resuldato['criterio'] != '') {
            return $resuldato['criterio'];
        } else {
            return null;
        }
    }else{
        return false;
    }
    
    /*if($query->num_rows>0){
        
    }else{
        return false;
    }*/
    
}




function es_administrador($rol)
{
    if ($rol == 'Administrador') {
        return true;
    } else {
        return false;
    }
}

function es_usuario($rol)
{
    if ($rol == 'Administrador' || $rol == 'Suscritor') {
        return true;
    } else {
        return false;
    }
}
//Evita las inyecciones de MYSQL
function escape($DB, $data)
{
    return mysqli_real_escape_string($DB, $data);
}

function Cantidad($conexion, $argumento)
{
    $Solicitud = mysqli_query($conexion, "SELECT * FROM $argumento");
    return mysqli_num_rows($Solicitud);
}

//Usuarios En Linea
function usuariosEnLina($conexion)
{
    $sesion = session_id();
    $tiempo = time();
    $tiempo_terminado_en_segundos = 60;
    $tiempo_culminado = time() - $tiempo_terminado_en_segundos;

    $query = mysqli_query($conexion, "SELECT * FROM usuarios_online WHERE sesion='$sesion'");
    $conteo = mysqli_num_rows($query);
    if ($conteo == NULL) {
        mysqli_query($conexion, "INSERT INTO usuarios_online(sesion,tiempo) VALUES ('$sesion','$tiempo')");
    } else {
        mysqli_query($conexion, "UPDATE usuarios_online SET tiempo = '$tiempo' WHERE sesion = '$sesion'");
    }
    $usuarios_online = mysqli_query($conexion, "SELECT * FROM usuarios_online WHERE tiempo > '$tiempo_culminado'");
    return $usuario_conteo = mysqli_num_rows($usuarios_online);
}

//Añadir Categoria
function añadirCategoria()
{
    if (isset($_POST['AñadirCategoria'])) {
        include 'include/CompareCategoria.php';
        $CategoriaTitulo = $_POST['CategoriaTitulo'];
        if ($CategoriaTitulo != '') {
            $Comparacion = Comparacion($CategoriaTitulo);
            if ($Comparacion == 'Existe') {
                echo '<h1>Ya existe esta Categoria</h1>';
            } else {
                $stmt = mysqli_prepare($conexion, "INSERT INTO categorias (categoria_titulo) VALUES (?) ");
                mysqli_stmt_bind_param($stmt, "s", $CategoriaTitulo);
                if (!$r = mysqli_stmt_execute($stmt)) {
                    echo 'Error de consulta';
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
function eliminarCategoria($conexion)
{
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
function editarCategoria($conexion)
{
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

function eliminarPost($conexion)
{
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

function usuario_existe($conexion, $usuario)
{

    $Solicitud = mysqli_query($conexion, "SELECT usuario_sobre_nombre FROM usuarios WHERE usuario_sobre_nombre='$usuario'");
    if (mysqli_num_rows($Solicitud) > 0) {
        return true;
    } else {
        return false;
    }
}

function correo_existe($conexion, $correo)
{
    $stmt = mysqli_prepare($conexion, "SELECT usuario_correo FROM usuarios WHERE usuario_correo=?");
    mysqli_stmt_bind_param($stmt, "s", $correo);
    if (!$r = mysqli_stmt_execute($stmt)) {
        echo 'Error';
    }
    $resultado = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($resultado) > 0) {
        return true;
    } else {
       return false;
    }
}
