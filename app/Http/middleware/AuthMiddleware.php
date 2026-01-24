<?php
    namespace App\Http\middleware;
    use App\Auth\Auth;
    use App\Http\Request;
    
    class AuthMiddleware{
        public function handle(Request $request){
            if(!Auth::check()){
                header('Location: /login');
                exit;
            }
        }
    }