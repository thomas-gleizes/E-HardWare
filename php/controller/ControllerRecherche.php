<?php

require_once ("../model/ModelRecherche.php");
class ControllerRecherche{
    public static function afficherRecherche(){
        $tab = ModelRecherche::afficheRechercheComplexe($_GET["research"],$_GET["prix"],$_GET["marque"],$_GET["categorie"]);
        $tabvaleur = ModelRecherche::getAllinfo($tab);
        require_once ("../view/vueRecherche.php");
    }

    public static function rechercheVide(){
        require_once ("../view/vueRecherche.php");
    }
}
