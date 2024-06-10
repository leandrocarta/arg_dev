@extends('layouts.app-master')
@section('content')
<div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">  
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="5000">      
      <img src="assets/img_banner/Banner-argentina-min.png" class="d-block w-100" alt="...">
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
        $productosArg = $productos->filter(function ($producto) {
            return $producto->ubicacion === 'Tur-Arg';
        });
        $productosAleatorios = $productosArg->shuffle();
       @endphp
       @foreach ($productosAleatorios as $producto)
       @if($producto->tipo_producto !== 'Aéreo')
       <div class="col-md-4 p-2">
        <div class="card productosCrucero">
            <div class="" style="position: relative; overflow: hidden;">
                <div style="padding-top: 100%;"></div>
                <img src="{{ asset('assets/img_paquetes/' . $producto->imagen) }}" class="card-img-top img-fluid" alt="{{ $producto->nombre }}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                <div class="card-img-overlay titulo-prod-cruceros">
                    <p><i class="fa-solid fa-location-dot me-1"></i> {{ $producto->destinos->ciudad_destino }}, {{ $producto->pais->nombre }}</p>                                     
                    <p><span class="usd">{{ $producto->moneda }} </span> {{ $producto->precio_total }}</p>
                </div>
            </div>
            <div class="w-100 btn-crucero">
                <a href="{{ route('producto.detalles', $producto->id) }}" class="btn btn-primary w-100">VER MÁS</a>
            </div>
        </div>
       </div>
       @endif
     @endforeach
    </div>   
  </div>
@endsection
