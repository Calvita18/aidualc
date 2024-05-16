<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aidualc</title>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <!-- <script src="https://kit.fontawesome.com/bd054b17a6.js" crossorigin="anonymous"></script> iconos -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.min.js"></script> 
    <link rel="stylesheet" href="../estilos/style_index.css"> 
</head>

<body>
    <header>
        <?php include_once ('../header-footer/header.php'); ?>
    </header>

    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="carousel-caption d-none d-md-block">
                <div class="estilo">
                    <h1 class="move-up">Estilo retro</h1>
                </div>             
                <h5 class="slogan">Deslumbra con el estilo del milenio en cada paso que des.</h5>
                <button class="btn-comprar"><a href ="#">Comprar</a></button>
            </div>
            <img src="../imagenes/estilo_romantico_fondo.jpg" class="d-block w-100 img-fluid" alt="...">
        </div>
        <div class="carousel-item">
            <div class="carousel-caption d-none d-md-block">
                <div class="estilo">
                    <h1 class="move-up">Estilo Romántico</h1>
                </div> 
                <h5 class="slogan">Deslumbra con el estilo del milenio en cada paso que des.</h5>
                <button class="btn-comprar"><a href ="#">Comprar</a></button>
            </div>
            <img src="../imagenes/estilo_retro_fondo.jpg" class="d-block w-100 img-fluid" alt="...">
        </div>
        <div class="carousel-item">
            <div class="carousel-caption d-none d-md-block">
                 <div class="estilo">
                    <h1 class="move-up">Estilo Rockero</h1>
                </div> 
                <h5 class="slogan">Deslumbra con el estilo del milenio en cada paso que des.</h5>
                <button class="btn-comprar"><a href ="#">Comprar</a></button>
            </div>
            <img src="../imagenes/estilo_rockero2_fondo.jpg" class="d-block w-100 img-fluid" alt="...">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleSlidesOnly" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleSlidesOnly" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Siguiente</span>
    </button>
</div>


    <footer>
        <?php include_once('../header-footer/footer.html');?>
    </footer>

</body>

</html>
