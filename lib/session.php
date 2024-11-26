<?php 
    require_once 'model/model_usuario.php';

    class session {

        private $sessionId;
        private $status;
        private $usuario;
        private $dataHoraInicio;
        private $dataHoraUltimoAcesso;
        
        public function __construct() {
            $this->inicializaInstancia();            
        }

        private function inicializaInstancia() {
            $this->usuario = new modelUsuario();
            $this->setStatus('Sessão não iniciada');
        }

        public function iniciaSessao() {
            if(!session_start()) {
                throw new Exception('Falhou ao inicializar sessão', 1);
            } 
            $this->sessionId = session_id();
            if(isset($_SESSION['start'])) {
                $this->dataHoraInicio = $_SESSION['start'];
                $this->setStatus('Sessão reiniciada');
            } else {
                $this->dataHoraInicio = time();
                $_SESSION['start'] = $this->dataHoraInicio;
                $this->setStatus('Sessão iniciada');
            }
        }

        public function gravaDadoSessao($nomeDado, $valorDado) {
            $_SESSION[$nomeDado] = $valorDado;
        }

        public function buscaDadoSessao($nomeDado) {
            if(isset($_SESSION[$nomeDado])) {
                return $_SESSION[$nomeDado];
            }
            return null;
        }

        public function getTimeElapsed() {
            //Retornar o tempo já passado da sessão desde o seu início;
        }

        public function finalizaSessao() {
            session_write_close();
            $this->sessionId = null;
            $this->setStatus('Sessão finalizada');
        }

        public function getUsuario() { 
            return $this->usuario;
        }

        public function getUsuarioSessao() {
            if($this->sessionId != null) {
                if(is_object($this->usuario) && $this->usuario->getUserName() != null) {
                    return $this->usuario->getUserName();
                } else {
                    return 'Não foi definido um usuário para sessão';
                }
            }
        }

        public function getSessionId() {
            return $this->sessionId;
        }

        public function getStatus() {
            return $this->status;
        }

        private function setStatus($sStatus) {
            $this->status = $sStatus;
        }

        public function getDataHoraInicio() {
            return $this->dataHoraInicio;
        }

        public function getDataHoraUltimoAcesso() {
            return $this->dataHoraUltimoAcesso;
        }

    }

?>