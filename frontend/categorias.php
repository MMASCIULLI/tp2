<?php
require_once("../backend/panel/includes/db.php");

// Obtener las categorías de la base de datos
$sql = "SELECT id, nombre FROM categorias";
$resultado = $conx->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías de Noticias</title>
   
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Categorías</h1>
        
        <div class="list-group">
            <?php while($categoria = $resultado->fetch_object()): ?>
                <a href="noticias_categoria.php?categoria_id=<?php echo $categoria->id; ?>" class="list-group-item list-group-item-action">
                    <?php echo $categoria->nombre; ?>
                </a>
            <?php endwhile; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>