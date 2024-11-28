<?php 

    class viewCriarAvaliacao {

        public function executar() {
            Application::getInstance()->Display($this->getLayout());
        }

        private function getPerguntasAtivas() {
            $sHtml = '';
            require_once "model/model_pergunta.php";
            $oModelPergunta = new modelPergunta();
            $oPerguntas = $oModelPergunta->getAllPerguntasAtivas();
            foreach($oPerguntas as $aPergunta) {
                $sNomeCampo = "pergunta['".$aPergunta['id']."']";
                $sHtml .= "
                <label for=\"$sNomeCampo\">".$aPergunta['descricao'].":</label>
                <textarea name=\"$sNomeCampo\"";
                if($aPergunta['obrigatoria']) {
                    $sHtml .= "required></textarea>";
                } else {
                    $sHtml .= "></textarea>";
                }
            }
            return $sHtml;
        }

        private function getBotoesAvaliar() {
            $aCores = ['#ff0000', '#ff4000', '#ff8000', '#ffbf00', '#ffff00', '#bfff00', '#80ff00', '#40ff00', '#00ff00', '#00ff80', '#0FFF50'];
            $sHtml = '';
            foreach($aCores as $iChave => $sCor) {
                $sHtml .= "<label>
                               <input type=\"radio\" name=\"resposta\" value=\"$iChave\">
                               <span style=\"background-color: $sCor;\">$iChave</span>
                           </label>";
            }
            return $sHtml;
        }

        private function getLayout() {
            $sHtml = "
            <!DOCTYPE html>
            <html lang=\"en\">
            <head>
                <meta charset=\"UTF-8\">
                <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
                <title>Avaliação</title>
                <link rel=\"stylesheet\" href=\"view/css/estilo_criar_avaliacao.css\">
            </head>
            <body>
                <div class=\"back-button\">
                    <a href=\"index.php\">Voltar</a>
                </div>
                <div class=\"container\">
                    <h1>Avaliação</h1>
                    <form action=\"index.php?rota=avaliacao&operacao=inserir\" method=\"post\">
                        <div>".$this->getBotoesAvaliar()."</div>
                        <br>
                        ".$this->getPerguntasAtivas()."
                        <label for=\"descricao\">Espaço para feedback livre:</label>
                        <textarea name=\"descricao\"></textarea>

                        <button type=\"submit\">Enviar Resposta</button>
                    </form>
                </div>
                <footer>
                    Sua avaliação espontânea é anônima, nenhuma informação pessoal é solicitada ou armazenada.
                </footer>
            </body>
            </html>";
            return $sHtml;
        }

    } 

?>