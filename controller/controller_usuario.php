<?php 

    //Responsável por mapear as interações com modelo e views de usuário
    class ControllerUsuario {

        public function listar() {
            require_once "view/view_listar_usuario.php";
            $view = new viewListarUsuario();
            $view->execute();
        }

        public function criar() {
            require_once "view/view_novo_usuario.php";
            $view = new viewNovoUsuario();
            $view->execute();
        }

        public function gravar() {
            require_once "model/model_usuario.php";
            $model = new Usuario();
            $model->setData($_POST);
            $model->update();
        }

    }
?>