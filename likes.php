<?php 
include 'include/BaseDeDatos.php';
$post = $_POST['post'];
$usuario = $_POST['usuario'];
$criterio = $_POST['criterio'];

if($criterio == 'meGusta'){
    $postQuery = mysqli_query($conexion,"SELECT * FROM post WHERE post_id=$post");
    $postResultado = mysqli_fetch_assoc($postQuery);
    $likes = $postResultado['likes'];
    
    $actualizarPost=mysqli_query($conexion,"UPDATE post SET likes='$likes'+1 WHERE post_id='$post'");
    if(!$actualizarPost){
        die(mysqli_error($conexion));
    }
    
    $registrarLikes = mysqli_query($conexion,"INSERT INTO likes(usuario_id,post_id,criterio) VALUES ('$usuario','$post','$criterio')");
    exit();
}

if($criterio == 'noMeGusta'){
    $postQuery = mysqli_query($conexion, "SELECT * FROM post WHERE post_id=$post");
    $postResultado = mysqli_fetch_assoc($postQuery);
    $unlikes = $postResultado['unlikes'];

    
    $actualizarPost = mysqli_query($conexion, "UPDATE post SET unlikes='$unlikes'+1 WHERE post_id='$post'");
    if (!$actualizarPost) {
        die(mysqli_error($conexion));
    }
    $eliminarLikes = mysqli_query($conexion, "DELETE FROM likes WHERE post_id='$post' AND usuario_id='$usuario'");
    if (!$eliminarLikes) {
        die(mysqli_error($conexion));
    }
    exit();
}
?>