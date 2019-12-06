<?php

require_once ("./../model/ModelPanier.php");
require_once ("./../model/ModelUtilisateur.php");
require_once ("./../model/ModelProduit.php");
class ControllerPanier{

    public static function addPanier(){
        session_start();
        ModelPanier::insertPanier(ModelUtilisateur::getIdUti($_SESSION['login']),$_POST['id_produit'],$_POST['quantite']);
        require_once ('../view/vueRecherche.php?action=afficherRecherche&prix=&marque=&categorie=&research=');
    }

    public static function displayPanier(){

        session_start();
        $idClient = ModelUtilisateur::getIdUti($_SESSION['login']);
        $tab = ModelPanier::getPanier($idClient);
        require_once ('../view/vuePanier.php');
    }

    public static function deletePanier(){
        session_start();
        $idClient = ModelUtilisateur::getIdUti($_SESSION['login']);
        ModelPanier::deletePanier($idClient, $_POST['id_produit']);
        $tab = ModelPanier::getPanier($idClient);
        require_once ('../view/vuePanier.php');
    }

}