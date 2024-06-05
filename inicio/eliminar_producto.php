<?php
session_start();
require_once("../login/config.php");

if (!isset($_SESSION['id']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../login/login.php");
    exit;
}

if (isset($_GET['id'])) {
    try {
        $conn = new PDO(BBDD_DSN, BBDD_USER, BBDD_PASS);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "DELETE FROM productos WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $_GET['id']);
        $stmt->execute();

        header("Location: index.php");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "ID de producto no proporcionado";
    exit;
}
?>
