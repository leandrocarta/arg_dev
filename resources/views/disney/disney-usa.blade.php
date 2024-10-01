@extends('layouts.app-master')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-12 text-center">
            <h1>¡Viaja a Disney USA con Enjoy 15!</h1>
            <p>Vive una experiencia única en Disney USA con nuestras increíbles ofertas y servicios.</p>
        </div>
    </div>

    <!-- Video de YouTube -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="ratio ratio-16x9">
                <iframe src="https://youtu.be/8LXv25HmC3E" title="YouTube video" allowfullscreen></iframe>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-12 text-center">
            <h2>Nuestros Programas de Disney USA 2025 - 2026 - 2027</h2>
            <p>Selecciona uno de los programas para conocer más detalles</p>
        </div>
    </div>
    <div class="row text-center mt-5 justify-content-center">
        <div class="col-md-3">
            <button class="btn program-btn" data-bs-toggle="collapse" data-bs-target="#collapseWeek" aria-expanded="false" aria-controls="collapseWeek">USA - Week</button>
        </div>
        <div class="col-md-3">
            <button class="btn program-btn" data-bs-toggle="collapse" data-bs-target="#collapseClassic" aria-expanded="false" aria-controls="collapseClassic">USA - Classic</button>
        </div>
        <div class="col-md-3">
            <button class="btn program-btn" data-bs-toggle="collapse" data-bs-target="#collapsePremium" aria-expanded="false" aria-controls="collapsePremium">USA - Premium</button>
        </div>
        <div class="col-md-3">
            <button class="btn program-btn" data-bs-toggle="collapse" data-bs-target="#collapseVip" aria-expanded="false" aria-controls="collapseVip">USA - VIP</button>
        </div>
    </div>

    <!-- Contenido Collapse -->
    <div class="collapse-container mt-3">
        <div class="collapse" id="collapseWeek">
      <div class="card card-body">
    <h3>USA - Week</h3>
    <p><strong>Salidas programadas:</strong></p>
    <ul>
        <li>ENERO / FEBRERO</li>
        <li>JUNIO / JULIO</li>
    </ul>

    <p><strong>Nuestros servicios incluyen:</strong></p>
    <ul>
        <li>Salidas desde principales ciudades: Córdoba, Buenos Aires y Rosario, brindando opciones accesibles para nuestras pasajeras desde distintos puntos del país.</li>
        <li>Transporte aéreo: Ofrecemos vuelos en aerolíneas de primer nivel con servicio a bordo continuo y sistema digital de entretenimiento, garantizando un viaje seguro y cómodo.</li>
        <li>Traslados receptivos: Aeropuerto - Orlando - Miami - Aeropuerto en bus privado con pantallas de DVD y musicalización “Enjoy15 Playlist” (Spotify y YouTube Music).</li>
        <li>Régimen de comidas: Nuestro plan ofrece pensión completa con merienda incluida, asegurando una experiencia gastronómica de excelencia durante todo el viaje.</li>
        <li>Asistencia médica: A cargo de Assist-Card, reconocida por proporcionar la mejor asistencia médica, legal y odontológica con la más amplia cobertura a nivel internacional.</li>
        <li>Coordinación permanente: Compuesta por un/a coordinador/a cada 15 quinceañeras, quienes las acompañan desde la mañana hasta la noche en cada una de las actividades, brindando atención personalizada en todo momento.</li>
        <li>Coordinación general: Integrada por gerentes, personal operativo, coordinadores médicos, directivos, operadores locales, guías receptivos y un staff de recreación, quienes complementan a la coordinación permanente para reforzar los pilares fundamentales del viaje: diversión, contención y seguridad.</li>
    </ul>

    <h4>Orlando, Florida - 8 días y 7 noches</h4>
    <p><strong>Alojamiento:</strong> Walt Disney World Resort (Disney’s All Star Movies, Music, Sports o Pop Century) con pensión completa y servicio de bebidas ilimitadas "Free Refill".</p>
    <p><strong>Actividades:</strong></p>
    <ul>
        <li>Parques temáticos Disney: Magic Kingdom, Epcot, Hollywood Studios, Animal Kingdom.</li>
        <li>Parques temáticos Universal: Universal Studios, Islands of Adventure, "Hogwarts Express".</li>
        <li>Disney Springs: Tiendas y restaurantes como Rainforest Café, T-Rex, LEGO Store, Coca-Cola Store, y World of Disney.</li>
        <li>Visita a Premium Outlets: Tiendas de marcas como GAP, Nike, Tommy Hilfiger, Adidas, y más.</li>
        <li>Cena de blanco en Planet Hollywood.</li>
        <li>Transportación ilimitada en bus, monorriel y Skyliner "Disney Transportation".</li>
        <li>Beneficios: Extra Magic Hours y Disney App.</li>
    </ul>

    <h4>Servicios generales:</h4>
    <ul>
        <li>Reuniones pre-viaje: Jornadas de integración e información para las quinceañeras y sus padres.</li>
        <li>Set de viaje: Remeras, mochila, campera, piloto impermeable, botella recargable y porta documentos.</li>
        <li>Seguimiento diario del viaje: Fotos, videos y descripción diaria en la web oficial: www.enjoy15.com.ar.</li>
        <li>Asesoramiento: Revisión y verificación de la documentación migratoria.</li>
        <li>Trámite VISA/ESTA: Organización grupal o asesoramiento individual para el trámite digital.</li>
    </ul>

    <h4>Precios temporada 2025/2026:</h4>
    <ul>
        <li>U$D 3,790 + Impuestos USD 1,245</li>
    </ul>
    <h4>Preventa temporada 2027:</h4>
    <ul>
        <li>U$D 3,910 + Impuestos USD 1,245</li>
    </ul>

    <p>Los siguientes valores incluyen: DNT / IVA / Tasas aeroportuarias / Impuestos hoteleros / Propinas / Maleteros.</p>
    <p>En caso de abonar en pesos, los siguientes impuestos y/o percepciones correspondientes a servicios aéreos y terrestres no están incluidos en el precio anteriormente mencionado: "Impuesto País" y "RG AFIP 5463".</p>
    <p>El cobro y cálculo de dichos impuestos sobre los servicios terrestres corresponde a la agencia minorista. Respecto de los impuestos sobre los servicios aéreos, su valor exacto se confirmará, liquidará y cobrará al momento de la emisión de los tickets aéreos (90 días previos a la salida aproximadamente).</p>
