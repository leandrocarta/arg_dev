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
              <p>EDITAR COTIZACION VUELOS</p>  
    <form class="form-horizontal" method="POST" action="{{ route('cotiAereo.updateProcess', ['id' => $aereos->id]) }}" enctype="multipart/form-data">                      
          @csrf
          <div class="form-floating mb-1">
              <input type="number" name="estado" class="form-control" value="{{ $aereos->estado }}">
              <label for="menores" class="form-label">¿Estado Respuesta?</label>
          </div>
          <div class="form-floating mb-3">
            <input type="date" name="fecha_ida" class="form-control" value="{{ $aereos->fecha_ida }}">
            <label for="fecha_ida" class="form-label">Fecha Partida:</label>
          </div>
          <div class="form-floating mb-3">
            <input type="date" name="fecha_regreso" class="form-control" value="{{ $aereos->fecha_regreso }}">
            <label for="fecha_regreso" class="form-label">Fecha Regreso si Corresponde :</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" name="origen" placeholder="Ciudad de Origen" class="form-control" value="{{ $aereos->origen }}">
            <label for="origen" class="form-label">Ciudad de Origen:</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" name="destino" placeholder="Ciudad Destino" class="form-control" value="{{ $aereos->destino }}">
            <label for="destino" class="form-label">Ciudad Destino:</label>
          </div>
          <div class="form-floating mb-1">
            <input type="number" name="adultos" class="form-control" value="{{ $aereos->adultos }}">
            <label for="adultos" class="form-label">¿Cantidad de adultos?</label>
          </div>
          <div class="form-floating mb-1">
              <input type="number" name="menores" class="form-control" value="{{ $aereos->menores }}">
              <label for="menores" class="form-label">¿Cantidad de menores?</label>
          </div>
          <div class="form-floating mb-3">
            <input type="email" name="email" placeholder="Email de Contacto" class="form-control" value="{{ $aereos->email }}">
            <label for="email" class="form-label">Email de Contacto:</label>
          </div>
          <div class="form-floating mb-3">
            <textarea name="aclaracion" placeholder="Tenes algo para aclararnos?" class="form-control" value="{{ $aereos->aclaracion }}"></textarea>
            <label for="email" class="form-label">Tenes algo que aclarar?</label>
          </div>
          <button type="submit" class="btn btn-primary w-100">Enviar</button>
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