@extends('layouts.app-master')
@section('content')
@if (@auth())
@if (Auth::guard('client')->check())

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-primary fw-bold">Mis Viajes</h2>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover shadow-sm">
            <thead class="table-dark text-center">
                <tr>
                    <th>ID</th>
                    <th>Paquete</th>
                    <th>Hotel</th>
                    <th>Valor del Viaje</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($viajes as $viaje)
                <tr>
                    <td class="text-center">{{ $viaje->id }}</td>
                    <td class="text-center">{{ $viaje->producto->titulo }}</td>
                    <td>{{ $viaje->hotel->nombre }}</td>
                    <td class="text-center">${{ number_format($viaje->valor_viaje, 2) }}</td>
                    <td class="text-center">{{ $viaje->fecha_inicio }}</td>
                    <td class="text-center">{{ $viaje->fecha_fin }}</td>
                    <td class="text-center">
                        <span class="badge bg-{{ $viaje->estado == 'confirmado' ? 'success' : ($viaje->estado == 'pendiente' ? 'warning' : 'secondary') }}">
                            {{ ucfirst($viaje->estado) }}
                        </span>
                    </td>
                    <td class="text-center">
                       <a href="{{ url('detalles_productos/' . $viaje->producto->id) }}" class="btn btn-info btn-sm">
                        <i class="fas fa-wallet"></i> Ver Mi Viaje
                       </a>
                       <!-- Botón Ver Pagos -->
                        <a href="{{ route('client.misPagos', ['mis_viajes_id' => $viaje->id]) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-wallet"></i> Ver Pagos
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">
                        <i class="fas fa-info-circle"></i> No tienes viajes registrados.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@else
@include('client.login_client')
@endif
@endif 
@endsection
