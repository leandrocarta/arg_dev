@extends('layouts.app-master')
@section('content')
    <!-- Otros datos del usuario que desees mostrar -->
<section class="container mt-5 presentacion">    
        <div class="titulo">
          <h2><span>TRABAJO REMOTO: </span>Únete a la emocionante revolución digital en una de las industrias de mayor crecimiento a nivel global: <span>'EL TURISMO'.</span> Conviértete en un <span>'PROMOTOR DIGITAL'</span> priorizando tu independencia y transformando tus sueños en oportunidades ilimitadas. ¡Inicia hoy la construcción de tu futuro en tus propios términos!</h2>          
          <p><span>NO NECESITAS INVERTIR DINERO PARA UNIRTE</span>. Valoramos tu actitud y tu deseo de crecer por encima de todo.
           Creemos en tu potencial y te ofrecemos el apoyo y la capacitación que necesitas. No dejes que las preocupaciones sobre inversiones te detengan.
           ¡Estás en el lugar adecuado para comenzar este emocionante viaje!
          </p>
        </div>   
        <hr>
        <div class="row contenido">
          <div class="col-md-5 mt-2">  
             @if (!auth()->check())                   
               @if ($user)
                 <img class="img-fluid" src="{{ asset('assets/img_profile/' . $user->img_profile) }}" alt="{{ $user->nombre }}">
                 <p class="mb-0"><b>NOMBRE:</b> {{ $user->nombre }} {{ $user->apellido }}</p> 
                 @if ($rango = $rangos->where('id', $user->id_rango)->first())
                   <p class="mb-0"><b>CARGO:</b> {{ $rango->nombre }}</p>
                 @else
                   <p></p>
                 @endif       
                 @if ($pais = $paises->where('cod_pais', $user->id_pais)->first())
                   <p class="mb-0"><b>PAÍS RESIDENCIA</b>: {{ $pais->nombre_img }}</p>
                 @else
                   <p>País no encontrado</p>
                 @endif  
                 <div class="mb-3 border-bottom" id="bandera-container">
                       @if ($user->id_pais)
                          <?php
                           $pais_editado = $paises->firstWhere('cod_pais', $user->id_pais);
                           ?>
                         @if ($pais_editado)
                           <div class="contenido-opcion-bandera d-flex">
                           <img id="bandera-img" src="{{ asset('assets/img_banderas/' . $pais_editado->nombre . '.png') }}" alt="Bandera del país" width="50">
                           <!-- Para Produccion anteponer la carpeta public -->
                           <!-- <img id="bandera-img" src="{{ asset('public/assets/img_banderas/' . $pais_editado->nombre . '.png') }}" alt="Bandera del país" width="50"> -->
                           </div>
                         @endif
                       @endif
                 </div>                   
               @endif     
             @else 
               @php
                $user = auth()->user();
                @endphp
                @if ($user)
               <img class="img-fluid" src="{{ asset('assets/img_profile/' . $user->img_profile) }}" alt="{{ $user->nombre }}">
                <p class="mb-0"><b>NOMBRE:</b> {{ $user->nombre }} {{ $user->apellido }}</p> 
                 @if ($rango = $rangos->where('id', $user->id_rango)->first())
                <p class="mb-0"><b>CARGO:</b> {{ $rango->nombre }}</p>
                @else
                 <p></p>
                @endif       
                @if ($pais = $paises->where('cod_pais', $user->id_pais)->first())
                <p class="mb-0"><b>PAÍS RESIDENCIA</b>: {{ $pais->nombre_img }}</p>
                @else
                 <p>País no encontrado</p>
                @endif  
                <div class="mb-3 border-bottom" id="bandera-container">
                       @if ($user->id_pais)
                       <?php
                           $pais_editado = $paises->firstWhere('cod_pais', $user->id_pais);
                       ?>
                       @if ($pais_editado)
                       <div class="contenido-opcion-bandera d-flex">
                        <img id="bandera-img" src="{{ asset('assets/img_banderas/' . $pais_editado->nombre . '.png') }}" alt="Bandera del país" width="50">
                        <!-- Para Produccion anteponer la carpeta public -->
                          <!-- <img id="bandera-img" src="{{ asset('public/assets/img_banderas/' . $pais_editado->nombre . '.png') }}" alt="Bandera del país" width="50"> -->
                       </div>
                       @endif
                       @endif
                </div>                   
               @endif     
        @endif          
                
                <div class="row">
                   <div class="col-md-12">
                     <p>Te extendemos una invitación especial para un exclusivo encuentro en línea en el que develaremos los pormenores de nuestro emocionante negocio y te mostraremos cómo puedes convertirte en un miembro destacado de esta próspera comunidad de emprendedores.</p>
                     <p>En esta presentación, descubrirás:</p>
                     <ul>
                       <li>Cómo puedes alcanzar la independencia financiera en la industria del turismo.</li>
                       <li>Las ventajas de ser tu propio jefe y trabajar desde cualquier lugar del mundo.</li>
                       <li>El camino claro y escalonado hacia el éxito, con un equipo comprometido a tu lado.</li>
                     </ul>                     
                     <p>¡Esperamos verte allí!</p>
                     <p>Saludos cordiales,</p>
                     <p> <b>Confirma tu lugar en el siguiente formulario:</b></p>
                   </div>
                 </div>             
                <div class="row">
                  <div class="col p-2 m-1 border bg-danger rounded">
                    <form action="{{ route('user.presentation_registro')}}" method="post">
                      @csrf
                      @php
                        $reclutador_equipo_oficial = request()->cookie('reclutador_equipo_oficial', '');
                      @endphp
                     <input type="hidden" name="reclutador_equipo_oficial" value="{{ $reclutador_equipo_oficial }}">
                      <!-- Agrega aquí tus campos de formulario -->
                      <div class="form-floating my-2">
                          <input type="email" class="form-control" placeholder="Danos tu mejor email" name="email" required>
                          <label for="email" class="form-label">¿Nos darías tu mejor email? </label>
                      </div>
                      <div class="mb-3 form-floating mt-3">
                        <input type="text" name="name" placeholder="Mi Nombre" class="form-control" required>
                        <label for="name" class="form-label">¿Cuál es tu Nombre?</label>                                            
                      </div>  
                      <div class="mb-3 form-floating">
                        <input type="text" name="pais" placeholder="¿En qué país vives?" class="form-control" required>
                        <label for="pais" class="form-label">¿En qué país vives?</label>                                            
                      </div>  
                      <div class="form-floating my-2">
                           <select name="fecha_presentacion" class="form-select" aria-label="Default select example" >   
                                   <option value="23 Octubre - 21hs Arg">23 Octubre - 21hs Arg</option>
                                   <option disabled value="30 Octubre - 21hs Arg">30 Octubre - 21hs Arg</option>                                   
                           </select>     
                           <label for="fecha_presentacion" class="form-label">Fecha Próxima Presentación</label>                      
                      </div>                                           
                      <button type="submit" class="btn btn-light form-control">REGISTRARME A LA REUNIÓN</button>
                    </form>
                  </div>
                </div>                
            </div>    
            <div class="col-md-7 border-start presentacion-contenido"> 
              <div class="row">
                <div class="col">
                   <h4>TRABAJO REMOTO Y LIBERTAD FINANCIERA:</h4>
                   <p>Imagina un mundo en el que tú controlas tus horario, tus ingresos y tu lugar de trabajo. En nuestro modelo de negocio, el <span>trabajo remoto </span>es la norma, lo que significa que puedes disfrutar de la comodidad de gestionar tu tiempo a tu manera. ¿Quieres pasar más tiempo con tu familia? ¿Viajar más? ¿O simplemente trabajar desde la comodidad de tu hogar? La elección es tuya. Además, en las próspera industria del turismo, <span>las oportunidades son ilimitadas</span>, y <span>tus ganancias también lo son</span>. Descubre un mundo de posibilidades y potencial financiero que puede ser tuyo en este emocionante camino como <span>PROMOTOR DIGITAL</span>.</p>
             
                   <h4>VENTAJAS DE VENDER PRODUCTOS TURÍSTICOS:</h4>
                   <p>Nuestra especialización se centra en la venta de productos turísticos, una de las industrias más emocionantes y prósperas en todo el mundo, con un crecimiento del 33% en ventas en línea en los últimos años. Esto significa que tendrás la oportunidad de conectar a las personas con experiencias únicas y al mismo tiempo generar ingresos significativos.</p>
    
                   <h4>CRECIMIENTO EN EL MODELO MULTINIVEL:</h4>
                   <p>En nuestro modelo de negocio multinivel, tu éxito es nuestro éxito. Aquí, no solo construyes tu propio negocio, sino que también tienes la oportunidad de liderar y apoyar a otros en su camino hacia el éxito. <span>"Liderar un equipo es una pieza fundamental; es el punto de partida para acelerar tu emprendimiento y generar ingresos pasivos sin que tengas que trabajar incansablemente por tu cuenta. Tu equipo trabajará contigo y para ti, contribuyendo al éxito de todos"</span>.</p>
    
                   <h4>VENDER EN TODO EL MUNDO:</h4>
                   <p>Imagina la emoción de poder llegar a clientes en todo el mundo. Con nosotros, tendrás la oportunidad de expandir tu alcance más allá de las fronteras, conectándote con personas de diferentes culturas y creando un negocio global.</p>
    
                   <h4>AVALADOS POR EL MINISTERIO DE TURISMO:</h4>
                   <p>La confianza es fundamental en los negocios, y nuestro respaldo por parte del Ministerio de Turismo de la Nación es una prueba de nuestra integridad y calidad. Trabajar con nosotros significa ser parte de una empresa que cumple con los más altos estándares y está comprometida con el éxito de sus colaboradores.</p>
    
                   <p>En resumen, esta es una oportunidad única para tomar el control de tu vida, construir un negocio exitoso en una emocionante industria y ser parte de una comunidad respaldada por el Ministerio de Turismo. ¿Estás listo para empezar este emocionante viaje hacia un futuro lleno de posibilidades? ¡Únete a nosotros y juntos hagamos realidad tus sueños!</p>
                </div>
              </div>
              <hr>   
              <div class="cita-pascal">                
                <div class="row">
                  <div class="col-12 text-center titulo-contenido">
                    <blockquote class="blockquote">
                    <p class="">Consideren este programa <span>“PROMOTOR DIGITAL”</span> como una <span>“VALIOSA OPORTUNIDAD”</span> en la industria del turismo. Si deciden unirse y participar activamente, tendrán la oportunidad única de adquirir conocimientos esenciales, establecer conexiones profesionales sólidas y obtener ventajas competitivas en este sector en constante crecimiento. Sin embargo, si optan por no participar, corren el riesgo de perderse una oportunidad excepcional que podría tener un impacto significativo en su crecimiento personal y su libertad financiera.</p>
                    <footer class="blockquote-footer">Carta Leandro (CEO)</footer>
                    </blockquote>
                  </div>
                </div>
              </div>          
            </div> 
        </div>
    </section>
@endsection
