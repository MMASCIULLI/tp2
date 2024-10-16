<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("../../includes/db.php");


session_start();


$email= isset($_POST["email"]) ? $_POST["email"] : "";
$password = isset($_POST["password"]) ? $_POST["password"] : "";

if (!empty($email)&& !empty ($password)) {
    $stmt = $conx->prepare("SELECT * FROM usuarios WHERE email = ? AND password = ?");
    $stmt->bind_param('ss', $email, $password);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $stmt->close();

    $usuario = $resultado->fetch_object();
   

    if ($usuario === NULL){
        echo  "Usuario o contraseña incorrecta <br>";
    }   else {
                $_SESSION["id"] = $usuario->id;
                header("Location: ../../../index.php");
                exit();
                
    
        } 
     
    }        
 ?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            border: none;
            border-radius: 9px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Iniciar Sesión</h1>

        <form  method="POST">
            <input type="text" name="email" placeholder="Ingrese su usuario" required>
			<input type="password" name="password" placeholder="Ingrese su contraseña" required>
            <button type="submit">Iniciar Sesion</button>
        </form>
    </div>

</body>
</html>