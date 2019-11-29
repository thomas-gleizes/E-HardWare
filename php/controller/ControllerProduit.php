<?php

require_once ("../model/ModelProduit.php");
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
        echo $tab['refProduit'];

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
        header('Location:../view/vueRecherche.php?action=rechercheVide');
    }


    public static function infoVueProduit(){
        $tab = ModelProduit::infoVueProduit($_POST['id_produit']);
        //$tab += ModelProduit::getInfoCate($_POST['id_produit'],$tab[0]['categorie']);
        require_once ('../view/vueProduit.php');
    }


}