<?php

require_once '../config/conexion.php';

$consultaProductos = $conexion->prepare("SELECT * FROM t_productos");
$consultaProductos->execute();
$datosProductos = $consultaProductos->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($datosProductos);

?>
