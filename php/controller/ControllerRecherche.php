<?php

require_once ("../model/ModelRecherche.php");
class ControllerRecherche{
    public static function afficherRecherch(){
        var_dump($_POST);
        $tab = ModelRecherche::afficherRecherche($_POST);
        $string = implode($tab);
        header("");
    }
}
