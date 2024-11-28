<?php 

    class ControllerLogin {

        public function criar() {
            require_once "view/view_login.php";
            $view = new viewLogin();
            $view->execute();
        }

        public function execute() {
            require_once "model/model_usuario.php";
            $oModel = new modelUsuario();
            
            if($oModel->validaLogin($_POST['username'], $_POST['senha'])) {
                require_once "view/view_admin.php";
                $view = new viewAdmin();
                $view->execute();    
            } else {
                echo "Erro";
            }
        }

    }
?>