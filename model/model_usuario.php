<?php 

    class modelUsuario {
        
        private $id;
        private $username;
        private $senha;

        public function getId() {
                return $this->id;
        }

        public function setId($id) {
                $this->id = $id;
                return $this;
        }

        public function getUsername() {
                return $this->username;
        }

        public function setUsername($username) {
                $this->username = $username;
                return $this;
        }

        public function getSenha() {
                return $this->senha;
        }

        public function setSenha($senha) {
                $this->senha = $senha;
                return $this;
        }

        public function validaLogin($sUsuario, $sSenha) {
            $oQuery = Application::getInstance()->getDataBase()->newQuery();
            $oQuery->setSql(
                "SELECT * 
                   FROM tbusuario 
                  WHERE usuusername = '$sUsuario'"
            );
            $oQuery->open();
            while($row = $oQuery->getNextRow()) {
                if($row['ususenha'] == $sSenha) {
                    return true;
                }
            }
            return false;
        }

    }

?>