<?php

require_once(File::build_path(array('model','ModelCommande.php')));
require_once(File::build_path(array('model','ModelUtilisateur.php')));
require_once(File::build_path(array('model','ModelPanier.php')));

class ControllerCommande {

    public static function DisplayOrder(){
        session_name("mlsfhvliusqfrbguilqdfjlqhdf");
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
        session_name("mlsfhvliusqfrbguilqdfjlqhdf");
        if (!isset($_SESSION['login'])){
            session_start();
        }
        $tab = [];
        $tab['date'] = date("o-n-d");
        $tab['idClient'] = ModelUtilisateur::getIdUti($_SESSION['login']);
        if (ModelUtilisateur::getNbProdPanier($tab['idClient']) > 0){
            ModelCommande::CreateOrder($tab);
            $idCommande = ModelCommande::getLastIdCommandes($tab['idClient']);
            $tabref = ModelPanier::getRefproduit($tab['idClient']);
            foreach ($tabref as $value){
                ModelCommande::addOrder($idCommande, $value['refProduit'], $value['quantiteProduit']);
            }
            ModelPanier::deleteAllPanier($tab['idClient']);
        } else {
            require_once (File::build_path(array('view','vueRecherche.php')));
        }
    }

    public static function displayAllOrder(){
        session_name("mlsfhvliusqfrbguilqdfjlqhdf");
        if (!isset($_SESSION['login'])){
            session_start();
        }
        $idClient = ModelUtilisateur::getIdUti($_SESSION['login']);
        $tab = ModelCommande::getAllOrder($idClient);
        require_once (File::build_path(array('view','vueHistorique.php')));
    }

}