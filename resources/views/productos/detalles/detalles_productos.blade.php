@extends('layouts.app-master')
@section('content')
 <div class="carousel carousel-dark slide" data-bs-ride="carousel">    
   <div class="carousel-inner img-prod-banner">
    @php
        $hotelesRelacionados = collect();

        foreach(['id_hotel', 'id_hotel2', 'id_hotel3'] as $campoHotel) {
            $idHotel = $productos->$campoHotel;

            if ($idHotel !== 1) {
                $hotelRelacionado = App\Models\Hotel::find($idHotel);

                if ($hotelRelacionado) {
                    $campoEstadia = "estadia";
                    if ($campoHotel === 'id_hotel2') {
                        $campoEstadia = "estadia_dos";
                    } elseif ($campoHotel === 'id_hotel3') {
                        $campoEstadia = "estadia_tres";
                    }
                    $estadiaHotel = $productos->$campoEstadia;
                    $hotelesRelacionados->push([
                        'hotel' => $hotelRelacionado,
                        'estadia' => $estadiaHotel,
                    ]);
                }
            }
        }
        @endphp
        @if ($hotelesRelacionados->isNotEmpty())
        @foreach ($hotelesRelacionados as $hotelData)
            <div class="carousel-item filtro {{ $loop->first ? 'active' : '' }}">
                <img src="{{ asset('assets/img_hoteles/' . $hotelData['hotel']->img_banner) }}" class="d-block w-100" alt="">
                <div class="titulo-detalles-prod">
                    <h4><i class="fa-solid fa-location-dot me-2"></i>{{ $productos->pais_destino }} - {{ $productos->destinos->nombre_destino }}</h4>
                    <h1>{{ $hotelData['hotel']->nombre }}</h1>
                    <h4>Con Estadía de {{ $hotelData['estadia'] }} Noches</h4>
                    <h4><strong><i class="fa-regular fa-calendar-days"></i></strong> {{ $productos->fecha_vencimiento }}</h4>
                </div>
            </div>
        @endforeach
        @else
        <p>No hay información disponible para este producto.</p>
        @endif
  </div>
