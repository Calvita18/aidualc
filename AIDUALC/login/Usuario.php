<?php
require_once("config.php");


class Usuario{
    protected $conn;

    public function __construct(){
        try{
            $this->conn = new PDO(BBDD_DSN, BBDD_USER, BBDD_PASS);

        }catch(PDOException $e){
            die("ERROR " .$e->getMessage());
        }
    }

    public function __destruct(){
        $this->conn = null;
    }

    public function verificarCliente($nombre, $pass){
        $query_cliente = "SELECT nombre, contrasena FROM clientes WHERE nombre = :nombre AND contrasena = md5(:pass)";
    
        $stmt_cliente = $this->conn->prepare($query_cliente);
    
        $parametros = [':nombre' =>$nombre, ':pass'=>$pass];
    
        $stmt_cliente->execute($parametros);
    
        if($stmt_cliente->rowCount() > 0){
            $usuario = $stmt_cliente->fetch(PDO::FETCH_ASSOC);
            session_start();
            $_SESSION["nombre"] = $usuario['nombre']; 
            header("Location: ../inicio/index.php");  
           
        }else{
            return false;
        }
        $stmt_cliente = null;
    }
    
    public function registrarCliente($nombre, $apellido, $email, $contra, $fecha, $dir, $telf){
        // Verificar si el correo ya existe en la base de datos
        $query_email = "SELECT COUNT(*) FROM clientes WHERE email = :email";
        $stmt_email = $this->conn->prepare($query_email); // Preparamos la consulta
        $parametros_email = [':email' => $email];
        $stmt_email->execute($parametros_email); 
        $num_filas = $stmt_email->fetchColumn(); // Obtenemos el número de filas
    
        //si el número de filas es mayor que 0, significa que el correo ya está registrado
        if ($num_filas > 0) {
            echo "El correo electrónico ya está registrado.";
        } else {
            $query = "INSERT INTO clientes (nombre, apellido, email, contrasena, fechaNac, direccion, telefono) VALUES (:nombre, :apellido, :email, md5(:contra), :fecha, :dir, :telf)";
            $stmt = $this->conn->prepare($query); // Preparamos la consulta de inserción
            $parametros = [
                ':nombre' => $nombre, 
                ':apellido' => $apellido,
                ':email' => $email,
                ':contra' => $contra,
                ':fecha' => $fecha,
                ':dir' => $dir,
                ':telf' => $telf
            ];
            $stmt->execute($parametros); // Ejecutamos la consulta de inserción con los parámetros
    
            // Si se inserta correctamente en la base de datos
            if ($stmt->rowCount() > 0) {
                echo "Se ha registrado correctamente."; // Mostramos un mensaje de éxito
                session_start();
                $_SESSION["email"] = $email; 
                $_SESSION["nombre"] = $nombre; // Guardar el nombre en la sesión
                header("Location: ..inicio//index.php"); // Redireccionamos al usuario a la página de inicio
                // exit();
            } else {
                echo "Se ha producido un error al registrar el usuario."; // Mostramos un mensaje de error
            }
    
            $stmt=null; // Liberamos los recursos de la consulta
        }
    
        $stmt_email  = null; // Liberamos los recursos de la consulta de verificación
    }
    
    
    }
?>