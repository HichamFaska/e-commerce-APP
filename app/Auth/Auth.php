<?php
    namespace App\Auth;


    class Auth{
        public static function login(int $userId){
            $_SESSION['userId'] = $userId;
        }

        public static function logout():void{
            session_destroy();
        }

        public static function check():bool{
            return isset($_SESSION['userId']);
        }

        public static function getId():int{
            return $_SESSION['userId'] ?? null;
        }
    }