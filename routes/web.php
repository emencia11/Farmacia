<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MedicamentoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UnidadMedidaController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\EntradaInventarioController;
use App\Http\Controllers\SalidaInventarioController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InventarioController;

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

Route::get('/', function () {
    return view('welcome');
});

// Ruta de registro
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Ruta de login (Agregar esta ruta)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Ruta para página de inicio
Route::get('/', function () {
    return view('welcome');
});

// Ruta para la página principal del sistema (home)
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Ruta para mostrar el formulario de login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Ruta para procesar el login
Route::post('/login', [LoginController::class, 'login']);

// Ruta de logout (esto es para el cierre de sesión)
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

// Ruta para Medicamentos
Route::resource('medicamentos', MedicamentoController::class)->middleware('auth');

// Ruta para Proveedores
Route::resource('proveedores', ProveedorController::class)->middleware('auth');

// Ruta para Ventas
Route::resource('ventas', VentaController::class);


Route::middleware(['auth'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index'); // Ver todos los usuarios
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit'); // Editar usuario
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy'); // Eliminar usuario
    
    Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('user.profile.edit'); // Editar perfil
    Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('user.profile.update'); // Actualizar perfil
});

Route::middleware(['auth'])->group(function () {
    Route::get('/proveedores', [ProveedorController::class, 'index'])->name('proveedores.index');

    Route::middleware('can:isRoot')->group(function () {
        Route::get('/proveedores/create', [ProveedorController::class, 'create'])->name('proveedores.create');
        Route::post('/proveedores', [ProveedorController::class, 'store'])->name('proveedores.store');
        Route::get('/proveedores/{id}/edit', [ProveedorController::class, 'edit'])->name('proveedores.edit');
        Route::put('/proveedores/{id}', [ProveedorController::class, 'update'])->name('proveedores.update');
        Route::delete('/proveedores/{id}', [ProveedorController::class, 'destroy'])->name('proveedores.destroy');
    });
});

Route::resource('categorias', CategoriaController::class);

Route::middleware(['auth'])->group(function () {
    Route::get('/unidades-medida', [UnidadMedidaController::class, 'index'])->name('unidades-medida.index');
    
    Route::middleware('can:canCreateUnidades')->group(function () {
        Route::get('/unidades-medida/create', [UnidadMedidaController::class, 'create'])->name('unidades-medida.create');
        Route::post('/unidades-medida', [UnidadMedidaController::class, 'store'])->name('unidades-medida.store');
    });
    
    Route::middleware('can:canEditUnidades')->group(function () {
        Route::get('/unidades-medida/{unidadMedida}/edit', [UnidadMedidaController::class, 'edit'])->name('unidades-medida.edit');
        Route::put('/unidades-medida/{unidadMedida}', [UnidadMedidaController::class, 'update'])->name('unidades-medida.update');
    });

    Route::delete('/unidades-medida/{unidadMedida}', [UnidadMedidaController::class, 'destroy'])->name('unidades-medida.destroy');
});

Route::middleware(['auth'])->group(function () {
    // Ruta para el listado de medicamentos
    Route::get('/medicamentos', [MedicamentoController::class, 'index'])->name('medicamentos.index');

    // Rutas para crear y almacenar medicamentos
    Route::middleware('can:canCreateMedicamentos')->group(function () {
        Route::get('/medicamentos/create', [MedicamentoController::class, 'create'])->name('medicamentos.create');
        Route::post('/medicamentos', [MedicamentoController::class, 'store'])->name('medicamentos.store');
    });

    // Rutas para editar y actualizar medicamentos
    Route::middleware('can:canEditMedicamentos')->group(function () {
        Route::get('/medicamentos/{id}/edit', [MedicamentoController::class, 'edit'])->name('medicamentos.edit');
        Route::put('/medicamentos/{id}', [MedicamentoController::class, 'update'])->name('medicamentos.update');
    });

    // Ruta para eliminar un medicamento (solo root)
    Route::middleware('can:canDeleteMedicamentos')->group(function () {
        Route::delete('/medicamentos/{id}', [MedicamentoController::class, 'destroy'])->name('medicamentos.destroy');
    });
});

Route::middleware(['auth'])->group(function () {
    // Vista general de inventario
    Route::get('/inventario', [EntradaInventarioController::class, 'inventarioIndex'])->name('inventario.index');

    // ========== ENTRADAS ========== //
    Route::middleware('can:canCreateInventario')->group(function () {
        Route::get('/inventario/entrada/create', [EntradaInventarioController::class, 'create'])->name('inventario.entrada.create');
        Route::post('/inventario/entrada', [EntradaInventarioController::class, 'store'])->name('inventario.entrada.store');
    });

    Route::middleware('can:canEditInventario')->group(function () {
        Route::get('/inventario/entrada/{id}/edit', [EntradaInventarioController::class, 'edit'])->name('inventario.entrada.edit');
        Route::put('/inventario/entrada/{id}', [EntradaInventarioController::class, 'update'])->name('inventario.entrada.update');
    });

    Route::middleware('can:canDeleteInventario')->group(function () {
        Route::delete('/inventario/entrada/{id}', [EntradaInventarioController::class, 'destroy'])->name('inventario.entrada.destroy');
    });

    // ========== SALIDAS ========== //
    Route::middleware('can:canCreateInventario')->group(function () {
        Route::get('/inventario/salida/create', [SalidaInventarioController::class, 'create'])->name('inventario.salida.create');
        Route::post('/inventario/salida', [SalidaInventarioController::class, 'store'])->name('inventario.salida.store');
    });

    Route::middleware('can:canEditInventario')->group(function () {
        Route::get('/inventario/salida/{id}/edit', [SalidaInventarioController::class, 'edit'])->name('inventario.salida.edit');
        Route::put('/inventario/salida/{id}', [SalidaInventarioController::class, 'update'])->name('inventario.salida.update');
    });

    Route::middleware('can:canDeleteInventario')->group(function () {
        Route::delete('/inventario/salida/{id}', [SalidaInventarioController::class, 'destroy'])->name('inventario.salida.destroy');
    });

    // Ver detalle individual
    Route::get('/inventario/{tipo}/{id}', [EntradaInventarioController::class, 'show'])->name('inventario.show');
});

Route::patch('/users/{user}/toggle-activo', [UserController::class, 'toggleActivo'])->name('users.toggleActivo');

Route::middleware(['auth'])->group(function () {
    Route::resource('devoluciones', \App\Http\Controllers\DevolucionController::class)->only(['index', 'create', 'store', 'show']);
});

Route::get('/inventario/movimientos', [InventarioController::class, 'verMovimientos'])->name('inventario.movimientos');

Route::get('/inventario', [InventarioController::class, 'index'])->name('inventario.index');


