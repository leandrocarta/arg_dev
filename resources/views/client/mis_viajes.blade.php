 @extends('layouts.app-master')
@section('content')
<h1>Lista de Viajes</h1>
<table>
    <thead>
        <tr>
            <th>Cliente</th>
            <th>Destino</th>
            <th>Hotel</th>
            <th>Fecha de Inicio</th>
            <th>Fecha de Fin</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($viajes as $viaje)
        <tr>
            <td>{{ $viaje->client->nombre }}</td>
            <td>{{ $viaje->destino->ciudad_destino }}</td>
            <td>{{ $viaje->hotel->nombre }}</td>
            <td>{{ $viaje->fecha_inicio }}</td>
            <td>{{ $viaje->fecha_fin }}</td>
            <td>{{ $viaje->estado }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
