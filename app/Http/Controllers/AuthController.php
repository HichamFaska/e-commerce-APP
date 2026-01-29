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
            
            if(!$user || !password_verify($password,$user->motDePasse)){
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

        public function showRegister():void{
            view('pages/auth/register');
        }

        public function register():void{
            $username = $this->request->input('username');
            $email = $this->request->input('email');
            $password = $this->request->input('password');
            $confirm_password = $this->request->input("confirm_password");
            
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                view('pages/auth/register', [
                    'error' => 'email invalide'
                ]);
                return;
            }
            
            if($confirm_password !== $password){
                view('pages/auth/register', [
                    'error' => 'Confirmation du mot de passe incorrecte'
                ]);
                return;
            }

            if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password)) {
                view("pages/auth/register", [
                    "error" => "Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial."
                ]);
                return;
            }


            if ($this->user->findByEmail($email)) {
                view('pages/auth/register', [
                    'error' => 'Cet email existe déjà'
                ]);
                return;
            }
            $password_hash = password_hash($password, PASSWORD_BCRYPT);
            $this->user->create([
                'username' => $username,
                'email' => $email,
                'password' => $password_hash
            ]);

            header('Location: /login');
            exit;
        }
    }