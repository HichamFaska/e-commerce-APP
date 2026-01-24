<?php
    namespace App\Core;

    use ReflectionClass;
    use Exception;

    class Container{
        private array $bindings = [];
        private array $instances = [];

        // Lier une classe
        public function bind(string $abstract, callable $factory): void{
            $this->bindings[$abstract] = $factory;
        }

        // Partager une instance existante
        public function instance(string $abstract, object $instance): void{
            $this->instances[$abstract] = $instance;
        }

        public function make(string $class){
            // Instance déjà partagée
            if(isset($this->instances[$class])){
                return $this->instances[$class];
            }

            // Factory définie
            if(isset($this->bindings[$class])){
                return $this->bindings[$class]($this);
            }

            // Auto-résolution via Reflection
            $reflection = new ReflectionClass($class);

            if(!$reflection->isInstantiable()){
                throw new Exception("Classe $class non instanciable");
            }

            $constructor = $reflection->getConstructor();
            if(!$constructor){
                return new $class;
            }

            $params = [];
            foreach($constructor->getParameters() as $param){
                $type = $param->getType();
                if(!$type){
                    throw new Exception("Dépendance non typée : {$param->getName()}");
                }
                $params[] = $this->make($type->getName());
            }

            return $reflection->newInstanceArgs($params);
        }
    }

