let productoEditar;
let editandoProducto = false;

const cargarDatos = () => {
    let tablaProducto = document.getElementById('tabla_productos');
    fetch("app/controller/obtener_datos.php")
    .then(respuesta => respuesta.json())
    .then((respuesta) => {
        let contenido = ''; 
        respuesta.forEach((producto) => {
            contenido += `
                <tr>
                    <td>${producto['producto']}</td>
                    <td>$${producto['precio']}</td>
                    <td>${producto['cantidad']}</td>
                    <td>
                        <button class="btn btn-warning me-3 editar" data-btn="editar" data-id="${producto['id_producto']}" data-nombre="${producto['producto']}" data-precio="${producto['precio']}" data-cantidad="${producto['cantidad']}">
                            Editar
                        </button>
                        <button class="btn btn-danger eliminar" data-btn="eliminar" data-id="${producto['id_producto']}">
                            Eliminar
                        </button>
                    </td>
                </tr>
            `; 
        });
        tablaProducto.innerHTML = contenido;
    });
}

const agregarProducto = () => {
    let nombreProducto = document.getElementById('nombre').value;
    let precioProducto = document.getElementById('precio').value;
    let cantidadProducto = document.getElementById('cantidad').value;
    let data = new FormData();
    data.append("nombre_p", nombreProducto); 
    data.append("precio_p", precioProducto); 
    data.append("cantidad_p", cantidadProducto);
    fetch("app/controller/registro_productos.php", {
        method: "POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then(async respuesta => {
        if (respuesta[0] == 1) {
            await Swal.fire({ icon: "success", title: `${respuesta[1]}` });
            cargarDatos();
            document.getElementById('nombre').value = '';
            document.getElementById('precio').value = '';
            document.getElementById('cantidad').value = '';
        } else {
            Swal.fire({ icon: "error", title: `${respuesta[1]}` });
        }
    });
}

const modificarProducto = () => {
    let nombreProducto = document.getElementById('nombre').value;
    let precioProducto = document.getElementById('precio').value;
    let cantidadProducto = document.getElementById('cantidad').value;
    let data = new FormData();
    data.append('idInput', productoEditar);
    data.append("nombre_p", nombreProducto); 
    data.append("precio_p", precioProducto); 
    data.append("cantidad_p", cantidadProducto); 
    fetch(`app/controller/actualizar_producto.php`, {
        method: "POST",
        body: data
    })
    .then(res => res.json())
    .then(async (res) => {
        if (res[0] == 1) {
            await Swal.fire({ icon: "success", title: `${res[1]}` });
            cargarDatos();
            editandoProducto = false;
            document.getElementById('nombre').value = '';
            document.getElementById('precio').value = '';
            document.getElementById('cantidad').value = '';
            document.getElementById('btn-registrar-producto').classList.remove('editar_producto');
            document.getElementById('btn-registrar-producto').classList.add('registrar_producto');
            document.getElementById('btn-registrar-producto').textContent = 'Registrar producto';
        } else {
            Swal.fire({ icon: "error", title: `${res[1]}` });
        }
    });
} 

const borrarProducto = () => {
    let data = new FormData();
    data.append('idInput', productoEditar);
    fetch('app/controller/eliminar_producto.php', {
        method: 'POST',
        body: data
    })
    .then(respuesta => respuesta.json())
    .then(async respuesta => {
        if (respuesta[0] == 1) {
            await Swal.fire({ icon: "success", title: `${respuesta[1]}` });
            cargarDatos();
        } else {
            await Swal.fire({ icon: "error", title: `${respuesta[1]}` });
        }
    });
}

document.addEventListener('DOMContentLoaded', () => {
    cargarDatos();
});

document.getElementById('btn-registrar-producto').addEventListener('click', () => {
    if (!editandoProducto) {
        agregarProducto();
    } else {
        modificarProducto();
    }
});

document.getElementById('tabla_productos').addEventListener('click', (e) => {
    if (e.target.classList.contains('editar')) {
        document.getElementById('nombre').value = e.target.dataset.nombre;
        document.getElementById('precio').value = e.target.dataset.precio;
        document.getElementById('cantidad').value = e.target.dataset.cantidad;

        document.getElementById('btn-registrar-producto').classList.remove('registrar_producto');
        document.getElementById('btn-registrar-producto').classList.add('editar_producto');
        document.getElementById('btn-registrar-producto').textContent = 'Editar Producto';

        productoEditar = e.target.dataset.id;
        editandoProducto = true;
    }
    if (e.target.classList.contains('eliminar')) {
        Swal.fire({
            icon: "warning",
            text: "¿Confirmas la eliminación de este producto?",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, eliminar producto"
        }).then((resultado) => {
            if (resultado.isConfirmed) {
                productoEditar = e.target.dataset.id;
                borrarProducto();
            }
        });
    }
});
