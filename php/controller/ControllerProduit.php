<?php

require_once(File::build_path(array('model','ModelProduit.php')));
require_once (File::build_path(array('model','ModelUtilisateur.php')));
class ControllerProduit{


    public static function ajouterPanier (){

        $tab = [];
        $tab['ref'] = $_POST['ref'];
        $tab['id'] = ControllerUtilisateur::getId();
        $tab['quantite'] = $_POST['quantite'];

        ModelProduit::ajouterPanier($tab);

        require_once (File::build_path(array('view','vueCommande.php')));

    }

    public static function supprimemrPanier(){

        $tab = [];
        $tab['ref'] = $_POST['ref'];
        $tab['id'] = ControllerUtilisateur::getId();

        ModelProduit::supProdPanier($tab);
    }

    public static function supprAllProdPanier (){
        $id = ControllerUtilisateur::getId();
        ModelProduit::supprAllProdPanier($id);
    }

    public static function ajoutProduit (){

        $categorie = $_POST['categorie'];

        $tabProd = [];
        $tabProd['nom'] = $_POST['nom'];
        $tabProd['nomMarque'] = $_POST['nomMarque'];
        $tabProd['categorie'] = $categorie;
        $tabProd['prix'] = $_POST['prix'];
        $tabProd['stock'] = $_POST['stock'];
        $tabProd['Url'] = $_POST['Url'];

        ModelProduit::insertProduit($tabProd);

        $tab = [];
        $tab['refProduit'] = ModelProduit::getIdProduit($tabProd['nom']);


        if ($categorie == 'Processeur'){
            $tab['nbCoeur'] = $_POST['nbCoeur'];
            $tab['nbThreads'] = $_POST['nbThreads'];
            $tab['socket'] = $_POST['socket'];
            $tab['frequence'] = $_POST['frequence'];
            $tab['boost'] = $_POST['boost'];
            $tab['cache'] = $_POST['cache'];
            ModelProduit::insertProcesseur($tab);

        } else if ($categorie == 'CarteGraphique'){
            $tab['chipset'] = $_POST['chipset'];
            $tab['memoire'] = $_POST['memoire'];
            $tab['architecture'] = $_POST['architecture'];
            $tab['bus'] = $_POST['bus'];
            ModelProduit::insertCarteGraphique($tab);

        } else if ($categorie == 'CarteMere'){
            $tab['chipset'] = $_POST['chipset'];
            $tab['architecture'] = $_POST['architecture'];
            $tab['socket'] = $_POST['socket'];
            $tab['format'] = $_POST['format'];
            ModelProduit::insertCarteMere($tab);

        } else if ($categorie == 'DisqueDur'){
            $tab['capacite'] = $_POST['capacite'];
            $tab['interface'] = $_POST['interface'];
            $tab['vitesseRotation'] = $_POST['vitesseRotation'];
            ModelProduit::insertDisqueDur($tab);

        } else if ($categorie == 'Memoire'){
            $tab['typ'] = $_POST['typ'];
            $tab['capacite'] = $_POST['capacite'];
            $tab['frequence'] = $_POST['frequence'];
            $tab['CAS'] = $_POST['CAS'];
            $tab['nbBarrette'] = $_POST['nbBarrette'];
            ModelProduit::insertMemoire($tab);

        } else if ($categorie == 'SSD') {
            $tab['format'] = $_POST['format'];
            $tab['capacite'] = $_POST['capacite'];
            $tab['interface'] = $_POST['interface'];
            $tab['lecture'] = $_POST['lecture'];
            $tab['ecriture'] = $_POST['ecriture'];
            ModelProduit::insertSSD($tab);

        } else if ($categorie == "Alimentation"){
            $tab['puissance'] = $_POST['puissance'];
            $tab['modularite'] = $_POST['modularite'];
            ModelProduit::insertAlimentation($tab);

        }
        $tabvaleur = [];

        require_once (File::build_path(array('view','vueRecherche.php')));
    }


    public static function infoVueProduit(){


        $tab = ModelProduit::getProduit($_POST['id_produit']);
        if ($tab[0]['categorie'] == 'Processeur'){
            $tabProd = ModelProduit::getProcesseur($_POST['id_produit']);
        } else if ($tab[0]['categorie'] == 'CarteGraphique'){
            $tabProd = ModelProduit::getCarteGraphique($_POST['id_produit']);
        } else if ($tab[0]['categorie'] == 'CarteMere'){
            $tabProd = ModelProduit::getCarteMere($_POST['id_produit']);
        } else if ($tab[0]['categorie'] == 'Memoire'){
            $tabProd = ModelProduit::getMemoire($_POST['id_produit']);
        } else if ($tab[0]['categorie'] == 'DisqueDur'){
            $tabProd = ModelProduit::getDisqueDur($_POST['id_produit']);
        } else if ($tab[0]['categorie'] == 'SSD'){
            $tabProd = ModelProduit::getSSD($_POST['id_produit']);
        } else if ($tab[0]['categorie'] == 'Alimentation') {
            $tabProd = ModelProduit::getAlimentation($_POST['id_produit']);
        }


        $tabReview = ModelProduit::getReview($_POST['id_produit']);
        $avr = round(ModelProduit::markAverage($_POST['id_produit']),2);


        if (session_status() == PHP_SESSION_NONE) {
            session_name("mlsfhvliusqfrbguilqdfjlqhdf");
            session_start();
        }

        if (isset($_SESSION['login'])){
            $login = $_SESSION['login'];
            $nbAvis = ModelProduit::countReview(ModelUtilisateur::getIdUti($_SESSION['login']),$_POST['id_produit']);
        } else {
            $login = "lkf,nd¤&\"&é";
            $nbAvis = 0;
        }
        require_once (File::build_path(array('view','vueProduit.php')));
    }

    public static function displayReview(){
        $ref = $_POST['refProduit'];
        $tab = ModelProduit::review($ref);
    }

    public static function addReview (){
        if (session_status() == PHP_SESSION_NONE) {
            session_name("mlsfhvliusqfrbguilqdfjlqhdf");
            session_start();
        }
        if ($_POST['note'] > 5){
            $note = 5;
        } else if ($_POST['note'] < 0){
            $note = 0;
        } else {
            $note = $_POST['note'];
        }
        $tab = [];
        $tab['idClient'] = ModelUtilisateur::getIdUti($_SESSION['login']);
        //var_dump($tab);
        $tab['refProduit'] = $_POST['id_produit'];
        $tab['note'] = $note;
        $tab['commentaire'] = $_POST['commentaire'];
        $tab['date'] = date("o-n-d");
        if (ModelProduit::countReview($tab['idClient'], $tab['refProduit']) == 0){
            ModelProduit::insertReview($tab);
        }
        self::infoVueProduit();
    }

    public static function supprProduit(){
        ModelProduit::deleteProduit($_POST['id_produit']);
        require_once (File::build_path(array('view','vueRecherche.php')));
    }

    public static function changerPrix(){
        ModelProduit::upDatePrice($_POST['id_produit'], $_POST['price']);
        self::infoVueProduit();
    }

    public static function changerNom(){
        ModelProduit::upDateName($_POST['id_produit'], $_POST['name']);
        self::infoVueProduit();
    }

    public static function ajouterStock(){
        ModelProduit::upDateStock($_POST['id_produit'], $_POST['stock']);
        self::infoVueProduit();
    }

    public static function supprReview (){
        ModelProduit::deleteReview($_POST['idClient'], $_POST['id_produit']);
        self::infoVueProduit();
    }



}