<?php
require_once("../backend/panel/includes/db.php");

$titulo = "";
$texto = "";
$id = null; // Inicializamos el ID como null por defecto
$rutaImagen = null;

// Verificar si estamos editando (si existe el parámetro 'id' en la URL)
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sentencia = $conx->prepare("SELECT * FROM noticias WHERE id = ?");
    $sentencia->bind_param('i', $id);
    $sentencia->execute();
    $resultado = $sentencia->get_result();
    $noticia = $resultado->fetch_object();

    if ($noticia) {
        // Asignamos los valores de la noticia a las variables para pre-llenar el formulario
        $titulo = $noticia->titulo;
        $texto = $noticia->texto;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($id) ? "Editar Noticia" : "Crear Noticia"; ?></title>
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

        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        .volver {
            display: block;
            margin-top: 20px;
            text-align: center;
            text-decoration: none;
            color: #007BFF;
        }

        .volver:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>

    <h1><?php echo isset($id) ? "Editar Noticia" : "Crear Noticia"; ?></h1>

    <form action="noticias.php?operacion=<?php echo isset($id) ? 'EDIT&id='.$id : 'NEW'; ?>" method="POST">
        <!-- Si estamos editando, incluimos un campo oculto con el ID de la noticia -->
        <?php if (isset($id)) { ?>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
        <?php } ?>

        <div>
            <label for="titulo">Título</label>
            <input type="text" id="titulo" name="titulo" value="<?php echo $titulo; ?>" required>
        </div>

        <div>
            <label for="texto">Contenido</label>
            <textarea id="texto" name="texto" required><?php echo $texto; ?></textarea>
        </div>

        <div>
            <label>Imagen:</label>
            <input type="file" name="imagen" accept="image/*">
            <?php if ($rutaImagen) { ?>
                <p>Imagen actual: <img src="<?php echo $rutaImagen; ?>" alt="Imagen actual" style="max-width: 200px;"></p>
            <?php } ?>


        </div>

        <button type="submit"><?php echo isset($id) ? "Guardar Cambios" : "Crear Noticia"; ?></button>
    </form>

    <a href="noticias.php" class="volver">Volver al listado</a>

</body>
</html>