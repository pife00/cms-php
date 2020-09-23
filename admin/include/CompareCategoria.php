<?php 
include 'BaseDeDatos.php';
function Comparacion($Dato){
    global $conexion;
    $Titulo = [];
    $CompareCategoria = mysqli_query($conexion,'SELECT * FROM categorias');
    foreach($CompareCategoria as $value){
    array_push($Titulo,$value['categoria_titulo']);
}
    foreach($Titulo as $value){
    if($value == $Dato){
        return 'Existe';
      }
    }
}

?>