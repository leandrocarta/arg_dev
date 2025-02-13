@extends('layouts.app-master')

@section('content')
@if (Auth::check() && Auth::user()->id_rango === 1)
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-primary fw-bold">Gestión de Viajes</h2>

        <div class="d-flex align-items-center">
            <!-- Select para Filtrar Viajes por Cliente -->
            <label for="filter_client" class="me-2"><i class="fas fa-user"></i> Cliente:</label>
            <select id="filter_client" class="form-select me-3" style="width: 200px;">
                <option value="">Todos los Clientes</option>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->nombre }} {{ $cliente->apellido }}</option>
                @endforeach
            </select>
            <!-- Botón para Crear un Nuevo Viaje -->
            <a href="{{ route('mis_viajes.create') }}" class="btn btn-success">
                <i class="fas fa-plus-circle"></i> Nuevo Viaje
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover shadow-sm" id="mis_viajes_table">
            <thead class="table-dark text-center">
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
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
                @foreach ($viajes as $viaje)
                <tr data-client-id="{{ $viaje->client->id }}">
                     <td class="text-center">{{ $viaje->id }}</td>
                    <td>{{ $viaje->client->nombre }} {{ $viaje->client->apellido }}</td>
                    <td class="text-center">{{ $viaje->producto->titulo }}</td>
                    <td>{{ $viaje->producto->id_hotel ? $viaje->producto->hotel->nombre : 'No asignado' }}</td>
                    <td class="text-center">
                        ${{ number_format($viaje->valor_viaje, 2) }}  
                    </td>
                    <td class="text-center">{{ $viaje->fecha_inicio }}</td>
                    <td class="text-center">{{ $viaje->fecha_fin }}</td>
                    <td class="text-center">
                        <span class="badge bg-{{ $viaje->estado == 'confirmado' ? 'success' : ($viaje->estado == 'pendiente' ? 'warning' : 'secondary') }}">
                            {{ ucfirst($viaje->estado) }}
                        </span>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('mis_viajes.edit', $viaje->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <form action="{{ route('mis_viajes.destroy', $viaje->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este viaje?');">
                                <i class="fas fa-trash-alt"></i> Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@else
<div class="container text-center mt-5">
    <div class="alert alert-danger">
        <h4>Acceso Denegado</h4>
        <p>No tienes permiso para ver esta página.</p>
    </div>
</div>
@endif

<script>
document.addEventListener("DOMContentLoaded", function() {
    const clientFilter = document.getElementById("filter_client");
    const tableRows = document.querySelectorAll("#mis_viajes_table tbody tr");

    clientFilter.addEventListener("change", function() {
        const selectedClientId = this.value;

        tableRows.forEach(row => {
            const rowClientId = row.getAttribute("data-client-id");

            if (!selectedClientId || rowClientId === selectedClientId) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });
});
</script>

@endsection
