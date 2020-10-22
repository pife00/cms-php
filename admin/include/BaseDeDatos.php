<?php
/*$host = 'remotemysql.com';
$user = '1BLJ11LUVH';
$password = 'HItSSTi9Vj';*/

$host = 'database-2.clqyyny78dz1.us-east-2.rds.amazonaws.com';
$user = 'admin';
$password = '8y9tL0EfWA0RLkhukox8';


//Elastic Amazon
//$conexion = mysqli_connect('ec2-13-58-107-88.us-east-2.compute.amazonaws.com','pife00','Imapife00@','cms');

//Local

//$conexion = mysqli_connect('localhost','root','123456','cms');

//Remota
//$conexion = new mysqli($host,$user,$password, '1BLJ11LUVH');

//aws
$conexion = new mysqli($host, $user, $password, 'cms');
$conexion->set_charset('utf8');
