@extends('layouts.app-master')
@section('content')
<div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">  
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="5000">      
      <img src="assets/img_banner/banner-argentina-min.png" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h1></h1>
          <p></p>
        </div>     
    </div>
  </div>  
 </div> 
 <div class="container introduction-productos-content">
  <div class="row">
    <div class="col-12 introduction-productos">
        <h1>DESCUBRE LA MAGIA DE ARGENTINA</h1>
        <p>Argentina, un país que cautiva con su diversidad única y ofrece un abanico de experiencias turísticas
          inolvidables. Desde las animadas calles de Buenos Aires hasta los paisajes remotos de la Patagonia,
          Argentina se presenta como un mosaico de contrastes y emociones.
        </p>
        <p class="a my-3">
          <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            ¿Quieres saber más?
          </a>   
        </p>
        <div class="collapse" id="collapseExample">
          <div class="card card-body">             
        <h4>Herencia Cultural y Pasión</h4>
        <p>Argentina es hogar de una rica herencia cultural, donde la pasión por el tango, la música y el arte impregna
          la vida cotidiana. En sus ciudades, especialmente en Buenos Aires, se puede sentir la energía vibrante de la
          danza, la arquitectura elegante y la intensidad de la vida nocturna.</p>

        <h4>Naturaleza Asombrosa</h4>
        <p>Desde las selvas tropicales del norte hasta los glaciares imponentes del sur, la naturaleza argentina sorprende
          por su variedad y belleza. Las Cataratas del Iguazú, la cordillera de los Andes y los paisajes infinitos de la
          Pampa ofrecen una muestra de la majestuosidad natural que caracteriza al país.</p>

        <h4>Gastronomía Auténtica</h4>
        <p>La cocina argentina es una mezcla única de influencias europeas y latinoamericanas, destacando por sus carnes
          asadas, empanadas y vinos excepcionales. Explorar los mercados locales y disfrutar de una parrillada es
          sumergirse en una experiencia culinaria que celebra los sabores auténticos del país.</p>

        <h4>Aventura en la Patagonia</h4>
        <p>Para los amantes de la aventura, la Patagonia argentina ofrece un escenario épico. Desde excursiones en kayak
          por lagos cristalinos hasta caminatas entre glaciares milenarios, esta región garantiza una dosis de
          adrenalina y la oportunidad de conectar con la naturaleza en su forma más pura.</p>

        <h4>Hospitalidad Inigualable</h4>
        <p>La hospitalidad de los argentinos es conocida en todo el mundo. Aquí, los visitantes son recibidos con una
          calidez única, haciendo que cada encuentro sea más que una simple transacción; es un intercambio de sonrisas,
          historias y conexiones genuinas.</p>

        <h4>Explora la Autenticidad Argentina</h4>
        <p>Argentina, con su mezcla de culturas, su naturaleza impresionante y su hospitalidad sincera, invita a los
          viajeros a explorar un territorio diverso donde cada rincón cuenta una historia única.</p>

          </div>
        </div>
      </div>
  </div>
 </div>
 <div class="container my-3 m-auto productos-detalles home-iconos">
     <div class="titulo text-center">
       <h4 class="display-4"></h4>
     </div>
     <div class="row">
       @php
        $productosArgentina = $productos->filter(function ($producto) {
            return $producto->destino_gral === 'Tur-Arg';
        });
        $productosAleatorios = $productosArgentina->shuffle();
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
            @elseif ($producto->tipo_producto == 'Family Plan')
            <div class="barra-horizontal-family">
              <p class="leyenda">Family Plan</p>
            </div>
             @elseif ($producto->tipo_producto == 'Paquete Turístico')
            <div class="barra-horizontal-paquete">
              <p class="leyenda">Paquete Turístico</p>
            </div>
            @elseif ($producto->tipo_producto == 'Exclusivo Comunidad')
            <div class="barra-horizontal-comunidad">
              <p class="leyenda">Exclusivo Comunidad (20% descto.)</p>
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
              @if ($producto->service && ($producto->service->transporte_int == 'Aéreo Directo' || $producto->service->transporte_int == 'Aéreos con escala'))                                        
                  <i class="fas fa-plane-departure"></i>
              @elseif ($producto->service && $producto->service->transporte_int == 'Micro') 
                  <i class="fas fa-bus"></i>
              @elseif ($producto->service && $producto->service->transporte_int == 'Sin Traslados')               
              @endif 
              <span>{{ $producto->origen_salida }} ⇌ {{ $producto->destinos->nombre_destino }}</span>
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
