@extends('layouts.app-master')
@if (Auth::check() && Auth::user()->id_rango === 1)
@section('content')
<div class="container">
    @if(session('success'))
    <div class="alert alert-success mt-2">
        {{ session('success') }}
    </div>
    @endif
    <a href="{{ route('crucero.create') }}" class="btn btn-success mt-2">Nuevo Crucero</a>
    <h2>Listado de Cruceros</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Destino</th>
                <th>Fecha</th>
                <th>Estadia</th>
                <th>Puerto</th>
                <th>Naviera</th>                
                <th>Barco</th>                
                <th>Cabina</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
            <tr>
                <td>{{ $producto->id }}</td>
                <td>{{ $producto->destino }}</td>
                <td>{{ $producto->fecha_partida }}</td>
               <td>{{ $producto->estadia }}</td>                
                <td>{{ $producto->puerto_salida }}</td>
                <td>{{ $producto->naviera }}</td>
                 <td>{{ $producto->nombre_barco }}</td>
                <td>{{ $producto->tipo_cabina }}</td>
                <td>
                   <!-- <a href="{{ route('producto.update', $producto->id) }}" class="btn btn-primary">Editar</a>  -->                  
                </td>
                <td>
                <!--    <form action="{{ route('producto.delete', $producto->id) }}" method="POST">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form> -->
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@endif