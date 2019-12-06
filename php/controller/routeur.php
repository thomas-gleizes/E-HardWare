<?php
    File::build_path(array('ControllerRecherche.php'));
    File::build_path(array('ControllerUtilisateur.php'));
    File::build_path(array('ControllerProduit.php'));
    File::build_path(array('ControllerCommande.php'));
    File::build_path(array('ControllerPanier.php'));
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
            ControllerCommande::createOrder();
        } else if ($_POST['action'] == 'ajoutReview'){
            ControllerProduit::addReview();
        } else if ($_POST['action'] == 'infoVueProduit'){
            ControllerProduit::infoVueProduit();
        } else if ($_POST['action'] == 'del'){
            ControllerPanier::deletePanier();
        } else  if ($_POST['action'] == 'Panier'){
            ControllerPanier::displayPanier();
        } else {
            $action = $_POST["action"];
            ControllerUtilisateur::$action();
        }
    }
?>
