<?php

require_once ("../model/ModelPrduit.php");
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


}