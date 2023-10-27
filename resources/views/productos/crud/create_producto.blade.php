@extends('layouts.app-master')

@if (Auth::check() && Auth::user()->id_rango === 1)
@section('content')
     <div class="container w-50 form-edit">
        <div class="row">
           <div class="col conten-login">   
              <p>ALTA DE PRODUCTOS</p>  
                <form class="form-horizontal" method="POST" action="{{ route('producto.create') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="nombre" class="col-md-4 control-label">Titulo Producto</label>
                            <div class="">
                                <input id="nombre" type="text" class="form-control" name="nombre" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="codigo" class="col-md-4 control-label">Código Producto</label>
                            <div class="">
                                <input id="codigo" type="text" class="form-control" name="codigo" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="imagen" class="col-md-4 control-label">Imagen del Producto</label>
                            <div class="">
                                <input id="imagen" type="file" class="form-control" name="imagen" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tipo_producto" class="col-md-4 control-label">Tipo Producto</label>
                            <div class="">
                                <select name="tipo_producto" class="form-select" aria-label="Default select example">  
                                   <option value="paquete">Paquete Turístico</option>
                                   <option value="aereo">Aéreo </option>
                                   <option value="hotel">Hotel</option>
                                </select>                                 
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pais_destino" class="col-md-4 control-label">País Destino</label>
                            <div class="">
                                <select name="pais_destino" class="form-select">
                                   @foreach ($paises as $pais)
                                     <option value="{{ $pais->nombre_img }}">
                                        {{ $pais->nombre_img }}
                                     </option>
                                   @endforeach
                                </select>                             
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ciudad_destino" class="col-md-4 control-label">Ciudad Destino</label>
                            <div class="">
                                <input id="ciudad_destino" type="text" class="form-control" name="ciudad_destino" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="origen_salida" class="col-md-4 control-label">Origen Salida</label>
                            <div class="">
                                <input id="origen_salida" type="text" class="form-control" name="origen_salida" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="transporte" class="col-md-4 control-label">Transporte</label>
                            <div class="">
                                <select name="transporte" class="form-select" aria-label="Default select example">  
                                   <option value="Aéreo">Aéreo</option>
                                   <option value="Micro">Micro </option>
                                </select>  
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="precio_total" class="col-md-4 control-label">Precio Total</label>
                            <div class="">
                                <input id="precio_total" type="number" class="form-control" name="precio_total" step="0.01" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="precio_comisionable" class="col-md-4 control-label">Precio Comisionable</label>
                            <div class="">
                                <input id="precio_comisionable" type="number" class="form-control" name="precio_comisionable" step="0.01" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="hotel" class="col-md-4 control-label">Hoteles</label>
                            <div class="">
                                <select name="hotel" class="form-select">
                                   @foreach ($hoteles as $hotel)
                                     <option value="{{ $hotel->nombre }}">
                                        {{ $hotel->nombre }}
                                     </option>
                                   @endforeach
                                </select>   
                            </div>
                        </div>  
                        <div class="form-group">
                            <label for="categoria_hotel" class="col-md-4 control-label">Categoría Hotel</label>
                            <div class="">
                                <input id="categoria_hotel" type="number" class="form-control" name="categoria_hotel" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="duracion" class="col-md-4 control-label">Estadía Noches</label>
                            <div class="">
                                <input id="duracion" type="number" class="form-control" name="duracion" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="solo_adultos" class="col-md-4 control-label">¿Solo Para Adultos?</label>
                            <div class="">
                                <input id="solo_adultos" type="checkbox" name="solo_adultos" value="1">
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