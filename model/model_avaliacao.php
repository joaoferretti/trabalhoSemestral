<?php 

    require_once 'model_setor.php';
    require_once 'model_dispositivo.php';
    date_default_timezone_set('America/Sao_Paulo');

    class modelAvaliacao {
        
        private $id;
        private $resposta;
        private $descricao;
        private $dataHora;

        private $Dispositivo;
        private $Setor;

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
            return $this;
        }

        public function getResposta() {
            return $this->resposta;
        }

        public function setResposta($resposta) {
            $this->resposta = $resposta;
            return $this;
        }

        public function getDescricao() {
            return $this->descricao;
        }

        public function setDescricao($descricao) {
            $this->descricao = $descricao;
            return $this;
        }

        public function getDataHora() {
            return $this->dataHora;
        }

        public function setDataHora($dataHora) {
            $this->dataHora = $dataHora;
            return $this;
        }

        public function getDispositivo() {
            return $this->Dispositivo;
        }

        public function setDispositivo($Dispositivo) {
            $this->Dispositivo = $Dispositivo;
            return $this;
        }

        public function getSetor() {
            if(!$this->Setor) {
                $this->Setor = new modelSetor;
            }
            return $this->Setor;
        }

        public function setSetor(modelSetor $Setor) {
            $this->Setor = $Setor;
            return $this;
        }

        public function setData($origem) {
            if(isset($origem["id"])) {
                $this->setId($origem["id"]); 
            }
            if(isset($origem["resposta"])) {
                $this->setResposta($origem["resposta"]);
            }
            if(isset($origem["descricao"])) {
                $this->setDescricao($origem["descricao"]);
            }
            if(isset($origem["dataHora"])) {
                $this->setDataHora($origem["dataHora"]);
            } else {
                $this->setDataHora(date('Y-m-d H:i:s'));
            }
        }

        public function inserir() {
            $result = Application::getInstance()->getDataBase()->newQuery()->insert(
                "tbavaliacao", 
                ["setid", "disid", "avaresposta", "avadescricao", "avadatahora"],
                [1, 1, $this->getResposta(), $this->getDescricao(), $this->getDataHora()]
                // [$this->getSetor()->getId(), $this->getDispositivo()->getId(), $this->getResposta(), $this->getDescricao(), $this->getDataHora()]
            );
            return $result;
        }

        public function getAll() {
            $oQuery = Application::getInstance()->getDataBase()->newQuery();
            $oQuery->setSql(
                "SELECT avaid, 
                        setid, 
                        disid, 
                        avaresposta, 
                        avadescricao, 
                        avadatahora 
                   FROM tbavaliacao"
            );
            $oQuery->open();
            return $oQuery->getAll();
        }

    }

?>