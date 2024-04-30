@extends('layouts.app-master')

@if (Auth::check() && Auth::user()->id_rango === 1)
@section('content')
     <div class="container w-50 form-edit">
        <div class="row">
           <div class="col conten-login">   
            <p>ALTA DE HOTELES</p>       
                 <form class="form-horizontal" method="POST" action="{{ route('hotel.store') }}" enctype="multipart/form-data">
                     {{ csrf_field() }}
                     <div class="mb-3 form-group form-floating">
                        <input type="text" class="form-control" name="nombre" placeholder="Nombre Hotel" required>
                        <label for="nombre" class="control-label">Nombre Hotel</label>
                     </div>  
                     <div class="mb-3 form-floating">                 
                        <select name="destino" class="form-select">                                    
                               @foreach ($destinos as $destino)
                                <option value="{{ $destino->id }}" {{ (old('ciudad_destino') == $destino->id) ? 'selected' : '' }}>
                                       {{ $destino->nombre_destino }}
                                   </option>
                               @endforeach
                         </select> 
                         <label for="destino" class="col-md-4 control-label">Ciudad Destino</label> 
                     </div>      
                     <div class="mb-3 form-floating">
                       <select name="pais" class="form-select">                        
                          @foreach ($paises as $pais)                       
                            <option value="{{ $pais->cod_pais }}" data-nombre-img="{{ $pais->nombre }}">
                            {{ $pais->nombre_img }}
                            </option>
                          @endforeach                          
                       </select>
                       <label for="pais" class="form-label">País</label>
                     </div>
                     <div class="mb-3 form-group form-floating">       
                         <select name="comidas" class="form-select" aria-label="Default select example">  
                            <option value="All Inclusive">All Inclusive</option>
                            <option value="Desayuno">Desayuno</option>
                            <option value="Media Pensión">Media Pensión</option>
                            <option value="Solo Hospedaje">Solo Hospedaje</option>
                         </select>  
                         <label for="comidas" class="col-md-4 control-label">¿Servicio de Gastronomía?</label>
                     </div>                   
                     <div class="mb-3 form-group form-floating">
                        <input type="number" value="5" class="form-control" name="categoria" placeholder="Categoría" min="1" max="7" required>
                        <label for="categoria" class="control-label">Categoría</label>
                     </div>   
                     <div class="mb-3 form-group form-floating">       
                         <select name="publico" class="form-select" aria-label="Default select example">  
                            <option value="Publico">Apto Publico</option>
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
                     <div class="col-md-12 d-flex">
                         <div class="col-md-4">
                            <div class="mb-3 form-group form-floating">
                               <div class="form-check">                            
                                  <label class="form-check-label" for="WIFI">
                                      WIFI?
                                  </label>
                                <input class="form-check-input" type="checkbox" name="wifi" value="WIFI">
                               </div>
                            </div>                          
                            <div class="mb-3 form-group form-floating">
                               <div class="form-check">                            
                                   <label class="form-check-label" for="gym">
                                       Gimnasio?
                                   </label>
                                   <input class="form-check-input" type="checkbox" name="gym" value="GIMNACIO">
                               </div>
                            </div>                      
                            <div class="mb-3 form-group form-floating">
                               <div class="form-check">
                                   <input class="form-check-input" type="checkbox" name="spa" value="SPA">
                                   <label class="form-check-label" for="spa">
                                       SPA?
                                   </label>
                               </div>
                            </div> 
                         </div>
                         <div class="col-md-4">
                            <div class="mb-3 form-group form-floating">
                               <div class="form-check">                            
                                  <label class="form-check-label" for="parking">
                                      PARKING?
                                  </label>
                                <input class="form-check-input" type="checkbox" name="parking" value="WIFI">
                               </div>
                            </div>                          
                            <div class="mb-3 form-group form-floating">
                               <div class="form-check">                            
                                   <label class="form-check-label" for="traslados">
                                       TRASLADOS?
                                   </label>
                                   <input class="form-check-input" type="checkbox" name="traslados" value="GIMNACIO">
                               </div>
                            </div>                      
                            <div class="mb-3 form-group form-floating">
                               <div class="form-check">
                               <!--    <input class="form-check-input" type="checkbox" name="spa" value="SPA">
                                   <label class="form-check-label" for="spa">
                                      
                                   </label> -->
                               </div>
                            </div> 
                         </div>
                         <div class="col-md-4">
                            <div class="mb-3 form-group form-floating">
                               <div class="form-check">                            
                              <!--    <label class="form-check-label" for="WIFI">
                                     
                                  </label>
                                <input class="form-check-input" type="checkbox" name="wifi" value="WIFI"> -->
                               </div>
                            </div>                          
                            <div class="mb-3 form-group form-floating">
                               <div class="form-check">                            
                                 <!--  <label class="form-check-label" for="gym">
                                       
                                   </label>
                                   <input class="form-check-input" type="checkbox" name="gym" value="GIMNACIO"> -->
                               </div>
                            </div>                      
                            <div class="mb-3 form-group form-floating">
                               <div class="form-check">
                                  <!-- <input class="form-check-input" type="checkbox" name="spa" value="SPA"> 
                                   <label class="form-check-label" for="spa">
                                       
                                   </label> -->
                               </div>
                            </div> 
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