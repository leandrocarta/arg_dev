@extends('layouts.app-master')

@if (Auth::check() && Auth::user()->id_rango === 1)
@section('content')
<div class="container w-50 form-edit">
    <div class="row">
        <div class="col conten-login">
            <p>EDITAR AEROLÍNEA</p>
            <form class="form-horizontal" method="POST" action="{{ route('aerolineas.update', $aerolinea->id) }}">
                @csrf
                @method('PUT')
                
                <div class="mb-3 form-group form-floating">
                    <input type="date" class="form-control" name="penalidad" value="{{ $aerolinea->penalidad }}" placeholder="Fecha Penalidad" required>
                    <label for="penalidad" class="control-label">Fecha Penalidad</label>
                </div>
                <!-- Campo para el Nombre -->
                <div class="mb-3 form-group form-floating">
                    <input type="text" class="form-control" name="compania" value="{{ $aerolinea->compania }}" placeholder="Nombre de la Aerolínea" required>
                    <label for="compania" class="control-label">Nombre de la Aerolínea</label>
                </div>

                <!-- Campo para la Descripción -->
                <div class="mb-3 form-group form-floating">
                    <textarea class="form-control" name="descripcion" placeholder="Descripción" rows="10">{{ $aerolinea->descripcion }}</textarea>
                    <label for="descripcion" class="control-label">Descripción</label>
                </div>

                <!-- Campo para la Fecha de Inicio -->
                <div class="mb-3 form-group form-floating">
                    <input type="date" class="form-control" name="fecha_inicio" value="{{ $aerolinea->fecha_inicio }}" placeholder="Fecha de Inicio" required>
                    <label for="fecha_inicio" class="control-label">Fecha de Inicio</label>
                </div>

                <!-- Campo para la Fecha de Fin -->
                <div class="mb-3 form-group form-floating">
                    <input type="date" class="form-control" name="fecha_fin" value="{{ $aerolinea->fecha_fin }}" placeholder="Fecha de Fin" required>
                    <label for="fecha_fin" class="control-label">Fecha de Fin</label>
                </div>

                <!-- Botón para guardar -->
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary">
                        ACTUALIZAR
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
