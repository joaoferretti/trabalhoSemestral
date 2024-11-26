<?php 

    class modelUsuario {
        
        private $userName;
        private $userLogin;
        private $userPass;

        public function getUserName() {
            return $this->userName;
        }

        public function setUserName($sUserName) {
            $this->userName = $sUserName;
        }

        public function getUserLogin() {
            return $this->userLogin;
        }

        public function setUserLogin($sUserLogin) {
            $this->userLogin = $sUserLogin;
        }

        public function getUserPass() {
            return $this->userPass;
        }

        public function setUserPass($sUserPass) {
            $this->userPass = $sUserPass;
        }

        public function setData($origem) {
            $this->userName  = $origem["nome"];
            $this->userLogin = $origem["login"];
            $this->userPass  = $origem["pass"];
        }

        public function update() {
            if($this->getUserLogin() && $this->getUserPass()) {
                Application::getInstance()->getDataBase()->newQuery()->UPDATE("usuario", 
                                                        ["nome", "pass"],
                                                        [$this->getUserName(), $this->getUserPass()],
                                                        "login = " . $this->getUserLogin()
                                                       );
            } else {
                throw new Exception("Dados de Login e Senha são obrigatórios.");                
            }
        }
    }

?>