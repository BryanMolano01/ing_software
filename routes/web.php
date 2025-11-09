<?php

use App\Http\Controllers\Administrador\MateriaPrimaController;
use App\Http\Controllers\Administrador\ProveedorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Administrador\UsuarioController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if (! $user) {
            return redirect('/');
        }
        $rol = $user->rol->rol ?? null;
        if ($rol === 'administrador') {
            return redirect()->route('administrador.dashboard');
        }
        if ($rol === 'panadero') {
            return redirect()->route('panadero.dashboard');
        }
        return redirect('/');
    })->name('dashboard');
});

Route::middleware(['auth', 'role:administrador'])->prefix('administrador')->name('administrador.')->group(function(){    
    
    // navbar
    Route::get('/dashboard', [UsuarioController::class, 'index'])->name('dashboard');
    
    // usuarios
    Route::resource('usuarios', UsuarioController::class)->except(['show']);
    Route::patch('/usuarios/{usuario}/estado', [UsuarioController::class, 'cambiarEstado'])
        ->name('usuarios.cambiarEstado');
    Route::get('/usuarios/editar/{usuario}', [UsuarioController::class, 'edit'])
        ->name('usuarios.editar');
    
    // materia prima (las rutas ahora usan "items")
    Route::resource('items', MateriaPrimaController::class)->except(['show']);
    // GET    /administrador/items              -> index   (administrador.items.index)
    // GET    /administrador/items/create       -> create  (administrador.items.create)
    // POST   /administrador/items              -> store   (administrador.items.store)
    // GET    /administrador/items/{item}/edit  -> edit    (administrador.items.edit)
    // PUT    /administrador/items/{item}       -> update  (administrador.items.update)
    // DELETE /administrador/items/{item}       -> destroy (administrador.items.destroy)
    
    // busqueda de logs
    Route::get('/access-search', [UsuarioController::class, 'searchAccessLogs'])
        ->name('access.search');
    
    // proveedores
    Route::resource('proveedores', ProveedorController::class)->except(['show']);

    //Route::view('/proveedor/crear', 'crear_proveedor')->name('proveedor.create');
    // store proveedor
    //Route::post('/proveedor', [ProveedorController::class, 'store'])->name('proveedor.store');
});

Route::middleware(['auth', 'role:panadero'])->group(function(){
    Route::get('/dashboard_panadero', function(){
        return view('dashboard_panadero');
    })->name('panadero.dashboard');
});

require __DIR__.'/auth.php';
