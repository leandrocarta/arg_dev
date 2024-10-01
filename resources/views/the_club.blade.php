
@extends('layouts.app-master')
@section('content')
  <div class="container my-5 m-auto">
  <div class="row my-3">
    <div class="col-md-5 border-end">
      <img src="assets/img/The_club_min.png" class="img-fluid rounded" alt="img_club">
    </div>
    <div class="col-md-7 titulo-paquetes">
      <h5>¡Presentamos <span>THE CLUB</span>, el programa exclusivo que te acerca a una experiencia turística inigualable y te permite financiarla de manera accesible!!
      Fieles a nuestro compromiso de brindarles la mejor experiencia, hemos creado <span>THE CLUB</span>, un programa diseñado para fortalecer la confianza entre nuestros socios y la empresa. A través de <span>THE CLUB</span>, accederás a un sinfín de beneficios que te permitirán disfrutar al máximo de tus viajes:  
      </h5> 
       <ul>
         <li>Precios preferenciales en productos turísticos: Disfruta de descuentos exclusivos en paquetes de viaje, hoteles, vuelos y actividades.</li>         
         <li>Financiación para tus viajes: Con THE CLUB, puedes financiar tus viajes con una entrega inicial y el saldo en cuotas fijas a una tasa preferencial.</li>
         <li>Asesoramiento personalizado: Nuestro equipo de expertos te brindará atención personalizada para ayudarte a planificar tu viaje ideal.</li>
         <li>Ofertas especiales: Recibe notificaciones anticipadas sobre promociones y oportunidades únicas para ahorrar en tus viajes.</li>
         <li>Y mucho más: ¡Prepárate para descubrir sorpresas y beneficios adicionales que te sorprenderán!</li>
      </ul>  
      <h6>El registro en THE CLUB no tiene costo, PERO SI, tiene muchos beneficios!!!</h6>    
    </div>
  </div>  
  <div class="row">
    <div class="col-md-12">
       <div class="w-100">
            <a href="{{ route('client.register_client') }}" class="btn btn-primary w-100">REGISTRARME "THE CLUB"</a>
        </div>
    </div>
  </div>
</div>

@endsection