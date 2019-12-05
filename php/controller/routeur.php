<?php
    require_once ('ControllerRecherche.php');
    require_once ('ControllerUtilisateur.php');
    require_once ('ControllerProduit.php');
    require_once ('ControllerCommande.php');
    if(!$_GET==null){
        if ($_GET['action'] == "actionExt"){
            ControllerUtilisateur::myaccount();
        } else {
            $action = $_GET["action"];
            ControllerRecherche::$action();
        }

    }
    if(!$_POST==null){
        if ($_POST['action'] == 'ajoutProduit') {
            ControllerProduit::ajoutProduit();
        } else if ($_POST['action'] == "createOrder") {
            $action = $_POST['action'];
            ControllerCommande::createOrder();
        } else if ($_POST['action'] == 'ajoutReview'){
            ControllerProduit::addReview();
        } else if ($_POST['action'] == 'infoVueProduit'){
            ControllerProduit::infoVueProduit();
        } else {
            $action = $_POST["action"];
            ControllerUtilisateur::$action();
        }
    }
?>
