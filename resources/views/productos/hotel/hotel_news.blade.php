@extends('layouts.app-master')

@if (Auth::check() && Auth::user()->id_rango === 1)
@section('content')
     <div class="container w-50 form-edit">
        <div class="row">
           <div class="col conten-login">   
            <p>ALTA DE HOTELES</p>       
                 <form class="form-horizontal" method="POST" action="{{ route('hotel.store') }}" enctype="multipart/form-data">
                     {{ csrf_field() }}
                     <div class="mb-3 form-floating">
                       <select name="id_prov" class="form-select">                        
                          @foreach ($proveedores as $proveedor)                       
                            <option value="{{ $proveedor->id }}" data-nombre-img="{{ $proveedor->empresa }}">
                            {{ $proveedor->empresa }}
                            </option>
                          @endforeach                          
                       </select>
                       <label for="pais" class="form-label">Proveedor</label>
                     </div>
                     <div class="mb-3 form-group form-floating">
                        <input type="text" class="form-control" name="nombre" placeholder="Nombre Hotel" required>
                        <label for="nombre" class="control-label">Nombre Hotel</label>
                     </div>  
                     <div class="mb-3 form-group form-floating">
                        <input type="number" value="5" class="form-control" name="categoria" placeholder="Categoría" min="1" max="7" required>
                        <label for="categoria" class="control-label">Categoría Estrellas</label>
                     </div> 
                     <div class="mb-3 form-floating">                 
                        <select name="id_ciudad" class="form-select">                                    
                               @foreach ($ciudades as $ciudad)
                                <option value="{{ $ciudad->id }}" {{ (old('ciudad') == $ciudad->id) ? 'selected' : '' }}>
                                       {{ $ciudad->ciudad_destino }}
                                   </option>
                               @endforeach
                         </select> 
                         <label for="destino" class="col-md-4 control-label">Ciudad Destino</label> 
                     </div>      
                     <div class="mb-3 form-floating">
                       <select name="id_pais" class="form-select">                        
                          @foreach ($paises as $pais)                       
                            <option value="{{ $pais->id }}" data-nombre-img="{{ $pais->nombre }}">
                            {{ $pais->nombre_img }}
                            </option>
                          @endforeach                          
                       </select>
                       <label for="pais" class="form-label">País</label>
                     </div>
                     <div class="mb-3 form-group form-floating">       
                         <select name="tipo_publico" class="form-select" aria-label="Default select example">  
                            <option value="Apto todo Publico">Apto todo Publico</option>
                            <option value="Niños Mayores de 6 años">Niños Mayores de 6 años</option>
                            <option value="Solo Adultos">Solo Adultos</option>
                         </select>  
                         <label for="publico" class="col-md-4 control-label">¿Apto todo Publico?</label>
                     </div>     
                     <div class="mb-3 form-group form-floating">
                        <input type="file" class="form-control" name="img_banner" placeholder="Banner" value="{{ old('img_banner') }}" required>
                        <label for="img_banner" class="col-md-12 control-label">Banner (1350x500)</label>
                     </div>
                     <div class="mb-3 form-group form-floating">
                        <input type="file" class="form-control" placeholder="Imagenes (Max. 15)" name="imagenes[]" accept="image/*" value="{{ old('imagenes') }}" multiple> 
                        <label for="imagenes" class="col-md-12 control-label">Imagenes (Max. 15)</label>    
                     </div>                     
                     <div class="form-group">
                        <label for="detalles" class="col-md-4 control-label">Info del Hotel</label>
                        <div class="">
                           <textarea class="form-control" name="detalles" rows="5">{{ old('detalle') }}</textarea>
                        </div>
                     </div>                                 
                     <div class="mt-2">
                        <button type="submit" class="btn btn-primary">
                            GUARDAR
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