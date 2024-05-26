<?php
session_start();
require_once("../login/config.php");

if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'message' => 'Debes iniciar sesión para realizar la compra.']);
    exit;
}

$cliente_id = $_SESSION['id'];

try {
    $conn = new PDO(BBDD_DSN, BBDD_USER, BBDD_PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Iniciar la transacción
    $conn->beginTransaction();

    // Obtener los productos del carrito
    $query = "SELECT c.producto_id, p.precio, c.cantidad
              FROM carrito c
              JOIN productos p ON c.producto_id = p.id
              WHERE c.cliente_id = :cliente_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':cliente_id', $cliente_id, PDO::PARAM_INT);
    $stmt->execute();
    $carrito = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($carrito)) {
        echo json_encode(['success' => false, 'message' => 'El carrito está vacío.']);
        exit;
    }

    // Calcular el total del pedido
    $total = 0;
    foreach ($carrito as $item) {
        $total += $item['precio'] * $item['cantidad'];
    }

    // Insertar el pedido
    $query = "INSERT INTO pedidos (cliente_id, fecha, productos, total, estado) VALUES (:cliente_id, NOW(), :productos, :total, 'Pendiente')";
    $stmt = $conn->prepare($query);
    $productos_json = json_encode($carrito); // Convertir los productos a formato JSON
    $stmt->bindParam(':cliente_id', $cliente_id, PDO::PARAM_INT);
    $stmt->bindParam(':productos', $productos_json, PDO::PARAM_STR);
    $stmt->bindParam(':total', $total, PDO::PARAM_STR);
    $stmt->execute();
    $pedido_id = $conn->lastInsertId();

    // Insertar los detalles del pedido
    $query = "INSERT INTO detalles_pedido (pedido_id, producto_id, cantidad, precio) VALUES (:pedido_id, :producto_id, :cantidad, :precio)";
    $stmt = $conn->prepare($query);
    foreach ($carrito as $item) {
        $stmt->bindParam(':pedido_id', $pedido_id, PDO::PARAM_INT);
        $stmt->bindParam(':producto_id', $item['producto_id'], PDO::PARAM_INT);
        $stmt->bindParam(':cantidad', $item['cantidad'], PDO::PARAM_INT);
        $stmt->bindParam(':precio', $item['precio'], PDO::PARAM_STR);
        $stmt->execute();
    }

    // Vaciar el carrito
    $query = "DELETE FROM carrito WHERE cliente_id = :cliente_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':cliente_id', $cliente_id, PDO::PARAM_INT);
    $stmt->execute();

    // Confirmar la transacción
    $conn->commit();

    // Redirigir a la página de método de pago con el ID del pedido
    echo json_encode(['success' => true, 'message' => 'Compra finalizada con éxito.', 'pedido_id' => $pedido_id]);
} catch (PDOException $e) {
    // Revertir la transacción si hay un error
    $conn->rollBack();
    echo json_encode(['success' => false, 'message' => 'Error en el proceso de compra: ' . $e->getMessage()]);
    exit;
}
?>
