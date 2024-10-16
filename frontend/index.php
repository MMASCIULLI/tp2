<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once("C:/xampp/htdocs/tp2/backend/panel/includes/db.php");
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú de Noticias</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: white;
            padding: 15px;
            text-align: center;
        }

        nav {
            background-color: #1e90ff;
            overflow: hidden;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        nav ul li {
            display: inline;
            padding: 14px 20px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 18px;
        }

        nav ul li a:hover {
            background-color: #575757;
            border-radius: 5px;
        }

        .content {
            padding: 20px;
        }

        .news-section {
            margin-bottom: 20px;
            background-color: white;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .news-section h2 {
            margin-top: 0;
        }

        .news-section p {
            color: #555;
        }
    </style>
</head>
<body>

    <header>
        <h1>INFORMADOS</h1>
    </header>

    <nav>
        <ul>
            <li><a href="noticias.php">NOTICIAS</a></li>
            <li><a href="categorias.php">CATEGORIAS</a></li>
            <li><a href="/tp2/backend/panel/views/usuarios/login.php">USUARIOS</a></li>

            
         
        </ul>
    </nav>

  <div class="content">
        <div class="news-section" id="Noticias">
            <h2>Noticias</h2>
            <a> Cada noticia incluye un título destacado y un texto detallado que ofrece una visión completa de los eventos o temas más importantes. Este espacio está diseñado para mantener a los usuarios informados sobre las últimas novedades y acontecimientos claves.</a>
            
        </div>

        <div class="news-section" id="CATEGORIAS">
            <h2>Categorias</h2>
           
        </div>


    </div>  

</body>
</html>
    









</body>
</html>



