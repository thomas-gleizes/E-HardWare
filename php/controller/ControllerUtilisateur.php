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
        //mail(tab['mail'],'Demande de confirmation de compte E-HardComerce.');
        header('Location:../view/compteCréé.php');
    }

    public static function connection(){
        $tab = [];
        $tab['mail'] = $_POST['mail'];
        $tab['mdp'] = $_POST['mdp'];

        if (ModelUtilisateur::connectionCompte($tab)) {
            header('Location:../../index.php');
        } else {
            require("../view/connection.php");
        }

    }


}
