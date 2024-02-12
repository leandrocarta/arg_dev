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
                            <label for="id_naviera" class="col-md-4 control-label">NAVIERA</label>
                            <div class="">                            
                                <select name="id_naviera" class="form-select">                                    
                                    @foreach ($navieras as $naviera)
                                        <option value="{{ $naviera->id }}" {{ (old('id_naviera') == $naviera->id) ? 'selected' : '' }}>
                                            {{ $naviera->nombre }}
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
                                        <option value="{{ $barco->id }}" {{ (old('id_barco') == $barco->id) ? 'selected' : '' }}>
                                            {{ $barco->nombre }}
                                        </option>
                                    @endforeach
                                </select>                           
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="destino" class="col-md-4 control-label">Destino</label>
                            <div class="">
                                <input type="text" class="form-control" name="destino" value="{{ old('destino') }}" required>
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="entre_fechas" class="col-md-4 control-label">Meses de Navegación</label>
                            <div class="">
                                <input type="text" class="form-control" name="entre_fechas" value="{{ old('entre_fechas') }}">
                            </div>
                        </div>
                        <div class="form-row">                           
                           <div class="form-group ps-1">
                               <label for="fecha_partida" class="col-form-label">Fecha Viaje</label>
                               <input type="date" name="fecha_partida" class="form-control">
                           </div>
                        </div>  
                        <div class="form-group">
                            <label for="img_banner" class="col-md-4 control-label">Imagen Banner</label>
                            <div class="">
                                <input type="file" class="form-control" name="img_banner" value="{{ old('img_banner') }}" required>
                            </div>
                        </div>       
                        <div class="form-group">
                            <label for="imagen" class="col-md-4 control-label">Imagen del Producto</label>
                            <div class="">
                                <input type="file" class="form-control" name="imagen" value="{{ old('imagen') }}" required>
                            </div>
                        </div>    
                        <div class="form-group">
                            <label for="estadia" class="col-md-4 control-label">Estadía</label>
                            <div class="">
                                <input type="number" class="form-control" name="estadia" value="{{ old('estadia') }}" required>
                            </div>
                        </div>                      
                         <div class="form-group">
                            <label for="puerto_salida" class="col-md-4 control-label">Puerto de Salida</label>
                            <div class="">
                                <select name="puerto_salida" class="form-select" aria-label="Default select example">  
                                    <option value="BS.AS." @if(old('puerto_salida') == 'BS.AS.') selected @endif>BS.AS.</option>
                                    <option value="BRASIL" @if(old('puerto_salida') == 'BRASIL') selected @endif>BRASIL</option>
                                    <option value="MIAMI" @if(old('puerto_salida') == 'MIAMI') selected @endif>MIAMI</option>
                                    <option value="OTRO" @if(old('puerto_salida') == 'OTRO') selected @endif>OTRO</option>
                                </select>  
                            </div>
                        </div>    
                        <div class="form-group">
                            <label for="tipo_cabina" class="col-md-4 control-label">Tipo de Cabina</label>
                            <div class="">
                                <select name="tipo_cabina" class="form-select" aria-label="Default select example">  
                                    <option value="CABINA INTERIOR" @if(old('tipo_cabina') == 'CABINA INTERIOR') selected @endif>CABINA INTERIOR</option>
                                    <option value="CABINA EXTERIOR" @if(old('tipo_cabina') == 'CABINA EXTERIOR') selected @endif>CABINA EXTERIOR</option>
                                    <option value="CABINA BALCÓN" @if(old('tipo_cabina') == 'CABINA BALCÓN') selected @endif>CABINA BALCÓN</option>
                                    <option value="CABINA SUITE" @if(old('tipo_cabina') == 'CABINA SUITE') selected @endif>CABINA SUITE</option>
                                </select>                                 
                            </div>
                        </div>   
                        <div class="form-group">
                            <label for="detalle" class="col-md-4 control-label">Detalle</label>
                            <input type="text" class="form-control" name="detalle" value="{{ old('detalle') }}">                            
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
                            <label for="precio" class="col-md-4 control-label">Precio Total</label>
                            <div class="">
                                <input type="number" class="form-control" name="precio" value="{{ old('precio') }}" step="0.01" required>
                            </div>
                        </div>   
                        <div class="form-group">
                           <p class="mas my-2">
                             <a class="btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                             <i class="fa-solid fa-circle-plus"><span>Itinerarios x dia</span></i>
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
