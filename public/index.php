<?php
    require_once dirname(__DIR__)."/vendor/autoload.php";
    require __DIR__ . '/../app/Core/Helpers/view.php'; // <--- ajouter le helper ici

    use App\Http\Request;
    use App\Core\Facade\Route;
    use App\Core\Router;

    $request = Request::capture();
    
    $router = new Router();

    Route::setRouter($router);
    require dirname(__DIR__)."/routes/web.php";
    $router->dispatch($request);