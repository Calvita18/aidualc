<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/bd054b17a6.js" crossorigin="anonymous"></script> <!--iconos-->
    <link href="./../estilos/style_login.css" rel="stylesheet" type="text/css"></link>
    <script src="./../js_deverdad/login.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script> -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <title>Inicio de Sesión</title>
</head>
<body>

<div class="container">
            <div class="card justify-content-center">
                <div class="card-header text-center"><img src="./../imagenes/AIDUALC.png" style="width: 130px; border-radius: 50%;" alt="logo"></div>
                <div class="card-body justify-content-center p-4">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="form-group row">
                            <label for="nombre" class="form-label col-12">Nombre:</label>
                            <div class="col-12">
                                <input type="text" name="nombre" id="nombre" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="pass" class="form-label col-12">Contraseña:</label>
                            <div class="col-12">
                            
                                <input type="password" name="pass" id="pass" class="form-control" required>
                                <i id = "mostrar" class="fa-regular fa-eye-slash"></i>
                                
                            </div>
                        </div>
                        <input type="submit" value="Enviar" class="btn btn-primary"  id="enviar">
                        <p class="cuenta">¿No tienes cuenta? <a href="registro.php" id="enlace">¡Regístrate!</a></p>
                    </form>
                    <a href="../inicio/index.php" class="fa-solid fa-chevron-left">Volver</a>
                </div>
            </div>
        </div>
    </div>


    <?php
    require_once("Usuario.php");
    require_once("Admin.php");

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $nombre = trim(htmlspecialchars($_POST["nombre"]));
        $pass = trim(htmlspecialchars($_POST["pass"]));

        if(empty($nombre)){
            $errors[] = "Debes introducir un nombre.<br>";
        }

        if(empty($pass)){
            $errors[] = "Debes introducir una contraseña válida.";
        }

        if(!empty($errors)){
            foreach($errors as $e){
                echo $e;
            }
        }else{
            $usuario = new Usuario(); 
        if(!$usuario->verificarCliente($nombre, $pass)) { 
            
            $admin = new Admin(); 
            if(!$admin->verificarAdmin($nombre, $pass)) { 
                echo "Usuario o contraseña incorrectos. Por favor, inténtelo de nuevo."; 
            } 
        }
    }
}
    ?>

</body>
</html>