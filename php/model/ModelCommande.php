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

    public static function addOrder($tab){
        $sql = "INSERT INTO ListeCommander VALUES (:idCommande, :refProduit, :quantite)";
        $value = array(
            "idCommande" => $tab['idCommande'],
            'refProduit' => $tab['refProduit'],
            'quantite' => $tab['quantite'],
        );
        $rec_prep = Model::$pdo->preapre($sql);
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