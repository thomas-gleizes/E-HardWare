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

        $mail = $tab['mail'];
        $code = ModelUtilisateur::getCodeConf($mail);
        $message = "Veuillez confirmer votre inscription sur E-HardWare sur le lien suivant vue.php,  avec le code suivant : $code .\n Merci de votre Inscription.";
        $header = "From : " . "thomas.gleizes@etu.umontpellier.fr";
        mail($mail,'Demande de confirmation de confirmation E-HardWare.', $message, $header);

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

    public static function Valider(){

        $tab['codeConf'] = $_POST['codeConf'];
        $tab['mail'] = $_POST['mail'];

        ModelUtilisateur::validerCompte($tab);
    }


}
