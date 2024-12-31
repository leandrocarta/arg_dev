@extends('layouts.app-master')

@if (Auth::check() && Auth::user()->id_rango === 1)
@section('content')
     <div class="container w-50 form-edit">
        <div class="row">
           <div class="col conten-login">   
            <p>ALTA CUPOS AEREOS</p>       
                 <form class="form-horizontal" method="POST" action="{{ route('aerolineas.store') }}" enctype="multipart/form-data">
                     {{ csrf_field() }}   
                     <div class="mb-3">
                        <label for="penalidad" class="form-label">Fecha de Penalidad:</label>
                        <input type="date" name="penalidad" class="form-control" min="{{ date('Y-m-d') }}" required>
                    </div>   
                     <div class="mb-3 form-group form-floating">
                        <input type="number" class="form-control" name="cupos" placeholder="Cupos disponibles" required>
                        <label for="cupos" class="control-label">Cupos disponibles</label>
                     </div>                                
                     <div class="mb-3 form-group form-floating">
                        <input type="text" class="form-control" name="compania" placeholder="Nombre Compañia" required>
                        <label for="compania" class="control-label">Nombre Compañia</label>
                     </div>  
                      <div class="form-group">
                        <label for="descripcion" class="control-label">Info</label>
                        <div class="">
                           <textarea class="form-control" name="descripcion" rows="5">{{ old('descripcion') }}</textarea>
                        </div>
                     </div> 
                     <div class="mb-3">
                        <label for="fecha_inicio" class="form-label">Fecha inicio viaje:</label>
                        <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" min="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_fin" class="form-label">Fecha fin viaje:</label>
                        <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" min="{{ date('Y-m-d') }}" required>
                    </div>                          
                     <div class="mt-2">
                        <button type="submit" class="btn btn-primary">
                            GUARDAR
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