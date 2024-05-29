<?php
session_start();
require_once("../login/config.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aidualc</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.min.js"></script>
    <!-- <script src="../js_deverdad/estilos.js"></script> -->
    <link rel="stylesheet" href="../estilos/style_hif.css">
    <script src="https://kit.fontawesome.com/bd054b17a6.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../estilos/style_estilos.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <nav class="navbar navbar-principal navbar-expand-md navbar-light">
            <div class="container-fluid w-100">
              <a class="navbar-brand" href="#">
                <img src="../imagenes/AIDUALC_sinfondo.png" id="logo" alt="Logo">
              </a>
              <button class="navbar-toggler" type="button" id="navbar-toggler-icon">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="estiloRomanticoDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Coquette
                        </a>
                        <div class="dropdown-menu" aria-labelledby="estiloRomanticoDropdown">
                                <a class="dropdown-item" href="../paginas/coquette_camisetas.php">Camisetas</a>
                                <a class="dropdown-item" href="../paginas/coquette_pantalones.php">Pantalones</a>
                                <a class="dropdown-item" href="../paginas/coquette_accesorios.php">Accesorios</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="estiloRetroDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             Retro
                        </a>
                        <div class="dropdown-menu" aria-labelledby="estiloRetroDropdown">
                                <a class="dropdown-item" href="../paginas/retro_camisetas.php">Camisetas</a>
                                <a class="dropdown-item" href="../paginas/retro_pantalones.php">Pantalones</a>
                                <a class="dropdown-item" href="../paginas/retro_accesorios.php">Accesorios</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../inicio/index.php">AIDUALC</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="estiloRockeroDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Punk
                        </a>
                        <div class="dropdown-menu" aria-labelledby="estiloRockeroDropdown">
                                <a class="dropdown-item" href="../paginas/punk_camisetas.php">Camisetas</a>
                                <a class="dropdown-item" href="../paginas/punk_pantalones.php">Pantalones</a>
                                <a class="dropdown-item" href="../paginas/punk_accesorios.php">Accesorios</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../paginas/servicio.php">Servicio al cliente</a>
                    </li>

                    <li>
                    <?php if(isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
                          <li class="nav-item">
                            <a class="nav-link" href="administrador.php">Administración</a>
                          </li>
                    <?php endif; ?>
                    </li>

                  <li class="iconos-header">
                    <ul class="navbar-nav">
                      <?php if(isset($_SESSION['nombre'])): ?>
                        <li class="iconos-header">
                          <span class="navbar-text ">¡Bienvenido/a, <?php echo $_SESSION['nombre']; ?>!</span>
                        </li>
                        <li class="iconos-header">
                          <a href="../inicio/logout.php"><i class="fa-solid fa-share"></i></a>
                        </li>
                      <?php else: ?>
                        <li class="iconos-header2">
                        <a href="../login/login.php"><i class="fas fa-user"></i></a>
                        <?php endif; ?>
                        <a href="../carrito/ver_carrito.php"><i class="fas fa-shopping-basket"></i></a>
                        </li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
</header>
    <script>
        $(document).ready(function(){
          $('#navbar-toggler-icon').click(function(){
            $('#collapsibleNavbar').collapse('toggle');
          });
        });
    </script>
</body>
</html>
