<?php
require_once("../login/config.php");
require_once("../header-footer/header.php");

try {
    $conn = new PDO(BBDD_DSN, BBDD_USER, BBDD_PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT p.*
            FROM productos p
            JOIN categorias c ON p.categoria_id = c.id
            JOIN estilos e ON p.id_estilo = e.id
            WHERE p.categoria_id = 3 AND p.id_estilo = 3";
            
    $stmt = $conn->query($sql);

    if ($stmt->rowCount() == 0) {
        echo "No se encontraron resultados.";
    } else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../estilos/style_estilos.css">
</head>
<body>
<script>
function addToCart(id, button) {
    button.disabled = true;
    button.innerHTML = 'Cargando...';

    fetch('../carrito/anadir_carrito.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id: id })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error en la respuesta del servidor');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            alert('Producto añadido al carrito');
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Ocurrió un error al procesar la solicitud');
    })
    .finally(() => {
        button.disabled = false;
        button.innerHTML = 'Añadir al carrito';
    });
}

function selectSize(size) {
    var sizes = document.querySelectorAll('.talla');
    sizes.forEach(function(el) {
        el.classList.remove('selected');
    });
    size.classList.add('selected');
}
</script>
<div class="row mt-5">
<div class="results-container ">
<?php
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="item">';
            echo '<img src="data:image/jpeg;base64,' . base64_encode($row['imagen']) . '" />';
            echo '<p> ' . htmlspecialchars($row['nombre']) . '</p>';
            echo '<p>' . htmlspecialchars($row['descripcion']) . '</p>';
            echo '<p> ' . htmlspecialchars($row['precio']) . '€</p>';
            echo '<p>Color: ' . htmlspecialchars($row['color']) . '</p>';
            echo '<p>Stock: ' . htmlspecialchars($row['stock']) . '</p>';
            echo '<div class="tallas-container">';
            echo '<span class="talla" onclick="selectSize(this)">S</span>';
            echo '<span class="talla" onclick="selectSize(this)">M</span>';
            echo '<span class="talla" onclick="selectSize(this)">L</span>';
            echo '<button onclick="addToCart(' . $row["id"] . ', this)">Añadir al carrito</button>';
            echo '</div>';
            echo '</div>';
        }
?>
</div>
</body>
</html>
<?php
    }
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}

$conn = null;
require_once("../header-footer/footer.html");
?>
