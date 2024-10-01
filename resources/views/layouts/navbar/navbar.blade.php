 @if (Auth::guard('client')->check() || Auth::check())
  @else
  <div class="promo-container">
    <p class="promo-text">"THE CLUB" Regístrate y podrás acceder a promociones exclusivas únicamente para nuestra comunidad.</p>
  </div>
 @endif
<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">    
      <div class="pe-3 content-logo">
        <a class="logo-navbar" href="/">
          <img class="logo-movil" src="../assets/img/Logo-banner-blanco.png" alt="">          
        </a> 
      </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse content-navbar" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2">
        <li class="nav-item">
          <a class="" aria-current="page" href="/">
            <div class="text-center text-left">
              <i class="fa-solid fa-house"></i>
              <p class="cw">Home</p>
            </div>
          </a>
        </li>
         <li class="nav-item ms-4">
          <a class="" aria-current="page" href="/aereos">
            <div class="text-center text-left">
              <i class="fa-solid fa-plane"></i>
              <p class="cw">Vuelos</p>
            </div>
          </a>
        </li>    
        <!-- 
        <li class="nav-item ms-4">
          <a class="" aria-current="page" href="/conoce-argentina">
            <div class="text-center text-left">
              <img class="bandera-arg" src="../assets/img_banderas/argentina_nav.png" alt="">
              <p>Tur-Arg</p>
            </div>
          </a>
        </li>
         -->
        <li class="nav-item ms-4">
          <a class="" aria-current="page" href="/brasil">
            <div class="text-center text-left">
              <img class="bandera-arg" src="../assets/img_banderas/Brasil_nav.png" alt="">
              <p>Brasil</p>
            </div>
          </a>
        </li>
        <li class="nav-item">
          <a class="" aria-current="page" href="/caribe">
            <div class="text-center text-left">
              <i class="fa-solid fa-umbrella-beach"></i>
              <p class="cw">Caribe</p>
            </div>
          </a>
        </li>      
      </ul>        
      <ul class="navbar-nav me-5 mb-2 mb-lg-0">      
        @guest()
          @if (Auth::guard('client')->check())
          @else
          <p class="inicia_sesion"><i class="fa-solid fa-right-to-bracket"></i><a href="/login_client">THE CLUB</a></p>
          @endif
        @endguest 
        @if (Auth::check())
          @php
          $userId = Auth::user()->id;
          @endphp
        @endif        
        @if (@auth())           
             @if (Auth::user())
               @if (Auth::user()->id_rango === 1) 
                   <li class="bienvenido-user nav-item dropdown">
                   <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Bienvenido
                   {{auth()->user()->usuario}}
                   </a>                   
                   <ul class="dropdown-menu menu-login">
                     <li><a class="dropdown-item" href="{{ route('user.edit') }}">Mi Perfil</a></li>
                     <li><a class="dropdown-item" href="#">Mis Ventas</a></li>
                     <li><a class="dropdown-item" href="#">Mi Equipo</a></li>
                     <li><a class="dropdown-item" href="/read_producto">Alta Paquetes</a></li>
                     <li><a class="dropdown-item" href="/read_crucero">Alta Cruceros</a></li>
                     <li><a class="dropdown-item" href="/excursiones_arg">Excursiones Arg.</a></li>
                     <li><a class="dropdown-item" href="/read_vuelos">Vuelos</a></li>
                     <li><a class="dropdown-item" href="/read_destinos">Destinos</a></li>
                   <!--  <li><a class="dropdown-item" href="upload">Uploads Provincias con exel</a></li> -->
                     <li><a class="dropdown-item" href="/read_hotel">Hoteles</a></li> 
                     <li><a class="dropdown-item" href="/read_rooms">Room</a></li> 
                     <li><a class="dropdown-item" href="/read_mayoristas">Mayoristas</a></li>
                     <li><a class="dropdown-item" href="/read_naviera">Alta Navieras</a></li>
                     <li><a class="dropdown-item" href="/read_barcos">Alta Barcos</a></li>
                     <li><a class="dropdown-item" href="{{ route('user.presentation', ['reclutador_equipo_oficial' => Auth::user()->id]) }}">Mi Presentación</a></li>
                     <li><hr class="dropdown-divider"></li>
                     <li><a class="dropdown-item" href="{{ route('recibo_pagos') }}">Recibos</a></li>
                     <li><a class="dropdown-item" href="/logout">Salir</a></li>
                   </ul>
                  </li>
               @elseif (Auth::user()->id_rango === null)    
                  <li class="bienvenido-user nav-item dropdown">
                  <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Bienvenido
                  {{auth()->user()->usuario}}
                  </a>
                  <ul class="dropdown-menu menu-login">
                    <li><a class="dropdown-item" href="{{ route('user.edit') }}">Mi Perfil</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="/logout">Salir</a></li>
                  </ul>
                </li>    
               @elseif (Auth::user()->id_rango === 2 || Auth::user()->id_rango === 3)
                  <li class="bienvenido-user nav-item dropdown">
                   <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Bienvenido
                     {{auth()->user()->usuario}}
                   </a>
                   <ul class="dropdown-menu menu-login">
                     <li><a class="dropdown-item" href="{{ route('user.edit') }}">Mi Perfil</a></li>
                     <li><a class="dropdown-item" href="#">Mis Ventas</a></li>
                     <li><a class="dropdown-item" href="#">Contenidos</a></li>
                     <li><hr class="dropdown-divider"></li>
                     <li><a class="dropdown-item" href="/logout">Salir</a></li>
                   </ul>
                  </li>
               @elseif (Auth::user()->id_rango > 3)
                  <li class="bienvenido-user nav-item dropdown">
                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Bienvenido
                     {{auth()->user()->usuario}}
                    </a>
                    <ul class="dropdown-menu menu-login">
                      <li><a class="dropdown-item" href="{{ route('user.edit') }}">Mi Perfil</a></li>
                      <li><a class="dropdown-item" href="#">Mis Ventas</a></li>
                      <li><a class="dropdown-item" href="#">Contenidos</a></li>
                      <li><a class="dropdown-item" href="#">Mi Equipo</a></li>
                      <li><a class="dropdown-item" href="{{ route('user.presentation', ['reclutador_equipo_oficial' => Auth::user()->id]) }}">Mi Presentación</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="/logout">Salir</a></li>
                    </ul>
                  </li>       
               @endif 
            @elseif (Auth::guard('client')->check())
              <li class="bienvenido-user nav-item dropdown">
              <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Bienvenido
               {{ Auth::guard('client')->user()->usuario }}
              </a>
               <ul class="dropdown-menu menu-login">
                   <li><a class="dropdown-item" href="{{ route('client.edit') }}">Mi Perfil</a></li>
                   <li><a class="dropdown-item" href="{{ route('client.misViajes') }}">Mis Viajes</a></li>
                   <li><hr class="dropdown-divider"></li>
                   <li><a class="dropdown-item" href="/logout">Salir</a></li>
               </ul>
              </li>  
            @endif               
        @endif       
      </ul>      
    </div>
  </div>
</nav>