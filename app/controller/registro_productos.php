<?php
require_once '../config/conexion.php';
session_start();

if (isset($_POST['nombre_producto']) && !empty($_POST['nombre_producto']) && 
    isset($_POST['precio_producto']) && !empty($_POST['precio_producto']) && 
    isset($_POST['cantidad_producto']) && !empty($_POST['cantidad_producto'])) {

    $nombreProducto = $_POST['nombre_producto'];
    $precioProducto = $_POST['precio_producto'];
    $cantidadProducto = $_POST['cantidad_producto'];

    if (is_numeric($precioProducto) && is_numeric($cantidadProducto)) {
        $insercionProducto = $conexion->prepare("INSERT INTO t_productos (producto, precio, cantidad) 
                                                 VALUES (:producto, :precio, :cantidad)");
        
        $insercionProducto->bindParam(':producto', $nombreProducto);
        $insercionProducto->bindParam(':precio', $precioProducto);
        $insercionProducto->bindParam(':cantidad', $cantidadProducto);
    
        $insercionProducto->execute();
        
        if ($insercionProducto) {
            echo json_encode([1, "Producto registrado"]);
        } else {
            echo json_encode([0, "Producto NO registrado"]);
        }
    } else {
        echo json_encode([0, "Solo datos numéricos en precio y cantidad"]);
    }

} else {
    echo json_encode([0, "No puedes dejar campos vacíos"]);
}
?>
