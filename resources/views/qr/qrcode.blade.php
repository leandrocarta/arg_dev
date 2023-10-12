<!DOCTYPE html>
<html>
<head>
    <title>Código QR</title>
    <link rel="stylesheet" href="{{url('assets/css/bootstrap.min.css')}}">
@vite(['resources/scss/app.scss', 'resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container text-center">
        <div class="row">
            <div class="col pt-5">
            <!--  <h1 style="color: #E9B003">NOMBRE COMERCIO</h1> -->
               {!! $qrCode !!}
             <!--   <h2 style="color: #E9B003">MOSTRA TUS PRODUCTOS</h2> -->
            </div>
        </div>
    </div>    
    <script src="{{url('assets/js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>
