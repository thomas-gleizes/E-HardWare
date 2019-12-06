<?php

require_once(File::build_path(array('model','ModelCommande.php')));
require_once(File::build_path(array('model','ModelUtilisateur.php')));
require_once(File::build_path(array('model','ModelPanier.php')));

class ControllerCommande {

    public static function DisplayOrder(){
        session_start();
        $idClient = ModelUtilisateur::getIdUti($_SESSION['login']);
        $tab = ModelCommande::getOrder($idClient);
        require_once ("../view/historique");
    }


    public static function createOrder(){
        sesssion_start();
        $tab = [];
        $tab['date'] = date("o-n-d");
        $tab['idClient'] = ModelUtilisateur::getIdUti($_SESSION['login']);
        ModelCommande::CreateOrder($tab);
        ModelPanier::deleteAllPanier($tab['idClient']);
    }


}