<?php 
$solicitud = mysqli_query($conexion,"SELECT * FROM post");
while($fila = mysqli_fetch_assoc($solicitud)){
    $Titulo = escape($conexion,$fila['post_estado']);
    echo "<option value=$Titulo >$Titulo</option>";
}
?>