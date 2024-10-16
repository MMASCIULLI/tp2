<?php

require_once("../backend/panel/includes/db.php");

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PANEL ADMINISTRATIVO</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .menu {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }

        .menu a {
            text-decoration: none;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            margin: 0 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .menu a:hover {
            background-color: #45a049;
        }

        .content {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .action-buttons a {
            padding: 5px 10px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 3px;
            margin-right: 5px;
        }

        .action-buttons a:hover {
            background-color: #0056b3;
        }

        .action-buttons .delete {
            background-color: #FF4136;
        }

        .action-buttons .delete:hover {
            background-color: #c0392b;
        }

        .boton-color {
            cursor: pointer;
            background-color: #90ee90;
            padding: 10px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
        }
    </style>
</head>
 <body>
  <h1>PANEL ADMINISTRATIVO</h1>



<div class="content">
    <p>¡Bienvenido/a INFORMADOS! Como administrador, tienes acceso completo para gestionar noticias, categorías y usuarios. Explora las herramientas que te permiten mantener la plataforma actualizada y optimizada.!</p>
</div>

<div class="menu">
    <a href="listado.php">Listado de Usuarios</a>
    <a href="formulario.php">Registrar Usuario</a>
    <a href="/tp2/frontend/index.php">Ver Página Principal</a>
    <a href="noticias.php">Noticias</a>
</div>

 </html>
  
  