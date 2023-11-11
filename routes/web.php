<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SomosController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/quienes-somos', [App\Http\Controllers\SomosController::class, 'somos'])->name('somos');


Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');


Route::get('/dashboard', function() {
    return view('admin.dashboard');
})->name('dashboard')->middleware('auth');

Route::get('/usuarios-admin', [App\Http\Controllers\UsuariosController::class, 'usuarios'])
    ->middleware('auth', 'verified')
    ->name('usuarios');

Route::get('/somos-admin', function() {
    return view('admin.quienessomos_admin');
})->name('quienessomos')->middleware('auth');


Route::get('/productos-admin', [App\Http\Controllers\ProductosController::class, 'productosad'])
    ->middleware('auth', 'verified')
    ->name('productoss');

Route::delete('/productos-admin/{idproducto}', [App\Http\Controllers\ProductosController::class, 'destroy'])->name('destroy.producto');
Route::get('/nuevo-producto', [App\Http\Controllers\ProductosController::class, 'marcacategoria'])->name('nuevo-producto');
Route::post('/productos-admin', [App\Http\Controllers\ProductosController::class, 'store'])->name('insertar.producto');
Route::put('/productos-admin/{idproducto}', [App\Http\Controllers\ProductosController::class, 'update'])->name('productos.update');
Route::get('/productos-admin/{idproducto}/edit', [App\Http\Controllers\ProductosController::class, 'edit'])->name('productos.edit');


Route::get('/marcas', [App\Http\Controllers\MarcaController::class, 'marcas'])
    ->middleware('auth', 'verified')
    ->name('marcas');

Route::post('/marcas', [App\Http\Controllers\MarcaController::class, 'store'])->name('insertar.marca');
Route::put('/marcas/{idmarca}', [App\Http\Controllers\MarcaController::class, 'update'])->name('marca.update');
Route::get('/marcas/{idmarca}/edit', [App\Http\Controllers\MarcaController::class, 'edit'])->name('marca.edit');
Route::delete('/marcas/{idmarca}', [App\Http\Controllers\MarcaController::class, 'destroy'])->name('destroy.marca');

Route::get('/categorias', [App\Http\Controllers\CategoriaController::class, 'categorias'])
    ->middleware('auth', 'verified')
    ->name('categorias');

Route::post('/categorias', [App\Http\Controllers\CategoriaController::class, 'store'])->name('insertar.categoria');
Route::put('/categorias/{idcategoria}', [App\Http\Controllers\CategoriaController::class, 'update'])->name('categoria.update');
Route::get('/categorias/{idcategoria}/edit', [App\Http\Controllers\CategoriaController::class, 'edit'])->name('categoria.edit');
Route::delete('/categorias/{idcategoria}', [App\Http\Controllers\CategoriaController::class, 'destroy'])->name('destroy.categoria');

//INICIA RUTAS SOLO PARA RETORNAR VISTAR DE LOS MODULOS METODO GET
Route::get('/products', [App\Http\Controllers\ProductosController::class, 'productos'])->name('products');

Route::get('/producto', [App\Http\Controllers\ProductosController::class, 'buscar'])->name('productos.buscar');

Route::get('/product', [App\Http\Controllers\ProductosController::class, 'buscardos'])->name('prod.buscar');

Route::get('/products/detalles/{idproducto}', [App\Http\Controllers\ProductoDetalle::class, 'detalles'])->name('detalles');


Auth::routes();
