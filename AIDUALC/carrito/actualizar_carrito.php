<?php
session_start();
require_once("../login/config.php");

if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'message' => 'Debes iniciar sesión para actualizar el carrito.']);
    exit;
}

$cliente_id = $_SESSION['id'];
$data = json_decode(file_get_contents('php://input'), true);
$carrito_id = $data['id'];
$action = $data['action'];

try {
    $conn = new PDO(BBDD_DSN, BBDD_USER, BBDD_PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($action === 'increase') {
        $query = "UPDATE carrito SET cantidad = cantidad + 1 WHERE id = :carrito_id AND cliente_id = :cliente_id";
    } elseif ($action === 'decrease') {
        $query = "UPDATE carrito SET cantidad = cantidad - 1 WHERE id = :carrito_id AND cliente_id = :cliente_id AND cantidad > 1";
    } else {
        echo json_encode(['success' => false, 'message' => 'Acción inválida.']);
        exit;
    }

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':carrito_id', $carrito_id, PDO::PARAM_INT);
    $stmt->bindParam(':cliente_id', $cliente_id, PDO::PARAM_INT);
    $stmt->execute();

    echo json_encode(['success' => true, 'message' => 'Carrito actualizado correctamente.']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error de conexión: ' . $e->getMessage()]);
}
?>
