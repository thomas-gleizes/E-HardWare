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
        if ($_POST['action'] == "ajoutProduit") {
            $action = $_POST["action"];
            ControllerProduit::ajoutProduit();
        } else {
            $action = $_POST["action"];
            ControllerUtilisateur::$action();
        }
    }
?>
