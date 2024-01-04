@extends('layouts.app-master')
@section('content')
@if (@auth())             
      @if (Auth::guard('client')->check())
    <div class="container w-50 form-edit form-movil">
        <div class="row px-3">
            <div class="col conten-login">              
               <form action="{{ route('client.update', [Auth::guard('client')->user()->id]) }}" method="post">
                @csrf
                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @error('email')
                        <div class="alert alert-danger mt-1">
                          <span class="">{{ $message }}</span>
                      </div>
                       @enderror
                @method('PUT')
                <p style="color: grey;"><b><u>EDITAR MIS DATOS</u></b></p>
                    <div class="mb-3">                      
                      <input name="username" type="text" placeholder="" class="form-control" value="{{Auth::guard('client')->user()->usuario}}" disabled> 
                   <div class="form-text">Nombre Usuario: No Editable.</div>
                    </div>
                    <div class="mb-3">
                      <input type="email" class="form-control" aria-describedby="emailHelp" value="{{Auth::guard('client')->user()->email}}" disabled>
                   <div class="form-text">Email Registrado: No Editable.</div>
                   </div>     
                   <p class="mb-2">
                     <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                     Editar datos sensibles
                     </a>  
                   </p>                
                     <div class="collapse mb-3" id="collapseExample">                      
                       <div class="card card-body collapse-form">                          
                          <div class="mb-3">
                            <label for="email" class="form-label">Cambiar Correo electrónico</label>
                            <input type="email" name="email" class="form-control" aria-describedby="emailHelp">    
                          </div>  
                          <div class="mb-3">
                            <label for="password-edit" class="form-label">Cambiar Contraseña</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword">
                          </div>                                     
                          <div class="mb-3">
                           <label for="password_confirmation_edit" class="form-label">Repita Contraseña</label>
                           <input type="password" name="password_confirmation_edit" class="form-control" id="exampleInputPassword2">
                          </div>                           
                       </div>
                    </div>                                           
                    <div class="mb-3 form-floating">
                      <input type="text" name="nombre" placeholder="Nombre" class="form-control" value="{{Auth::guard('client')->user()->nombre }}">
                      <label for="nombre" class="form-label">Nombre/s</label>                                            
                    </div>
                    <div class="mb-3 form-floating">
                      <input type="text" name="apellido" placeholder="Apellido" class="form-control" value="{{Auth::guard('client')->user()->apellido}}">
                      <label for="apellido" class="form-label">Apellido/s</label>                                            
                    </div>      
                    <div class="mb-3 form-floating">
                      <input type="text" name="cod_area" placeholder="Código Area Telefónica" class="form-control" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="{{Auth::guard('client')->user()->cod_area}}">
                      <label for="cod_area" class="form-label">Código Area Telefónica</label>                                            
                    </div>
                    <div class="mb-3 form-floating">
                      <input type="text" name="movil" placeholder="Numero móvil" class="form-control" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="{{Auth::guard('client')->user()->movil}}">
                      <label for="movil" class="form-label">Numero Móvil</label>                                            
                    </div>                    
                    <div class="mb-3 form-floating">
                      <input type="text" name="ciudad" placeholder="Ciudad" class="form-control" value="{{Auth::guard('client')->user()->ciudad}}">
                      <label for="ciudad" class="form-label">Ciudad</label>                                            
                    </div>  
                    <div class="mb-3 form-floating">                    
                       <input type="text" name="provincia" placeholder="Provincia" class="form-control" value="{{Auth::guard('client')->user()->provincia}}">
                      <label for="provincia" class="form-label">Provincia</label>                         
                    </div>                                            
                   <div class="mb-3 form-floating">
                     <input type="text" name="pais" placeholder="Pais" class="form-control" value="{{Auth::guard('client')->user()->pais}}">
                      <label for="pais" class="form-label">Pais</label>    
                   </div>                                                
                    <button type="submit" class="btn btn-primary">Enviar</button>
                  </form>
            </div>
        </div>
    </div>
    @else
        @include('client.login_client')
    @endif
@endif     
  @endsection
 