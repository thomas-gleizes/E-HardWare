<?php

require_once (File::build_path(array('model','ModelUtilisateur.php')));
require_once (File::build_path(array('controller','ControllerPanier.php')));

class ControllerUtilisateur{

    public static function creation(){

        $tab = [];
        $tab['mail'] = $_POST['mail'];
        $tab['nom'] = $_POST['nom'];
        $tab['prenom'] = $_POST['prenom'];
        $tab['mdp1'] = $_POST['mdp1'];
        $tab['mdp2'] = $_POST['mdp2'];
        $tab['adresse'] = $_POST['adresse'];
        $tab['ville'] = $_POST['ville'];
        if (self::containsEmoji($_POST['mail']) || self::containsEmoji($_POST['nom']) || self::containsEmoji($_POST['prenom']) || self::containsEmoji($_POST['mdp1']) || self::containsEmoji($_POST['adresse']) || self::containsEmoji($_POST['ville'])){
            header("Location:../view/creation.php?mail=".$tab['mail']."&nom=".$tab['nom']."&prenom=".$tab['prenom']."&adresse=".$tab['adresse']."&ville=".$tab['ville']."&error=4");
        } else if (self::verifEmail($_POST['mail'])) {
            header("Location:../view/creation.php?mail=".$tab['mail']."&nom=".$tab['nom']."&prenom=".$tab['prenom']."&adresse=".$tab['adresse']."&ville=".$tab['ville']."&error=5");
        } else if (strlen($_POST['mdp1']) < 8) {
            header("Location:../view/creation.php?mail=".$tab['mail']."&nom=".$tab['nom']."&prenom=".$tab['prenom']."&adresse=".$tab['adresse']."&ville=".$tab['ville']."&error=3");
        } else if (strlen(trim($_POST['mail'])) == 0 || strlen(trim($_POST['nom'])) == 0 || strlen(trim($_POST['prenom'])) == 0 || strlen(trim($_POST['mdp1'])) == 0 || strlen(trim($_POST['adresse'])) == 0 || strlen(trim($_POST['ville'])) == 0){
            header("Location:../view/creation.php?mail=".$tab['mail']."&nom=".$tab['nom']."&prenom=".$tab['prenom']."&adresse=".$tab['adresse']."&ville=".$tab['ville']."&error=0");
        } else if (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
            header("Location:../view/creation.php?mail=".$tab['mail']."&nom=".$tab['nom']."&prenom=".$tab['prenom']."&adresse=".$tab['adresse']."&ville=".$tab['ville']."&error=2");
        } else if ($tab['mdp1'] == $tab['mdp2']){
            ModelUtilisateur::creationCompte($tab);
            $mail = $tab['mail'];
            $code = ModelUtilisateur::getCodeConf($mail);
            $message = "Veuillez confirmer votre inscription sur E-HardWare avec le code suivant : $code .\n Merci de votre Inscription. Dans le lien suivant: ";
            $lien = "http://webinfo.iutmontp.univ-montp2.fr/~savouretb/travail/ProjetPHP/php/view/account.php";
            $header = "From : " . "thomas.gleizes@etu.umontpellier.fr";
            mail($mail,'Demande de confirmation de confirmation E-HardWare.', $message.$lien, $header);
            header('Location:../view/compteCréé.php');
        } else {
            header("Location:../view/creation.php?mail=".$tab['mail']."&nom=".$tab['nom']."&prenom=".$tab['prenom']."&adresse=".$tab['adresse']."&ville=".$tab['ville']."&error=1");
        }


    }

    public static function connection(){
        $tab = [];
        $tab['mail'] = $_POST['mail'];
        $tab['mdp'] = $_POST['mdp'];
        if (isset($_POST['error'])){
            $_GET['error'] = $_POST['error'];
        }

        if (ModelUtilisateur::connectionCompte($tab)) {
            $resClient = ModelUtilisateur::myaccount();
            require ("../view/account.php");
        } else {
            header("Location:../view/connection.php?mail=".$tab['mail']);
        }
    }

