<?php
require_once ('../model/Model.php');

class ModelRecherche{

    public static function afficherRecherche($nom){
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
        //var_dump($tab);
        if(empty($tab))
            return null;
        return $tab;
    }

    public static function afficheRechercheComplexe($nom,$prix,$marque,$categorie){
        $tab = self::afficherRecherche($nom);
        $requete = "";
        if ($prix == 1){
            if($marque==null && $categorie==null){
                return $tab;
            }
            if($marque!=null && $categorie == null){
            } else if($marque==null && $categorie!=null){
                $requete = "SELECT * FROM $categorie c JOIN Produits p on p.refProduit = c.refProduit where p.nom like %.$nom.%";
            } else if($marque!=null && $categorie == null){
                $requete = "SELECT * FROM Produit where marque =$marque and  nom like %.$nom.%";
            } else if($marque!=null && $categorie != null){
                $requete = "SELECT * FROM Produit p JOIN $categorie ca ON ca.refProduit = p.refProduit WHERE p.nomMarque = $marque AND p.nom like %.$nom.%";
            }
            $sql = $requete."GROUP BY(refProduit), ORDER BY ASC";
        } else if ($prix == 2){
            $sql = "SELECT * FROM Produits WHERE $requete GROUP BY(refProduit), ORDER BY DESC";
        } else {
            $sql = "SELECT * FROM Produits WHERE requete = x";
        }
    }

    public static function getAllInfo($ref){
        $tab= [];
        foreach ($ref as $value){
            $sql = "SELECT * FROM Produits where refProduit = :ref";
            $valeur = array(
                "ref"=> $value
            );
            $rec_prep = Model::$pdo->prepare($sql);
            $rec_prep->execute($valeur);
            $rec_prep->setFetchMode(PDO::FETCH_ASSOC);
            $tab = array_merge($tab,$rec_prep->fetchAll());
        }
        return $tab;
    }
}