@extends('layouts.app-master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Crear Categoría de Usuario</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('categoria_users.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="nombre">Nombre de la categoría</label>
                                <input type="text" name="nombre" id="nombre" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">Crear Categoría</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
