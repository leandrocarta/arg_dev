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
            <div class="border mt-5">
               {!! $qrCode !!}             
            </div>
        </div>
    </div>    
    <script src="{{url('assets/js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>
