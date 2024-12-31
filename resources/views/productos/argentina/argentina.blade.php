@extends('layouts.app-master')
@section('content')
<div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">  
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="5000">      
      <img src="{{ asset ('assets/img_banner/Banner-argentina-min.png') }}" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
         <h1></h1>
         <p></p>
      </div>     
    </div>
  </div>  
 </div> 
 
 <div class="container my-3 m-auto productos-detalles home-iconos">
     <div class="titulo text-center">
     <!--  <h4 class="display-4">Nuestros Paquetes Imbatibles</h4>
       <p class="text-start">Todos nuestros paquetes incluyen (Aéreos con equipaje en Bodega, traslados Privados en destino y seguros hasta usd 300.000) con valores por pasajero en habitación doble.</p>
       <p class="text-start">Consultanos por otros Hoteles o tipo de habitación!!</p>
     -->
     </div>
     <div class="row">
       @php
       $productosCaribe = collect($productos)->filter(function ($producto) {
        return $producto->ubicacion === 'Argentina';
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
                    <p>REF: N° {{ $producto->id }} - <i class="fa-regular fa-calendar-days"></i> {{ $producto->fecha_salida }}</p>
                    <h5><i class="fa-solid fa-location-dot me-1"></i> {{ $producto->destinos->ciudad_destino }}</h5> 
                    <p>{{ $producto->titulo }}</p>                                    
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
        <h4 class="display-4">Busca los mejores Paquetes por Argentina</h4>        
    </div>
    <!-- Contenedor del formulario con estilo de recuadro -->
  @php
    $destinosArgentinaArray = json_decode($destinosArgentina, true);
  @endphp
  <div class="row justify-content-center">
    <div class="col-lg-10">
        <p class="text-start">Incluyen (Aéreos con equipaje en Bodega, traslados regular en destino + seguros) valores para dos pasajeros en habitación doble.</p>
       <p class="text-start">¿Son más de dos? Consultanos!!</p>
        <div class="p-4 mb-5" style="border: 2px solid #007bff; border-radius: 10px; background-color: #f8f9fa;">
            <h5 class="text-center mb-4" style="color: #007bff;">Encuentra tu Destino Perfecto</h5>
            <form action="{{ route('paquetes.argentina') }}#resultado" method="GET" id="argentinaForm">
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
        <h1>DESCUBRE LA MAGIA DE ARGENTINA</h1>
        <p>Argentina, un país que cautiva con su diversidad única y ofrece un abanico de experiencias turísticas
          inolvidables. Desde las animadas calles de Buenos Aires hasta los paisajes remotos de la Patagonia,
          Argentina se presenta como un mosaico de contrastes y emociones.
        </p>
        <p class="a my-3">
          <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            ¿Quieres saber más?
          </a>   
        </p>
        <div class="collapse" id="collapseExample">
          <div class="card card-body">             
        <h4>Herencia Cultural y Pasión</h4>
        <p>Argentina es hogar de una rica herencia cultural, donde la pasión por el tango, la música y el arte impregna
          la vida cotidiana. En sus ciudades, especialmente en Buenos Aires, se puede sentir la energía vibrante de la
          danza, la arquitectura elegante y la intensidad de la vida nocturna.</p>

        <h4>Naturaleza Asombrosa</h4>
        <p>Desde las selvas tropicales del norte hasta los glaciares imponentes del sur, la naturaleza argentina sorprende
          por su variedad y belleza. Las Cataratas del Iguazú, la cordillera de los Andes y los paisajes infinitos de la
          Pampa ofrecen una muestra de la majestuosidad natural que caracteriza al país.</p>

        <h4>Gastronomía Auténtica</h4>
        <p>La cocina argentina es una mezcla única de influencias europeas y latinoamericanas, destacando por sus carnes
          asadas, empanadas y vinos excepcionales. Explorar los mercados locales y disfrutar de una parrillada es
          sumergirse en una experiencia culinaria que celebra los sabores auténticos del país.</p>

        <h4>Aventura en la Patagonia</h4>
        <p>Para los amantes de la aventura, la Patagonia argentina ofrece un escenario épico. Desde excursiones en kayak
          por lagos cristalinos hasta caminatas entre glaciares milenarios, esta región garantiza una dosis de
          adrenalina y la oportunidad de conectar con la naturaleza en su forma más pura.</p>

        <h4>Hospitalidad Inigualable</h4>
        <p>La hospitalidad de los argentinos es conocida en todo el mundo. Aquí, los visitantes son recibidos con una
          calidez única, haciendo que cada encuentro sea más que una simple transacción; es un intercambio de sonrisas,
          historias y conexiones genuinas.</p>

        <h4>Explora la Autenticidad Argentina</h4>
        <p>Argentina, con su mezcla de culturas, su naturaleza impresionante y su hospitalidad sincera, invita a los
          viajeros a explorar un territorio diverso donde cada rincón cuenta una historia única.</p>

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
        $productosArg = $productos->filter(function ($producto) {
            return $producto->ubicacion === 'Tur-Arg';
        });
        $productosAleatorios = $productosArg->shuffle();
       @endphp
       @foreach ($productosAleatorios as $producto)
       @if($producto->tipo_producto !== 'Aéreo')
       <div class="col-md-4 p-2">
        <div class="card productosCrucero">
            <div class="" style="position: relative; overflow: hidden;">
                <div style="padding-top: 100%;"></div>
                <img src="{{ asset('assets/img_paquetes/' . $producto->imagen) }}" class="card-img-top img-fluid" alt="{{ $producto->nombre }}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                <div class="card-img-overlay titulo-prod-cruceros">
                    <p><i class="fa-solid fa-location-dot me-1"></i> {{ $producto->destinos->ciudad_destino }}, {{ $producto->pais->nombre }}</p>                                     
                    <p><span class="usd">{{ $producto->moneda }} </span> {{ $producto->precio_total }}</p>
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
  <script>
  // Variables de destinos traídas desde el backend
  const destinosArgentina = @json($destinosArgentinaArray);

  function actualizarDestinos() {
    const destinoSelect = document.getElementById('destino');

    // Limpiar opciones de destino
    destinoSelect.innerHTML = '<option value="">-- Selecciona un destino --</option>';

    // Validar si Brasil ('BR') tiene destinos
    if (destinosArgentina['AR']) {
      const ciudades = destinosArgentina['AR'].ciudades;

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
