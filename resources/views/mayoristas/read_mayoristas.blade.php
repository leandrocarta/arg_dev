@extends('layouts.app-master')
@if (Auth::check() && Auth::user()->id_rango === 1)
@section('content')
<div class="container">
    @if(session('success'))
    <div class="alert alert-success mt-2">
        {{ session('success') }}
    </div>
    @endif
    <a href="{{ route('mayorista.new') }}" class="btn btn-success mt-2">Crear Nuevo Proveedor</a>
    <h2>Listado de Proveedores</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Empresa</th>
                <th>Contacto</th>
                <th>Dirección </th>
                <th>Teléfono</th>
                <th>email</th>             
                <th>Provincia</th>
                <th>País</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mayoristas as $mayorista)
            <tr>
                <td>{{ $mayorista->id }}</td>
                <td>{{ $mayorista->empresa }}</td>
                <td>{{ $mayorista->contacto }}</td>
                <td>{{ $mayorista->direccion }}</td>
               <td>{{ $mayorista->telefono }}</td>     
               <td>{{ $mayorista->email }}</td>  
                <td>{{ $mayorista->provincia }}</td>
                <td>{{ $mayorista->pais }}</td>
                <td>
                    <a href="{{ route('mayorista.update', $mayorista->id) }}" class="btn btn-primary">Editar</a>                    
                </td>
                <td>
                    <form action="{{ route('mayorista.delete', $mayorista->id) }}" method="POST">
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