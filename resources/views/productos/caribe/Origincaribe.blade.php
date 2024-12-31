@extends('layouts.app-master')
@section('content')
<div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="5000">
      <img src="{{ asset('assets/img_banner/Caribe-min.png') }}" class="d-block w-100" alt="Caribe">
      <div class="carousel-caption d-none d-md-block">
        <h1></h1>
        <p></p>
      </div>
    </div>
  </div>
</div>
<div class="container my-3 m-auto productos-detalles home-iconos">
     <div class="titulo text-center">
       <h4 class="display-4">Paquetes Imbatibles Comunidad</h4>
       <p class="text-start">Todos nuestros paquetes incluyen (Aéreos con equipaje en Bodega, traslados Privados en destino y seguros hasta usd 300.000) con valores por pasajero en habitación doble.</p>
       <p class="text-start">Consultanos por otros Hoteles o tipo de habitación!!</p>
     </div>
     <div class="row">
       @php
       $productosCaribe = collect($productos)->filter(function ($producto) {
        return $producto->ubicacion === 'Caribe';
        });
        $productosAleatorios = $productosCaribe->shuffle();
       @endphp
        @foreach ($productosAleatorios as $producto)
       @if($producto->tipo_producto !== 'Aéreo')
       <div class="col-md-4 p-2">
        <div class="card productosCrucero">
            <div class="" style="position: relative; overflow: hidden;">
                <div style="padding-top: 100%;"></div>
                @if ($producto->tipo_producto == 'The Club')
                    <div class="barra-horizontal-comunidad">
                      <p class="leyenda">100% - Financiados!!!</p>
                    </div>
                    @endif 
                <img src="{{ asset('assets/img_paquetes/' . $producto->imagen) }}" class="card-img-top img-fluid" alt="{{ $producto->nombre }}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                <div class="card-img-overlay titulo-prod-cruceros">
                    <p>REF: N° {{ $producto->id }} - <i class="fa-solid fa-cloud-moon"></i> {{ $producto->estadia }} Noches</p>
                    <p><i class="fa-regular fa-calendar-days"></i> {{ $producto->fecha_salida }}</p>
                    <h5><i class="fa-solid fa-location-dot me-1"></i> {{ $producto->destinos->ciudad_destino }}</h5> 
                    <p>{{ $producto->titulo }}</p>   
                    <p><i class="fa-solid fa-hotel"></i> {{ $producto->hotel->nombre }} </p>                                 
                     <h3 class="precio_home"><span class="usd">{{ $producto->moneda }} </span> {{ $producto->precio_total }}</h3>
                    </div>
            </div>
            <div class="w-100 btn-crucero">
                <a href="{{ route('producto.detalles', $producto->id) }}" class="btn btn-primary w-100">VER MÁS</a>
            </div>
        </div>
       </div>
       @endif
     @endforeach
    </div>   
  </div> 
