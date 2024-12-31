@extends('layouts.app-master')

@section('content')
<div class="container">
    <h2>Crear Nuevo Itinerario</h2>

    <form action="{{ route('itinerario_cupos.store') }}" method="POST">
        @csrf 
        <div class="mb-3">
            <label for="num_vuelo" class="form-label">Numero de Vuelo</label>
            <input type="text" name="num_vuelo" id="origen" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="aereos_id" class="form-label">Aéreo</label>
            <select name="aerolinea_id" id="aerolinea_id" class="form-select" required>
              <option value="" disabled selected>Seleccione cupo aéreo</option>
                 @foreach ($aerolineas as $aerolinea)
                     <option value="{{ $aerolinea->id }}">{{ $aerolinea->id }} - {{ $aerolinea->compania }}</option>
                 @endforeach
             </select>
        </div>
        <div class="mb-3">
            <label for="origen" class="form-label">Origen</label>
            <input type="text" name="origen" id="origen" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="destino" class="form-label">Destino</label>
            <input type="text" name="destino" id="destino" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="fecha_salida" class="form-label">Fecha Salida</label>
            <input type="date" name="fecha_salida" id="fecha_salida" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="hora_salida" class="form-label">Hora Salida</label>
            <input type="time" name="hora_salida" id="hora_salida" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="fecha_llegada" class="form-label">Fecha Llegada</label>
            <input type="date" name="fecha_llegada" id="fecha_llegada" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="hora_llegada" class="form-label">Hora Llegada</label>
            <input type="time" name="hora_llegada" id="hora_llegada" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="cupos" class="form-label">Cupos</label>
            <input type="number" name="cupos" id="cupos" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection
