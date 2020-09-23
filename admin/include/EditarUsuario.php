<?php 
if(isset($_GET['usuario_id'])){
   $IDParametro= escape($conexion, $_GET['usuario_id']);
   $query = mysqli_query($conexion,"SELECT * FROM usuarios WHERE usuario_id='$IDParametro'");
   if(!$query){
       die(mysqli_error($conexion));
   }else{
        $fila = mysqli_fetch_assoc($query);
        $SobreNombre = escape($conexion, $fila['usuario_sobre_nombre']);
        $Contraseña = escape($conexion, $fila['usuario_contraseña']);
        $Salt = escape($conexion, $fila['randSalt']);
        $Nombre =  escape ($conexion,$fila['usuario_nombre']);
        $Apellido = escape($conexion,$fila['usuario_apellido']);
        $Correo = escape($conexion, $fila['usuario_correo']);
        $ImagenProvisional = escape($conexion, $fila['usuario_imagen']);
        $Rol = escape($conexion, $fila['usuario_rol']);
   }
}
?>
<form action="" method="post" enctype="multipart/form-data" >
<div class="form-group">
<label for="">Nombre de Usuario</label>
<input name="usuario_sobre_nombre" class="form-control" type="text" value="<?php echo $SobreNombre ?>" >
</div>
<div class="form-group">
<label for="">Contraseña</label>
<input value="<?php echo $Contraseña ?>" type="password" name="usuario_contraseña" class="form-control"  >
</div>

<div class="form-group">
<label for="">Nombre</label>
<input value="<?php echo $Nombre ?>"name="usuario_nombre" class="form-control" type="text" >
</div>

<div class="form-group">
<label for="">Apellido</label>
<input value="<?php echo $Apellido ?>" name="usuario_apellido" class="form-control" type="text" >
</div>

<div class="form-group">
<label for="">correo</label>
<input value="<?php echo $Correo ?>" name="usuario_correo" class="form-control" type="email" >
</div>


<div class="form-group">
    <label for="exampleFormControlFile1">Imagen</label>
    <img width='40' src="../imagenes/<?php echo $ImagenProvisional; ?>" alt="">
    <input name="usuario_imagen" type="file" class="form-control-file" >
  </div>

<div class="form-group">
<label for="">Rol</label>
<input value="<?php echo $Rol ?>" name="usuario_rol" class="form-control" type="text" >
</div>


<div class="form-group">
    <input type="submit" name="EnviarEditarUsuario" class="btn btn-primary" value="Enviar" >
</div>

<?php
if(isset($_POST['EnviarEditarUsuario'])){
    $ID = $IDParametro;
    $SobreNombre = escape($conexion, $_POST['usuario_sobre_nombre']);
    $Contraseña = escape($conexion, $_POST['usuario_contraseña']);
    $Nombre = escape($conexion, $_POST['usuario_nombre']);
    $Apellido = escape($conexion, $_POST['usuario_apellido']);
    $Correo = escape($conexion, $_POST['usuario_correo']);
    $Imagen = $_FILES['usuario_imagen']['name'];
    $ImagenTemporal = $_FILES['usuario_imagen']['tmp_name'];
    $Rol =escape($conexion,$_POST['usuario_rol']);

    //$Contraseña = crypt($Contraseña,$Salt);
    $Contraseña = password_hash($Contraseña,PASSWORD_BCRYPT,array('cost'=>10));
    if(empty($Imagen)){
        $Imagen = $ImagenProvisional;
    }
    move_uploaded_file($ImagenTemporal,"../imagenes/$Imagen");

    $Solicitud = mysqli_query($conexion,"UPDATE usuarios SET 
    usuario_sobre_nombre='$SobreNombre', 
    usuario_contraseña = '$Contraseña',
    usuario_nombre='$Nombre',
    usuario_apellido='$Apellido',
    usuario_correo='$Correo',
    usuario_imagen='$Imagen',
    usuario_rol='$Rol'
    WHERE usuario_id='$ID'");
    if(!$Solicitud){
        die(mysqli_error($conexion));
    }else{
        header('Location:usuarios.php');
    }
}
?>
</form>
