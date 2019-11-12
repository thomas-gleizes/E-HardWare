<?php
require_once ('../model/Model.php');

class ModelRecherche{

    public static function afficherRecherche($val){
        $sql = "SELECT * FROM Produits where nom like '%':val'l%'";
        $valeur  =array(
            "val" => $val
        );
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($valeur);
        $rec_prep->setFecthMode(PDO::FETCH_COLUMN,1);
        $tab = $rec_prep->fetchAll();
        if(empty($tab))
            return null;
        return $tab;
    }

}