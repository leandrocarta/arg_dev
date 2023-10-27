@extends('layouts.app-master')

@if (Auth::check() && Auth::user()->id_rango === 1)
@section('content')
     <div class="container w-50 form-edit">
        <div class="row">
           <div class="col conten-login">   
            <p>ALTA DE HOTELES</p>       
                 <form class="form-horizontal" method="POST" action="{{ route('hotel.store') }}">
                     {{ csrf_field() }}
                     <div class="form-group">
                         <label for="nombre" class="control-label">Nombre del Hotel</label>
                         <div>
                             <input id="nombre" type="text" class="form-control" name="nombre" required>
                        </div>
                     </div>
                     <label for="categoria" class="control-label">Categoría del Hotel</label>
                     <div>
                        <input id="categoria" type="number" class="form-control" name="categoria" required>
                     </div>    
                     <div class="mt-2">
                        <button type="submit" class="btn btn-primary">
                            Crear Producto Hotel
                        </button>
                    </div>
                </form>                    
            </div>
        </div>
    </div>
@endsection
@else
    @section('content')
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Acceso no autorizado</div>
                        <div class="panel-body">
                            <p>No tienes permiso para acceder a esta página.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
@endif