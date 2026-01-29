<?php

use App\Auth\Auth;
use App\Core\Facade\Route;
    use App\Http\Controllers\AdminProductController;
    use App\Http\Controllers\AuthController;
    use App\Http\Controllers\CartController;
    use App\Http\Controllers\CategoryController;
    use App\Http\Controllers\homeController;
    use App\Http\Controllers\PaymentController;
    use App\Http\Controllers\ProductController;
    use App\Http\Controllers\CheckoutController;
    use App\Http\middleware\AuthMiddleware;
    use App\Http\middleware\GuestMiddleware;
    use App\Http\middleware\RoleMiddleware;

    Route::get('/',[homeController::class, 'index']);

    Route::get('/register', [AuthController::class, 'showRegister'], [GuestMiddleware::class]);
    Route::post('/register', [AuthController::class, 'register'],[GuestMiddleware::class]);
    
    Route::get('/login', [AuthController::class, 'showLogin'], [GuestMiddleware::class]);
    Route::post('/login', [AuthController::class, 'login'], [GuestMiddleware::class]);
    Route::get('/logout', [AuthController::class, 'logout'], [AuthMiddleware::class]);

    Route::get('/product/{id}', [ProductController::class, 'index']);

    Route::get('/categorie/{categorie}', [CategoryController::class, 'index']);

    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/cart/add', [CartController::class, 'addToCart']);
    Route::post('/cart/remove', [CartController::class, 'remove']);
    Route::post('/cart/update', [CartController::class, 'update']);

    Route::get('/checkout',[CheckoutController::class, 'index'], [AuthMiddleware::class]);
    Route::post('/checkout',[CheckoutController::class, 'store'], [AuthMiddleware::class]);

    Route::get('/payment', [PaymentController::class, 'index'], [AuthMiddleware::class]);
    Route::post('/payment/stripe', [PaymentController::class, 'pay']);
    Route::get('/payment/success', [PaymentController::class, 'success'], [AuthMiddleware::class]);
    Route::get('/payment/cancel', [PaymentController::class, 'cancel'],[AuthMiddleware::class]);

    Route::get('/admin/dashboard', function (){

    },[function (){ return new RoleMiddleware('admin');}]);

    Route::get('/admin/products',[AdminProductController::class, 'index'],[function (){ return new RoleMiddleware('admin');}]);
    Route::post('/admin/products/add',[AdminProductController::class, 'store'],[function (){ return new RoleMiddleware('admin');}]);