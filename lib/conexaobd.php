<?php 

    require_once "query.php";

    class conexaobd {

        private $host;
        private $port;
        private $user;
        private $password;
        private $database;
        private $dbconn;
        private $status;

        public function __construct() {
            $this->inicializaInstancia();
        }

        private function inicializaInstancia() {
            $this->user = 'postgres';
            $this->port = 5432;
            $this->host = 'localhost';
            $this->desconecta();
        }

        private function setStatus($sStatus) {
            $this->status = $sStatus;
        }

        public function getStatus() {
            return $this->status;
        }

        public function conecta() {
            try {
                $this->setStatus('Conectando');
                if(!isset($this->dbconn)) {
                    $this->dbconn = pg_connect($this->getConnectionString());
                }
                if($this->dbconn) {
                    $this->setStatus('Conectado');
                    return true;
                }
            } catch (Exception $e){
                $this->setStatus('Erro: ' . $e->getMessage());
            }
        }

        public function getInternalConnection() {
            return $this->dbconn;
        }

        public function desconecta() {
            if($this->dbconn) {
                pg_close($this->dbconn);
            }
            $this->setStatus('Desconectado');
        }

        public function setHost($sHost) {
            $this->host = $sHost;
        }

        public function setport($port) {
            $this->port = $port;
        }

        public function setUser($sUser) {
            $this->user = $sUser;
        }

        public function setPassword($sPassword) {
            $this->password = $sPassword;
        }

        public function setDatabase($sDatabase) {
            $this->database = $sDatabase;
        }

        private function getConnectionString() {
            return "host="      . $this->host . 
                   " port="     . $this->port . 
                   " dbname="   . $this->database . 
                   " user="     . $this->user . 
                   " password=" . $this->password;
        }

        public function newQuery() {
            return new Query($this);
        }

    }
?>