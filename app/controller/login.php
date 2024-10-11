<?php
require_once '../config/conexion.php';
session_start();

if ($_POST) {
    if (isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['pass']) && !empty($_POST['pass'])) {

        $emailUsuario = $_POST['email'];
        $passwordUsuario = $_POST['pass'];

        $consultaUsuario = $conexion->prepare("SELECT * FROM t_usuarios WHERE email = :email");
        $consultaUsuario->bindParam(':email', $emailUsuario);
        $consultaUsuario->execute();
        $datosUsuario = $consultaUsuario->fetch(PDO::FETCH_ASSOC);

        if ($datosUsuario) {
            if ($datosUsuario['pass'] == $passwordUsuario) {
                $_SESSION['usuario'] = $datosUsuario;
                echo json_encode([1, "Datos de acceso correctos"]);
            } else {
                echo json_encode([0, "Error en credenciales de acceso"]);
            }
        } else {
            echo json_encode([0, "Información no localizada"]);
        }
        
    } else {
        echo json_encode([0, "Tienes que llenar los datos en el formulario"]);
    }
}
?>
