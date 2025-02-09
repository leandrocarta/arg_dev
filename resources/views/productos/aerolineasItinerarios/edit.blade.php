@extends('layouts.app-master')
@section('content')
<div class="container">
    <h2>Editar Itinerario</h2>

    <form action="{{ route('itinerario_cupos.update', $itinerario->id) }}" method="POST">
        @csrf

        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        
        <div class="mb-3">
            <label for="num_vuelo" class="form-label">Numero de Vuelo</label>
            <input type="text" name="num_vuelo" id="origen" class="form-control" value="{{ $itinerario->num_vuelo }}" required>
        </div>

        <div class="mb-3">
            <label for="aerolinea_id" class="form-label">Aerolinea</label>
            <select name="aerolinea_id" id="aerolinea_id" class="form-select" required>
                <option value="" disabled>Selecciona una aerolínea</option>
                @foreach ($aerolineas as $aerolinea)
                    <option value="{{ $aerolinea->id }}" {{ $itinerario->aerolinea_id == $aerolinea->id ? 'selected' : '' }}>
                        {{ $aerolinea->id }} - {{ $aerolinea->compania }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="origen" class="form-label">Origen</label>
            <input type="text" name="origen" id="origen" class="form-control" value="{{ $itinerario->origen }}" required>
        </div>

        <div class="mb-3">
            <label for="destino" class="form-label">Destino</label>
            <input type="text" name="destino" id="destino" class="form-control" value="{{ $itinerario->destino }}" required>
        </div>

        <div class="mb-3">
            <label for="hora_salida" class="form-label">Hora Salida</label>
            <input type="time" name="hora_salida" id="hora_salida" class="form-control" value="{{ $itinerario->hora_salida }}" required>
        </div> 
 
         <div class="mb-3">
            <label for="hora_llegada" class="form-label">Hora Llegada</label>
            <input type="time" name="hora_llegada" id="hora_llegada" class="form-control" value="{{ $itinerario->hora_llegada }}" required>
        </div>

        <div class="mb-3">
            <label for="fecha_salida" class="form-label">Fecha Salida</label>
            <input type="date" name="fecha_salida" id="fecha_salida" class="form-control" value="{{ $itinerario->fecha_salida }}" required>
        </div>        

        <div class="mb-3">
            <label for="fecha_llegada" class="form-label">Fecha Llegada</label>
            <input type="date" name="fecha_llegada" id="fecha_llegada" class="form-control" value="{{ $itinerario->fecha_llegada }}" required>
        </div>     
        <button type="submit" class="btn btn-success">Actualizar</button>
    </form>
</div>
@endsection
