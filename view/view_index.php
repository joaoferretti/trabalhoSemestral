<?php 

    class viewIndex {

        public function execute() {
            Application::getInstance()->displayFile("view/res/view_index.html");
        }

    }

?>