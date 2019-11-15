<?php

require_once ("../model/ModelUtilisateur.php");

class ControllerUtilisateur{

    public static function creation(){
        $tab = [];
        $tab['email'] = $_POST['mail'];

        ModelUtilisateur::creationCompte($tab);

        require_once ("../view/vueRecherche.php");
    }

    public static function connection(){
        $tab = [];
        $tab['email'] = $_POST['mail'];
        $tab['mot de passe'] = ModelUtilisateur::['mot de passe'];


        ModelUtilisateur::connectionCompte($tab);
        require_once ("../view/vueRecherche.php");
    }


}
