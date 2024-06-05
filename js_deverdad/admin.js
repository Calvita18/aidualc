document.addEventListener("readystatechange",cargarEventos,false)//cargar todo (siempre es así)
function cargarEventos(evento){//comprobamos que el esxtado está interecativo (funciona)
    if(document.readyState=="interactive"){
        document.getElementById("enviarMensaje").addEventListener("click", comprueba, true);//cogemos el elemento por el id, le añadimos uno que escucha los clicks y manda a comprobarlos
        document.getElementById("nombre").addEventListener("click",function (){ocultarError("mnombre")}, true);
        document.getElementById("email").addEventListener("click",function (){ocultarError("memail")}, true);
        document.getElementById("telf").addEventListener("click",function (){ocultarError("mtelefono")}, true);
        document.getElementById("mensaje").addEventListener("click",function (){ocultarError("mmensaje")}, true);
    }
}



function comprueba() {
    //hasta que no se comprueba todo no se hace la llamada por eso no se recarga la página
    var nombre = 0;
    var email = 0;
    var mensaje = 0;
    var telefono = 0; 

    if (document.getElementById("nombre").value == "") {
        document.getElementById("mnombre").className = "visible";
    } else {
        nombre = 1;
    }

    if (document.getElementById("mensaje").value == "") {
        document.getElementById("mmensaje").className = "visible";
    } else {
        if (contarLetras(document.getElementById("mensaje").value) >= 20) { //verificamos si el mensaje tiene al menos 20 letras
            mensaje = 1;
        } else {
            document.getElementById("mmensaje").className = "visible";
            document.getElementById("mmensaje").innerText = "Por favor, introduzca un mensaje válido.";
        }
    }

    if (document.getElementById("email").value == "") {
        document.getElementById("memail").innerText = "Campo obligatorio";
        document.getElementById("memail").className = "visible";
    } else {
        if (validarCorreo(document.getElementById("email").value)) {
            email = 1;
        } else {
            document.getElementById("memail").className = "visible";
            document.getElementById("memail").innerText = "No cumple con los requisitos.";
        }
    }

    if (document.getElementById("telf").value != "") { 
        if (validarTelefono(document.getElementById("telf").value)) {
            telefono = 1;
        } else {
            document.getElementById("mtelefono").className = "visible";
            document.getElementById("mtelefono").innerText = "Por favor, introduzca un número válido.";
        }
    } else {
        telefono = 1; //si el teléfono está vacío es válido
    }

    if (nombre + email + mensaje + telefono == 4) { 
        mostrarToast(); 
    }
}

function ocultarError(parametro){
     document.getElementById(parametro).className = "noVisible";
 }

function validarCorreo(email) {
    // compruebo la expresión regular y devulevo si es válido o no
    if (/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/.test(email)) {
        return true;
    } else {
        return false;
    }
}

function validarTelefono(telefono){
    // compruebo la expresión regular y devulevo si es válido o no
    if (/^\d{9}$/.test(telefono)) {
        return true;
    } else {
        return false;
    }
}

function contarLetras(texto) {
    var letras = texto.match(/[a-zA-Z]/g); 
    return letras ? letras.length : 0; //si hay letras, devuelve la longitud, sino 0
}