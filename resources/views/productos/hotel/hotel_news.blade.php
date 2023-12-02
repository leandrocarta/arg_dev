@extends('layouts.app-master')

@if (Auth::check() && Auth::user()->id_rango === 1)
@section('content')
     <div class="container w-50 form-edit">
        <div class="row">
           <div class="col conten-login">   
            <p>ALTA DE HOTELES</p>       
                 <form class="form-horizontal" method="POST" action="{{ route('hotel.store') }}" enctype="multipart/form-data">
                     {{ csrf_field() }}
                     <div class="form-group">
                         <label for="nombre" class="control-label">Nombre del Hotel</label>                         
                         <div>
                             <input type="text" class="form-control" name="nombre" required>
                        </div>
                     </div>
                     <label for="categoria" class="control-label">Categoría del Hotel</label>
                     <div>
                        <input type="number" class="form-control" name="categoria" required>
                     </div>   
                     <div class="form-group">
                           <label for="publico" class="col-md-4 control-label">¿Apto todo Publico?</label>
                            <div class="">
                                <select name="publico" class="form-select" aria-label="Default select example">  
                                   <option value="Publico">Apto Publico</option>
                                   <option value="Niños Mayores de 6 años">Niños Mayores de 6 años</option>
                                   <option value="Solo Adultos">Solo Adultos</option>
                                </select>  
                            </div>
                     </div>     
                     <div class="form-group">
                            <label for="img_banner" class="col-md-4 control-label">Imagen Principal Banner (1350x500)</label>
                            <div class="">
                                <input type="file" class="form-control" name="img_banner" value="{{ old('img_banner') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="imagenes" class="col-md-4 control-label">Imagenes Secundarias</label>
                            <div class="">
                                <input type="file" class="form-control" name="imagenes[]" accept="image/*" value="{{ old('imagenes') }}" multiple> 
                            </div>
                        </div>    
                        <div class="form-group">
                           <label for="gym" class="col-md-4 control-label">¿Área de Gimnasio?</label>
                            <div class="">
                                <select name="gym" class="form-select" aria-label="Default select example">                                      
                                   <option value="Sin Gimnasio">Sin Gimnasio</option>
                                   <option value="Área de Gimnasio">Área de Gimnasio</option>
                                </select>  
                            </div>
                        </div>     
                        <div class="form-group">
                           <label for="spa" class="col-md-4 control-label">¿Área de Spa?</label>
                            <div class="">
                                <select name="spa" class="form-select" aria-label="Default select example">                                      
                                   <option value="Sin Spa">Sin Spa</option>
                                   <option value="Área de Spa">Área de Spa</option>
                                </select>  
                            </div>
                        </div>                       
                        <div class="mt-2">
                        <button type="submit" class="btn btn-primary">
                            Crear Producto Hotel
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