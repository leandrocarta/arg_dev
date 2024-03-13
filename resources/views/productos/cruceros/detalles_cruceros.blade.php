@extends('layouts.app-master')
@section('content')
<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{ asset('assets/img_banner/' . $productos->img_banner) }}" class="d-block w-100" alt="...">
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
                     @if($productos->detalle)
                     <p><i class="fa-regular fa-clipboard"></i> {{ $productos->detalle }} </p>
                     @endif
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
<div class="modal fade" id="modalVuelos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fas fa-question-circle"></i> CRUCERO A: {{ $productos->destino }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/consulta_viaje_crucero" method="post">
          @csrf
          <input type="hidden" name="id" value="{{ $productos->id }}">
          <div class="form-floating mb-3">
            <input type="number" name="adultos" placeholder="Cantidad Adultos" class="form-control" min="1" value="1">
            <label for="adultos" class="form-label">Cantidad Adultos:</label>
          </div>
          <div class="form-floating mb-3">
            <input type="number" name="menores" placeholder="Cantidad Menores" class="form-control" min="0" value="0">
            <label for="menores" class="form-label">Cantidad Menores:</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" name="nombre" placeholder="Cuál es tu Nombre ?" class="form-control" required>
            <label for="nombre" class="form-label">Cuál es tu Nombre ?</label>
          </div>
          <div class="form-floating mb-3">
            <input type="email" name="email" placeholder="Cuál es tu Email?" class="form-control" required>
            <label for="email" class="form-label">Cuál es tu Email?</label>
          </div>
          <div class="form-floating mb-3">
            <textarea name="consulta" placeholder="Déjanos acá tu consulta!!" class="form-control"></textarea>
            <label for="consulta" class="form-label">Déjanos acá tu consulta!!</label>
          </div>
          <button type="submit" class="btn btn-primary w-100">Enviar Consulta</button>
        </form>
      </div>
    </div>
  </div>
</div>
@if(session('success'))
<div class="modal fade" id="modalExito" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title"><i class="fa fa-check-circle"></i>
        ¡Gracias por tu consulta! Nos comunicaremos contigo para brindarte toda la información que necesitas. ¡Hasta pronto!
        </h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"></span>
        </button>
      </div>
        <div class="modal-body">   
           <img src="{{ asset('assets/img_cruceros/' . $productos->imagen) }}" class="d-block w-100" alt=""> 
      </div>
      <div class="modal-footer">
       <p>{{ $productos->destino }}: Es un Excelente Destino !!</p> 
      </div>
    </div>
  </div>
</div>
@endif
@endsection