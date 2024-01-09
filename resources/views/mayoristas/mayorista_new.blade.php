@extends('layouts.app-master')
@section('content')
    <div class="container w-50 form-movil">
        <div class="row px-3">
            <div class="col conten-login">
               <form action="{{ url('/mayorista_new') }}" method="post">
                @csrf
                <p style="color: grey;"><b><u>ALTA PROVEEDORES MAYORISTAS</u></b></p>
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" name="empresa" placeholder="Empresa" value="{{ old('empresa') }}" required>
                  <label for="empresa" class="form-label">Empresa</label>                  
                </div>
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" name="contacto" placeholder="Contacto" value="{{ old('contacto') }}" required>
                  <label for="contacto" class="form-label">Contacto</label>                  
                </div>
                <div class="mb-3 form-floating">
                      <input type="text" name="direccion" placeholder="Dirección" class="form-control" value="{{old('direccion')}}">
                      <label for="direccion" class="form-label">Dirección</label>                                            
                </div>
                <div class="mb-3 form-floating">
                      <input type="text" name="telefono" placeholder="Numero Teléfono" class="form-control" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="{{ old('telefono') }}">
                      <label for="telefono" class="form-label">Numero teléfono</label>                                            
                </div>                
                <div class="form-floating mb-3">
                  <input type="email" name="email" placeholder="Correo electrónico" class="form-control" id="email" aria-describedby="emailHelp" value="{{ old('email') }}" required>
                  <label for="email" class="form-label">Correo electrónico</label>                    
                </div>
                <div class="mb-3 form-floating">
                      <input type="text" name="ciudad" placeholder="Ciudad" class="form-control" value="{{old('ciudad')}}">
                      <label for="ciudad" class="form-label">Ciudad</label>                                            
                </div>   
                <div class="mb-3 form-floating">
                      <input type="text" name="provincia" placeholder="Provincia" class="form-control" value="{{old('provincia')}}">
                      <label for="provincia" class="form-label">Provincia</label>                                            
                </div>  
                <div class="mb-3 form-floating">
                      <input type="text" name="pais" placeholder="Pais" class="form-control" value="{{old('pais')}}">
                      <label for="pais" class="form-label">Pais</label>                                            
                </div>                  
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
            </div>
        </div>
    </div>
  @endsection