<?php session_start() ?>

<?php 
  $_SESSION['usuario'] = null;
  $_SESSION['usuario_nombre'] = null;  
  $_SESSION['usuario_apellido'] = null;;
  $_SESSION['usuario_rol'] = null;

  header('location:../index.php');

?>