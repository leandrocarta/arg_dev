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
                        <h5 class="card-title">Bienvenidos</h5>
                        <p class="card-text">¡Tu registro se ha completado con éxito! Ahora ya podés iniciar sesión y acceder a tu cuenta.  Te deseamos lo mejor en esta nueva etapa como emprendedor digital de turismo, y recuerda que estamos atentos para brindarte todo el apoyo que necesites. Mucha Suerte!!!.</p>
                        <a href="login_emprendedor_digital" class="btn btn-primary">Iniciar Sesión</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection