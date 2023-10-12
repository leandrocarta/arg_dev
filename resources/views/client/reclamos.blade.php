@extends('layouts.app-master')
@section('content')
@guest
@php
$cliente = auth('client')->user(); // Obtén el cliente autenticado ('client') es el guard del archivo config
@endphp
@if ($cliente)
    <div class="container w-50 form-edit form-movil">
      <div class="row px-3">
        <div class="col conten-login">   
          <form action="{{ route('client.reclamos', ['id' => $cliente->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @if(Session::has('error_message'))
              <div class="alert alert-danger">
                {{ Session::get('error_message') }}
                {{ Session::forget('error_message') }}
              </div>
            @endif
            @if(session('success'))
              <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <p style="color: grey;"><b><u>RECLAMOS CLIENTES:</u></b></p>                                                         
            <div class="mb-3 form-floating">
              <input type="text" name="name" placeholder="Nombre" class="form-control" required>
              <label for="nombre" class="form-label">Nombre</label>                                            
            </div>
            <div class="mb-3 form-floating">
              <input type="text" name="lastname" placeholder="Apellido" class="form-control">
              <label for="apellido" class="form-label">Apellido</label>                                            
            </div>        
            <div class="form-floating mb-3">
              <input type="email" name="email" placeholder="Correo electrónico" class="form-control" id="email" aria-describedby="emailHelp" required>
              <label for="email" class="form-label">Correo electrónico</label>
            </div>            
            <div class="mb-3 form-floating">
              <input type="number" name="cod_pais" placeholder="Código País" class="form-control" onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required>
              <label for="cod_pais" class="form-label">Código País: Ej. +54</label>                                            
            </div>
            <div class="mb-3 form-floating">
              <input type="number" name="movil" placeholder="Código Área + Número Telefónico" class="form-control" onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required>
              <label for="movil" class="form-label">Código Área + Número Telefónico</label>                                            
            </div>                    
            <div class="mb-3 form-floating">
              <input type="text" name="pais" placeholder="País" class="form-control" required>
              <label for="País" class="form-label">País</label>                                            
            </div> 
            <div class="mb-3 form-floating">
              <textarea class="form-control" name="comentario" rows="4" required></textarea><br>
              <label for="País" class="form-label">Describinos aquí el reclamo por el cual te contactas</label>
            </div>         
            <button type="submit" class="btn btn-primary">Enviar</button>
          </form>
        </div>
      </div>
    </div>
  @else
  <p>Debes INICIAR SESION para acceder a tu cuenta.</p>
  @endif
@endguest
@endsection
