@extends('layouts.app-master')

@section('content')
<div class="container my-5">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div class="row">
        <div class="col-12 text-center">
            <h1>¡Viaja a Eurodisney con Enjoy 15!</h1>
            <p>Vive una experiencia mágica en Eurodisney con nuestras increíbles ofertas.</p>
        </div>
    </div>

    <!-- Video de YouTube -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="ratio ratio-16x9"> 
                <iframe width="853" height="480" src="https://www.youtube.com/embed/E654wPWE3EA" title="Viajá a Disney EUROPA con Enjoy 15 y Argtravels.tur.ar" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
        </div>
    </div>

    <!-- Botones para redirigir a los destinos -->
     <div class="row mt-5">
        <div class="col-12 text-center">
            <h2>Programa EuroDisney 2025 - 2026 - 2027</h2>
            <p>Seleccionalo para conocer más detalles</p>
        </div>
    </div>
    <div class="row text-center mt-5 justify-content-center">       
        <div class="col-md-3">
            <button class="btn program-btn" data-bs-toggle="collapse" data-bs-target="#collapsePremiumEuro" aria-expanded="false" aria-controls="collapsePremiumEuro">Programa</button>
        </div>       
    </div>
    <div class="collapse-container mt-3"> 
       <div class="collapse" id="collapsePremiumEuro">
        <div class="card card-body">
    <h3>Europa - Premium</h3>

    <p><strong>Salidas programadas:</strong> Septiembre 2025 / 2026</p>

    <p><strong>Nuestros servicios incluyen:</strong></p>
    <ul>
        <li>Salidas desde principales ciudades: Buenos Aires, Rosario y Córdoba, brindando opciones accesibles para nuestras pasajeras desde distintos puntos del país.</li>
        <li>Transporte aéreo: Ofrecemos vuelos con aerolíneas de primer nivel, garantizando así un viaje seguro y cómodo para nuestras pasajeras.</li>
        <li>Traslados receptivos: Bus de nivel ejecutivo exclusivo para nuestro grupo. Incluye todos los traslados: desde y hacia el aeropuerto, hoteles y excursiones. Contamos con nuestra "Enjoy15 Playlist" en Spotify y YouTube Music, especialmente seleccionada para acompañar el viaje.</li>
        <li>Régimen de comidas: Brindamos un plan que incluye pensión completa con merienda incluida, asegurando una experiencia gastronómica de excelencia durante todo el viaje.</li>
        <li>Asistencia médica: A cargo de Assist-Card, reconocida por proporcionar la mejor atención médica, odontológica y legal, con una amplia cobertura a nivel internacional, brindando tranquilidad y seguridad a nuestras pasajeras y sus familias, en todo momento.</li>
        <li>Coordinación permanente: Nuestro equipo de coordinadores acompaña a las pasajeras en todo el recorrido, brindándoles una atención personalizada y asegurando su bienestar durante todo el viaje.</li>
        <li>Coordinación general: Compuesta por gerentes y personal operativo. Complementando a la coordinación permanente para garantizar la contención y atención necesaria a las quinceañeras y sus familias.</li>
    </ul>

    <h4>Londres, Inglaterra - 3 noches</h4>
    <p><strong>Alojamiento:</strong> Hotel “Royal National” o similar.</p>
    <p><strong>Actividades:</strong></p>
    <ul>
        <li>City Tour por Londres: Palacio de Westminster, Big Ben, Palacio de Buckingham, Abadía de Westminster, Trafalgar Square, St. James's Park, London Bridge, Tower Bridge, Piccadilly Circus, Hyde Park.</li>
        <li>Visita a “Warner Bros Studio Tour London - The Making of Harry Potter”.</li>
        <li>Visita a centros comerciales de primeras marcas: “Harrods”, “Lillywhites”, “Oxford Street” y “Covent Garden” entre otros.</li>
    </ul>

    <h4>París, Francia - 3 noches</h4>
    <p><strong>Alojamiento:</strong> Hotel “Campanile Val de France”, “Dream Castle” o similar.</p>
    <p><strong>Actividades:</strong></p>
    <ul>
        <li>City Tour por París: Visita y ascenso a la Torre Eiffel, Río Sena, Museo del Louvre, Arco del Triunfo.</li>
        <li>Admisiones a parques temáticos: Disneyland Park, Walt Disney Studios Park.</li>
        <li>Utilización de beneficios: Early Park Entry y Disneyland App.</li>
        <li>Visita a Disney Village: Radio Disney On Line, Disney Emporium, Disney Fashion, LEGO Store, World of Disney, The Disney Gallery.</li>
    </ul>

    <h4>Madrid, España - 3 noches</h4>
    <p><strong>Alojamiento:</strong> Hotel “Ayre Colon Palladium” o “Sterling Gran Vía” o similar.</p>
    <p><strong>Actividades:</strong></p>
    <ul>
        <li>Admisión a parque temático: Parque Warner.</li>
        <li>Visita a tiendas de primeras marcas: “Primark”, “H&M”, “Foot Locker”, “Decathlon”, “Apple Store”.</li>
        <li>City Tour por Madrid: Puerta del Sol, Plaza Mayor, Palacio Real, Gran Vía, Palacio de Cibeles, Parque del Retiro, Templo de Debod, Catedral de Almudena, Puerta del Alcalá, Mercado de San Miguel.</li>
    </ul>

    <h4>Barcelona, España - 3 noches</h4>
    <p><strong>Alojamiento:</strong> En complejo “Port Aventura”, “Caribe Gold River”, “El Paso” o similar.</p>
    <p><strong>Actividades:</strong></p>
    <ul>
        <li>Admisiones a parques temáticos: Port Aventura Park, Ferrari Land.</li>
        <li>Visita a la Playa de Salou.</li>
        <li>City Tour por Barcelona: Plaza España y Montjuic, Rambla y playa de la Barceloneta, Sagrada Familia, Casa Batlló, Casa Milà.</li>
        <li>Almuerzo en restaurante en Plaza “Las Arenas”.</li>
    </ul>

    <h4>Servicios generales:</h4>
    <ul>
        <li>Reuniones pre-viaje: jornadas de integración e información, tanto para las quinceañeras como para los padres.</li>
        <li>Set de viaje: remeras, mochila, campera, piloto impermeable, marbetes, botella recargable, identificación personal de seguridad, porta documentos.</li>
        <li>Seguimiento diario del viaje: con fotos, videos y descripción diaria de las actividades de las pasajeras. A través de nuestra web: www.enjoy15.com.ar.</li>
        <li>Asesoramiento: Incluye la revisión y verificación de la documentación migratoria.</li>
    </ul>

    <h4>Precios:</h4>
    <ul>
        <li>U$D 6,020 + Impuestos USD 1,300</li>
    </ul>

    <p>Los siguientes valores incluyen: DNT, IVA, Tasas aeroportuarias, Impuestos hoteleros, Propinas y Maleteros.</p>
    <p>En caso de abonar en pesos, los siguientes impuestos y/o percepciones correspondientes a servicios aéreos y terrestres no están incluidos en el precio anteriormente mencionado: "Impuesto País" y "RG AFIP 5463".</p>
    <p>El cobro y cálculo de dichos impuestos sobre los servicios terrestres corresponde a la agencia minorista. Respecto de los impuestos sobre los servicios aéreos, su valor exacto se confirmará, liquidará y cobrará al momento de la emisión de los tickets aéreos (90 días previos a la salida aproximadamente).</p>
