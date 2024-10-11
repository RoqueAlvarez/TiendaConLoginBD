<?php
session_start();
require_once '../config/conexion.php';


$nombreUsuario = $_POST['nombre'];
$apellidoUsuario = $_POST['apellido'];
$emailUsuario = $_POST['email'];
$passUsuario = $_POST['pass'];


$idUsuario = $_SESSION['usuario']['id_usuario'];
$actualizacion = $conexion->prepare("UPDATE t_usuarios 
        SET nombre = :nombre, apellido = :apellido, email = :email, pass = :pass  
        WHERE id_usuario = :id_usuario");

$actualizacion->bindParam(':nombre', $nombreUsuario);
$actualizacion->bindParam(':apellido', $apellidoUsuario);
$actualizacion->bindParam(':email', $emailUsuario);
$actualizacion->bindParam(':pass', $passUsuario);
$actualizacion->bindParam(':id_usuario', $idUsuario);


$actualizacion->execute();


if ($actualizacion) {
    $consulta = $conexion->prepare("SELECT * FROM t_usuarios WHERE id_usuario = :id_usuario");
    $consulta->bindParam(':id_usuario', $idUsuario);
    $consulta->execute();
    $datosUsuario = $consulta->fetch(PDO::FETCH_ASSOC);

    if ($datosUsuario) {
        $_SESSION['usuario'] = $datosUsuario;
        echo json_encode([1, "Información actualizada correctamente"]);
    } else {
        echo json_encode([0, "Error al actualizar datos"]);
    }
} else {
    echo json_encode([0, "Error al actualizar datos"]);
}
?>
