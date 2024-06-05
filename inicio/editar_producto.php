<?php
session_start();
require_once("../login/config.php");

if (!isset($_SESSION['id']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../login/login.php");
    exit;
}

if (isset($_POST['submit'])) {
    try {
        $conn = new PDO(BBDD_DSN, BBDD_USER, BBDD_PASS);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE productos SET
                    categoria_id = :categoria_id,
                    id_estilo = :id_estilo,
                    nombre = :nombre,
                    descripcion = :descripcion,
                    precio = :precio,
                    color = :color,
                    imagen = :imagen,
                    stock = :stock
                WHERE id = :id";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':categoria_id', $_POST['categoria']);
        $stmt->bindParam(':id_estilo', $_POST['estilo']);
        $stmt->bindParam(':nombre', $_POST['nombre']);
        $stmt->bindParam(':descripcion', $_POST['descripcion']);
        $stmt->bindParam(':precio', $_POST['precio']);
        $stmt->bindParam(':color', $_POST['color']);
        $stmt->bindParam(':stock', $_POST['stock']);
        $stmt->bindParam(':id', $_POST['id']);

        if (isset($_FILES['imagen']) && $_FILES['imagen']['size'] > 0) {
            $imagen = file_get_contents($_FILES['imagen']['tmp_name']);
            $stmt->bindParam(':imagen', $imagen, PDO::PARAM_LOB);
        } else {
            $sql = "SELECT imagen FROM productos WHERE id = :id";
            $stmtImagen = $conn->prepare($sql);
            $stmtImagen->bindParam(':id', $_POST['id']);
            $stmtImagen->execute();
            $row = $stmtImagen->fetch(PDO::FETCH_ASSOC);
            $imagen = $row['imagen'];
            $stmt->bindParam(':imagen', $imagen, PDO::PARAM_LOB);
        }

        $stmt->execute();
        header("Location: index.php");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    if (isset($_GET['id'])) {
        try {
            $conn = new PDO(BBDD_DSN, BBDD_USER, BBDD_PASS);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM productos WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $_GET['id']);
            $stmt->execute();
            $producto = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$producto) {
                echo "Producto no encontrado";
                exit;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            exit;
        }
    } else {
        echo "ID de producto no proporcionado";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.min.js"></script> 
    <link rel="stylesheet" href="../estilos/style_editar.css"> 
</head>
<body>

<?php 
    require_once("../header-footer/header.php");
    ?>
    <main class="body-editar">
    <h1 class="editar-h1">Editar Producto</h1>
    <form action="editar_producto.php" method="post" enctype="multipart/form-data" class="formulario-editar-producto">
        <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">

        <label for="categoria">Categoría:</label>
        <input type="text" id="categoria" name="categoria" value="<?php echo htmlspecialchars($producto['categoria_id']); ?>" required><br>

        <label for="estilo">Estilo:</label>
        <input type="text" id="estilo" name="estilo" value="<?php echo htmlspecialchars($producto['id_estilo']); ?>" required><br>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($producto['nombre']); ?>" required><br>

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required><?php echo htmlspecialchars($producto['descripcion']); ?></textarea><br>

        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" value="<?php echo htmlspecialchars($producto['precio']); ?>" required><br>

        <label for="color">Color:</label>
        <input type="text" id="color" name="color" value="<?php echo htmlspecialchars($producto['color']); ?>" required><br>

        <label for="imagen">Imagen:</label>
        <input type="file" id="imagen" name="imagen"><br>
        <?php if ($producto['imagen']): ?>
            <img src="data:image/jpeg;base64,<?php echo base64_encode($producto['imagen']); ?>" alt="Imagen del producto" style="width: 100px; height: 100px;"><br>
        <?php endif; ?>

        <label for="stock">Stock:</label>
        <input type="number" id="stock" name="stock" value="<?php echo htmlspecialchars($producto['stock']); ?>" required><br>

        <button type="submit" name="submit" value="guardar">Guardar Cambios</button>
        <button type="button" onclick="window.location.href='index.php';">Volver</button>
    </form>

    </main>
    <?php 
    require_once("../header-footer/footer.html");
    ?>

</body>
</html>
