<?php
require_once("../login/config.php");
require_once("../header-footer/header.php");

try {
    $conn = new PDO(BBDD_DSN, BBDD_USER, BBDD_PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta según el estilo seleccionado
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
<html>
<head>
<link rel="stylesheet" href="../estilos/style_estilos.css">
</head>
<body>
    <div class="results-container">
<?php
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="item">';
            echo '<img src="data:image/jpeg;base64,' . base64_encode($row['imagen']) . '" />';
            echo '<p>Nombre: ' . htmlspecialchars($row['nombre']) . '</p>';
            echo '<p>Descripción: ' . htmlspecialchars($row['descripcion']) . '</p>';
            echo '<p>Precio: ' . htmlspecialchars($row['precio']) . '€</p>';
            echo '<p>Color: ' . htmlspecialchars($row['color']) . '</p>';
            echo '<div class="tallas-container">';
            echo '<span class="talla">S</span>';
            echo '<span class="talla">M</span>';
            echo '<span class="talla">L</span>';
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
