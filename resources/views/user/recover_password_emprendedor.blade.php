@extends('layouts.app-master')
@section('content')
  <div class="container w-50 form-movil">
        <div class="row px-3">
            <div class="col conten-login">
               <form action="{{ url('/recover_password_emprendedor') }}" method="post">
                @csrf
                @if(session('success'))
                <div class="alert alert-success mt-2">
                {{ session('success') }}
                </div>
                @endif
                <p style="color: grey;"><b><u>Emprendedor Digital</u></b></p>
                <div id="emailHelp" class="form-text">Recuperar mi contraseña.</div>
               <!-- @include('parcials.messages')        -->        
                    <div class="form-floating mb-3">
                      <input type="email" name="usuario" placeholder="Correo electrónico" class="form-control" required>
                      <label for="exampleInputEmail1" class="form-label">Confirma tu Correo electrónico:</label>                                            
                       @error('email')
                        <div class="alert alert-danger mt-1">
                          <span class="">{{ $message }}</span>
                        </div>
                       @enderror                 
                    </div>                                                       
                    <button type="submit" class="btn btn-primary">ENVIAR</button>                                         
                </form>
            </div>
        </div>
  </div>  
@endsection
 