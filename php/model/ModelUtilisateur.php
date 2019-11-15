<?php
require_once ('../model/Model.php');

class ModelUtilisateur{

    public static function creationCompte($tab){

    }

    public static function connectionCompte($tab){

    }

    public function chiffrer ($mdp){
        $mdp_chiffre = hash('sha256', $mdp);
        return $mdp_chiffre;
    }

}