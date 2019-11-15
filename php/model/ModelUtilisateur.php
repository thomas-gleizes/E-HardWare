<?php
require_once ('../model/Model.php');
require_once ('../lib/Security.php');

class ModelUtilisateur{

    public static function creationCompte($tab){
        $mdp = chiffrer($tab['mdp']).Security::getSeed();
        $sql = "INSERT INTO Clients values( null,:mail,:nom,:prenom,:ville,:adresse,0,0,0,:mdp) ";
        $valeur  =array(
            "mail" => $tab['mail'],
            "nom" => $tab['nom'],
            "prenom" => $tab['prenom'],
            "mdp" => $mdp,
            "adresse" => $tab['adresse'],

        );
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($valeur);
    }

    public static function connectionCompte($tab){
        $mail = $tab['Email'];
        $rep = Model::$pdo->query("SELECT mdp FROM Client WHERE Email = $mail");
        $rep -> setFetchMode(PDO::FETCH_CLASS, 'Client');
        $res = $rep->fetchAll(PDO::FETCH_ASSOC);
        $mdp = $tab['mot de passe'];

        $mdp = chiffrer($mdp);
        if ($res == $mdp){
            return true;
        } else {
            return false;
        }
    }

    public function chiffrer ($mdp){
        $mdp_chiffre = hash('sha256', $mdp);
        return $mdp_chiffre;
    }

}