</div>
<div class="container mt-4">
    <div class="row datos-generales">
        <hr>
        <h2 class="mb-4">Información General</h2>
        <div class="col-md-5 info-paquete d-flex flex-column">
            <div class="card bg-light px-2 border rounded flex-grow-1">
                <h4 class="mb-2">Información del Paquete</h4>
                <p>
                    <strong><i class="fas fa-bus"></i> - Origen:</strong> Domicilio ⮂ {{ $productos->origen_salida }} {{ $productos->service->traslados_orig }}
                </p>
                <p class="">
                    @if ($productos->service)
                        @php
                            $transporteAereo = $productos->service->transporte_int;
                        @endphp

                        @if ($transporteAereo == 'Aéreo Directo')
                            <i class="fas fa-plane-departure me-1"></i> -
                        @elseif ($transporteAereo == 'Aéreos con escala')
                            <i class="fas fa-plane-departure me-1"></i> - 
                        @endif

                        @if ($transporteAereo == 'Micro - Vans') 
                            <i class="fas fa-bus"></i> 
                        @endif

                        @if ($transporteAereo == 'Sin Traslados')               
                            <!-- Agregar código específico si es necesario -->
                        @endif
                    @endif

                    <span><strong>{{ $productos->service->transporte_int }}:</strong> desde {{ $productos->origen_salida }} ⮂ {{ $productos->destinos->nombre_destino }}</span>                 
                </p>
                <p class="">                
                    <strong><i class="fas fa-bus me-1"></i> - Destino:</strong> {{ $productos->service->traslados_dest }} desde <span>Aeropuerto ⮂ Hotel</span>           
                </p>     
                <p>
                    <strong><i class="fa-solid fa-cloud-moon"></i> - Estadía Total:</strong> {{ $productos->estadiaTotal }} Noches.
                </p>       
                <p class="mb-2">
                    <strong><i class="fa-solid fa-kit-medical me-1"></i> - {{ $productos->service->seguro }} </strong>
                </p>                
            </div>
        </div>
        <div class="col-md-7 info-paquete d-flex flex-column">
            <div class="card bg-light px-2 border rounded flex-grow-1">
                <h4 class="mb-2">{{ $productos->destinos->nombre_destino }}</h4>
                <p class="mb-2">            
                    @if($productos->destinos->detalle_gral)
                        {{ $productos->destinos->detalle_gral }}                        
                         <a data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                           Leer mas
                         </a>   
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>
<div class="collapse" id="collapseExample">
    <div class="card card-body">
        <div class="container">
            <div class="row bg-light border rounded">
                <div class="col-md-6">                            
                    @if($productos->destinos->ubicacion)
                        <p class="mb-2 border rounded p-1 m-2">
                            <i class="fa-solid fa-location-dot"></i>
                            <span class="ms-2 fw-bold">Ubicación:</span>
                            {{ $productos->destinos->ubicacion }}
                        </p>                            
                    @endif
                    @if($productos->destinos->playas)
                        <p class="mb-2 border rounded p-1 m-2">
                            <i class="fa-solid fa-umbrella-beach"></i>
                            <span class="ms-2 fw-bold">Playas:</span>
                            {{ $productos->destinos->playas }}
                        </p>                            
                    @endif
                    @if($productos->destinos->gastronomia)
                        <p class="mb-2 border rounded p-1 m-2">
                            <i class="fas fa-utensils"></i>
                            <span class="ms-2 fw-bold">Gastronomía:</span>
                            {{ $productos->destinos->gastronomia }}
                        </p>
                    @endif
                </div>
                <div class="col-md-6">
                    @if($productos->destinos->atracciones)
                        <p class="mb-2 border rounded p-1 m-2">  
                            <i class="fas fa-camera"></i>
                            <span class="ms-2 fw-bold">Atracciones:</span>
                            {{ $productos->destinos->atracciones }}
                        </p>
                    @endif
                    @if($productos->destinos->historia)
                        <p class="mb-2 border rounded p-1 m-2"> 
                            <i class="fas fa-book"></i> 
                            <span class="ms-2 fw-bold">Historia:</span>
                            {{ $productos->destinos->historia }}                
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid my-3 m-auto productos-detalles">
   <div class="row px-2 campo-detalles datos-generales">        
      <div class="col-md-5 ">
           @php
           $camposOrdenados = [
               'id_hotel' => 'estadia',
               'id_hotel2' => 'estadia_dos',
               'id_hotel3' => 'estadia_tres',
           ];
           @endphp
           @foreach ($camposOrdenados as $campoHotel => $campoEstadia)
           @php
           $idHotel = $productos->$campoHotel;
           @endphp
           @if ($idHotel !== 1)
           @php
           $hotelRelacionado = App\Models\Hotel::find($idHotel);
           @endphp
           @if ($hotelRelacionado)
            <div class="detalle-hotel">
                <h5 class="subtitulo-hotel">
                    @if ($campoHotel === 'id_hotel')
                    HOSPEDAJE PRINCIPAL:
                    @else
                    OTROS:
                    @endif
                </h5>
                 <div class="info-hotel">
                     <p><i class="fa-solid fa-hotel"></i>: {{ $productos->$campoEstadia }} Noches
                         - {{ $hotelRelacionado->nombre }}             
                     </p>
                     <p class=""><i class="fa-solid fa-bed"></i> : Habitación {{ $productos->habitacion }}
                      @if ($productos->service->comidas == 'All Inclusive')
                         Con {{ $productos->service->comidas }}
                         @elseif ($productos->service->comidas == 'Desayuno')
                         <i class="fa-solid fa-mug-saucer"></i> : {{ $productos->service->comidas }}
                         @elseif ($productos->service->comidas == 'Media Pensión')
                         <i class="fa-solid fa-utensils"></i> : {{ $productos->service->comidas }}
                         @endif
                     </p>
                     @if ($hotelRelacionado->gym == 'Área de Gimnasio' || $hotelRelacionado->spa == 'Área de Spa')
                     <p>
                         @if ($hotelRelacionado->gym == 'Área de Gimnasio')
                         <i class="fa-solid fa-dumbbell"></i> : {{ $hotelRelacionado->gym }}
                         @endif
                         @if ($hotelRelacionado->spa == 'Área de Spa')
                         - <i class="fa-solid fa-hot-tub-person"></i> : {{ $hotelRelacionado->spa }}
                         @endif
                     </p>
                     @endif
                 </div>                 
             </div>
             @endif
             @endif
             @endforeach
             <hr>
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <p>
                          <strong>PRECIO TOTAL: </strong> - {{ $productos->moneda }} {{ $productos->precio_total }}
                        </p>
                    </div>
                    <div class="col-md-5">
                        <a class="btn btn-danger w-100" href="">Consultar</a>
                    </div>
                </div>
            </div>
             
      </div>
      <div class="col-md-7 mt-2-movil">
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

        
       
        