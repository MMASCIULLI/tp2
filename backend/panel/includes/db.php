<?php 
//archivo database conexion
$servidor = "localhost";
$user = "root";
$password = "";
$database = "basedatos";


$conx = new mysqli($servidor, $user, $password, $database);// objeto para conexion de base de datos 

if ($conx->connect_error) {
    echo "Error de conexion: " . $conx->connect_error;
} 