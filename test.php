<?php
$host = 'remotemysql.com';
$user = '1BLJ11LUVH';
$password = 'HItSSTi9Vj';

$conexion = new mysqli($host,$user,$password);
if(!$conexion){
    die(mysqli_error($conexion));
}else{
    echo 'Conectado';
}