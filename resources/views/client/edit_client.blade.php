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
                 @error('password_confirmation_edit')
                               <div class="alert alert-danger mt-1">
                                    <span>Sus contraseñas no coinciden</span>
                               </div>
                           @enderror   
                 @error('password')
                               <div class="alert alert-danger mt-1">
                                 <span class="">{{ $message }}</span>
                               </div>
                           @enderror    
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
                     Cambiar contraseña
                     </a>  
                   </p>                
                     <div class="collapse mb-3" id="collapseExample">                      
                       <div class="card card-body collapse-form">                          
                        <!--  <div class="mb-3 form-floating">                            
                            <input type="email" name="email" class="form-control" placeholder="Cambiar Correo electrónico">    
                            <label for="email" class="form-label">Cambiar Correo electrónico</label>
                          </div>  -->
                          <div class="mb-3 form-floating">                            
                            <input type="password" name="password" class="form-control" placeholder="">
                            <label for="password-edit" class="form-label">Cambiar Contraseña</label>
                          </div>                                                           
                          <div class="mb-3 form-floating">                           
                           <input type="password" name="password_confirmation_edit" class="form-control" placeholder="">
                           <label for="password_confirmation_edit" class="form-label">Repita Contraseña</label>
                          </div>                                                  
                       </div>
                    </div>           
                    <p>IMPORTANTE:</p>    
                    <p>Los datos personales deben ser iguales al documento de viaje.</p>                            
                    <div class="mb-3 form-floating">
                      <input type="text" name="nombre" placeholder="Nombre" class="form-control" value="{{Auth::guard('client')->user()->nombre }}">
                      <label for="nombre" class="form-label">Nombres</label>                                            
                    </div>
                    <div class="mb-3 form-floating">
                      <input type="text" name="apellido" placeholder="Apellido" class="form-control" value="{{Auth::guard('client')->user()->apellido}}">
                      <label for="apellido" class="form-label">Apellido</label>                                            
                    </div>    
                    <div class="mb-3">                            
                         <select name="documento" class="form-select">  
                          <option value="">--- Tipo de Documento ---</option>
                            <option value="PASAPORTE">PASAPORTE</option>
                            <option value="DNI">DNI</option>
                         </select>                           
                    </div>
                    <div class="mb-3 form-floating">
                      <input type="text" name="numero_doc" placeholder="numero_doc" class="form-control" value="">
                      <label for="numero_doc" class="form-label">Número del documento</label>                                            
                    </div>
                    <div class="mb-3 form-floating">
                        <input type="date" name="fecha_nacimiento" placeholder="Fecha de Nacimiento" class="form-control" value="">
                       <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <input type="date" name="fecha_vencimiento" placeholder="Fecha de Vencimiento del Documento" class="form-control" value="">
                         <label for="fecha_vencimiento" class="form-label">Fecha de Vencimiento del Documento</label>
                    </div>
                    <div class="mb-3 form-floating">
                      <input type="number" name="cuil" placeholder="cuil" class="form-control" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="{{Auth::guard('client')->user()->cod_area}}">
                      <label for="cuil" class="form-label">Número de Cuil o DNI</label>                                            
                    </div>                  
                    <div class="mb-3 form-floating">
                      <input type="number" name="movil" placeholder="Numero móvil" class="form-control" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="{{Auth::guard('client')->user()->movil}}">
                      <label for="movil" class="form-label">WhatsApp (Incluir codigo de area) </label>                                            
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
 