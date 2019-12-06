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
        $tab['refProduit'] = ModelProduit::getIdProduit($tabProd['nom'],$tabProd['categorie']);


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
        require_once ('../view/vueRecherche.php');
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
        session_start();
        if (isset($_SESSION['login'])){
            $nbAvis = true;
        } else {
            $nbAvis = ModelProduit::countReview(ModelUtilisateur::getIdUti($_SESSION['login']));
        }

        require_once ('../view/vueProduit.php');
    }

    public static function displayReview(){
        $ref = $_POST['refProduit'];
        $tab = ModelProduit::review($ref);
    }

    public static function addReview (){
        session_start();
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
        $tab['refProduit'] = $_POST['refProduit'];
        $tab['note'] = $note;
        $tab['commentaire'] = $_POST['commentaire'];
        $tab['date'] = date("o-n-d");
        ModelProduit::insertReview($tab);
        //SELF::infoVueProduit();
    }

        //header('Location:../view/vueRecherche.php?action=rechercheVide')


}