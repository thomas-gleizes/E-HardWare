<?php
    require_once('../lib/File.php');
    require_once (File::build_path(array('controller','ControllerRecherche.php')));
    require_once (File::build_path(array('controller','ControllerUtilisateur.php')));
    require_once (File::build_path(array('controller','ControllerProduit.php')));
    require_once (File::build_path(array('controller','ControllerCommande.php')));
    require_once (File::build_path(array('controller','ControllerPanier.php')));
    require_once (File::build_path(array('controller','ControllerAjax.php')));
    if(!$_GET==null){
        if ($_GET['action'] == "actionExt"){
            try {
                ControllerUtilisateur::myaccount();
            } catch (Exception $e) {
                header('Location: ../view/vueErreur.php');
            }
        }else if ($_GET['action'] == "ajax") {
            try {
                $action = $_GET["control"];
                ControllerAjax::$action();
            } catch (Exception $e) {
                header('Location: ../view/vueErreur.php');
            }
        } else if ($_GET['action'] == 'panier') {
            try {
                ControllerPanier::displayPanier();
            } catch (Exception $e) {
                header('Location: ../view/vueErreur.php');
            }
        } else if ($_GET['action'] == 'askChangeMdp') {
            try {
                ControllerUtilisateur::askChangeMdp();
            } catch (Exception $e) {
                header('Location: ../view/vueErreur.php');
            }
        } else if ($_GET['action'] == 'VueProduit'){
            try {
                ControllerProduit::infoVueProduit();
            } catch (Exception $e) {
                header('Location: ../view/vueErreur.php');
            }
        } else {
            try {
                $action = $_GET["action"];
                ControllerRecherche::$action();
            } catch (Exception $e) {
                header('Location: ../view/vueErreur.php');
            }
        }
    }

    if(!$_POST==null){
        if ($_POST['action'] == 'ajoutProduit') {
            try {
                ControllerProduit::ajoutProduit();
            } catch (Exception $e) {
                header('Location: ../view/vueErreur.php');
            }
        } else if ($_POST['action'] == "createOrder") {
            try {
                ControllerCommande::createOrder();
            } catch (Exception $e) {
                header('Location: ../view/vueErreur.php');
            }
        } else if ($_POST['action'] == 'ajoutReview'){
            try {
                ControllerProduit::addReview();
            } catch (Exception $e) {
                header('Location: ../view/vueErreur.php');
            }
        } else if ($_POST['action'] == 'infoVueProduit'){
            try {
                ControllerProduit::infoVueProduit();
            } catch (Exception $e) {
                header('Location: ../view/vueErreur.php');
            }
        } else if ($_POST['action'] == 'del'){
            try {
                ControllerPanier::deletePanier();
            } catch (Exception $e) {
                header('Location: ../view/vueErreur.php');
            }
        } else  if ($_POST['action'] == 'Panier'){
            try {
                ControllerPanier::displayPanier();
            } catch (Exception $e) {
                header('Location: ../view/vueErreur.php');
            }
        } else if ($_POST['action'] == 'order') {
            try {
                ControllerCommande::createOrder();
            } catch (Exception $e) {
                header('Location: ../view/vueErreur.php');
            }
        } else if ($_POST['action'] == 'ajoutPanier') {
            try {
                ControllerPanier::ajoutPanier();
            } catch (Exception $e) {
                header('Location: ../view/vueErreur.php');
            }
        } else if ($_POST['action'] == 'stock'){
            try {
                ControllerProduit::ajouterStock();
            } catch (Exception $e) {
                header('Location: ../view/vueErreur.php');
            }
        } else if ($_POST['action'] == 'name'){
            try {
                ControllerProduit::changerNom();
            } catch (Exception $e) {
                header('Location: ../view/vueErreur.php');
            }
        } else if ($_POST['action'] == 'prix') {
            try {
                ControllerProduit::changerPrix();
            } catch (Exception $e) {
                header('Location: ../view/vueErreur.php');
            }
        } else if ($_POST['action'] == 'supprProduit') {
            try {
                ControllerProduit::supprProduit();
            } catch (Exception $e) {
                header('Location: ../view/vueErreur.php');
            }
        } else if ($_POST['action'] == 'commande') {
            try {
                ControllerCommande::displayAllOrder();
            } catch (Exception $e) {
                header('Location: ../view/vueErreur.php');
            }
        } else if ($_POST['action'] == 'affCommande') {
            try {
                ControllerCommande::DisplayOrder();
            } catch (Exception $e) {
                header('Location: ../view/vueErreur.php');
            }
        } else if ($_POST['action'] == 'supprReview') {
            try {
                ControllerProduit::supprReview();
            } catch (Exception $e) {
                header('Location: ../view/vueErreur.php');
            }
        } else {
            try {
                $action = $_POST["action"];
                ControllerUtilisateur::$action();
            } catch (Exception $e) {
                header('Location: ../view/vueErreur.php');
            }
        }
    }

    if ($_GET==null && $_POST==null){
        header('Location: ../view/vueErreur.php');
    }
?>
