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
              <p>EDITAR NAVIERA</p>  
                <form class="form-horizontal" method="POST" action="{{ route('naviera.update', ['id' => $naviera->id]) }}">
                        {{ csrf_field() }}                        
                        <div class="form-group">
                            <label for="naviera" class="col-md-4 control-label">Nombre</label>
                            <div class="">
                                <input type="text" class="form-control" name="naviera" value="{{ $naviera->nombre }}" required>
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