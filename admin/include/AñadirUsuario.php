
<form action="" method="post" enctype="multipart/form-data" >
<div class="form-group">
<label for="">Nombre de Usuario</label>
<input name="usuario_sobre_nombre" class="form-control" type="text" >
</div>
<div class="form-group">
<label for="">Contraseña</label>
<input name="usuario_clave" class="form-control" type="password" >
</div>

<div class="form-group">
<label for="">Nombre</label>
<input name="usuario_nombre" class="form-control" type="text" >
</div>

<div class="form-group">
<label for="">Apellido</label>
<input name="usuario_apellido" class="form-control" type="text" >
</div>

<div class="form-group">
<label for="">Correo</label>
<input name="usuario_correo" class="form-control" type="email" >
</div>


<div class="form-group">
    <label for="exampleFormControlFile1">Imagen</label>
    <input name="usuario_imagen" type="file" class="form-control-file" >
  </div>

<div class="form-group">
<label for="">Rol</label>
<input name="usuario_rol" class="form-control" type="text" >
</div>


<div class="form-group">
    <input type="submit" name="EnviarNuevoUsuario" class="btn btn-primary" value="Enviar" >
</div>

<?php
if(isset($_POST['EnviarNuevoUsuario'])){
    $SobreNombre = mysqli_real_escape_string($conexion, $_POST['usuario_sobre_nombre']);
    $Contraseña = mysqli_real_escape_string($conexion,$_POST['usuario_clave']);
    $Nombre = mysqli_real_escape_string($conexion,$_POST['usuario_nombre']);
    $Apellido = mysqli_real_escape_string($conexion,$_POST['usuario_apellido']);
    $Correo = mysqli_real_escape_string($conexion,$_POST['usuario_correo']);
    $Imagen = $_FILES['usuario_imagen']['name'];
    $ImagenTemporal = $_FILES['post_imagen']['tmp_name'];
    $Rol =mysqli_real_escape_string($conexion,$_POST['usuario_rol']);

    move_uploaded_file($ImagenTemporal,"../imagenes/$Imagen");

    $Contraseña = password_hash($Contraseña,PASSWORD_BCRYPT,array('cost'=>10));

    $Solicitud = mysqli_query($conexion,
    "INSERT INTO usuarios (usuario_sobre_nombre,usuario_clave,usuario_nombre,usuario_apellido
    ,usuario_correo,usuario_imagen,usuario_rol)
    VALUES ('$SobreNombre','$Contraseña','$Nombre','$Apellido','$Correo','$Imagen','$Rol')");
    if(!$Solicitud){
        die(mysqli_error($conexion));
    }else{
        header('Location:usuarios.php');
    }
}
?>
</form>