</div>
        </div>
        <div class="collapse" id="collapseClassic">
           <div class="card card-body">
    <h3>USA - Classic</h3>
    
    <p><strong>Salidas programadas:</strong> ENE-FEB / JUN-JUL</p>

    <p><strong>Nuestros servicios incluyen:</strong></p>
    <ul>
        <li>Salidas desde principales ciudades: Córdoba, Buenos Aires y Rosario, brindando opciones accesibles para nuestras pasajeras desde distintos puntos del país.</li>
        <li>Transporte aéreo: vuelos en aerolíneas de primer nivel con servicio a bordo continuo y sistema digital de entretenimiento.</li>
        <li>Traslados receptivos: Aeropuerto - Orlando - Miami - Aeropuerto en bus privado con pantallas de DVD y musicalización "Enjoy15 Playlist" (Spotify y YouTube Music).</li>
        <li>Pensión completa: desayuno, almuerzo, merienda y cena. Incluye bebidas ilimitadas con el servicio "Disney Mug".</li>
        <li>Asistencia médica a cargo de Assist-Card, brindando cobertura médica, legal y odontológica a nivel internacional.</li>
        <li>Coordinación permanente: un/a coordinador/a por cada 15 quinceañeras, brindando atención personalizada en cada actividad, desde los parques temáticos hasta cualquier otro destino del itinerario.</li>
        <li>Coordinación general: Integrada por gerentes, personal operativo, coordinadores médicos, directivos, guías receptivos y un staff de recreación, para asegurar diversión, contención y seguridad en todo momento.</li>
    </ul>

    <h4>Orlando, Florida - 10 días y 9 noches</h4>
    <p><strong>Alojamiento:</strong> Walt Disney World Resort (Disney’s All Star Movies, Music, Sports o Pop Century) con pensión completa (desayuno, almuerzo, merienda y cena). Incluye el servicio "Disney Mug" con sistema "Free Refill" de bebidas en forma permanente.</p>
    <p><strong>Actividades:</strong></p>
    <ul>
        <li>Parques temáticos: Magic Kingdom, Epcot, Hollywood Studios, Animal Kingdom.</li>
        <li>Parques acuáticos: Blizzard Beach, Typhoon Lagoon.</li>
        <li>Parques temáticos Universal: Universal Studios, Islands of Adventure, "Hogwarts Express".</li>
        <li>Disney Springs: Disney Marketplace, Rainforest Café, T-Rex, LEGO Store, Coca Cola Store, World of Disney, NBA Experience, M&M Store.</li>
        <li>Fiesta de Gala con DJ en vivo, torta de cumpleaños y un encuentro muy especial con Mickey, Minnie y sus amigos para fotos y autógrafos.</li>
        <li>Cena de blanco en Planet Hollywood.</li>
        <li>Transportación ilimitada en bus, monorriel y Skyliner "Disney Transportation".</li>
        <li>Beneficios: Extra Magic Hours (solo para huéspedes de Disney) y uso de la Disney App.</li>
    </ul>

    <h4>Servicios generales:</h4>
    <ul>
        <li>Reuniones pre-viaje: jornadas de integración e información, tanto para las quinceañeras como para los padres.</li>
        <li>Set de viaje: remeras, mochila, campera, piloto impermeable, marbetes, botella recargable, identificación personal de seguridad y porta documentos.</li>
        <li>Seguimiento diario del viaje: fotos, videos y descripción diaria de las actividades de las pasajeras a través de la web www.enjoy15.com.ar.</li>
        <li>Asesoramiento: incluye la revisión y verificación de la documentación migratoria.</li>
        <li>VISA/ESTA: organización del trámite en forma grupal o asesoramiento individual del trámite digital.</li>
    </ul>

    <h4>Miami Beach, Florida - 3 días y 2 noches</h4>
    <p><strong>Alojamiento:</strong> Hotel “Riu Florida Beach”, “Holiday Inn” o “Miami Beach Resort & Spa” frente al mar, con pensión completa.</p>
    <p><strong>Actividades:</strong></p>
    <ul>
        <li>City Tour: Ocean Drive, Design District, Wynwood Walls y Bayside Shopping.</li>
        <li>Cena en salón privado en Hard Rock Café.</li>
        <li>Noche de los Colores: cada grupo se viste de su color, ¡son los protagonistas!</li>
        <li>Fiesta de despedida la última noche, en un salón frente al mar, de gala, para despedir un viaje increíble.</li>
    </ul>

    <p>En la salida de febrero se incluye un solo parque acuático de Walt Disney World.</p>

    <h4>Precios temporada 2025/2026:</h4>
    <ul>
        <li>U$D 5,240 + Impuestos USD 1,280</li>
    </ul>

    <h4>Preventa temporada 2027:</h4>
    <ul>
        <li>U$D 5,360 + Impuestos USD 1,280</li>
    </ul>

    <p>Los siguientes valores incluyen: DNT, IVA, tasas aeroportuarias, impuestos hoteleros, propinas y maleteros.</p>
    <p>En caso de abonar en pesos, los siguientes impuestos y/o percepciones correspondientes a servicios aéreos y terrestres no están incluidos en el precio anteriormente mencionado: "Impuesto País" y "RG AFIP 5463".</p>
    <p>El cobro y cálculo de dichos impuestos sobre los servicios terrestres corresponde a la agencia minorista. Respecto de los impuestos sobre los servicios aéreos, su valor exacto se confirmará, liquidará y cobrará al momento de la emisión de los tickets aéreos (90 días previos a la salida aproximadamente).</p>

    <hr>
    <h3>USA - Classic</h3>    
    <p><strong>Salidas programadas:</strong> DICIEMBRE</p>
    <p><strong>Nuestros servicios incluyen:</strong></p>
    <ul>
        <li>Salidas desde principales ciudades: Córdoba, Buenos Aires y Rosario, brindando opciones accesibles para nuestras pasajeras desde distintos puntos del país.</li>
        <li>Transporte aéreo: vuelos en aerolíneas de primer nivel con servicio a bordo continuo y sistema digital de entretenimiento, garantizando un viaje seguro y cómodo.</li>
        <li>Traslados receptivos: Aeropuerto - Orlando - Miami - Aeropuerto en bus privado con pantallas de DVD y musicalización "Enjoy15 Playlist" (Spotify y YouTube Music).</li>
        <li>Pensión completa: desayuno, almuerzo, merienda y cena. Incluye bebidas ilimitadas con el servicio "Disney Mug".</li>
        <li>Asistencia médica a cargo de Assist-Card, brindando cobertura médica, legal y odontológica a nivel internacional.</li>
        <li>Coordinación permanente: un/a coordinador/a por cada 15 quinceañeras, brindando atención personalizada en cada actividad, desde los parques temáticos hasta cualquier otro destino del itinerario.</li>
        <li>Coordinación general: Integrada por gerentes, personal operativo, coordinadores médicos, directivos, guías receptivos y un staff de recreación, para asegurar diversión, contención y seguridad en todo momento.</li>
    </ul>

    <h4>Orlando, Florida - 10 días y 9 noches</h4>
    <p><strong>Alojamiento:</strong> Walt Disney World Resort (Disney’s All Star Movies, Music, Sports o Pop Century) con pensión completa (desayuno, almuerzo, merienda y cena). Incluye el servicio "Disney Mug" con sistema "Free Refill" de bebidas en forma permanente.</p>
    <p><strong>Actividades:</strong></p>
    <ul>
        <li>Parques temáticos: Magic Kingdom, Epcot, Hollywood Studios, Animal Kingdom.</li>
        <li>Parques acuáticos: Blizzard Beach, Typhoon Lagoon.</li>
        <li>Parques temáticos Universal: Universal Studios, Islands of Adventure, "Hogwarts Express".</li>
        <li>Disney Springs: Disney Marketplace, Rainforest Café, T-Rex, LEGO Store, Coca Cola Store, World of Disney, NBA Experience, M&M Store.</li>
        <li>Evento con los personajes: una experiencia única con Mickey, Minnie y sus amigos, ideal para disfrutar de fotos, autógrafos y momentos inolvidables.</li>
        <li>Cena de blanco en Planet Hollywood.</li>
        <li>Transportación ilimitada en bus, monorriel y Skyliner "Disney Transportation".</li>
        <li>Beneficios: Extra Magic Hours (solo para huéspedes de Disney) y uso de la Disney App.</li>
    </ul>

    <h4>Servicios generales:</h4>
    <ul>
        <li>Reuniones pre-viaje: jornadas de integración e información, tanto para las quinceañeras como para los padres.</li>
        <li>Set de viaje: remeras, mochila, campera, piloto impermeable, marbetes, botella recargable, identificación personal de seguridad y porta documentos.</li>
        <li>Seguimiento diario del viaje: fotos, videos y descripción diaria de las actividades de las pasajeras a través de la web www.enjoy15.com.ar.</li>
        <li>Asesoramiento: incluye la revisión y verificación de la documentación migratoria.</li>
        <li>VISA/ESTA: organización del trámite en forma grupal o asesoramiento individual del trámite digital.</li>
    </ul>

    <h4>Miami Beach, Florida - 3 días y 2 noches</h4>
    <p><strong>Alojamiento:</strong> Hotel “Riu Florida Beach”, “Holiday Inn” o “Miami Beach Resort & Spa” frente al mar, con pensión completa.</p>
    <p><strong>Actividades:</strong></p>
    <ul>
        <li>City Tour: Ocean Drive, Design District, Wynwood Walls y Bayside Shopping.</li>
        <li>Cena en salón privado en Hard Rock Café.</li>
        <li>Noche de los Colores: cada grupo se viste de su color, ¡son los protagonistas!</li>
        <li>Cena de despedida: la última noche, un encuentro especial para cerrar un viaje increíble de manera tradicional y memorable.</li>
    </ul>

    <p>En la salida de febrero se incluye un solo parque acuático de Walt Disney World.</p>

    <h4>Precios temporada 2025/2026:</h4>
    <ul>
        <li>U$D 5,240 + Impuestos USD 1,280</li>
    </ul>

    <h4>Preventa temporada 2027:</h4>
    <ul>
        <li>U$D 5,360 + Impuestos USD 1,280</li>
    </ul>

    <p>Los siguientes valores incluyen: DNT, IVA, tasas aeroportuarias, impuestos hoteleros, propinas y maleteros.</p>
    <p>En caso de abonar en pesos, los siguientes impuestos y/o percepciones correspondientes a servicios aéreos y terrestres no están incluidos en el precio anteriormente mencionado: "Impuesto País" y "RG AFIP 5463".</p>
    <p>El cobro y cálculo de dichos impuestos sobre los servicios terrestres corresponde a la agencia minorista. Respecto de los impuestos sobre los servicios aéreos, su valor exacto se confirmará, liquidará y cobrará al momento de la emisión de los tickets aéreos (90 días previos a la salida aproximadamente).</p>
