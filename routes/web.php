<?php

use App\Http\Controllers\UserLoginController;
use App\Http\Controllers\UserRegisterController;
use App\Http\Controllers\UserHomeController;
use App\Http\Controllers\UserLogoutController;
use App\Http\Controllers\ClientRegisterController;
use App\Http\Controllers\ClientLoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\ProvinciaController;
use App\Http\Controllers\CategoriaUserController;
use App\Http\Controllers\UserPresentationController;
use App\Http\Controllers\ContactosController;
use App\Http\Controllers\PromocionController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\CotizacionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AereosController;
use App\Http\Controllers\ViajeController;
use App\Http\Controllers\DestinoController;
use App\Http\Controllers\ViajeAMedidaController;
use App\Http\Controllers\ProveedorMayoristaController; 
use App\Http\Controllers\ProductoCruceroController;
use App\Http\Controllers\AltaNavieraController;
use App\Http\Controllers\NombreBarcoController;
use App\Http\Controllers\ExcursionesArgController; 
use App\Http\Controllers\HotelsRoomController;
use App\Http\Controllers\ReciboPagoController;
use App\Http\Controllers\MisViajesController;
use App\Http\Controllers\ContactoCursoItalianoController;
use App\Http\Controllers\DisneyController;

Route::get('/disney-usa', [DisneyController::class, 'disneyUSA'])->name('disney.usa');
Route::get('/eurodisney', [DisneyController::class, 'eurodisney'])->name('eurodisney');

Route::get('/', [HomeController::class, 'index']);
Route::get('/welcome_suppliers', function () {
    return view('welcome_suppliers');
});
Route::get('/certificado_habilitante', function () {
    return view('layouts.construccion.certificado_habilitante');
});
Route::get('/cotizacion_update/{id}', [CotizacionController::class, 'formUpdateCotizacion'])->name('cotizacion.update');
Route::post('/cotizacion_update/{id}', [CotizacionController::class, 'editarCotizacion'])->name('cotizacion.updateProcess');

//Auth::routes(['verify' => true]);
Route::get('/upload', [ProvinciaController::class, 'showUploadForm'])->name('upload.form');
Route::post('/import', [ProvinciaController::class, 'import'])->name('import.excel');
Route::get('/verify-email-client/{id}', [ClientRegisterController::class, 'verifyEmail'])->name('verify.email.client');
Route::get('/verify-email-user/{id}', [UserRegisterController::class, 'verifyEmail'])->name('verify.email.user');
// User Emprendedores
//Route::resource('/user', UserRegisterController::class);
Route::post('/register_emprendedor_digital', [UserRegisterController::class, 'register']);
Route::get('/register_emprendedor_digital', [UserRegisterController::class, 'show']);
Route::get('/verificacion_success', [UserRegisterController::class, 'verification'])->name('verificacion.success');
Route::get('/login_emprendedor_digital', [UserLoginController::class, 'show']);
Route::post('/login_emprendedor_digital', [UserLoginController::class, 'login']);
Route::get('/recover_password_emprendedor', [UserLoginController::class, 'recover']);
Route::post('/recover_password_emprendedor', [UserLoginController::class, 'recoverPassword']);
Route::get('/userHome', [UserHomeController::class, 'index']);
Route::get('/edit', [UserRegisterController::class, 'editForm'])->name('user.edit');
Route::put('/edit/{id}', [UserRegisterController::class, 'update'])->name('user.update');
Route::get('/bienvenidos', [UserRegisterController::class, 'welcome']);
Route::get('/logout', [UserLogoutController::class, 'logout']);
//Route::get('/oportunidad_trabajo_remoto', [UserPresentationController::class, 'information'])->name('user.presentation');
Route::get('/oportunidad_trabajo_remoto_turismo', [UserPresentationController::class, 'information'])->name('user.presentation');
Route::post('/oportunidad_trabajo_remoto_turismo', [UserPresentationController::class, 'registro'])->name('user.presentation_registro');
// Fin User Emprendedores
Route::resource('paises', PaisController::class);
Route::resource('provincias', ProvinciaController::class);
Route::resource('categoria_users', CategoriaUserController::class);
// Clientes
Route::get('/clientHome', [ClientLoginController::class, 'index']);
Route::post('/register_client', [ClientRegisterController::class, 'register']);
Route::get('/register_client', [ClientRegisterController::class, 'show'])->name('client.register_client');
Route::get('/verification_success', [ClientRegisterController::class, 'verification'])->name('verification.success');
Route::get('/login_client', [ClientLoginController::class, 'showLogin']);
Route::post('/login_client', [ClientLoginController::class, 'login']);
Route::get('/edit_client', [ClientRegisterController::class, 'editForm'])->name('client.edit');
Route::put('/update/{id}', [ClientRegisterController::class, 'update'])->name('client.update');
Route::get('/logout_client', [ClientLoginController::class, 'logout']);
Route::get('/recover_password_client', [ClientLoginController::class, 'recover']);
Route::post('/recover_password_client', [ClientLoginController::class, 'recoverPassword']);
Route::get('/reclamos', [ContactosController::class, 'showForm'])->name('client.reclamos.form');
Route::post('/reclamos/{id}', [ContactosController::class, 'reclamo_save'])->name('client.reclamos');
Route::get('/mis_viajes', [MisViajesController::class, 'index'])->name('client.misViajes');
Route::post('/mis_viajes', [MisViajesController::class, 'store']);
Route::delete('/mis_viajes/{id}', [MisViajesController::class, 'destroy'])->name('mis_viajes.destroy');

