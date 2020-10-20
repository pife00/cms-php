<?php include 'BaseDeDatos.php'; ?>
<?php session_start() ?>
<?php include "../admin/functions.php"; ?>
<?php

if (isset($_POST['UsuarioSesion'])) {
    $Usuario = $_POST['usuario'];
    $Contraseña = $_POST['contraseña'];
    if(IniciarSesion($conexion,$Usuario,$Contraseña)){
        redireccion("admin/index.php");
    }else{
        redireccion("./index.php");
    }
}
?>
