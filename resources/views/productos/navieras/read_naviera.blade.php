@extends('layouts.app-master')
@if (Auth::check() && Auth::user()->id_rango === 1)
@section('content')
<div class="container">
    @if(session('success'))
    <div class="alert alert-success mt-2">
        {{ session('success') }}
    </div>
    @endif
    <a href="{{ route('naviera.create') }}" class="btn btn-success mt-2">Nueva Naviera</a>
    <h2>Listado de Navieras</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Naviera</th>                               
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($navieras as $naviera)
            <tr>
                <td>{{ $naviera->id }}</td>                
                <td>{{ $naviera->nombre }}</td>
                <td>
                    <a href="{{ route('naviera.edit', $naviera->id) }}" class="btn btn-primary">Editar</a>                  
                </td>
                <td>
                    <form action="{{ route('naviera.delete', $naviera->id) }}" method="POST">
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