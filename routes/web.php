<?php

use App\Http\Controllers\CnaeController;
use App\Http\Controllers\SetorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
Route::middleware(['auth:sanctum', 'verified'])->group(function() {
    Route::resource('usuarios', UserController::class);
    Route::get('/meu-perfil', [UserController::class, 'perfil'])->name('perfil');
    Route::resource('setores', SetorController::class);

    Route::resource('cnaes', CnaeController::class);

    Route::get('/setores/{setor_id}/criar-cnae', [CnaeController::class, 'create'])
        ->name('cnaes.create');
});

Route::get("/setor/ajax-listar-cnaes", [SetorController::class, 'ajaxCnaes'])
    ->name("ajax.listar.cnaes");
