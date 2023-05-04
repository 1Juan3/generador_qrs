<?php

use Illuminate\Support\Facades\Route;

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



// Route::get('/',[App\Http\Controllers\QRController::class,'generateQr']);
Route::get('/',[App\Http\Controllers\QRController::class,'verQrPorGrupo'])->name('gruposQr');
Route::post('/',[App\Http\Controllers\QRController::class,'storage'])->name('create');
Route::get('/viewQrs/{grupo}',[App\Http\Controllers\QRController::class,'generateQr'])->name('visualizar');
Route::post('/registrarEntrada',[App\Http\Controllers\QRController::class,'consultar_informacion'])->name('consultar');
Route::get('/registrarEntrada',[App\Http\Controllers\QRController::class,'consultar_informacion'])->name('consultar');
Route::post('/registrarEntrada/{datos}',[App\Http\Controllers\QRController::class,'registrar_entrada'])->name('registrar');