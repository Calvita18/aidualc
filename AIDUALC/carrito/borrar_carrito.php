<?php
session_start();
require_once("../login/config.php");

if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'message' => 'Debes iniciar sesión para eliminar productos del carrito.']);
    exit;
}

$cliente_id = $_SESSION['id'];
$data = json_decode(file_get_contents('php://input'), true);
$carrito_id = $data['id'];

try {
    $conn = new PDO(BBDD_DSN, BBDD_USER, BBDD_PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "DELETE FROM carrito WHERE id = :carrito_id AND cliente_id = :cliente_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':carrito_id', $carrito_id, PDO::PARAM_INT);
    $stmt->bindParam(':cliente_id', $cliente_id, PDO::PARAM_INT);
    $stmt->execute();

    echo json_encode(['success' => true, 'message' => 'Producto eliminado del carrito.']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error de conexión: ' . $e->getMessage()]);
}
?>
