@extends('layouts.app-master')
@section('content')
  <div class="container w-50 form-movil">
        <div class="row px-3">
            <div class="col conten-login">
               <form action="{{ url('/recover_password_client') }}" method="post">
                @csrf
                <p style="color: grey;"><b><u>CLIENTES</u></b></p>
                <div id="emailHelp" class="form-text">Recuperar mi contraseña.</div>
               <!-- @include('parcials.messages')        -->        
                    <div class="form-floating mb-3">
                      <input type="text" name="usuario" placeholder="Usuario / Correo electrónico" class="form-control" required>
                      <label for="exampleInputEmail1" class="form-label">Confirma tu Correo electrónico:</label>                                            
                       @if(session('message'))
                        <div class="alert alert-success">
                          {{ session('message') }}
                        </div>
                       @elseif($errors->has('email'))
                           <div class="alert alert-danger mt-1">
                               <span>{{ $errors->first('email') }}</span>
                           </div>
                       @endif
                       @if(isset($newPassword))
                       <p>Nueva contraseña temporal generada: {{ $newPassword }}</p>
                         @endif
                    </div>                                                       
                    <button type="submit" class="btn btn-primary">ENVIAR</button>                                         
                </form>
            </div>
        </div>
  </div>  
@endsection
 