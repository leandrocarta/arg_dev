@extends('layouts.app-master')
@section('content') 
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 mt-5">
                <div class="alert alert-success text-center" role="alert">
                    <h2>¡Registro Completado!</h2>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Bienvenido</h5>
                        <p class="card-text">¡Su registro se ha completado con éxito! Ahora puede iniciar sesión para acceder a su cuenta.</p>
                        <a href="login_client" class="btn btn-primary">Iniciar Sesión</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection