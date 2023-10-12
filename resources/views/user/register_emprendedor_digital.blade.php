@extends('layouts.app-master')
@section('content')
    <div class="container w-50 form-movil">
        <div class="row px-3">
            <div class="col conten-login">
               <form action="{{ url('/register_emprendedor_digital') }}" method="post">
                @csrf
                <p style="color: grey;"><b><u>REGISTRO PARA EMPRENDEDORES</u></b></p>
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Nombre de usuario" value="{{ old('usuario') }}" required>
                  <label for="username" class="form-label">Nombre de usuario</label>
                  @error('usuario')
                   <div class="alert alert-danger mt-1">
                     <span class="">{{ $message }}</span>
                   </div>
                  @enderror
                </div>
                <div class="form-floating mb-3">
                  <input type="email" name="email" placeholder="Correo electrónico" class="form-control" id="email" aria-describedby="emailHelp" value="{{ old('email') }}">
                  <label for="email" class="form-label">Correo electrónico</label>
                     <div id="emailHelp" class="form-text">Nunca compartiremos su correo electrónico con nadie más.</div>
                       @error('email')
                        <div class="alert alert-danger mt-1">
                          <span class="">{{ $message }}</span>
                        </div>
                       @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="email" name="Correo_electrónico" placeholder="Confirmar Correo electrónico" class="form-control" id="confirmEmail" aria-describedby="emailHelp" value="{{ old('Correo_electrónico') }}">
                       <label for="Correo_electrónico" class="form-label">Confirmar Correo electrónico</label>
                       @error('Correo_electrónico')
                           <div class="alert alert-danger mt-1">
                             <span class="">{{ $message }}</span>
                           </div>
                      @enderror
                </div>
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
                <input type="hidden" name="id_user_lider" value="{{ request()->query('sumatealequipodeemprendedoresdigitales') }}">
                <button type="submit" class="btn btn-primary">Enviar</button>
              </form>
            </div>
        </div>
    </div>
  @endsection