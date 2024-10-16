<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once("../backend/panel/includes/db.php");


$id = isset($_GET['id']) ? intval($_GET['id']) : 0;


if ($id <= 0) {
    echo "ID de noticia no válido.";
    exit();
}


$stmt = $conx->prepare("SELECT * FROM noticias WHERE id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$resultado = $stmt->get_result();


if ($resultado->num_rows > 0) {
    $noticia = $resultado->fetch_object();
} else {
    echo "Noticia no encontrada.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($noticia->titulo); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
        p {
            font-size: 16px;
            color: #555;
        }
        img {
            max-width: 100%;
            height: auto;
        }
        .boton {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1><?php echo htmlspecialchars($noticia->titulo); ?></h1>
    <p><?php echo nl2br(htmlspecialchars($noticia->texto)); ?></p>
    <?php if ($noticia->imagen) { ?>
        <img src="<?php echo htmlspecialchars($noticia->imagen); ?>" alt="<?php echo htmlspecialchars($noticia->titulo); ?>">
    <?php } else { ?>
        <p>No hay imagen disponible.</p>
    <?php } ?>
    <img src="backend/uploads/"<?php echo htmlspecialchars($noticia->imagen); ?>" alt="<?php echo htmlspecialchars($noticia->titulo); ?>">
</div>

</body>
</html>