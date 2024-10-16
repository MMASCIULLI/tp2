<?php
require_once("../backend/panel/includes/db.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sentencia = $conx->prepare("SELECT * FROM usuarios WHERE id = ?");
    $sentencia->bind_param('i', $id);
    $sentencia->execute();
    $resultado = $sentencia->get_result();
    $usuario = $resultado->fetch_object();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($_GET["id"]) ? "Editar Usuario" : "Crear Usuario"; ?></title>
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
            max-width: 400px;
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

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .boton-guardar {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .boton-guardar:hover {
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

    <h1><?php echo isset($_GET["id"]) ? "Editar Usuario" : "Crear Usuario"; ?></h1>

    <form action="panel/controllers/usuarios.php?operacion=NEW" method="POST">
        <input type="hidden" name="id" value="<?php echo isset($_GET["id"]) ? $usuario->id : ""; ?>" />

        <div>
            <label for="email">Email</label>
            <input type="text" id="email" name="email" value="<?php echo isset($_GET["id"]) ? $usuario->email : ""; ?>" required />
        </div>

        <div>
            <label for="password">Password</label>
            <input type="text" id="password" name="password" value="<?php echo isset($_GET["id"]) ? $usuario->password : ""; ?>" required />
        </div>

        <button class="boton-guardar" type="submit">Guardar</button>
    </form>

    <a href=" listado.php" class="volver">Volver al listado</a>

</body>
</html>