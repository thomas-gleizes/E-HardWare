<?php

require_once ('../model/Model.php');
class ModelPanier{

    public static function getPanier($idClient){
        $sql = "SELECT pa.refProduit, pa.quantiteProduit , nom, nomMarque, Url, prix, categorie FROM Panier pa, Produits p WHERE pa.refProduit = p.refProduit AND pa.idClient = :idClient;";
        $value['idClient'] = $idClient;
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($value);
        $rec_prep->setFetchMode(PDO::FETCH_ASSOC);
        $tab = $rec_prep->fetchAll();
        return $tab;
    }

    public static function getNbProduit ($idClient){
        $sql = "SELECT idClient, nbProduitPanier FROM Clients WHERE idClient = :idClient;";
        $value['idClient'] = $idClient;
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($value);
        $rec_prep->setFetchMode(PDO::FETCH_ASSOC);
        $tab = $rec_prep->fetchAll();
        return $tab;
    }

    public static function deletePanier($idClient, $refProduit){
        $sql = "DELETE FROM Panier WHERE idClient = :idClient AND refProduit = :refProduit;)";
        $value['idClient'] = $idClient;
        $value['refProduit'] = $refProduit;
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($value);
    }

    public static function insertPanier($idClient, $refProduit, $quantite){
        $sql = "INSERT INTO Panier VALUES (:idClient, :refProduit, :quantite)";
        $value['idClient'] = $idClient;
        $value['refProduit'] = $refProduit;
        $value['quantite'] = $quantite;
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($value);
    }

    public static function deleteAllPanier($idClient){
        $sql = "DELETE FROM Panier WHERE idClient = :idClient;)";
        $value['idClient'] = $idClient;
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($value);
    }






}