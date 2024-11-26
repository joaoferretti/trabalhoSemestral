<?php 

    require_once "conexaobd.php";
    require_once "session.php";
    require_once "route.php";

    //Classe de inicialização da aplicação - Nela todo o controle da aplicação é estabelecido.
    class Application {

        private $dataBase;
        private $session;
        private $config;
        private $routeController;

        static $instance;

        public function __construct($autoConnect = true) {
            $this->initApp($autoConnect);  
        }

        static function getInstance() {
            return Application::$instance;
        }

        private function getConfigFileName() {
            return "config.env";
        }

        public function getConfigEntry($group, $name) {
            if(!isset($this->config)) {
                throw new Exception("Conteúdo de configuração não carregado");
            }
            if(!isset($this->config->{$group}->{$name})) {
                throw new Exception("Chave de configuração ".$group."->".$name." não encontrada");
            }
            return $this->config->{$group}->{$name};
        }

        private function initApp($autoConnect) {
            Application::$instance = $this;
            if(!file_exists($this->getConfigFileName())) { 
                throw new Exception("Arquivo de configuração não encontrado.");    
            }
            $this->config = json_decode(file_get_contents($this->getConfigFileName()));
            if($autoConnect) {
                $this->conectaBd();
            }
            $this->session = new session();
            $this->session->iniciaSessao();
            $this->routeController = new Route();
        }

        public function conectaBd() {
            if(!isset($this->dataBase)) {
                $this->dataBase = new Conexaobd();
                $this->dataBase->setHost    ($this->getConfigEntry("database", "host"    ));
                $this->dataBase->setPort    ($this->getConfigEntry("database", "port"    ));
                $this->dataBase->setDatabase($this->getConfigEntry("database", "dbname"  ));
                $this->dataBase->setUser    ($this->getConfigEntry("database", "user"    ));
                $this->dataBase->setPassword($this->getConfigEntry("database", "password"));
            }
            return $this->dataBase->conecta();
        }

        public function getDataBase() {
            return $this->dataBase;
        }

        public function getSession() {
            return $this->session;
        }

        public function route() {
            $this->routeController->execute();
        }

        public function getModel($context) {
            return $this->routeController->getInstanceHelper('model', $context);
        }

        public function display($content) {
            echo $content;
        }

        public function displayFile($file) {
            if(file_exists($file)) {
                echo file_get_contents($file);
            }
        }

    }
?>