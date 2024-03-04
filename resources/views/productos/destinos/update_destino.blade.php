@extends('layouts.app-master')

@if (Auth::check() && Auth::user()->id_rango === 1)
@section('content')
     <div class="container w-50 form-edit">
        <div class="row">            
           <div class="col conten-login">   
              <p>EDITAR DESTINO</p> 
              @if ($errors->has('codigo'))
              <div class="alert alert-danger my-3">
                {{ $errors->first('codigo') }}
              </div>
              @endif 
                <form class="form-horizontal" method="POST" action="{{ route('update.destino', ['id' => $destinos->id]) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="nombre_destino" class="col-md-4 control-label">Nombre Destino</label>
                            <div class="">
                                <input type="text" class="form-control" name="nombre_destino" value="{{ $destinos->nombre_destino }}" required>
                            </div>
                        </div>      
                        <div class="form-group">
                            <label for="id_pais" class="col-md-4 control-label">País Destino</label>
                            <div class="">                            
                                <select name="id_pais" class="form-select"> 
                                    @foreach ($paises as $pais)
                                        <option value="{{ $pais->id }}" {{ $destinos->id_pais == $pais->id ? 'selected' : '' }}>
                                            {{ $pais->nombre_img }}
                                        </option>
                                    @endforeach
                                </select>                           
                            </div>
                        </div>           
                        <div class="form-group">
                            <label for="detalle_gral" class="col-md-4 control-label">Detalle General</label>
                            <div class="">
                              <textarea class="form-control" name="detalle_gral" rows="5">{{ $destinos->detalle_gral }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ubicacion" class="col-md-4 control-label">Ubicación</label>
                            <div class="">
                              <textarea class="form-control" name="ubicacion" rows="5">{{ $destinos->ubicacion }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="playas" class="col-md-4 control-label">Playas</label>
                            <div class="">
                              <textarea class="form-control" name="playas" rows="5">{{ $destinos->playas }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="gastronomia" class="col-md-4 control-label">Gastronomía</label>
                            <div class="">
                              <textarea class="form-control" name="gastronomia" rows="5">{{ $destinos->gastronomia }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="atracciones" class="col-md-4 control-label">Atracciones</label>
                            <div class="">
                              <textarea class="form-control" name="atracciones" rows="5">{{ $destinos->atracciones }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="historia" class="col-md-4 control-label">Historia</label>
                            <div class="">
                              <textarea class="form-control" name="historia" rows="5">{{ $destinos->historia }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="resumen" class="col-md-4 control-label">Resumen</label>
                            <div class="">
                              <textarea class="form-control" name="resumen" rows="5">{{ $destinos->resumen }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="img_banner" class="col-md-4 control-label">Imagen Principal Banner (1350x500)</label>
                            <div class="">
                                <input type="file" class="form-control" name="img_banner">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="imagenes" class="col-md-4 control-label">Imagenes Secundarias</label>
                            <div class="">
                                <input type="file" class="form-control" name="imagenes[]" accept="image/*" multiple> 
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