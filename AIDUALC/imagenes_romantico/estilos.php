<?php
// header('Content-Type: application/json');

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $estilo = isset($_POST['tipo']) ? htmlspecialchars($_POST['tipo']) : null;

//     $resultados = [];

//     if ($estilo === 'camisetaRomantico') {
//                 $resultados = [
//                     ['src' => '../imagenes_estilos/coquette/top_rosa.png', 'nombre' => 'Camiseta Rosa', 'precio' => '9.99€', 'talla' => 'S/M/L', 'color' => 'Rosa', 'descripcion' => 'Camiseta rosa con escote de corazón'],
//                     ['src' => '../imagenes_estilos/coquette/top_rosa2.png', 'nombre' => 'Camiseta Rosa con Lazo', 'precio' => '24.99€', 'talla' => 'S/M/L', 'color' => 'Rosa', 'descripcion' => 'Camiseta rosa con lazo'],
//                     ['src' => '../imagenes_estilos/coquette/top_rosa3.png', 'nombre' => 'Camiseta Rosa con Lazo', 'precio' => '24.99€', 'talla' => 'S/M/L', 'color' => 'Rosa', 'descripcion' => 'Camiseta rosa con lazo'],
//                     ['src' => '../imagenes_estilos/coquette/top_rosa4.png', 'nombre' => 'Camiseta Rosa con Lazo', 'precio' => '24.99€', 'talla' => 'S/M/L', 'color' => 'Rosa', 'descripcion' => 'Camiseta rosa con lazo'],
//                     ['src' => '../imagenes_estilos/coquette/top_rosa5.png', 'nombre' => 'Camiseta Rosa con Lazo', 'precio' => '24.99€', 'talla' => 'S/M/L', 'color' => 'Rosa', 'descripcion' => 'Camiseta rosa con lazo'],
//                     ['src' => '../imagenes_estilos/coquette/top_rosa6.png', 'nombre' => 'Camiseta Rosa con Lazo', 'precio' => '24.99€', 'talla' => 'S/M/L', 'color' => 'Rosa', 'descripcion' => 'Camiseta rosa con lazo'],
//                     ['src' => '../imagenes_estilos/coquette/top_verde.png', 'nombre' => 'Camiseta Rosa con Lazo', 'precio' => '24.99€', 'talla' => 'S/M/L', 'color' => 'Rosa', 'descripcion' => 'Camiseta rosa con lazo'],
//                     ['src' => '../imagenes_estilos/coquette/ver_flores.png', 'nombre' => 'Camiseta Rosa con Lazo', 'precio' => '24.99€', 'talla' => 'S/M/L', 'color' => 'Rosa', 'descripcion' => 'Camiseta rosa con lazo'],
//                     ['src' => '../imagenes_estilos/coquette/top_rosa_brillante.png', 'nombre' => 'Camiseta Rosa con Lazo', 'precio' => '24.99€', 'talla' => 'S/M/L', 'color' => 'Rosa', 'descripcion' => 'Camiseta rosa con lazo'],
        
