@extends('layouts.app-master')
@if (Auth::check() && Auth::user()->id_rango === 1)
@section('content')
<div class="container">
    @if(session('success'))
    <div class="alert alert-success mt-2">
        {{ session('success') }}
    </div>
    @endif
    <a href="{{ route('form.room') }}" class="btn btn-success mt-2">CREAR HABITACION</a>
    <h2>LISTADO DE HABITACIONES</h2>
    <input type="text" id="searchInput" placeholder="Buscar por letra...">

    <div class="mb-3 table-container border">    
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Hotel</th>
                    <th>Tipo Habitacion</th> 
                    <th>Base</th> 
                    <th>Costo</th>
                    <th>Utilidad</th>                                
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rooms as $room)
                <tr>
                    <td>{{ $room->id }}</td>
                    <td>{{ $room->id_hotel }}</td>                
                    <td>{{ $room->tipo_room }}</td>
                    <td>{{ $room->capacidad }}</td>
                    <td>{{ $room->moneda }} {{ $room->costo_room }}</td>                
                    <td>{{ $room->utilidad }} %</td>
                    <td>
                        <a href="{{ route('room.update', $room->id) }}" class="btn btn-primary">Editar</a>                  
                    </td>
                    <td>
                        <form action="{{ route('room.delete', $room->id) }}" method="POST">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form> 
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById('searchInput').addEventListener('input', function() {
        var searchText = this.value.toLowerCase();
        var rows = document.querySelectorAll('.table tbody tr');
        
        rows.forEach(function(row) {
            var text = row.textContent.toLowerCase();
            if (text.indexOf(searchText) === -1) {
                row.style.display = 'none';
            } else {
                row.style.display = '';
            }
        });
    });
</script>

@endsection
@endif

