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
