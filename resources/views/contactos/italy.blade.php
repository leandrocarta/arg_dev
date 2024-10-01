@extends('layouts.app-master')
@section('content')
        <div class="container datos-generales">        
            <div class="row">
                <div class="col-md-12">
                    <h2 class="my-4">FORMULARIO DE CONTACTO</h2>
                </div>
            </div>
        </div>
        <div class="container w-50 form-edit form-movil">                   
            <div class="row pb-3 px-3">
                <div class="col conten-login">              
                    <form action="{{ url('/italy') }}" method="post">
                        @csrf
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif                 
                        @error('email')
                            <div class="alert alert-danger mt-1">
                                <span class="">{{ $message }}</span>
                            </div>
                        @enderror
                        <p style="color: grey;"><b><u>Por favor completar todos los campos.</u></b></p>                          
                        <div class="mb-3 form-group">
                            <label for="tipo_prod" class="col-md-4 control-label">Cuál es tu interés?</label>
                            <div class="">
                                <select name="tipo_producto" class="form-select" aria-label="Default select example">                                             
                                   <option value="Cursos">Cursos de Italiano en el instituto</option>
                                   <option value="Viaje Idiomático">Viaje Idiomático y Cultural a Italia</option>
                                   <option value="Cursos y Viajes">Curso y Viaje</option>  
                                   <option value="Otros destinos">Otros Destinos</option>                                  
                                 </select>  
                            </div>
                        </div> 
                        <div class="form-group form-floating">
                            <input type="text" name="nombre" placeholder="Nos darias tu Nombre?" class="form-control" name="tel" value="{{ old('nombre') }}" required>
                            <label for="nombre" class="control-label">Nos darias tu Nombre?</label>
                        </div> 
                        <div class="form-group form-floating my-3">
                            <input type="text" name="apellido" placeholder="Y tu Apellido?" class="form-control" name="tel" value="{{ old('apellido') }}">
                            <label for="apellido" class="control-label">Y tu Apellido?</label>
                        </div>                         
                        <div class="form-floating form-group">
                            <input type="email" class="form-control" placeholder="Tu correo electrónico?" name="correo" value="{{ old('correo') }}" required>
                            <label for="correo" class="control-label">Tu correo electrónico?</label>    
                        </div> 
                        <div class="form-group form-floating my-3">
                            <input type="text" placeholder="Danos también un teléfono" class="form-control" name="tel" value="{{ old('tel') }}" required>
                            <label for="tel" class="control-label">Un teléfono (WhatsApp)</label>
                        </div> 
                        <div class="form-group form-floating my-3">
                            <input type="text" placeholder="Algún comentario?" class="form-control" name="comentario" value="{{ old('comentario') }}">
                            <label for="comentario" class="control-label">Algún comentario?</label>
                        </div>                                                           
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
            </div>
        </div>    
@endsection