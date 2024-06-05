<?php
session_start();
require_once("../login/config.php");

if (!isset($_SESSION['id'])) {
    echo json_encode(array('success' => false, 'message' => 'Debes iniciar sesión para vaciar el carrito.'));
    exit;
}

$cliente_id = $_SESSION['id'];

try {
    $conn = new PDO(BBDD_DSN, BBDD_USER, BBDD_PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "DELETE FROM carrito WHERE cliente_id = :cliente_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':cliente_id', $cliente_id, PDO::PARAM_INT);
    $stmt->execute();

    echo json_encode(array('success' => true));

} catch (PDOException $e) {
    echo json_encode(array('success' => false, 'message' => 'Error al vaciar el carrito: ' . $e->getMessage()));
    exit;
}
?>
