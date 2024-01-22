@extends('layouts.app-master')
@if (Auth::check() && Auth::user()->id_rango === 1)
@section('content')
<div class="container">
    @if(session('success'))
    <div class="alert alert-success mt-2">
        {{ session('success') }}
    </div>
    @endif
    <a href="{{ route('destinos.form') }}" class="btn btn-success mt-2">Crear Nuevo Destino</a>
    <h2>Listado de Destinos</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre Destino</th>
                <th>País Destino</th>               
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($destinos as $destino)
            <tr>
                <td>{{ $destino->id }}</td>
                <td>{{ $destino->nombre_destino }}</td>
                <td>{{ $destino->id_pais }}</td>
                <td>
                    <a href="{{ route('destino.update', $destino->id) }}" class="btn btn-primary">Editar</a>                    
                </td>
                <td>
                    <form action="{{ route('destino.delete', $destino->id) }}" method="POST">
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