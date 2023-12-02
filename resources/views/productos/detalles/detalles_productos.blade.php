@extends('layouts.app-master')
@section('content')
 <div class="carousel carousel-dark slide" data-bs-ride="carousel">  
  <div class="carousel-inner img-prod-banner">
    @if ($productos->hotel)
        <div class="carousel-item active filtro">
            <img src="{{ asset('assets/img_hoteles/' . $productos->hotel->img_banner) }}" class="d-block w-100" alt="...">
            <div class="titulo-detalles-prod">
              <h4><i class="fa-solid fa-location-dot me-2"></i>{{ $productos->pais_destino }} - {{ $productos->ciudad_destino }}</h4>
              <h1>{{ $productos->hotel->nombre }}</h1>             
            </div>
          </div>
    @else
        <p>No hay información disponible para este producto.</p>
    @endif
  </div>
</div>
  <div class="container-fluid my-3 m-auto productos-detalles">
    <div class="row px-2">
      <div class="col-md-5 bg-light border rounded">
        <h3>Datos del Producto</h3>
        <p><i class="fa-solid fa-hotel"></i> :
           {{ $productos->hotel->nombre }}
        </p>
        <p class=""> @if ($productos->service->comidas == 'All Inclusive')
                <i class="fa-solid fa-bell-concierge"></i> : {{ $productos->service->comidas }}
                @elseif ($productos->service->comidas == 'Desayuno')
                <i class="fa-solid fa-mug-saucer"></i> : {{ $productos->service->comidas }}
                @elseif ($productos->service->comidas == 'Media Pensión')
                <i class="fa-solid fa-utensils"></i> : {{ $productos->service->comidas }} 
              @endif   
        </p> 
        <p class=""><i class="fa-solid fa-bed"></i> : Habitación  
           {{ $productos->habitacion }}   
        </p> 
        <p class=""><i class="fa-solid fa-cloud-moon"></i> : 
            {{ $productos->estadia }}  Noches</span>        
           </span>           
        </p> 
        @if ($productos->hotel->gym == 'Área de Gimnasio' || $productos->hotel->spa == 'Área de Spa')
        <h3>Otros Servicios</h3>
        <p> @if ($productos->hotel->gym == 'Área de Gimnasio')
            <i class="fa-solid fa-dumbbell"></i> : {{ $productos->hotel->gym }}
            @endif
        </p>
        <p>
            @if ($productos->hotel->spa == 'Área de Spa')
            <i class="fa-solid fa-hot-tub-person"></i> : {{ $productos->hotel->spa }}                 
            @endif   
        </p> 
        @endif
      </div>
      <div class="col-md-7">
        <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
          <div class="carousel-indicators">
             @foreach ($productos->hotel->getImagenes() as $key => $imagen)
              <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="{{ $key }}" class="{{ $key === 0 ? 'active' : '' }}" aria-current="true" aria-label="Slide {{ $key + 1 }}"></button>
             @endforeach
          </div>
          <div class="carousel-inner img-prod-banner rounded">
             @foreach ($productos->hotel->getImagenes() as $key => $imagen)
              <div class="carousel-item {{ $key === 0 ? 'active' : '' }}" data-bs-interval="3000">
                {{-- Acceder a los campos del hotel --}}
                <img src="{{ asset('assets/img_hoteles/' . $imagen) }}" class="d-block w-100" alt="Imagen Hotel">                
              </div>
             @endforeach
          </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
              </button>
        </div>
      </div>
    </div>         
  </div> 
@endsection

        
       
        