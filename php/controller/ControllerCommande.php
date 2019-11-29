<?php

require_once ("../model/ModelCommande.php");
require_once ("../model/ModelUtilisateur.php");

class ControllerCommande {

    public static function createOrder(){
        sesssion_start();
        $tab = [];
        $tab['date'] = date("o-n-t");
        $tab['idClient'] = ModelUtilisateur::getIdUti($_SESSION['login']);
        ModelCommande::CreateOrder($tab);
    }

}