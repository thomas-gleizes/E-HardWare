<?php
require_once ('../model/Model.php');

class ModelAjax{

    public static function add($id){
        $sql = "SELECT nom, stock, prix, Url FROM Produits WHERE refProduit = :id";
        $value = array(
            "id" => $id
        );
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($value);
        $tab = $rec_prep->fetchAll(PDO::FETCH_ASSOC);
        return $tab;
    }

    public static function card(){
        $rep = Model::$pdo->query("SELECT refProduit, nom, nomMarque, prix, Url  FROM Produits WHERE stock > 0 ORDER BY RAND() LIMIT 12");
        $rep->setFetchMode(PDO::FETCH_CLASS, 'nomMarque');
        $tab = $rep->fetchAll(PDO::FETCH_ASSOC);
        return $tab;
    }

    public static function result($result){
        $sql = ("SELECT nom,refProduit FROM Produits WHERE nom like :result");
        $value = array(
            "result" => "%".$result."%"
        );
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($value);
        $rec_prep->setFetchMode(PDO::FETCH_ASSOC);
        $tab = $rec_prep->fetchAll();
        return $tab;
    }

    public static function marque(){
        $rep = Model::$pdo->query("SELECT nomMarque FROM Produits GROUP BY (nomMarque);");
        $rep->setFetchMode(PDO::FETCH_CLASS, 'nomMarque');
        $tab = $rep->fetchAll(PDO::FETCH_ASSOC);
        return $tab;
    }
}
