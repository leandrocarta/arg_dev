<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto Proveedores</title><link rel="stylesheet" href="{{url('assets/css/bootstrap.min.css')}}">
@vite(['resources/scss/app.scss', 'resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="welcome_suppliers">
    <div class="logo-container">
        <img src="{{ asset('assets/img/logo_footer.png') }}" alt="Logo">
        <div class="welcome-text">¡Bienvenidos!</div>
    </div>
    <div class="container-welcome w-100 p-2" id="container-welcome">
        <div class="image-container">
            <h3>ARGTRAVELS</h3>
           <div class="circular-image">            
               <img src="{{ asset('assets/img/leo-min.png') }}" alt="Imagen Circular">
           </div>
           <h4>AGENCIA DE VIAJES</h4>
        </div>  
        <div class="content-datos">
           <p><i class="fa-solid fa-user me-1"></i> Leandro Ivan Carta</p>
           <p><a href="https://api.whatsapp.com/send?phone=543413672066" target="_blank" class="text-reset text-decoration-none"><i class="fab fa-whatsapp me-1"></i> +54 3413 672 066</a></p>
           <p><a href="contacto" class="text-reset text-decoration-none"><i class="fa-regular fa-envelope me-1"></i> contacto@argtravels.tur.ar</a></p>
           <p><a href="https://www.argtravels.tur.ar" target="_blank" class="text-reset text-decoration-none"><i class="fa-solid fa-globe me-1"></i> www.argtravels.tur.ar</a></p>
           <p><i class="fa-solid fa-passport me-1"></i> Legajo: PV-2023-69402366-APN-DRAV#MTYD</p>
        </div>
    </div>
 <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Esperar 4 segundos antes de mostrar la tabla
            setTimeout(function () {
                var tablaContainer = document.getElementById("container-welcome");
                var logo = document.querySelector(".logo-container");
                var welcomeText = document.querySelector(".welcome-text");
                 var circularImage = document.querySelector(".circular-image");

                circularImage.style.opacity = "1"; // Mostrar la imagen

                // Mostrar la tabla y ocultar el logo y el mensaje de bienvenida
                tablaContainer.style.display = "block";
                logo.style.display = "none";
                welcomeText.style.display = "none";
            }, 4000);
        });
    </script>
    <script src="{{url('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="https://kit.fontawesome.com/1f121b7605.js" crossorigin="anonymous"></script>
</body>
</html>