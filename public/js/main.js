//URL: dirección externa
//URI: dirección interna
const autenticarUsuario = () => {
    let correo = document.getElementById('email-id').value;
    let clave = document.getElementById('pass-id').value;
    let formularioDatos = new FormData();
    formularioDatos.append("email", correo); //añade datos al formulario
    formularioDatos.append("pass", clave); //añade datos al formulario

    fetch("app/controller/login.php", {
        method: "POST",
        body: formularioDatos
    })
    .then(respuesta => respuesta.json())
    .then(async resultado => {
        if (resultado[0] == 1) {
            await Swal.fire({icon: "success", title: `${resultado[1]}`});
            window.location = "index.php";
        } else {
            Swal.fire({icon: "error", title: `${resultado[1]}`});
        }
    });
}

const registrarUsuario = () => {
    let nuevoNombre = document.getElementById('nombre').value;
    let nuevoApellido = document.getElementById('apellido').value;
    let nuevoCorreo = document.getElementById('email').value;
    let nuevaClave = document.getElementById('pass').value;
    let formularioDatos = new FormData();
    formularioDatos.append("nombre", nuevoNombre); 
    formularioDatos.append("apellido", nuevoApellido); 
    formularioDatos.append("email", nuevoCorreo); 
    formularioDatos.append("pass", nuevaClave); 

    fetch("app/controller/registro.php", {
        method: "POST",
        body: formularioDatos
    })
    .then(respuesta => respuesta.json())
    .then(async resultado => {
        if (resultado[0] == 1) {
            await Swal.fire({icon: "success", title: `${resultado[1]}`});
            window.location = "login.php";
        } else {
            Swal.fire({icon: "error", title: `${resultado[1]}`});
        }
    });
}

window.addEventListener('DOMContentLoaded', () => {
    const btnLogin = document.getElementById('btn-saludar');
    if (btnLogin) {
        btnLogin.addEventListener('click', () => {
            autenticarUsuario();
        });
    }

    const btnRegistro = document.getElementById('btn-registrar');
    if (btnRegistro) {
        btnRegistro.addEventListener('click', () => {
            registrarUsuario();
        });
    }
});
