<?php
session_start();
require_once("../login/config.php");

if (!isset($_SESSION['id']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../login/login.php");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categoria = $_POST['categoria'];
    $estilo = $_POST['estilo'];
    $nombre = trim($_POST['nombre']);
    $descripcion = trim($_POST['descripcion']);
    $precio = $_POST['precio'];
    $color = trim($_POST['color']);
    $stock = $_POST['stock'];

    if (strlen($nombre) < 4) {
        $errors[] = 'El nombre debe tener al menos 4 caracteres.';
    }

    if (strlen($descripcion) < 4) {
        $errors[] = 'La descripción debe tener al menos 4 caracteres.';
    }

    if (strlen($color) < 4) {
        $errors[] = 'El color debe tener al menos 4 caracteres.';
    }

    if (!is_numeric($precio) || $precio <= 0) {
        $errors[] = 'El precio debe ser un número positivo.';
    }

    if (!is_numeric($stock) || $stock < 0) {
        $errors[] = 'El stock no puede ser un número negativo.';
    }

    if (empty($errors)) {
        echo "Producto añadido con éxito.";
    } else {
        foreach ($errors as $error) {
            echo $errors;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración</title>
    <link rel="stylesheet" href="../estilos/style_admin.css"> 
</head>

<body class="body-admin">
<?php 
    require_once("../header-footer/header.php");
?>
<h1>Panel de Administración</h1>

<h2>Añadir Nuevo Producto</h2>
<form action="anadir_producto.php" method="post" enctype="multipart/form-data">
    <label for="categoria">Categoría:</label>
    <select id="categoria" name="categoria" required>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
    </select><br>

    <label for="estilo">Estilo:</label>
    <select id="estilo" name="estilo" required>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
    </select><br>

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" pattern="[A-Za-z]+" required><br>

    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="descripcion" pattern="[A-Za-z]+" title="Solo letras" required></textarea><br>

    <label for="precio">Precio:</label>
    <input type="text" id="precio" name="precio" required><br>

    <label for="color">Color:</label>
    <input type="text" id="color" name="color" pattern="[A-Za-z]+"  required><br>

    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" name="imagen" required><br>

    <label for="stock">Stock:</label>
    <input type="number" id="stock" name="stock" min="0" pattern="[0-9]+" title="Solo números" required><br>

    <button type="submit">Añadir Producto</button>
</form>
<?php 
    require_once("../header-footer/footer.html");

   
?>


</body>
</html>
