@extends('layouts.app-master')
@section('content')
<div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">  
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="5000">      
      <img src="assets/img_banner/Crucero-min.png" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h1></h1>
          <p></p>
        </div>     
    </div>
  </div>  
</div> 
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
       <div class="barra-movil">
         <div class="titulo-barra-movil">
          <div class="d-flex">
            <div class="me-4"><img class="me-4" src="assets/img_logos_cruceros/Logo_msc.png" alt=""></div>
            <div class="me-4"><img class="me-4" src="assets/img_logos_cruceros/Logo_costa.png" alt=""></div>
            <div class="me-4"><img class="me-4" src="assets/img_logos_cruceros/Logo_royal.png" alt=""></div>
            <div class="me-4"><img class="me-4" src="assets/img_logos_cruceros/Logo_celebrity.png" alt=""></div>
            <div class="me-4"><img class="me-4" src="assets/img_logos_cruceros/Logo_azamara.png" alt=""></div>
        </div>         
       </div>
    </div>
  </div>
 </div>
</div>
<div class="container introduction-productos-content">
  <div class="row">
    <div class="col-12 introduction-productos">
        <h1>EXPLORA EL MUNDO CRUCEROS</h1>
        <p>Bienvenidos a bordo de una experiencia única que cambiará tu percepción de viajar. 
        En nuestro mundo de cruceros, cada travesía es una oportunidad para sumergirse en la magia de destinos cautivadores mientras disfrutas de lujo y comodidades incomparables. 
        ¿Estás listo para embarcarte en un viaje que no solo es un destino, sino una experiencia extraordinaria?
        </p>        
      </div>
  </div>
</div>
<div class="container my-3 m-auto productos-detalles home-iconos">
    <div class="titulo">
        <h2 class=""></h2>
    </div>
    <div class="row">
            @php
            $productosCruceros = $productos->filter(function ($producto) {
                return $producto->destino_gral === 'Cruceros';
            });
            $productosAleatorios = $productosCruceros->shuffle();
            @endphp
            @foreach ($productosAleatorios as $productoAleatorio)
            <div class="col-md-4 p-2">
                <div class="card productosCrucero">
                    <div class="" style="position: relative; overflow: hidden;">
                        <div style="padding-top: 100%;"></div> <!-- Este contenedor mantiene el aspect ratio -->
                        <img src="{{ asset('assets/img_cruceros/' . $productoAleatorio->imagen) }}" class="card-img-top img-fluid" alt="{{ $productoAleatorio->nombre }}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                        <div class="card-img-overlay titulo-prod-cruceros">
                            <h5 class="card-title"><i class="fa-solid fa-anchor"></i> {{ $productoAleatorio->naviera->nombre }}</h5>                            
                                <p class="precio-total"><i class="fa-solid fa-location-dot ms-1 me-2"></i> {{ $productoAleatorio->destino }}  </p>
                                <p class="precio-total"><i class="fa-regular fa-calendar-days ms-1 me-2"></i> {{ $productoAleatorio->entre_fechas }}  </p>
                                <p class="precio-total">Desde: {{ $productoAleatorio->moneda }}  {{ $productoAleatorio->precio }} </p>
                                <p class="precio-total">Estadia: {{ $productoAleatorio->estadia }} <i class="fa-solid fa-moon"></i>  </p>                            
                        </div>
                    </div>
                    <div class="w-100 btn-crucero">
                        <a href="{{ route('producto.detallesCrucero', $productoAleatorio->id) }}" class="btn btn-primary w-100">VER MAS</a>          
                    </div>
                </div>
            </div>
        @endforeach
    </div>   
</div> 
@endsection
