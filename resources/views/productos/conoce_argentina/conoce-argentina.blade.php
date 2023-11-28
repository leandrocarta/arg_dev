@extends('layouts.app-master')
@section('content')
  <div class="container my-5 m-auto productos-detalles">
     <div class="titulo text-center">
       <h2 class="display-4">¡Conoce Argentina con ARGTRAVELS!</h2>
     </div>
     <div class="row my-5">
     @foreach ($productos as $producto)
     <div class="col-md-4 productos">
       <div class="card">
         <div class="card-img-container">
          <img src="{{ asset('assets/img_paquetes/' . $producto->imagen) }}" class="card-img-top img-fluid productos" alt="{{ $producto->nombre }}">
            <div class="card-img-overlay titulo-prod">
              <h6 class="card-title">{{ $producto->nombre }}</h6>
              <p class="precio-total">Precio desde: ${{ $producto->precio_total }}</p>
            </div>
         </div>      
         <div>        
           <p class="ms-2">
             @if ($producto->transporte == 'Aéreo')
               <i class="fas fa-plane-departure"></i>
             @elseif ($producto->transporte == 'Aéreo Ida') 
               <i class="fas fa-plane-departure"></i>
             @elseif ($producto->transporte == 'Micro')
               <i class="fas fa-bus"></i>
             @endif:
             <span>{{ $producto->origen_salida }} ⇌ {{ $producto->ciudad_destino }}</span>
           </p>
              <p class="ms-2">
             <i class="fa-solid fa-bus"></i> : <span>Aeropuerto ⇌ Hotel</span>
           </p>
        <p class="ms-2">
          <i class="fa-solid fa-hotel"></i> : <span>{{ $producto->hotel }} 
            @if ($producto->categoria_hotel == 5)
            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
            @elseif ($producto->categoria_hotel == 4)  
            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
           @elseif ($producto->categoria_hotel == 3)  
            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
           @elseif ($producto->categoria_hotel == 2)  
            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i> 
            @endif || <i class="fa-solid fa-bed ms-2"></i> : <span>{{ $producto->duracion }} <i class="fa-solid fa-cloud-moon"></i></span>        
          </span>           
        </p>         
        <p class="ms-2">          
        </p>        
      </div>
      <a href="#" class="btn btn-primary">Ver detalles</a>
    </div>
  </div>
  @endforeach
</div> 
     <div class="text-center">
       <a href="#" class="btn btn-primary btn-lg">Ver todos los destinos</a>
     </div>
  </div>
@endsection
