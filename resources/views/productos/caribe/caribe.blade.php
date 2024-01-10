@extends('layouts.app-master')
@section('content')
<div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">  
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="5000">      
      <img src="assets/img_banner/Caribe-min.png" class="d-block w-100" alt="...">
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
  <h1>DESCUBRE LA MAGIA DEL CARIBE</h1>
  <p>Sumérgete en un paraíso tropical donde las playas de arena dorada se encuentran con las aguas cristalinas. Desde las icónicas playas de Punta Cana hasta los rincones escondidos de Jamaica, el Caribe te invita a explorar la belleza sin igual de sus costas.</p>
  <p class="a my-3">
    <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
      ¿Quieres saber más?
    </a>   
  </p>
  <div class="collapse" id="collapseExample">
    <div class="card card-body">        
      <h4>Paraíso tropical de playas doradas</h4>
          <p>El Caribe, un paraíso tropical donde las playas de arena dorada se encuentran con las aguas cristalinas. Desde las icónicas playas de Punta Cana hasta los rincones escondidos de Jamaica, el Caribe te invita a sumergirte en la belleza sin igual de sus costas.</p>

          <h4>Exploración de arrecifes de coral</h4>
          <p>Descubre la riqueza submarina del Caribe a través de sus arrecifes de coral. Snorkeling en los Cayos de Cuba o buceo en las Islas Caimán, cada rincón ofrece una experiencia única para admirar la vida marina y los coloridos corales.</p>

          <h4>Cultura vibrante y festivales caribeños</h4>
          <p>Sumérgete en la cultura vibrante del Caribe, donde la música y los festivales llenan las calles de alegría. Desde el carnaval en Trinidad y Tobago hasta las festividades de Junkanoo en las Bahamas, la alegría y la música caribeña te envuelven.</p>

          <h4>Gastronomía isleña y sabores exóticos</h4>
          <p>La gastronomía del Caribe es una explosión de sabores exóticos. Desde el jerk jamaicano hasta el mofongo en Puerto Rico, cada isla tiene su propia especialidad culinaria. Disfruta de pescados frescos y frutas tropicales en un festín que deleitará tu paladar.</p>

          <h4>Aventuras en la selva y cascadas secretas</h4>
          <p>Explora la exuberante selva del Caribe y descubre cascadas secretas. Desde las selvas de Dominica hasta las rutas de senderismo en Santa Lucía, cada isla ofrece aventuras en la naturaleza que te acercarán a la auténtica belleza del Caribe.</p>

          <h4>Hospitalidad isleña y bienvenida cálida</h4>
          <p>Experimenta la hospitalidad única del Caribe, donde la bienvenida es cálida y cada visita se convierte en una experiencia inolvidable. Desde los resorts de lujo hasta las acogedoras posadas, cada rincón te invita a disfrutar de la serenidad isleña.</p>

          <h4>Explora la magia del Caribe</h4>
          <p>El Caribe, con su combinación de playas paradisíacas, cultura vibrante y hospitalidad isleña, te invita a explorar un mundo de maravillas tropicales y experiencias únicas.</p>
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
        $productosCaribe = $productos->filter(function ($producto) {
            return $producto->destino_gral === 'Caribe';
        });
        $productosAleatorios = $productosCaribe->shuffle();
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
