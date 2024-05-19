document.addEventListener("DOMContentLoaded", function() {
    const peticion = (tipo, contenedor) => {
        const formData = new FormData();
        formData.append('tipo', tipo);

        const options = {
            method: 'POST',
            body: formData
        };

        fetch('../imagenes_romantico/estilos.php', options)
        .then((response) => response.json())
        .then((data) => mostrarResultados(contenedor, data.resultados))
        .catch((error) => console.error('Error:', error));
    }

    const camisetaRomantico = document.getElementById("camisetaRomantico");
    const pantalonesRomantico = document.getElementById("pantalonesRomantico");
    const accesoriosRomantico = document.getElementById("accesoriosRomantico");

    const camisetaRetro = document.getElementById("camisetaRetro");
    const pantalonesRetro = document.getElementById("pantalonesRetro");
    const accesoriosRetro = document.getElementById("accesoriosRetro");

    const camisetaRockero = document.getElementById("camisetaRockero");
    const pantalonesRockero = document.getElementById("pantalonesRockero");
    const accesoriosRockero = document.getElementById("accesoriosRockero");

    function handleButtonClick(tipo) {
        const formData = new FormData();
        formData.append('tipo', tipo);
    
        const options = {
            method: 'POST',
            body: formData
        };
    
        fetch('../imagenes_romantico/estilos.php', options)
            .then((response) => response.json())
            .then((data) => mostrarResultados(data.resultados))
            .catch((error) => console.error('Error:', error));
    }
    
    function mostrarResultados(resultados) {
        const resultsDiv = document.createElement('div');
        resultsDiv.classList.add('results-container');
    
        resultados.forEach(item => {
            const img = document.createElement('img');
            img.src = item.src;
    
            const nombre = document.createElement('p');
            nombre.textContent = 'Nombre: ' + item.nombre;
    
            const precio = document.createElement('p');
            precio.textContent = 'Precio: ' + item.precio;
    
            const talla = document.createElement('p');
            talla.textContent = 'Talla: ' + item.talla;
    
            const color = document.createElement('p');
            color.textContent = 'Color: ' + item.color;
    
            const descripcion = document.createElement('p');
            descripcion.textContent = 'Descripción: ' + item.descripcion;
    
            const itemDiv = document.createElement('div');
            itemDiv.classList.add('item');
    
            itemDiv.appendChild(img);
            itemDiv.appendChild(nombre);
            itemDiv.appendChild(descripcion);
            itemDiv.appendChild(precio);
            itemDiv.appendChild(talla);
            itemDiv.appendChild(color);
           
    
            resultsDiv.appendChild(itemDiv);
        });
    
        const contenidoDinamico = document.getElementById('contenido-dinamico');
        contenidoDinamico.innerHTML = '';
        contenidoDinamico.appendChild(resultsDiv);
    }    

    if (camisetaRomantico) camisetaRomantico.addEventListener("click", () => handleButtonClick('camisetaRomantico'));
    if (pantalonesRomantico) pantalonesRomantico.addEventListener("click", () => handleButtonClick('pantalonesRomantico'));
    if (accesoriosRomantico) accesoriosRomantico.addEventListener("click", () => handleButtonClick('accesoriosRomantico'));

    if (camisetaRetro) camisetaRetro.addEventListener("click", () => handleButtonClick('camisetaRetro'));
    if (pantalonesRetro) pantalonesRetro.addEventListener("click", () => handleButtonClick('pantalonesRetro'));
    if (accesoriosRetro) accesoriosRetro.addEventListener("click", () => handleButtonClick('accesoriosRetro'));

    if (camisetaRockero) camisetaRockero.addEventListener("click", () => handleButtonClick('camisetaRockero'));
    if (pantalonesRockero) pantalonesRockero.addEventListener("click", () => handleButtonClick('pantalonesRockero'));
    if (accesoriosRockero) accesoriosRockero.addEventListener("click", () => handleButtonClick('accesoriosRockero'));
});
