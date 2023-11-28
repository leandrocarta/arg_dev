<!doctype html>
<html lang="es">

<head>
  <title>ARGTRAVELS</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
  <!-- Bootstrap CSS v5.2.1 -->
  <link rel="stylesheet" href="{{url('assets/css/bootstrap.min.css')}}">
   @vite(['resources/scss/app.scss', 'resources/css/app.css', 'resources/js/app.js'])
</head>
<body> 
  <header>
    @include('layouts.navbar.navbar')  
  </header>
  <main class="container-fluid">
    @yield('content')
  </main>
  <footer>
    @include('layouts.footer.footer')
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://kit.fontawesome.com/1f121b7605.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
   $(document).ready(function(){
       $('#miModal').modal('show');
   });
  </script>
 <script>
  document.addEventListener('DOMContentLoaded', function() {
    var promoContainer = document.querySelector('.promo-container');

    // Agrega la clase 'removing' y ajusta la altura después de 2 segundos
    setTimeout(function() {
      promoContainer.classList.add('removing');
      promoContainer.style.maxHeight = '0'; /* Establece la altura a cero para cerrar el div */
    }, 6000);

    // Elimina el div después de 3 segundos (ajusta según sea necesario)
    setTimeout(function() {
      promoContainer.remove();
    }, 8000);
  });
</script>







</body>

</html>