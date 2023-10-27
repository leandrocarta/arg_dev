@extends('layouts.app-master')
@section('content')
  <div class="container my-5 m-auto presentacion">
    <div class="titulo text-center">
      <h2 class="display-4">¡Conoce Argentina con ARGTRAVELS!</h2>
    </div>
    <div class="row my-5">
    @foreach ($productos as $producto)
    <div class="col-md-4">
        <div class="card">
            <img src="{{ asset('assets/img_paquetes/' . $producto->imagen) }}" class="card-img-top img-fluid" alt="{{ $producto->nombre }}">
            <div class="card-body">
                <h5 class="card-title">{{ $producto->nombre }}</h5>
                <p class="card-text">{{ $producto->descripcion }}</p>
                <p class="card-text"><strong>Código:</strong> {{ $producto->codigo }}</p>
                <a href="#" class="btn btn-primary">Ver detalles</a>
            </div>
        </div>
    </div>
    @endforeach
</div>

    <div class="text-center">
      <a href="#" class="btn btn-primary btn-lg">Ver todos los destinos</a>
    </div>
  </div>
@endsection
