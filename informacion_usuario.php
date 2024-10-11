<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("location: ./login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Información</title>
</head>
<body>
    <h1>Actualizar Datos de Usuario</h1>
    <form action="">
        <input type="text" name="nombre_usuario" id="nombre_usuario" placeholder="Nombre">
        <input type="text" name="apellido_usuario" id="apellido_usuario" placeholder="Apellido">
        <input type="email" name="email_usuario" id="email_usuario" placeholder="Correo Electrónico">
        <input type="password" name="password_usuario" id="password_usuario" placeholder="Contraseña">
        <button type="button" id="btn-actualizar">Actualizar Datos</button>
    </form>
    <script src="./public/js/informacion_usuario.js"></script>
</body>
</html>
