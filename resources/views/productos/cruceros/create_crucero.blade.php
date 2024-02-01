@extends('layouts.app-master')

@if (Auth::check() && Auth::user()->id_rango === 1)
@section('content')
     <div class="container w-50 form-edit">
        <div class="row">            
           <div class="col conten-login">   
              <p>ALTA DE CRUCEROS</p> 
              @if ($errors->has('codigo'))
              <div class="alert alert-danger my-3">
                {{ $errors->first('codigo') }}
              </div>
              @endif 
                <form class="form-horizontal" method="POST" action="{{ route('crucero.create') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="nombre" class="col-md-4 control-label">Destino</label>
                            <div class="">
                                <input id="nombre" type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" required>
                            </div>
                        </div>
                        <div class="form-row">                           
                           <div class="form-group ps-1">
                               <label for="fecha_vencimiento" class="col-form-label">Fecha Viaje</label>
                               <input type="date" name="fecha_vencimiento" class="form-control" required>
                           </div>
                        </div>      
                        <div class="form-group">
                            <label for="imagen" class="col-md-4 control-label">Imagen del Producto</label>
                            <div class="">
                                <input id="imagen" type="file" class="form-control" name="imagen" value="{{ old('imagen') }}" required>
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="naviera" class="col-md-4 control-label">Puerto de Salida</label>
                            <div class="">
                                <select name="puerto_salida" class="form-select" aria-label="Default select example">  
                                    <option value="Costa Cruceros" @if(old('naviera') == 'Costa Cruceros') selected @endif>Costa Cruceros</option>
                                    <option value="MSC Cruceros" @if(old('naviera') == 'MSC Cruceros') selected @endif>MSC Cruceros</option>
                                    <option value="Royal Caribbean" @if(old('naviera') == 'Royal Caribbean') selected @endif>Royal Caribbean</option>
                                    <option value="Celebrity Cruises" @if(old('naviera') == 'Celebrity Cruises') selected @endif>Celebrity Cruises</option>
                                    <option value="Azamara Cruises" @if(old('naviera') == 'Azamara Cruises') selected @endif>Azamara Cruises</option>
                                </select>  
                            </div>
                        </div>    
                         <div class="form-group">
                            <label for="puerto_salida" class="col-md-4 control-label">Puerto de Salida</label>
                            <div class="">
                                <select name="puerto_salida" class="form-select" aria-label="Default select example">  
                                    <option value="Bs. As." @if(old('puerto_salida') == 'Bs. As.') selected @endif>Bs. As.</option>
                                    <option value="Brasil" @if(old('puerto_salida') == 'Brasil') selected @endif>Brasil</option>
                                    <option value="Otor" @if(old('puerto_salida') == 'Otro') selected @endif>Otro</option>
                                </select>  
                            </div>
                        </div>    
                        <div class="form-group">
                            <label for="habitacion" class="col-md-4 control-label">Tipo de Cabina</label>
                            <div class="">
                                <select name="cabina" class="form-select" aria-label="Default select example">  
                                    <option value="Cabina Interior" @if(old('cabina') == 'Cabina Interior') selected @endif>Cabina Interior</option>
                                    <option value="Cabina Exterior" @if(old('cabina') == 'Cabina Exterior') selected @endif>Cabina Exterior</option>
                                    <option value="Cabina Balcon" @if(old('cabina') == 'Cabina Balcon') selected @endif>Cabina Balcon</option>
                                    <option value="Cabina Suite" @if(old('cabina') == 'Cabina Suite') selected @endif>Cabina Suite</option>
                                </select>                                 
                            </div>
                        </div>                        
                          <div class="form-group">
                           <p class="mas my-2">
                             <a class="btn-primary" data-bs-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample">
                             <i class="fa-solid fa-circle-plus"><span>Servicios incluidos</span></i>
                             </a>                      
                           </p>
                           <div class="collapse mb-3 edit" id="collapseExample1">                      
                               <div class="card card-body collapse-form">                                  
                                  <div class="form-group">
                                   <label for="traslados_orig" class="col-md-4 control-label">Traslados en Origen</label>
                                      <div class="">
                                          <select name="traslados_orig" class="form-select" aria-label="Default select example"> 
                                            <option value="No Incluye" @if(old('traslados_orig') == 'No Incluye') selected @endif>No Incluye</option>
                                            <option value="Rosario" @if(old('traslados_orig') == 'Rosario') selected @endif>Desde Rosario</option> 
                                            <option value="Aeropuerto" @if(old('traslados_orig') == 'Aeropuerto') selected @endif>Desde Aeropuerto</option>                                                                                      
                                          </select>  
                                      </div>
                                  </div>   
                                  <div class="form-group">
                                   <label for="traslados_dest" class="col-md-4 control-label">Traslados en Destino</label>
                                      <div class="">
                                          <select name="traslados_dest" class="form-select" aria-label="Default select example">                                             
                                            <option value="No Incluye" @if(old('traslados_dest') == 'No Incluye') selected @endif>No Incluye</option>
                                            <option value="Incluye Traslados" @if(old('traslados_dest') == 'Incluye Traslados') selected @endif>Incluye Traslados</option>
                                          </select>  
                                      </div>
                                  </div>                                        
                                  <div class="form-group">
                                   <label for="comidas" class="col-md-4 control-label">Comidas</label>
                                      <div class="">
                                          <select name="comidas" class="form-select" aria-label="Default select example"> 
                                            <option value="All Inclusive" @if(old('comidas') == 'All Inclusive') selected @endif>All Inclusive</option>
                                            <option value="Desayuno" @if(old('comidas') == 'Desayuno') @endif>Desayuno</option>
                                            <option value="Media Pensión" @if(old('comidas') == 'Media Pensión') @endif>Media Pensión</option>
                                            <option value="Otros" @if(old('comidas') == 'Otros') @endif>Otros</option>
                                          </select>  
                                      </div>
                                  </div>   
                                  <div class="form-group">
                                  <label for="seguro" class="col-md-4 control-label">Asistencia al viajero</label>
                                      <div class="">
                                          <select name="seguro" class="form-select" aria-label="Default select example"> 
                                            <option value="Asistencia al viajero" @if(old('seguro') == 'Asistencia al viajero') selected @endif>Asistencia al viajero</option>
                                            <option value="SIN Asistencia al viajero" @if(old('seguro') == 'SIN Asistencia al viajero') selected @endif>SIN Asistencia al viajero</option>
                                          </select>  
                                      </div>
                                  </div>    
                                  <div class="form-group">
                                   <label for="propinas" class="col-md-4 control-label">Propinas</label>
                                      <div class="">
                                          <select name="propinas" class="form-select" aria-label="Default select example">                                             
                                            <option value="No Incluye" @if(old('propinas') == 'No Incluye') selected @endif>No Incluye Propinas</option>
                                            <option value="Incluye" @if(old('propinas') == 'Incluye') selected @endif>Incluye Propinas</option>
                                          </select>  
                                      </div>
                                  </div>                   
                               </div>
                          </div>  
                        </div>  
                        <div class="form-group">
                           <p class="mas my-2">
                             <a class="btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                             <i class="fa-solid fa-circle-plus"><span>Itinerarios / Excursiones</span></i>
                             </a>                      
                           </p>
                           <div class="collapse mb-3 edit" id="collapseExample">                      
                               <div class="card card-body collapse-form">
                                  <div class="form-floating mb-2">
                                     <input type="text" class="form-control" name="dia1" value="{{ old('dia1') }}" placeholder="Día 1">
                                     <label for="dia1" class="form-label">Día 1</label>
                                  </div>                                     
                                  <div class="form-floating mb-2">
                                     <input type="text" class="form-control" name="dia2" value="{{ old('dia2') }}" placeholder="Día 2">
                                     <label for="dia2" class="form-label">Día 2</label>
                                  </div> 
                                  <div class="form-floating mb-2">
                                     <input type="text" class="form-control" name="dia3" value="{{ old('dia3') }}" placeholder="Día 3">
                                     <label for="dia3" class="form-label">Día 3</label>
                                  </div> 
                                  <div class="form-floating mb-2">
                                     <input type="text" class="form-control" name="dia4" value="{{ old('dia4') }}" placeholder="Día 4">
                                     <label for="dia4" class="form-label">Día 4</label>
                                  </div> 
                                  <div class="form-floating mb-2">
                                     <input type="text" class="form-control" name="dia5" value="{{ old('dia5') }}" placeholder="Día 5">
                                     <label for="dia5" class="form-label">Día 5</label>
                                  </div> 
                                  <div class="form-floating mb-2">
                                     <input type="text" class="form-control" name="dia6" value="{{ old('dia6') }}" placeholder="Día 6">
                                     <label for="dia6" class="form-label">Día 6</label>
                                  </div> 
                                  <div class="form-floating mb-2">
                                     <input type="text" class="form-control" name="dia7" value="{{ old('dia7') }}" placeholder="Día 7">
                                     <label for="dia7" class="form-label">Día 7</label>
                                  </div> 
                                  <div class="form-floating mb-2">
                                     <input type="text" class="form-control" name="dia8" value="{{ old('dia8') }}" placeholder="Día 8">
                                     <label for="dia8" class="form-label">Día 8</label>
                                  </div> 
                                  <div class="form-floating mb-2">
                                     <input type="text" class="form-control" name="dia9" value="{{ old('dia9') }}" placeholder="Día 9">
                                     <label for="dia9" class="form-label">Día 9</label>
                                  </div> 
                                  <div class="form-floating mb-2">
                                     <input type="text" class="form-control" name="dia10" value="{{ old('dia10') }}" placeholder="Día 10">
                                     <label for="dia10 class="form-label">Día 10</label>
                                  </div> 
                                  <div class="form-floating mb-2">
                                     <input type="text" class="form-control" name="dia11" value="{{ old('dia11') }}" placeholder="Día 11">
                                     <label for="dia11" class="form-label">Día 11</label>
                                  </div> 
                                  <div class="form-floating mb-2">
                                     <input type="text" class="form-control" name="dia12" value="{{ old('dia12') }}" placeholder="Día 12">
                                     <label for="dia12" class="form-label">Día 12</label>
                                  </div> 
                                  <div class="form-floating mb-2">
                                     <input type="text" class="form-control" name="dia13" value="{{ old('dia13') }}" placeholder="Día 13">
                                     <label for="dia13" class="form-label">Día 13</label>
                                  </div> 
                                  <div class="form-floating mb-2">
                                     <input type="text" class="form-control" name="dia14" value="{{ old('dia14') }}" placeholder="Día 14">
                                     <label for="dia14" class="form-label">Día 14</label>
                                  </div> 
                                  <div class="form-floating mb-2">
                                     <input type="text" class="form-control" name="dia15" value="{{ old('dia15') }}" placeholder="Día 15">
                                     <label for="dia15" class="form-label">Día 15</label>
                                  </div>                             
                               </div>
                          </div>  
                        </div>  
                        <div class="form-group">
                            <label for="destinoGral" class="col-md-4 control-label">Destino General</label>
                            <div class="">
                                <select name="destinoGral" class="form-select" aria-label="Default select example">  
                                    <option value="Mundo" @if(old('destinoGral') == 'Mundo') selected @endif>Mundo</option>
                                    <option value="Tur-Arg" @if(old('destinoGral') == 'Tur-Arg') selected @endif>Tur-Arg</option>
                                    <option value="Brasil" @if(old('destinoGral') == 'Brasil') selected @endif>Brasil</option>
                                    <option value="Caribe" @if(old('destinoGral') == 'Caribe') selected @endif>Caribe</option>
                                    <option value="Europa" @if(old('destinoGral') == 'Europa') selected @endif>Europa</option>                                    
                                </select>                                 
                            </div>
                        </div>                              
                        <div class="form-group">
                            <label for="puerto_salida" class="col-md-4 control-label">Puerto de Salida</label>
                            <div class="">
                                <select name="puerto_salida" class="form-select" aria-label="Default select example">  
                                    <option value="Bs. As." @if(old('puerto_salida') == 'Bs. As.') selected @endif>Bs. As.</option>
                                    <option value="Brasil" @if(old('puerto_salida') == 'Brasil') selected @endif>Brasil</option>
                                    <option value="Otor" @if(old('puerto_salida') == 'Otro') selected @endif>Otro</option>
                                </select>  
                            </div>
                        </div>                       
                        <div class="form-group">
                            <label for="precio_total" class="col-md-4 control-label">Precio Total</label>
                            <div class="">
                                <input type="number" class="form-control" name="precio_total" value="{{ old('precio_total') }}" step="0.01" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="descto" class="col-md-4 control-label">Descto. Comunidad</label>
                            <div class="">
                                <input type="number" class="form-control" name="descto" value="1" step="0.01">
                            </div>
                        </div>                        
                        <div class="form-group">
                            <label for="moneda" class="col-md-4 control-label">Tipo de Moneda</label>
                            <div class="">
                                <select name="moneda" class="form-select" aria-label="Default select example">  
                                    <option value="USD" @if(old('moneda') == 'USD') selected @endif>USD</option>
                                    <option value="EUR" @if(old('moneda') == 'EUR') selected @endif>EUR</option>
                                    <option value="$" @if(old('moneda') == '$') selected @endif>$</option>                                    
                                </select>                                 
                            </div>
                        </div>     
                        <div class="form-group">
                            <label for="estadiaTotal" class="col-md-4 control-label">Estadía Total</label>
                            <div class="">
                                <input type="number" class="form-control" name="estadiaTotal" value="{{ old('estadiaTotal') }}" required>
                            </div>
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