@extends('layouts.app-master')

@section('content')
<div class="container-fluid detalles_productos">
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
                    <div class="banner_movil">
                        <div class="carousel-item filtro {{ $loop->first ? 'active' : '' }}">
                            <div class="card-img-container">
                                <img src="{{ asset('assets/img_hoteles/' . $hotelData['hotel']->img_banner) }}" class="d-block w-100" alt="">
                                <div class="titulo-detalles-prod">
                                    <h1><i class="fa-solid fa-location-dot me-2"></i> {{ $productos->destinos->ciudad_destino }}, {{ $productos->pais->nombre_img }}</h1>
                                    <h2><i class="fa-solid fa-hotel"></i> {{ $hotelData['hotel']->nombre }}</h2>
                                    @if ($productos->tipo_producto == 'Exclusivo Comunidad')
                                        <p class="exclusivo-detalles">Comunidad Argtravels (20% Descto.)</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p>No hay información disponible para este producto.</p>
            @endif
        </div>
    </div>
</div>
@if(Auth::guard('client')->check())
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="d-grid">
                <a href="{{ route('client.misViajes') }}" class="btn btn-secondary btn-lg shadow-sm">
                    <i class="fas fa-arrow-left"></i> Regresar a Mis Viajes
                </a>
            </div>
        </div>
    </div>
