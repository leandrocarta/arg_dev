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
                           <option value=" {{ Auth::guard('client')->user()->documento == null ? 'selected' : '' }}">--- Tipo de Documento ---</option>
                           <option value="Pasaporte" {{ Auth::guard('client')->user()->documento == 'Pasaporte' ? 'selected' : '' }}>PASAPORTE</option>
                           <option value="Dni" {{ Auth::guard('client')->user()->documento == 'Dni' ? 'selected' : '' }}>DNI</option>
                       </select>
                       <div class="form-text">
                        <i class="fas fa-exclamation-triangle me-1" style="color: rgb(255, 145, 0);"></i>  
                            <a href="#modalItinerario" data-bs-toggle="modal" style="color: rgb(255, 145, 0);">
                                  Advertencia!!
                              </a>
                                <div class="modal fade" id="modalItinerario" tabindex="-1" aria-labelledby="modalItinerarioLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalAdvertenciaLabel">
                                                    ⚠️ Advertencia Importante
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>
                                                    ⚠️ <strong>¡Atención! Esto es muy importante:</strong>
                                                </p>
                                                <p>
                                                    🛂 Para viajar al **exterior**, debes contar con tu <strong>pasaporte vigente o ciudadanía</strong>.                      
                                                <p>
                                                  🌍 En el caso de **Brasil**, puedes viajar únicamente con tu **DNI**. Sin embargo, para destinos en el **Caribe** u otros países del mundo, el DNI no servirá.
                                                </p>
                                                <p>
                                                    🚨 <strong>¡Nunca, pero nunca actualices tus documentos días o semanas previas al viaje!</strong>  
                                                    Si lo haces, el **RENAPER** anulará tu documento actual y **no podrás salir del país**.                      
                                                </p>
                                                <p>
                                                  📅 Asegúrate de que tu pasaporte o DNI esté vigente al momento de planificar tu viaje.
                                               </p>
                                                <p>
                                                    ✅ **Consejo:** Verifica tus documentos con suficiente anticipación para evitar inconvenientes.
                                                </p>
                                                <p>
                                                  📞 **Si necesitas ayuda, no dudes en llamarnos.** <strong> Estamos aquí para ayudarte en todo.</strong>
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Entendido</button>
                                           </div>
                                        </div>
                                    </div>
                                </div>
                       </div>
                    </div>
                    <div class="mb-3 form-floating">
                      <input type="text" name="numero_doc" placeholder="numero_doc" class="form-control" value="{{Auth::guard('client')->user()->numero_doc}}">
                      <label for="numero_doc" class="form-label">Número del documento</label>                                            
                    </div>
                    <div class="mb-3 form-floating">
                        <input type="date" name="fecha_nacimiento" placeholder="Fecha de Nacimiento" class="form-control" value="{{Auth::guard('client')->user()->fecha_nacimiento}}">
                       <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <input type="date" name="fecha_vencimiento" placeholder="Fecha de Vencimiento del Documento" class="form-control" value="{{Auth::guard('client')->user()->fecha_vencimiento}}">
                         <label for="fecha_vencimiento" class="form-label">Fecha de Vencimiento del Documento</label>
                    </div>                                   
                    <div class="mb-3 form-floating">
                      <input type="number" name="movil" placeholder="Numero móvil" class="form-control" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="{{Auth::guard('client')->user()->movil}}">
                      <label for="movil" class="form-label">WhatsApp (Incluir codigo de area) </label>                                            
                    </div>   
                    <div class="mb-3 form-floating">
                      <input type="text" name="direccion" placeholder="direccion" class="form-control" value="{{Auth::guard('client')->user()->direccion}}">
                      <label for="direccion" class="form-label">Dirección</label>                                            
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
 