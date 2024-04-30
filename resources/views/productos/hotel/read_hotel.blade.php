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
                <th>Apto Todo Publico?</th>  
                <th>Gastronomía</th>
                <th>Wifi</th>  
                <th>Gym</th>
                <th>Spa</th>  
                <th>Parking</th>
                <th>Traslados</th>             
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
                <td>{{ $hotel->publico }}</td>
                <td>{{ $hotel->comidas }}</td>
                <td>{{ $hotel->wifi }}</td>
                <td>{{ $hotel->gym }}</td>
                <td>{{ $hotel->spa }}</td>
                <td>{{ $hotel->parking }}</td>
                <td>{{ $hotel->traslados }}</td>
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