<?php
    namespace App\Http\Controllers;

    use App\Http\Request;
    use App\Models\User;
    use App\Auth\Auth;

    class AuthController{
        private Request $request;
        private User $user;

        public function __construct(Request $request, User $user){
            $this->request = $request;
            $this->user = $user;
        }

        public function showLogin():void{
            view("pages/auth/login");
        }

        public function login(): void{
            $email = $this->request->input("email");
            $password = $this->request->input("password");

            $user = $this->user->findByEmail($email);
            
            if(!$user || $password !== $user->motDePasse){
                view("pages/auth/login", ["error" => 'Identifiants invalides']);
                return;
            }

            Auth::login($user->id_utilisateur, $user->role, $user->username);
            if(Auth::role() === "admin"){
                header('Location: /admin/dashboard');
                exit;
            }
            header('Location: /');
            exit;
        }

        public function logout():void{
            Auth::logout();
            header('Location: /login');
            exit;
        }
    }