</div>
        </div>
        <div class="collapse" id="collapsePremium">
            
<div class="card card-body">
    <h3>USA - Premium</h3>
    
    <p><strong>Salidas programadas:</strong> ENE/FEB 2025 Y 2026 - JUN/JUL 2025</p>

    <p><strong>Nuestros servicios incluyen:</strong></p>
    <ul>
        <li>Salidas desde principales ciudades: Córdoba, Buenos Aires y Rosario, brindando opciones accesibles para nuestras pasajeras desde distintos puntos del país.</li>
        <li>Transporte aéreo: vuelos en aerolíneas de primer nivel con servicio a bordo continuo y sistema digital de entretenimiento, garantizando un viaje seguro y cómodo.</li>
        <li>Traslados receptivos: Aeropuerto - Orlando - Miami - Aeropuerto en bus privado con pantallas de DVD y musicalización "Enjoy15 Playlist" (Spotify y YouTube Music).</li>
        <li>Pensión completa: desayuno, almuerzo, merienda y cena. Incluye bebidas ilimitadas con el servicio "Disney Mug".</li>
        <li>Asistencia médica a cargo de Assist-Card, brindando cobertura médica, legal y odontológica a nivel internacional.</li>
        <li>Coordinación permanente: un/a coordinador/a por cada 15 quinceañeras, brindando atención personalizada en cada actividad, desde los parques temáticos hasta cualquier otro destino del itinerario.</li>
        <li>Coordinación general: Integrada por gerentes, personal operativo, coordinadores médicos, directivos, guías receptivos y un staff de recreación, para asegurar diversión, contención y seguridad en todo momento.</li>
    </ul>

    <h4>Orlando, Florida - 13 días y 12 noches</h4>
    <p><strong>Alojamiento:</strong> Walt Disney World Resort (Disney’s All Star Movies, Music, Sports o Pop Century) con pensión completa (desayuno, almuerzo, merienda y cena). Incluye el servicio "Disney Mug" con sistema "Free Refill" de bebidas en forma permanente.</p>
    <p><strong>Actividades:</strong></p>
    <ul>
        <li>Parques "Walt Disney World": Magic Kingdom, Epcot, Hollywood Studios, Animal Kingdom.</li>
        <li>Parques acuáticos: Blizzard Beach, Typhoon Lagoon.</li>
        <li>Parques "Universal Studios": Universal Studios, Island of Adventure. Incluye: "Hogwarts Express".</li>
        <li>Disney Springs: Disney Marketplace, Rainforest Café, T-Rex, LEGO Store, Coca Cola Store, World of Disney, NBA Experience, M&M Store.</li>
        <li>Fiesta de Gala con DJ en vivo, torta de cumpleaños y un encuentro muy especial con Mickey, Minnie y sus amigos para fotos y autógrafos.</li>
        <li>Fiesta de disfraces en salón privado con diversas temáticas.</li>
        <li>Cena de blanco en Planet Hollywood.</li>
        <li>Transportación ilimitada en bus, monorriel y Skyliner "Disney Transportation".</li>
    </ul>
    <h4>Miami Beach, Florida - 3 días y 2 noches</h4>
    <p><strong>Alojamiento:</strong> Hotel “Riu Florida Beach”, “Holiday Inn” o “Miami Beach Resort & Spa” frente al mar, con pensión completa.</p>
    <p><strong>Actividades:</strong></p>
    <ul>
        <li>City Tour: Ocean Drive, Design District, Wynwood Walls y Bayside Shopping.</li>
        <li>Cena en salón privado en Hard Rock Café.</li>
        <li>Noche de los Colores: cada grupo se viste de su color, ¡son los protagonistas!</li>
        <li>Fiesta de despedida la última noche en un salón frente al mar, de gala, para despedir un viaje increíble.</li>
    </ul>

    <h4>Precios temporada 2025/2026:</h4>
    <ul>
        <li>U$D 5,930 + Impuestos USD 1,300</li>
    </ul>

    <p>En la salida de febrero se incluye un solo parque acuático de Walt Disney World.</p>

    <h4>Preventa temporada 2027:</h4>
    <ul>
        <li>U$D 6,050 + Impuestos USD 1,300</li>
    </ul>

    <p>Los siguientes valores incluyen: DNT, IVA, tasas aeroportuarias, impuestos hoteleros, propinas y maleteros.</p>
    <p>En caso de abonar en pesos, los siguientes impuestos y/o percepciones correspondientes a servicios aéreos y terrestres no están incluidos en el precio anteriormente mencionado: "Impuesto País" y "RG AFIP 5463".</p>
    <p>El cobro y cálculo de dichos impuestos sobre los servicios terrestres corresponde a la agencia minorista. Respecto de los impuestos sobre los servicios aéreos, su valor exacto se confirmará, liquidará y cobrará al momento de la emisión de los tickets aéreos (90 días previos a la salida aproximadamente).</p>