</div>
    </div>
    </div>
    <div class="row">
    <div class="col p-2 m-1 border conten-form-disney rounded">
    <h3 class="form-title text-center mb-4">Formulario de contacto</h3> <!-- Título del formulario -->
    <form action="{{ route('formDisneyEuropa')}}" method="post">
        @csrf
        @php
            $promotor_ventas = request()->cookie('promotor_ventas', '');
        @endphp
        <input type="hidden" name="promotor_ventas" value="{{ $promotor_ventas }}">
        
        <div class="form-floating my-2">
            <input type="email" class="form-control" placeholder="Danos tu mejor email" name="email" required>
            <label for="email" class="form-label">¿Nos darías tu mejor email?</label>
        </div>
        
        <div class="mb-3 form-floating mt-3">
            <input type="text" name="name" placeholder="Mi Nombre" class="form-control" required>
            <label for="name" class="form-label">¿Cuál es tu Nombre?</label>                                            
        </div>
        
        <div class="mb-3 form-floating my-2">
            <select name="disney" class="form-select" aria-label="Default select example">   
               <option value="EuroDisney">EuroDisney</option> 
               <option value="Disney USA">Disney USA</option>
            </select>     
            <label for="disney" class="form-label">¿A dónde te gustaría viajar?</label>                      
        </div>   

        <div class="mb-3 form-floating my-2">
            <select name="fecha" class="form-select" aria-label="Default select example">   
                <option value="2025">2025</option>
                <option value="2026">2026</option>
                <option value="2027">2027</option>                               
            </select>     
            <label for="fecha" class="form-label">¿En que año viajarias (2025-2026-2027)?</label>                      
        </div>  
        
        <div class="mb-3 form-floating my-2">
            <select name="contacto" class="form-select" aria-label="Default select example">   
                <option value="Whatsapp">Por WhatsApp</option>
                <option value="email">Por Email</option>  
                <option value="telefono">Por Teléfono</option>                              
            </select>     
            <label for="contacto" class="form-label">¿Cómo te podemos contactar?</label>                      
        </div>   
        
        <div class="mb-3 form-floating">
            <input type="text" name="movil" placeholder="Número móvil" class="form-control" onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required>
            <label for="movil" class="form-label">Número Móvil (EJ: 011xxxx)</label>                                            
        </div>      
        
        <div class="mb-3 form-floating">
            <input type="text" name="comentario" placeholder="¿Algún comentario?" class="form-control">
            <label for="comentario" class="form-label">¿Algún comentario?</label>                                            
        </div>                                   
        
        <button type="submit" class="btn btn-light form-control">ENVIAR</button>
    </form>
</div>
</div>  
</div>
@endsection