//                 ];
//                 $sql = "SELECT src, nombre, precio, talla, descripcion FROM productos";
//             } elseif ($estilo === 'pantalonesRomantico') {
//                 $resultados = [
//                     ['src' => '../imagenes_estilos/coquette/pant_cinto.png', 'nombre' => 'Camiseta Rosa', 'precio' => '9.99€', 'talla' => 'S/M/L', 'color' => 'Rosa', 'descripcion' => 'Camiseta rosa con escote de corazón'],
//                     ['src' => '../imagenes_estilos/coquette/pant_clasico.png', 'nombre' => 'Camiseta Rosa con Lazo', 'precio' => '24.99€', 'talla' => 'S/M/L', 'color' => 'Rosa', 'descripcion' => 'Camiseta rosa con lazo'],
//                     ['src' => '../imagenes_estilos/coquette/pant_estrella.png', 'nombre' => 'Camiseta Rosa con Lazo', 'precio' => '24.99€', 'talla' => 'S/M/L', 'color' => 'Rosa', 'descripcion' => 'Camiseta rosa con lazo'],
//                     ['src' => '../imagenes_estilos/coquette/pant_mariposa.png', 'nombre' => 'Camiseta Rosa con Lazo', 'precio' => '24.99€', 'talla' => 'S/M/L', 'color' => 'Rosa', 'descripcion' => 'Camiseta rosa con lazo'],
//                     ['src' => '../imagenes_estilos/coquette/pant_brillante.png', 'nombre' => 'Camiseta Rosa con Lazo', 'precio' => '24.99€', 'talla' => 'S/M/L', 'color' => 'Rosa', 'descripcion' => 'Camiseta rosa con lazo'],
//                     ['src' => '../imagenes_estilos/coquette/pant_morado.png', 'nombre' => 'Camiseta Rosa con Lazo', 'precio' => '24.99€', 'talla' => 'S/M/L', 'color' => 'Rosa', 'descripcion' => 'Camiseta rosa con lazo'],
//                     ['src' => '../imagenes_estilos/coquette/pant_oscuro.png', 'nombre' => 'Camiseta Rosa con Lazo', 'precio' => '24.99€', 'talla' => 'S/M/L', 'color' => 'Rosa', 'descripcion' => 'Camiseta rosa con lazo'],
//                     ['src' => '../imagenes_estilos/coquette/pant_rallado.png', 'nombre' => 'Camiseta Rosa con Lazo', 'precio' => '24.99€', 'talla' => 'S/M/L', 'color' => 'Rosa', 'descripcion' => 'Camiseta rosa con lazo'],
//                     ['src' => '../imagenes_estilos/coquette/pant_rosa.png', 'nombre' => 'Camiseta Rosa con Lazo', 'precio' => '24.99€', 'talla' => 'S/M/L', 'color' => 'Rosa', 'descripcion' => 'Camiseta rosa con lazo'],
//                 ];
//             } elseif ($estilo === 'accesoriosRomantico') {
//                 $resultados = [
//                     ['src' => '../imagenes_estilos/coquette/bolso_diesel.png', 'nombre' => 'Camiseta Rosa', 'precio' => '9.99€', 'talla' => 'S/M/L', 'color' => 'Rosa', 'descripcion' => 'Camiseta rosa con escote de corazón'],
//                     ['src' => '../imagenes_estilos/coquette/bolso_rosa.png', 'nombre' => 'Camiseta Rosa con Lazo', 'precio' => '24.99€', 'talla' => 'S/M/L', 'color' => 'Rosa', 'descripcion' => 'Camiseta rosa con lazo'],
//                     ['src' => '../imagenes_estilos/coquette/bolso_rosa2.png', 'nombre' => 'Camiseta Rosa con Lazo', 'precio' => '24.99€', 'talla' => 'S/M/L', 'color' => 'Rosa', 'descripcion' => 'Camiseta rosa con lazo'],
//                     ['src' => '../imagenes_estilos/coquette/cinton.png', 'nombre' => 'Camiseta Rosa con Lazo', 'precio' => '24.99€', 'talla' => 'S/M/L', 'color' => 'Rosa', 'descripcion' => 'Camiseta rosa con lazo'],
//                     ['src' => '../imagenes_estilos/coquette/cintob.png', 'nombre' => 'Camiseta Rosa con Lazo', 'precio' => '24.99€', 'talla' => 'S/M/L', 'color' => 'Rosa', 'descripcion' => 'Camiseta rosa con lazo'],
//                     ['src' => '../imagenes_estilos/coquette/gafasn.png', 'nombre' => 'Camiseta Rosa con Lazo', 'precio' => '24.99€', 'talla' => 'S/M/L', 'color' => 'Rosa', 'descripcion' => 'Camiseta rosa con lazo'],
//                     ['src' => '../imagenes_estilos/coquette/gafasr.png', 'nombre' => 'Camiseta Rosa con Lazo', 'precio' => '24.99€', 'talla' => 'S/M/L', 'color' => 'Rosa', 'descripcion' => 'Camiseta rosa con lazo'],
//                     ['src' => '../imagenes_estilos/coquette/gorran.png', 'nombre' => 'Camiseta Rosa con Lazo', 'precio' => '24.99€', 'talla' => 'S/M/L', 'color' => 'Rosa', 'descripcion' => 'Camiseta rosa con lazo'],
//                     ['src' => '../imagenes_estilos/coquette/gorrav.png', 'nombre' => 'Camiseta Rosa con Lazo', 'precio' => '24.99€', 'talla' => 'S/M/L', 'color' => 'Rosa', 'descripcion' => 'Camiseta rosa con lazo'],
//                 ];
//             } elseif ($estilo === 'camisetaRetro') {
//                 $resultados = [
//                     ['src' => '../imagenes_estilos/pantalon_rosa.jpg', 'nombre' => 'Camiseta Rosa', 'precio' => '9.99€', 'talla' => 'S/M/L', 'color' => 'Rosa', 'descripcion' => 'Camiseta rosa con escote de corazón'],
//                     ['src' => '../imagenes_estilos/top_rosa2.png', 'nombre' => 'Camiseta Rosa con Lazo', 'precio' => '24.99€', 'talla' => 'S/M/L', 'color' => 'Rosa', 'descripcion' => 'Camiseta rosa con lazo'],
//                     ['src' => '../imagenes_estilos/top_rosa3.png', 'nombre' => 'Camiseta Rosa con Lazo', 'precio' => '24.99€', 'talla' => 'S/M/L', 'color' => 'Rosa', 'descripcion' => 'Camiseta rosa con lazo'],
//                     ['src' => '../imagenes_estilos/top_rosa4.png', 'nombre' => 'Camiseta Rosa con Lazo', 'precio' => '24.99€', 'talla' => 'S/M/L', 'color' => 'Rosa', 'descripcion' => 'Camiseta rosa con lazo'],
//                     ['src' => '../imagenes_estilos/top_rosa5.png', 'nombre' => 'Camiseta Rosa con Lazo', 'precio' => '24.99€', 'talla' => 'S/M/L', 'color' => 'Rosa', 'descripcion' => 'Camiseta rosa con lazo'],
//                     ['src' => '../imagenes_estilos/top_rosa6.png', 'nombre' => 'Camiseta Rosa con Lazo', 'precio' => '24.99€', 'talla' => 'S/M/L', 'color' => 'Rosa', 'descripcion' => 'Camiseta rosa con lazo'],
//                     ['src' => '../imagenes_estilos/top_verde.png', 'nombre' => 'Camiseta Rosa con Lazo', 'precio' => '24.99€', 'talla' => 'S/M/L', 'color' => 'Rosa', 'descripcion' => 'Camiseta rosa con lazo'],
//                     ['src' => '../imagenes_estilos/ver_flores.png', 'nombre' => 'Camiseta Rosa con Lazo', 'precio' => '24.99€', 'talla' => 'S/M/L', 'color' => 'Rosa', 'descripcion' => 'Camiseta rosa con lazo'],
//                     ['src' => '../imagenes_estilos/top_rosa_brillante.png', 'nombre' => 'Camiseta Rosa con Lazo', 'precio' => '24.99€', 'talla' => 'S/M/L', 'color' => 'Rosa', 'descripcion' => 'Camiseta rosa con lazo'],
//              ];
            // } elseif ($estilo === 'pantalonesRetro') {
            //     $resultados = [
            //         ['src' => '../imagenes/pantalones_retro1.png'],
    //                 ['src' => '../imagenes/pantalones_retro2.png']
    //             ];
    //         } elseif ($estilo === 'accesoriosRetro') {
    //             $resultados = [
    //                 ['src' => '../imagenes/accesorios_retro1.png'],
    //                 ['src' => '../imagenes/accesorios_retro2.png']
    //             ];
    //         } elseif ($estilo === 'camisetaRockero') {
    //             $resultados = [
    //                 ['src' => '../imagenes/camiseta_rockero1.png'],
    //                 ['src' => '../imagenes/camiseta_rockero2.png']
    //             ];
    //         } elseif ($estilo === 'pantalonesRockero') {
    //             $resultados = [
    //                 ['src' => '../imagenes/pantalones_rockero1.png'],
    //                 ['src' => '../imagenes/pantalones_rockero2.png']
    //             ];
    //         } elseif ($estilo === 'accesoriosRockero') {
    //             $resultados = [
    //                 ['src' => '../imagenes/accesorios_rockero1.png'],
    //                 ['src' => '../imagenes/accesorios_rockero2.png']
    //             ];
    //         }
    //     } 
         
        

    // echo json_encode(['resultados' => $resultados]);
