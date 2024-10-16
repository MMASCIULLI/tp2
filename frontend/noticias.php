<?php
// Conectar a la base de datos
require_once("../backend/panel/includes/db.php");

// Obtener todas las noticias
$stmt = $conx->prepare("SELECT * FROM noticias ORDER BY id DESC");
$stmt->execute();
$resultado = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noticias</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .noticia {
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }

        .noticia h2 {
            color: #333;
        }

        .noticia p {
            font-size: 16px;
            color: #555;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Últimas Noticias</h1>

    <?php while ($fila = $resultado->fetch_object()) { ?>
    <div class="noticia">
        <h2><?php echo $fila->titulo; ?></h2>
        <p><?php echo $fila->texto; ?></p>
        <a href="/tp/backend/panel/vermasnoticias.php?id=<?php echo $fila->id; ?>"  type="submit" class="boton-color">Ver más</a>

      
        <!-- Verificar si hay una imagen y mostrarla -->
        <?php if ($fila->imagen) { ?>
            <td><img src="../../<?php echo $fila->imagen; ?>"width="125"></td>
        <?php } ?>
    </div>
<?php } ?>
</div>
 
</body>
</html>