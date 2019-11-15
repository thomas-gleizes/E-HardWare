<?php
    require_once ('ControllerRecherche.php');
    if(!$_GET==null){
        $action = $_GET["action"];
        ControllerRecherche::$action();
    }
if(!$_POST==null){
    $action = $_POST["action"];
    ControllerRecherche::$action();
}
?>
