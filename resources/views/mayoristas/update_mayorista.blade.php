@extends('layouts.app-master')

@if (Auth::check() && Auth::user()->id_rango === 1)
@section('content')
     <div class="container w-50 form-edit">
        <div class="row">
           <div class="col conten-login">   
            @if(session('success'))
              <div class="alert alert-success mt-2">
              {{ session('success') }}
              </div>
            @endif
              <p>EDITAR MAYORISTA</p>  
                <form class="form-horizontal" method="POST" action="{{ route('mayorista.updateProcess', ['id' => $mayorista->id]) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}   
                         <div class="form-floating mb-3">
                           <input type="text" class="form-control" name="empresa" placeholder="Empresa" value="{{ $mayorista->empresa }}" required>
                           <label for="empresa" class="form-label">Empresa</label>                  
                        </div>                   
                        <div class="form-floating mb-3">
                           <input type="text" class="form-control" name="contacto" placeholder="Contacto" value="{{ $mayorista->contacto }}">
                           <label for="contacto" class="form-label">Contacto</label>                  
                        </div>
                        <div class="mb-3 form-floating">
                              <input type="text" name="direccion" placeholder="Dirección" class="form-control" value="{{ $mayorista->direccion }}">
                              <label for="direccion" class="form-label">Dirección</label>                                            
                        </div>
                        <div class="mb-3 form-floating">
                           <input type="text" name="telefono" placeholder="Numero Teléfono" class="form-control" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="{{ $mayorista->telefono }}">
                           <label for="telefono" class="form-label">Numero teléfono</label>                                            
                       </div>                
                       <div class="form-floating mb-3">
                         <input type="email" name="email" placeholder="Correo electrónico" class="form-control" id="email" aria-describedby="emailHelp" value="{{ $mayorista->email }}">
                         <label for="email" class="form-label">Correo electrónico</label>                    
                       </div>
                       <div class="mb-3 form-floating">
                             <input type="text" name="localidad" placeholder="Localidad" class="form-control" value="{{ $mayorista->localidad }}">
                             <label for="localidad" class="form-label">Localidad</label>                                            
                       </div>   
                       <div class="mb-3 form-floating">
                             <input type="text" name="provincia" placeholder="Provincia" class="form-control" value="{{ $mayorista->provincia }}">
                             <label for="provincia" class="form-label">Provincia</label>                                            
                       </div>  
                       <div class="mb-3 form-floating">
                             <input type="text" name="pais" placeholder="Pais" class="form-control" value="{{ $mayorista->pais }}">
                             <label for="pais" class="form-label">Pais</label>                                            
                       </div>                       
                        <div class="mt-2">
                           <button type="submit" class="btn btn-primary">
                               Guardar Producto
                           </button>
                        </div> 
                </form>                 
            </div>                   
        </div>
    </div>
@endsection
@else
    @section('content')
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Acceso no autorizado</div>
                        <div class="panel-body">
                            <p>No tienes permiso para acceder a esta página.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
@endif