<?php

require_once(File::build_path(array('model','ModelCommande.php')));
require_once(File::build_path(array('model','ModelUtilisateur.php')));
require_once(File::build_path(array('model','ModelPanier.php')));

class ControllerCommande {

    public static function DisplayOrder(){
        if (session_status() == PHP_SESSION_NONE) {
            session_name("mlsfhvliusqfrbguilqdfjlqhdf");
            session_start();
        }
        $tab = ModelCommande::getProdOrder($_POST['idCommande']);
        $tabClient = ModelCommande::getInfoCommande($_POST['idCommande']);
        require_once (File::build_path(array('view','vueCommandeHistorique.php')));
    }


    public static function createOrder(){
        if (session_status() == PHP_SESSION_NONE) {
            session_name("mlsfhvliusqfrbguilqdfjlqhdf");
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
                $stock = ModelProduit::getStock($value['refProduit']);
                if ($stock > $value['quantiteProduit']){
                    ModelCommande::addOrder($idCommande, $value['refProduit'], $stock);
                    ModelPanier::deletePanier($tab['idClient'], $value['refProduit']);
                } else if ($stock > 0){
                    ModelCommande::addOrder($idCommande, $value['refProduit'], $value['quantiteProduit']);
                    ModelPanier::deletePanier($tab['idClient'], $value['refProduit']);
                }
            }
            self::displayAllOrder();
        } else {
            require_once (File::build_path(array('view','vueRecherche.php')));
        }
    }
/*
$sql = "CALL GenereCodeConfirmation('$mail')";
$stmt = Model::$pdo->prepare($sql);
$stmt->execute();*/

    public static function displayAllOrder(){
        if (session_status() == PHP_SESSION_NONE) {
            session_name("mlsfhvliusqfrbguilqdfjlqhdf");
            session_start();
        }
        $idClient = ModelUtilisateur::getIdUti($_SESSION['login']);
        $tab = ModelCommande::getAllOrder($idClient);
        require_once (File::build_path(array('view','vueHistorique.php')));
    }

}