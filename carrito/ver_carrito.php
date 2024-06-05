<?php
session_start();
require_once("../login/config.php");

if (!isset($_SESSION['id'])) {
    echo "Debes iniciar sesión para ver el carrito.";
    exit;
}

$cliente_id = $_SESSION['id'];

try {
    $conn = new PDO(BBDD_DSN, BBDD_USER, BBDD_PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "SELECT c.id AS carrito_id, p.nombre, p.precio, c.cantidad
              FROM carrito c
              JOIN productos p ON c.producto_id = p.id
              WHERE c.cliente_id = :cliente_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':cliente_id', $cliente_id, PDO::PARAM_INT);
    $stmt->execute();
    $carrito = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit;
}

$total = 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos/carrito.css">
    <script src="../js_deverdad/carrito.js"></script>
    <script src="../js_deverdad/estilos.js"></script>
    <title>Carrito de Compras</title>
</head>
<body>

    <div class="container">
        <h1>Carrito de Compra</h1>
        <table>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
                <th></th>
            </tr>
            <?php foreach ($carrito as $item): ?>
                <tr>
                    <td data-label="Producto"><?php echo htmlspecialchars($item['nombre']); ?></td>
                    <td data-label="Precio"><?php echo number_format($item['precio'], 2); ?>€</td>
                    <td data-label="Cantidad"><?php echo htmlspecialchars($item['cantidad']); ?></td>
                    <td data-label="Total"><?php echo number_format($item['precio'] * $item['cantidad'], 2); ?>€</td>
                    <td>
                        <button onclick="actualizarCarrito(<?php echo $item['carrito_id']; ?>, 'increase')">+</button>
                        <button onclick="actualizarCarrito(<?php echo $item['carrito_id']; ?>, 'decrease')">-</button>
                        <button onclick="if(confirmar()) { borrarCarrito(<?php echo $item['carrito_id']; ?>); }">Eliminar</button>

                    </td>
                </tr>
                <?php $total += $item['precio'] * $item['cantidad']; ?>
            <?php endforeach; ?>
        </table>
        <h2 class="total">Total: <?php echo number_format($total, 2); ?>€</h2>
        <button class="boton" onclick="finalizarCompra()">Finalizar Compra</button>
        <button class="boton" onclick="seguirComprando()">Seguir Comprando</button>
        <button class="boton" onclick="eliminarTodo()">Vaciar Carrito</button>

        <script>
             var cliente_id = <?php echo json_encode($cliente_id); ?>;
        </script>

    </div>
</body>
</html>
