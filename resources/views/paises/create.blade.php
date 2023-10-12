@extends('layouts.app-master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Crear País</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('paises.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="nombre">Nombre del país</label>
                                <input type="text" name="nombre" id="nombre" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="cod_pais">Código del país</label>
                                <input type="text" name="cod_pais" id="cod_pais" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">Crear País</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection