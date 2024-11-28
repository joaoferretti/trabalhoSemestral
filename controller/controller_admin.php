<?php 

    class ControllerAdmin {

        public function criar() {
            switch ($_GET['tipo']) {
                case 'pergunta':
                    require_once "view/view_criar_pergunta.php";
                    $view = new viewCriarPergunta();
                    $view->execute();        
                    break;
            }
        }

        public function execute() {
            require_once "view/view_login.php";
            $view = new viewLogin();
            $view->execute();
        }

        public function gravar() {
            switch ($_GET['tipo']) {
                case 'pergunta':
                    require_once "model/model_pergunta.php";
                    $oModel = new modelPergunta();
                    $oModel->setDescricao($_POST['descricao']);
                    $oModel->setObrigatoria($_POST['obrigatoria']);
                    $oModel->setAtiva(1);
                    $oModel->inserir();
            }
        }

        public function alterar() {
            $iIdPergunta = $_GET['pergunta'];
            require_once "model/model_pergunta.php";
            $oModel = new modelPergunta();
            $oModel->setId($iIdPergunta);
            $oModel->setDescricao($_POST['descricao']);
            $oModel->setObrigatoria(isset($_POST['obrigatoria']) ? 1 : 0);
            $oModel->setAtiva(isset($_POST['ativa']) ? 1 : 0);
            $oModel->alterar();
            echo "<script>
                alert('Pergunta alterada com sucesso.');
            </script>";
            require_once "view/view_admin.php";
            $view = new viewAdmin();
            $view->execute();    
        }

    }
?>