<div class="container my-3 m-auto productos-detalles home-iconos">
    <!-- Título principal -->
    <div class="titulo text-center">
        <h4 class="display-4">Busca Otros Paquetes al Caribe</h4>
    </div>
    <!-- Contenedor del formulario con estilo de recuadro -->
  @php
    $destinosCaribeArray = json_decode($destinosCaribe, true);
  @endphp

  <div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="p-4 mb-5" style="border: 2px solid #007bff; border-radius: 10px; background-color: #f8f9fa;">
            <h5 class="text-center mb-4" style="color: #007bff;">Encuentra tu Destino Perfecto</h5>
            <form action="{{ route('paquetes.caribe') }}#resultado" method="GET" id="caribeForm">
                <div class="row">
                    <!-- Campo País -->
                    <div class="col-md-6 mb-3">
                        <label for="pais" class="form-label">Selecciona un país:</label>
                        <select name="pais" id="pais" class="form-control" onchange="actualizarDestinos()">
                            <option value="">-- Selecciona un país --</option>
                            @foreach ($destinosCaribeArray as $codigoPais => $pais)
                                <option value="{{ $codigoPais }}">{{ $pais['nombre_pais'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Campo Destino -->
                    <div class="col-md-6 mb-3">
                        <label for="destino" class="form-label">Selecciona un destino:</label>
                        <select name="destino" id="destino" class="form-control">
                            <option value="">-- Selecciona un destino --</option>
                        </select>
                    </div>

                    <!-- Campo Fecha de inicio y fin -->
                    <div class="col-md-6 mb-3">
                        <label for="fecha_inicio" class="form-label">Fecha de inicio:</label>
                        <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" min="{{ date('Y-m-d') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="fecha_fin" class="form-label">Fecha de fin:</label>
                        <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" min="{{ date('Y-m-d') }}">
                    </div>

                    <!-- Botón de búsqueda -->
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary mt-3 px-4">Buscar Paquetes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>
<div class="container my-3 m-auto productos-detalles home-iconos" id="resultado">
    <div class="titulo text-center">
        <h4 class="display-4"></h4>
    </div>
    <div class="row">
        @foreach ($paquetes as $index => $paquete)
            <div class="col-md-3 p-2">
                <div class="card productosCrucero">
                    <div style="position: relative; overflow: hidden;">
                        <div style="padding-top: 100%;"></div>
                        <img src="{{ $paquete['imagenes'][0] ?? 'ruta/a/imagen/default.jpg' }}" class="card-img-top img-fluid" alt="{{ $paquete['titulo'] }}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">                        
                        <div class="card-img-overlay titulo-prod-cruceros">
                            <p><i class="fa-regular fa-calendar-days"></i> {{ $paquete['fecha_salida'] ?? 'Fecha no disponible' }}</p>
                            <h5><i class="fa-solid fa-location-dot me-1"></i> {{ $paquete['titulo'] }}</h5>
                            <p> {{ ucwords(strtolower($paquete['nombre_pais'])) }} </p>
                            <p> Desde, {{ ucwords(strtolower( $paquete['ciudad_origen_nombre'] ))}}</p>                            
                            <p class="precio_home"><span class="usd">{{ $paquete['moneda'] }} </span> {{ number_format($paquete['precio'], 2) }}</p>
                        </div>
                    </div>
                    <div class="w-100 btn-crucero">
                        <a class="btn btn-primary w-100" data-bs-toggle="collapse" data-bs-target="#detallesPaquete{{ $index }}" aria-expanded="false" aria-controls="detallesPaquete{{ $index }}">VER MÁS</a>                                
                    </div>
                </div>
            </div>
        @endforeach
    </div>
  </div>
  <div class="container">
    <div class="accordion mt-3" id="accordionPaquetes">
    @foreach ($paquetes as $index => $paquete)
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading{{ $index }}"></h2>
            <div id="detallesPaquete{{ $index }}" class="accordion-collapse collapse" data-bs-parent="#accordionPaquetes">
                <div class="accordion-body">
                    <h5>{{ $paquete['titulo'] }}</h5>
                    <p><strong>REF:</strong> {{ $paquete['codigo_paquete'] }}</p>
                    <p><strong>Noches:</strong> {{ $paquete['noches'] ?? 'No disponible' }}</p>
                   <!-- <p><strong>Precio:</strong> {{ $paquete['moneda'] }} {{ number_format($paquete['precio'], 2) }}</p> 
                    <p><strong>Salida:</strong> {{ $paquete['fecha_salida'] ?? 'Fecha no disponible' }}</p>                                                             
                    <p><strong>Incluye Aéreos:</strong> {{ $paquete['incluye_aereo'] ? 'Sí' : 'No' }}</p>
                    @if (!empty($paquete['origen_aereo']))
                        <p><strong>Origen de Vuelos:</strong> {{ $paquete['origen_aereo'] }}</p>
                    @endif
                    <p><strong>Seguro viajero:</strong> {{ $paquete['seguro_medico'] ?? 'No especificado' }}</p>
                    <p><strong>Traslados:</strong> {{ $paquete['traslados'] ?? 'No especificado' }}</p> -->

                    @if (!empty($paquete['hoteles']))
                        @foreach ($paquete['hoteles'] as $hotel)
                            <p><strong>Hotel:</strong> {{ $hotel['nombre'] }}</p>
                        @endforeach
                    @else
                        <p>No hay hoteles disponibles para este paquete.</p>
                    @endif
                    <p class="text-center my-4">
                       <a href="https://api.whatsapp.com/send?phone=543413672066" target="_blank" class="btn-whatsapp">
                       <i class="whatsapp fab fa-whatsapp"></i> ¡Haz clic aquí y envíanos tu consulta con el N° de REF:!</a>
                    </p>
                    <!-- <p><strong>Notas:</strong> {{ $paquete['notas'] ?? 'No disponible' }}</p> -->
                </div>
            </div>
        </div>
    @endforeach
 </div>
 </div>

 <div class="container introduction-productos-content">
  <div class="row">
    <div class="col-12 introduction-productos">
  <h1>DESCUBRE LA MAGIA DEL CARIBE</h1>
  <p>Sumérgete en un paraíso tropical donde las playas de arena dorada se encuentran con las aguas cristalinas. Desde las icónicas playas de Punta Cana hasta los rincones escondidos de Jamaica, el Caribe te invita a explorar la belleza sin igual de sus costas.</p>
  <p class="a my-3">
    <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
      ¿Quieres saber más?
    </a>   
  </p>
  <div class="collapse" id="collapseExample">
    <div class="card card-body">        
      <h4>Paraíso tropical de playas doradas</h4>
          <p>El Caribe, un paraíso tropical donde las playas de arena dorada se encuentran con las aguas cristalinas. Desde las icónicas playas de Punta Cana hasta los rincones escondidos de Jamaica, el Caribe te invita a sumergirte en la belleza sin igual de sus costas.</p>

          <h4>Exploración de arrecifes de coral</h4>
          <p>Descubre la riqueza submarina del Caribe a través de sus arrecifes de coral. Snorkeling en los Cayos de Cuba o buceo en las Islas Caimán, cada rincón ofrece una experiencia única para admirar la vida marina y los coloridos corales.</p>

          <h4>Cultura vibrante y festivales caribeños</h4>
          <p>Sumérgete en la cultura vibrante del Caribe, donde la música y los festivales llenan las calles de alegría. Desde el carnaval en Trinidad y Tobago hasta las festividades de Junkanoo en las Bahamas, la alegría y la música caribeña te envuelven.</p>

          <h4>Gastronomía isleña y sabores exóticos</h4>
          <p>La gastronomía del Caribe es una explosión de sabores exóticos. Desde el jerk jamaicano hasta el mofongo en Puerto Rico, cada isla tiene su propia especialidad culinaria. Disfruta de pescados frescos y frutas tropicales en un festín que deleitará tu paladar.</p>

          <h4>Aventuras en la selva y cascadas secretas</h4>
          <p>Explora la exuberante selva del Caribe y descubre cascadas secretas. Desde las selvas de Dominica hasta las rutas de senderismo en Santa Lucía, cada isla ofrece aventuras en la naturaleza que te acercarán a la auténtica belleza del Caribe.</p>

          <h4>Hospitalidad isleña y bienvenida cálida</h4>
          <p>Experimenta la hospitalidad única del Caribe, donde la bienvenida es cálida y cada visita se convierte en una experiencia inolvidable. Desde los resorts de lujo hasta las acogedoras posadas, cada rincón te invita a disfrutar de la serenidad isleña.</p>

          <h4>Explora la magia del Caribe</h4>
          <p>El Caribe, con su combinación de playas paradisíacas, cultura vibrante y hospitalidad isleña, te invita a explorar un mundo de maravillas tropicales y experiencias únicas.</p>
    </div>
  </div>
 </div>
  </div>
 </div>
 <script>
  // Variables de destinos traídas desde el backend
  const destinosCaribe = @json($destinosCaribeArray);

   function actualizarDestinos() {
    const paisSelect = document.getElementById('pais');
    const destinoSelect = document.getElementById('destino');

    // Limpiar opciones de destino
    destinoSelect.innerHTML = '<option value="">-- Selecciona un destino --</option>';

    // Obtener el país seleccionado
    const paisSeleccionado = paisSelect.value;

    // Validar si el país seleccionado tiene destinos
    if (destinosCaribe[paisSeleccionado]) {
        const ciudades = destinosCaribe[paisSeleccionado].ciudades;

        // Crear opciones para cada ciudad
        ciudades.forEach(ciudad => {
            const option = document.createElement('option');
            option.value = ciudad.codigo_ciudad;
            option.text = ciudad.nombre_ciudad;
            destinoSelect.appendChild(option);
        });
    }
 }
 </script> 
 <!-- Inyecta el array de paquetes en JavaScript -->
 <script>
    const paquetes = {!! json_encode($paquetes) !!};
 </script>

 <!-- Script para manejar el collapse y mostrar detalles -->
 <script>
    document.addEventListener('DOMContentLoaded', () => {
        const botonesVerMas = document.querySelectorAll('.ver-mas-btn');
        
        botonesVerMas.forEach((boton, index) => {
            boton.addEventListener('click', () => {
                mostrarDetalles(paquetes[index]);
            });
        });
    });

    function mostrarDetalles(paquete) {
        const contenedorDetalles = document.getElementById('contenidoPaquete');
        if (!contenedorDetalles) {
            console.error("El elemento 'contenidoPaquete' no se encontró en el DOM.");
            return;
        }

        let contenido = `
            <h5>${paquete.titulo}</h5>
            <p><strong>REF:</strong> ${paquete.codigo_paquete}</p>
            <p><strong>Precio:</strong> ${paquete.moneda} ${parseFloat(paquete.precio).toFixed(2)}</p>
            <p><strong>Salida:</strong> ${paquete.fecha_salida || 'Fecha no disponible'}</p>
            <p><strong>Noches:</strong> ${paquete.noches || 'No disponible'}</p>
            <p><strong>Notas:</strong> ${paquete.notas || 'No disponible'}</p>
            <h6>Hoteles Incluidos:</h6>
        `;

        if (paquete.hoteles && paquete.hoteles.length > 0) {
            paquete.hoteles.forEach(hotel => {
                contenido += `
                    <p><strong>Hotel:</strong> ${hotel.nombre}</p>
                    <p><strong>Precio:</strong> ${paquete.moneda} ${parseFloat(hotel.precio).toFixed(2)}</p>
                    <div class="hotel-images">
                `;
                hotel.imagenes.forEach(imagen => {
                    contenido += `<img src="${imagen}" class="img-thumbnail" style="width: 50px; height: auto;">`;
                });
                contenido += '</div><hr>';
            });
        } else {
            contenido += `<p>No hay hoteles disponibles para este paquete.</p>`;
        }

        contenedorDetalles.innerHTML = contenido;
    }
</script>
<script>
    function mostrarDetalles(paquete) {
        let contenido = `
            <h5>${paquete.titulo ?? 'Título no disponible'}</h5>
            <p><strong>Precio:</strong> ${paquete.moneda} ${parseFloat(paquete.precio).toFixed(2)}</p>
            <p><strong>Salida:</strong> ${paquete.fecha_salida ?? 'Fecha no disponible'}</p>
            <p><strong>Noches:</strong> ${paquete.noches ?? 'No disponible'}</p>
            <p><strong>Notas:</strong> ${paquete.notas ?? 'No disponible'}</p>
            <h6>Hoteles Incluidos:</h6>`;

        if (paquete.hoteles) {
            paquete.hoteles.forEach(hotel => {
                contenido += `
                    <p><strong>Hotel:</strong> ${hotel.nombre}</p>
                    <p><strong>Precio:</strong> ${paquete.moneda} ${parseFloat(hotel.precio).toFixed(2)}</p>
                    <div>`;
                hotel.imagenes.forEach(imagen => {
                    contenido += `<img src="${imagen}" class="img-thumbnail" style="width: 50px; height: auto;">`;
                });
                contenido += `</div><hr>`;
            });
        }

        document.getElementById('modalContenido').innerHTML = contenido;
        new bootstrap.Modal(document.getElementById('paqueteModal')).show();
    }
</script>

@endsection



