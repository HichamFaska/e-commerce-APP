<?php
    namespace App\Http\middleware;

    use App\Auth\Auth;
    use App\Http\Request;

    class RoleMiddleware{
        private array $role;

        public function __construct(string|array $role){
            $this->role = (array) $role;
        }

        public function handle(Request $request):void{
            if(!Auth::check()){
                header('Location: /login');
                exit;
            }

            if(!in_array(Auth::role(), $this->role, true)){
                http_response_code(403);
                view('errors/403');
                exit;
            }
        }
    }