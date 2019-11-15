<?php
    require_once ('ControllerRecherche.php');
    if(!$_GET==null){
        $action = $_GET["action"];
        controller::$action();
    }
?>
