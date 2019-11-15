<?php

require_once ("../model/ModelRecherche.php");
class ControllerRecherche{
    public static function afficherRecherche(){
        $tab = ModelRecherche::afficherRecherche($_POST);
        $string = implode($tab);
        header("");
    }
}
