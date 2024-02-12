@extends('layouts.app-master')
@if (Auth::check() && Auth::user()->id_rango === 1)
@section('content')
<div class="container">
    @if(session('success'))
    <div class="alert alert-success mt-2">
        {{ session('success') }}
    </div>
    @endif
    <a href="{{ route('barco.create') }}" class="btn btn-success mt-2">NUEVO BARCO</a>
    <h2>LISTADO DE BARCOS</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Naviera</th>
                <th>Nombre Barco</th>                               
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barcos as $barco)
            <tr>
                <td>{{ $barco->id }}</td>
                <td>{{ $barco->id_naviera }}</td>                
                <td>{{ $barco->nombre }}</td>
                <td>
                    <a href="{{ route('barco.edit', $barco->id) }}" class="btn btn-primary">Editar</a>                  
                </td>
                <td>
                    <form action="{{ route('barco.delete', $barco->id) }}" method="POST">
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