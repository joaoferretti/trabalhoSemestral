<?php 

    class viewCriarPergunta {

        public function execute() {
            Application::getInstance()->Display($this->getLayout());
        }

        private function getLayout() {
            $sHtml = "
            <!DOCTYPE html>
            <html lang=\"pt-br\">
            <head>
                <meta charset=\"UTF-8\">
                <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
                <title>Cadastrar Pergunta</title>
                <link rel=\"stylesheet\" href=\"view/css/estilo_criar_pergunta.css\">
            </head>
            <body>

                <div class=\"form-container\">
                    <h2>Cadastrar Pergunta</h2>
                    <form action=\"index.php?rota=admin&operacao=gravar&tipo=pergunta\" method=\"POST\">
                        <label for=\"descricao\">Pergunta:</label>
                        <input type=\"text\" id=\"descricao\" name=\"descricao\" required>

                        <div class=\"checkbox-container\">
                            <input type=\"checkbox\" id=\"obrigatoria\" name=\"obrigatoria\" value=\"1\">
                            <label for=\"obrigatoria\">Pergunta obrigatória</label>
                        </div>

                        <button type=\"submit\">Cadastrar Pergunta</button>
                    </form>
                </div>
            </body>
            </html>";
            return $sHtml;
        }

    } 

?>