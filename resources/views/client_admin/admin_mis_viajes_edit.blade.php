@extends('layouts.app-master')

@if (Auth::check() && Auth::user()->id_rango === 1)
@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="mb-0"><i class="fas fa-edit"></i> Editar Viaje</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('mis_viajes.update', $viaje->id) }}">
                        @csrf

                        <!-- Cliente -->
                        <div class="mb-3">
                            <label for="client_id" class="form-label"><i class="fas fa-user"></i> Cliente</label>
                            <select name="client_id" id="client_id" class="form-select" required>
                                @foreach ($clients as $client)
                                <option value="{{ $client->id }}" {{ $viaje->client_id == $client->id ? 'selected' : '' }}>
                                    {{ $client->nombre }} {{ $client->apellido }}
                                </option>
                                @endforeach
                            </select>
                        </div>                       
                        <div class="mb-3">
                            <label for="id_producto" class="form-label"><i class="fas fa-box"></i> Paquete</label>
                            <select name="id_producto" id="id_producto" class="form-select" required>
                              <option value="">Seleccione un paquete</option>
                              @foreach ($productos as $producto)
                              <option value="{{ $producto->id }}" data-hotel="{{ $producto->id_hotel }}" data-precio="{{ $producto->precio_total }}" 
                                   {{ $viaje->id_producto == $producto->id ? 'selected' : '' }}>
                                   {{ $producto->titulo }} - ${{ number_format($producto->precio_total, 2) }}
                               </option>
                               @endforeach
                            </select>
                        </div>

                        <!-- Hotel -->
                        <div class="mb-3">
                            <label for="hotel_id" class="form-label"><i class="fas fa-hotel"></i> Hotel</label>
                            <select name="hotel_id" id="hotel_id" class="form-select" required>
                                @foreach ($hotels as $hotel)
                                <option value="{{ $hotel->id }}" {{ $viaje->hotel_id == $hotel->id ? 'selected' : '' }}>
                                    {{ $hotel->nombre }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Valor del Viaje -->
                        <div class="mb-3">
                            <label for="valor_viaje" class="form-label"><i class="fas fa-money-bill"></i> Valor del Viaje</label>
                            <input type="number" step="0.01" name="valor_viaje" id="valor_viaje" class="form-control" value="{{ $viaje->valor_viaje }}" required>
                        </div>

                        <!-- Fechas -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="fecha_inicio" class="form-label"><i class="fas fa-calendar-alt"></i> Fecha de Inicio</label>
                                <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" value="{{ $viaje->fecha_inicio }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="fecha_fin" class="form-label"><i class="fas fa-calendar-alt"></i> Fecha de Fin</label>
                                <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" value="{{ $viaje->fecha_fin }}" required>
                            </div>
                        </div>

                        <!-- Estado -->
                        <div class="mb-3">
                            <label for="estado" class="form-label"><i class="fas fa-info-circle"></i> Estado</label>
                            <select name="estado" id="estado" class="form-select" required>
                                <option value="pendiente" {{ $viaje->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="confirmado" {{ $viaje->estado == 'confirmado' ? 'selected' : '' }}>Confirmado</option>
                                <option value="completado" {{ $viaje->estado == 'completado' ? 'selected' : '' }}>Completado</option>
                            </select>
                        </div>

                        <!-- Notas -->
                        <div class="mb-3">
                            <label for="notas" class="form-label"><i class="fas fa-sticky-note"></i> Notas</label>
                            <textarea name="notas" id="notas" class="form-control" rows="3">{{ $viaje->notas }}</textarea>
                        </div>

                        <!-- Botones -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.misViajes') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Regresar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@else
@section('content')
<div class="container text-center mt-5">
    <div class="alert alert-danger">
        <h4><i class="fas fa-ban"></i> Acceso Denegado</h4>
        <p>No tienes permiso para ver esta página.</p>
    </div>
</div>
@endif
@endsection