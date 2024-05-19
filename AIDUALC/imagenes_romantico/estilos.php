<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $estilo = isset($_POST['tipo']) ? htmlspecialchars($_POST['tipo']) : null;

    $resultados = [];

    if ($estilo === 'camisetaRomantico') {
        $resultados = [
            ['src' => '../imagenes_estilos/top_rosa.png', 'nombre' => 'Camiseta Rosa', 'precio' => '9.99€', 'talla' => 'S/M/L', 'color' => 'Rosa', 'descripcion' => 'Camiseta rosa con escote de corazón'],
            ['src' => '../imagenes_estilos/top_rosa2.png', 'nombre' => 'Camiseta Rosa con Lazo', 'precio' => '24.99€', 'talla' => 'S/M/L', 'color' => 'Rosa', 'descripcion' => 'Camiseta rosa con lazo']
        ];
    } elseif ($estilo === 'pantalonesRomantico') {
        $resultados = [
            ['src' => '../imagenes/pantalones_romantico1.png'],
            ['src' => '../imagenes/pantalones_romantico2.png']
        ];
    } elseif ($estilo === 'accesoriosRomantico') {
        $resultados = [
            ['src' => '../imagenes/accesorios_romantico1.png'],
            ['src' => '../imagenes/accesorios_romantico2.png']
        ];
    } elseif ($estilo === 'camisetaRetro') {
        $resultados = [
            ['src' => '../imagenes/camiseta_retro1.png'],
            ['src' => '../imagenes/camiseta_retro2.png']
        ];
    } elseif ($estilo === 'pantalonesRetro') {
        $resultados = [
            ['src' => '../imagenes/pantalones_retro1.png'],
            ['src' => '../imagenes/pantalones_retro2.png']
        ];
    } elseif ($estilo === 'accesoriosRetro') {
        $resultados = [
            ['src' => '../imagenes/accesorios_retro1.png'],
            ['src' => '../imagenes/accesorios_retro2.png']
        ];
    } elseif ($estilo === 'camisetaRockero') {
        $resultados = [
            ['src' => '../imagenes/camiseta_rockero1.png'],
            ['src' => '../imagenes/camiseta_rockero2.png']
        ];
    } elseif ($estilo === 'pantalonesRockero') {
        $resultados = [
            ['src' => '../imagenes/pantalones_rockero1.png'],
            ['src' => '../imagenes/pantalones_rockero2.png']
        ];
    } elseif ($estilo === 'accesoriosRockero') {
        $resultados = [
            ['src' => '../imagenes/accesorios_rockero1.png'],
            ['src' => '../imagenes/accesorios_rockero2.png']
        ];
    }

    echo json_encode(['resultados' => $resultados]);
}
