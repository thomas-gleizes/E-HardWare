<?php
require_once (File::build_path(array('model','Model.php')));

class ModelCommande{

    public static function CreateOrder($tab){
        $sql = "INSERT INTO Commandes VALUES ('', :date, :idClient, '', '', 'En attente')";
        $value = array(
            "date" => $tab['date'],
            "idClient" => $tab['idClient'],
        );
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($value);
    }

    public static function getLastIdCommandes($idClient){
        $sql = "SELECT LAST_INSERT_ID(idCommande) as ID FROM Commandes WHERE idClient = :idClient;";
        $value['idClient'] = $idClient;
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($value);
        $rec_prep->setFetchMode(PDO::FETCH_ASSOC);
        $tab = $rec_prep->fetchAll();
        foreach ($tab as $item) {
            $ID = $item['ID'];
        }
        return $ID;
    }

    public static function addOrder($idCommande, $refProduit, $quantite){
        $sql = "INSERT INTO ListeCommander VALUES (:idCommande, :refProduit, :quantite)";
        $value['idCommande'] = $idCommande;
        $value['refProduit'] = $refProduit;
        $value['quantite'] = $quantite;
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($value);
    }

    public static function getOrder($idClient){
        $sql = "SELECT * FROM Commandes WEHRE idClient = :idClient GROUP BY (etatCommande);";
        $value['idClient'] = $idClient;
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($value);
        $rec_prep->setFetchMode(PDO::FETCH_ASSOC);
        $tab = $rec_prep->fetchAll();
        return $tab;
    }



}