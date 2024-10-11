<?php 
require_once '../config/conexion.php';
session_start();

if (!empty($_POST['nombre_producto']) && !empty($_POST['precio_producto']) && !empty($_POST['cantidad_producto'])) {

    $idProducto = $_POST['idInput'];
    $nombreProducto = $_POST['nombre_producto'];
    $precioProducto = $_POST['precio_producto'];
    $cantidadProducto = $_POST['cantidad_producto'];

    if (is_numeric($precioProducto) && is_numeric($cantidadProducto)) {
        $actualizacion = $conexion->prepare("UPDATE t_productos 
        SET producto = :producto, precio = :precio, cantidad = :cantidad  
        WHERE id_producto = :id_producto");

        $actualizacion->bindParam(':producto', $nombreProducto);
        $actualizacion->bindParam(':precio', $precioProducto);
        $actualizacion->bindParam(':cantidad', $cantidadProducto);
        $actualizacion->bindParam(':id_producto', $idProducto);

        $actualizacion->execute();

        if ($actualizacion) {
            echo json_encode([1, "Producto actualizado correctamente"]);
        } else {
            echo json_encode([0, "Producto NO actualizado correctamente"]);
        }
    } else {
        echo json_encode([0, "Solo datos numéricos en precio y cantidad"]);
    }

} else {
    echo json_encode([0, "Datos incompletos"]);
}
?>
