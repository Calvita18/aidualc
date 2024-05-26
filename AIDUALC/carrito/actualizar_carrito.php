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
$action = $data['action'];

try {
    $conn = new PDO(BBDD_DSN, BBDD_USER, BBDD_PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($action === 'increase') {
        $query = "UPDATE carrito SET cantidad = cantidad + 1 WHERE id = :id";
    } elseif ($action === 'decrease') {
        // Check current quantity
        $checkQuery = "SELECT cantidad FROM carrito WHERE id = :id";
        $checkStmt = $conn->prepare($checkQuery);
        $checkStmt->bindParam(':id', $id, PDO::PARAM_INT);
        $checkStmt->execute();
        $row = $checkStmt->fetch(PDO::FETCH_ASSOC);

        if ($row['cantidad'] > 1) {
            $query = "UPDATE carrito SET cantidad = cantidad - 1 WHERE id = :id";
        } else {
            $query = "DELETE FROM carrito WHERE id = :id";
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Acción no válida']);
        exit;
    }

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $response = ['success' => true];
    } else {
        $response = ['success' => false, 'message' => 'No se pudo actualizar la cantidad'];
    }

    echo json_encode($response);

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error de conexión: ' . $e->getMessage()]);
}
?>
