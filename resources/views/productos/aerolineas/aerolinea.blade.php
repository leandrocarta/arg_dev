@extends('layouts.app-master')

@if (Auth::check() && Auth::user()->id_rango === 1)
@section('content')
<div class="container">
    @if(session('success'))
    <div class="alert alert-success mt-2">
        {{ session('success') }}
    </div>
    @endif

    <!-- Botón para crear nueva aerolínea -->
    <a href="{{ route('aerolineas.news') }}" class="btn btn-success mt-2">Crear Nueva Aerolínea</a>

    <h2>Listado de Aerolíneas y sus Productos</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Penalidad</th>
                <th>Aerolínea</th>
                <th>Cupos</th>
                <th>Descripción</th>                
                <th>Fecha Salida</th>                
                <th>Fecha Llegada</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($aerolineas as $aerolinea)
            <tr>
                <td>{{ $aerolinea->penalidad }}</td>
                <td>{{ $aerolinea->compania }}</td>
                <td>{{ $aerolinea->cupos }}</td>
                <td>{{ $aerolinea->descripcion }}</td>
                <td>{{ $aerolinea->fecha_inicio }}</td>
                <td>{{ $aerolinea->fecha_fin }}</td>
                <td>
                    <a href="{{ route('aerolineas.edit', $aerolinea->id) }}" class="btn btn-primary">Editar</a>                    
                        <form action="{{ route('aerolineas.destroy', $aerolinea->id) }}" method="POST" style="display:inline;">
                           @csrf
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta aerolínea?')">
                                Eliminar
                            </button>
                        </form>
                </td>
            </tr>
            @endforeach  
        </tbody>
    </table>
</div>
@endsection
@endif
