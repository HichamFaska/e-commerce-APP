<?php
    if(!function_exists('view')){
        function view(string $path, array $data = []):void{
            $viewPath = dirname(__DIR__)."/../resources/views/".$path.".php";
            if(!file_exists($viewPath)){
                throw new Exception("Vue introuvable : {$path}");
            }
            extract($data);
            require $viewPath;
        }
    }