@extends('layouts.app-master')
@section('content')
@guest()
  <p>Debes INICIAR SESION para acceder a tu cuenta.</p>
@endguest
@auth()
    <div class="container w-50 form-edit form-movil">
        <div class="row">
            <div class="col conten-login">   
               <form action="{{ route('user.update', ['id' => $user->id]) }}" method="post" enctype="multipart/form-data">
                @csrf               
                @if(Session::has('error_message'))
                <div class="alert alert-danger">
                {{ Session::get('error_message') }}
                {{ Session::forget('error_message') }} <!-- Elimina el mensaje de la sesión -->
                 </div>
                @endif
                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @method('PUT')
                <p style="color: grey;"><b><u>EDITAR MIS DATOS</u></b></p>
                    <div class="mb-3">                      
                      <input name="username" type="text" placeholder="" class="form-control" value="{{auth()->user()->usuario}}" disabled> 
                   <div class="form-text">Nombre Usuario: No Editable.</div>
                    </div>
                    <div class="mb-3">
                      <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{auth()->user()->email}}" disabled>
                   <div class="form-text">Email Registrado: No Editable.</div>
                   </div>
                     <p class="mas">
                       <a class="btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                         <i class="fa-solid fa-circle-plus"><span>Aquí tus Links</span></i>
                       </a>                      
                     </p>
                     <div class="collapse mb-3" id="collapseExample">                      
                       <div class="card card-body collapse-form">
                          <!--
                          <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Cambiar Correo electrónico</label>
                            <input type="email" name="email_confirmation" class="form-control" id="exampleInputEmail2" aria-describedby="emailHelp">    
                          </div>  
                          <div class="mb-3">
                            <label for="password" class="form-label">Cambiar Contraseña</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword">
                          </div>                                     
                          <div class="mb-3">
                           <label for="del_password" class="form-label">Repita Contraseña</label>
                           <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword2">
                          </div>   
                          -->    
                          @if ($user->id_rango === null)    
                         <div class="mb-3">                                               
                          <p>Seleccione un Rango y Guarde los Cambios</p>
                         </div>     
                          @elseif ($user->id_rango === '2')    
                         <div class="mb-3">
                          <input type="text" class="form-control" value="{{auth()->user()->link_kappo}}" disabled>                      
                          <div class="form-text">Link de ventas MarketPlace: No Editable.</div>
                         </div>   
                         @elseif ($user->id_rango === '3')                         
                         <div class="mb-3">
                          <input type="text" class="form-control" value="{{auth()->user()->link_argtravels}}" disabled>                      
                          <div class="form-text">Link de ventas Turismo: No Editable.</div>
                         </div> 
                         @elseif($user->id_rango === '1' || $user->id_rango >= '4')       
                        <!-- <div class="mb-3">
                          <input type="text" class="form-control" value="{{auth()->user()->link_kappo}}" disabled>                      
                          <div class="form-text">Link de ventas MarketPlace: No Editable.</div>
                         </div> -->
                         <div class="mb-3">
                          <input type="text" class="form-control" value="{{auth()->user()->link_argtravels}}" disabled>                      
                          <div class="form-text">Link de ventas Turismo: No Editable.</div>
                         </div>                      
                         <div class="mb-3">
                          <input type="text" class="form-control" value="{{auth()->user()->link_sumate}}" disabled>                      
                          <div class="form-text">Link para reclutamiento de equipo: No Editable.</div>
                         </div> 
                         @endif                  
                       </div>
                    </div>    
                    <div class="mb-3 form-floating">                    
                     <select name="rango" class="form-select">                        
                          @if ($user->id_rango === '1')
                               @php
                                   $count = 1;
                               @endphp
                               @foreach ($rangos as $rango)
                               @if ($count >= 1)
                                       <option value="{{ $rango->id }}" {{ $user->id_rango == $rango->id ? 'selected' : '' }}>
                                           {{ $rango->nombre }}
                                       </option>
                               @endif
                                   @php
                                       $count++;
                                   @endphp
                               @endforeach
                          @elseif ($user->id_rango === '2' || $user->id_rango === '3' || $user->id_rango === null )
                               @php
                                   $count = 1;
                               @endphp
                               @foreach ($rangos as $rango)
                               @if ($count > 1)
                                   @if ($rango->id === 2 || $rango->id === 3 || $rango->id === 4)                                       
                                       <option value="{{ $rango->id }}" {{ $user->id_rango == $rango->id ? 'selected' : '' }}>
                                           {{ $rango->nombre }}
                                       </option>
                                   @else
                                       <option value="{{ $rango->id }}" disabled>
                                       {{ $rango->nombre }}
                                       </option>    
                                   @endif
                               @endif
                                   @php
                                       $count++;
                                   @endphp
                               @endforeach
                            @elseif ($user->id_rango === '4')
                               @php
                                   $count = 1;
                               @endphp
                               @foreach ($rangos as $rango)
                               @if ($count > 1)
                                   @if ($rango->id === 4 || $rango->id === 5)                                       
                                       <option value="{{ $rango->id }}" {{ $user->id_rango == $rango->id ? 'selected' : '' }}>
                                           {{ $rango->nombre }}
                                       </option>
                                   @else
                                       <option value="{{ $rango->id }}" disabled>
                                       {{ $rango->nombre }}
                                       </option>    
                                   @endif
                               @endif
                                   @php
                                       $count++;
                                   @endphp
                               @endforeach
                            @elseif ($user->id_rango === '5')
                               @php
                                   $count = 1;
                               @endphp
                               @foreach ($rangos as $rango)
                               @if ($count > 1)
                                   @if ($rango->id === 5 || $rango->id === 6)                                       
                                       <option value="{{ $rango->id }}" {{ $user->id_rango == $rango->id ? 'selected' : '' }}>
                                           {{ $rango->nombre }}
                                       </option>
                                   @else
                                       <option value="{{ $rango->id }}" disabled>
                                       {{ $rango->nombre }}
                                       </option>    
                                   @endif
                               @endif
                                   @php
                                       $count++;
                                   @endphp
                               @endforeach
                            @elseif ($user->id_rango === '6')
                               @php
                                   $count = 1;
                               @endphp
                               @foreach ($rangos as $rango)
                               @if ($count > 1)
                                   @if ($rango->id === 6 || $rango->id === 7)                                       
                                       <option value="{{ $rango->id }}" {{ $user->id_rango == $rango->id ? 'selected' : '' }}>
                                           {{ $rango->nombre }}
                                       </option>
                                   @else
                                       <option value="{{ $rango->id }}" disabled>
                                       {{ $rango->nombre }}
                                       </option>    
                                   @endif
                               @endif
                                   @php
                                       $count++;
                                   @endphp
                               @endforeach
                            @elseif ($user->id_rango === '7')
                               @php
                                   $count = 1;
                               @endphp
                               @foreach ($rangos as $rango)
                               @if ($count > 1)
                                   @if ($rango->id === 7 || $rango->id === 8)                                       
                                       <option value="{{ $rango->id }}" {{ $user->id_rango == $rango->id ? 'selected' : '' }}>
                                           {{ $rango->nombre }}
                                       </option>
                                   @else
                                       <option value="{{ $rango->id }}" disabled>
                                       {{ $rango->nombre }}
                                       </option>    
                                   @endif
                               @endif
                                   @php
                                       $count++;
                                   @endphp
                               @endforeach
                            @elseif ($user->id_rango === '8')
                               @php
                                   $count = 1;
                               @endphp
                               @foreach ($rangos as $rango)
                               @if ($count > 1)
                                   @if ($rango->id === 8 || $rango->id === 9)                                       
                                       <option value="{{ $rango->id }}" {{ $user->id_rango == $rango->id ? 'selected' : '' }}>
                                           {{ $rango->nombre }}
                                       </option>
                                   @else
                                       <option value="{{ $rango->id }}" disabled>
                                       {{ $rango->nombre }}
                                       </option>    
                                   @endif
                               @endif
                                   @php
                                       $count++;
                                   @endphp
                               @endforeach
                            @elseif ($user->id_rango === '9')
                               @php
                                   $count = 1;
                               @endphp
                               @foreach ($rangos as $rango)
                               @if ($count > 1)
                                   @if ($rango->id === 9)                                       
                                       <option value="{{ $rango->id }}" {{ $user->id_rango == $rango->id ? 'selected' : '' }}>
                                           {{ $rango->nombre }}
                                       </option>
                                   @else
                                       <option value="{{ $rango->id }}" disabled>
                                       {{ $rango->nombre }}
                                       </option>    
                                   @endif
                               @endif
                                   @php
                                       $count++;
                                   @endphp
                               @endforeach                            
                          @else
                               <option value="" disabled selected>Seleccionar</option>
                               @php
                                   $count = 1;
                               @endphp
                               @foreach ($rangos as $rango)
                                   @if ($count > 1)
                                       <option value="{{ $rango->id }}">
                                           {{ $rango->nombre }}
                                       </option>
                                   @endif
                                   @php
                                       $count++;
                                   @endphp
                               @endforeach
                           @endif                      
                       </select>     
                      <label for="provincia" class="form-label">Rango Actual</label>
                      <div class="form-text">Accede al Siguiente Rango para Ampliar tu Equipo.</div>
                    </div>                     
                    <div class="mb-3 form-floating">
                      <input type="text" name="nombre" placeholder="Nombre" class="form-control" 
                      @if (auth()->user()->nombre)
                      value="{{ auth()->user()->nombre }}"
                      @else
                      value="{{ old('nombre') }}"
                      @endif >                      
                      <label for="nombre" class="form-label">Nombre/s</label>                                            
                    </div>
                    <div class="mb-3 form-floating">
                      <input type="text" name="apellido" placeholder="Apellido" class="form-control" value="{{auth()->user()->apellido}}">
                      <label for="apellido" class="form-label">Apellido/s</label>                                            
                    </div>
                    <div class="mb-3">
                        <div class="edit-opcion-dni form-floating">
                           <select name="dni_select" class="form-select" aria-label="Default select example" required>                               
                               @if ($user->dni_select) 
                                   <option selected value="{{auth()->user()->dni_select}}">{{auth()->user()->dni_select}} </option>
                               @endif 
                                   <option value="DNI">DNI</option>
                                   <option value="PASAPORTE">PASAPORTE</option>
                                   <option value="LC">LC</option>
                                   <option value="OTRO">Otro</option>
                           </select>     
                           <label for="pais" class="form-label">Tipo Documento</label>                      
                       </div>                      
                    </div>
                    <div class="mb-3 form-floating">
                      <input type="text" name="dni_num" placeholder="Apellido" class="form-control" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="{{auth()->user()->dni_num}}">
                      <label for="dni" class="form-label">Numero Documento</label>                                            
                    </div>
                    <div class="mb-3 form-floating">
                      <input type="text" name="cod_area" placeholder="Código Area Telefónica" class="form-control" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="{{auth()->user()->movil_area}}">
                      <label for="cod_area" class="form-label">Código Area Telefónica</label>                                            
                    </div>
                    <div class="mb-3 form-floating">
                      <input type="text" name="movil" placeholder="Numero móvil" class="form-control" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="{{auth()->user()->movil_num}}">
                      <label for="movil" class="form-label">Numero Móvil</label>                                            
                    </div>
                    <div class="mb-3 form-floating">
                      <input type="text" name="direccion" placeholder="Dirección" class="form-control" value="{{auth()->user()->direccion}}">
                      <label for="direccion" class="form-label">Dirección</label>                                            
                    </div>
                    <div class="mb-3 form-floating">
                      <input type="text" name="ciudad" placeholder="Ciudad" class="form-control" value="{{auth()->user()->ciudad}}">
                      <label for="ciudad" class="form-label">Ciudad</label>                                            
                    </div>  
                    <div class="mb-3 form-floating">                    
                      <select name="provincia" class="form-select">
                         @php
                         $provinciasOrdenadas = $provincias->sortBy(function ($provincia) {
                         return $provincia->pais->nombre . ' ' . $provincia->nombre;
                         });
                         @endphp
                         @if ($user->id_provincia)
                         @foreach ($provinciasOrdenadas as $provincia)
                             <option value="{{ $provincia->id }}" {{ $user->id_provincia == $provincia->id ? 'selected' : '' }}>
                                 {{ $provincia->pais->nombre }} -- {{ $provincia->nombre }}
                             </option>
                         @endforeach
                         @else
                             <option value="" disabled selected>Seleccionar</option>
                         @foreach ($provinciasOrdenadas as $provincia)
                             <option value="{{ $provincia->id }}">
                          {{ $provincia->pais->nombre }} -- {{ $provincia->nombre }}
                             </option>
                         @endforeach
                         @endif                      
                       </select>
                      <label for="provincia" class="form-label">Provincia / Estado</label>
                    </div>                                            
                   <div class="mb-3 form-floating">
                     <select name="pais" class="form-select" onchange="mostrarBandera(this)">
                        @if ($user->id_pais)
                        @foreach ($paises as $pais)                       
                        <option value="{{ $pais->cod_pais }}" data-nombre-img="{{ $pais->nombre }}" {{ $user->id_pais == $pais->cod_pais ? 'selected' : '' }}>
                        {{ $pais->nombre_img }} ({{ $pais->cod_pais }})
                        </option>
                        @endforeach
                           @else <!-- Si el campo id_pais está vacío o nulo -->
                        <option value="" data-nombre-img="" disabled selected>Seleccione su País</option>
                        @foreach ($paises as $pais)
                        <option value="{{ $pais->cod_pais }}" data-nombre-img="{{ $pais->nombre}}">
                            {{ $pais->nombre_img }} ({{ $pais->cod_pais }})
                        </option>
                        @endforeach
                        @endif
                      </select>
                      <label for="pais" class="form-label">País</label>
                   </div>
                   <div class="mb-3" id="bandera-container">
                       @if ($user->id_pais)
                       <?php
                           $pais_editado = $paises->firstWhere('cod_pais', $user->id_pais);
                       ?>
                       @if ($pais_editado)
                       <div class="contenido-opcion-bandera d-flex">
                           <img id="bandera-img" src="{{ asset('assets/img_banderas/' . $pais_editado->nombre . '.png') }}" alt="Bandera del país" width="50">
                       </div>
                       @endif
                       @endif
                   </div>  
                   <div class="mb-3">
                      <label for="profile_image">Imagen de perfil</label>
                      <input type="file" name="profile_image" id="profile_image" class="form-control">
                   </div>  
                   @if ($errors->has('profile_image'))
                   <div class="alert alert-danger mt-1">
                    <span class="">{{ $errors->first('profile_image') }}</span>
                   </div>
                   @endif                       
                    <button type="submit" class="btn btn-primary">Enviar</button>
                  </form>
            </div>
        </div>
    </div>
  @endauth  
  @endsection
<script>
  function mostrarBandera(selectElement) {
    var banderaElement = document.getElementById('bandera-img');
    var banderaContainer = document.getElementById('bandera-container');
    var seleccion = selectElement.options[selectElement.selectedIndex];
    var cod_pais = seleccion.value; // Aquí obtenemos el valor del código del país.
    var nombre_img = seleccion.getAttribute('data-nombre-img'); // Aquí obtenemos el valor del atributo personalizado.

    var banderaUrl = '{{ asset('assets/img_banderas/') }}' + '/' + nombre_img.replace(/ /g, '-') + '.png';

    if (banderaElement) {
        banderaElement.src = banderaUrl;
    } else {
        // Si no hay imagen de bandera previa, creamos el elemento img.
        var img = document.createElement('img');
        img.src = banderaUrl;
        img.alt = 'Bandera del país';
        img.width = 50;
        img.id = 'bandera-img';
        banderaContainer.appendChild(img);
    }
}
</script>