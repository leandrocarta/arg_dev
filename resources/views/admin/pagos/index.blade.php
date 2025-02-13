@extends('layouts.app-master')

@section('content')
@if (Auth::check() && Auth::user()->id_rango === 1)
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="text-primary fw-bold">Gestión de Pagos</h2>

    <div class="d-flex align-items-center">
        <!-- Select para Filtrar Pagos por Cliente -->
        <label for="filter_client" class="me-2"><i class="fas fa-user"></i> Cliente:</label>
        <select id="filter_client" class="form-select me-3" style="width: 200px;">
            <option value="">Todos los Clientes</option>
            @foreach ($clientes as $cliente)
                <option value="{{ $cliente->id }}">{{ $cliente->nombre }} {{ $cliente->apellido }}</option>
            @endforeach
        </select>
        <!-- Botón para Crear un Nuevo Pago -->
        <a href="{{ route('admin.pagos.create') }}" class="btn btn-success">
            <i class="fas fa-plus-circle"></i> Nuevo Pago
        </a>
    </div>
</div>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="table-responsive">
       
        <table class="table table-bordered table-hover shadow-sm" id="pagos_table">
    <thead class="table-dark text-center">
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Viaje</th>
            <th>Valor Viaje</th>
            <th>Su Pagado</th>
            <th>Saldo</th>
            <th>Fecha Pago</th>
            <th>Método</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pagos as $pago)
        <tr data-client-id="{{ $pago->client->id }}">
             <td class="text-center">{{ $pago->id }}</td>
             <td>{{ $pago->client->nombre }} {{ $pago->client->apellido }}</td>
             <td class="text-center">
                 {{ $pago->misViaje ? 'ID: '.$pago->misViaje->id : 'No asignado' }}
             </td>
             <td class="text-end fw-bold">
              ${{ number_format($pago->total_viaje ?? 0, 2) }}
             </td>

             <td class="text-end text-success fw-bold">
                 ${{ number_format($pago->monto_pagado, 2) }}
             </td>
             <td class="text-end text-danger fw-bold">
                 ${{ number_format($pago->saldo_pendiente, 2) }}
             </td>
             <td class="text-center">{{ $pago->fecha_pago }}</td>
             <td class="text-center">
                 <span class="badge bg-info text-dark">{{ $pago->metodo_pago }}</span>
             </td>
             <td class="text-center">
                 <span class="badge bg-{{ $pago->estado == 'confirmado' ? 'success' : 'warning' }}">
                     {{ ucfirst($pago->estado) }}
                 </span>
             </td>
             <td class="text-center">
                 <a href="{{ route('admin.pagos.edit', $pago->id) }}" class="btn btn-primary btn-sm">
                     <i class="fas fa-edit"></i> Editar
                 </a>
                 <form action="{{ route('admin.pagos.destroy', $pago->id) }}" method="POST" class="d-inline">
                     @csrf
                     @method('DELETE')
                     <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este pago?');">
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
    const tableRows = document.querySelectorAll("#pagos_table tbody tr");

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
