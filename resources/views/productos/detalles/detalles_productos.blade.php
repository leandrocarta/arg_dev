@extends('layouts.app-master')
@section('content')
<div class="detalles_productos">
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
<div class="container">
    <div class="row datos-generales">
        <hr>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                   <h2 class="mb-4">Información General</h2>
                </div>
            </div>
        </div>        
        <div class="col-md-6 info-paquete d-flex flex-column mb1-movil">
            <div class="px-2 flex-grow-1 bg-light-detalles">
                <h4 class="mb-2">Información del Paquete</h4>
                <p>
                    <i class="fas fa-bus"></i> Origen: Domicilio ⮂ {{ $productos->origen_salida }} {{ $productos->service->traslados_orig }}
                </p>
                <p class="">
                    @if ($productos->service)
                        @php
                            $transporteAereo = $productos->service->transporte_int;
                        @endphp

                        @if ($transporteAereo == 'Aéreo Directo')
                            <i class="fas fa-plane-departure me-1"></i>
                        @elseif ($transporteAereo == 'Aéreos con escala')
                            <i class="fas fa-plane-departure me-1"></i> 
                        @endif

                        @if ($transporteAereo == 'Micro - Vans') 
                            <i class="fas fa-bus"></i> 
                        @endif

                        @if ($transporteAereo == 'Sin Traslados')               
                            <!-- Agregar código específico si es necesario -->
                        @endif
                    @endif

                    {{ $productos->service->transporte_int }}: desde {{ $productos->origen_salida }} ⮂ {{ $productos->destinos->nombre_destino }}                 
                </p>
                <p class="">                
                    <i class="fas fa-bus me-1"></i> Destino: {{ $productos->service->traslados_dest }} desde <span>Aeropuerto ⮂ Hotel</span>           
                </p>     
                <p>
                    <i class="fa-solid fa-cloud-moon"></i> Estadía Total: {{ $productos->estadiaTotal }} Noches.
                </p>       
                <p class="mb-2">
                    <i class="fa-solid fa-kit-medical me-1"></i> {{ $productos->service->seguro }} 
                </p>                
            </div>
        </div>
        <div class="col-md-6 info-paquete d-flex flex-column">
            <div class="bg-light-detalles px-2 flex-grow-1">
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
<div class="container mt-4">
    <div class="row datos-generales">    
        <div class="collapse" id="collapseExample">
            <div class="container">
            <div class="row">
                <div class="col-md-12">
                   <h2 class="">Queres saber más sobre {{ $productos->destinos->nombre_destino }} ?</h2>
                </div>
            </div>
        </div>  
            <div class="">
                <div class="container mt-4">
                    <div class="row bg-light-detalles">
                        <div class="col-md-6">                            
                            @if($productos->destinos->ubicacion)
                                <p class="mb-2 borde-cajas">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span class="fw-bold">Ubicación:</span>
                                    {{ $productos->destinos->ubicacion }}
                                </p>                            
                            @endif
                            @if($productos->destinos->playas)
                                <p class="borde-cajas">
                                    <i class="fa-solid fa-umbrella-beach"></i>
                                    <span class="fw-bold">Playas:</span>
                                    {{ $productos->destinos->playas }}
                                </p>                            
                            @endif
                            @if($productos->destinos->gastronomia)
                                <p class="mb-2 borde-cajas">
                                    <i class="fas fa-utensils"></i>
                                    <span class="fw-bold">Gastronomía:</span>
                                    {{ $productos->destinos->gastronomia }}
                                </p>
                            @endif
                        </div>
                        <div class="col-md-6">
                            @if($productos->destinos->atracciones)
                                <p class="mb-2 borde-cajas">  
                                    <i class="fas fa-camera"></i>
                                    <span class="fw-bold">Atracciones:</span>
                                    {{ $productos->destinos->atracciones }}
                                </p>
                            @endif
                            @if($productos->destinos->historia)
                                <p class="mb-2 borde-cajas"> 
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
                     <p><i class="fa-solid fa-hotel"></i> {{ $productos->$campoEstadia }} Noches
                         {{ $hotelRelacionado->nombre }}             
                     </p>
                     <p class=""><i class="fa-solid fa-bed"></i> Habitación {{ $productos->habitacion }}
                      @if ($productos->service->comidas == 'All Inclusive')
                         Con {{ $productos->service->comidas }}
                         @elseif ($productos->service->comidas == 'Desayuno')
                         <i class="fa-solid fa-mug-saucer"></i> {{ $productos->service->comidas }}
                         @elseif ($productos->service->comidas == 'Media Pensión')
                         <i class="fa-solid fa-utensils"></i> {{ $productos->service->comidas }}
                         @endif
                     </p>
                     @if ($hotelRelacionado->gym == 'Área de Gimnasio' || $hotelRelacionado->spa == 'Área de Spa')
                     <p>
                         @if ($hotelRelacionado->gym == 'Área de Gimnasio')
                         <i class="fa-solid fa-dumbbell"></i> {{ $hotelRelacionado->gym }}
                         @endif
                         @if ($hotelRelacionado->spa == 'Área de Spa')
                         - <i class="fa-solid fa-hot-tub-person"></i> {{ $hotelRelacionado->spa }}
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
                          <strong>PRECIO </strong> ( {{ $productos->moneda }} {{ $productos->precio_total }} )
                          <p class="a-confirmar">A Confirmar al momento de la reserva</p>
                        </p>
                    </div>
                    <div class="col-md-5">
                        <a href="#modalVuelos" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#modalVuelos">Consultar Lugares!!!</a>                       
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
  </div>
   <!-- Modal Consultar Lugares -->
 <div class="modal fade" id="modalVuelos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fas fa-question-circle"></i> Consulta por {{ $productos->destinos->nombre_destino }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"></span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Formulario para Cotizar Vuelos -->
        <form action="/consulta_viaje" method="post">
          @csrf
          <input type="hidden" name="id" value="{{ $productos->id }}">
          <div class="form-floating mb-3">
            <input type="number" name="adultos" placeholder="Cantidad Adultos" class="form-control" min="1" value="1">
            <label for="adultos" class="form-label">Cantidad Adultos:</label>
          </div>
          <div class="form-floating mb-3">
            <input type="number" name="menores" placeholder="Cantidad Menores" class="form-control" min="0" value="0">
            <label for="menores" class="form-label">Cantidad Menores:</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" name="nombre" placeholder="Cuál es tu Nombre ?" class="form-control" required>
            <label for="nombre" class="form-label">Cuál es tu Nombre ?</label>
          </div>
          <div class="form-floating mb-3">
            <input type="email" name="email" placeholder="Cuál es tu Email?" class="form-control" required>
            <label for="email" class="form-label">Cuál es tu Email?</label>
          </div>
          <div class="form-floating mb-3">
            <textarea name="consulta" placeholder="Déjanos acá tu consulta!!" class="form-control"></textarea>
            <label for="consulta" class="form-label">Déjanos acá tu consulta!!</label>
          </div>
          <button type="submit" class="btn btn-primary w-100">Enviar Consulta</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal respuesta cotizacion viajes -->
@if(session('success'))
<div class="modal fade" id="modalExito" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title"><i class="fa fa-check-circle"></i>
        ¡Gracias por tu consulta! Pronto nos comunicaremos contigo para brindarte toda la información que necesitas. ¡Hasta pronto!
        </h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"></span>
        </button>
      </div>
        <div class="modal-body">   
            <img src="{{ asset('assets/img_hoteles/' . $hotelData['hotel']->img_banner) }}" class="d-block w-100" alt=""> 
      </div>
      <div class="modal-footer">
        <p>Disfruta al máximo {{ $productos->destinos->nombre_destino }} !!</p>
      </div>
    </div>
  </div>
</div>
@endif
@endsection

        
       
        