<?php

use App\Http\Controllers\EmpresaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('contenido');
});

Route::get('/empresas', [EmpresaController::class, 'index']);
Route::post('/empresas/registrar', [EmpresaController::class, 'store']);
Route::put('/empresas/actualizar', [EmpresaController::class, 'update']);
Route::put('/empresas/activar', [EmpresaController::class, 'activar']);
Route::put('/empresas/desactivar', [EmpresaController::class, 'desactivar']);
