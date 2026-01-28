<?php
    namespace App\Http;

    class Request{
        public function __construct(
            private array $query,
            private array $request,
            private array $server,
            private array $files,
            private array $cookies,
        ){}

        public static function capture():Request{
            return new Request($_GET, $_POST, $_SERVER, $_FILES, $_COOKIE);
        }

        public function method():string{
            return $this->server['REQUEST_METHOD'] ?? 'GET';
        }

        public function path():string{
            $uri = $this->server['REQUEST_URI'] ?? '/';
            return strtok($uri, '?');
        }

        public function previous():?string{
            return $this->request['HTTP_REFERER'] ?? null;
        }
        
        public function input(string $key, mixed $default = null):mixed{
            return $this->request[$key]
                ?? $this->query[$key]
                ?? $default;
        }

        public function file(string $key, mixed $default = null): mixed{
            return $this->files[$key] ?? $default;
        }
        public function files():array{
            return $this->files ?? [];
        }
        public function cookie(string $key, mixed $default = null): mixed{
            return $this->cookies[$key] ?? $default;
        }

        public function has(string $key):bool{
            return isset($this->request[$key]);
        }
    }