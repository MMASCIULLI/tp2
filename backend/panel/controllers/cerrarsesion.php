<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

if (isset($_POST["logout"])) {  
    session_destroy(); 
    header("location: /tp2/views/usuarios/login.php");
    exit(); 
 } 

