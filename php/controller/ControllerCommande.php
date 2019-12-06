<?php

require_once(File::build_path(array('model','ModelCommande.php')));
require_once(File::build_path(array('model','ModelUtilisateur.php')));
require_once(File::build_path(array('model','ModelPanier.php')));

class ControllerCommande {

    public static function DisplayOrder(){

        if (isset($_SESSION['login'])){
            $idClient = ModelUtilisateur::getIdUti($_SESSION['login']);
            $tab = ModelCommande::getOrder($idClient);
            $tabClient = ModelUtilisateur::getInfoCommande($idClient);
        } else {
            $tab = [];
            $tabClient = [];
        }
        require_once (File::build_path(array('view','historique')));
    }


    public static function createOrder(){

        if (!isset($_SESSION['login'])){
            session_start();
        }
        $tab = [];
        $tab['date'] = date("o-n-d");
        $tab['idClient'] = ModelUtilisateur::getIdUti($_SESSION['login']);
        ModelCommande::CreateOrder($tab);
        $idCommande = ModelCommande::getLastIdCommandes($tab['idClient']);
        $tabref = ModelPanier::getRefproduit($tab['idClient']);
        foreach ($tabref as $value){
            echo $value['refProduit'];
            echo "= refProduit <br>";
            echo $value['quantiteProduit'];
            echo "= Quantiter <br>";
            ModelCommande::addOrder($idCommande, $value['refProduit'], $value['quantiteProduit']);
        }
        ModelPanier::deleteAllPanier($tab['idClient']);
    }


}