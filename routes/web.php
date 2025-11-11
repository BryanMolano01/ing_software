<?php

use App\Http\Controllers\Administrador\MateriaPrimaController;
use App\Http\Controllers\Administrador\ProveedorController;
use App\Http\Controllers\Administrador\TipoMateriaPrimaController;
use App\Http\Controllers\Administrador\UbicacionController;
use App\Http\Controllers\Administrador\UnidadMedidaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\TipoItem;
use App\Models\Ubicacion;

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
    //tipo de materia prima
    Route::resource('tipoItem', TipoMateriaPrimaController::class)->except(['show']);
    //ubicacion
    Route::resource('ubicacion', UbicacionController::class)->except(['show']);
    //medidas
    Route::resource('medida', UnidadMedidaController::class)->except(['show']);



    // RUTAS QUE HAY QUE MODIFICAR/ELIMINAR DESPUES
    Route::view('/proveedor/crear', 'editar_proveedor')->name('proveedor.edit');

    Route::view('/tipos/admin', 'administrar_tipos')->name('tipos.admin');
    Route::view('/tipos/edit', 'editar_tipos')->name('tipos.edit');

    Route::view('/ubicaciones/admin', 'administrar_ubicaciones')->name('ubicaciones.admin');
    Route::view('/ubicaciones/edit', 'editar_ubicaciones')->name('ubicaciones.edit');

    Route::view('/medidas/admin', 'administrar_medidas')->name('medidas.admin');
    Route::view('/medidas/edit', 'editar_medidas')->name('medidas.edit');

    Route::view('/recetas/admin', 'administrar_recetas')->name('recetas.admin');
    Route::view('/recetas/edit', 'editar_recetas')->name('recetas.edit');

    
    // store proveedor
    //Route::post('/proveedor', [ProveedorController::class, 'store'])->name('proveedor.store');
});

Route::middleware(['auth', 'role:panadero'])->group(function(){
    Route::get('/dashboard_panadero', function(){
        return view('dashboard_panadero');
    })->name('panadero.dashboard');
});

require __DIR__.'/auth.php';