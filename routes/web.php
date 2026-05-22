<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OfertasController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; 

// ============================================
// RUTAS PÚBLICAS
// ============================================

Route::get('/', function () {
    $productos = DB::table('Hombre')
        ->inRandomOrder()
        ->limit(4)
        ->get();

    return view('welcome', compact('productos'));
})->name('home');

// ============================================
// RUTAS AUTENTICADAS (Dashboard)
// ============================================

Route::get('/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// ============================================
// AUTENTICACIÓN
// ============================================

// Ruta de logout
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    
    return redirect('/');
})->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');
    
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas de administración
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/products/store', [App\Http\Controllers\Admin\AdminController::class, 'storeProduct'])->name('products.store');
    Route::post('/users/store', [App\Http\Controllers\Admin\AdminController::class, 'storeUser'])->name('users.store');
    Route::get('/users/{id}/edit', [App\Http\Controllers\Admin\AdminController::class, 'editUser'])->name('users.edit');
    Route::patch('/users/{id}', [App\Http\Controllers\Admin\AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{id}/delete', [App\Http\Controllers\Admin\AdminController::class, 'deleteUser'])->name('users.delete');
});

// Rutas del carrito
Route::get('/carrito', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// Rutas de checkout
Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout.process')->middleware('auth');
Route::get('/checkout/success', [CartController::class, 'checkoutSuccess'])->name('checkout.success');

Route::get('/vistaProducto/{id}', function ($id) {
    $producto = DB::table('Hombre')->where('id_producto', $id)->first();
    
    if (!$producto) {
        abort(404);
    }
    
    return view('shop.vistaProducto', ['producto' => $producto]);
});

Route::get('/search', function () {
    $term = trim(request('q', ''));

    if (!$term) {
        return view('search.results', [
            'query' => $term,
            'productos' => collect([]),
            'total' => 0,
        ]);
    }

    $searchColumns = ['nombre', 'descripcion', 'tipoRopa', 'color'];

    $hombres = DB::table('Hombre')
        ->where(function ($query) use ($term, $searchColumns) {
            foreach ($searchColumns as $column) {
                $query->orWhere($column, 'like', "%{$term}%");
            }
        })
        ->get()
        ->map(function ($item) {
            return (object) array_merge((array) $item, [
                'category' => 'hombres',
                'url' => '/vistaProducto/' . $item->id_producto,
            ]);
        });

    $mujeres = DB::table('Mujer')
        ->where(function ($query) use ($term, $searchColumns) {
            foreach ($searchColumns as $column) {
                $query->orWhere($column, 'like', "%{$term}%");
            }
        })
        ->get()
        ->map(function ($item) {
            return (object) array_merge((array) $item, [
                'category' => 'mujeres',
                'url' => '/mujeres/' . $item->id_producto,
            ]);
        });

    $productos = $hombres->merge($mujeres);

    return view('search.results', [
        'query' => $term,
        'productos' => $productos,
        'total' => $productos->count(),
    ]);
})->name('search');

/*
|--------------------------------------------------------------------------
| RUTA PARA LA SECCIÓN DE OFERTAS
|--------------------------------------------------------------------------
*/

Route::get('/ofertas', [OfertasController::class, 'index'])->name('ofertas');

/*
|--------------------------------------------------------------------------
| RUTAS PARA LA SECCIÓN DE HOMBRES
|--------------------------------------------------------------------------
*/

// Listado general de productos para hombres con filtros
Route::get('/hombres', function () {
    $query = DB::table('Hombre');
    
    // Filtro por tipo de ropa
    if (request('tipo')) {
        $query->where('tipoRopa', request('tipo'));
    }
    
    // Filtro por talla (usando LIKE porque talla es un campo con valores como "S, M, L, XL")
    if (request('talla')) {
        $query->where('talla', 'like', '%' . request('talla') . '%');
    }
    
    // Filtro por color
    if (request('color')) {
        $query->where('color', request('color'));
    }
    
    // Filtro por precio máximo
    if (request('precio_max')) {
        $query->where('precio', '<=', request('precio_max'));
    }
    
    $productos = $query->get();
    return view('shop.hombres', ['productos' => $productos]);
})->name('hombres');

// Detalle de un producto específico por ID
Route::get('/hombres/{id}', function ($id) {
    // Buscamos el producto específico por su ID
    $producto = DB::table('Hombre')->where('id_producto', $id)->first();

    // Si no existe, mandamos error 404
    if (!$producto) { 
        abort(404); 
    }

    return view('shop.vistaProducto', [
        'producto' => $producto,
        'backUrl' => url('/hombres'),
    ]);
});

// Detalle de un producto de mujer específico por ID
Route::get('/mujeres/{id}', function ($id) {
    $producto = DB::table('Mujer')->where('id_producto', $id)->first();

    if (!$producto) {
        abort(404);
    }

    return view('shop.vistaProducto', [
        'producto' => $producto,
        'backUrl' => url('/mujeres'),
    ]);
});

/*
|--------------------------------------------------------------------------
| RUTAS PARA LA SECCIÓN DE MUJERES
|--------------------------------------------------------------------------
*/

Route::get('/mujeres', function () {
    $query = DB::table('Mujer');

    if (request('tipo')) {
        $query->where('tipoRopa', request('tipo'));
    }

    if (request('talla')) {
        $query->where('talla', 'like', '%' . request('talla') . '%');
    }

    if (request('color')) {
        $query->where('color', request('color'));
    }

    if (request('precio_max')) {
        $query->where('precio', '<=', request('precio_max'));
    }

    $productos = $query->get();
    return view('shop.mujeres', ['productos' => $productos]);
})->name('mujeres');

/*
|--------------------------------------------------------------------------
| RUTAS PARA EL SISTEMA DE PEDIDOS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    // Rutas de pedidos para administradores
    Route::prefix('admin/pedidos')->name('admin.pedidos.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\PedidoController::class, 'index'])->name('index');
        Route::get('/{id}', [App\Http\Controllers\Admin\PedidoController::class, 'show'])->name('show');
        Route::put('/{id}/estado', [App\Http\Controllers\Admin\PedidoController::class, 'updateEstado'])->name('update.estado');
        Route::delete('/{id}', [App\Http\Controllers\Admin\PedidoController::class, 'destroy'])->name('destroy');
        Route::get('/estadisticas', [App\Http\Controllers\Admin\PedidoController::class, 'estadisticas'])->name('estadisticas');
    });
});

// Importa las rutas de autenticación (Login, Registro, etc.)
require __DIR__.'/auth.php';