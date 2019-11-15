<?php
require_once ('../model/Model.php');

class ModelRecherche{

    public static function afficherRecherche($nom/*,$prix,$marque,$categorie*/){
        $sql = "SELECT * FROM Produits where nom like :nom ";
        $valeur  =array(
            "nom" => "%".$nom."%"
            /*"prix" => $prix,
            "marque" => $marque,
            "categorie" => $categorie*/
        );
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($valeur);
        $rec_prep->setFetchMode(PDO::FETCH_COLUMN,0);
        $tab = $rec_prep->fetchAll();
        var_dump($tab);
        if(empty($tab))
            return null;
        return $tab;
    }

    public static function requeteComplexe($categorie,$marque,$prix){
        $sql = "";
    }
}