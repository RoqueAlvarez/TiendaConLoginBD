const finalizarSesion = () => {
    fetch("app/controller/cerrar_sesion.php")
    .then(respuesta => respuesta.json())
    .then(async (resultado) => {
        await Swal.fire({icon: "success", title: `${resultado[1]}`});
        window.location = "login.php";
    });
}

document.getElementById('btn-cerrar-sesion').addEventListener('click', () => {
    finalizarSesion();
});
