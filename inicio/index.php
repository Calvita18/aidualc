<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aidualc</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.min.js"></script> 
    <link rel="stylesheet" href="../estilos/style_index.css"> 
</head>
<body>
    <header>
        <?php include_once ('../header-footer/header.php'); ?>
    </header>

    <div id="contenido-dinamico" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="carousel-caption d-none d-md-block">
                <div class="estilo">
                    <h1 class="move-up">R E T R O</h1>
                </div>             
            </div>
            <img src="../imagenes/estilo_retro_fondo.jpg" class="d-block w-100 img-fluid" alt="...">
        </div>
        <div class="carousel-item">
            <div class="carousel-caption d-none d-md-block">
                <div class="estilo">
                    <h1 class="move-up">C O Q U E T T E</h1>
                </div> 
            </div>
            <img src="../imagenes/romantico.jpg" class="d-block w-100 img-fluid" alt="...">
        </div>
        <div class="carousel-item">
            <div class="carousel-caption d-none d-md-block">
                 <div class="estilo">
                    <h1 class="move-up">P U N K</h1>
                </div> 
            </div>
            <img src="../imagenes/estilo_rockero2_fondo.jpg" class="d-block w-100 img-fluid" alt="...">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#contenido-dinamico" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#contenido-dinamico" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Siguiente</span>
    </button>

</div>


    <footer>
        <?php include_once('../header-footer/footer.html');?>
    </footer>

</body>

</html>
