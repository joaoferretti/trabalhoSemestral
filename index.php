<?php
    require_once "lib/application.php";
    new Application();
    Application::getInstance()->route();
?>