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
            $resClient = ModelUtilisateur::myaccount();
            require ("../view/account.php");
        } else {
            header("Location:../view/connection.php?mail=".$tab['mail']);
        }
    }

    public static function Valider(){

        session_start();
        $tab['codeConf'] = $_POST['codeConf'];
        $tab['mail'] = $_SESSION['login'];

        ModelUtilisateur::validerCompte($tab);
    }

    public static function edit(){
        $tab = [];
        $tab['id'] = $_POST['id'];
        $tab['mail'] = $_POST['mail'];
        $tab['adresse'] = $_POST['adresse'];
        $tab['ville'] = $_POST['ville'];

        ModelUtilisateur::editCompte($tab);

        header('Location:../view/account.php');

    }

    public static function disconnect(){
        session_start();
        session_unset();
        session_destroy();

        header('Location:../../index.php');
    }

    public static function reValiderMail($mail){
        $code = ModelUtilisateur::getCodeConf($mail);
        $lien = 'http://webinfo.iutmontp.univ-montp2.fr/~gleizest/Cours/php/ProjetPHP/php/view/account.php';
        $message = "Veuillez confirmez votre changement de mail en entrant le code suivant : $code dans le liens suivant $lien";
        $header = 'From : " . "thomas.gleizes@etu.umontpellier.fr';
        mail($mail, 'Demande de reConfirmation de Email suite a un chengement de celui-ci',$message,$header);
    }

    public static function validation(){
        $code = $_POST['code'];
        if(ModelUtilisateur::validerCompte($code)){
            header('Location:../view/account.php');
        } else {
            header('Location:../view/account.php?error=1');
        }
    }

    public static function changerMdp(){
        $tab = [];
        $tab['id'] = $_POST['id'];
        $tab['mail'] = $_POST['mail'];

        ModelUtilisateur::mailMdp($tab);
    }

    public static function myaccount(){


        $resClient = ModelUtilisateur::myaccount();

        require_once ("../view/account.php");
    }
























}