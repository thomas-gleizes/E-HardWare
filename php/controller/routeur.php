<?php
    require_once ('ControllerRecherche.php');
    require_once ('ControllerUtilisateur.php');
    if(!$_GET==null){
        $action = $_GET["action"];
        ControllerRecherche::$action();
    }
if(!$_POST==null){
    $action = $_POST["action"];
    ControllerUtilisateur::$action();
}
?>
