@extends('layouts.app-master')
@section('content')
<div class="container-fluid p-0">
<div class="banner_movil">
 <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>      
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="5000">      
      <img src="assets/img_banner/Agente_iberostar-min.png" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h1></h1>
          <p></p>
        </div>     
    </div>    
    <div class="carousel-item" data-bs-interval="3000">
      <img src="assets/img_banner/Destino-min.png" class="d-block w-100" alt="">      
    </div>     
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
  <div class="container my-3 m-auto productos-detalles home-iconos">
     <div class="titulo text-center">
       <h4 class="display-4"></h4>
     </div>
     <div class="row">                     
       @php
       $productosAleatorios = $productos->shuffle()->take(6);
       @endphp
       @foreach ($productos as $producto)       
      <div class="col-md-4 p-2">
        <div class="card productosCrucero">
            <div class="" style="position: relative; overflow: hidden;">
                <div class="card-img-container" style="padding-top: 100%;">
                    @if ($producto->tipo_producto == 'The Club')
                    <div class="barra-horizontal-comunidad">
                       <p class="leyenda">THE CLUB - Cupos Limitados!!!</p>
                    </div>
                    @endif 
                    <img src="{{ asset('assets/img_paquetes/' . $producto->imagen) }}" class="card-img-top img-fluid" alt="{{ $producto->nombre }}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                    <div class="card-img-overlay titulo-prod-cruceros">
                    <p>REF: N° {{ $producto->id }} - <i class="fa-regular fa-calendar-days"></i> {{ $producto->fecha_salida }}</p>
                    <h5><i class="fa-solid fa-location-dot me-1"></i> {{ $producto->destinos->ciudad_destino }}</h5> 
                    <p>{{ $producto->pais->nombre }}</p>                                    
                    <h3 class="precio_home"><span class="usd">{{ $producto->moneda }} </span> {{ $producto->precio_total }}</h3>  
                  </div>
                </div>
            </div>
            <div class="w-100 btn-crucero">
                <a href="{{ route('producto.detalles', $producto->id) }}" class="btn btn-primary w-100">VER ITINERARIO</a>
            </div>
        </div>
      </div>
       @endforeach
    </div>   
  </div>
  <!-- Seccion Disney USA -->
  <section class="">
  <div class="container-fluid" id="disney">  
    <div class="row">
      <div class="col-md-12">
        <h3 class="quince-title">Quinceañeras</h3>
      </div>  
    </div>  
    <div class="row">
    <!-- Imagen Disney USA -->
    <div class="col-md-6 p-0">
         <a href="{{ route('disney.usa') }}" class="zoom-effect">
        <div class="card position-relative">
            <img src="assets/img_disney/img-disney-usa.jpg" class="img-fluid" alt="Disney USA">
            <div class="card-body text-center boton-disney-usa position-absolute">
                <img src="assets/img_disney/boton-disney-usa.png" class="img-fluid" alt="Disney USA">
            </div>
        </div>
    </a>
    </div>
    <div class="col-md-6 p-0">
        <a href="{{ route('eurodisney') }}" class="zoom-effect">
            <div class="card position-relative">
                <img src="assets/img_disney/img-disney-eur.jpg" class="img-fluid" alt="Disney Europa">
                <div class="card-body text-center boton-disney-usa position-absolute">
                    <img src="assets/img_disney/boton-disney-europa.png" class="img-fluid" alt="Disney Europa">
                </div>
            </div>
        </a>
    </div>
</div>
  </div>
  </section>
  <div class="container-fluid my-3 m-auto container-servicios bg-gris">
    <div class="row" id="vuelos">
      <hr>     
      <h1 class="text-center">Descubrí el Placer de Viajar</h1>      
      <div class="col-md-3 container-servicio">
        <h3>Vuelos</h3>
        <div class="overlay">          
          <a href="/aereos">Cotizar Vuelos!!</a>
        </div>
        <img class="img-fluid" src="assets/img/Vuelos.png" alt="">
      </div>
      <div class="col-md-3 container-servicio">
         <h3>Paquetes Turísticos</h3>   
         <a href="paquetes#paquetes">     
         <img class="img-fluid" src="assets/img/Paquetes.png" alt="">
         </a>
      </div>
      <div class="col-md-3 container-servicio">
         <h3>Salidas Grupales</h3>       
         <a href="grupales#grupales"> 
        <img class="img-fluid" src="assets/img/Grupales.png" alt="">
        </a>
      </div>
      <div class="col-md-3 container-servicio">
         <h3>Viajes a Medida</h3>        
         <a href="a-medida"> 
        <img class="img-fluid" src="assets/img/TuViaje.png" alt="">
        </a>
      </div>
    </div>
  </div>
  <div class="container my-3 m-auto productos-detalles home-iconos">
     <div class="titulo text-center">
       <h4 class="display-4"></h4>
     </div>
     <div class="row">                     
       @php
       $productosAleatorios = $productos->shuffle()->take(6);
       @endphp
       @foreach ($productos as $producto)       
      <div class="col-md-4 p-2">
        <div class="card productosCrucero">
            <div class="" style="position: relative; overflow: hidden;">
                <div class="card-img-container" style="padding-top: 100%;">
                    @if ($producto->tipo_producto == 'The Club')
                    <div class="barra-horizontal-comunidad">
                      <p class="leyenda">THE CLUB - Cupos Limitados!!!</p>
                    </div>
                    @endif 
                    <img src="{{ asset('assets/img_paquetes/' . $producto->imagen) }}" class="card-img-top img-fluid" alt="{{ $producto->nombre }}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                    <div class="card-img-overlay titulo-prod-cruceros">
                    <p>REF: N° {{ $producto->id }} - <i class="fa-regular fa-calendar-days"></i> {{ $producto->fecha_salida }}</p>
                    <h5><i class="fa-solid fa-location-dot me-1"></i> {{ $producto->destinos->ciudad_destino }}</h5> 
                    <p>{{ $producto->pais->nombre }}</p>                                    
                     <h3 class="precio_home"><span class="usd">{{ $producto->moneda }} </span> {{ $producto->precio_total }}</h3>
                    </div>
                </div>
            </div>
            <div class="w-100 btn-crucero">
                <a href="{{ route('producto.detalles', $producto->id) }}" class="btn btn-primary w-100">VER ITINERARIO</a>
            </div>
        </div>
      </div>
       @endforeach
    </div>   
  </div>
</div> 
@if($mostrarModal)
<div class="modal fade comercioAdherido" id="miModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="padding-bottom: 0">
        <h5 class="modal-title"><i>Precios y Ofertas exclusivas para la comunidad de Viajeros</i></h5> 
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <a href="http://127.0.0.1:8000/register_client">
            <img src="assets/img/comunidad-min.png" alt="Probanos!!!" class="img-fluid">
        </a>
      </div>       
    </div>
  </div>
</div>
@endif 
<!-- Modal respuesta cotizacion aereos -->
@if(session('success'))
<div class="modal fade" id="modalExito" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title"><i class="fa fa-check-circle"></i>
        Recibimos tu consulta, en breve te responderemos, Muchas Gracias!!
        </h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"></span>
        </button>
      </div>
        <div class="modal-body">        
            <img src="assets/img/Vuelos-min.png" alt="Vuelos!!!" class="img-fluid">        
      </div>
    </div>
  </div>
</div>
@endif 
@endsection

        
       
        