@extends('layouts.app-master')
@section('content')
<div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">  
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="5000">      
      <img src="assets/img_banner/medida-min.png" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h1></h1>
          <p></p>
        </div>     
    </div>
  </div>  
 </div> 
 <div class="container introduction-productos-content my-3">
  <div class="row">
    <div class="col-12 introduction-productos">
      <h1>DISEÑAMOS TU VIAJE A TU MEDIDA</h1>
      <p>Embárcate en una aventura global explorando los destinos turísticos más asombrosos del mundo, donde la diversidad cultural, la historia milenaria y los paisajes impresionantes se entrelazan para ofrecer experiencias inolvidables.</p>
  </div>
  </div>
 </div> 
 <div class="container">
  <div class="row">
    <div class="col-md-6">
      <div class="">
        <img class="w-100" src="assets/img/cuestionario.png" alt="">
      </div>
      
    </div>
    <div class="col-md-6 productos mb-3">
      <h1>Cuestionario de Viaje</h1>
      <p></p>
      <form action="/formulario-a-medida" method="post">
        @csrf 
        <div class="form-floating mb-1">
            <input type="text" placeholder="" name="nombre" class="form-control" >
            <label for="nombre" class="form-label">¿Nos darías tu nombre?</label>
        </div>
        <div class="form-floating mb-1">
            <input type="email" placeholder="" name="email" class="form-control" required>
            <label for="email" class="form-label">Y tú correo electrónico para contactarte!!</label>
        </div>
        <div class="form-floating mb-1">
            <input type="date" placeholder="" name="fecha" class="form-control" >
            <label for="fecha" class="form-label">¿En qué fecha planeas viajar?</label>
        </div>
        <div class="form-floating mb-1">
            <input type="number" name="duracion" class="form-control" placeholder="" >
            <label for="duracion" class="form-label">¿Cuánto días planeas dedicar a este viaje?</label>
        </div>
        <div class="form-floating mb-1">
            <input type="text" placeholder="" name="destino" class="form-control" >
            <label for="destino" class="form-label">¿Hay algún destino específico que quieras visitar?</label>
        </div>
        <div class="form-floating mb-1">
            <input type="number" name="adultos" value="1" class="form-control" placeholder="" >
            <label for="adultos" class="form-label">¿Cantidad de adultos?</label>
        </div>
        <div class="form-floating mb-1">
            <input type="number" name="menores" value="0" class="form-control" placeholder="" >
            <label for="menores" class="form-label">¿Cantidad de menores?</label>
        </div>        
        <div class="form-floating mb-1">
            <input type="text" name="presupuesto" class="form-control" placeholder="" >
            <label for="presupuesto" class="form-label">¿Tienes un presupuesto estimado para este viaje?</label>
        </div>
        <div class="form-floating mb-1">
            <input type="text" name="alojamiento" class="form-control" placeholder="">
            <label for="alojamiento" class="form-label">¿Prefieres Hotel, Apart u otro tipo de alojamiento?</label>
        </div>        
        <div class="form-floating mb-1">
            <input type="text" name="actividades" class="form-control" placeholder="">
            <label for="actividades" class="form-label">¿Quieres realizar actividades, cuales?</label>
        </div>
        <div class="form-floating mb-1">
            <input type="text" name="salud" class="form-control" placeholder="">
            <label for="salud" class="form-label">¿Hay alguna condición de salud o de dieta que debamos saber?</label>
        </div>
        <div class="form-floating mb-1">
            <input type="text" name="independencia" class="form-control" placeholder="">
            <label for="independencia" class="form-label">¿Prefieres un Itinerario estructurado o más flexibilidad?</label>
        </div>
        <div class="form-floating mb-1">
            <textarea name="expectativas" class="form-control" placeholder=""></textarea>
            <label for="expectativas" class="form-label">¿Cuáles son tus expectativas principales?</label>
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
