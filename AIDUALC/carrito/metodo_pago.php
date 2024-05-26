<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Incluye el script de PayPal SDK -->
    <script src="https://www.paypal.com/sdk/js?client-id=AbxlCyKkthvLSNTahiNEtiTSHxsMlm8e2EIt91MsBLdwhS9kgPDLJw4wSYfRwsnTXJ0-rUQvSVWsx7_Q&currency=EUR"></script>
</head>
<body>
    <!-- Contenedor donde se renderizará el botón de PayPal -->
    <div id="paypal-button-container"></div>

    <script>
        // Renderiza el botón de PayPal en el contenedor especificado
        paypal.Buttons({
            style:{
                // color: 'blue',
                shape: 'pill',
                label: 'pay'
            },
            createOrder: function(data, actions){
                return actions.order.create({
                    purchase_units:[{
                        amount:{
                            value: 70//aquí iría el total
                        }
                    }]
                });
            },

            onApprove: function(data, actions){
                actions.order.capture().then(function(detalles){
                    window.location.href="completado.html";
                });
            },

            onCancel: function(data){
                alert("Pago cancelado");
                console.log(data);
            }
        }).render('#paypal-button-container');
    </script>
</body>
</html>
