@extends('layouts.app-master')
@section('content')
  <div class="container w-50 form-movil">
        <div class="row px-3">
            <div class="col conten-login">
               <form action="{{ url('/login_client') }}" method="post">
                @csrf
                <p style="color: grey;"><b><u>COMUNIDAD</u></b></p>
                <div id="emailHelp" class="form-text">Si ya estas registrado, solamente ingresa tus datos.</div>
               <!-- @include('parcials.messages')        -->        
                    <div class="form-floating mb-3">
                      <input type="text" name="usuario" placeholder="Usuario / Correo electrónico" class="form-control" required>
                      <label for="exampleInputEmail1" class="form-label">Usuario / Correo electrónico:</label>                                            
                       @error('email')
                        <div class="alert alert-danger mt-1">
                          <span class="">{{ $message }}</span>
                        </div>    
                       @enderror                        
                    </div>
                    <div class="form-floating mb-3">
                      <input type="password" name="password" placeholder="Password" class="form-control" id="exampleInputPassword1">
                      <label for="exampleInputPassword1" class="form-label">Contraseña</label>                      
                    <div id="emailHelp" class="form-text"><a href="/recover_password_client">Olvide mi contraseña</a></div>
                    </div>                                     
                    <button type="submit" class="btn btn-primary">IR A MI PANEL</button>
                     <div class="mb-3">
                      <a href="/register_client">Registrarse</a>  
                    </div>                      
                </form>
            </div>
        </div>
  </div>  
@endsection
 