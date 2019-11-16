<?php
require_once ('../model/Model.php');
require_once ('../lib/Security.php');

class ModelUtilisateur{

    public static function creationCompte($tab){
        $mdp = ModelUtilisateur::chiffrer($tab['mdp'].Security::getSeed());
        $sql = "INSERT INTO Clients values( '',:mail,:nom,:prenom,:ville,:adresse,0,0,0,:mdp) ";
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
    }

    public static function connectionCompte($tab){
        $mail = $tab['mail'];
        $rep = Model::$pdo->query("SELECT mdp FROM Clients WHERE Email = '$mail'");
        $rep -> setFetchMode(PDO::FETCH_CLASS, 'Client');
        $res = $rep->fetchAll(PDO::FETCH_ASSOC);
        $mdp = ModelUtilisateur::chiffrer($tab['mdp'].Security::getSeed());
        if ($res[0]['mdp'] == $mdp){
            return true;
        } else {
            return false;
        }
    }

    public static function chiffrer($mdp){
        $mdp_chiffre = hash('sha256', $mdp);
        return $mdp_chiffre;
    }

}