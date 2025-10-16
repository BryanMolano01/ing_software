<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:administrador'])->group(function(){
    Route::get('/dashboard-administrador', function(){
        return view('dashboard');
    })->name('administrador.dashboard');
});
Route::middleware(['auth', 'role:panadero'])->group(function(){
    Route::get('/dashboard.panadero', function(){
        return view('dashboard');
    })->name('panadero.dashboard');
});
    



require __DIR__.'/auth.php';
