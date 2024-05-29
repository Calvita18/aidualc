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
    <title>Carrito de Compras</title>
</head>
<body>
    <div class="container">
        <h1>Carrito de Compras</h1>
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
                        <button onclick="updateCartItem(<?php echo $item['carrito_id']; ?>, 'increase')">+</button>
                        <button onclick="updateCartItem(<?php echo $item['carrito_id']; ?>, 'decrease')">-</button>
                        <button onclick="deleteCartItem(<?php echo $item['carrito_id']; ?>)">Eliminar</button>
                    </td>
                </tr>
                <?php $total += $item['precio'] * $item['cantidad']; ?>
            <?php endforeach; ?>
        </table>
        <h2 class="total">Total: <?php echo number_format($total, 2); ?>€</h2>
        <button class="boton" onclick="finalizarCompra()">Finalizar Compra</button>
        <button class="boton" onclick="seguirComprando()">Seguir Comprando</button>

        <script>
            function updateCartItem(id, action) {
                fetch('actualizar_carrito.php', {
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
                fetch('borrar_carrito.php', {
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
                window.location.href = 'checkout.php';
            }

            function seguirComprando() {
                window.location.href = '../inicio/index.php'; 
            }
        </script>
    </div>
</body>
</html>
