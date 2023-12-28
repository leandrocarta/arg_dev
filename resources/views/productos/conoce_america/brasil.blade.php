@extends('layouts.app-master')
@section('content')
<div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>   
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="5000">      
      <img src="assets/img_banner/brasil-min.png" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h1></h1>
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
 <div class="container introduction-productos-content">
  <div class="row">
    <div class="col-12 introduction-productos">
  <h1>DESCUBRE LA BELLEZA DE BRASIL</h1>
  <p>Brasil, un país vibrante que deslumbra con su diversidad cultural y paisajes naturales extraordinarios. Desde las playas de Copacabana hasta la selva amazónica, Brasil te invita a explorar sus contrastes únicos.</p>
  <p class="a my-3">
    <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
      ¿Quieres saber más?
    </a>   
  </p>
  <div class="collapse" id="collapseExample">
    <div class="card card-body">        
      <h4>Playas Paradisíacas</h4>
      <p>Brasil es famoso por sus playas paradisíacas. Desde las inmaculadas playas de Porto de Galinhas, conocidas por sus aguas cristalinas y arenas blancas, hasta las icónicas playas de Copacabana en Río de Janeiro, famosas por su animado ambiente y vistas espectaculares, el litoral brasileño ofrece lugares como paraísos terrenales. Recorre las cálidas aguas de la Praia de Pipa, famosa por su encanto bohemio y belleza natural. No te pierdas la Praia do Forte, hogar de playas vírgenes y protegidas, donde podrás disfrutar de la biodiversidad marina. También, explora las extensas dunas de Genipabu y maravíllate con sus paisajes únicos. La tranquila Praia do Espelho en Bahía, con sus aguas serenas y paisajes espectaculares, es otro tesoro escondido del nordeste brasileño. Disfruta de la Praia dos Carneiros en Pernambuco, con sus aguas tranquilas y palmeras que bordean la costa, creando un ambiente paradisíaco. Estas recomendaciones son solo una muestra de la diversidad y belleza natural que Brasil tiene para ofrecer, proporcionando entornos ideales para relajarse y disfrutar del sol.</p>

      <h4>Festivales y Ritmos Apasionantes</h4>
      <p>Sumérgete en la alegría contagiosa de los festivales brasileños y deja que los ritmos apasionantes de la samba y la bossa nova te envuelvan. En Brasil, la música y la danza son parte integral de la vida cotidiana.</p>

      <h4>Naturaleza Exuberante</h4>
      <p>Descubre la exuberante belleza de la selva amazónica, hogar de una increíble variedad de flora y fauna. Las Cataratas del Iguazú y las extensas llanuras del Pantanal ofrecen panoramas impresionantes y experiencias inolvidables.</p>

      <h4>Gastronomía Colorida y Sabrosa</h4>
      <p>La cocina brasileña es una explosión de colores y sabores. Desde la feijoada, el plato nacional, hasta las deliciosas coxinhas, cada bocado es una aventura culinaria que refleja la riqueza de la cultura brasileña.</p>

      <h4>Aventuras en la Amazonia</h4>
      <p>Para los amantes de la aventura, la Amazonia brasilera ofrece exploraciones fascinantes. Navega por el río Amazonas, admira la biodiversidad única y conecta con la naturaleza en su estado más puro.</p>

      <h4>Hospitalidad Brasileña</h4>
      <p>La hospitalidad de los brasileños es conocida en todo el mundo. En cada rincón, te recibirán con sonrisas cálidas y te invitarán a formar parte de su vibrante cultura.</p>

      <h4>Explora la Magia de Brasil</h4>
      <p>Brasil, con su diversidad cultural, su naturaleza deslumbrante y su hospitalidad única, te invita a explorar un territorio lleno de sorpresas y experiencias auténticas.</p>
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
            return $producto->destino_gral === 'Brasil';
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
