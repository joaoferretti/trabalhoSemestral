<?php 

    //Classe responsável por tratar as rotas da aplicação.
    class Route {

        private $resource;
        private $className;
        private $classInstance;

        public function __construct() {
            $this->route();
        }

        private function route() {
            $this->resource = "";
            $rota = $this->getRota();
            switch ($this->getOperation()) {
                case 'listar':
                    $this->resource = "view";
                    $this->className = "view_listar";
                    break;                
                case 'novo':
                    $this->resource = "view";
                    $this->className = "view_novo";
                    break;                
                case 'inserir':
                    $this->resource = "model";
                    $this->className = "model";
                    break;
                case 'atualizar':
                    $this->resource = "model";
                    $this->className = "model";
                    break;
                case 'excluir':
                    $this->resource = "model";
                    $this->className = "model";
                    break;
                default:
                    $this->resource = "controller";
                    $this->className = "controller";
                    if(!isset($rota)) {
                        $rota = "index";
                    }
                    break;
            }
            $this->resource = $this->resource . "//" . $this->className . "_" . $rota . ".php";
            $this->className = str_replace("_", "", $this->className) . $rota;
        }

        public function getRota() {
            if(isset($_REQUEST["rota"])) {
                return $_REQUEST["rota"];
            }
            return null;
        }
        public function getOperation() {
            if(isset($_REQUEST["operacao"])) {
                return $_REQUEST["operacao"];
            }
            return null;
        }

        public function getResource() {
            return $this->resource;
        }

        public function getClassName() {
            return $this->className;
        }

        public function getClassInstance() {
            return $this->classInstance;
        }

        private function instanceClass() {
            require_once $this->getResource();
            if(class_exists($this->className)) {
                if(!isset($this->classInstance)) { 
                    if($this->classInstance = new $this->className) {
                        return true;
                    }    
                }
            }
            return false;
        }

        public function execute() {
            if($this->instanceClass()) {
                $operation = ($this->getOperation() ?? 'execute');
                if(method_exists($this->classInstance, $operation)) {
                    $this->classInstance->{$operation}();
                } else {
                    throw new Exception("Operação " . $operation . " inexistente na classe " . $this->getClassName());
                }
            }
        }

        public function getInstanceHelper($type, $context) {
            $file = $type . "//" . $type . "_" . $context . ".php";
            if(file_exists($file)) {
                require_once $file;
                $class = $type . $context;
                if(class_exists($class)) {
                    return new $class;
                }
            }             
        }
    }
?>