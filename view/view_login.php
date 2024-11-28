<?php 

    class viewLogin {

        public function execute() {
            Application::getInstance()->Display($this->getLayout());
        }

        private function getLayout() {
            $sHtml = "
            <!DOCTYPE html>
            <html lang=\"en\">
            <head>
                <meta charset=\"UTF-8\">
                <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
                <title>Login</title>
                <link rel=\"stylesheet\" href=\"view/css/estilo_login.css\">
            </head>
            <body>
                <div class=\"login-container\">
                    <h1>Login</h1>
                    <form action=\"index.php?rota=login&operacao=execute\" method=\"POST\">
                        <input type=\"text\" name=\"username\" placeholder=\"Usuário\" required>
                        <input type=\"password\" name=\"senha\" placeholder=\"Senha\" required>
                        <button type=\"submit\">Entrar</button>
                    </form>
                </div>
            </body>
            </html>";
            return $sHtml;
        }

    } 

?>