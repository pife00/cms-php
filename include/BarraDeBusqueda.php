<?php
include 'include/BaseDeDatos.php';
if(isset($_POST['BusquedaBlog'])){
    $Busqueda = $_POST['BarraDeBusqueda'];
    $solicitud = mysqli_query($conexion,"SELECT * FROM post WHERE post_etiquetas='$Busqueda'");
    if(mysqli_num_rows($solicitud)==0){
        echo '<h2>No encontrado</h2>';
    }else{

    }   
}
?>