@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="card p-4">
        <!-- Título y Descripción del Paquete -->
        <h1 class="display-4">{{ $packageDetails['name'] }}</h1>
        <p>{{ $packageDetails['description'] }}</p>

        <!-- Imágenes del Paquete -->
        <div class="row my-4">
            @foreach($packageDetails['pictures'] as $picture)
                <div class="col-md-3 mb-3">
                    <img src="{{ $picture }}" alt="Imagen del Paquete" class="img-fluid">
                </div>
            @endforeach
        </div>

        <!-- Detalles del Vuelo -->
        <h3>Detalles del Vuelo</h3>
        @foreach($packageDetails['flights'] as $flight)
            <div class="mb-4">
                <h5>Aerolínea: {{ $flight['supplier']['name'] }}</h5>
                <img src="{{ $flight['supplier']['image'] }}" alt="{{ $flight['supplier']['name'] }}" class="mb-3">
                @foreach($flight['trips'] as $trip)
                    <p><strong>Salida:</strong> {{ $trip['departureCity'] }} - {{ $trip['departureAirport'] }} el {{ $trip['departureDate'] }} a las {{ $trip['departureHour'] }}</p>
                    <p><strong>Llegada:</strong> {{ $trip['arrivalCity'] }} - {{ $trip['arrivalAirport'] }} el {{ $trip['arrivalDate'] }} a las {{ $trip['arrivalHour'] }}</p>
                    <p><strong>Paradas:</strong> {{ $trip['stops'] }}</p>
                    <hr>
                @endforeach
            </div>
        @endforeach

        <!-- Detalles de los Hoteles -->
        <h3>Alojamiento</h3>
        @foreach($packageDetails['hotels'] as $hotel)
            <div class="mb-4">
                <h5>{{ $hotel['name'] }} - {{ $hotel['hotelClass'] }} estrellas</h5>
                <p>{{ $hotel['description'] }}</p>
                <div class="row">
                    @foreach($hotel['pictures'] as $picture)
                        <div class="col-md-3 mb-3">
                            <img src="{{ $picture }}" alt="Imagen del Hotel" class="img-fluid">
                        </div>
                    @endforeach
                </div>
                <p><strong>Noches:</strong> {{ $hotel['nights'] }}</p>
                <hr>
            </div>
        @endforeach

        <!-- Políticas de Cancelación -->
        <h3>Políticas de Cancelación</h3>
        <ul>
            @foreach($packageDetails['cancellationPolicies'] as $policy)
                <li>{{ $policy['from'] }} a {{ $policy['to'] }} días antes: ${{ $policy['amount'] }}</li>
            @endforeach
        </ul>

        <!-- Notas de Tarifas -->
        <h3>Notas Importantes</h3>
        <ul>
            @foreach($packageDetails['fareNotes'] as $note)
                <li>{{ $note }}</li>
            @endforeach
        </ul>

        <!-- Precio Total -->
        <h2 class="mt-4">Precio: {{ $packageDetails['price']['currency'] }} {{ $packageDetails['price']['net'] }}</h2>
    </div>
</div>
@endsection
