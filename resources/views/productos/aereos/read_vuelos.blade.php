@extends('layouts.app-master')
@if (Auth::check() && Auth::user()->id_rango === 1)
@section('content')
<div class="container">
    @if(session('success'))
    <div class="alert alert-success mt-2">
        {{ session('success') }}
    </div>
    @endif
    <a href="{{ route('vuelos.create') }}" class="btn btn-success mt-2">Crear Nuevo Producto</a>
    <h2>Listado de Vuelos</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Titulo</th>
                <th>Código</th>
                <th>Tipo Producto</th>
                <th>País</th>
                <th>Ciudad Destino</th>                
                <th>Precio Total</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
            <tr>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->codigo }}</td>
                <td>{{ $producto->tipo_producto }}</td>                
                <td>{{ $producto->pais_destino }}</td>
                <td>{{ $producto->ciudad_destino }}</td>
                <td>{{ $producto->precio_total }}</td>
                <td>
                    <a href="{{ route('producto.update', $producto->id) }}" class="btn btn-primary">Editar</a>                    
                </td>
                <td>
                    <form action="{{ route('producto.delete', $producto->id) }}" method="POST">
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