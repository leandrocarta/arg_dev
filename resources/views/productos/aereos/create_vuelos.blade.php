@extends('layouts.app-master')

@if (Auth::check() && Auth::user()->id_rango === 1)
@section('content')
     <div class="container w-50 form-edit">
        <div class="row">            
           <div class="col conten-login">   
              <p>NUEVO VUELO</p> 
              @if ($errors->has('codigo'))
              <div class="alert alert-danger my-3">
                {{ $errors->first('codigo') }}
              </div>
              @endif 
                <form class="form-horizontal" method="POST" action="{{ route('vuelos.create') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="nombre" class="col-md-4 control-label">Titulo</label>
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
                            <label for="tipo_producto" class="col-md-4 control-label">Tipo Producto</label>
                            <div class="">
                                <select name="tipo_producto" class="form-select" aria-label="Default select example">  
                                    <option value="Aéreo" @if(old('tipo_producto') == 'Aéreo') selected @endif>Aéreo</option>                                    
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