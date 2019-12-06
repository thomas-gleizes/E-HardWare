<?php

File::build_path(array('model','ModelPanier.php'));
File::build_path(array('model','ModelProduit.php'));
File::build_path(array('model','ModelUtilisateur.php'));

class ControllerPanier{

    public static function addPanier(){
        session_start();
        ModelPanier::insertPanier(ModelUtilisateur::getIdUti($_SESSION['login']),$_POST['id_produit'],$_POST['quantite']);
        $tab = ModelPanier::getPanier(ModelUtilisateur::getIdUti($_SESSION['login']));
        setcookie("panier",$tab['quantiteProduit'],time()+time()+31570000);
        require_once ('../view/vueRecherche.php?action=afficherRecherche&prix=&marque=&categorie=&research=');
    }

    public static function displayPanier(){


        if(!isset($_SESSION)){
            session_start();
        }
        if(isset($_SESSION['login'])){
            $idClient = ModelUtilisateur::getIdUti($_SESSION['login']);
            $tab = ModelPanier::getPanier($idClient);
        }
        $tab = [];
        require_once ('../view/vueCommande.php');
    }

    public static function deletePanier(){
        session_start();
        $idClient = ModelUtilisateur::getIdUti($_SESSION['login']);
        ModelPanier::deletePanier($idClient, $_POST['id_produit']);
        $tab = ModelPanier::getPanier($idClient);
        require_once ('../view/vueCommande.php');
    }

}