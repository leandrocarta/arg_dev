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
              <p>EDITAR CRUCEROS</p>  
                       <form class="form-horizontal" method="POST" action="{{ route('crucero.update', ['id' => $producto->id]) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="id_naviera" class="col-md-4 control-label">NAVIERA</label>
                            <div class="">                            
                                <select name="id_naviera" class="form-select">                                      
                                    @foreach ($navieras as $naviera)
                                      <option value="{{ $naviera->id }}" {{ $producto->id_naviera == $naviera->id ? 'selected' : '' }}>
                                       {{ $naviera->naviera }}
                                      </option>
                                    @endforeach                              
                                </select>                           
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="id_barco" class="col-md-4 control-label">NOMBRE BARCO</label>
                            <div class="">                            
                                <select name="id_barco" class="form-select">                                      
                                    @foreach ($barcos as $barco)
                                      <option value="{{ $barco->id }}" {{ $producto->id_naviera == $barco->id_naviera ? 'selected' : '' }}>
                                       {{ $barco->nombre }}
                                      </option>
                                    @endforeach                              
                                </select>                           
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="destino" class="col-md-4 control-label">Destino</label>
                            <div class="">
                                <input type="text" class="form-control" name="destino" value="{{ $producto->destino }}">
                            </div>
                        </div>
                        <div class="form-row">                           
                           <div class="form-group ps-1">
                               <label for="fecha_partida" class="col-form-label">Fecha Viaje</label>
                               <input type="date" name="fecha_partida" class="form-control" value="{{ $producto->fecha_partida }}">
                           </div>
                        </div>      
                        <div class="form-group">
                            <label for="imagen" class="col-md-4 control-label">Imagen del Producto</label>
                            <div class="">
                                <input id="imagen" type="file" class="form-control" name="imagen">
                            </div>
                        </div>    
                        <div class="form-group">
                            <label for="estadia" class="col-md-4 control-label">Estadía</label>
                            <div class="">
                                <input type="number" class="form-control" name="estadia" value="{{ $producto->estadia }}">
                            </div>
                        </div>                      
                         <div class="form-group">
                            <label for="puerto_salida" class="col-md-4 control-label">Puerto de Salida</label>
                            <div class="">
                                <select name="puerto_salida" class="form-select" aria-label="Default select example">  
                                    <option value="{{ $producto->puerto_salida }}" @if(old('puerto_salida') == 'Bs. As.') selected @endif>{{ $producto->puerto_salida }}</option>
                                    <option value="Bs. As." @if(old('puerto_salida') == 'Bs. As.') selected @endif>Bs. As.</option>
                                    <option value="Brasil" @if(old('puerto_salida') == 'Brasil') selected @endif>Brasil</option>
                                    <option value="Otor" @if(old('puerto_salida') == 'Otro') selected @endif>Otro</option>
                                </select>  
                            </div>
                        </div>    
                        <div class="form-group">
                            <label for="tipo_cabina" class="col-md-4 control-label">Tipo de Cabina</label>
                            <div class="">
                                <select name="tipo_cabina" class="form-select" aria-label="Default select example">  
                                    <option value="{{ $producto->tipo_cabina }}" @if(old('tipo_cabina') == 'Cabina Interior') selected @endif>{{ $producto->tipo_cabina }}</option>
                                    <option value="Cabina Interior" @if(old('tipo_cabina') == 'Cabina Interior') selected @endif>Cabina Interior</option>
                                    <option value="Cabina Exterior" @if(old('tipo_cabina') == 'Cabina Exterior') selected @endif>Cabina Exterior</option>
                                    <option value="Cabina Balcon" @if(old('tipo_cabina') == 'Cabina Balcon') selected @endif>Cabina Balcon</option>
                                    <option value="Cabina Suite" @if(old('tipo_cabina') == 'Cabina Suite') selected @endif>Cabina Suite</option>
                                </select>                                 
                            </div>
                        </div>   
                        <div class="form-group">
                            <label for="detalle" class="col-md-4 control-label">Detalle</label>
                            <input type="text" class="form-control" name="detalle" value="{{ $producto->detalle }}">                            
                        </div> 
                        <div class="form-group">
                            <label for="moneda" class="col-md-4 control-label">Tipo de Moneda</label>
                            <div class="">
                                <select name="moneda" class="form-select" aria-label="Default select example">  
                                    <option value="{{ $producto->moneda }}" @if(old('moneda') == 'USD') selected @endif>{{ $producto->moneda }}</option>
                                    <option value="USD" @if(old('moneda') == 'USD') selected @endif>USD</option>
                                    <option value="EUR" @if(old('moneda') == 'EUR') selected @endif>EUR</option>
                                    <option value="$" @if(old('moneda') == '$') selected @endif>$</option>                                    
                                </select>                                 
                            </div>
                        </div>  
                        <div class="form-group">
                            <label for="precio" class="col-md-4 control-label">Precio Total</label>
                            <div class="">
                                <input type="number" class="form-control" name="precio" value="{{ $producto->precio }}" step="0.01" >
                            </div>
                        </div>   
                        @if($producto->itinerarios)
                        <div class="form-group">
                           <p class="mas my-2">
                             <a class="btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                             <i class="fa-solid fa-circle-plus"><span>Itinerarios x dia</span></i>
                             </a>                      
                           </p>
                           <div class="collapse mb-3 edit" id="collapseExample">                      
                               <div class="card card-body collapse-form">
                                  <div class="form-floating mb-2">
                                     <input type="text" class="form-control" name="dia1" value="{{ $producto->itinerarios->dia1 }}" placeholder="Día 1">
                                     <label for="dia1" class="form-label">Día 1</label>
                                  </div>                                     
                                  <div class="form-floating mb-2">
                                     <input type="text" class="form-control" name="dia2" value="{{ $producto->itinerarios->dia2 }}" placeholder="Día 2">
                                     <label for="dia2" class="form-label">Día 2</label>
                                  </div> 
                                  <div class="form-floating mb-2">
                                     <input type="text" class="form-control" name="dia3" value="{{ $producto->itinerarios->dia3 }}" placeholder="Día 3">
                                     <label for="dia3" class="form-label">Día 3</label>
                                  </div> 
                                  <div class="form-floating mb-2">
                                     <input type="text" class="form-control" name="dia4" value="{{ $producto->itinerarios->dia4 }}" placeholder="Día 4">
                                     <label for="dia4" class="form-label">Día 4</label>
                                  </div> 
                                  <div class="form-floating mb-2">
                                     <input type="text" class="form-control" name="dia5" value="{{ $producto->itinerarios->dia5 }}" placeholder="Día 5">
                                     <label for="dia5" class="form-label">Día 5</label>
                                  </div> 
                                  <div class="form-floating mb-2">
                                     <input type="text" class="form-control" name="dia6" value="{{ $producto->itinerarios->dia6 }}" placeholder="Día 6">
                                     <label for="dia6" class="form-label">Día 6</label>
                                  </div> 
                                  <div class="form-floating mb-2">
                                     <input type="text" class="form-control" name="dia7" value="{{ $producto->itinerarios->dia7 }}" placeholder="Día 7">
                                     <label for="dia7" class="form-label">Día 7</label>
                                  </div> 
                                  <div class="form-floating mb-2">
                                     <input type="text" class="form-control" name="dia8" value="{{ $producto->itinerarios->dia8 }}" placeholder="Día 8">
                                     <label for="dia8" class="form-label">Día 8</label>
                                  </div> 
                                  <div class="form-floating mb-2">
                                     <input type="text" class="form-control" name="dia9" value="{{ $producto->itinerarios->dia9 }}" placeholder="Día 9">
                                     <label for="dia9" class="form-label">Día 9</label>
                                  </div> 
                                  <div class="form-floating mb-2">
                                     <input type="text" class="form-control" name="dia10" value="{{ $producto->itinerarios->dia10 }}" placeholder="Día 10">
                                     <label for="dia10" class="form-label">Día 10</label>
                                  </div> 
                                  <div class="form-floating mb-2">
                                     <input type="text" class="form-control" name="dia11" value="{{ $producto->itinerarios->dia11 }}" placeholder="Día 11">
                                     <label for="dia11" class="form-label">Día 11</label>
                                  </div> 
                                  <div class="form-floating mb-2">
                                     <input type="text" class="form-control" name="dia12" value="{{ $producto->itinerarios->dia12 }}" placeholder="Día 12">
                                     <label for="dia12" class="form-label">Día 12</label>
                                  </div> 
                                  <div class="form-floating mb-2">
                                     <input type="text" class="form-control" name="dia13" value="{{ $producto->itinerarios->dia13 }}" placeholder="Día 13">
                                     <label for="dia13" class="form-label">Día 13</label>
                                  </div> 
                                  <div class="form-floating mb-2">
                                     <input type="text" class="form-control" name="dia14" value="{{ $producto->itinerarios->dia14 }}" placeholder="Día 14">
                                     <label for="dia14" class="form-label">Día 14</label>
                                  </div> 
                                  <div class="form-floating mb-2">
                                     <input type="text" class="form-control" name="dia15" value="{{ $producto->itinerarios->dia15 }}" placeholder="Día 15">
                                     <label for="dia15" class="form-label">Día 15</label>
                                  </div>                             
                               </div>
                          </div>  
                        </div>  
                        @else 
                        <div class="form-group">
                           <p class="mas my-2">
                             <a class="btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                             <i class="fa-solid fa-circle-plus"><span>Itinerarios x dia</span></i>
                             </a>                      
                           </p>
                           <div class="collapse mb-3 edit" id="collapseExample">                      
                               <div class="card card-body collapse-form">
                                  <div class="form-floating mb-2">
                                     <input type="text" class="form-control" name="dia1" value="" placeholder="Día 1">
                                     <label for="dia1" class="form-label">Día 1</label>
                                  </div>                                     
                                  <div class="form-floating mb-2">
                                     <input type="text" class="form-control" name="dia2" value="" placeholder="Día 2">
                                     <label for="dia2" class="form-label">Día 2</label>
                                  </div> 
                                  <div class="form-floating mb-2">
                                     <input type="text" class="form-control" name="dia3" value="" placeholder="Día 3">
                                     <label for="dia3" class="form-label">Día 3</label>
                                  </div> 
                                  <div class="form-floating mb-2">
                                     <input type="text" class="form-control" name="dia4" value="" placeholder="Día 4">
                                     <label for="dia4" class="form-label">Día 4</label>
                                  </div> 
                                  <div class="form-floating mb-2">
                                     <input type="text" class="form-control" name="dia5" value="" placeholder="Día 5">
                                     <label for="dia5" class="form-label">Día 5</label>
                                  </div> 
                                  <div class="form-floating mb-2">
                                     <input type="text" class="form-control" name="dia6" value="" placeholder="Día 6">
                                     <label for="dia6" class="form-label">Día 6</label>
                                  </div> 
                                  <div class="form-floating mb-2">
                                     <input type="text" class="form-control" name="dia7" value="" placeholder="Día 7">
                                     <label for="dia7" class="form-label">Día 7</label>
                                  </div> 
                                  <div class="form-floating mb-2">
                                     <input type="text" class="form-control" name="dia8" value="" placeholder="Día 8">
                                     <label for="dia8" class="form-label">Día 8</label>
                                  </div> 
                                  <div class="form-floating mb-2">
                                     <input type="text" class="form-control" name="dia9" value="" placeholder="Día 9">
                                     <label for="dia9" class="form-label">Día 9</label>
                                  </div> 
                                  <div class="form-floating mb-2">
                                     <input type="text" class="form-control" name="dia10" value="" placeholder="Día 10">
                                     <label for="dia10" class="form-label">Día 10</label>
                                  </div> 
                                  <div class="form-floating mb-2">
                                     <input type="text" class="form-control" name="dia11" value="" placeholder="Día 11">
                                     <label for="dia11" class="form-label">Día 11</label>
                                  </div> 
                                  <div class="form-floating mb-2">
                                     <input type="text" class="form-control" name="dia12" value="" placeholder="Día 12">
                                     <label for="dia12" class="form-label">Día 12</label>
                                  </div> 
                                  <div class="form-floating mb-2">
                                     <input type="text" class="form-control" name="dia13" value="" placeholder="Día 13">
                                     <label for="dia13" class="form-label">Día 13</label>
                                  </div> 
                                  <div class="form-floating mb-2">
                                     <input type="text" class="form-control" name="dia14" value="" placeholder="Día 14">
                                     <label for="dia14" class="form-label">Día 14</label>
                                  </div> 
                                  <div class="form-floating mb-2">
                                     <input type="text" class="form-control" name="dia15" value="" placeholder="Día 15">
                                     <label for="dia15" class="form-label">Día 15</label>
                                  </div>                             
                               </div>
                          </div>  
                        </div>  
                            @endif                                       
                        <div class="mt-2">
                           <button type="submit" class="btn btn-primary">
                               Guardar
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