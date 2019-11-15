<?php

require_once ("../model/ModelUtilisateur.php");

class ControllerUtilisateur{

    public static function creation(){
        $tab = [];
        $tab['email'] = $_POST['mail'];
        $tab['nom'] = $_POST['nom'];
        $tab['prenom'] = $_POST['prenom'];
        $tab['mdp'] = $_POST['mdp'];
        $tab['adresse'] = $_POST['adresse'];

        ModelUtilisateur::creationCompte($tab);
        header('Location:../view/vueRecherche.php');
    }

    public static function connection(){
        $tab = [];
        $tab['email'] = $_POST['mail'];
        $tab['mot de passe'] = $_POST['mot de passe'];

        ModelUtilisateur::connectionCompte($tab);
        require_once ("../view/vueRecherche.php");
    }


}
