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

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    //return view('layouts.construccion.construccion');
    return view('home');
});
Route::get('/welcome_suppliers', function () {
    return view('welcome_suppliers');
});
Route::get('/certificado_habilitante', function () {
    return view('layouts.construccion.certificado_habilitante');
});
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
Route::post('/recover_password_emprendedor', [UserLoginController::class, 'recoverPost']);
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
Route::get('/register_client', [ClientRegisterController::class, 'show']);
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

Route::get('/contacto', [ContactosController::class, 'contactForm'])->name('client.contacto');
Route::post('/contacto/{id?}', [ContactosController::class, 'contactAccion'])->name('client.contacto.save');

// Promociones productos
Route::get('/conoce-argentina', [PromocionController::class, 'cookie_conoceArgentina']);
Route::get('/por-el-mundo', [PromocionController::class, 'cookie_porElMundo']);
// Qr
Route::get('/qrcode', [QRCodeController::class, 'generateQRCode']);
// Cookie promotor digital