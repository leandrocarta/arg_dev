@extends('layouts.app-master')

@section('content')
@if (Auth::guard('client')->check())
<div class="container mt-4">
    <div class="table-responsive">
        <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-primary fw-bold">Mis Pagos</h2>
          <a href="{{ route('client.misViajes') }}" class="btn btn-secondary">
          <i class="fas fa-arrow-left"></i> Volver a Mis Viajes
         </a>
        </div>
        <table class="table table-bordered table-hover shadow-sm" id="pagos_table">
            <thead class="table-dark text-center">
                <tr>
                    <th>ID</th>
                    <th>Viaje</th>
                    <th>Valor del Viaje</th>
                    <th>Monto Pagado</th>
                    <th>Saldo Pendiente</th>
                    <th>Fecha de Pago</th>
                    <th>Método</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pagos as $pago)
                <tr>
                    <td class="text-center">{{ $pago->id }}</td>
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
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">
                        <i class="fas fa-info-circle"></i> No tienes pagos registrados.
                    </td>
                </tr>
                @endforelse
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
@endsection
