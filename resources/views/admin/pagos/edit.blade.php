@extends('layouts.app-master')

@section('content')
@if (Auth::check() && Auth::user()->id_rango === 1)
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-lg">
                <div class="card-header bg-warning text-white text-center">
                    <h3 class="mb-0"><i class="fas fa-edit"></i> Editar Pago</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.pagos.update', $pago->id) }}">
                        @csrf
                        <!-- Cliente -->
                        <div class="mb-3">
                            <label for="client_id" class="form-label"><i class="fas fa-user"></i> Cliente</label>
                            <select name="client_id" id="client_id" class="form-select" required>
                                @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id }}" {{ $pago->client_id == $cliente->id ? 'selected' : '' }}>
                                    {{ $cliente->nombre }} {{ $cliente->apellido }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Viaje -->
                        <div class="mb-3">
                            <label for="mis_viajes_id" class="form-label"><i class="fas fa-map-marker-alt"></i> Viaje</label>
                            <select name="mis_viajes_id" id="mis_viajes_id" class="form-select" required>
                                @foreach ($viajes as $viaje)
                                <option value="{{ $viaje->id }}" {{ $pago->mis_viajes_id == $viaje->id ? 'selected' : '' }}>
                                   ID: {{ $viaje->id }} - Paquete: {{ $viaje->producto->titulo ?? 'No asignado' }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Monto Pagado -->
                        <div class="mb-3">
                            <label for="monto_pagado" class="form-label"><i class="fas fa-dollar-sign"></i> Monto Pagado</label>
                            <input type="number" step="0.01" name="monto_pagado" id="monto_pagado" class="form-control" value="{{ $pago->monto_pagado }}" required>
                        </div>

                        <!-- Método de Pago -->
                        <div class="mb-3">
                            <label for="metodo_pago" class="form-label"><i class="fas fa-wallet"></i> Método de Pago</label>
                            <select name="metodo_pago" id="metodo_pago" class="form-select">
                                <option value="Efectivo" {{ $pago->metodo_pago == 'Efectivo' ? 'selected' : '' }}>Efectivo</option>
                                <option value="Transferencia" {{ $pago->metodo_pago == 'Transferencia' ? 'selected' : '' }}>Transferencia</option>
                                <option value="Tarjeta" {{ $pago->metodo_pago == 'Tarjeta' ? 'selected' : '' }}>Tarjeta</option>
                            </select>
                        </div>

                        <!-- Estado del Pago -->
                        <div class="mb-3">
                            <label for="estado" class="form-label"><i class="fas fa-info-circle"></i> Estado del Pago</label>
                            <select name="estado" id="estado" class="form-select">
                                <option value="pendiente" {{ $pago->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="confirmado" {{ $pago->estado == 'confirmado' ? 'selected' : '' }}>Confirmado</option>
                                <option value="rechazado" {{ $pago->estado == 'rechazado' ? 'selected' : '' }}>Rechazado</option>
                            </select>
                        </div>

                        <!-- Botones -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.pagos') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Cancelar
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
<div class="container text-center mt-5">
    <div class="alert alert-danger">
        <h4><i class="fas fa-ban"></i> Acceso Denegado</h4>
        <p>No tienes permiso para ver esta página.</p>
    </div>
</div>
@endif
@endsection
