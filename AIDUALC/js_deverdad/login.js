document.addEventListener("readystatechange",cargarEventos,false);//cargar todo (siempre es así)
function cargarEventos(evento){//comprobamos que el esxtado está interecativo (funciona)
    if(document.readyState=="interactive"){
        document.getElementById("enviar").addEventListener("click", enviar, true);//cogemos el elemento por el id, le añadimos uno que escucha los clicks y manda a comprobarlos
        // document.getElementById("correo").addEventListener("click", ocultarError, true);//cogemos el elemento por el id, le añadimos uno que escucha los clicks y manda a comprobarlos
        // document.getElementById("pass").addEventListener("click", ocultarError, true);//cogemos el elemento por el id, le añadimos uno que escucha los clicks y manda a comprobarlos
        document.getElementById("mostrar").addEventListener("click", mostrarContrasena, true);
    }
}


function enviar(){
    document.forms["formulario"].submit();
}

// function ocultarError(){
//     document.getElementById("parrafoError").className("noVisible");
// }

function mostrarContrasena(){
    var icono = document.getElementById("mostrar");
    var tipo = document.getElementById("pass");

    if(tipo.type == "password"){
        icono.className="fa-regular fa-eye";
        tipo.type = "text";
    }else{
        tipo.type = "password";
        icono.className="fa-regular fa-eye-slash";
    }
}