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

   public function verificarAdmin($correo, $pass){
        $query = "SELECT email, contrasena FROM administradores WHERE email = :correo AND contrasena = md5(:pass)";

        $stmt = $this->conn->prepare($query);

        $stmt->execute([':correo' => $correo, ':pass' => $pass]);

        if($stmt->rowCount() > 0){
            session_start();
            $_SESSION["correo"] = $correo;
            header("Location: inicio_admin.php"); 
            
        } else {
            return false;
        }
        $stmt = null;
   

   }
    
}

?>