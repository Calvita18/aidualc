<?php
session_start();
require_once("../login/config.php");

header('Content-Type: application/json');

if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'message' => 'Debes iniciar sesión']);
    exit;
}

try {
    $conn = new PDO(BBDD_DSN, BBDD_USER, BBDD_PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $data = json_decode(file_get_contents('php://input'), true);
    $producto_id = $data['id'];
    $cliente_id = $_SESSION['id'];

    // Verificar el stock
    $query = "SELECT stock FROM productos WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $producto_id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $stock = $row['stock'];

    if ($stock > 0) {
        // Iniciar una transacción
        $conn->beginTransaction();
        try {
            // Añadir al carrito
            $query = "INSERT INTO carrito (cliente_id, producto_id, cantidad) VALUES (:cliente_id, :producto_id, 1)
                      ON DUPLICATE KEY UPDATE cantidad = cantidad + 1";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':cliente_id', $cliente_id, PDO::PARAM_INT);
            $stmt->bindParam(':producto_id', $producto_id, PDO::PARAM_INT);
            $stmt->execute();

            // Commit de la transacción
            $conn->commit();

            $response = ['success' => true];
        } catch (Exception $e) {
            // Rollback en caso de error
            $conn->rollBack();
            $response = ['success' => false, 'message' => 'Error al añadir el producto al carrito'];
        }
    } else {
        $response = ['success' => false, 'message' => 'No hay suficiente stock'];
    }
} catch (PDOException $e) {
    $response = ['success' => false, 'message' => 'Error de conexión: ' . $e->getMessage()];
}

echo json_encode($response);
?>
