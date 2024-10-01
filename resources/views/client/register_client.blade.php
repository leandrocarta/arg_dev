@extends('layouts.app-master')
@section('content')
    <div class="container w-50 form-movil">
        <div class="row px-3">
            <div class="col conten-login">
               <form action="{{ url('/register_client') }}" method="post">
                @csrf
                <p style="color: grey;"><b>Alta Nuevo Miembro:</b></p>
                <p style="color: grey;">Regístrate en 'THE CLUB' y accede a tarifas especiales y planes de pagos en tus próximas vacaciones.</p>
                <div class="form-floating my-3">
                  <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Nombre de usuario" value="{{ old('usuario') }}" required>
                  <label for="usuario" class="form-label">Nombre de usuario</label>
                  @error('usuario')
                   <div class="alert alert-danger mt-1">
                     <span class="">{{ $message }}</span>
                   </div>
                  @enderror
                </div>
                <div class="form-floating mb-3">
                  <input type="email" name="email" placeholder="Correo electrónico" class="form-control" id="email" aria-describedby="emailHelp" value="{{ old('email') }}" required>
                  <label for="email" class="form-label">Correo electrónico</label>
                     <div id="emailHelp" class="form-text">Nunca compartiremos su correo electrónico con nadie más.</div>
                       @error('email')
                        <div class="alert alert-danger mt-1">
                          <span class="">{{ $message }}</span>
                      </div>
                       @enderror
                </div>
               <!-- <div class="form-floating mb-3">
                    <input type="email" name="correo_electronico" placeholder="Confirmar Correo electrónico" class="form-control" id="confirmEmail" aria-describedby="emailHelp" value="{{ old('correo_electronico') }}">
                       <label for="correo_electronico" class="form-label">Confirmar Correo electrónico</label>
                       @error('correo_electronico')
                           <div class="alert alert-danger mt-1">
                             <span class="">{{ $message }}</span>
                           </div>
                      @enderror
                </div> -->                
                <div class="form-floating mb-3">
                    <input type="password" name="password" placeholder="Password" class="form-control" id="password">
                    <label for="password" class="form-label">Password</label>
                     @error('password')
                        <div class="alert alert-danger mt-1">
                          <span class="">{{ $message }}</span>
                        </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="password" name="del_password" placeholder="Confirmar Password" class="form-control" id="confirmPassword">
                    <label for="Confirmación_password" class="form-label">Confirmar Password</label>
                     @error('del_password')
                        <div class="alert alert-danger mt-1">
                             <span class="">{{ $message }}</span>
                        </div>
                    @enderror
                </div>
                <input type="hidden" name="id_user" value="{{ request()->query('liderequipoventas') }}">
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
            </div>
        </div>
    </div>
  @endsection