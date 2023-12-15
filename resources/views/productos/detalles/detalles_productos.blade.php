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
                    <h4><i class="fa-solid fa-location-dot me-2"></i>{{ $productos->pais_destino }} - {{ $productos->ciudad_destino }}</h4>
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
    <div class="row">
        <div class="col">
            <hr>
            <h2 class="mb-4">Datos Generales</h2>
            <p>
                <strong><i class="fas fa-bus me-1"></i> -  Traslados Origen:</strong> {{ $productos->service->traslados_orig }}
            </p>
            <p class="">
                @if ($productos->service && ($productos->service->transporte_int == 'Aéreos' || $productos->service->transporte_int == 'Aéreos con escala'))                                        
                    <i class="fas fa-plane-departure me-1"></i> -
                @elseif ($productos->service && $productos->service->transporte_int == 'Micro') 
                    <i class="fas fa-bus"></i> 
                @elseif ($productos->service && $productos->service->transporte_int == 'Sin Traslados')               
                @endif 
                <span>{{ $productos->origen_salida }} ⇌ {{ $productos->ciudad_destino }}</span>                 
            </p>
            <p class="">                
                <strong><i class="fas fa-bus me-1"></i> - Traslados Destino:</strong> {{ $productos->service->traslados_dest }} <span>Aeropuerto ⇌ Hotel</span>           
            </p>     
            <p>
                <strong><i class="fa-solid fa-cloud-moon"></i> - </strong> Estadía Total {{ $productos->estadiaTotal }} Noches.
            </p>       
            <p class="mb-2">
                <strong><i class="fa-solid fa-kit-medical me-1"></i> - </strong> {{ $productos->service->seguro }}
            </p>
            <hr>
        </div>
    </div>
</div>

  <div class="container-fluid my-3 m-auto productos-detalles">
    <div class="row px-2 campo-detalles">        
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
                    <u>HOSPEDAJE PRINCIPAL:</u>
                    @else
                    <u>OTROS:</u>
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

        
       
        