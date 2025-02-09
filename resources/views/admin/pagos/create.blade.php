@extends('layouts.app-master')

@if (Auth::check() && Auth::user()->id_rango === 1)
@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="mb-0"><i class="fas fa-credit-card"></i> Crear Nuevo Pago</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.pagos.store') }}">
                        @csrf

                        <!-- Cliente -->
                        <!-- Cliente -->
<div class="mb-3">
    <label for="client_id" class="form-label"><i class="fas fa-user"></i> Cliente</label>
    <select name="client_id" id="client_id" class="form-select" required>
        <option value="">Seleccione un cliente</option>
        @foreach ($clientes as $cliente)
        <option value="{{ $cliente->id }}">{{ $cliente->nombre }} {{ $cliente->apellido }}</option>
        @endforeach
    </select>
</div>

<!-- Viaje -->
<div class="mb-3">
    <label for="mis_viajes_id" class="form-label"><i class="fas fa-map-marker-alt"></i> Viaje</label>
    <select name="mis_viajes_id" id="mis_viajes_id" class="form-select" required>
        <option value="">Seleccione un viaje</option>
        @foreach ($viajes as $viaje)
        <option value="{{ $viaje->id }}" data-client="{{ $viaje->client_id }}" data-total="{{ $viaje->valor_viaje }}">
            ID: {{ $viaje->id }} - Destino: {{ $viaje->destino->ciudad_destino }}
        </option>
        @endforeach
    </select>
</div>


                        <!-- Total del Viaje -->
                        <div class="mb-3">
                            <label for="total_viaje" class="form-label"><i class="fas fa-dollar-sign"></i> Total del Viaje</label>
                            <input type="text" id="total_viaje" class="form-control" readonly>
                        </div>

                        <!-- Tipo de Pago -->
                        <div class="mb-3">
                            <label for="tipo_pago" class="form-label"><i class="fas fa-list"></i> Tipo de Pago</label>
                            <select name="tipo_pago" id="tipo_pago" class="form-select">
                                <option value="reserva">Reserva</option>
                                <option value="cuota">Cuota</option>
                            </select>
                        </div>

                        <!-- Número de Cuota -->
                        <div class="mb-3 d-none" id="cuota_section">
                            <label for="numero_cuota" class="form-label"><i class="fas fa-hashtag"></i> Número de Cuota</label>
                            <input type="number" name="numero_cuota" id="numero_cuota" class="form-control">
                        </div>

                        <!-- Fecha del Pago -->
                        <div class="mb-3">
                            <label for="fecha_pago" class="form-label"><i class="fas fa-calendar-alt"></i> Fecha del Pago</label>
                            <input type="date" name="fecha_pago" id="fecha_pago" class="form-control" required>
                        </div>

                        <!-- Monto Pagado -->
                        <div class="mb-3">
                            <label for="monto_pagado" class="form-label"><i class="fas fa-dollar-sign"></i> Monto Pagado</label>
                            <input type="number" step="0.01" name="monto_pagado" id="monto_pagado" class="form-control" required>
                        </div>

                        <!-- Método de Pago -->
                        <div class="mb-3">
                            <label for="metodo_pago" class="form-label"><i class="fas fa-wallet"></i> Método de Pago</label>
                            <select name="metodo_pago" id="metodo_pago" class="form-select">                                
                                <option value="Efectivo">Efectivo</option>
                                <option value="Transferencia">Transferencia</option>
                                <option value="Tarjeta">Tarjeta</option>                                
                            </select>
                        </div>

                        <!-- Estado del Pago -->
                        <div class="mb-3">
                            <label for="estado" class="form-label"><i class="fas fa-info-circle"></i> Estado del Pago</label>
                            <select name="estado" id="estado" class="form-select">
                                <option value="pendiente">Pendiente</option>
                                <option value="confirmado">Confirmado</option>
                                <option value="rechazado">Rechazado</option>
                            </select>
                        </div>

                        <!-- Botones -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.pagos') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Guardar Pago
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
<script>
document.addEventListener("DOMContentLoaded", function() {
    const clientSelect = document.getElementById("client_id");
    const viajeSelect = document.getElementById("mis_viajes_id");
    const totalViajeInput = document.getElementById("total_viaje");

    // Filtrar los viajes cuando cambia el cliente
    clientSelect.addEventListener("change", function() {
        const selectedClient = this.value;
        Array.from(viajeSelect.options).forEach(option => {
            if (option.value === "") {
                option.hidden = false;
            } else {
                option.hidden = option.getAttribute("data-client") !== selectedClient;
            }
        });
        viajeSelect.value = ""; // Reset de selección de viajes
        totalViajeInput.value = "";
    });

    // Mostrar el total del viaje al seleccionar un viaje
    viajeSelect.addEventListener("change", function() {
        const selectedOption = viajeSelect.options[viajeSelect.selectedIndex];
        totalViajeInput.value = selectedOption.getAttribute("data-total") || "";
    });
});
</script>

@endsection