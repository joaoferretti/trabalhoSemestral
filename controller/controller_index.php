<?php 

    class controllerIndex {

        public function execute() {
            require_once "view/view_index.php";
            $view = new viewIndex();
            $view->execute();
        }

    }

?>