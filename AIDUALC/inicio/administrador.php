<?php
session_start();
require_once("../login/config.php");

if (!isset($_SESSION['id']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../login/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración</title>
</head>
<body>
    <h1>Panel de Administración</h1>

    <h2>Añadir Nuevo Producto</h2>
    <form action="anadir_producto.php" method="post" enctype="multipart/form-data">
        <label for="categoria">Categoría:</label>
        <input type="text" id="categoria" name="categoria" required><br>

        <label for="estilo">Estilo:</label>
        <input type="text" id="estilo" name="estilo" required><br>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br>

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required></textarea><br>

        <label for="precio">Precio:</label>
        <input type="text" id="precio" name="precio" required><br>

        <label for="color">Color:</label>
        <input type="text" id="color" name="color" required><br>

        <label for="imagen">Imagen:</label>
        <input type="file" id="imagen" name="imagen" required><br>

        <label for="stock">Stock:</label>
        <input type="number" id="stock" name="stock" required><br>

        <button type="submit">Añadir Producto</button>
    </form>
</body>
</html>
