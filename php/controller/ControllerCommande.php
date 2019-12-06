<?php

require_once ("../model/ModelCommande.php");
require_once ("../model/ModelUtilisateur.php");
require_once ("../model/ModelPanier.php");

class ControllerCommande {

    public static function getOrder(){
        session_start();

    }

    public static function createOrder(){
        sesssion_start();
        $tab = [];
        $tab['date'] = date("o-n-t");
        $tab['idClient'] = ModelUtilisateur::getIdUti($_SESSION['login']);
        ModelCommande::CreateOrder($tab);
        ModelPanier::deleteAllPanier($tab['idClient']);
    }


}