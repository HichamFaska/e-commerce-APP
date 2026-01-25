<?php
    use App\Core\Facade\Route;
    use App\Http\Controllers\AuthController;
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

    Route::get('/admin/dashboard', function (){
        echo "c'est la partie administration 😁";
    },[function (){ return new RoleMiddleware('admin');}]);

    Route::get('/admin/produit', function (){
        echo "c'est la partie administration des produits 😁";
    },[function (){ return new RoleMiddleware('admin');}]);
    