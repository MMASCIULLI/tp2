<?php

// Mostrar errores durante el desarrollo
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Incluir la conexión a la base de datos
require_once("../backend/panel/includes/db.php");

// Verificar si se ha enviado una operación a través de la URL
$operacion = isset($_GET['operacion']) ? $_GET['operacion'] : null;

// Incluir el manejo de imágenes
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $texto = $_POST['texto'];

    // Inicializamos la variable de la ruta de la imagen
    $rutaImagen = null;

    // Verificamos si se ha subido una imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $nombreArchivo = $_FILES['imagen']['name'];
        $extensionArchivo = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
        
        // Definir una nueva ruta para guardar la imagen
        $nombreUnico = uniqid() . '.' . $extensionArchivo; // Generar un nombre único
        $rutaImagen = '../uploads/' . $nombreUnico; // Ruta donde guardarás la imagen

        // Mover el archivo subido a la carpeta 'uploads'
        if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaImagen)) {
            echo "Error al mover la imagen a la carpeta 'uploads'.";
            exit();
        }
    }

    // OPERACIÓN NEW (CREAR NUEVA NOTICIA)
    if ($operacion == "NEW") {
        // Solo se debe guardar si $rutaImagen no es nulo
        if ($rutaImagen !== null) {
            $stmt = $conx->prepare("INSERT INTO noticias (titulo, texto, imagen) VALUES (?, ?, ?)");
            $stmt->bind_param('sss', $titulo, $texto, $rutaImagen);
        } else {
            // Si no hay imagen, puedes decidir no incluirla o usar una por defecto
            $stmt = $conx->prepare("INSERT INTO noticias (titulo, texto) VALUES (?, ?)");
            $stmt->bind_param('ss', $titulo, $texto);
        }

        if ($stmt->execute()) {
            header("Location: noticias.php");
            exit();
        } else {
            echo "Error al crear la noticia: " . $stmt->error;
        }

    // OPERACIÓN EDIT (EDITAR UNA NOTICIA EXISTENTE)
    } elseif ($operacion == "EDIT" && isset($_POST['id'])) {
        $id = $_POST['id'];

        // Si se ha subido una nueva imagen, actualizar también la ruta de la imagen
        if ($rutaImagen) {
            $stmt = $conx->prepare("UPDATE noticias SET titulo = ?, texto = ?, imagen = ? WHERE id = ?");
            $stmt->bind_param('sssi', $titulo, $texto, $rutaImagen, $id);
        } else {
            $stmt = $conx->prepare("UPDATE noticias SET titulo = ?, texto = ? WHERE id = ?");
            $stmt->bind_param('ssi', $titulo, $texto, $id);
        }

        if ($stmt->execute()) {
            header("Location: noticias.php");
            exit();
        } else {
            echo "Error al editar la noticia: " . $stmt->error;
        }
    }
}

// Operación para eliminar una noticia
if ($operacion == "DELETE" && isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conx->prepare("DELETE FROM noticias WHERE id = ?");
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        header("Location: noticias.php");
        exit();
    } else {
        echo "Error al eliminar la noticia: " . $stmt->error;
    }
}

// Mostrar todas las noticias
$stmt = $conx->prepare("SELECT * FROM noticias");
$stmt->execute();
$resultado = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Noticias</title>
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

        .boton-crear {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th, table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .boton {
            background-color: #2196F3;
            color: white;
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
        }

        .boton.eliminar {
            background-color: #f44336;
        }

        .boton:hover {
            background-color: #555;
        }

        .acciones {
            display: flex; /* Usar flexbox para alinear los botones */
            gap: 10px; /* Espacio entre los botones */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Noticias</h1>
        <a href="fornoticias.php" class="boton-crear">CREAR NUEVA NOTICIA</a>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Contenido</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = $resultado->fetch_object()) { ?>
                    <tr>
                        <td><?php echo $fila->id; ?></td>
                        <td><?php echo $fila->titulo; ?></td>
                        <td><?php echo substr($fila->texto, 0, 50) . "..."; ?></td>
                        <td><img src="../../<?php echo $fila->image ?>"width="125"></td>
                        <td class="acciones">
                            <a href="fornoticias.php?id=<?php echo $fila->id; ?>" class="boton">Editar</a>
                            <a href="noticias.php?operacion=DELETE&id=<?php echo $fila->id; ?>" class="boton eliminar">Eliminar</a>
                            
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>
</html>