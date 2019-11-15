<?php
    require_once ('ControllerVoiture.php');
    if(!$_GET==null){
        $action = $_GET["action"];
        controller::$action();
    }
?>
