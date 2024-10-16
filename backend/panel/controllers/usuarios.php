<?php
require_once("../includes/db.php");

$operacion = $_GET["operacion"];

if ($operacion == "NEW") {
    $email = $_POST['email'];
    $password = $_POST["password"];

    // Hashear la contraseña antes de guardarla
    $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

    // Insertar el nuevo usuario en la base de datos
    $sentencia = $conx->prepare("INSERT INTO usuarios (email, password) VALUES (?, ?)");
    $sentencia->bind_param("ss", $email, $passwordHashed);

    if ($sentencia->execute()) {
        // Si la inserción fue exitosa, redirigir al listado
        header("Location: ../../listado.php");
        exit();
    } else {
        echo "Error al crear el usuario: " . $sentencia->error;
    }
}
 else if ($operacion == "EDIT") {
    $id = $_POST['id'];
    $email = $_POST['email'];
    $password = $_POST["password"];

    // esto es para verificar las contraseñas almacenadas con la ingresada
    $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

    
    $sentencia = $conx->prepare("UPDATE usuarios SET email = ?, password = ? WHERE id = ?");
    $sentencia->bind_param("ssi", $email, $passwordHashed, $id);
    if (!$sentencia->execute()) {
        echo "Error en la consulta: " . $sentencia->error;
    }

} else if ($operacion == "DELETE") {
    $id = $_GET["id"];

    //se elimina el usuario
    $sentencia = $conx->prepare("DELETE FROM usuarios WHERE id = ?");
    $sentencia->bind_param("i", $id);
    if (!$sentencia->execute()) {
        echo "Error en la consulta: " . $sentencia->error;
    }
}

header("Location: ../../listado.php");
exit();

?>