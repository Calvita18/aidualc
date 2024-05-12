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
        $query = "SELECT nombre, contrasena FROM administradores WHERE nombre = :nombre AND contrasena = md5(:pass)";

        $stmt = $this->conn->prepare($query);

        $stmt->execute([':nombre' => $nombre, ':pass' => $pass]);

        if($stmt->rowCount() > 0){
            session_start();
            $_SESSION["nombre"] = $nombre;
            header("Location: ../inicio/index_admin.html"); 
            
        } else {
            return false;
        }
        $stmt = null;
   

   }
    
}

?>