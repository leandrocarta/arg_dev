@extends('layouts.app-master')
@section('content')

 <div class="container introduction-productos-content my-3">  
 </div> 
 <div class="container">
  <div class="row px-2">   
    <div class="col-md-3"></div> 
    <div class="col-md-6 productos mb-3 container-a-medida" id='form'>      
      <h1>RECIBO DE PAGO</h1>
      <p></p>
      <form action="/recibo_pagos" method="post">
        @csrf 
         @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif
        <div class="form-floating mb-1">
            <input type="text" placeholder="" name="nombre" class="form-control" required>
            <label for="nombre" class="form-label">Nombre?</label>
        </div>
        <div class="form-floating mb-1">
            <input type="text" placeholder="" name="apellido" class="form-control" required>
            <label for="apellido" class="form-label">Apellido?</label>
        </div>
        <div class="form-floating mb-1">
            <input type="text" placeholder="" name="dni" class="form-control" required>
            <label for="dni" class="form-label">DNI?</label>
        </div>
        <div class="form-floating mb-1">
            <input type="email" placeholder="" name="email" class="form-control" required>
            <label for="email" class="form-label">Correo electrónico!!</label>
        </div>
         <div class="form-floating mb-1">
            <textarea name="concepto" class="form-control" placeholder=""></textarea>
            <label for="concepto" class="form-label">Detalles del Pago</label>
        </div>
        <div class="form-floating mb-1">             
                <select name="moneda" class="form-select" aria-label="Default select example">  
                  <option value="Dolares" @if(old('moneda') == 'Dolares') selected @endif>Dolares</option>
                    <option value="Pesos" @if(old('moneda') == 'Pesos') selected @endif>Pesos</option>                    
                    <option value="Euros" @if(old('moneda') == 'Euros') selected @endif>Euros</option>
                </select>  
                <label for="servicio" class="control-label">Moneda del Pago?</label>             
        </div>           
        <div class="form-floating mb-1">
            <input type="number" name="importe" class="form-control" placeholder="" required>
            <label for="importe" class="form-label">Importe Pagado?</label>
        </div>
        <div class="form-floating mb-1">
            <input type="date" placeholder="" name="fecha" class="form-control" required>
            <label for="fecha" class="form-label">Fecha del Pago?</label>
        </div>
        <button type="submit" class="btn btn-primary mb-3">Enviar</button>
    </form>
    </div>
    <div class="col-md-3"></div> 
  </div>
 </div>
@endsection
