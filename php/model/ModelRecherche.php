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
        $sql ="";
        $requete = "";
        if ($prix == 1){
            if($marque==null && $categorie==null){
                return $tab;
            } else if($marque==null && $categorie!=null){
                $requete = "SELECT * FROM $categorie c JOIN Produits p on p.refProduit = c.refProduit where p.nom like '%$nom%'";
            } else if($marque!=null && $categorie == null){
                $requete = "SELECT * FROM Produit where marque =$marque and  nom like '%$nom%'";
            } else if($marque!=null && $categorie != null){
                $requete = "SELECT * FROM Produit p JOIN $categorie ca ON ca.refProduit = p.refProduit WHERE p.nomMarque = $marque AND p.nom like '%$nom%'";
            }
            //echo "prix = 1".$categorie;
            $sql = $requete." GROUP BY(p.refProduit) ORDER BY p.prix ASC";
        } else if ($prix == 2){
            if($marque==null && $categorie==null){
                return $tab;
            } else if($marque==null && $categorie!=null){
                $requete = "SELECT * FROM $categorie c JOIN Produits p on p.refProduit = c.refProduit where p.nom like '%$nom%'";
            } else if($marque!=null && $categorie == null){
                $requete = "SELECT * FROM Produit where marque =$marque and  nom like '%$nom%'";
            } else if($marque!=null && $categorie != null){
                $requete = "SELECT * FROM Produit p JOIN $categorie ca ON ca.refProduit = p.refProduit WHERE p.nomMarque = $marque AND p.nom like '%$nom%'";
            }
            //echo "prix = 2".$categorie;
            $sql = $requete." GROUP BY(p.refProduit) ORDER BY p.prix DESC";
        } else {
            if($marque==null && $categorie==null){
                return $tab;
            } else if($marque==null && $categorie!=null){
                $requete = "SELECT * FROM $categorie c JOIN Produits p on p.refProduit = c.refProduit where p.nom like '%$nom%'";
            } else if($marque!=null && $categorie == null){
                $requete = "SELECT * FROM Produit where marque =$marque and  nom like '%$nom%'";
            } else if($marque!=null && $categorie != null){
                $requete = "SELECT * FROM Produit p JOIN $categorie ca ON ca.refProduit = p.refProduit WHERE p.nomMarque = $marque AND p.nom like '%$nom%'";
            }
        }
        echo $sql;
        //echo  "prix = 0".$categorie;
        $rep = Model::$pdo->query($requete);
        $rep->setFetchMode(PDO::FETCH_ASSOC);
        $tab = $rep->fectAll();
        return $tab;
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