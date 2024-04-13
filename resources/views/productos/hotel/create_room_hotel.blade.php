@extends('layouts.app-master')

@if (Auth::check() && Auth::user()->id_rango === 1)
@section('content')
     <div class="container w-50 form-edit">
        <div class="row">            
           <div class="col conten-login">   
              <p>ALTA DE HABITACIONES</p> 
              @if ($errors->has('codigo'))
              <div class="alert alert-danger my-3">
                {{ $errors->first('codigo') }}
              </div>
              @endif 
                <form class="form-horizontal" method="POST" action="{{ route('create_room_hotel') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}  
                        <div class="form-group form-floating">                                                                                   
                            <select name="hotel_id" class="form-select">                                    
                                   @foreach ($hoteles as $hotele)
                                    <option value="{{ $hotele->id }}" {{ (old('hotel_id') == $hotele->id) ? 'selected' : '' }}>
                                        {{ $hotele->nombre }}
                                    </option>
                                   @endforeach
                            </select>    
                            <label for="hotel" class="col-md-4 control-label">HOTEL</label>
                        </div>  
                        <div class="my-3 form-group form-floating">                            
                            <input type="text" placeholder="TIPO HABITACIÓN" class="form-control" name="tipo_habitacion" value="{{ old('tipo_habitacion') }}" required>                            
                            <label for="tipo_habitacion" class="col-md-4 control-label">TIPO HABITACIÓN</label>
                        </div>   
                        <div class="mb-3 form-group form-floating">                                                        
                           <select name="capacidad" class="form-select" aria-label="Default select example"> 
                               <option value="DOBLE" @if(old('capacidad') == 'DOBLE') selected @endif>HAB. DOBLE</option> 
                               <option value="SIMPLE" @if(old('capacidad') == 'SIMPLE') selected @endif>HAB. SIMPLE</option>                                    
                               <option value="TRIPLE" @if(old('capacidad') == 'TRIPLE') selected @endif>HAB. TRIPLE</option>       
                               <option value="CUADRUPLE" @if(old('capacidad') == 'CUADRUPLE') selected @endif>HAB. CUADRUPLE</option>
                               <option value="FAMILY PLAN" @if(old('capacidad') == 'FAMILY PLAN') selected @endif>FAMILY PLAN</option>                             
                           </select>                                
                           <label for="capacidad" class="col-md-4 control-label">CAPACIDAD HABITACIÓN</label>
                        </div>   
                        <div class="form-group form-floating">                            
                            <textarea class="form-control" placeholder="DETALLE DE LA HABITACIÓN" name="detalle" rows="5">{{ old('detalle') }}</textarea>
                            <label for="detalle" class="col-md-4 control-label">DETALLE DE LA HABITACIÓN</label>
                        </div>  
                        <div class="form-group">
                            <label for="imagenes" class="col-md-4 control-label">IMAGENES (10 Max.)</label>
                            <div class="">
                                <input type="file" class="form-control" name="imagenes[]" accept="image/*" value="{{ old('imagenes') }}" multiple> 
                            </div>
                        </div>  
                        <div class="my-3 form-group form-floating">                            
                            <input type="number" placeholder="PRECIO COSTO" class="form-control" name="costo" value="{{ old('costo') }}" step="0.01" required>                            
                            <label for="costo" class="control-label">PRECIO COSTO</label>
                        </div>  
                        <div class="mb-3 form-group form-floating">
                            <select name="moneda" class="form-select" aria-label="Default select example">  
                                <option value="USD" @if(old('moneda') == 'USD') selected @endif>USD</option>
                                <option value="EUR" @if(old('moneda') == 'EUR') selected @endif>EUR</option>
                                <option value="$" @if(old('moneda') == '$') selected @endif>$</option>                                    
                            </select>                                 
                            <label for="moneda" class="col-md-4 control-label">Tipo de Moneda</label>
                        </div>                         
                        <div class="mb-3 form-group form-floating">
                           <input type="number" name="utilidad" placeholder="utilidad" class="form-control" min="0" step="0.05">
                           <label for="utilidad" class="control-label">UTILIDAD %</label>                                            
                        </div>                                                     
                        <div class="mt-2">
                           <button type="submit" class="btn btn-primary">
                               AGREGAR HABITACIÓN 
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