<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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

        // Verificar existencia del producto
        $query = "SELECT COUNT(*) FROM productos WHERE nombre = :nombre";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            echo "No se pudo insertar porque ya existe: $nombre.";
            echo "<a href='administrador.php'>Volver</a>";
            exit;
        }

        // Verificar existencia de categoría y estilo
        $checkCategoria = $conn->prepare("SELECT id FROM categorias WHERE id = :categoria_id");
        $checkCategoria->bindParam(':categoria_id', $categoria_id, PDO::PARAM_INT);
        $checkCategoria->execute();
        
        $checkEstilo = $conn->prepare("SELECT id FROM estilos WHERE id = :id_estilo");
        $checkEstilo->bindParam(':id_estilo', $id_estilo, PDO::PARAM_INT);
        $checkEstilo->execute();
        
        if ($checkCategoria->rowCount() === 0) {
            throw new Exception("La categoría seleccionada no existe.");
        }
        
        if ($checkEstilo->rowCount() === 0) {
            throw new Exception("El estilo seleccionado no existe.");
        }

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
        echo "<script>alert('Producto añadido con éxito');</script>";
        header("Location: index.php");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null; // Cerrar conexión
} else {
    echo "Error al subir la imagen.";
}
?>
</body>
</html>