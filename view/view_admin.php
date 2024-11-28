<?php 

    class viewAdmin {

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
                <title>Painel Administrativo</title>
                <link rel=\"stylesheet\" href=\"view/css/estilo_admin.css\">
                <script src=\"view/js/script_admin.js\"></script>
            </head>
            <body>
                <div class=\"back-button\">
                    <a href=\"index.php\">Voltar</a>
                </div>
                <div class=\"container\">
                    <h1>Painel Administrativo</h1>
                    <div class=\"button-group\">
                        <button onclick=\"showSection('listarAvaliacoes')\">Listar Avaliações</button>
                        <button onclick=\"showSection('alterarPerguntas')\">Alterar Perguntas</button>
                    </div>

                    <!-- Seção de listar avaliações -->
                    <div id=\"listarAvaliacoes\" class=\"section\">
                        <h2>Avaliações Cadastradas</h2>
                        <table class=\"table\">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Setor</th>
                                    <th>Dispositivo</th>
                                    <th>Avaliação</th>
                                    <th>Descrição</th>
                                    <th>Data Hora</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>".$this->getAllAvaliacoes()."</tbody>
                        </table>
                    </div>
                                            
                    <!-- Seção de alterar perguntas -->
                    <div id=\"alterarPerguntas\" class=\"section active\">
                        <h2>Alterar Perguntas das Avaliações</h2>
                            <table class=\"table\" id=\"perguntasTable\">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Pergunta</th>
                                        <th>Ativo</th>
                                        <th>Obrigatorio</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>".$this->getPerguntas()."</tbody>
                            </table>
                            <div style=\"display: flex; justify-content: space-between;\">
                                <button><a href=\"index.php?rota=admin&operacao=criar&tipo=pergunta\">Adicionar Pergunta</a></button>
                            </div>
                    </div>
                </div>
            </body>
            </html>";
            return $sHtml;
        }

        private function getEstrelas($iResposta) {
            $aCores = ['#ff0000', '#ff4000', '#ff8000', '#ffbf00', '#ffff00', '#bfff00', '#80ff00', '#40ff00', '#00ff00', '#00ff80', '#0FFF50'];
            return "<p color=\"$aCores[$iResposta]\">$iResposta</p>";
        }

        private function getAllAvaliacoes() {
            $sHtml = '';
            $oAvaliacao = Application::getInstance()->getModel('avaliacao');
            $oAvaliacoes = $oAvaliacao->getAll();
            foreach($oAvaliacoes as $aAvaliacoes) {
                $sHtml .= "
                <tr>
                    <td>".$aAvaliacoes['avaid']."</td>
                    <td>".$aAvaliacoes['setid']."</td>
                    <td>".$aAvaliacoes['disid']."</td>
                    <td>".$this->getEstrelas($aAvaliacoes['avaresposta'])."</td>
                    <td>".$aAvaliacoes['avadescricao']."</td>
                    <td>".$aAvaliacoes['avadatahora']."</td>
                    <td><button class=\"expand-btn\" onclick=\"toggleSubTable(this)\">Expandir</button></td>
                </tr>
                <tr id=\"sub-table-1\" class=\"sub-table\">
                    <td colspan=\"5\">
                        <table class=\"table\">
                            <thead>
                                <tr>
                                    <th>Pergunta</th>
                                    <th>Resposta</th>
                                </tr>
                            </thead>
                            <tbody>
                                ".$this->getRespostasByAvaliacao($aAvaliacoes['avaid'])."
                            </tbody>
                        </table>
                    </td>
                </tr>";
            }
            return $sHtml;
        }

        private function getRespostasByAvaliacao($iAvaid) {
            $sHtml = '';
            $oAvaliacaoPergunta = Application::getInstance()->getModel('avaliacao_pergunta');
            $oAvaliacoes = $oAvaliacaoPergunta->getAllByAvaliacao($iAvaid);
            foreach($oAvaliacoes as $aAvaliacoes) {
                $sHtml .= "
                <tr>
                    <td>".$aAvaliacoes['perdescricao']."</td>
                    <td>".$aAvaliacoes['avpresposta']."</td>
                </tr>";
            }
            return $sHtml;
        }

        private function getPerguntas() {
            $sHtml = '';
            $oPergunta = Application::getInstance()->getModel('pergunta');
            $oPerguntas = $oPergunta->getAll();
            foreach($oPerguntas as $aPergunta) {
                $iId = $aPergunta['id'];
                $sHtml .= "
                <tr>
                    <form action=\"index.php?rota=admin&operacao=alterar&pergunta=$iId\" method=\"POST\">
                    <td>$iId</td>
                    <td><input type=\"text\" name=\"descricao\" value=\"".$aPergunta['descricao']."\"></td>
                    <td><input type=\"checkbox\" name=\"ativa\" ";
                    
                    if($aPergunta['ativa']) {
                        $sHtml .= "checked></td>";
                    } else {
                        $sHtml .= "</td>";
                    }
                    
                    $sHtml .= "<td><input type=\"checkbox\" name=\"obrigatoria\" ";
                    if($aPergunta['obrigatoria']) {
                        $sHtml .= "checked></td>";
                    } else {
                        $sHtml .= "</td>";
                    }

                    $sHtml .= "
                    </td>
                        <td><button type=\"submit\" class=\"alter-button\">Alterar</button></td>
                    </form>
                </tr>";
            }
            return $sHtml;
        }

    } 

?>