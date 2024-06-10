@extends('layouts.app-master')

@if (Auth::check() && Auth::user()->id_rango === 1)
@section('content')
<div class="container">
    @if(session('success'))
    <div class="alert alert-success mt-2">
        {{ session('success') }}
    </div>
    @endif
    <a href="{{ route('hotel.store') }}" class="btn btn-success mt-2">Crear Hotel</a>
    <h2>Listado de Hoteles</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre Hotel</th>
                <th>Categoría</th>
                <th>Ciudad</th>
                <th>Pais</th>
                <th>Tipo Publico?</th>                          
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hoteles as $hotel)
            <tr>
                <td>{{ $hotel->id }}</td>
                <td>{{ $hotel->nombre }}</td>
                <td>{{ $hotel->categoria }}</td>
                <td>{{ $hotel->destino->ciudad_destino }}</td>
                <td>{{ $hotel->pais->nombre_img }}</td>
                <td>{{ $hotel->tipo_publico }}</td>
                <td>
                    <a href="{{ route('hotel.update', $hotel->id) }}" class="btn btn-primary">Editar</a>                    
                </td>
                <td>
                    <form action="{{ route('hotel.delete', $hotel->id) }}" method="POST">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@endif