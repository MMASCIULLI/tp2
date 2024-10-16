<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("../backend/panel/includes/db.php");

// Para mostrar todos los usuarios
$stmt = $conx->prepare("SELECT * FROM usuarios");
$stmt -> execute();
$resultado = $stmt -> get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
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

        .registrar-user {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .registrar-user:hover {
            background-color: #45a049;
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
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #90ee90;
            color: white;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            text-align: center;
        }

        .boton-color:hover {
            background-color: #70c570;
        }
    </style>
</head>
<body>

    <h1>Listado de Usuarios</h1>

    <a href="formulario.php" class="registrar-user">Registrar Usuario</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Password</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($fila = $resultado->fetch_object()) {?> 
            <tr>
                <td><?php echo $fila->id; ?></td>
                <td><?php echo $fila->email; ?></td>
                <td> <img src="<?php echo $image ?>" width="100"></td>
                <td>*********</td> 
                <td class="action-buttons">
                    <a href="formulario.php?id=<?php echo $fila->id; ?>">Editar</a>
                    <a href="panel/controllers/usuarios.php?operacion=DELETE&id=<?php echo $fila->id; ?>" class="delete">Eliminar</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <form action="/tp2/backend/panel/views/usuarios/login.php" method="POST">
        <button class="boton-color" name="logout" type="submit">Cerrar Sesión</button>
    </form>

</body>
</html>