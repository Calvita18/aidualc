<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./../css/bootstrap.min.css">
    <link rel="stylesheet" href="./../estilos/style_servicio.css">
    <script src="https://kit.fontawesome.com/bd054b17a6.js" crossorigin="anonymous"></script>
    <title>Servicio al cliente</title>
</head>
<body>
    <?php require_once("../header-footer/header.html")?>

    <main class="d-flex align-items-center justify-content-center min-vh-80">
        <section class="container">
            <section class="row form_wrap">
                <section class="col-md-6 col-lg-5 mx-auto cantact_info">
                    <section class="info_title">
                        <h2 class="text-center">PONTE EN CONTACTO<br>CON NOSOTROS</h2>
                    </section>
                    <section class="info_items">
                        <p><span class="fa fa-envelope"></span> aidualc@gmail.com</p>
                        <p><span class="fa fa-mobile"></span> 625 14 89 00</p>
                    </section>
                </section>

                <section class="col-md-6 col-lg-5 mx-auto">
                    <form action="" class="form_contact">
                        <h2 class="text-center">Envíanos un mensaje</h2>
                        <div class="form-group">
                            <label for="nombre">Nombre *:</label>
                            <input type="text" class="form-control" name ="nombre" id="nombre" placeholder="Obligatorio">
                        </div>
                        <div class="form-group">
                            <label for="telf">Teléfono:</label>
                            <input type="text" class="form-control" name="telf" id="telf">
                        </div>
                        <div class="form-group">
                            <label for="email">Correo electrónico *:</label>
                            <input type="email" class="form-control" id="email" placeholder="Obligatorio">
                        </div>
                        <div class="form-group">
                            <label for="mensaje">Mensaje *:</label>
                            <textarea class="form-control" id="mensaje" placeholder="Obligatorio"></textarea>
                        </div>
                        <button type="submit" class="btn btn-enviar btn-block mt-3">Enviar Mensaje</button>
                    </form>
                </section>
            </section>
        </section>
    </main>

    <?php require_once("../header-footer/footer.html")?>

</body>
</html>
