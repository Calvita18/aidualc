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
            WHERE p.categoria_id = 1 AND p.id_estilo = 2";
            
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
  <script src="../js_deverdad/estilos.js"></script>
</head>
<body>
<div class="row mt-5">
    <div class="results-container">
        <?php
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="item">';
            echo '<img src="data:image/jpeg;base64,' . base64_encode($row['imagen']) . '" />';
            echo '<p class="nombre-producto">' . htmlspecialchars($row['nombre']) . '</p>';
            echo '<p>' . htmlspecialchars($row['descripcion']) . '</p>';
            echo '<p> ' . htmlspecialchars($row['precio']) . '€</p>';
            echo '<p>Stock: ' . htmlspecialchars($row['stock']) . '</p>';
            echo '<div class="tallas-container">';
            echo '<span class="talla" onclick="seleccionarTalla(this)">S</span>';
            echo '<span class="talla" onclick="seleccionarTalla(this)">M</span>';
            echo '<span class="talla" onclick="seleccionarTalla(this)">L</span>';
            echo '</div>';
            echo '<button class="anadir_carrito" onclick="agregarAlCarrito(' . $row["id"] . ', this)">Añadir al carrito</button>';
            if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin') {
                echo '<a href="../inicio/editar_producto.php?id=' . $row["id"] . '" class="btn btn-warning">Editar</a>';
                echo '<a href="../inicio/eliminar_producto.php?id=' . $row["id"] . '" class="btn btn-danger" onClick="return confirmar()">Eliminar</a>';
            }
            echo '</div>';
        }
        ?>
    </div>
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
