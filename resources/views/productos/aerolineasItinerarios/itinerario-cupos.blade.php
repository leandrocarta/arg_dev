@extends('layouts.app-master')

@section('content')
<div class="container">
    <h2>Listado de Itinerarios</h2>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <a href="{{ route('itinerario_cupos.news') }}" class="btn btn-success mb-3">Nuevo Itinerario</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID Cupo</th>
                <th>Num.Vuelo</th>
                <th>Origen</th>
                <th>Destino</th>
                <th>Fecha Salida</th>
                <th>Hora Salida</th>
                <th>Fecha Llegada</th>
                <th>Hora Llegada</th>
                <th>Cupos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($itinerarios as $itinerario)
            <tr>
                <td>{{ $itinerario->aerolinea_id }}</td>
                <td>{{ $itinerario->num_vuelo }}</td>
                <td>{{ $itinerario->origen }}</td>
                <td>{{ $itinerario->destino }}</td>
                <td>{{ $itinerario->fecha_salida }}</td>
                <td>{{ $itinerario->hora_salida }}</td>
                <td>{{ $itinerario->fecha_llegada }}</td>
                <td>{{ $itinerario->hora_llegada }}</td>
                <td>{{ $itinerario->cupos }}</td>
                <td>
                    <a href="{{ route('itinerario_cupos.edit', $itinerario->id) }}" class="btn btn-primary btn-sm">Editar</a>
                    <form action="{{ route('itinerario_cupos.destroy', $itinerario->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este itinerario?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
