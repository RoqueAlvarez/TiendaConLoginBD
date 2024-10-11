const cargarInformacion = () => {
    fetch("app/controller/informacion_usuario.php")
    .then(respuesta => respuesta.json())
    .then((datosUsuario) => {
        document.getElementById('nombre').value = datosUsuario['nombre'];
        document.getElementById('apellido').value = datosUsuario['apellido'];
        document.getElementById('email').value = datosUsuario['email'];
        document.getElementById('pass').value = datosUsuario['pass'];
    });
}

const guardarInformacion = () => {
    let nuevoNombre = document.getElementById('nombre').value;
    let nuevoApellido = document.getElementById('apellido').value;
    let nuevoEmail = document.getElementById('email').value;
    let nuevaPass = document.getElementById('pass').value;

    let formData = new FormData();
    formData.append('nombre', nuevoNombre);
    formData.append('apellido', nuevoApellido);
    formData.append('email', nuevoEmail);
    formData.append('pass', nuevaPass);

    fetch("app/controller/actualizar_info_usuario.php", {
        method: "POST",
        body: formData
    })
    .then(respuesta => respuesta.json())
    .then(resultado => {
        if (resultado[0] == 1) {
            alert(`${resultado[1]}`);
            window.location = "index.php";
        } else {
            alert(`${resultado[1]}`);
        }
    });
}

document.addEventListener('DOMContentLoaded', () => {
    cargarInformacion();
});

document.getElementById('btn-actualizar').addEventListener('click', () => {
    guardarInformacion();
});
