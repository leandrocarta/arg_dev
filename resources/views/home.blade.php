@extends('layouts.app-master')
@section('content')
 <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="3" aria-label="Slide 4"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="5000">      
      <img src="assets/img_banner/Cancun-min.png" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h1></h1>
          <p></p>
        </div>
      <div class="carousel-caption d-none d-md-block">
        <h5></h5>
        <p></p>
      </div>
    </div>
    <div class="carousel-item" data-bs-interval="3000">
      <img src="assets/img_banner/Africa-min.png" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5></h5>
        <p></p>
      </div>
    </div>
    <div class="carousel-item" data-bs-interval="3000">
      <img src="assets/img_banner/egipto-min.png" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5></h5>
        <p></p>
      </div>
    </div>
    <div class="carousel-item" data-bs-interval="3000">
      <img src="assets/img_banner/europa-min.png" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5></h5>
        <p></p>
      </div>
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
 <!-- Barra movil 
 <div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
       <div class="barra-movil">
         <div class="titulo-barra-movil"><h2>TODOS LOS DESTINOS AL MEJOR PRECIO, ENCONTRÁ EL TUYO y VIAJA TRANQUILO</span></h2></div>  
       </div>
    </div>
  </div>
 </div>
 -->
  <div class="container my-3 m-auto productos-detalles">
     <div class="titulo text-center">
       <h4 class="display-4"></h4>
     </div>
     <div class="row">
       @php
       $productosAleatorios = $productos->shuffle()->take(6);
       @endphp
       @foreach ($productosAleatorios as $producto)
       <div class="col-md-4 p-2">
       <div class="card productos">
         <div class="card-img-container">
            @if($producto->tipo_producto == 'Salida Grupal')
            <div class="barra-horizontal-grupal">
              <p class="leyenda">Salida Grupal</p>
            </div>
            @elseif ($producto->tipo_producto == 'Family Plan')
            <div class="barra-horizontal-family">
              <p class="leyenda">Family Plan</p>
            </div>
             @elseif ($producto->tipo_producto == 'Paquete Turístico')
            <div class="barra-horizontal-paquete">
              <p class="leyenda">Paquete Turístico</p>
            </div>
            @endif
            <img src="{{ asset('assets/img_paquetes/' . $producto->imagen) }}" class="card-img-top img-fluid" alt="{{ $producto->nombre }}">
              <div class="card-img-overlay titulo-prod">
                <h6 class="card-title">{{ $producto->nombre }}</h6>
                <p class="precio-total">Precio: {{ $producto->moneda }} {{ $producto->precio_total }}</p>
              </div>
         </div>      
         <div>      
            <p class="ms-2">  
              @if ($producto->service && ($producto->service->transporte_int == 'Aéreos' || $producto->service->transporte_int == 'Aéreos con escala'))                                        
                  <i class="fas fa-plane-departure"></i>
              @elseif ($producto->service && $producto->service->transporte_int == 'Micro') 
                  <i class="fas fa-bus"></i>
              @elseif ($producto->service && $producto->service->transporte_int == 'Sin Traslados')               
              @endif 
              <span>{{ $producto->origen_salida }} ⇌ {{ $producto->ciudad_destino }}</span>
            </p>
           <p class="ms-2">
             <i class="fa-solid fa-bus"></i> : <span>Aeropuerto ⇌ Hotel</span>
           </p>
           <p class="ms-2">
              <span>
                  @if ($producto->hotel) {{-- Verifica si hay una relación con un hotel --}}
                      <i class="fa-solid fa-hotel"></i> :
                      {{ $producto->hotel->nombre }}
                      @for ($i = 1; $i <= $producto->hotel->categoria; $i++)
                          <i class="fa-solid fa-star"></i>
                      @endfor
                  @else
                      <i class="fa-solid fa-hotel"></i> : Consultar!!
                  @endif
              </span>
          </p>
            <p class="">
              <i class="fa-solid fa-bed ms-2"></i> : {{ $producto->habitacion }} <span> ({{ $producto->estadia }} <i class="fa-solid fa-cloud-moon"></i>)</span>        
              </span>           
            </p>   
         </div>
         <div class="p-1 w-100">
          <a href="{{ route('producto.detalles', $producto->id) }}" class="btn btn-primary w-100">VER MAS</a>          
         </div>        
       </div>
      </div>
     @endforeach
    </div>   
  </div>
  <div class="container-fluid container-servicios bg-gris">
    <div class="row">
      <hr>     
      <h1 class="text-center">Descubrí el Placer de Viajar</h1>      
      <div class="col-md-3 container-servicio">
        <h3>Vuelos</h3>
        <div class="overlay">          
          <a href="#modalVuelos" class="" data-bs-toggle="modal" data-bs-target="#modalVuelos">Cotizar Vuelos!!</a>
        </div>
        <img class="img-fluid" src="assets/img/vuelos.png" alt="">
      </div>
      <div class="col-md-3 container-servicio">
         <h3>Paquetes Turísticos</h3>   
         <a href="paquetes">     
         <img class="img-fluid" src="assets/img/Paquetes.png" alt="">
         </a>
      </div>
      <div class="col-md-3 container-servicio">
         <h3>Salidas Grupales</h3>        
        <img class="img-fluid" src="assets/img/Grupales.png" alt="">
      </div>
      <div class="col-md-3 container-servicio">
         <h3>Viajes a Medida</h3>        
        <img class="img-fluid" src="assets/img/TuViaje.png" alt="">
      </div>
    </div>
  </div>
  <!-- Modal para Vuelos -->
<div class="modal fade" id="modalVuelos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fa fa-plane"></i> Cotizar Vuelos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"></span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Formulario para Cotizar Vuelos -->
        <form action="/cotizar_vuelos" method="post">
          @csrf
          <div class="form-floating mb-3">
            <input type="date" name="fecha_ida" placeholder="Fecha de Ida" class="form-control" required>
            <label for="fecha_ida" class="form-label">Fecha Partida:</label>
          </div>
          <div class="form-floating mb-3">
            <input type="date" name="fecha_regreso" placeholder="Fecha Regreso" class="form-control">
            <label for="fecha_regreso" class="form-label">Fecha Regreso:</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" name="origen" placeholder="Ciudad de Origen" class="form-control" required>
            <label for="origen" class="form-label">Ciudad de Origen:</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" name="destino" placeholder="Ciudad Destino" class="form-control" required>
            <label for="destino" class="form-label">Ciudad Destino:</label>
          </div>
          <div class="form-floating mb-3">
            <input type="email" name="email" placeholder="Email de Contacto" class="form-control" required>
            <label for="email" class="form-label">Email de Contacto:</label>
          </div>
          <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
      </div>
    </div>
  </div>
</div>
@if($mostrarModal)
<div class="modal fade comercioAdherido" id="miModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="padding-bottom: 0">
        <h5 class="modal-title" style="margin-bottom: 3px;" ><a type="button" class="btn" href="http://127.0.0.1:8000/register_client">Registrate:</a><i>Precios y Ofertas exclusivas para la comunidad</i></h5> 
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <a href="http://127.0.0.1:8000/register_client">
            <img src="assets/img/viajandomejor-min.png" alt="Probanos!!!" class="img-fluid">
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
        <h5 class="modal-title"><i class="fa fa-check-circle"></i></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"></span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Aquí mostrarás el mensaje de éxito -->
        @if(session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endif 
@endsection

        
       
        