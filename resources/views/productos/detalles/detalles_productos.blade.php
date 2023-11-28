@extends('layouts.app-master')
@section('content')
 <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
  
  <div class="carousel-inner img-prod-banner">
    @if ($productos->hotel)
        <div class="carousel-item active filtro">
            {{-- Acceder a los campos del hotel --}}
            <img src="{{ asset('assets/img_hoteles/' . $productos->hotel->img_banner) }}" class="d-block w-100" alt="...">
            <div class="titulo-detalles-prod">
              <p><i class="fa-solid fa-location-dot me-2"></i>{{ $productos->pais_destino }} - {{ $productos->ciudad_destino }} - {{ $productos->estadia }} <i class="fa-solid fa-cloud-moon"></i></p>
              <h1>{{ $productos->hotel->nombre }}</h1>
            </div>
        </div>
    @else
        <p>No hay información disponible para este producto.</p>
    @endif
  </div>
</div>
  <div class="container my-5 m-auto productos-detalles">
    <div class="row">
      <div class="col-md-5">
        <h3>Detalles del Viaje</h3>
      </div>
      <div class="col-md-7"></div>
    </div>
     
       
  </div> 
@endsection

        
       
        