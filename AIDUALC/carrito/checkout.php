<?php
session_start();
require_once("../login/config.php");

if (!isset($_SESSION['id'])) {
    echo "Debes iniciar sesión para finalizar la compra.";
    exit;
}

$cliente_id = $_SESSION['id'];

try {
    $conn = new PDO(BBDD_DSN, BBDD_USER, BBDD_PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
        echo "El carrito está vacío.";
        exit;
    }

    // Calcular el total del pedido
    $total = 0;
    foreach ($carrito as $item) {
        $total += $item['precio'] * $item['cantidad'];
    }
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <script src="https://www.paypal.com/sdk/js?client-id=AbxlCyKkthvLSNTahiNEtiTSHxsMlm8e2EIt91MsBLdwhS9kgPDLJw4wSYfRwsnTXJ0-rUQvSVWsx7_Q&currency=EUR"></script>
</head>
<body>
    <h1>Checkout</h1>
    <p>Total: €<?= number_format($total, 2) ?></p>
    <div id="paypal-button-container"></div>

    <script>
        paypal.Buttons({
            style: {
                color: 'blue',
                shape: 'pill',
                label: 'pay'
            },
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '<?= number_format($total, 2, '.', '') ?>'
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    fetch('complete_purchase.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ orderID: data.orderID })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Compra completada con éxito');
                            window.location.href = 'completado.html';
                        } else {
                            alert('Error al completar la compra: ' + data.message);
                        }
                    });
                });
            },
            onCancel: function(data) {
                alert("Pago cancelado");
            }
        }).render('#paypal-button-container');
    </script>
</body>
</html>
