@extends('layouts.app-master')

@if (Auth::check() && Auth::user()->id_rango === 1)
@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="mb-0"><i class="fas fa-plus-circle"></i> Crear Nuevo Viaje</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('mis_viajes.store') }}" onsubmit="syncValorViaje()" enctype="multipart/form-data">
                        @csrf

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

                        <!-- Selección de Paquete (Producto) -->
                        <div class="mb-3">
                            <label for="id_producto" class="form-label"><i class="fas fa-box"></i> Paquete</label>
                            <select name="id_producto" id="id_producto" class="form-select" required>
                                <option value="">Seleccione un paquete</option>
                                @foreach ($productos as $producto)
                                    <option value="{{ $producto->id }}" data-hotel="{{ $producto->id_hotel }}" data-precio="{{ $producto->precio_total }}">
                                        {{ $producto->titulo }} - ${{ number_format($producto->precio_total, 2) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Hotel (se llena automáticamente con el paquete seleccionado) -->
                        <div class="mb-3">
                            <label for="hotel_id" class="form-label"><i class="fas fa-hotel"></i> Hotel</label>
                            <input type="text" id="hotel_nombre" class="form-control" readonly>
                            <input type="hidden" name="hotel_id" id="hotel_id">
                        </div>

                        <!-- Precio del Paquete (se llena automáticamente) -->
                        <div class="mb-3">
                            <label for="valor_viaje" class="form-label"><i class="fas fa-dollar-sign"></i> Precio del Viaje</label>
                            <input type="number" step="0.01" id="valor_viaje" class="form-control" required>
                            <input type="hidden" name="valor_viaje" id="valor_viaje_hidden">
                        </div>

                        <!-- Fechas -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="fecha_inicio" class="form-label"><i class="fas fa-calendar-alt"></i> Fecha de Inicio</label>
                                <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="fecha_fin" class="form-label"><i class="fas fa-calendar-alt"></i> Fecha de Fin</label>
                                <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" required>
                            </div>
                        </div>

                        <!-- Estado -->
                        <div class="mb-3">
                            <label for="estado" class="form-label"><i class="fas fa-info-circle"></i> Estado</label>
                            <select name="estado" id="estado" class="form-select" required>
                                <option value="pendiente">Pendiente</option>
                                <option value="confirmado">Confirmado</option>
                                <option value="completado">Completado</option>
                            </select>
                        </div>

                        <!-- Notas -->
                        <div class="mb-3">
                            <label for="notas" class="form-label"><i class="fas fa-sticky-note"></i> Notas</label>
                            <textarea name="notas" id="notas" class="form-control" rows="3" placeholder="Información adicional"></textarea>
                        </div>

                        <!-- Botones -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.misViajes') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Regresar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Guardar Viaje
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script para actualizar hotel y precio automáticamente al seleccionar un paquete -->
<script>
    document.getElementById('id_producto').addEventListener('change', function() {
        let selectedOption = this.options[this.selectedIndex];
        let hotelId = selectedOption.getAttribute('data-hotel');
        let precio = selectedOption.getAttribute('data-precio');

        document.getElementById('hotel_id').value = hotelId;
        document.getElementById('hotel_nombre').value = hotelId ? "Hotel ID: " + hotelId : "No asignado";
        document.getElementById('valor_viaje').value = "$" + parseFloat(precio).toFixed(2);
        document.getElementById('valor_viaje_hidden').value = precio;
    });
</script>
<script>
    function syncValorViaje() {
        document.getElementById('valor_viaje_hidden').value = document.getElementById('valor_viaje').value;
    }
</script>
@else
<div class="container text-center mt-5">
    <div class="alert alert-danger">
        <h4><i class="fas fa-ban"></i> Acceso Denegado</h4>
        <p>No tienes permiso para ver esta página.</p>
    </div>
</div>
@endif
@endsection
