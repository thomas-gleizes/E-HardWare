<?php

require_once (File::build_path(array('model','ModelRecherche.php')));
require_once (File::build_path(array('model','ModelPanier.php')));
require_once (File::build_path(array('model','ModelUtilisateur.php')));

class ControllerRecherche{
    public static function afficherRecherche(){
        if (session_status() == PHP_SESSION_NONE) {
            session_name("mlsfhvliusqfrbguilqdfjlqhdf");
            session_start();
        }
        $tab2 = ModelRecherche::afficheRechercheComplexe($_GET["research"],$_GET["prix"],$_GET["marque"],$_GET["categorie"]);
        $tabvaleur = ModelRecherche::getAllinfo($tab2);
        /*if(isset($_SESSION['login'])){
            $id = ModelUtilisateur::getIdUti($_SESSION['login']);
            $valCookie = ModelPanier::getNbProduit($id);
            $valCookie = $valCookie[0]['nbProduitPanier'];
        }*/

        require_once (File::build_path(array('view','vueRecherche.php')));
    }

    public static function rechercheVide(){
        if (session_status() == PHP_SESSION_NONE) {
            session_name("mlsfhvliusqfrbguilqdfjlqhdf");
            session_start();
        }
        $tabvaleur = [];
        $id = ModelUtilisateur::getIdUti($_SESSION['login']);
        //$valCookie = ModelPanier::getNbProduit($id);
        //$valCookie = $valCookie[0]['nbProduitPanier'];
        require_once (File::build_path(array('view','vueRecherche.php')));
    }

    public static function rechercherSidebar(){
        if (session_status() == PHP_SESSION_NONE) {
            session_name("mlsfhvliusqfrbguilqdfjlqhdf");
            session_start();
        }
        $tab2 = ModelRecherche::infoSidebar($_GET["categorie"]);
        $tabvaleur = ModelRecherche::getAllInfo($tab2);
        $id = ModelUtilisateur::getIdUti($_SESSION['login']);
        //$valCookie = ModelPanier::getNbProduit($id);
        //$valCookie = $valCookie[0]['nbProduitPanier'];
        require_once (File::build_path(array('view','vueRecherche.php')));
    }
}