<?php
    use App\Core\Facade\Route;
    use App\Http\Controllers\AuthController;
    use App\Http\middleware\AuthMiddleware;
    use App\Http\middleware\GuestMiddleware;

    Route::get('/', function (){
        echo "bienvenue a mon App e-commerce";
    },[AuthMiddleware::class]);

    Route::get('/login', [AuthController::class, 'showLogin'], [GuestMiddleware::class]);
    Route::post('/login', [AuthController::class, 'login'], [GuestMiddleware::class]);
    Route::get('/logout', [AuthController::class, 'logout'], [AuthMiddleware::class]);