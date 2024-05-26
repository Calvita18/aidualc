<?php
 
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        require_once("Usuario.php");
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
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://kit.fontawesome.com/bd054b17a6.js" crossorigin="anonymous"></script> <!--iconos-->
<script src="https://www.google.com/recaptcha/api.js" async defer></script> <!--recaptcha-->
<script src="./../js_deverdad/registro.js"></script>
<link href="./../estilos/style_registro.css" rel="stylesheet" type="text/css"></link>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>

<title>Registro</title>

</head>
<body>
<div class="container">
    <div class="row justify-content-center">
            <div class="card">
                <div class="card-header"><img src="./../imagenes/AIDUALC.png" style="width: 150px; border-radius: 50%;" alt="logo"></div>
                <div class="card-body justify-content-center p-4 ">
                    <form method="post" action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>"  name="formulario" id="formulario">
                        <div class="form-group">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Obligatorio">
                        </div>
                        <p class="noVisible" id="mnombre">Campo obligatorio</p>

                        <div class="form-group">
                            <label for="apellido" class="form-label">Apellido:</label>
                            <input type="text" id="apellido" name="apellido" class="form-control" placeholder="Obligatorio">
                        </div>
                        <p class="noVisible" id="mapellido">Campo obligatorio</p>

                        <div class="form-group">
                            <label for="email" class="form-label">Correo electrónico:</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Obligatorio">
                        </div>
                        <p class="noVisible" id="mcorreo">Campo obligatorio</p>

                        <div class="form-group">
                            <label for="contra" class="form-label">Contraseña:
                                <i data-toggle="tooltip" data-placement="right" title="La contraseña debe tener mínimo 8 caracteres, una mayúscula y un número " class="fa-solid fa-circle-info" style="font-size: 14px;"></i><br><br>
                                <input type="password" name="contra" id="contra" minlength ="8"  placeholder="Obligatorio"  class="form-control"><i id = "mostrar" class="fa-regular fa-eye-slash"></i>
                            </label>
                        </div>
                        <p id="mcontrasena" class="noVisible">Campo obligatorio</p>
                    
                        <div class="form-group">
                            <label for="fecha" class="form-label">Fecha de nacimiento:</label>
                            <input type="date" id="fecha" name="fecha" class="form-control" placeholder="Obligatorio">
                        </div>
                        <p class="noVisible" id="mfecha">Campo obligatorio</p>

                        <div class="form-group">
                            <label for="dir" class="form-label">Dirección:</label>
                            <input type="text" id="dir" name="dir" class="form-control" placeholder="Obligatorio">
                        </div>
                        <p class="noVisible" id="mdireccion">Campo obligatorio</p>

                        <div class="form-group">
                            <label for="telf" class="form-label">Teléfono:</label>
                            <input type="text" id="telf" name="telf" class="form-control" min="9" max="9" placeholder="Obligatorio">
                        </div>
                        <p class="noVisible" id="mtelefono">Campo obligatorio</p>

                        <!-- <div class="g-recaptcha" data-sitekey="6Lci5YopAAAAADt0zUhTYzh6qLWwHOFmHSSEwwCX"></div><br>  -->

                        <input type="button" value="Registrarse" id="registrar">

                        <p class="cuenta">¿Ya tienes cuenta? <a href="login.php" id="enlace">Inicia sesión</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<a href="../inicio/index.php" class="fa-solid fa-chevron-left">Volver</a>

<script>
    (function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
</body>
</html>
