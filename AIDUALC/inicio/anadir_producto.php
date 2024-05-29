<?php
session_start();
require_once("../login/config.php");

// Verifica que el usuario sea administrador
if (!isset($_SESSION['id']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../inicio/index.php");
    exit();
}

$nombre = $_POST['nombre'];
$categoria_id = $_POST['categoria'];
$id_estilo = $_POST['estilo'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$color = $_POST['color'];
$stock = $_POST['stock'];

// Verifica que se haya subido una imagen
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    // Obtener información de la imagen
    $imagen = file_get_contents($_FILES['imagen']['tmp_name']);

    try {
        $conn = new PDO(BBDD_DSN, BBDD_USER, BBDD_PASS);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Insertar el producto en la base de datos
        $sql = "INSERT INTO productos (categoria_id, id_estilo, nombre, descripcion, precio, color, imagen, stock) 
                VALUES (:categoria_id, :id_estilo, :nombre, :descripcion, :precio, :color, :imagen, :stock)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':categoria_id', $categoria_id, PDO::PARAM_INT);
        $stmt->bindParam(':id_estilo', $id_estilo, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
        $stmt->bindParam(':precio', $precio, PDO::PARAM_STR);
        $stmt->bindParam(':color', $color, PDO::PARAM_STR);
        $stmt->bindParam(':imagen', $imagen, PDO::PARAM_LOB);
        $stmt->bindParam(':stock', $stock, PDO::PARAM_INT);

        $stmt->execute();

        echo "Producto añadido exitosamente.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null; // Cerrar conexión
} else {
    echo "Error al subir la imagen.";
}
?>
