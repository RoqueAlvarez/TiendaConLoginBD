<?php
require_once("./app/config/dependencias.php");
session_start();

if (isset($_SESSION['usuario'])) {
    header("location: ./index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=CSS."bootstrap.min.css";?>">
    <link rel="stylesheet" href="<?=CSS."registro_vista.css";?>">
    <title>Registro de Usuario</title>
</head>
<body class="d-flex justify-content-center align-items-center mt-5 p-3">
    <form action="./registro_vista.php" method="post" class="w-25 p-4">
        <div class="text-center mb-4">
            <h2 class="text-white">Crea tu Cuenta</h2>
        </div>
        <div class="input-group mt-3">
            <input type="text" class="form-control" placeholder="Nombre Completo" id="nombre_usuario" name="nombre" value="">
        </div>
        <div class="input-group mt-3">
            <input type="text" class="form-control" placeholder="Apellido" id="apellido_usuario" name="apellido" value="">
        </div>
        <div class="input-group mt-3">
            <input type="email" class="form-control" placeholder="Correo Electrónico" id="email_usuario" name="email" value="">
        </div>
        <div class="input-group mt-3">
            <input type="password" class="form-control" placeholder="Crea tu Contraseña" id="pass_usuario" name="pass" value="">
        </div>
        <div class="mt-3">
            <button type="button" id="btn-registrar" class="btn w-100 text-white fs-4">Registrarse</button> 
        </div>
    </form>

    <script src="./public/js/alerts.js"></script>
    <script src="./public/js/main.js"></script>
</body>
</html>
