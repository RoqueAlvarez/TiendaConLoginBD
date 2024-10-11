<?php 
require_once "./app/config/dependencias.php";

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
    <link rel="stylesheet" href="<?=CSS."main.css";?>">
    <title>Ingreso de Usuario</title>
</head>
<body class="d-flex justify-content-center align-items-center mt-5 p-3">
    <form action="./login.php" method="post" class="w-25 p-4">
        <div class="text-center mb-5 c-user">
            <h2 class="text-white">Acceso al Sistema</h2>
        </div>
        <div class="input-group mt-3">
            <input type="email" id="email_usuario" class="form-control" placeholder="Correo Electrónico" name="email" value="">
        </div>
        <div class="input-group mt-3">
            <input type="password" id="pass_usuario" class="form-control" placeholder="Contraseña" name="pass" value="">
        </div>
        <div class="mt-5 c-button">
            <button type="button" id="btn-ingresar" class="btn w-100 text-white fs-4">Iniciar Sesión</button>
        </div>
        <div class="mt-4 d-flex justify-content-center">
            <p>¿No tienes una cuenta?</p> 
            <a href="./registro_vista.php" class="text-white mx-3">Regístrate aquí</a>
        </div>
    </form>

    <script src="./public/js/alerts.js"></script>
    <script src="./public/js/main.js"></script>
</body>
</html>
