<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
</head>
<body>
    
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="correo">Correo electrónico:</label>
        <input type="email" name="correo" id="correo" required>

        <label for="pass">Contraseña:</label>
        <input type="password" name="pass" id="pass" required>

        <input type="submit" value="Enviar">
        <a href="registro.php">¿No tienes cuenta? Regístrate aquí.</a>
    </form>
    
    <?php
    require_once("Usuario.php");
    require_once("Admin.php");

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $correo = trim(htmlspecialchars($_POST["correo"]));
        $pass = trim(htmlspecialchars($_POST["pass"]));

        if(empty($correo)){
            $errors[] = "Debes introducir un correo válido.";
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
        if(!$usuario->verificarCliente($correo, $pass)) { 
            
            $admin = new Admin(); 
            if(!$admin->verificarAdmin($correo, $pass)) { 
                echo "Usuario o contraseña incorrectos. Por favor, inténtelo de nuevo."; 
            } 
        }
    }
    }
    ?>

</body>
</html>