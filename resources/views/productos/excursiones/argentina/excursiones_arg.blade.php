@extends('layouts.app-master')

@if (Auth::check() && Auth::user()->id_rango === 1)
@section('content')
     <div class="container w-50 form-edit">
        <div class="row">            
           <div class="col conten-login">   
              <p>ALTA EXCURSIONES ARGENTINA</p> 
              @if ($errors->has('codigo'))
              <div class="alert alert-danger my-3">
                {{ $errors->first('codigo') }}
              </div>
              @endif 
                <form class="form-horizontal" method="POST" action="{{ route('excursiones_arg.create') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}  
                        <div class="form-group">
                            <label for="excursion" class="col-md-4 control-label">Nombre Excursion</label>
                            <div class="">
                                <input type="text" class="form-control" name="excursion" value="{{ old('excursion') }}" required>
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="detalle" class="col-md-4 control-label">Detalle Excursion</label>
                            <div class="">
                                <input type="text" class="form-control" name="detalle" value="{{ old('detalle') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="imagenes" class="col-md-4 control-label">Imagenes Banner (Hasta 5)</label>
                            <div class="">
                                <input type="file" class="form-control" name="imagenes[]" accept="image/*" value="{{ old('imagenes') }}" multiple> 
                            </div>
                        </div>   
                        <div class="form-group">
                            <label for="imagen" class="col-md-4 control-label">Imagen de Promoción (1)</label>
                            <div class="">
                                <input type="file" class="form-control" name="imagen" value="{{ old('imagen') }}" required>
                            </div>
                        </div>   
                        <div class="form-group">
                            <label for="precio" class="col-md-4 control-label">Precio Costo</label>
                            <div class="">
                                <input type="number" class="form-control" name="precio" value="{{ old('precio') }}" step="0.01" required>
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
                            <label for="video" class="col-md-4 control-label">URL Video</label>
                            <div class="">
                                <input type="text" class="form-control" name="video" value="{{ old('video') }}">
                            </div>
                        </div>            
                         <div class="form-group">
                            <label for="duracion" class="col-md-4 control-label">Duración de la excursión</label>
                            <div class="">
                                <select name="duracion" class="form-select" aria-label="Default select example">  
                                    <option value="1/2 Día" @if(old('duracion') == '1/2 Día') selected @endif>1/2 Día</option>
                                    <option value="1 Día" @if(old('duracion') == '1 Día') selected @endif>1 Día</option>
                                    <option value="2 Días" @if(old('duracion') == '2 Días') selected @endif>2 Días</option>
                                    <option value="3 Días" @if(old('duracion') == '3 Días') selected @endif>3 Días</option>
                                    <option value="Mas de 3 Días" @if(old('duracion') == 'Mas de 3 Díass') selected @endif>Mas de 3 Días</option>
                                </select>  
                            </div>
                        </div>    
                        <div class="form-group">
                            <label for="provincias" class="col-md-4 control-label">Provincia Destino</label>
                            <div class="">                            
                                <select name="provincias" class="form-select">                                    
                                    @foreach ($provincias as $provincia)
                                        <option value="{{ $provincia->id }}" {{ (old('pais_destino') == $provincia->id) ? 'selected' : '' }}>
                                            {{ $provincia->nombre }}
                                        </option>
                                    @endforeach
                                </select>                           
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