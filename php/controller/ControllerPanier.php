<?php

require_once(File::build_path(array('model','ModelPanier.php')));
require_once(File::build_path(array('model','ModelProduit.php')));
require_once(File::build_path(array('model','ModelUtilisateur.php')));
require_once(File::build_path(array('controller','ControllerUtilisateur.php')));

class ControllerPanier{

    public static function addPanier(){
        if (session_status() == PHP_SESSION_NONE) {
            session_name("mlsfhvliusqfrbguilqdfjlqhdf");
            session_start();
        }
        ModelPanier::insertPanier(ModelUtilisateur::getIdUti($_SESSION['login']),$_POST['id_produit'],$_POST['quantite']);
        $tab = ModelPanier::getPanier(ModelUtilisateur::getIdUti($_SESSION['login']));
        setcookie("panier",$tab['quantiteProduit'],time()+time()+31570000);

        require_once (File::build_path(array('view','vueCommande')));
    }

    public static function ajoutPanier(){
        $id = ControllerUtilisateur::getId();
        $nb = ModelPanier::verifprodPanier($_POST['id_produit'], $id);
        if ($nb == 0){
            ModelPanier::ajoutPanier($_POST["id_produit"],$_POST["nombre"],$id);
        } else {
            ModelPanier::upDatePanier($_POST['id_produit'],$id,$_POST['nombre']);
        }
        header("Location:./routeur.php?action=panier");
        //SELF::displayPanier(); // ajouter les produit au panier a chaque refresh de la page))
    }

    public static function displayPanier(){
        if (session_status() == PHP_SESSION_NONE) {
            session_name("mlsfhvliusqfrbguilqdfjlqhdf");
            session_start();
        }
        if(isset($_SESSION['login'])){
            $idClient = ModelUtilisateur::getIdUti($_SESSION['login']);
            $tab = ModelPanier::getPanier($idClient);
            $tabClient = ModelUtilisateur::getInfoCommande($idClient);
            $code = ModelUtilisateur::getCodeConf($_SESSION['login']);
        } else {
            $tab = [];
            $tabClient = [];
            $code = 0;
        }
        require_once (File::build_path(array('view','vueCommande.php')));
    }

    public static function deletePanier(){
        if (session_status() == PHP_SESSION_NONE) {
            session_name("mlsfhvliusqfrbguilqdfjlqhdf");
            session_start();
        }
        if (isset($_SESSION['login'])){
            $idClient = ModelUtilisateur::getIdUti($_SESSION['login']);
            ModelPanier::deletePanier($idClient, $_POST['id_produit']);
            $tab = ModelPanier::getPanier($idClient);
            $tabClient = ModelUtilisateur::getInfoCommande($idClient);
            $code = ModelUtilisateur::getCodeConf($_SESSION['login']);
        } else {
            $tab = [];
            $tabClient = [];
            $code = 0;
        }
        require_once (File::build_path(array('view','vueCommande.php')));
    }

}