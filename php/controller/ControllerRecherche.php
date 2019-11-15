<?php

require_once ("../model/ModelRecherche.php");
class ControllerRecherche{
    public static function afficherRecherche(){
        //var_dump($_GET);
        $tab = ModelRecherche::afficherRecherche($_GET["research"]);
        $url = "";

        require_once ("../view/vueRecherche.php");
    }
}
