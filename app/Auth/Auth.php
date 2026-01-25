<?php
    namespace App\Auth;


    class Auth{
        public static function login(int $userId, string $role, string $username){
            $_SESSION['userId'] = $userId;
            $_SESSION['role'] = $role;
            $_SESSION['username'] = $username;
        }

        public static function role():?string{
            return $_SESSION['role'] ?? null;
        }

        public static function getUsername():?string{
            return $_SESSION['username'] ?? null;
        }

        public static function logout():void{
            session_destroy();
        }

        public static function check():bool{
            return isset($_SESSION['userId']);
        }

        public static function getId():?int{
            return $_SESSION['userId'] ?? null;
        }
    }