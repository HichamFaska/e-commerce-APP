<?php
    require_once dirname(__DIR__)."/vendor/autoload.php";
    require __DIR__ . '/../app/Core/Helpers/view.php';

    use App\Core\Env;
    use App\Http\Request;
    use App\Core\Facade\Route;
    use App\Core\Router;
    
    session_start();
    try{
        Env::load(dirname(__DIR__)."/.env");
        $request = Request::capture();
    
        $router = new Router();

        Route::setRouter($router);
        require dirname(__DIR__)."/routes/web.php";
        $router->dispatch($request);
    }
    catch(Exception $e){
        http_response_code(500);
        $errorMessage = $e->getMessage();
        if (file_exists(dirname(__DIR__)."/app/resources/views/errors/error.php")) {
            view('errors/error', ['message' => $errorMessage]);
        } else {
            echo "<h1>Erreur</h1>";
            echo "<p>{$errorMessage}</p>";
        }
    }
    