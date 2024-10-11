<?php
require_once '../config/conexion.php';
session_start();

$idProducto = $_POST['idInput'];

$eliminarProducto = $conexion->prepare("DELETE FROM t_productos WHERE id_producto = :id_producto");
$eliminarProducto->bindParam(':id_producto', $idProducto);
$eliminarProducto->execute();

if ($eliminarProducto) {
    echo json_encode([1, 'Producto eliminado correctamente']);
} else {
    echo json_encode([0, 'Producto NO eliminado correctamente']);
}
?>
