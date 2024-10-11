<?php
require_once "../config/conexion.php";
session_start();

$expresionEmail = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

if (isset($_SESSION['usuario'])) {
    header("location: ./index.php");
    exit();
}

if ($_POST) {
    if (isset($_POST['nombre']) && !empty($_POST['nombre']) && 
        isset($_POST['apellido']) && !empty($_POST['apellido']) &&
        isset($_POST['email']) && !empty($_POST['email']) &&
        isset($_POST['pass']) && !empty($_POST['pass'])) {

        if (is_numeric($_POST['nombre'])) {
            echo json_encode([0, "No puedes agregar números en el input nombre"]);
        } else if (is_numeric($_POST['apellido'])) {
            echo json_encode([0, "No puedes agregar números en el input apellido"]);
        } else if (!preg_match($expresionEmail, $_POST['email'])) {
            echo json_encode([0, "No cumples con las especificaciones de un correo"]);
        } else {
            $nombreUsuario = $_POST['nombre'];
            $apellidoUsuario = $_POST['apellido'];
            $emailUsuario = $_POST['email'];
            $passwordUsuario = $_POST['pass'];

            $insercionUsuario = $conexion->prepare("INSERT INTO t_usuarios (nombre, apellido, email, pass) 
                                                    VALUES (:nombre, :apellido, :email, :pass)");
            
            $insercionUsuario->bindParam(':nombre', $nombreUsuario);
            $insercionUsuario->bindParam(':apellido', $apellidoUsuario);
            $insercionUsuario->bindParam(':email', $emailUsuario);
            $insercionUsuario->bindParam(':pass', $passwordUsuario);

            $insercionUsuario->execute();

            if ($insercionUsuario) {
                echo json_encode([1, "Usuario registrado correctamente"]);
            } else {
                echo json_encode([0, "Usuario NO registrado"]);
            }
        }
        
    } else {
        echo json_encode([0, "No puedes dejar campos vacíos"]);
    }
}
?>