    public static function Valider(){
        if (session_status() == PHP_SESSION_NONE) {
            session_name("mlsfhvliusqfrbguilqdfjlqhdf");
            session_start();
        }
        $tab['codeConf'] = $_POST['codeConf'];
        $tab['mail'] = $_SESSION['login'];

        ModelUtilisateur::validerCompte($tab);
    }

    public static function edit(){
        $tab = [];
        $tab['id'] = $_POST['id'];
        $tab['adresse'] = $_POST['adresse'];
        $tab['ville'] = $_POST['ville'];
        if (self::containsEmoji($_POST['mail']) || self::containsEmoji($_POST['nom']) || self::containsEmoji($_POST['prenom']) || self::containsEmoji($_POST['mdp1']) || self::containsEmoji($_POST['adresse']) || self::containsEmoji($_POST['ville'])){
            header("Location:../view/account.php?error=0");
        }  else if (strlen(trim($_POST['adresse'])) == 0 || strlen(trim($_POST['ville'])) == 0 ){
            header("Location:../view/account.php?error=1");
        } else {
            ModelUtilisateur::editCompte($tab);

            header('Location:../view/account.php');
        }


    }

    public static function verifEmail($mail){
        $BaseMail = ModelUtilisateur::verifEmail($mail);
        var_dump($BaseMail);
        if ($BaseMail > 0){
            return true;
        } else {
            return false;
        }
    }

    public static function disconnect(){
        if (session_status() == PHP_SESSION_NONE) {
            session_name("mlsfhvliusqfrbguilqdfjlqhdf");
            session_start();
        }
        session_unset();
        session_destroy();

        header('Location:../../index.php');
    }

    public static function validation(){
        $code = $_POST['code'];
        if(ModelUtilisateur::validerCompte($code)){
            header('Location:../view/account.php');
        } else {
            header('Location:../view/account.php?error=2');
        }
    }

    public static function askChangeMdp(){
        if (session_status() == PHP_SESSION_NONE) {
            session_name("mlsfhvliusqfrbguilqdfjlqhdf");
            session_start();
        }
        $token = ModelUtilisateur::securedLink();
        $lien = 'http://webinfo.iutmontp.univ-montp2.fr/~savouretb/travail/ProjetPHP/php/view/changePassword.php?token='.$token.'&mail='.$_SESSION['login'];
        $message = "pour changer le mot de passe cliquer sur le lien ci-dessous: \n $lien";
        $header = 'From : " . "thomas.gleizes@etu.umontpellier.fr';
        mail($_SESSION['login'], 'demande de changement de mot de passe',$message,$header);
        header('Location:../view/confirmationChanged.php');
    }

    public static function changePassword(){
        if (!isset($_POST['token'])){
            header('Location:../view/changePassword.php?error=2');
        } else if ($_POST['mdp1'] == $_POST['mdp2']){
            $id = ModelUtilisateur::getIdUti($_POST['mail']);
            if (ModelUtilisateur::getToken($id) == 0) {
                header('Location:../view/changePassword.php?error=3&token='.$_POST['token'].'&mail='.$_POST['mail']);
            } else if (ModelUtilisateur::getToken($id) == $_POST['token']){
                ModelUtilisateur::changePassword($id, $_POST['mdp1']);
                header('Location:../view/changePassword.php?success=1');
            } else {
                header('Location:../view/changePassword.php?error=1');
            }
        } else {
            header('Location:../view/changePassword.php?error=0&token='.$_POST['token'].'&mail='.$_POST['mail']);
        }
    }

    public static function myaccount(){
        $resClient = ModelUtilisateur::myaccount();
        require_once ("../view/account.php");
    }

    public static function getId(){
        session_name("mlsfhvliusqfrbguilqdfjlqhdf");
        session_start();
        if (session_status() == PHP_SESSION_NONE) {
            session_name("mlsfhvliusqfrbguilqdfjlqhdf");
            session_start();
        }
    }

    public static function containsEmoji( $string ) {
        preg_match( '/[\x{1F600}-\x{1F64F}]/u', $string, $matches_emo );
        return !empty( $matches_emo[0] ) ? true : false;
    }



























}