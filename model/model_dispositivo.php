<?php 

    class modelDispositivo {
        
        private $id;
        private $descricao;

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
            return $this;
        }

        public function getDescricao() {
            return $this->descricao;
        }

        public function setDescricao($descricao) {
            $this->descricao = $descricao;
            return $this;
        }

        public function setData($origem) {
            $this->id  = $origem["id"];
            $this->descricao = $origem["descricao"];
        }

    }

?>