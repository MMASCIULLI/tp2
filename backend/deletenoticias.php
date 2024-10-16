<?php
// Mostrar errores durante el desarrollo
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Incluir la conexión a la base de datos
require_once("db.php");

// Verificar que se ha recibido un ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Preparar y ejecutar la consulta de eliminación
    $stmt = $conx->prepare("DELETE FROM noticias WHERE id = ?");
    $stmt->bind_param('i', $id);
    
    if ($stmt->execute()) {
        header('Location: noticias.php'); // Redirigir después de eliminar
        exit;
    } else {
        echo "Error al eliminar la noticia: " . $stmt->error;
    }
} else {
    echo "ID de noticia no especificado.";
}
?>








