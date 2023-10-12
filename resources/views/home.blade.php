@extends('layouts.app-master')
@section('content')
 <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="10000">
      <img src="assets/img_banner/banner1.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5></h5>
        <p></p>
      </div>
    </div>
    <div class="carousel-item" data-bs-interval="2000">
      <img src="assets/img_banner/banner2.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5></h5>
        <p></p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="assets/img_banner/banner3.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5></h5>
        <p></p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<div class="container-fluid proximamente">
    <div class="row">
        <div class="col"><h1>¡Próximamente!</h1> 
            <p>Seremos pioneros y únicos al ofrecer paquetes turísticos excepcionales que te llevarán a experiencias inolvidables. Regístrate ahora para estar entre los primeros en enterarte sobre nuestro emocionante lanzamiento.</p>
        </div>
    </div>
</div>
    <!-- Contenedor de 6 productos en 3 filas con 2 columnas cada una 
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                </div>
            </div>
        </div>
    </div> -->
@endsection