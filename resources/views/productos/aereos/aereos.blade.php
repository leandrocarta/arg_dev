@extends('layouts.app-master')
@section('content')
 <div class="container">
  <div class="row">
    <div class="col-md-6">
      <form action="/cotizar_vuelos" method="post">
          @csrf
          <div class="form-floating mb-3">
            <input type="date" name="fecha_ida" placeholder="Fecha de Ida" class="form-control" required>
            <label for="fecha_ida" class="form-label">Fecha Partida:</label>
          </div>
          <div class="form-floating mb-3">
            <input type="date" name="fecha_regreso" placeholder="Fecha Regreso si Corresponde" class="form-control">
            <label for="fecha_regreso" class="form-label">Fecha Regreso si Corresponde :</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" name="origen" placeholder="Ciudad de Origen" class="form-control" required>
            <label for="origen" class="form-label">Ciudad de Origen:</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" name="destino" placeholder="Ciudad Destino" class="form-control" required>
            <label for="destino" class="form-label">Ciudad Destino:</label>
          </div>
          <div class="form-floating mb-3">
            <input type="email" name="email" placeholder="Email de Contacto" class="form-control" required>
            <label for="email" class="form-label">Email de Contacto:</label>
          </div>
          <div class="form-floating mb-3">
            <textarea name="aclaracion" placeholder="Tenes algo para aclararnos?" class="form-control"></textarea>
            <label for="email" class="form-label">Tenes algo que aclarar?</label>
          </div>
          <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
  </div>
 </div>
 @endsection