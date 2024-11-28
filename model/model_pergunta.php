<?php 

    class modelPergunta {
        
        private $id;
        private $descricao;
        private $ativa;
        private $obrigatoria;

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

        public function getAtiva() {
            return $this->ativa;
        }

        public function setAtiva($ativa) {
            $this->ativa = $ativa;
            return $this;
        }

        public function getObrigatoria() {
            return $this->obrigatoria;
        }

        public function setObrigatoria($obrigatoria) {
            $this->obrigatoria = $obrigatoria;
            return $this;
        }

        public function setData($origem) {
            if(isset($origem["id"])) {
                $this->id          = $origem["id"];
            }
            if(isset($origem["descricao"])) {
                $this->descricao   = $origem["descricao"];
            }
            if(isset($origem["ativa"])) {
                $this->ativa       = $origem["ativa"];
            }
            if(isset($origem["obrigatoria"])) {
                $this->obrigatoria = $origem["obrigatoria"];
            }
        }

        public function getAll() {
            $oQuery = Application::getInstance()->getDataBase()->newQuery();
            $oQuery->setSql(
                "SELECT perid          AS id, 
  	                    perdescricao   AS descricao,
  	                    perativa       AS ativa,
  	                    perobrigatoria AS obrigatoria
                   FROM tbpergunta
                  ORDER BY perid"
            );
            $oQuery->open();
            return $oQuery->getAll();
        }

        public function getAllPerguntasAtivas() {
            $oQuery = Application::getInstance()->getDataBase()->newQuery();
            $oQuery->setSql(
                "SELECT perid          AS id,
  	                    perdescricao   AS descricao,
  	                    perativa       AS ativa,
                        perobrigatoria AS obrigatoria
                   FROM tbpergunta
                  WHERE perativa = 1"
            );
            $oQuery->open();
            return $oQuery->getAll();
        }

        public function inserir() {
            $result = Application::getInstance()->getDataBase()->newQuery()->insert(
                "tbpergunta", 
                ['perdescricao', 'perobrigatoria', 'perativa'],
                [$this->getDescricao(), $this->getObrigatoria(), $this->getAtiva()]
            );
            return $result;
        }

        public function alterar() {
            Application::getInstance()->getDataBase()->newQuery()->UPDATE(
                "tbpergunta", 
                ["perdescricao", "perativa", "perobrigatoria"],
                [$this->getDescricao(), $this->getAtiva(), $this->getObrigatoria()],
                "perid = " . $this->getId()
            );
        }
    }

?>