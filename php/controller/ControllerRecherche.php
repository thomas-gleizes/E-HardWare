<?php

File::build_path(array('model','ModelRecherche.php'));
require_once ("../model/ModelPanier.php");
require_once ("../model/ModelUtilisateur.php");
class ControllerRecherche{
    public static function afficherRecherche(){
        if(!isset($_SESSION)){
            session_start();
        }
        //var_dump($_GET);
        $tab = ModelRecherche::afficheRechercheComplexe($_GET["research"],$_GET["prix"],$_GET["marque"],$_GET["categorie"]);
        $tabvaleur = ModelRecherche::getAllinfo($tab);
        $id = ModelUtilisateur::getIdUti($_SESSION['login']);
        $valCookie = ModelPanier::getNbProduit($id);
        $valCookie = $valCookie[0]['nbProduitPanier'];
        require_once ("../view/vueRecherche.php");
    }

    public static function rechercheVide(){
        if(!isset($_SESSION)){
            session_start();
        }
        $tabvaleur = [];
        $id = ModelUtilisateur::getIdUti($_SESSION['login']);
        $valCookie = ModelPanier::getNbProduit($id);
        $valCookie = $valCookie[0]['nbProduitPanier'];
        require_once ("../view/vueRecherche.php");
    }

    public static function rechercherSidebar(){
        if(!isset($_SESSION)){
            session_start();
        }
        $tab = ModelRecherche::infoSidebar($_GET["categorie"]);
        $tabvaleur = ModelRecherche::getAllInfo($tab);
        $id = ModelUtilisateur::getIdUti($_SESSION['login']);
        $valCookie = ModelPanier::getNbProduit($id);
        $valCookie = $valCookie[0]['nbProduitPanier'];
        require_once ("../view/vueRecherche.php");
    }
}