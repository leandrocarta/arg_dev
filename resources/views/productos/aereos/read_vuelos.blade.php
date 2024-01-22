@extends('layouts.app-master')
@if (Auth::check() && Auth::user()->id_rango === 1)
@section('content')
<div class="container">
    @if(session('success'))
    <div class="alert alert-success mt-2">
        {{ session('success') }}
    </div>
    @endif
     <p class="a my-3">
         <a class="btn btn-danger" data-bs-toggle="collapse" href="#consultaVuelos" role="button" aria-expanded="false" aria-controls="collapseExample">
            Cotizador de Vuelos
          </a> 
          <a class="btn btn-primary" data-bs-toggle="collapse" href="#listadoVuelos" role="button" aria-expanded="false" aria-controls="collapseExample">
            Listado de Vuelos
          </a>   
          <a href="{{ route('vuelos.create') }}" class="btn btn-success">Crear Nuevo Producto</a>
        </p>
        <div class="collapse" id="consultaVuelos">
          <div class="card card-body">             
            <h2>Listado de Vuelos</h2>
              <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha Ida</th>
                        <th>Fecha Vuelta</th>
                        <th>Origen</th>
                        <th>Destino</th>
                        <th>Adultos</th>                
                        <th>Menores</th>
                        <th>Email</th>
                        <th>Mensaje</th>                
                        <th>Estado</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach ($cotiAereos as $cotiAereo)
                     <tr>
                         <td>{{ $cotiAereo->id }}</td>
                         <td>{{ $cotiAereo->fecha_ida }}</td>
                         <td>{{ $cotiAereo->fecha_regreso }}</td>                
                         <td>{{ $cotiAereo->origen }}</td>
                         <td>{{ $cotiAereo->destino }}</td>
                         <td>{{ $cotiAereo->adultos }}</td>
                         <td>{{ $cotiAereo->menores }}</td>
                         <td>{{ $cotiAereo->email }}</td>
                         <td>{{ $cotiAereo->aclaracion }}</td>
                         <td>{{ $cotiAereo->estado }}</td>
                         <td>
                            <a href="{{ route('cotiAereo.update', $cotiAereo->id) }}" class="btn btn-primary">Editar</a>                    
                         </td>
                         <td>
                             <form action="{{ route('cotiAereo.delete', $cotiAereo->id) }}" method="POST">
                                 {{ csrf_field() }}
                                 <button type="submit" class="btn btn-danger">Eliminar</button>
                             </form>
                         </td>
                     </tr>
                    @endforeach
                </tbody>
            </table>        
          </div>
        </div>  
        <div class="collapse" id="listadoVuelos">
          <div class="card card-body">             
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
                <!--   @foreach ($productos as $producto)
                     <tr>
                         <td></td>
                         <td></td>
                         <td></td>                
                         <td></td>
                         <td></td>
                         <td></td>
                         <td>
                            <a href="" class="btn btn-primary">Editar</a>                    
                         </td>
                         <td>
                             <form action="" method="POST">
                                 {{ csrf_field() }}
                                 <button type="submit" class="btn btn-danger">Eliminar</button>
                             </form>
                         </td>
                     </tr>
                    @endforeach -->
                </tbody>
            </table>        
          </div>
        </div>    
  </div>
@endsection
@endif