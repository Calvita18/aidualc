<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/bd054b17a6.js" crossorigin="anonymous"></script> <!--iconos-->
    <link href="./../estilos/style.css" rel="stylesheet" type="text/css"></link>
    <script src="./../js_deverdad/registro.js"></script>
    <script src= "https://www.google.com/recaptcha/api.js" async defer></script> <!--recaptcha-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./../js/bootstrap-5.0.2-dist/css/bootstrap.min.css">

    <title>Registro</title>
</head>
<body>

<form method="post" action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" enctype="multipart/form-data" name="formulario" id="formulario">
    <label>
        Nombre <input type="text" id="nombre" name="nombre" placeholder="Obligatorio">
    </label><p class="noVisible" id="mnombre">Campo obligatorio</p>

    <label for="apellido">Apellido: 
        <input type="text" name="apellido" id="apellido"  placeholder="Obligatorio">
    </label><p id="mapellido" class="noVisible">Campo obligatorio</p>

    <label for="email"> Correo electrónico: 
        <input type="email" name="email" id="email"  placeholder="Obligatorio">
    </label><p id="mcorreo" class="noVisible">Campo obligatorio</p>

    <label for="contra">Contraseña:<i data-toggle="tooltip" data-placement="right" title="La contraseña debe tener mínimo 8 caracteres, una mayúscula y un número " class="fa-solid fa-circle-info" style="font-size: 14px;"></i><br><br>
        <input type="password" name="contra" id="contra" minlength ="8"  placeholder="Obligatorio"><i id = "mostrar" class="fa-regular fa-eye-slash"></i>
    </label><p id="mcontrasena" class="noVisible">Campo obligatorio</p>

    <label for="fecha">Fecha de nacimiento: 
	    <input type="date" name="fecha" id="fecha"  placeholder="Obligatorio">
    </label><p id="mfecha" class="noVisible">Campo obligatorio</p>

    <label for="dir">Dirección: 
	    <input type="text" name="dir" id="dir"  placeholder="Obligatorio">
    </label><p id="mdireccion" class="noVisible">Campo obligatorio</p>

    <label for="telf">Teléfono: 
	    <input type="text" name="telf" id="telf" min="9" max="9"  placeholder="Obligatorio">
    </label><p id="mtelefono" class="noVisible">Campo obligatorio</p>

    <!-- div to show reCAPTCHA -->
	<div class="g-recaptcha" data-sitekey="6Lci5YopAAAAADt0zUhTYzh6qLWwHOFmHSSEwwCX"></div><br> 

    <input type="button" value="Registrarse" id="registrar">

    </form>
    
    <?php
     require_once("Usuario.php");

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $nombre = htmlspecialchars(trim($_POST["nombre"]));
        $apellido = htmlspecialchars(trim($_POST["apellido"]));
        $email = htmlspecialchars(trim($_POST["email"]));
        $contra = trim(htmlspecialchars($_POST["contra"]));
        $fecha  = htmlspecialchars(trim($_POST["fecha"])); 
        $dir = htmlspecialchars(trim($_POST["dir"])); 
        $telf = htmlspecialchars(trim($_POST["telf"])); 
       
        
        if(empty($nombre)){
            $errors[] = "Debes introducir un nombre.";
        }

        if(empty($apellido)){
            $errors[] = "Debes introducir un apellido.";
        }

        if(empty($email)){
            $errors[] = "Debes introducir un correo válido.";
        }

        if(empty($contra)){
            $errors[] = "Debes introducir una contraseña.";
        }

        if(empty($fecha)){
            $errors[] = "Debes introducir una fecha de nacimiento.";
        }

        if(empty($dir)){
            $errors[] = "Debes introducir una dirección.";
        }

        if(empty($telf)){
            $errors[] = "Debes introducir un teléfono de contacto.";
        }
        
        if(!empty($errors)){
            foreach($errors as $e){
                echo $e;
            }

        }else{
            $usuario = new Usuario(); 
            $usuario->registrarCliente($nombre, $apellido, $email, $contra, $fecha, $dir, $telf);
        }
    }
    ?>

    <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
    </script>
</body>
</html>