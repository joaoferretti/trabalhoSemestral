<?php 

    //Responsável por mapear as interações com modelo e views de usuário
    class ControllerAvaliacao {

        public function criar() {
            require_once "view/view_criar_avaliacao.php";
            $view = new viewCriarAvaliacao();
            $view->executar();
        }

        public function inserir() {
            if(!isset($_POST['resposta'])) {
                echo "<script>
                          alert('Não foi informada resposta');
                      </script>";
                $this->criar();
            } else {
                require_once "model/model_avaliacao.php";
                $oModel = new modelAvaliacao();
                $oModel->setData($_POST);
                $oResult = $oModel->inserir();
                $oPerguntas = $_POST['pergunta'];
                foreach($oPerguntas as $iPergunta => $sValor) {
                    $this->insereRelacionamentoPerguntaAvaliacao($oResult['avaid'], trim($iPergunta, "[]'"), $sValor);
                }
                echo "<script>
                          alert('O Hospital Regional Alto Vale (HRAV) agradece sua resposta e ela é muito importante para nós, pois nos ajuda a melhorar continuamente nossos serviços.');
                      </script>";
                $this->criar();
            }
        }

        private function insereRelacionamentoPerguntaAvaliacao($iAvaliacao, $iPergunta, $sValor) {
            require_once "model/model_avaliacao_pergunta.php";
            $oModel = new modelAvaliacao_Pergunta();
            $oModel->getAvaliacao()->setId($iAvaliacao);
            $oModel->getPergunta()->setId($iPergunta);
            $oModel->setResposta($sValor);
            $oModel->inserir();
        }

    }
?>