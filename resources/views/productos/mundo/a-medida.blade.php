@extends('layouts.app-master')
@section('content')
<div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">  
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="5000">      
      <img src="assets/img_banner/Medida-min.png" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h1></h1>
          <p></p>
        </div>     
    </div>
  </div>  
 </div> 
 <div class="container introduction-productos-content my-3">
  <div class="row px-2">
    <div class="col-12 introduction-productos">
      <h1>DISEÑAMOS TU VIAJE A TU MEDIDA</h1>
      <p>Embárcate en una aventura global explorando los destinos turísticos más asombrosos del mundo, donde la diversidad cultural, la historia milenaria y los paisajes impresionantes se entrelazan para ofrecer experiencias inolvidables.</p>
  </div>
  </div>
 </div> 
 <div class="container">
  <div class="row px-2">
    <div class="col-md-6 mb-3">
      <div class="">
        <img class="w-100" src="assets/img/cuestionario.png" alt="">
      </div>      
    </div>
    <div class="col-md-6 productos mb-3 container-a-medida" id='form'>
      <h1>Cotizar Paquetes</h1>
      <p></p>
      <form action="/a-medida" method="post">
        @csrf 
         @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif
        <div class="form-floating mb-1">
            <input type="text" placeholder="" name="nombre" class="form-control" required>
            <label for="nombre" class="form-label">¿Nos darías tu Nombre y Apellido?</label>
        </div>
        <div class="form-floating mb-1">
            <input type="email" placeholder="" name="email" class="form-control" required>
            <label for="email" class="form-label">Y tú correo electrónico para contactarte!!</label>
        </div>
        <div class="form-floating mb-1">
            <input type="date" placeholder="" name="fecha" class="form-control" required>
            <label for="fecha" class="form-label">¿En qué fecha planeas viajar?</label>
        </div>
        <div class="form-floating mb-1">
            <input type="number" name="dias" class="form-control" placeholder="" required>
            <label for="dias" class="form-label">¿Cuántas noches serian ideales para este viaje?</label>
        </div>
        <div class="form-floating mb-1">
            <input type="text" placeholder="" name="destino" class="form-control" required>
            <label for="destino" class="form-label">¿Cual sería tu destino para estas vacaciones?</label>
        </div>
        <div class="form-floating mb-1">
            <input type="number" name="adultos" value="1" class="form-control" placeholder="" min="1">
            <label for="adultos" class="form-label">¿Cantidad de adultos?</label>
        </div>
        <div class="form-floating mb-1">
            <input type="number" name="menores" value="0" class="form-control" placeholder="" min="0">
            <label for="menores" class="form-label">¿Cantidad de menores?</label>
        </div>  
        <div class="form-floating mb-1">
            <input type="text" name="edad_menores" class="form-control" placeholder="" >
            <label for="edad_menores" class="form-label">Si hay menores, ¿Que edades tienen? Ejemplo: (11-8)</label>
        </div>   
        <div class="form-floating mb-1">
            <input type="number" name="habitaciones" value="1" class="form-control" placeholder="" min="1" step="1">
            <label for="habitaciones" class="form-label">¿Cuantas habitaciones serían necesarias?</label>
        </div>     
        <div class="form-floating mb-1">             
                <select name="servicio" class="form-select" aria-label="Default select example">  
                    <option value="Priorizo el Precio" @if(old('servicio') == 'Priorizo el Precio') selected @endif>Priorizo el Precio</option>
                    <option value="Priorizo la Calidad y Servicio " @if(old('servicio') == 'Priorizo la Calidad y Servicio ') selected @endif>Priorizo la Calidad y Servicio </option>
                    <option value="Busco Hoteles de Lujo" @if(old('servicio') == 'Busco Hoteles de Lujo') selected @endif>Busco Hoteles de Lujo</option>
                </select>  
                <label for="servicio" class="control-label">¿Que priorizas?</label>             
        </div>   
        <div class="form-floating mb-1">
            <textarea name="info" class="form-control" placeholder=""></textarea>
            <label for="info" class="form-label">¿Si crees relevante otra información, ingrésala aquí?</label>
        </div>
        <button type="submit" class="btn btn-primary mb-3">Enviar</button>
    </form>
    </div>
  </div>
 </div>
@endsection
