<?php
    namespace App\Http\middleware;

    use App\Auth\Auth;
    use App\Http\Request;

    class GuestMiddleware{
        public function handle(Request $request){
            if(Auth::check()){
                header('Location: /');
                exit;
            }
        }
    }