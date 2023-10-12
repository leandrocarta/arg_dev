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
  <script src="{{url('assets/js/bootstrap.bundle.min.js')}}"></script>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://kit.fontawesome.com/1f121b7605.js" crossorigin="anonymous"></script>
</body>

</html>