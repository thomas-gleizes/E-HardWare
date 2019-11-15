<?php

require_once ("../model/ModelUtilisateur.php");

class ControllerUtilisateur{

    public static function creation(){
        $tab = [];
        $tab['email'] = $_POST['mail'];

        ModelUtilisateur::creationCompte($tab);

        require_once ("../view/vueRecherche.php");
    }
}
