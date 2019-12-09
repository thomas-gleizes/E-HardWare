<?php

require_once (File::build_path(array('model','ModelRecherche.php')));
require_once (File::build_path(array('model','ModelPanier.php')));
require_once (File::build_path(array('model','ModelUtilisateur.php')));

class ControllerRecherche{
    public static function afficherRecherche(){
        session_name("mlsfhvliusqfrbguilqdfjlqhdf");
        if(!isset($_SESSION)){
            session_start();
        }
        $tab = ModelRecherche::afficheRechercheComplexe($_GET["research"],$_GET["prix"],$_GET["marque"],$_GET["categorie"]);
        $tabvaleur = ModelRecherche::getAllinfo($tab);
        if(isset($_SESSION['login'])){
            $id = ModelUtilisateur::getIdUti($_SESSION['login']);
            $valCookie = ModelPanier::getNbProduit($id);
            $valCookie = $valCookie[0]['nbProduitPanier'];
        }

        require_once (File::build_path(array('view','vueRecherche.php')));
    }

    public static function rechercheVide(){
        session_name("mlsfhvliusqfrbguilqdfjlqhdf");
        if(!isset($_SESSION)){
            session_start();
        }
        $tabvaleur = [];
        $id = ModelUtilisateur::getIdUti($_SESSION['login']);
        $valCookie = ModelPanier::getNbProduit($id);
        $valCookie = $valCookie[0]['nbProduitPanier'];
        require_once (File::build_path(array('view','vueRecherche.php')));
    }

    public static function rechercherSidebar(){
        session_name("mlsfhvliusqfrbguilqdfjlqhdf");
        if(!isset($_SESSION)){
            session_start();
        }
        $tab = ModelRecherche::infoSidebar($_GET["categorie"]);
        $tabvaleur = ModelRecherche::getAllInfo($tab);
        $id = ModelUtilisateur::getIdUti($_SESSION['login']);
        $valCookie = ModelPanier::getNbProduit($id);
        $valCookie = $valCookie[0]['nbProduitPanier'];
        require_once (File::build_path(array('view','vueRecherche.php')));
    }
}