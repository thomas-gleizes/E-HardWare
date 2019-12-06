<?php

File::build_path(array('model','ModelRecherche.php'));

class ControllerRecherche{
    public static function afficherRecherche(){
        //var_dump($_GET);
        $tab = ModelRecherche::afficheRechercheComplexe($_GET["research"],$_GET["prix"],$_GET["marque"],$_GET["categorie"]);
        $tabvaleur = ModelRecherche::getAllinfo($tab);
        //var_dump($tabvaleur);
        File::build_path(array('view','vueRecherche.php'));

    }

    public static function rechercheVide(){
        File::build_path(array('view','vueRecherche.php'));


        $tabvaleur = [];
        require_once ("../view/vueRecherche.php");
    }

    public static function rechercherSidebar(){
        $tab = ModelRecherche::infoSidebar($_GET["categorie"]);
        $tabvaleur = ModelRecherche::getAllInfo($tab);
        File::build_path(array('view','vueRecherche.php'));

    }
}