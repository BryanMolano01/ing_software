<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Administrador\UsuarioController;
Route::get('/', function () {
    return view('welcome');
});



Route::get('/dashboard', function () {
    return view('dashboard_administrador');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});








Route::middleware(['auth', 'role:administrador'])->prefix('administrador')->name('administrador.')->group(function(){
    Route::get('/dashboard-administrador', function(){
        return view('dashboard_administrador');
    })->name('administrador.dashboard');

    Route::resource('usuarios', UsuarioController::class);
    Route::post('usuarios/{usuario}/cambiar-estado', [UsuarioController::class, 'cambiarEstado'])->name('usuarios.cambiarEstado');

    Route::get('/administracion/usuarios/crear', function () {
    return view('crear_usuario');
    })->name('crear.usuario');

});







Route::middleware(['auth', 'role:panadero'])->group(function(){
    Route::get('/dashboard.panadero', function(){
        return view('dashboard_panadero');
    })->name('panadero.dashboard');
});
    

 

require __DIR__.'/auth.php';
