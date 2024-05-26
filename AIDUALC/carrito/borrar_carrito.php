<?php
session_start();
require_once("../login/config.php");

header('Content-Type: application/json');

if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'message' => 'Tienes que iniciar sesión']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'];

try {
    $conn = new PDO(BBDD_DSN, BBDD_USER, BBDD_PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "DELETE FROM carrito WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $response = ['success' => $stmt->rowCount() > 0];
    echo json_encode($response);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error de conexión: ' . $e->getMessage()]);
}
?>
