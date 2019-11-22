<?php
    require_once ('ControllerRecherche.php');
    require_once ('ControllerUtilisateur.php');
    if(!$_GET==null){
        if ($_GET['action'] == "actionExt"){
            ControllerUtilisateur::myaccount();
        } else {
            $action = $_GET["action"];
            ControllerRecherche::$action();
        }

    }
    if(!$_POST==null){
        $action = $_POST["action"];
        ControllerUtilisateur::$action();
    }
?>
