<?php
    require_once('../lib/File.php');
    require_once (File::build_path(array('controller','ControllerRecherche.php')));
    require_once (File::build_path(array('controller','ControllerUtilisateur.php')));
    require_once (File::build_path(array('controller','ControllerProduit.php')));
    require_once (File::build_path(array('controller','ControllerCommande.php')));
    require_once (File::build_path(array('controller','ControllerPanier.php')));
    if(!$_GET==null){
        if ($_GET['action'] == "actionExt"){
            ControllerUtilisateur::myaccount();
        }else if ($_GET['action'] == "ajax") {
            $action = $_GET["control"];
            ControllerAjax::$action();
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