</div>
@endif
<div class="container my-2">
    <div class="row datos-generales">
        <div class="container">
            <div class="row">
                <div class="col-md-7 icon-detalles mb-2">
                    <div class="col-md-12">
                        <h2 class="mb-4">SERVICIO DEL PAQUETE</h2>
                    </div>
                    @if ($productos->service)
                        @php
                            $transporteAereo = $productos->service->transporte_int;
                        @endphp
                        <p class="mb-1">
                            @if ($transporteAereo == 'Aéreo Directo')
                                <i class="fas fa-plane-departure me-1"></i>
                                {{ $productos->origen_salida }} ⮂ {{ $productos->destinos->ciudad_destino }} NO INCLUYE AEREOS
                            @elseif ($transporteAereo == 'Aéreos con escala')
                                <i class="fas fa-plane-departure me-1"></i> Vuelos desde {{ $productos->origen_salida }} ⮂ {{ $productos->destinos->ciudad_destino }} <a
                                    href="#modalItinerario" data-bs-toggle="modal" style="color: rgb(255, 145, 0)">
                                    Ver itinerario aquí
                                </a>
                                <div class="modal fade" id="modalItinerario" tabindex="-1" aria-labelledby="modalItinerarioLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title" id="modalItinerarioLabel">
                                                    Itinerario: {{ $productos->origen_salida }} ⮂ {{ $productos->destinos->ciudad_destino }} ({{ $productos->aerolinea->compania }})
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                @if ($productos->aerolinea && $productos->aerolinea->itinerarios->isNotEmpty())
                                                    <div class="row">
                                                        @foreach ($productos->aerolinea->itinerarios as $itinerario)
                                                            <div class="col-12 col-md-3 mb-3">
                                                                <div class="card shadow-sm border-0">
                                                                    <div class="card-header bg-light">
                                                                        <strong>Vuelo: {{ $itinerario->num_vuelo }}</strong>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <p><strong>Origen:</strong> {{ $itinerario->origen }}</p>
                                                                        <p><strong>Destino:</strong> {{ $itinerario->destino }}</p>
                                                                        <p><strong>Fecha:</strong> {{ $itinerario->fecha_salida }}</p>
                                                                        <p><strong>Hora Salida:</strong> {{ $itinerario->hora_salida }}</p>
                                                                        <p><strong>Hora Llegada:</strong> {{ $itinerario->hora_llegada }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <p class="text-muted">No hay itinerarios disponibles para esta aerolínea.</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif ($transporteAereo == '')
                                <i class="fas fa-plane-departure me-1"></i>
                                <span>SE COTIZARA POR GRUPO</span>
                            @elseif ($transporteAereo == 'Micro - Vans')
                                <i class="fas fa-bus"></i>
                            @endif
                        </p>
                        <p class="mb-1"><i class="fas fa-bus me-1"></i> {{ $productos->service->traslados_dest }} <span>TRASLADOS PRIVADOS IN-OUT</span></p>
                        <p class="mb-1"><i class="fa-solid fa-cloud-moon"></i> INCLUYE ESTADIA de {{ $productos->estadia }} NOCHES.</p>
                        <p class="mb-1"><i class="fa-solid fa-kit-medical me-1"></i> {{ $productos->service->seguro }}</p>
                    @endif
                </div>
                <div class="col-md-5 icon-detalles mb-2">
                    @if (!empty($productos->youtube))
                        @php
                            preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $productos->youtube, $matches);
                            $youtube_id = $matches[1] ?? null;
                        @endphp

                        @if ($youtube_id)
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $youtube_id }}" allowfullscreen></iframe>
                            </div>
                        @else
                            <p>Video no disponible.</p>
                        @endif
                    @else
                        <p>No se proporcionó un enlace de YouTube.</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="container-fuid">
            <div class="row">
                <div class="col-md-12 info-paquete d-flex flex-column">
                    <div class="bg-light-detalles px-2 flex-grow-1">
                        <h4 class="mb-2">{{ $productos->destinos->ciudad_destino }}</h4>
                        <p class="mb-2">
                            @if($productos->destinos->detalle_gral)
                                {{ $productos->destinos->detalle_gral }}
                                <a data-bs-toggle="collapse" href="#collapseExample" style="color: orange" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    Leer más
                                </a>
                            @endif
                        </p>
                    </div>
                </div>
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
                        <h2 class="">¿Quieres saber más sobre {{ $productos->destinos->ciudad_destino }}?</h2>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="container mt-4">
                    <div class="row bg-light-detalles">
                        <div class="col-md-12">
                            @if($productos->destinos->ubicacion)
                                <p class="m-2">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span class="fw-bold">Ubicación:</span>
                                    {{ $productos->destinos->ubicacion }}
                                </p>
                                <hr>
                            @endif
                            @if($productos->destinos->playas)
                                <p class="m-2">
                                    <i class="fa-solid fa-umbrella-beach"></i>
                                    <span class="fw-bold">Playas:</span>
                                    {{ $productos->destinos->playas }}
                                </p>
                                <hr>
                            @endif
                            @if($productos->destinos->gastronomia)
                                <p class="m-2">
                                    <i class="fas fa-utensils"></i>
                                    <span class="fw-bold">Gastronomía:</span>
                                    {{ $productos->destinos->gastronomia }}
                                </p>
                                <hr>
                            @endif
                            @if($productos->destinos->atracciones)
                                <p class="m-2">
                                    <i class="fas fa-camera"></i>
                                    <span class="fw-bold">Atracciones:</span>
                                    {{ $productos->destinos->atracciones }}
                                </p>
                                <hr>
                            @endif
                            @if($productos->destinos->historia)
                                <p class="m-2">
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
        <div class="col-md-5">
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
                                    DETALLES:
                                @else
                                    OTROS:
                                @endif
                            </h5>
                            <div class="info-hotel">
                                <p><i class="fa-solid fa-hotel"></i> {{ $hotelRelacionado->nombre }}</p>
                                <p><i class="fa-solid fa-cloud-moon"></i> {{ $productos->$campoEstadia }} Noches</p>
                                <p><i class="fa-solid fa-bed"></i> {{ $productos->habitacion }}</p>
                                <p>
                                    @if ($productos->service->comidas == 'All Inclusive')
                                        <i class="fa-solid fa-bell-concierge"></i> {{ $productos->service->comidas }}
                                    @elseif ($productos->service->comidas == 'Desayuno')
                                        <i class="fa-solid fa-mug-saucer"></i> {{ $productos->service->comidas }}
                                    @elseif ($productos->service->comidas == 'Media Pensión')
                                        <i class="fa-solid fa-utensils"></i> {{ $productos->service->comidas }}
                                    @endif
                                </p>
                                <p><i class="fa-regular fa-calendar-days"></i> Salida {{ $productos->fecha_salida }}</p>
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
                                <p>Producto creado el {{ $productos->created_at }}</p>
                            </div>
                        </div>
                    @endif
                @endif
            @endforeach
            <hr>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <p>
                            @php
                                $descto_comunidad = $productos->descto;
                                $resul = $productos->precio_total * $descto_comunidad;
                            @endphp
                            @if ($productos->tipo_producto == 'Exclusivo Comunidad')
                                <strong>PRECIO: </strong> {{ $productos->moneda }} <s>{{ $productos->precio_total }}</s>
                                <p>Comunidad Argtravels {{ $productos->moneda . ' ' . $resul }}</p>
                                <p class="a-confirmar">Por Pax en Habitación doble</p>
                                <p class="a-confirmar">Consultar por otro tipo de habitación</p>
                            @else
                                <strong>PRECIO: </strong> ({{ $productos->moneda }} {{ $productos->precio_total }})
                                <p class="a-confirmar">Por Pax en Habitación doble</p>
                                <p class="a-confirmar">Consultar por otro tipo de habitación</p>
                                <p class="text-center my-4">
                                    <a href="https://api.whatsapp.com/send?phone=543413672066" target="_blank" class="btn-whatsapp">
                                        <i class="whatsapp fab fa-whatsapp"></i> ¡Haz clic aquí y envíanos tu consulta con el N° de REF: {{ $productos->id }}!
                                    </a>
                                </p>
                            @endif
                        </p>
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
    <div class="row">
        <div class="col-md-12">
            @if ($productos->detalles)
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <p><strong>NOTA: </strong> {{ $productos->detalles }}</p>
                        </div>
                    </div>
                @endif
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
                    <input type="hidden" name="tipo_prod" value="{{ $productos->tipo_producto }}">
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
<!-- Modal respuesta cotización viajes -->
@if(session('success'))
    <div class="modal fade" id="modalExito" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">
                        <i class="fa fa-check-circle"></i>
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
                    <p>{{ $productos->destinos->nombre_destino }}: ¡Es un Excelente Destino!</p>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection

