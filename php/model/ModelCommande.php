<?php
require_once ('../model/Model.php');

class ModelCommande{

    public static function CreateOrder ($tab){
        $sql = "INSERT INTO Commandes VALUES ('', :date, :idClient, '', '', 'En attente')";
        $value = array(
            "date" => $tab['date'],
            "idClient" => $tab['idClient'],
        );
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($value);
    }



}