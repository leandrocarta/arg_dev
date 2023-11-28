@extends('layouts.app-master')

@if (Auth::check() && Auth::user()->id_rango === 1)
@section('content')
     <div class="container w-50 form-edit">
        <div class="row">
           <div class="col conten-login">   
            @if(session('success'))
              <div class="alert alert-success mt-2">
              {{ session('success') }}
              </div>
            @endif
              <p>EDITAR PRODUCTO</p>  
                <form class="form-horizontal" method="POST" action="{{ route('hotel.updateProcess', ['id' => $hotel->id]) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}                        
                        <div class="form-group">
                            <label for="nombre" class="col-md-4 control-label">Nombre Hotel</label>
                            <div class="">
                                <input type="text" class="form-control" name="nombre" value="{{ $hotel->nombre }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="codigo" class="col-md-4 control-label">Categoria Hotel</label>
                            <div class="">
                                <input type="text" class="form-control" name="categoria" value="{{ $hotel->categoria }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                           <label for="publico" class="col-md-4 control-label">¿Apto todo Publico?</label>
                            <div class="">
                                <select name="publico" class="form-select" aria-label="Default select example">  
                                    @if ($hotel->publico)
                                      <option value="{{ $hotel->publico }}" selected>
                                        {{ $hotel->publico }}
                                      </option>
                                    @endif
                                   <option value="Publico">Apto Publico</option>
                                   <option value="Niños Mayores de 6 años">Niños Mayores de 6 años</option>
                                   <option value="Solo Adultos">Solo Adultos</option>
                                </select>  
                            </div>
                        </div>   
                        <div class="mt-2">
                           <button type="submit" class="btn btn-primary">
                               Guardar Cambios
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