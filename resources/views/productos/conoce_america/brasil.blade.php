@extends('layouts.app-master')
@section('content')
<div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>   
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="5000">      
      <img src="{{ asset ('assets/img_banner/Brasil-min.png') }}" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h1></h1>
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
 <div class="container my-3 m-auto productos-detalles home-iconos">
    <!-- Título principal -->
    <div class="titulo text-center">
        <h4 class="display-4">Busca los mejores Paquetes por Brasil</h4>  
           
    </div>
    <!-- Contenedor del formulario con estilo de recuadro -->
  @php
    $destinosBrasilArray = json_decode($destinosBrasil, true);
  @endphp

  <div class="row justify-content-center">
    <div class="col-lg-10">
        <p class="text-start">Incluyen (Aéreos con equipaje en Bodega, traslados regular en destino + seguros) valores para dos pasajeros en habitación doble.</p>
       <p class="text-start">¿Son más de dos? Consultanos!!</p>   
        <div class="p-4 mb-5" style="border: 2px solid #007bff; border-radius: 10px; background-color: #f8f9fa;">
            <h5 class="text-center mb-4" style="color: #007bff;">Encuentra tu Destino Perfecto</h5>
            <form action="{{ route('paquetes.brasil') }}#resultado" method="GET" id="argentinaForm">
                <div class="row">
                    <!-- Campo Destino -->
                    <div class="col-md-12 mb-3">
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
            <!-- Producto -->
            <div class="col-md-3 p-2">
                <div class="card productosCrucero">
                    <div style="position: relative; overflow: hidden;">
                        <div style="padding-top: 100%;"></div>
                        <img src="{{ $paquete['imagenes'][0] ?? 'ruta/a/imagen/default.jpg' }}" class="card-img-top img-fluid" alt="{{ $paquete['titulo'] }}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                        <div class="card-img-overlay titulo-prod-cruceros">
                            <p><i class="fa-regular fa-calendar-days"></i> {{ $paquete['fecha_salida'] ?? 'Fecha no disponible' }}</p>
                            <h5><i class="fa-solid fa-location-dot me-1"></i> {{ $paquete['titulo'] }}</h5>
                            <p>{{ ucwords(strtolower($paquete['nombre_pais'])) }}</p>
                            <p>Desde, {{ ucwords(strtolower($paquete['ciudad_origen_nombre'])) }}</p>
                            <p class="precio_home"><span class="usd">{{ $paquete['moneda'] }} </span> {{ number_format($paquete['precio'], 2) }}</p>
                        </div>
                    </div>
                    <div class="w-100 btn-crucero">
                        <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#modalPaquete{{ $index }}">
                            VER MÁS
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal para el paquete -->
            <div class="modal fade" id="modalPaquete{{ $index }}" tabindex="-1" aria-labelledby="modalPaqueteLabel{{ $index }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalPaqueteLabel{{ $index }}">{{ $paquete['titulo'] }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>REF:</strong> {{ $paquete['codigo_paquete'] }}</p>
                            <p><strong>Noches:</strong> {{ $paquete['noches'] ?? 'No disponible' }}</p>
                            <p><strong>Precio:</strong> {{ $paquete['moneda'] }} {{ number_format($paquete['precio'], 2) }}</p>
                            <p><strong>Salida:</strong> {{ $paquete['fecha_salida'] ?? 'Fecha no disponible' }}</p>
                            <p><strong>Incluye Aéreos:</strong> {{ $paquete['incluye_aereo'] ? 'Sí' : 'No' }}</p>
                            @if (!empty($paquete['hoteles']))
                                @foreach ($paquete['hoteles'] as $hotel)
                                    <p><strong>Hotel:</strong> {{ $hotel['nombre'] }}</p>
                                @endforeach
                            @else
                                <p>No hay hoteles disponibles para este paquete.</p>
                            @endif
                            <p class="text-center my-4">
                                <a href="https://api.whatsapp.com/send?phone=543413672066" target="_blank" class="btn-whatsapp">
                                    <i class="whatsapp fab fa-whatsapp"></i> ¡Haz clic aquí y envíanos tu consulta con el N° de REF: {{ $paquete['codigo_paquete'] }}!
                                </a>
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
 <div class="container introduction-productos-content">
  <div class="row">
    <div class="col-12 introduction-productos">
  <h1>DESCUBRE LA BELLEZA DE BRASIL</h1>
  <p>Brasil, un país vibrante que deslumbra con su diversidad cultural y paisajes naturales extraordinarios. Desde las playas de Copacabana hasta la selva amazónica, Brasil te invita a explorar sus contrastes únicos.</p>
  <p class="a my-3">
    <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
      ¿Quieres saber más?
    </a>   
  </p>
  <div class="collapse" id="collapseExample">
    <div class="card card-body">        
      <h4>Playas Paradisíacas</h4>
      <p>Brasil es famoso por sus playas paradisíacas. Desde las inmaculadas playas de Porto de Galinhas, conocidas por sus aguas cristalinas y arenas blancas, hasta las icónicas playas de Copacabana en Río de Janeiro, famosas por su animado ambiente y vistas espectaculares, el litoral brasileño ofrece lugares como paraísos terrenales. Recorre las cálidas aguas de la Praia de Pipa, famosa por su encanto bohemio y belleza natural. No te pierdas la Praia do Forte, hogar de playas vírgenes y protegidas, donde podrás disfrutar de la biodiversidad marina. También, explora las extensas dunas de Genipabu y maravíllate con sus paisajes únicos. La tranquila Praia do Espelho en Bahía, con sus aguas serenas y paisajes espectaculares, es otro tesoro escondido del nordeste brasileño. Disfruta de la Praia dos Carneiros en Pernambuco, con sus aguas tranquilas y palmeras que bordean la costa, creando un ambiente paradisíaco. Estas recomendaciones son solo una muestra de la diversidad y belleza natural que Brasil tiene para ofrecer, proporcionando entornos ideales para relajarse y disfrutar del sol.</p>

      <h4>Festivales y Ritmos Apasionantes</h4>
      <p>Sumérgete en la alegría contagiosa de los festivales brasileños y deja que los ritmos apasionantes de la samba y la bossa nova te envuelvan. En Brasil, la música y la danza son parte integral de la vida cotidiana.</p>

      <h4>Naturaleza Exuberante</h4>
      <p>Descubre la exuberante belleza de la selva amazónica, hogar de una increíble variedad de flora y fauna. Las Cataratas del Iguazú y las extensas llanuras del Pantanal ofrecen panoramas impresionantes y experiencias inolvidables.</p>

      <h4>Gastronomía Colorida y Sabrosa</h4>
      <p>La cocina brasileña es una explosión de colores y sabores. Desde la feijoada, el plato nacional, hasta las deliciosas coxinhas, cada bocado es una aventura culinaria que refleja la riqueza de la cultura brasileña.</p>

      <h4>Aventuras en la Amazonia</h4>
      <p>Para los amantes de la aventura, la Amazonia brasilera ofrece exploraciones fascinantes. Navega por el río Amazonas, admira la biodiversidad única y conecta con la naturaleza en su estado más puro.</p>

      <h4>Hospitalidad Brasileña</h4>
      <p>La hospitalidad de los brasileños es conocida en todo el mundo. En cada rincón, te recibirán con sonrisas cálidas y te invitarán a formar parte de su vibrante cultura.</p>

      <h4>Explora la Magia de Brasil</h4>
      <p>Brasil, con su diversidad cultural, su naturaleza deslumbrante y su hospitalidad única, te invita a explorar un territorio lleno de sorpresas y experiencias auténticas.</p>
    </div>
  </div>
</div>
  </div>
 </div>
 <div class="container my-3 m-auto productos-detalles home-iconos">
     <div class="titulo text-center">
       <h4 class="display-4"></h4>
     </div>
     <div class="row">
       @php
        $productosArgentina = $productos->filter(function ($producto) {
            return $producto->destino_gral === 'Brasil';
        });
        $productosAleatorios = $productosArgentina->shuffle();
       @endphp
       @foreach ($productosAleatorios as $producto)
       <div class="col-md-4 p-2">
       <div class="card productos">
         <div class="card-img-container">
            @if($producto->tipo_producto == 'Salida Grupal')
            <div class="barra-horizontal-grupal">
              <p class="leyenda">Salida Grupal</p>
            </div>
            @elseif($producto->tipo_producto == 'Grupal con Guía Hispanohablante')
            <div class="barra-horizontal-grupal-hispano">
              <p class="leyenda">Grupal con Guía Hispanohablante</p>
            </div>
            @elseif ($producto->tipo_producto == 'Family Plan')
            <div class="barra-horizontal-family">
              <p class="leyenda">Family Plan</p>
            </div>
             @elseif ($producto->tipo_producto == 'Paquete Turístico')
            <div class="barra-horizontal-paquete">
              <p class="leyenda">Paquete Turístico</p>
            </div>
            @elseif ($producto->tipo_producto == 'Exclusivo Comunidad')
            <div class="barra-horizontal-comunidad">
              <p class="leyenda">Comunidad Argtravels (20% descto.)</p>
            </div>
            @endif
            @php
               $descto_comunidad =$producto->descto;                         
               $resul =  $producto->precio_total * $descto_comunidad
            @endphp
            <img src="{{ asset('assets/img_paquetes/' . $producto->imagen) }}" class="card-img-top img-fluid" alt="{{ $producto->nombre }}">
              <div class="card-img-overlay titulo-prod">
                <h6 class="card-title">{{ $producto->nombre }}</h6>
                @if ($producto->tipo_producto == 'Exclusivo Comunidad')
                <p class="precio-total">Precio: {{ $producto->moneda }} <s> {{ $producto->precio_total }} </s> ({{ $resul }})</p>
               <p>  </p>
                @else 
               <p class="precio-total">Precio: {{ $producto->moneda }}  {{ $producto->precio_total }} </p>
               @endif
              </div>
         </div>      
         <div>      
            <p class="ms-2">  
              @if ($producto->service && ($producto->service->transporte_int == 'Aéreo Directo' || $producto->service->transporte_int == 'Aéreos con escala'))                                        
                  <i class="fas fa-plane-departure"></i>
              @elseif ($producto->service && $producto->service->transporte_int == 'Micro') 
                  <i class="fas fa-bus"></i>
              @elseif ($producto->service && $producto->service->transporte_int == 'Sin Traslados')               
              @endif 
              <span>{{ $producto->origen_salida }} ⇌ {{ $producto->destinos->nombre_destino }}</span>
            </p>
           <p class="ms-2">
             <i class="fa-solid fa-bus"></i> : <span>Aeropuerto ⇌ Hotel</span>
           </p>
           <p class="ms-2">
              <span>
                  @if ($producto->hotel) {{-- Verifica si hay una relación con un hotel --}}
                      <i class="fa-solid fa-hotel"></i> :
                      {{ $producto->hotel->nombre }}
                      @for ($i = 1; $i <= $producto->hotel->categoria; $i++)
                          <i class="fa-solid fa-star"></i>
                      @endfor
                  @else
                      <i class="fa-solid fa-hotel"></i> : Consultar!!
                  @endif
              </span>
          </p>
            <p class="">
              <i class="fa-solid fa-bed ms-2"></i> : {{ $producto->habitacion }} <span> ({{ $producto->estadiaTotal }} <i class="fa-solid fa-cloud-moon"></i>)</span>        
              </span>           
            </p>   
         </div>
         <div class="p-1 w-100">
          <a href="{{ route('producto.detalles', $producto->id) }}" class="btn btn-primary w-100">VER MAS</a>          
         </div>        
       </div>
      </div>
     @endforeach
    </div>   
  </div>
<script>
  // Variables de destinos traídas desde el backend
  const destinosBrasil = @json($destinosBrasilArray);

  function actualizarDestinos() {
    const destinoSelect = document.getElementById('destino');

    // Limpiar opciones de destino
    destinoSelect.innerHTML = '<option value="">-- Selecciona un destino --</option>';

    // Validar si Brasil ('BR') tiene destinos
    if (destinosBrasil['BR']) {
      const ciudades = destinosBrasil['BR'].ciudades;

      // Crear opciones para cada ciudad
      ciudades.forEach(ciudad => {
        const option = document.createElement('option');
        option.value = ciudad.codigo_ciudad;
        option.text = ciudad.nombre_ciudad;
        destinoSelect.appendChild(option);
      });
    } else {
      console.error("No se encontraron destinos para Brasil.");
    }
  }

  // Llamar a la función automáticamente al cargar la página
  document.addEventListener('DOMContentLoaded', actualizarDestinos);
</script>


  <!-- Original
  <script>
  // Variables de destinos traídas desde el backend
  const destinosBrasil = @json($destinosBrasilArray);

   function actualizarDestinos() {
    const paisSelect = document.getElementById('pais');
    const destinoSelect = document.getElementById('destino');

    // Limpiar opciones de destino
    destinoSelect.innerHTML = '<option value="">-- Selecciona un destino --</option>';

    // Obtener el país seleccionado
    const paisSeleccionado = paisSelect.value;

    // Validar si el país seleccionado tiene destinos
    if (destinosBrasil[paisSeleccionado]) {
        const ciudades = destinosBrasil[paisSeleccionado].ciudades;

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
--> 
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
