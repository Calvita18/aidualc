// document.addEventListener("DOMContentLoaded", function() {
//     const peticion = (tipo) => {
//         const formData = new FormData();
//         formData.append('tipo', tipo);
//         const opciones = {
//             method: 'POST',
//             body: formData
//         };
//         return fetch('../imagenes_romantico/estilos.php', opciones)
//             .then(response => response.json());
//     };

//     function mostrarResultados(resultados) {
//         const resultadosDiv = document.createElement('div');
//         resultadosDiv.classList.add('results-container');
    
//         resultados.forEach(item => {
//             const img = document.createElement('img');
//             img.src = item.src;
    
//             const nombre = document.createElement('p');
//             nombre.textContent = 'Nombre: ' + item.nombre;
    
//             const precio = document.createElement('p');
//             precio.textContent = 'Precio: ' + item.precio;
    
//             const tallaContainer = document.createElement('div');
//             tallaContainer.classList.add('tallas-container'); 
    
//             item.talla = Array.isArray(item.talla) ? item.talla : [item.talla]; 

//             item.talla.forEach(talla => {
//                 const tallaButton = document.createElement('button'); 
//                 tallaButton.textContent = talla; 
//                 tallaButton.classList.add('talla'); 
//                 tallaButton.addEventListener('click', () => seleccionarTalla(tallaButton)); 
//                 tallaContainer.appendChild(tallaButton); 
                
//                 if (item.selectedSize === talla) {
//                     tallaButton.classList.add('selected');
//                 }
//             });
            
            
    
//             const color = document.createElement('p');
//             color.textContent = 'Color: ' + item.color;
    
//             const descripcion = document.createElement('p');
//             descripcion.textContent = 'Descripción: ' + item.descripcion;
    
//             const itemDiv = document.createElement('div');
//             itemDiv.classList.add('item'); 
//             itemDiv.appendChild(img);
//             itemDiv.appendChild(nombre);
//             itemDiv.appendChild(descripcion);
//             itemDiv.appendChild(precio);
//             itemDiv.appendChild(tallaContainer);
//             itemDiv.appendChild(color);
    
//             resultadosDiv.appendChild(itemDiv);
//         });
    
//         const contenidoDinamico = document.getElementById('contenido-dinamico');
//         contenidoDinamico.innerHTML = '';
//         contenidoDinamico.appendChild(resultadosDiv);
//     }
    
//     function seleccionarTalla(tallaElement) {
    
//         const allTallas = document.querySelectorAll('.talla');
//         allTallas.forEach(elemento => {
//             elemento.classList.remove('selected');
//         });
    
    
//         tallaElement.classList.add('selected');
//     }
    
//     function handleButtonClick(tipo) {
//         peticion(tipo)
//             .then(data => mostrarResultados(data.resultados))
//             .catch(error => console.error('Error:', error));
//     }


//     if (camisetaRomantico) camisetaRomantico.addEventListener("click", () => handleButtonClick('camisetaRomantico'));
//     if (pantalonesRomantico) pantalonesRomantico.addEventListener("click", () => handleButtonClick('pantalonesRomantico'));
//     if (accesoriosRomantico) accesoriosRomantico.addEventListener("click", () => handleButtonClick('accesoriosRomantico'));

//     if (camisetaRetro) camisetaRetro.addEventListener("click", () => handleButtonClick('camisetaRetro'));
//     if (pantalonesRetro) pantalonesRetro.addEventListener("click", () => handleButtonClick('pantalonesRetro'));
//     if (accesoriosRetro) accesoriosRetro.addEventListener("click", () => handleButtonClick('accesoriosRetro'));

//     if (camisetaRockero) camisetaRockero.addEventListener("click", () => handleButtonClick('camisetaRockero'));
//     if (pantalonesRockero) pantalonesRockero.addEventListener("click", () => handleButtonClick('pantalonesRockero'));
//     if (accesoriosRockero) accesoriosRockero.addEventListener("click", () => handleButtonClick('accesoriosRockero'));
// });
document.addEventListener('DOMContentLoaded', function() {
    const tallasContainers = document.querySelectorAll('.tallas-container');
    tallasContainers.forEach(container => {
        container.addEventListener('click', function(event) {
            if (event.target.classList.contains('talla')) {
                const tallas = container.querySelectorAll('.talla');
                const isSelected = event.target.classList.contains('selected');
                tallas.forEach(talla => {
                    talla.classList.remove('selected');
                });
                if (!isSelected) {
                    event.target.classList.add('selected');
                }
            }
        });
    });
});
