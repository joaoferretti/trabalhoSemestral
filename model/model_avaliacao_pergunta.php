<?php 

require_once 'model_avaliacao.php';
require_once 'model_pergunta.php';

class modelAvaliacao_Pergunta {
    
    private $resposta;

    private $Avaliacao;
    private $Pergunta;

    public function getResposta() {
        return $this->resposta;
    }

    public function setResposta($resposta) {
        $this->resposta = $resposta;
        return $this;
    }

    public function getAvaliacao() {
        if(!$this->Avaliacao) {
            $this->Avaliacao = new modelAvaliacao;
        }
        return $this->Avaliacao;
    }

    public function setAvaliacao(modelAvaliacao $Avaliacao) {
        $this->Avaliacao = $Avaliacao;
        return $this;
    }

    public function getPergunta() {
        if(!$this->Pergunta) {
            $this->Pergunta = new modelPergunta;
        }
        return $this->Pergunta;
    }

    public function setPergunta(modelPergunta $Pergunta) {
        $this->Pergunta = $Pergunta;
        return $this;
    }

    public function inserir() {
        Application::getInstance()->getDataBase()->newQuery()->insert(
            "tbavaliacaopergunta", 
            ["avaid", "perid", "avpresposta"],
            [$this->getAvaliacao()->getId(), $this->getPergunta()->getId(), $this->getResposta()]
        );
    }

    public function getAllByAvaliacao($iAvaid) {
        $oQuery = Application::getInstance()->getDataBase()->newQuery();
        $oQuery->setSql(
            "SELECT perdescricao, avpresposta 
               FROM tbavaliacaopergunta 
               JOIN tbpergunta
                 ON tbpergunta.perid = tbavaliacaopergunta.perid
              WHERE avaid = $iAvaid"
        );
        $oQuery->open();
        return $oQuery->getAll();
    }

}

?>