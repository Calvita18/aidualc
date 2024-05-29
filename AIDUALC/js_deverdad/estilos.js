function agregarAlCarrito(id, button) {
    button.disabled = true;
    // button.innerHTML = 'Cargando...';

    fetch('../carrito/anadir_carrito.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id: id })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error en la respuesta del servidor');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            alert('Producto añadido al carrito');
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Ocurrió un error al procesar la solicitud');
    })
    .finally(() => {
        button.disabled = false;
        button.innerHTML = 'Añadir al carrito';
    });
}
function seleccionarTalla(size) {
    size.classList.toggle('selected'); 
}

// Función para obtener las tallas seleccionadas
function obtenerTalla() {
    var selectedSizes = [];
    var sizes = document.querySelectorAll('.talla');
    sizes.forEach(function(size) {
        if (size.classList.contains('selected')) {
            selectedSizes.push(size.textContent); 
        }
    });
    return selectedSizes;
}
