<?php include 'BaseDeDatos.php'; ?>
<?php session_start() ?>
<?php

if (isset($_POST['UsuarioSesion'])) {
    $Usuario = $_POST['usuario'];
    $Contraseña = $_POST['contraseña'];
    $Usuario = mysqli_real_escape_string($conexion, $Usuario);
    $Contraseña = mysqli_real_escape_string($conexion, $Contraseña);
    $SolicitudSesion = mysqli_query($conexion, "SELECT * FROM usuarios WHERE 
    usuario_sobre_nombre='$Usuario'");
    if (!$SolicitudSesion) {
        die(mysqli_error($conexion));
    }
    if($SolicitudSesion->num_rows>0){
        $fila = mysqli_fetch_assoc($SolicitudSesion);
        $DB_usuario_id = $fila['usuario_id'];
        $DB_usuario = $fila['usuario_sobre_nombre'];
        $DB_contraseña = $fila['usuario_contraseña'];
        $DB_randSalt = $fila['randSalt'];
        $DB_nombre = $fila['usuario_nombre'];
        $DB_apellido = $fila['usuario_apellido'];
        $DB_rol = $fila['usuario_rol'];

       // $Contraseña = crypt($Contraseña,$DB_contraseña);
         
       if(password_verify($Contraseña,$DB_contraseña)){
            $_SESSION['usuario_id'] = $DB_usuario_id;
            $_SESSION['usuario'] = $DB_usuario;
            $_SESSION['usuario_nombre'] = $DB_nombre;
            $_SESSION['usuario_apellido'] = $DB_apellido;
            $_SESSION['usuario_rol'] = $DB_rol;
            header('location:../admin');
        }
    }else{
        header('Location:../index.php');
    }
}
?>
