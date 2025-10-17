<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Administrador\UsuarioController;
Route::get('/', function () {
    return view('welcome');
});



Route::get('/dashboard', [UsuarioController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::patch('/administracion/usuarios/{usuario}/estado', [UsuarioController::class, 'cambiarEstado'])
    ->name('administrador.usuarios.cambiarEstado');

Route::middleware(['auth', 'role:administrador'])->prefix('administrador')->name('administrador.')->group(function(){    
   
    Route::get('/administracion/usuarios/editar/{usuario}', [UsuarioController::class, 'edit'])
    ->name('administrador.editar.usuario');
    //
    Route::get('/administracion/usuarios/editar/{user?}', function () { // Agregamos {user?} para que la URL se vea profesional
        return view('editar_usuario');
    })->name('editar.usuario');

    Route::get('/dashboard', [UsuarioController::class, 'index'])->name('dashboard');

    // Mantenemos una sola línea para el resource y la ruta de AJAX
    Route::resource('usuarios', UsuarioController::class)->except(['show']); // Excluimos 'show' que no usaremos

    
});







Route::middleware(['auth', 'role:panadero'])->group(function(){
    Route::get('/dashboard_panadero', function(){
        return view('dashboard_panadero');
    })->name('panadero.dashboard');
});
    

 

require __DIR__.'/auth.php';
