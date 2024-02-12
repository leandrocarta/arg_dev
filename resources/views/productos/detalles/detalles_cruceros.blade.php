@extends('layouts.app-master')
@section('content')
<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{ asset('assets/img_cruceros/' . $productos->img_banner) }}" class="d-block w-100" alt="...">
    </div>    
  </div>
</div>
<div class="container introduction-productos-content mb-2">
  <div class="row">
    <div class="col-12 introduction-productos">
        <h1>{{ $productos->naviera->nombre }}</h1>
        <p>{{ $productos->barco->nombre }}: {{ $productos->barco->detalle }}.
        </p>
    </div>
  </div>
</div>
<div class="container-fluid my-3 m-auto productos-detalles">
   <div class="row px-2 campo-detalles datos-generales">        
      <div class="col-md-5 ">
            <div class="detalle-hotel">
                <h5 class="subtitulo-hotel"><i class="fa-solid fa-anchor"></i> {{ $productos->naviera->nombre }}</h5>
                 <div class="info-hotel">
                     <p><i class="fa-solid fa-ship"></i> {{ $productos->barco->nombre }}                                  
                     </p> 
                     <p>
                     <i class="fa-solid fa-route"></i> {{ $productos->destino }} desde {{ $productos->puerto_salida }}   
                     </p>
                     <p>
                     <i class="fa-solid fa-cloud-moon"></i>{{ $productos->estadia }} NOCHES   
                     </p>                     
                     <p class=""><i class="fa-solid fa-bed"></i> {{ $productos->tipo_cabina }} 2 PAX </p>
                     <p>                        
                     </p>  
                     <p><i class="fa-regular fa-calendar-days"></i> {{ $productos->fecha_partida }}  - Consultar Otras Fechas!!</p>
                     <p class="a-confirmar">Consultar otros tipos de cabinas y/o mayor capacidad de PASAJEROS.</p>
                     <p><i class="fa-regular fa-clipboard"></i> {{ $productos->detalle }} </p>
                 </div>                 
             </div>             
             <hr>
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <p><strong>PRECIOS DESDE: usd {{ $productos->precio }}</strong> 
                        <p class="a-confirmar">A Confirmar al momento de la reserva</p>  
                        </p>
                    </div>
                    <div class="col-md-5">
                        <a href="#modalVuelos" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#modalVuelos">Consultar Lugares!!!</a>                       
                    </div>
                </div>
            </div>
             
      </div>
      <div class="col-md-7 mt-2-movil">
        <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
          <div class="carousel-indicators">
             @foreach ($productos->barco->getImagenes() as $key => $imagen)
              <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="{{ $key }}" class="{{ $key === 0 ? 'active' : '' }}" aria-current="true" aria-label="Slide {{ $key + 1 }}"></button>
             @endforeach
          </div>
          <div class="carousel-inner img-prod-banner rounded">
             @foreach ($productos->barco->getImagenes() as $key => $imagen)
              <div class="carousel-item {{ $key === 0 ? 'active' : '' }}" data-bs-interval="3000">                
                <img src="{{ asset('assets/img_cruceros/' . $imagen) }}" class="d-block w-100" alt="Imagen Barco">                
              </div>
             @endforeach
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
      </div>
    </div>         
  </div>   

@endsection