<hr>

    <h3>USA - Premium</h3>
    
    <p><strong>Salidas programadas:</strong> JUN-JUL 2026 | ENE-FEB Y JUN-JUL 2027</p>

    <p><strong>Nuestros servicios incluyen:</strong></p>
    <ul>
        <li>Salidas desde principales ciudades: Córdoba, Buenos Aires y Rosario, brindando opciones accesibles para nuestras pasajeras desde distintos puntos del país.</li>
        <li>Transporte aéreo: vuelos en aerolíneas de primer nivel con servicio a bordo continuo y sistema digital de entretenimiento, garantizando un viaje seguro y cómodo.</li>
        <li>Traslados receptivos: Aeropuerto - Orlando - Miami - Aeropuerto en bus privado con pantallas de DVD y musicalización "Enjoy15 Playlist" (Spotify y YouTube Music).</li>
        <li>Pensión completa: desayuno, almuerzo, merienda y cena. Incluye bebidas ilimitadas con el servicio "Disney Mug".</li>
        <li>Asistencia médica a cargo de Assist-Card, brindando cobertura médica, legal y odontológica a nivel internacional.</li>
        <li>Coordinación permanente: un/a coordinador/a por cada 15 quinceañeras, brindando atención personalizada en cada actividad, desde los parques temáticos hasta cualquier otro destino del itinerario.</li>
        <li>Coordinación general: Integrada por gerentes, personal operativo, coordinadores médicos, directivos, guías receptivos y un staff de recreación, para asegurar diversión, contención y seguridad en todo momento.</li>
    </ul>

    <h4>Orlando, Florida - 13 días y 12 noches</h4>
    <p><strong>Alojamiento:</strong> Walt Disney World Resort (Disney’s All Star Movies, Music, Sports o Pop Century) con pensión completa (desayuno, almuerzo, merienda y cena). Incluye el servicio "Disney Mug" con sistema "Free Refill" de bebidas en forma permanente.</p>
    <p><strong>Actividades:</strong></p>
    <ul>
        <li>Parques temáticos: Magic Kingdom, Epcot, Hollywood Studios, Animal Kingdom.</li>
        <li>Parques acuáticos: Blizzard Beach, Typhoon Lagoon.</li>
        <li>Disney Springs: Disney Marketplace, Rainforest Café, T-Rex, LEGO Store, Coca Cola Store, World of Disney, NBA Experience, M&M Store.</li>
        <li>Fiesta de Gala con DJ en vivo, torta de cumpleaños y un encuentro muy especial con Mickey, Minnie y sus amigos para fotos y autógrafos.</li>
        <li>Cena de blanco en Planet Hollywood.</li>
        <li>Transportación ilimitada en bus, monorriel y Skyliner "Disney Transportation".</li>
        <li>Beneficios: Extra Magic Hours (solo para huéspedes de Disney) y uso de la Disney App.</li>
    </ul>

    <h4>Universal Studios - 5 noches</h4>
    <p><strong>Alojamiento:</strong> Universal Studios Resort (Universal’s Endless Summer Surfside Inn & Dockside Inn / Aventura / Cabana Bay / Terra Luna / Stella Nova) con pensión completa (desayuno, almuerzo, merienda y cena). Incluye servicio "Universal Mug" con sistema "Free Refill" de bebidas en forma permanente.</p>
    <p><strong>Actividades:</strong></p>
    <ul>
        <li>Parques temáticos: Universal Studios, Island of Adventure. Incluye: "Hogwarts Express".</li>
        <li>Visita al nuevo parque Universal Epic Universe.</li>
        <li>Parque acuático: Volcano Bay.</li>
        <li>Transportación ilimitada: "Universal Transportation" dentro del complejo.</li>
        <li>Fiesta de disfraces en salón privado con diversas temáticas.</li>
        <li>Visita a Sea World Park & Entertainment Inc con admisiones a Discovery Cove o Aquatica y traslado en bus ejecutivo exclusivo para el grupo.</li>
        <li>Traslado y visita a Premium Outlets: Shopping de mega marcas (GAP, Nike, Tommy Hilfiger, Adidas, Reebok, Vans, Converse, Forever 21, Aeropostale, H&M, Victoria's Secret, entre otras).</li>
        <li>Traslado y visita a Mega-Store de perfumes, cosméticos y productos electrónicos.</li>
        <li>Almuerzo o cena en Hard Rock Cafe Orlando.</li>
        <li>Beneficios: Early Park Entry (solo para huéspedes de Universal) y uso de la Universal App.</li>
    </ul>

    <h4>Miami Beach, Florida - 3 días y 2 noches</h4>
    <p><strong>Alojamiento:</strong> Hotel “Riu Florida Beach”, “Holiday Inn” o “Miami Beach Resort & Spa” frente al mar, con pensión completa.</p>
    <p><strong>Actividades:</strong></p>
    <ul>
        <li>City Tour por las principales playas: Ocean Drive, Design District, Wynwood Walls y Bayside Shopping.</li>
        <li>Cena en salón privado en Hard Rock Café.</li>
        <li>Noche de los Colores: cada grupo se viste de su color, ¡son los protagonistas!</li>
        <li>Fiesta de despedida la última noche en un salón frente al mar, de gala, para despedir un viaje increíble.</li>
    </ul>

    <h4>Servicios generales:</h4>
    <ul>
        <li>Reuniones pre-viaje: jornadas de integración e información, tanto para las quinceañeras como para los padres.</li>
        <li>Set de viaje: remeras, mochila, campera, piloto impermeable, marbetes, botella recargable, identificación personal de seguridad, porta documentos.</li>
        <li>Seguimiento diario del viaje: con fotos, video y descripción diaria de las actividades de las pasajeras. A través de nuestra web: www.enjoy15.com.ar.</li>
        <li>Asesoramiento: Incluye la revisión y verificación de la documentación migratoria.</li>
        <li>VISA/ESTA: organización del trámite en forma grupal o asesoramiento individual del trámite digital.</li>
    </ul>

    <p>En la salida de febrero se incluye un solo parque acuático de Walt Disney World.</p>

    <h4>Precios temporada 2026:</h4>
    <ul>
        <li>U$D 5,930 + Impuestos U$D 1,300</li>
    </ul>

    <h4>Preventa temporada 2027:</h4>
    <ul>
        <li>U$D 6,050 + Impuestos U$D 1,300</li>
    </ul>

    <p>Los siguientes valores incluyen: DNT, IVA, tasas aeroportuarias, impuestos hoteleros, propinas y maleteros.</p>
    <p>En caso de abonar en pesos, los siguientes impuestos y/o percepciones correspondientes a servicios aéreos y terrestres no están incluidos en el precio anteriormente mencionado: "Impuesto País" y "RG AFIP 5463".</p>
    <p>El cobro y cálculo de dichos impuestos sobre los servicios terrestres corresponde a la agencia minorista. Respecto de los impuestos sobre los servicios aéreos, su valor exacto se confirmará, liquidará y cobrará al momento de la emisión de los tickets aéreos (90 días previos a la salida aproximadamente).</p>
</div>
</div>
        <div class="collapse" id="collapseVip">
           
<div class="card card-body">
    <h3>USA - VIP</h3>

    <p><strong>Salidas programadas:</strong> JUN-JUL 2025</p>

    <p><strong>Nuestros servicios incluyen:</strong></p>
    <ul>
        <li>Salidas desde principales ciudades: Córdoba, Buenos Aires y Rosario, brindando opciones accesibles para nuestras pasajeras desde distintos puntos del país.</li>
        <li>Transporte aéreo: Ofrecemos vuelos en aerolíneas de primer nivel con servicio a bordo continuo y sistema digital de entretenimiento, garantizando un viaje seguro y cómodo.</li>
        <li>Traslados receptivos: Aeropuerto - Orlando - Miami - Aeropuerto en bus privado con pantallas planas de DVD y musicalización “Enjoy15 Playlist” (Spotify y YouTube Music).</li>
        <li>Régimen de comidas: Nuestro plan ofrece pensión completa con merienda incluida, asegurando una experiencia gastronómica de excelencia durante todo el viaje.</li>
        <li>Asistencia médica: A cargo de Assist-Card, reconocida por proporcionar la mejor asistencia médica, legal y odontológica con la más amplia cobertura a nivel internacional.</li>
        <li>Coordinación permanente: Compuesta por un/a coordinador/a cada 15 quinceañeras, quienes las acompañan desde la mañana hasta la noche en cada una de las actividades que realice el grupo, sea en un parque temático o en algún otro complejo que incluya el itinerario, brindándoles una atención personalizada en todo momento.</li>
        <li>Coordinación general: Integrada por gerentes, personal operativo, coordinadores médicos, directivos, operadores locales, guías receptivos y un staff de recreación, quienes complementan a la coordinación permanente para reforzar los pilares fundamentales del viaje: diversión, contención y seguridad. Necesario para la tranquilidad de las quinceañeras y sus familias.</li>
    </ul>

    <h4>Orlando, Florida - 13 días y 12 noches</h4>
    <p><strong>Alojamiento:</strong> Walt Disney World Resort: Disney’s All Star Movies, Music, Sports / Pop Century con pensión completa (desayuno, almuerzo, merienda y cena). Incluye el servicio “Disney Mug” con sistema “Free Refill” de bebidas en forma permanente.</p>
    <p><strong>Actividades:</strong></p>
    <ul>
        <li>Parques temáticos: Magic Kingdom, Epcot, Hollywood Studios, Animal Kingdom, Universal Studios, Island of Adventure. Incluye: “Hogwarts Express”.</li>
        <li>Parques acuáticos: Blizzard Beach, Typhoon Lagoon.</li>
        <li>Disney Springs: Disney Marketplace, Rainforest Café, T-Rex, LEGO Store, Coca Cola Store, World of Disney, NBA Experience, M&M Store.</li>
        <li>Fiesta de Gala con DJ live Argentina, torta de cumpleaños y un encuentro muy especial con Mickey, Minnie y sus amigos para fotos y autógrafos.</li>
        <li>Cena de blanco en Planet Hollywood.</li>
        <li>Transportación ilimitada en bus, monorriel y/o Skyliner “Disney Transportation” / “Universal Transportation” sin cargo y dentro del complejo.</li>
        <li>Fiesta de disfraces en salón privado con diversas temáticas.</li>
        <li>Visita a Sea World Park & Entertainment Inc con admisiones a Discovery Cove o Aquatica y traslado en bus nivel ejecutivo, exclusivo para el grupo, de ida y regreso.</li>
        <li>Traslado y visita a Premium Outlets: Shopping de mega marcas (GAP, Nike, Tommy Hilfiger, Adidas, Reebok, Vans, Converse, Forever 21, Aeropostale, H&M, Victoria's Secret, entre otras).</li>
        <li>Traslado y visita a Mega-Store de perfumes, cosméticos y productos electrónicos.</li>
        <li>Almuerzo o cena en Hard Rock Cafe Orlando.</li>
    </ul>

    <p><strong>Beneficios:</strong></p>
    <ul>
        <li>Extra Magic Hours (solo para huéspedes de Disney) y Disney App.</li>
        <li>Early Park Entry (solo para huéspedes de Universal) y Universal App.</li>
    </ul>

    <h4>Miami Beach, Florida - 3 días y 2 noches</h4>
    <p><strong>Alojamiento:</strong> Hotel “Riu Florida Beach”, “Holiday Inn”, “Miami Beach Resort and Spa” o similar, frente al mar y con pensión completa (desayuno buffet, almuerzo, merienda y cena). Incluye bebidas.</p>
    <p><strong>Actividades:</strong></p>
    <ul>
        <li>City Tour por las principales playas: Ocean Drive, Design District, Wynwood Walls y Bayside Shopping.</li>
        <li>Cena en salón privado de “Hard Rock Café”.</li>
        <li>Noche de los Colores: cada grupo se viste de su color ¡Son protagonistas!</li>
        <li>Fiesta de despedida la última noche en un salón frente al mar. De gala para despedir un viaje increíble y de la mejor manera.</li>
    </ul>

    <h4>Bahamas - 4 días y 3 noches</h4>
    <p><strong>Alojamiento:</strong> Crucero categoría de lujo “Royal Caribbean” con sistema “All Inclusive”.</p>
    <p><strong>Actividades:</strong></p>
    <ul>
        <li>City Tour por “Nassau”, capital de Bahamas.</li>
        <li>Visita y descenso en “Coco Cay”, isla privada de “Royal Caribbean”.</li>
        <li>Actividades recreativas, entretenimiento a bordo y la mayor diversión a cargo del equipo de animación “On Board” de “Royal Caribbean”.</li>
    </ul>

    <h4>Precios</h4>
    <ul>
        <li><strong>Salida 2025:</strong> U$D 6.730 + Impuestos U$D 1.530</li>
    </ul>
    <hr>
    
    <h3>USA - VIP</h3>

    <p><strong>Salidas programadas:</strong> JUN-JUL 2026 | JUN-JUL 2027</p>

    <p><strong>Nuestros servicios incluyen:</strong></p>
    <ul>
        <li>Salidas desde principales ciudades: Córdoba, Buenos Aires y Rosario, brindando opciones accesibles para nuestras pasajeras desde distintos puntos del país.</li>
        <li>Transporte aéreo: Ofrecemos vuelos en aerolíneas de primer nivel con servicio a bordo continuo y sistema digital de entretenimiento, garantizando un viaje seguro y cómodo.</li>
        <li>Traslados receptivos: Aeropuerto - Orlando - Miami - Aeropuerto en bus privado con pantallas planas de DVD y musicalización “Enjoy15 Playlist” (Spotify y YouTube Music).</li>
        <li>Régimen de comidas: Nuestro plan ofrece pensión completa con merienda incluida, asegurando una experiencia gastronómica de excelencia durante todo el viaje.</li>
        <li>Asistencia médica: A cargo de Assist-Card, reconocida por proporcionar la mejor asistencia médica, legal y odontológica con la más amplia cobertura a nivel internacional.</li>
        <li>Coordinación permanente: Compuesta por un/a coordinador/a cada 15 quinceañeras, quienes las acompañan desde la mañana hasta la noche en cada una de las actividades que realice el grupo, brindándoles una atención personalizada en todo momento.</li>
        <li>Coordinación general: Integrada por gerentes, personal operativo, coordinadores médicos, directivos, operadores locales, guías receptivos y un staff de recreación, quienes complementan a la coordinación permanente para reforzar los pilares fundamentales del viaje: diversión, contención y seguridad.</li>
    </ul>

    <h4>Orlando, Florida - 13 días y 12 noches</h4>
    <h5>Walt Disney World - 7 noches</h5>
    <p><strong>Alojamiento:</strong> Walt Disney World Resort: Disney’s All Star Movies, Music, Sports / Pop Century con pensión completa (desayuno, almuerzo, merienda y cena). Incluye el servicio “Disney Mug” con sistema “Free Refill” de bebidas en forma permanente.</p>
    <p><strong>Actividades:</strong></p>
    <ul>
        <li>Parques temáticos: Magic Kingdom, Epcot, Hollywood Studios, Animal Kingdom.</li>
        <li>Parques acuáticos: Blizzard Beach, Typhoon Lagoon.</li>
        <li>Disney Springs: Disney Marketplace, Rainforest Café, T-Rex, LEGO Store, Coca Cola Store, World of Disney, NBA Experience, M&M Store.</li>
        <li>Fiesta de Gala con DJ live Argentina, torta de cumpleaños y un encuentro muy especial con Mickey, Minnie y sus amigos para fotos y autógrafos.</li>
        <li>Cena de blanco en Planet Hollywood.</li>
        <li>Transportación ilimitada en bus, monorriel y Skyliner “Disney Transportation” sin cargo dentro del complejo.</li>
    </ul>

    <h5>Universal Studios - 5 noches</h5>
    <p><strong>Alojamiento:</strong> Universal Studios Resort: Universal’s Endless Summer Surfside Inn & Dockside Inn / Aventura / Cabana Bay / Terra Luna / Stella Nova con pensión completa (desayuno, almuerzo, merienda y cena). Incluye servicio “Universal Mug” con sistema “Free Refill” de bebidas en forma permanente.</p>
    <p><strong>Actividades:</strong></p>
    <ul>
        <li>Parques temáticos: Universal Studios, Island of Adventure. Incluye: “Hogwarts Express”.</li>
        <li>Visita al nuevo parque Universal Epic Universe.</li>
        <li>Parque acuático: Volcano Bay.</li>
        <li>Transportación ilimitada: “Universal Transportation” dentro del complejo.</li>
        <li>Fiesta de disfraces en salón privado con diversas temáticas.</li>
        <li>Visita a Sea World Park & Entertainment Inc con admisiones a Discovery Cove o Aquatica y traslado en bus nivel ejecutivo, exclusivo para el grupo.</li>
        <li>Traslado y visita a Premium Outlets: Shopping de mega marcas (GAP, Nike, Tommy Hilfiger, Adidas, Reebok, Vans, Converse, Forever 21, Aeropostale, H&M, Victoria's Secret, entre otras).</li>
        <li>Traslado y visita a Mega-Store de perfumes, cosméticos y productos electrónicos.</li>
        <li>Almuerzo o cena en Hard Rock Cafe Orlando.</li>
    </ul>

    <p><strong>Beneficios:</strong></p>
    <ul>
        <li>Early Park Entry (solo para huéspedes de Universal) y Universal App.</li>
    </ul>

    <h4>Miami Beach, Florida - 3 días y 2 noches</h4>
    <p><strong>Alojamiento:</strong> Hotel “Riu Florida Beach”, “Holiday Inn”, “Miami Beach Resort and Spa” o similar, frente al mar y con pensión completa (desayuno buffet, almuerzo, merienda y cena). Incluye bebidas.</p>
    <p><strong>Actividades:</strong></p>
    <ul>
        <li>City Tour por las principales playas: Ocean Drive, Design District, Wynwood Walls y Bayside Shopping.</li>
        <li>Cena en salón privado de “Hard Rock Café”.</li>
        <li>Noche de los Colores: cada grupo se viste de su color ¡Son protagonistas!</li>
        <li>Fiesta de despedida la última noche en un salón frente al mar. De gala para despedir un viaje increíble.</li>
    </ul>

    <h4>Bahamas - 4 días y 3 noches</h4>
    <p><strong>Alojamiento:</strong> Crucero categoría de lujo “Royal Caribbean” con sistema “All Inclusive”.</p>
    <p><strong>Actividades:</strong></p>
    <ul>
        <li>City Tour por “Nassau”, capital de Bahamas.</li>
        <li>Visita y descenso en “Coco Cay”, isla privada de “Royal Caribbean”.</li>
        <li>Actividades recreativas, entretenimiento a bordo y la mayor diversión a cargo del equipo de animación “On Board” de “Royal Caribbean”.</li>
    </ul>

    <h4>Servicios generales:</h4>
    <ul>
        <li>Reuniones pre-viaje: jornadas de integración e información, tanto para las quinceañeras como para los padres.</li>
        <li>Set de viaje: remeras, mochila, campera, piloto impermeable, marbetes, botella recargable, identificación personal de seguridad, porta documentos.</li>
        <li>Seguimiento diario del viaje: con fotos, video y descripción diaria de las actividades de las pasajeras. A través de nuestra web: www.enjoy15.com.ar.</li>
        <li>Asesoramiento: incluye la revisión y verificación de la documentación migratoria.</li>
        <li>VISA/ESTA: organización del trámite en forma grupal o asesoramiento individual del trámite digital.</li>
    </ul>

    <h4>Precios:</h4>
    <ul>
        <li><strong>Salida 2026:</strong> U$D 6,730 + Impuestos U$D 1,530</li>
        <li><strong>Pre Venta 2027:</strong> U$D 6,890 + Impuestos U$D 1,530</li>
    </ul>

    <p>1. En la salida de febrero se utiliza un solo parque acuático de Walt Disney World.</p>
    <p>2. Los siguientes valores incluyen: DNT, IVA, Tasas aeroportuarias, Impuestos hoteleros, Propinas y Maleteros.</p>
    <p>3. En caso de abonar en pesos, los siguientes impuestos y/o percepciones correspondientes a servicios aéreos y terrestres no están incluidos en el precio anteriormente mencionado: "Impuesto País" y "RG AFIP 5463".</p>
    <p>El cobro y cálculo de dichos impuestos sobre los servicios terrestres corresponde a la agencia minorista. Respecto de los impuestos sobre los servicios aéreos, su valor exacto se confirmará, liquidará y cobrará al momento de la emisión de los tickets aéreos (90 días previos a la salida aproximadamente).</p>

</div>


        </div>
    </div>
</div>

<!-- Script para controlar los collapses -->
<script>
    document.addEventListener('click', function (event) {
        if (event.target.matches('[data-bs-toggle="collapse"]')) {
            var target = event.target.getAttribute('data-bs-target');
            var collapseElements = document.querySelectorAll('.collapse');

            collapseElements.forEach(function (collapseEl) {
                if (collapseEl.id !== target.substring(1)) {
                    var bsCollapse = new bootstrap.Collapse(collapseEl, {
                        toggle: false
                    });
                    bsCollapse.hide();
                }
            });
        }
    });
</script>
@endsection



