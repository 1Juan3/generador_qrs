<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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

Route::get('/login', function () {
    return Socialite::driver('google')->redirect();
});
 
Route::get('/google/callback', function () {
    $user = Socialite::driver('google')->user();

    $userExist = User::where('email', $user->email);
    
    if($userExist){
        Auth::login($userExist);
    }else {
        redirect('/');
    }

 

});



// Route::get('/',[App\Http\Controllers\QRController::class,'generateQr']);
Route::get('/', function () {
    return view('login');
});
Route::get('verGrupos/{grupo}', [App\Http\Controllers\QRController::class, 'eliminarQrPorGrupo'])->name('eliminar');
Route::post('verGrupos/{grupo}', [App\Http\Controllers\QRController::class, 'eliminarQrPorGrupo'])->name('eliminar');
Route::get('/verGrupos',[App\Http\Controllers\QRController::class,'verQrPorGrupo'])->name('gruposQr');
Route::post('/verGrupos',[App\Http\Controllers\QRController::class,'storage'])->name('create');
Route::get('/viewQrs/{grupo}',[App\Http\Controllers\QRController::class,'generateQr'])->name('visualizar');
Route::get('/verRegistro',[App\Http\Controllers\QRController::class,'consultar_informacion_entrada'])->name('consutarRegistro');
Route::post('/verRegistro',[App\Http\Controllers\QRController::class,'consultar_informacion_entrada'])->name('consutarRegistro');
Route::get('/registrarEntrada',[App\Http\Controllers\QRController::class,'consultar_informacion'])->name('consultar');
Route::post('/registrarEntrada',[App\Http\Controllers\QRController::class,'consultar_informacion'])->name('consultar');
Route::post('/registrarEntrada/{datos}',[App\Http\Controllers\QRController::class,'registrar_entrada'])->name('registrar');