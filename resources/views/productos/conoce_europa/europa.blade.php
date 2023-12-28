@extends('layouts.app-master')
@section('content')
<div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">  
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="5000">      
      <img src="assets/img_banner/europa-min.png" class="d-block w-100" alt="...">
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
      <h1>DESCUBRE LA RIQUEZA DE EUROPA</h1>
      <p>Europa, un continente impregnado de historia, cultura y diversidad, te invita a sumergirte en sus encantos. Desde las majestuosas ciudades con su arquitectura centenaria hasta los impresionantes paisajes naturales que te dejan sin aliento, Europa ofrece una experiencia única para cada viajero.</p>

  <p class="a my-3">
    <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
      ¿Quieres saber más?
    </a>   
  </p>
  <div class="collapse" id="collapseExample">
    <div class="card card-body">        
       <h4>Un viaje a través de la historia y la cultura</h4>
          <p>Europa, un continente impregnado de historia, cultura y diversidad, te invita a sumergirte en sus encantos. Desde las majestuosas ciudades con su arquitectura centenaria hasta los impresionantes paisajes naturales que te dejan sin aliento, Europa ofrece una experiencia única para cada viajero.</p>

          <h4>Destinos emblemáticos que te enamorarán</h4>
          <p>Explora las calles adoquinadas de París, donde la Torre Eiffel se alza como un ícono imponente, y déjate seducir por el arte en el Louvre. Pasea por los canales de Venecia, donde la arquitectura renacentista se refleja en las aguas serenas, creando un escenario de ensueño.</p>

          <h4>Encanto de antiguas civilizaciones y modernidad</h4>
          <p>Descubre la historia antigua en Atenas, con la Acrópolis dominando el horizonte, y sumérgete en la cultura vibrante de Barcelona, donde la arquitectura de Gaudí deja una huella única. Recorre los Alpes suizos, con sus picos cubiertos de nieve, y siente la magia de la aurora boreal en los cielos del norte de Europa.</p>

          <h4>Festín para los sentidos: Gastronomía europea</h4>
          <p>La diversidad culinaria de Europa es un festín para los sentidos. Desde la pasta italiana hasta los quesos franceses y las salchichas alemanas, cada país ofrece sabores auténticos que deleitarán tu paladar. Explora los mercados locales y descubre la riqueza gastronómica que define a cada región.</p>

          <h4>Viaja con facilidad: Red de trenes de alta velocidad</h4>
          <p>La red de trenes de alta velocidad te permite recorrer fácilmente las maravillas de Europa, desde las playas mediterráneas hasta los castillos en las colinas. Sumérgete en la vida nocturna de Berlín, con sus clubes vibrantes, o relájate en las playas de la Costa Amalfitana en Italia.</p>

          <h4>Hospitalidad europea: Una bienvenida en cada rincón</h4>
          <p>La hospitalidad europea te hará sentir bienvenido en cada rincón. Desde las aldeas pintorescas hasta las metrópolis bulliciosas, cada destino tiene su propia historia que contar. Europa, con su riqueza cultural, su patrimonio histórico y sus paisajes variados, te espera con los brazos abiertos para que descubras la magia que la hace única.</p>
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
        $productosEuropa = $productos->filter(function ($producto) {
            return $producto->destino_gral === 'Europa';
        });
        $productosAleatorios = $productosEuropa->shuffle();
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
