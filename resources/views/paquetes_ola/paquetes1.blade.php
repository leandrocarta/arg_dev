
@extends('layouts.app-master')
@section('content')
<div class="container my-3 m-auto productos-detalles home-iconos">
    <div class="titulo text-center">
        <h4 class="display-4">Paquetes Disponibles</h4>
    </div>
    <div class="row">
        @foreach ($paquetes as $paquete)
        <div class="col-md-4 p-2">
            <div class="card productosCrucero">
                <div style="position: relative; overflow: hidden;">
                    <div class="card-img-container" style="padding-top: 100%;">
                        <img 
                             src="{{ $paquete['imagenes'][0] ?? asset('ruta/a/imagen/default.jpg') }}" 
                             srcset="{{ $paquete['imagenes'][0] }} 1x, {{ $paquete['imagenes_hd'][0] ?? $paquete['imagenes'][0] }} 2x"
                             class="card-img-top img-fluid img-paquete" 
                             alt="{{ $paquete['titulo'] }}" 
                         >
                        <div class="card-img-overlay titulo-prod-cruceros">
                            <p>REF: N° {{ $paquete['codigo_paquete'] }}</p>
                            <h5><i class="fa-solid fa-location-dot me-1"></i> {{ $paquete['titulo'] }}</h5>
                            <p><i class="fa-solid fa-calendar-days"></i> Fecha de salida: {{ $paquete['fecha_salida'] }}</p>
                            <p><i class="fa-solid fa-moon"></i> Noches: {{ $paquete['noches'] }}</p>
                            @if($paquete['incluye_aereo'])
                                <p><i class="fa-solid fa-plane"></i> Incluye Aéreos</p>
                            @elseif($paquete['incluye_bus'])
                                <p><i class="fa-solid fa-bus"></i> Incluye Bus</p>
                            @else
                                <p><i class="fa-solid fa-circle-exclamation"></i> Transporte no incluido</p>
                            @endif
                            <h3 class="precio_home"><span class="usd">{{ $paquete['moneda'] }} </span> {{ $paquete['precio'] }}</h3>
                        </div>
                    </div>
                </div>
                <div class="w-100 btn-crucero">
                    <a href="#" class="btn btn-primary w-100">VER ITINERARIO</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>   
</div>



    @endsection