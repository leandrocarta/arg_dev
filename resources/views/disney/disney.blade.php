@extends('layouts.app-master')
@section('content')

  <!-- Seccion Disney USA -->
  <section>
  <div class="container-fluid mt-3" id="disney">  
    <div class="row">
      <div class="col-md-12">
        <h3 class="quince-title">Quinceañeras</h3>
      </div>  
    </div>  
    <div class="row">
    <!-- Imagen Disney USA -->
    <div class="col-md-6 p-0">
         <a href="{{ route('disney.usa') }}" class="zoom-effect">
        <div class="card position-relative">
            <img src="assets/img_disney/img-disney-usa.jpg" class="img-fluid" alt="Disney USA">
            <div class="card-body text-center boton-disney-usa position-absolute">
                <img src="assets/img_disney/boton-disney-usa.png" class="img-fluid" alt="Disney USA">
            </div>
        </div>
    </a>
    </div>
    <div class="col-md-6 p-0">
        <a href="{{ route('eurodisney') }}" class="zoom-effect">
            <div class="card position-relative">
                <img src="assets/img_disney/img-disney-eur.jpg" class="img-fluid" alt="Disney Europa">
                <div class="card-body text-center boton-disney-usa position-absolute">
                    <img src="assets/img_disney/boton-disney-europa.png" class="img-fluid" alt="Disney Europa">
                </div>
            </div>
        </a>
    </div>
  </div>
  </div>
@endsection

        
       
        