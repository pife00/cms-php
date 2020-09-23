<?php 
$solicitud = mysqli_query($conexion,"SELECT * FROM categorias");
while($fila = mysqli_fetch_assoc($solicitud)){
    $ID = escape($conexion,$fila['categoria_id']);
    $Titulo = escape($conexion, $fila['categoria_titulo']);
    echo "<option value=$ID >$Titulo</option>";
}
?>