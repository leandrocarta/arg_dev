@extends('layouts.app-master')
@section('content')
  <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">  
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="5000">      
      <img src="assets/img_banner/Europa_grupal-min.png" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h1></h1>
          <p></p>
        </div>     
    </div>
  </div>    
 </div> 
  <div class="container my-3 m-auto productos-detalles" id="grupales">
     <div class="titulo-paquetes">
       <h2>LAS MEJORES SALIDAS GRUPALES <span>POR TODO EL MUNDO</span></h2>
       <p>Te invitamos a explorar nuestra extraordinaria colección de productos diseñados para satisfacer las expectativas de cada tipo de viajero.<span> Presta especial atención a nuestras ofertas</span>, ya que contamos con una línea cuidadosamente seleccionada que incorpora un toque exclusivo en cada destino.</p>
       <p>Al explorar nuestra amplia gama de productos, encontrarás opciones que destacan no solo por los destinos fascinantes que visitarás, sino también por experiencias enriquecidas gracias a <span>guías de habla hispana</span> expertos en cultura e historia. Estos expertos están aquí para transformar cada momento de tu viaje en una inmersión auténtica en la riqueza cultural de cada lugar.</p>
       <hr>
      </div>
     <div class="row">
       @php
        $productosPaquetes = $productos->filter(function ($producto) {
        return $producto->tipo_producto === 'Salida Grupal' | $producto->tipo_producto === 'Grupal con Guía Hispanohablante';
       });
       $productosAleatorios = $productosPaquetes->shuffle();
       @endphp
       @foreach ($productosAleatorios as $producto)
       <div class="col-md-4 p-2">
       <div class="card productos">
         <div class="card-img-container">
            @if($producto->tipo_producto == 'Salida Grupal') 
            <div class="barra-horizontal-grupal">
              <p class="leyenda">Salida Grupal</p>
            </div> 
             @elseif($producto->tipo_producto == 'Grupal con Guía Hispanohablante')
            <div class="barra-horizontal-grupal-hispano">
              <p class="leyenda">Grupal con Guía Hispanohablante</p>
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
              <i class="fa-solid fa-bed ms-2"></i> : {{ $producto->habitacion }} <span> ({{ $producto->estadiaTotal }} <i class="fa-solid fa-cloud-moon"></i>)</span>        
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
@endsection
 