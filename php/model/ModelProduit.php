<?php
require_once ('../model/Model.php');

class ModelProduit {

    public static function ajouterPanier ($tab){

        $sql = "INSERT INTO Panier VALUES (:idClient, :idProduit, quantite)";
        $valeur = array(
            "idClient" => $tab['id'],
            "idProduit" => $tab['ref'],
            "quantite" => $tab['quantite'],
        );
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($valeur);
    }





}