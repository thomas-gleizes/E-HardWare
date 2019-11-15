<?php

require_once ("../model/ModelRecherche.php");
class ControllerRecherche{
    public static function afficherRecherch(){
        $tab = ModelRecherche::afficherRecherche($_POST);
        $string = implode($tab);
        header("");
    }
}
