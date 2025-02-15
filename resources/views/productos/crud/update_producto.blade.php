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
              <p>NO EDITA LA TOTALIDAD DE LOS ITEMS PRODUCTO</p>  
                <form class="form-horizontal" method="POST" action="{{ route('producto.updateProcess', ['id' => $producto->id]) }}" enctype="multipart/form-data">                      
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="titulo" class="col-md-4 control-label">Titulo Producto</label>
                            <div class="">
                                <input type="text" class="form-control" name="titulo" value="{{ $producto->titulo }}">
                            </div>
                        </div>
                         <div class="form-row d-flex">
                           <div class="form-group col-md-6 pe-1">
                               <label for="proveedor" class="col-form-label">Proveedor</label>
                               <select name="proveedor" class="form-select" aria-label="Default select example">  
                                     @foreach ($proveedores as $proveedor)
                                        <option value="{{ $proveedor->empresa }}" {{ $producto->proveedor == $proveedor->empresa ? 'selected' : '' }}>
                                            {{ $proveedor->empresa }}
                                        </option>
                                    @endforeach
                                </select>   
                           </div>
                           <div class="form-group col-md-6 ps-1">
                               <label for="fecha_salida" class="col-form-label">Fecha de Viaje</label>
                               <input type="date" name="fecha_salida" class="form-control" value="{{ $producto->fecha_salida }}" required>
                           </div>
                        </div> 
                         <div class="form-group">
                            <label for="id_hotel" class="col-md-4 control-label">Hotel</label>
                            <div class="">
                               <select name="id_hotel" class="form-select">
                                 @foreach ($hoteles as $hotel)
                                        <option value="{{ $hotel->id }}" {{ $producto->id_hotel == $hotel->id ? 'selected' : ''}}>
                                        {{ $hotel->nombre }}
                                      </option>                                      
                                    @endforeach     
                                </select>
                            </div>
                        </div>   
                        <div class="form-group">
                            <label for="id_destino" class="col-md-4 control-label">Destino</label>
                            <div class="">                            
                                <select name="id_destino" class="form-select">                                    
                                    @foreach ($destinos as $destino)
                                        <option value="{{ $destino->id }}" {{ $producto->id_destino == $destino->id ? 'selected' : ''}}>
                                            {{ $destino->ciudad_destino }}
                                        </option>
                                    @endforeach
                                </select>                           
                            </div>
                        </div>    
                         <div class="form-group">
                            <label for="id_pais" class="col-md-4 control-label">País Destino</label>
                            <div class="">                            
                                <select name="id_pais" class="form-select">                                    
                                    @foreach ($paises as $pais)
                                        <option value="{{ $pais->id }}" {{ $producto->id_pais == $pais->id ? 'selected' : '' }}>
                                            {{ $pais->nombre_img }}
                                        </option>
                                    @endforeach
                                </select>                           
                            </div>
                        </div>  
                        <div class="form-group pe-1">
                          <label for="id_aerolinea" class="col-form-label">Aerolínea</label>
                          <select name="id_aerolinea" class="form-select" required>
                             <option value="">Seleccione una aerolínea</option>
                             @foreach ($aerolineas as $aerolinea)
                                 <option value="{{ $aerolinea->id }}" {{ $producto->id_aerolinea == $aerolinea->id ? 'selected' : '' }}>
                                     {{ $aerolinea->compania }} Fecha: {{ $aerolinea->fecha_inicio }}
                                 </option>
                             @endforeach
                           </select>
                        </div>
                        <div class="form-group">
                            <label for="estadia" class="col-md-4 control-label">Estadía Principal</label>
                            <div class="">
                                <input type="number" class="form-control" name="estadia" value="{{ $producto->estadia }}">
                            </div>
                        </div>   
                        <div class="form-group">
                            <label for="habitacion" class="col-md-4 control-label">Tipo de Habitación</label>
                            <div class="">
                                <select name="habitacion" class="form-select" aria-label="Default select example">  
                                   <option value="{{ $producto->habitacion }}" @if(old('habitacion') == 'Base Doble') selected @endif>{{ $producto->habitacion }}</option>
                                    <option value="Base Simple" @if(old('habitacion') == 'Base Simple') selected @endif>Base Simple</option>
                                    <option value="Base Triple" @if(old('habitacion') == 'Base Triple') selected @endif>Base Triple</option>
                                    <option value="Base Cuadruple" @if(old('habitacion') == 'Base Cuadruple') selected @endif>Base Cuadruple</option>
                                    <option value="Family Plan" @if(old('habitacion') == 'Family Plan') selected @endif>Family Plan</option>
                                    <option value="Base Doble" @if(old('habitacion') == 'Base Doble') selected @endif>Base Doble</option>
                                </select>                                 
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="precio_total" class="col-md-4 control-label">Precio Total</label>
                            <div class="">
                                <input type="number" class="form-control" name="precio_total" value="{{ $producto->precio_total }}" step="0.01">
                            </div>
                        </div>                        
                        <div class="form-group">
                            <label for="moneda" class="col-md-4 control-label">Tipo de Moneda</label>
                            <div class="">
                                <select name="moneda" class="form-select" aria-label="Default select example">  
                                    <option value="{{ $producto->moneda }}" @if(old('moneda') == 'USD') selected @endif>{{ $producto->moneda }}</option>
                                    <option value="EUR" @if(old('moneda') == 'EUR') selected @endif>EUR</option>
                                    <option value="$" @if(old('moneda') == '$') selected @endif>$</option>  
                                    <option value="USD" @if(old('moneda') == 'USD') selected @endif>USD</option>                                  
                                </select>                                 
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="origen_salida" class="col-md-4 control-label">Origen Salida</label>
                            <div class="">
                                <select name="origen_salida" class="form-select" aria-label="Default select example">  
                                    <option value="{{ $producto->origen_salida }}" @if(old('origen_salida') == '{{ $producto->origen_salida }}') selected @endif>{{ $producto->origen_salida }}</option>
                                    <option value="Rosario" @if(old('origen_salida') == 'Rosario') selected @endif>Rosario</option>
                                    <option value="Córdoba" @if(old('origen_salida') == 'Córdoba') selected @endif>Córdoba</option>
                                    <option value="Ezeiza" @if(old('origen_salida') == 'Ezeiza') selected @endif>Ezeiza</option>
                                </select>  
                            </div>
                        </div>    
                        <div class="form-group">
                            <label for="tipo_producto" class="col-md-4 control-label">Tipo Producto</label>
                            <div class="">
                                <select name="tipo_producto" class="form-select" aria-label="Default select example">  
                                    <option value="{{ $producto->tipo_producto }}" @if(old('tipo_producto') == 'Paquete Turístico') selected @endif>{{ $producto->tipo_producto }}</option>
                                    <option value="Salida Grupal" @if(old('tipo_producto') == 'Salida Grupal') selected @endif>Salida Grupal</option>
                                    <option value="Grupal con Guía Hispanohablante" @if(old('tipo_producto') == 'Grupal con Guía Hispanohablante') selected @endif>Grupal con Guía Hispanohablante</option>
                                    <option value="Family Plan" @if(old('tipo_producto') == 'Family Plan') selected @endif>Family Plan</option>
                                    <option value="Exclusivo Comunidad" @if(old('tipo_producto') == 'Exclusivo Comunidad') selected @endif>Exclusivo Comunidad</option>
                                    <option value="Paquete Turístico" @if(old('tipo_producto') == 'Paquete Turístico') selected @endif>Paquete Turístico</option>
                                </select>                                 
                            </div>
                        </div>                        
                        <div class="form-group">
                            <label for="imagen" class="col-md-4 control-label">Imagen del Producto</label>
                            <div class="">
                                <input id="imagen" type="file" class="form-control" name="imagen">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="detalles" class="col-md-4 control-label">Detalles</label>
                            <div class="">
                                <input type="text" class="form-control" name="detalles" value="{{ $producto->detalles }}">
                            </div>
                        </div>  
                        <div class="form-group">
                            <label for="comidas" class="col-md-4 control-label">Comidas</label>
                              <div class="">
                                  <select name="comidas" class="form-select" aria-label="Default select example"> 
                                  <option value="{{ $producto->comidas }}" @if(old('comidas') == 'All Inclusive') selected @endif>{{ $producto->comidas }}</option>
                                    <option value="All Inclusive" @if(old('comidas') == 'All Inclusive') selected @endif>All Inclusive</option>
                                    <option value="Desayuno" @if(old('comidas') == 'Desayuno') @endif>Desayuno</option>
                                    <option value="Media Pensión" @if(old('comidas') == 'Media Pensión') @endif>Media Pensión</option>
                                    <option value="Otros" @if(old('comidas') == 'Otros') @endif>Otros</option>
                                  </select>  
                              </div>
                        </div>                           
                          <div class="form-group">
                           <p class="mas my-2">
                             <a class="btn-primary" data-bs-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample">
                             <i class="fa-solid fa-circle-plus"><span>( No editar ) - Servicios incluidos</span></i>
                             </a>                      
                           </p>
                           <div class="collapse mb-3 edit" id="collapseExample1">                      
                               <div class="card card-body collapse-form">
                                  <div class="form-group">
                                   <label for="transporte_int" class="col-md-4 control-label">Transporte Internacional</label>
                                      <div class="">
                                          <select name="transporte_int" class="form-select" aria-label="Default select example"> 
                                            <option value="{{ $producto->codigo }}" @if(old('transporte_int') == 'Aéreo Directo') selected @endif>{{ $producto->codigo }}</option>
                                            <option value="Aéreos con escala" @if(old('transporte_int') == 'Aéreos con escala') @endif>Aéreos con escala</option>
                                            <option value="Micro" @if(old('transporte_int') == 'Micro') @endif>Micro</option>
                                            <option value="Otro" @if(old('transporte_int') == 'Otro') @endif>Otro</option>
                                             <option value="Sin Traslados" @if(old('transporte_int') == 'Sin Traslados') @endif>Sin Traslados</option>
                                             <option value="Aéreo Directo" @if(old('transporte_int') == 'Aéreo Directo') selected @endif>Aéreo Directo</option>
                                        </select>  
                                      </div>
                                  </div> 
                                  <div class="form-group">
                                   <label for="traslados_orig" class="col-md-4 control-label">Traslados en Origen</label>
                                      <div class="">
                                          <select name="traslados_orig" class="form-select" aria-label="Default select example">  
                                            <option value="{{ $producto->codigo }}" @if(old('traslados_orig') == 'Sin Traslados') selected @endif>{{ $producto->codigo }}</option>
                                            <option value="Micro - Vans" @if(old('traslados_orig') == 'Micro - Vans') @endif>Micro - Vans</option>
                                            <option value="Aéreos" @if(old('traslados_orig') == 'Aéreos') @endif>Aéreos</option>
                                            <option value="Otro" @if(old('traslados_orig') == 'Otro') @endif>Otro</option>  
                                            <option value="Sin Traslados" @if(old('traslados_orig') == 'Sin Traslados') selected @endif>Sin Traslados</option>                                          
                                          </select>  
                                      </div>
                                  </div>   
                                  <div class="form-group">
                                   <label for="traslados_dest" class="col-md-4 control-label">Traslados en Destino</label>
                                      <div class="">
                                          <select name="traslados_dest" class="form-select" aria-label="Default select example"> 
                                            <option value="Micro - Vans" @if(old('traslados_dest') == 'Micro - Vans') selected @endif>Micro - Vans</option>
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
                                            <option value="Departamento" @if(old('estadía') == 'Departamento') selected @endif>Departamento</option>
                                            <option value="Otro" @if(old('estadía') == 'Otro') selected @endif>Otro</option>
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
                               </div>
                          </div>  
                        </div>  
                        <div class="form-group">
                           <p class="mas my-2">
                             <a class="btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                             <i class="fa-solid fa-circle-plus"><span>( No editar ) - Itinerarios / Excursiones</span></i>
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
                            <label for="ubicacion" class="col-md-4 control-label">Destino General</label>
                            <div class="">
                                <select name="ubicacion" class="form-select" aria-label="Default select example">   
                                    <option value="{{ $producto->destino_gral }}" @if(old('destinoGral') == 'Mundo') selected @endif>{{ $producto->destino_gral }}</option>
                                    <option value="Tur-Arg" @if(old('ubicacion') == 'Tur-Arg') @endif>Tur-Arg</option>
                                    <option value="Brasil" @if(old('ubicacion') == 'Brasil') @endif>Brasil</option>
                                    <option value="Caribe" @if(old('ubicacion') == 'Caribe') @endif>Caribe</option>
                                    <option value="Europa" @if(old('ubicacion') == 'Europa') @endif>Europa</option>                                    
                                    <option value="Mundo" @if(old('ubicacion') == 'Mundo') @endif>Mundo</option>
                                </select>                                 
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