Route::get('/contacto', [ContactosController::class, 'contactForm'])->name('client.contacto');
Route::post('/contacto/{id?}', [ContactosController::class, 'contactAccion'])->name('client.contacto.save');
// Excursiones Arg
Route::get('/excursiones_arg', [ExcursionesArgController::class, 'create'])->name('excursiones_arg.create');
// FIN Excursiones Arg
// Italianos
Route::get('/italy', [ContactoCursoItalianoController::class, 'create']);
Route::post('/italy', [ContactoCursoItalianoController::class, 'store']);
// Promociones productos turisticos
Route::get('/conoce-argentina', [PromocionController::class, 'cookie_conoceArgentina']);
Route::get('/brasil', [PromocionController::class, 'cookie_brasil']);
Route::get('/caribe', [PromocionController::class, 'cookie_caribe']);
Route::get('/europa', [PromocionController::class, 'cookie_europa']);
Route::get('/por-el-mundo', [PromocionController::class, 'cookie_porElMundo']);
Route::get('/aereos', [PromocionController::class, 'cookie_vuelos']);
Route::get('/cruceros', [PromocionController::class, 'cookie_cruceros']);
// Proveedores Mayoristas
Route::get('/read_mayoristas', [ProveedorMayoristaController::class, 'listarMayoristas'])->name('mayorista.listado');
Route::get('/mayorista_new', [ProveedorMayoristaController::class, 'mostrarFormulario'])->name('mayorista.new');
Route::post('/mayorista_new', [ProveedorMayoristaController::class, 'crear']);
Route::get('/update_mayorista/{id}', [ProveedorMayoristaController::class, 'formUpdateMayorista'])->name('mayorista.update');
Route::post('/update_mayorista/{id}', [ProveedorMayoristaController::class, 'editarMayorista'])->name('mayorista.updateProcess');
Route::post('/delete_mayorista/{id}', [ProveedorMayoristaController::class, 'deleteMayorista'])->name('mayorista.delete');
// FIN Proveedores Mayoristas
// Qr
Route::get('/qrcode', [QRCodeController::class, 'generateQRCode']);
// Cookie promotor digital
//Alta Hoteles
Route::get('/read_hotel', [HotelController::class, 'mostrarHoteles'])->name('hotel.show');
Route::get('/hotel_news', [HotelController::class, 'showFormHotel'])->name('hotel.store');
Route::post('/hotel_news', [HotelController::class, 'createHotel'])->name('hotel.store');
Route::get('/hotel_update/{id}', [HotelController::class, 'formUpdateHotel'])->name('hotel.update');
Route::post('/hotel_update/{id}', [HotelController::class, 'editarHotel'])->name('hotel.updateProcess');
Route::post('/hotel_delete/{id}', [HotelController::class, 'hotelDelete'])->name('hotel.delete');
// Paises
Route::get('/read_pais', [PaisController::class, 'mostrarPaises'])->name('pais.show');
Route::get('/pais_news', [PaisController::class, 'showFormPais'])->name('pais.store');
Route::post('/pais_news', [PaisController::class, 'createPais'])->name('pais.store');
Route::get('/pais_update/{id}', [PaisController::class, 'formUpdatePais'])->name('pais.update');
Route::post('/pais_update/{id}', [PaisController::class, 'editarPais'])->name('pais.updateProcess');
Route::post('/pais_delete/{id}', [PaisController::class, 'paisDelete'])->name('pais.delete');
//Alta Paquetes
Route::get('/create_producto', [ProductoController::class, 'showFormProd'])->name('producto.create');
Route::post('/create_producto', [ProductoController::class, 'createProd'])->name('producto.create');
Route::get('/read_producto', [ProductoController::class, 'mostrarProductos'])->name('producto.show');
Route::get('/update_producto/{id}', [ProductoController::class, 'formUpdateProductos'])->name('producto.update');
Route::post('/editar_producto/{id}', [ProductoController::class, 'editarProducto'])->name('producto.updateProcess');
Route::post('/delete_producto/{id}', [ProductoController::class, 'deleteProductos'])->name('producto.delete');
Route::get('/detalles_productos/{id}', [ProductoController::class, 'detalle_producto'])->name('producto.detalles');
Route::get('/paquetes', [ProductoController::class, 'paquetes']);
Route::get('/grupales', [ProductoController::class, 'grupales']);
//Alta Cruceros - 
Route::get('/create_crucero', [ProductoCruceroController::class, 'showFormCru'])->name('crucero.create');
Route::post('/create_crucero', [ProductoCruceroController::class, 'create'])->name('crucero.creates');
Route::get('/read_crucero', [ProductoCruceroController::class, 'mostrarProductos'])->name('crucero.show');
Route::get('/crucero_update/{id}', [ProductoCruceroController::class, 'edit'])->name('crucero.edit');
Route::post('/crucero_update/{id}', [ProductoCruceroController::class, 'update'])->name('crucero.update');
Route::post('/delete_crucero/{id}', [ProductoCruceroController::class, 'destroy'])->name('crucero.delete');
Route::get('/detalles_cruceros/{id}', [ProductoCruceroController::class, 'detalle_producto'])->name('producto.detallesCrucero');
// Alta Navieras
Route::get('/create_naviera', [AltaNavieraController::class, 'showFormNav']);
Route::get('/read_naviera', [AltaNavieraController::class, 'index']);
Route::post('/create_naviera', [AltaNavieraController::class, 'create'])->name('naviera.create');
Route::post('/delete_naviera/{id}', [AltaNavieraController::class, 'destroy'])->name('naviera.delete');
Route::get('/naviera_update/{id}', [AltaNavieraController::class, 'edit'])->name('naviera.edit');
Route::post('/naviera_update/{id}', [AltaNavieraController::class, 'update'])->name('naviera.update');
// Nombre de Barcos
Route::get('/create_barco', [NombreBarcoController ::class, 'showFormNav']);
Route::get('/read_barcos', [NombreBarcoController ::class, 'index']);
Route::post('/create_barco', [NombreBarcoController ::class, 'create'])->name('barco.create');
Route::post('/delete_barco/{id}', [NombreBarcoController ::class, 'destroy'])->name('barco.delete');
Route::get('/barco_update/{id}', [NombreBarcoController ::class, 'edit'])->name('barco.edit');
Route::post('/barco_update/{id}', [NombreBarcoController ::class, 'update'])->name('barco.update');
//Aereos
Route::get('/read_vuelos', [AereosController::class, 'mostrarVuelos'])->name('vuelos.show');
Route::get('/create_vuelos', [AereosController::class, 'showFormVuelos'])->name('vuelos.create');
Route::post('/create_vuelos', [AereosController::class, 'createVuelo'])->name('vuelos.create');
Route::post('/cotizar_vuelos', [AereosController::class, 'cotizarVuelos'])->name('cotizar.vuelos');
Route::get('/coti_update/{id}', [AereosController::class, 'formUpdateCoti'])->name('cotiAereo.update');
Route::post('/deleteCotiAereo/{id}', [AereosController::class, 'deleteCotiAereo'])->name('cotiAereo.delete');
Route::post('/editarCotiAereo/{id}', [AereosController::class, 'editarProducto'])->name('cotiAereo.updateProcess');
// Viajes consultas
Route::post('/consulta_viaje', [ViajeController::class, 'guardarDatos'])->name('consulta_viaje');
Route::post('/consulta_viaje_crucero', [ViajeController::class, 'guardarDatosCrucero'])->name('consulta_viaje_crucero');
// Destinos
Route::get('/read_destinos', [DestinoController::class, 'mostrarDestinos'])->name('destinos.show'); 
Route::get('/create_destino', [DestinoController::class, 'showFormDestino'])->name('destinos.form');
Route::post('/create_destinos', [DestinoController::class, 'createDestino'])->name('destinos.create');
Route::get('/update_destino/{id}', [DestinoController::class, 'formUpdateDestino'])->name('destino.update');
Route::post('/update_destino/{id}', [DestinoController::class, 'updateDestino'])->name('update.destino');
Route::post('/delete_destino/{id}', [DestinoController::class, 'deleteDestinos'])->name('destino.delete');
// Viajes a Medida
Route::get('/a-medida', [ViajeAMedidaController::class, 'vista'])->name('a-medida');
Route::post('/a-medida', [ViajeAMedidaController::class, 'store']);
// Create Rooms
Route::get('/create_room_hotel', [HotelsRoomController ::class, 'index'])->name('form.room');
Route::post('/create_room_hotel', [HotelsRoomController ::class, 'create'])->name('create_room_hotel');
Route::get('/read_rooms', [HotelsRoomController ::class, 'read_rooms']);
Route::get('/room_update/{id}', [HotelsRoomController ::class, 'edit_form'])->name('room.update');
Route::post('/delete_room/{id}', [HotelsRoomController ::class, 'destroy'])->name('room.delete');
/*
Route::post('/barco_update/{id}', [NombreBarcoController ::class, 'update'])->name('barco.update');
*/
// Recibo de pagos
Route::get('/recibo_pagos', [ReciboPagoController::class, 'index'])->name('recibo_pagos');
Route::post('/recibo_pagos', [ReciboPagoController::class, 'store']);
// Fin Recibo de pagos
// The Club
Route::get('/the_club', [UserRegisterController ::class, 'the_club']);