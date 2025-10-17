<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/administracion/usuarios/crear', function () {
    return view('crear_usuario');
})->name('crear.usuario');

Route::get('/dashboard', function () {
    return view('dashboard_administrador');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:administrador'])->group(function(){
    Route::get('/dashboard-administrador', function(){
        return view('dashboard_administrador');
    })->name('administrador.dashboard');
});
Route::middleware(['auth', 'role:panadero'])->group(function(){
    Route::get('/dashboard.panadero', function(){
        return view('dashboard_panadero');
    })->name('panadero.dashboard');
});
    



require __DIR__.'/auth.php';
