<?php
require_once ('../model/Model.php');
require_once ('../lib/Security.php');

class ModelUtilisateur{

    public static function creationCompte($tab){
        $mdp = ModelUtilisateur::chiffrer($tab['mdp'].Security::getSeed());
        $sql = "INSERT INTO Clients values( '',:mail,:nom,:prenom,:ville,:adresse,0,0,0,:mdp,0) ";
        $valeur  =array(
            "mail" => $tab['mail'],
            "nom" => $tab['nom'],
            "prenom" => $tab['prenom'],
            "ville" => $tab['ville'],
            "adresse" => $tab['adresse'],
            "mdp" => $mdp
        );
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($valeur);
        $mail = $tab['mail'];
        $sql = "CALL GenereCodeConfirmation('$mail')";
        $stmt = Model::$pdo->prepare($sql);
        $stmt->execute();

        session_start();
        $_SESSION['login'] = $mail;
        $_SESSION['admin'] = 0;
    }

    public static function connectionCompte($tab){
        $mail = $tab['mail'];
        $rep = Model::$pdo->query("SELECT mdp FROM Clients WHERE Email = '$mail'");
        $rep -> setFetchMode(PDO::FETCH_CLASS, 'Client');
        $res = $rep->fetchAll(PDO::FETCH_ASSOC);
        $mdp = ModelUtilisateur::chiffrer($tab['mdp'].Security::getSeed());
        $rep1 = Model::$pdo->query("SELECT prioriter FROM Clients WHERE Email = '$mail'");
        $rep1 -> setFetchMode(PDO::FETCH_CLASS, 'Client');
        $res1 = $rep1->fetchAll(PDO::FETCH_ASSOC);
        session_start();
        $_SESSION['login'] = $mail;
        $_SESSION['admin'] = $res1[0]['prioriter'];
        if ($res[0]['mdp'] == $mdp){
            return true;
        } else {
            return false;
        }
    }

    public static function editCompte($tab){
        $sql = "UPDATE Clients SET Email = :mail, villeClient = :ville, adresseClient = :adresse where idClient = :id";
        $valeur  =array(
            "mail" => $tab['mail'],
            "ville" => $tab['ville'],
            "adresse" => $tab['adresse'],
            "id" => $tab['id']
        );
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($valeur);
        $_SESSION['login'] = $tab['mail'];
    }

    public static function chiffrer($mdp){
        $mdp_chiffre = hash('sha256', $mdp);
        return $mdp_chiffre;
    }

    public static function getCodeConf($mail){
        $rep = Model::$pdo->query("SELECT codeConfirmation FROM Clients Where Email = '$mail'");
        $rep -> setFetchMode(PDO::FETCH_CLASS, 'Client');
        $res = $rep->fetchAll(PDO::FETCH_ASSOC);
        return $res[0]['codeConfirmation'];
    }

    public static function validerCompte($tab){

        $mail = tab['mail'];
        $code = self::getCodeConf($mail);

        if ($code[0]['codeConfirmation'] == tab['codeConf']){
            return true;
            $sql = 'UPDATE Clients SET codeConfirmation = 1 WHERE Email = $mail';
            $valeur  = array(
                "mail" => $tab['mail']
            );
            $rec_prep = Model::$pdo->prepare($sql);
            $rec_prep->execute($valeur);
        } else {
            return false;
        }

    }



}