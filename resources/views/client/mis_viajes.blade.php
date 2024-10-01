 @extends('layouts.app-master')
@section('content')
@if (@auth())             
    @if (Auth::guard('client')->check())
        <div class="container datos-generales">        
            <div class="row">
                <div class="col-md-12">
                    <h2 class="my-4">AQUÍ VERAS TUS SELECCIONES</h2>
                </div>
            </div>
        </div>
        @php
            $misProductosIds = DB::table('mis_viajes')
                                 ->where('id_cliente', Auth::guard('client')->user()->id)
                                 ->pluck('id_producto');
   
            $productosFiltrados = $productos->whereIn('id', $misProductosIds);

            $productosAleatorios = $productosFiltrados->shuffle()->take(6);
        @endphp
        <div class="container my-3 m-auto productos-detalles home-iconos">            
            <div class="row">
                @foreach ($productosAleatorios as $producto)
                    <div class="col-md-4 p-2">
                        <div class="card productosCrucero">
                            <div class="" style="position: relative; overflow: hidden;">
                                <div class="card-img-container" style="padding-top: 100%;">
                                    @if ($producto->tipo_producto == 'The Club')
                                        <div class="barra-horizontal-comunidad">
                                            <p class="leyenda">THE CLUB - Cupos Limitados!!!</p>
                                        </div>
                                    @endif 
                                    <img src="{{ asset('assets/img_paquetes/' . $producto->imagen) }}" class="card-img-top img-fluid" alt="{{ $producto->nombre }}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                                    <div class="card-img-overlay titulo-prod-cruceros">
                                        <p>REF: N° {{ $producto->id }} - <i class="fa-regular fa-calendar-days"></i> {{ $producto->fecha_salida }}</p>
                                        <h5><i class="fa-solid fa-location-dot me-1"></i> {{ $producto->destinos->ciudad_destino }}</h5>
                                        <p>{{ $producto->pais->nombre }}</p>                                    
                                        <h3 class="precio_home"><span class="usd">{{ $producto->moneda }} </span> {{ $producto->precio_total }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="w-100 btn-crucero d-flex justify-content-between">
                                <a href="{{ route('producto.detalles', $producto->id) }}" class="btn btn-primary w-50">VER ITINERARIO</a>
                                <form action="{{ route('mis_viajes.destroy', $producto->id) }}" method="POST" class="w-50">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger w-100" onclick="return confirm('¿Estás seguro de que quieres eliminar este producto?');">ELIMINAR</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="container datos-generales">        
               <div class="row">
                  <div class="col-md-12">
                    <h2 class="mt-4">SELECCIONA TU PAQUETE IDEAL</h2>
                  </div>
               </div>
           </div> 
        <div class="container w-50 form-edit form-movil">                   
            <div class="row pb-3">
                <div class="col conten-login">              
                    <form action="{{ url('/mis_viajes') }}" method="post">
                        @csrf
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif                 
                        @error('email')
                            <div class="alert alert-danger mt-1">
                                <span class="">{{ $message }}</span>
                            </div>
                        @enderror
                        <p style="color: grey;"><b><u>PAQUETES ACTIVOS</u></b></p>   
                        <div class="mb-3 d-none">
                            <input type="number" name="id_cliente" class="form-control" value="{{ Auth::guard('client')->user()->id }}">                                                                 
                        </div>   
                        <div class="mb-3 form-group">
                            <label for="id_producto" class="col-md-4 control-label">Elegí tu destino</label>
                            <div class="">                            
                                <select name="id_producto" class="form-select">                                    
                                    @foreach ($productos as $producto)
                                        <option value="{{ $producto->id }}" {{ (old('id_destino') == $producto->id) ? 'selected' : '' }}>
                                            {{ $producto->titulo }}, REFERENCIA N° {{ $producto->id }}
                                        </option>
                                    @endforeach
                                </select>                           
                            </div>
                        </div>                       
                        <div class="mb-3 form-floating">
                            <input type="number" name="familias" placeholder="Cuantas familias son" class="form-control" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="1" min="1">
                            <label for="familias" class="form-label">Cuantas familias son?</label>                                            
                        </div> 
                        <div class="mb-3 form-floating">
                            <input type="number" name="adultos" placeholder="Cantidad Adultos" class="form-control" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="2" min="1">
                            <label for="adultos" class="form-label">Cantidad de adultos?</label>                                            
                        </div>  
                        <div class="mb-3 form-floating">
                            <input type="number" name="menores" placeholder="Cantidad Menores" class="form-control" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="0" min="0">
                            <label for="menores" class="form-label">Cantidad de Menores?</label>                                            
                        </div>  
                        <div class="mb-3 form-floating">
                            <input type="text" name="edad_menores" placeholder="Edad de los Menores?" class="form-control" onkeypress="if (!/[1-9,]/.test(event.key)) event.preventDefault();">
                            <label for="edad_menores" class="form-label">Edad de los Menores?(ej:6,8,3)</label>                                            
                        </div> 
                        <div class="mb-3 form-floating">
                            <input type="number" name="habitaciones" placeholder="" class="form-control" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="1" min="1">
                            <label for="habitaciones" class="form-label">Cuantas Habitaciones van a necesitar?</label>                                            
                        </div>   
                        <div class="form-group">
                            <label for="comentario" class="control-label">Algún comentario que quieras dejarnos?</label>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="comentario" value="{{ old('comentario') }}">
                            </div>
                        </div>                                           
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    @else
        @include('client.login_client')
    @endif
@endif     
@endsection
