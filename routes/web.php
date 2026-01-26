<?php
    use App\Core\Facade\Route;
    use App\Http\Controllers\AuthController;
    use App\Http\Controllers\CartController;
    use App\Http\Controllers\homeController;
    use App\Http\Controllers\ProductController;
    use App\Http\middleware\AuthMiddleware;
    use App\Http\middleware\GuestMiddleware;
    use App\Http\middleware\RoleMiddleware;

    Route::get('/',[homeController::class, 'index']);

    Route::get('/login', [AuthController::class, 'showLogin'], [GuestMiddleware::class]);
    Route::post('/login', [AuthController::class, 'login'], [GuestMiddleware::class]);
    Route::get('/logout', [AuthController::class, 'logout'], [AuthMiddleware::class]);

    Route::get('/product/{id}', [ProductController::class, 'index']);

    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/cart/add', [CartController::class, 'addToCart']);
    Route::post('/cart/remove', [CartController::class, 'remove']);
    Route::post('/cart/update', [CartController::class, 'update']);

    Route::get('/admin/dashboard', function (){

    },[function (){ return new RoleMiddleware('admin');}]);

    Route::get('/admin/products', function (){

    },[function (){ return new RoleMiddleware('admin');}]);
    