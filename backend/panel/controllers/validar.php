<?php 
@session_start();

// Comprobar si la sesión no está establecida o si está vacía
if (!isset($_SESSION["id"]) || empty($_SESSION["id"])) {
    // No estoy validado, redirigir al login
    header("Location: /views/usuarios/login.php");
    exit();
}