function actualizarCarrito(id, action) {
    fetch('actualizar_carrito.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id: id, action: action })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // alert('Carrito actualizado');
            location.reload(); //recargar la página para mostrar los cambios
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => console.error('Error:', error));
}

function borrarCarrito(id) {
    fetch('borrar_carrito.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id: id })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // alert('Producto eliminado del carrito');
            location.reload(); //recargar la página para mostrar los cambios
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => console.error('Error:', error));
}

function finalizarCompra() {
    window.location.href = 'checkout.php';
}

function seguirComprando() {
    window.location.href = '../inicio/index.php'; 
}

function eliminarTodo() {
    var respuesta = confirm("¿Estás seguro que quieres vaciar todo el carrito?");

    if (respuesta) {
        fetch('vaciar_carrito.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ cliente_id: cliente_id })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload(); //recargar la página para mostrar los cambios
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    }
}
