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
              <p>EDITAR PRODUCTO</p>  
                <form class="form-horizontal" method="POST" action="{{ route('hotel.updateProcess', ['id' => $hotel->id]) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}                        
                        <div class="mb-3 form-group">
                            <label for="nombre" class="col-md-4 control-label">Nombre Hotel</label>
                            <div class="">
                                <input type="text" class="form-control" name="nombre" value="{{ $hotel->nombre }}" required>
                            </div>
                        </div>
                        <div class="mb-3 form-floating">                 
                          <select name="destino" class="form-select">
                             @foreach ($destinos as $destino)
                               <option value="{{ $destino->id }}" {{ ($hotel->destino == $destino->id) ? 'selected' : '' }}>
                                   {{ $destino->nombre_destino }}
                               </option>
                             @endforeach
                          </select>
                         <label for="destino" class="col-md-4 control-label">Ciudad Destino</label> 
                     </div>      
                     <div class="mb-3 form-floating">
                       <select name="pais" class="form-select">
                             @foreach ($paises as $pais)
                               <option value="{{ $pais->id }}" {{ ($hotel->pais == $pais->cod_pais) ? 'selected' : '' }}>
                                   {{ $pais->nombre_img }}
                               </option>
                             @endforeach
                          </select>
                       <label for="pais" class="form-label">País</label>
                     </div>
                     <div class="mb-3 form-group form-floating">       
                         <select name="comidas" class="form-select" aria-label="Default select example">  
                            @if ($hotel->comidas)
                                      <option value="{{ $hotel->comidas }}" selected>
                                        {{ $hotel->comidas }}
                                      </option>
                                    @endif
                            <option value="All Inclusive">All Inclusive</option>
                            <option value="Desayuno">Desayuno</option>
                            <option value="Media Pensión">Media Pensión</option>
                            <option value="Solo Hospedaje">Solo Hospedaje</option>
                         </select>  
                         <label for="comidas" class="col-md-4 control-label">¿Servicio de Gastronomía?</label>
                     </div>   
                        <div class="form-group">
                            <label for="codigo" class="col-md-4 control-label">Categoria Hotel</label>
                            <div class="">
                                <input type="text" class="form-control" name="categoria" value="{{ $hotel->categoria }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                           <label for="publico" class="col-md-4 control-label">¿Apto todo Publico?</label>
                            <div class="">
                                <select name="publico" class="form-select" aria-label="Default select example">  
                                    @if ($hotel->publico)
                                      <option value="{{ $hotel->publico }}" selected>
                                        {{ $hotel->publico }}
                                      </option>
                                    @endif
                                   <option value="Publico">Apto Publico</option>
                                   <option value="Niños Mayores de 6 años">Niños Mayores de 6 años</option>
                                   <option value="Solo Adultos">Solo Adultos</option>
                                </select>  
                            </div>
                        </div>   
                        <div class="col-md-12 d-flex">
                         <div class="col-md-4">
                            <div class="mb-3 form-group form-floating">
                               <div class="form-check">                            
                                  <label class="form-check-label" for="WIFI">
                                      WIFI?
                                  </label>
                                <input class="form-check-input" type="checkbox" name="wifi" value="1" @if($hotel->wifi == 1) checked @endif>
                               </div>
                            </div>                          
                            <div class="mb-3 form-group form-floating">
                               <div class="form-check">                            
                                   <label class="form-check-label" for="gym">
                                       Gimnasio?
                                   </label>
                                   <input class="form-check-input" type="checkbox" name="gym" value="1" @if($hotel->gym == 1) checked @endif>
                               </div>
                            </div>                      
                            <div class="mb-3 form-group form-floating">
                               <div class="form-check">
                                   <input class="form-check-input" type="checkbox" name="spa" value="1" @if($hotel->spa == 1) checked @endif>
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
                                <input class="form-check-input" type="checkbox" name="parking" value="1" @if($hotel->parking == 1) checked @endif>
                               </div>
                            </div>                          
                            <div class="mb-3 form-group form-floating">
                               <div class="form-check">                            
                                   <label class="form-check-label" for="traslados">
                                       TRASLADOS?
                                   </label>
                                   <input class="form-check-input" type="checkbox" name="traslados" value="1" @if($hotel->traslados == 1) checked @endif>
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
                               Guardar Cambios
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