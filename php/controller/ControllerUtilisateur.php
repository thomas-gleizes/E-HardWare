<?php

require_once ("../model/ModelUtilisateur.php");

class ControllerUtilisateur{

    public static function creation(){
        $tab = [];
        $tab['mail'] = $_POST['mail'];
        $tab['nom'] = $_POST['nom'];
        $tab['prenom'] = $_POST['prenom'];
        $tab['mdp'] = $_POST['mdp'];
        $tab['adresse'] = $_POST['adresse'];
        $tab['ville'] = $_POST['ville'];

        ModelUtilisateur::creationCompte($tab);
        header('Location:../view/vueRecherche.php');
    }

    public static function connection(){
        $tab = [];
        $tab['mail'] = $_POST['mail'];
        $tab['mdp'] = $_POST['mdp'];

        if (ModelUtilisateur::connectionCompte($tab)) {
            echo "mdp bon";
        } else {
            echo 'mdp pas bon';
        }

    }


}
