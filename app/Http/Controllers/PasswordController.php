<?php
    namespace App\Http\Controllers;

    use App\Http\Request;
    use App\Models\PasswordReset;
    use App\Models\User;
    use App\Services\MailService;
    
    class PasswordController{
        private Request $request;
        private User $user;
        private PasswordReset $passwordReset;

        public function  __construct(Request $request, User $user, PasswordReset $passwordReset){
            $this->request = $request;
            $this->user = $user;
            $this->passwordReset = $passwordReset;
        }

        public function showForgot() {
            view('pages/auth/forgot-password');
        }

        public function sendOtp():void{
            $email = $this->request->input('email');
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                view('pages/auth/forgot-password', [
                    'error' => 'Email invalide'
                ]);
                return;
            }
            $user = $this->user->findByEmail($email);
            if (!$user) {
                view('pages/auth/forgot-password', ['error' => 'Email introuvable']);
                return;
            }
            $otp = random_int(100000,999999);
            $token = bin2hex(random_bytes(32));
            date_default_timezone_set('Europe/Paris');
            $expires = date('Y-m-d H:i:s', time() + 300);

            $this->passwordReset->create([
                'email' => $email,
                'otp' => $otp,
                'token' => $token,
                'expires' => $expires
            ]);

            MailService::sendOtp($email, $otp, $token);

            header('location: /verify-otp/'.$token);
            exit;
        }

        public function showOtp($token):void{
            if (!$this->passwordReset->existsByToken($token)){
                http_response_code(403);
                exit;
            }

            view('pages/auth/verify-otp', ['token' => $token]);
        }

        public function verifyOtp(string $token):void{
            $otp = $this->request->input('otp');
            $reset = $this->passwordReset->verifyOtp($token, $otp);
            if (!$reset) {
                view('pages/auth/verify-otp', [
                    'error' => 'OTP invalide ou expiré',
                    'token' => $token
                ]);
                return;
            }
            header("Location: /reset-password/".$token);
        }

        public function showReset(string $token) {
            view('pages/auth/reset-password', ['token' => $token]);
        }

        public function resetPassword(string $token):void{
            $password = $this->request->input('password');
            $confirm  = $this->request->input('confirm_password');

            if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password)) {
                view("pages/auth/reset-password", [
                    "token" => $token,
                    "error" => "Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial."
                ]);
                return;
            }
            if ($password !== $confirm) {
                view('pages/auth/reset-password', [
                    'error' => 'Les mots de passe ne correspondent pas',
                    'token' => $token
                ]);
                return;
            }

            $reset = $this->passwordReset->findByToken($token);
            if (!$reset){
                http_response_code(403);
                exit;
            }

            $password_hash = password_hash($password, PASSWORD_BCRYPT);

            $this->user->updatePassword($reset->email, $password_hash);
            $this->passwordReset->deleteByToken($token);

            header('Location: /reset-password-success');
            exit;
        }

        public function success():void{
            view('pages/auth/sucess-reset');
        }
    }