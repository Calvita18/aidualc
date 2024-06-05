<?php
require_once("config.php");

class Admin{
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

   public function verificarAdmin($nombre, $pass){
    $query = "SELECT id, nombre, contrasena, rol FROM clientes WHERE nombre = :nombre AND contrasena = md5(:pass)";

    $stmt = $this->conn->prepare($query);
    $parametros = [':nombre' => $nombre, ':pass' => $pass];
    $stmt->execute($parametros);

    if ($stmt->rowCount() > 0) {
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        session_start();
        $_SESSION["id"] = $usuario['id'];
        $_SESSION["usuario"] = $usuario['nombre'];
        $_SESSION["rol"] = $usuario['rol'];  
        header("Location: ../inicio/index.php");
            
        } else {
            return false;
        }
        $stmt = null;
   

   }
    
}

?>