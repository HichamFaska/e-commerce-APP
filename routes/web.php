<?php
    use App\Core\Facade\Route;
    use App\Http\Controllers\AuthController;

    Route::get('/', function (){
        echo "bienvenue a mon App e-commerce";
    });

    Route::get('/login', [AuthController::class, 'showLogin']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/logout', [AuthController::class, 'logout']);