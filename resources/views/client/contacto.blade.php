@extends('layouts.app-master')
@section('content')
@guest
@php
$cliente = auth('client')->user(); // Obtén el cliente autenticado ('client') es el guard del archivo config
@endphp
@if ($cliente)
    <div class="container w-50 form-edit form-movil">
      <div class="row">
        <div class="col conten-login">   
          <form action="{{ route('client.contacto.save', ['id' => $cliente->id]) }}" method="post" enctype="multipart/form-data">
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
            <p style="color: grey;"><b><u>CONSULTA DE CLIENTE:</u></b></p>                                                         
            <div class="mb-3 form-floating">
              <input type="text" name="nombre" placeholder="Nombre" class="form-control" required>
              <label for="nombre" class="form-label">Nombre</label>                                            
            </div>                  
            <div class="form-floating mb-3">
              <input type="email" name="email" placeholder="Correo electrónico" class="form-control" id="email" aria-describedby="emailHelp" required>
              <label for="email" class="form-label">Correo electrónico</label>
            </div>            
            <div class="mb-3 form-floating">
              <input type="text" name="pais" placeholder="País" class="form-control">
              <label for="País" class="form-label">País</label>                                            
            </div> 
            <div class="mb-3 form-floating">
              <textarea class="form-control" name="comentario" rows="4"></textarea><br>
              <label for="País" class="form-label">Describinos aquí tu consulta</label>
            </div>         
            <button type="submit" class="btn btn-primary">Enviar</button>
          </form>
        </div>
      </div>
    </div>  
    @else
  <div class="container w-50 form-edit form-movil">
      <div class="row p-3">
        <div class="col conten-login">   
          <form action="{{ route('client.contacto.save')}}" method="post">
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
            <p style="color: grey;"><b><u>FORMULARIO DE CONTACTO:</u></b></p>                                                         
            <div class="mb-3 form-floating">
              <input type="text" name="nombre" placeholder="Nombre" class="form-control" required>
              <label for="nombre" class="form-label">Nombre</label>                                            
            </div>
            <div class="form-floating mb-3">
              <input type="email" name="email" placeholder="Correo electrónico" class="form-control" id="email" aria-describedby="emailHelp" required>
              <label for="email" class="form-label">Correo electrónico</label>
            </div>             
            <div class="mb-3 form-floating">
              <input type="text" name="pais" placeholder="País" class="form-control">
              <label for="País" class="form-label">País</label>                                            
            </div> 
            <div class="mb-3 form-floating">
              <textarea class="form-control" name="comentario" rows="4"></textarea><br>
              <label for="País" class="form-label">Describinos aquí tu consulta</label>
            </div>         
            <button type="submit" class="btn btn-primary">Enviar</button>
          </form>
        </div>
      </div>
    </div>  
  @endif
@endguest
@endsection