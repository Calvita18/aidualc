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

$total = 0; // Inicializar la variable $total
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
</head>
<body>
    <h1>Carrito de Compras</h1>
    <table>
        <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Total</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($carrito as $item): ?>
            <tr>
                <td><?php echo htmlspecialchars($item['nombre']); ?></td>
                <td><?php echo number_format($item['precio'], 2); ?>€</td>
                <td><?php echo htmlspecialchars($item['cantidad']); ?></td>
                <td><?php echo number_format($item['precio'] * $item['cantidad'], 2); ?>€</td>
                <td>
                    <button onclick="updateCartItem(<?php echo $item['carrito_id']; ?>, 'increase')">+</button>
                    <button onclick="updateCartItem(<?php echo $item['carrito_id']; ?>, 'decrease')">-</button>
                    <button onclick="deleteCartItem(<?php echo $item['carrito_id']; ?>)">Eliminar</button>
                </td>
            </tr>
            <?php $total += $item['precio'] * $item['cantidad']; ?>
        <?php endforeach; ?>
    </table>
    <h2>Total: <?php echo number_format($total, 2); ?>€</h2>
    <button onclick="finalizarCompra()">Finalizar Compra</button>

    <script>
        function updateCartItem(id, action) {
            fetch('../carrito/actualizar_carrito.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id: id, action: action })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Carrito actualizado');
                    location.reload(); // Recargar la página para mostrar los cambios
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        }

        function deleteCartItem(id) {
            fetch('../carrito/borrar_carrito.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id: id })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Producto eliminado del carrito');
                    location.reload(); // Recargar la página para mostrar los cambios
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        }

        function finalizarCompra() {
            fetch('checkout.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ action: 'finalizar_compra' })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Compra finalizada con éxito.');
                    window.location.href = 'metodo_pago.php?pedido_id=' + data.pedido_id;
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    </script>
</body>
</html>
