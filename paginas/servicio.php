<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos/style_servicio.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js_deverdad/servicio.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/bd054b17a6.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../estilos/style_estilos.css">

 
    <title>Servicio al cliente</title>
</head>
<body>
    <?php require_once("../header-footer/header.php")?>
    <main class="d-flex align-items-center justify-content-center min-vh-80" name="formulario_servicio">
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

                <section class="col-md-6 col-lg-5 mx-auto ">
                    <form class="form_contact" action ="<?=htmlspecialchars($_SERVER["PHP_SELF"])?>" name="formulario_servicio">
                        <h2 class="text-center">Envíanos un mensaje</h2>
                        <div class="form-group">
                            <label for="nombre">Nombre *:</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Obligatorio">
                        </div>
                        <p class="noVisible" id="mnombre">Campo obligatorio</p>

                        <div class="form-group">
                            <label for="telf">Teléfono:</label>
                            <input type="text" class="form-control" name="telf" id="telf">
                        </div>
                        <p class="noVisible" id="mtelefono">Campo obligatorio</p>

                        <div class="form-group">
                            <label for="email">Correo electrónico *:</label>
                            <input type="email" class="form-control" id="email" placeholder="Obligatorio">
                        </div>
                        <p class="noVisible" id="memail">Campo obligatorio</p>

                        <div class="form-group">
                            <label for="mensaje">Mensaje *:</label>
                            <textarea class="form-control" id="mensaje" placeholder="Obligatorio"></textarea>
                        </div>
                        <p class="noVisible" id="mmensaje">Campo obligatorio</p>

                        <button type="button" class="btn btn-enviar btn-block mt-3" id="enviarMensaje">Enviar Mensaje</button>
                    </form>
                </section>
            </section>
        </section>
    </main>
    </div>
    <div class="toast-container">
        <div class="toast bg-success" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
            <div class="toast-header">
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body ">
                Mensaje enviado con éxito.
                <p class="letra_pequena">Le responderemos de 1-3 días hábiles.</p>
            </div>
        </div>
    </div>

    <?php require_once("../header-footer/footer.html")?>


</body>
</html>
