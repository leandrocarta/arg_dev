@extends('layouts.app-master')

@if (Auth::check() && Auth::user()->id_rango === 1)
@section('content')
     <div class="container w-50 form-edit">
        <div class="row">            
           <div class="col conten-login">   
              <p>ALTA DE PRODUCTOS</p> 
              @if ($errors->has('codigo'))
              <div class="alert alert-danger my-3">
                {{ $errors->first('codigo') }}
              </div>
              @endif 
                <form class="form-horizontal" method="POST" action="{{ route('producto.create') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="nombre" class="col-md-4 control-label">Titulo Producto</label>
                            <div class="">
                                <input id="nombre" type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" required>
                            </div>
                        </div>
                        <div class="form-row d-flex">
                           <div class="form-group col-md-6 pe-1">
                               <label for="codigo" class="col-form-label">Código Producto</label>
                               <input type="text" class="form-control" name="codigo" required>
                           </div>
                           <div class="form-group col-md-6 ps-1">
                               <label for="fecha_vencimiento" class="col-form-label">Fecha de Vencimiento</label>
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
                            <label for="habitacion" class="col-md-4 control-label">Tipo de Habitación</label>
                            <div class="">
                                <select name="habitacion" class="form-select" aria-label="Default select example">  
                                    <option value="Base Doble" @if(old('habitacion') == 'Base Doble') selected @endif>Base Doble</option>
                                    <option value="Base Simple" @if(old('habitacion') == 'Base Simple') selected @endif>Base Simple</option>
                                    <option value="Base Triple" @if(old('habitacion') == 'Base Triple') selected @endif>Base Triple</option>
                                    <option value="Base Cuadruple" @if(old('habitacion') == 'Base Cuadruple') selected @endif>Base Cuadruple</option>
                                    <option value="Family Plan" @if(old('habitacion') == 'Family Plan') selected @endif>Family Plan</option>
                                </select>                                 
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tipo_producto" class="col-md-4 control-label">Tipo Producto</label>
                            <div class="">
                                <select name="tipo_producto" class="form-select" aria-label="Default select example">  
                                    <option value="Paquete Turístico" @if(old('tipo_producto') == 'Paquete Turístico') selected @endif>Paquete Turístico</option>
                                    <option value="Salida Grupal" @if(old('tipo_producto') == 'Salida Grupal') selected @endif>Salida Grupal</option>
                                    <option value="Grupal con Guía Hispanohablante" @if(old('tipo_producto') == 'Grupal con Guía Hispanohablante') selected @endif>Grupal con Guía Hispanohablante</option>
                                    <option value="Family Plan" @if(old('tipo_producto') == 'Family Plan') selected @endif>Family Plan</option>
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
                                   <label for="transporte_int" class="col-md-4 control-label">Transporte Internacional</label>
                                      <div class="">
                                          <select name="transporte_int" class="form-select" aria-label="Default select example"> 
                                            <option value="Aéreos" @if(old('transporte_int') == 'Aéreos') selected @endif>Aéreos</option>
                                            <option value="Aéreos con escala" @if(old('transporte_int') == 'Aéreos con escala') selected @endif>Aéreos con escala</option>
                                            <option value="Micro" @if(old('transporte_int') == 'Micro') selected @endif>Micro</option>
                                            <option value="Otro" @if(old('transporte_int') == 'Otro') selected @endif>Otro</option>
                                             <option value="Sin Traslados" @if(old('transporte_int') == 'Sin Traslados') selected @endif>Sin Traslados</option>
                                        </select>  
                                      </div>
                                  </div> 
                                  <div class="form-group">
                                   <label for="traslados_orig" class="col-md-4 control-label">Traslados en Origen</label>
                                      <div class="">
                                          <select name="traslados_orig" class="form-select" aria-label="Default select example"> 
                                            <option value="Sin Traslados" @if(old('traslados_orig') == 'Sin Traslados') selected @endif>Sin Traslados</option>
                                            <option value="Micro" @if(old('traslados_orig') == 'Micro') selected @endif>Micro</option>
                                            <option value="Aéreos" @if(old('traslados_orig') == 'Aéreos') selected @endif>Aéreos</option>
                                            <option value="Otro" @if(old('traslados_orig') == 'Otro') selected @endif>Otro</option>                                            
                                          </select>  
                                      </div>
                                  </div>   
                                  <div class="form-group">
                                   <label for="traslados_dest" class="col-md-4 control-label">Traslados en Destino</label>
                                      <div class="">
                                          <select name="traslados_dest" class="form-select" aria-label="Default select example"> 
                                            <option value="Micro" @if(old('traslados_dest') == 'Micro') selected @endif>Micro</option>
                                            <option value="Sin Traslados" @if(old('traslados_dest') == 'Sin Traslados') selected @endif>Sin Traslados</option>
                                          </select>  
                                      </div>
                                  </div>
                                  <div class="form-group">
                                   <label for="estadía" class="col-md-4 control-label">Estadía</label>
                                      <div class="">
                                          <select name="estadía" class="form-select" aria-label="Default select example"> 
                                            <option value="Hotel" @if(old('estadía') == 'Hotel') selected @endif>Hotel</option>
                                            <option value="Apart" @if(old('estadía') == 'Apart') selected @endif>Apart</option>
                                            <option value="Otro" @if(old('estadía') == 'Otro') selected @endif>Otro</option>
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
                                            <option value="Asistencia al viajero" @if(old('seguro') == 'Asistencia al viajero') selected @endif>SIN Asistencia al viajero</option>
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
                            <label for="pais_destino" class="col-md-4 control-label">País Destino</label>
                            <div class="">                            
                                <select name="pais_destino" class="form-select">                                    
                                    @foreach ($paises as $pais)
                                        <option value="{{ $pais->nombre_img }}" {{ (old('pais_destino') == $pais->nombre_img) ? 'selected' : '' }}>
                                            {{ $pais->nombre_img }}
                                        </option>
                                    @endforeach
                                </select>                           
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ciudad_destino" class="col-md-4 control-label">Ciudad Destino</label>
                            <div class="">
                                <input type="text" class="form-control" name="ciudad_destino" value="{{ old('ciudad_destino') }}" required>
                            </div>
                        </div>                        
                        <div class="form-group">
                            <label for="origen_salida" class="col-md-4 control-label">Origen Salida</label>
                            <div class="">
                                <select name="origen_salida" class="form-select" aria-label="Default select example">  
                                    <option value="Rosario" @if(old('origen_salida') == 'Rosario') selected @endif>Rosario</option>
                                    <option value="Córdoba" @if(old('origen_salida') == 'Córdoba') selected @endif>Córdoba</option>
                                    <option value="Ezeiza" @if(old('origen_salida') == 'Ezeiza') selected @endif>Ezeiza</option>
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
                            <label for="precio_comisionable" class="col-md-4 control-label">Precio Comisionable</label>
                            <div class="">
                                <input type="number" class="form-control" name="precio_comisionable" value="{{ old('precio_comisionable') }}" step="0.01" required>
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
                            <label for="hotel_principal" class="col-md-4 control-label">Hotel Principal</label>
                            <div class="">
                               <select name="hotel_principal" class="form-select">
                                    @foreach ($hoteles as $hotel)
                                        <option value="{{ $hotel->id }}" {{ (old('hotel_principal') == $hotel->id) ? 'selected' : '' }}>
                                            {{ $hotel->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>  
                        <div class="form-group">
                            <label for="estadia_principal" class="col-md-4 control-label">Estadía Principal</label>
                            <div class="">
                                <input type="number" class="form-control" name="estadia_principal" value="{{ old('estadia_principal') }}" required>
                            </div>
                        </div>    
                        <div class="form-group">
                            <label for="hotel_dos" class="col-md-4 control-label">Hotel 2</label>
                            <div class="">
                               <select name="hotel_dos" class="form-select">
                                    @foreach ($hoteles as $hotel)
                                        <option value="{{ $hotel->id }}" {{ (old('hotel_dos') == $hotel->id) ? 'selected' : '' }}>
                                            {{ $hotel->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>  
                        <div class="form-group">
                            <label for="estadia_dos" class="col-md-4 control-label">Estadía Hotel 2</label>
                            <div class="">
                                <input value="0" type="number" class="form-control" name="estadia_dos" value="{{ old('estadia_dos') }}">
                            </div>
                        </div>                        
                        <div class="form-group">
                            <label for="hotel_tres" class="col-md-4 control-label">Hotel 3</label>
                            <div class="">
                               <select name="hotel_tres" class="form-select">
                                    @foreach ($hoteles as $hotel)
                                        <option value="{{ $hotel->id }}" {{ (old('hotel_tres') == $hotel->id) ? 'selected' : '' }}>
                                            {{ $hotel->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>  
                        <div class="form-group">
                            <label for="estadia_tres" class="col-md-4 control-label">Estadía Hotel 3</label>
                            <div class="">
                                <input value="0" type="number" class="form-control" name="estadia_tres" value="{{ old('estadia_tres') }}">
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