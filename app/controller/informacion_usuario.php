<?php
session_start();
require_once '../config/conexion.php';


$idUsuario = $_SESSION['usuario']['id_usuario'];
$consultaUsuario = $conexion->prepare("SELECT * FROM t_usuarios WHERE id_usuario = :id_usuario");
$consultaUsuario->bindParam(':id_usuario', $idUsuario);
$consultaUsuario->execute();

$datosUsuario = $consultaUsuario->fetch(PDO::FETCH_ASSOC);

echo json_encode($datosUsuario);
?>
