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
            echo"1";
            if($marque==null && $categorie==null){
                $requete = "SELECT * FROM Produits where nom like '%$nom%' ";
            }
            if($marque==null && $categorie!=null){
                $requete = "SELECT * FROM $categorie c JOIN Produits p on p.refProduit = c.refProduit where p.nom like '%$nom%'";
            }
            if($marque!=null && $categorie == null){
                $requete = "SELECT * FROM Produits where nomMarque ='$marque' and  nom like '%$nom%'";
            }
            if($marque!=null && $categorie != null){
                $requete = "SELECT * FROM Produits p JOIN $categorie ca ON ca.refProduit = p.refProduit WHERE p.nomMarque = '$marque' AND p.nom like '%$nom%'";
            }
            $sql = $requete." GROUP BY(p.refProduit) ORDER BY p.prix ASC";

        }
        if ($prix == 2){
            //echo"2";
            if($marque==null && $categorie==null){
                $requete = "SELECT * FROM Produits where nom like '%$nom%' ";
            }
            if($marque==null && $categorie!=null){
                $requete = "SELECT * FROM $categorie c JOIN Produits p on p.refProduit = c.refProduit where p.nom like '%$nom%'";
            }
            if($marque!=null && $categorie == null){
                $requete = "SELECT * FROM Produits where nomMarque ='$marque' and  nom like '%$nom%'";
            }
            if($marque!=null && $categorie != null){
                $requete = "SELECT * FROM Produits p JOIN $categorie ca ON ca.refProduit = p.refProduit WHERE p.nomMarque = '$marque 'AND p.nom like '%$nom%'";
            }
            $sql = $requete." GROUP BY(p.refProduit) ORDER BY p.prix DESC";

        } if($prix == null) {

            if($marque==null && $categorie==null){
                //echo"3.1";
                $requete = "SELECT * FROM Produits where nom like '%$nom%' ";
            }
            if($marque==null && $categorie!=null){
               // echo"3.2";
                $requete = "SELECT * FROM $categorie c JOIN Produits p on p.refProduit = c.refProduit where p.nom like '%$nom%'";
            }
            if($marque!=null && $categorie == null){
                //echo"3.3";
                $requete = "SELECT * FROM Produits where nomMarque ='$marque' and  nom like '%$nom%'";
            }
            if($marque!=null && $categorie != null){
                //echo"3.4";
                $requete = "SELECT * FROM Produits p JOIN $categorie ca ON ca.refProduit = p.refProduit WHERE p.nomMarque = '$marque' AND p.nom like '%$nom%'";
            }
            $sql=$requete;
            //echo $sql;
        }
        //echo "$sql <br>";
        $rep = Model::$pdo->query($requete);
        $rep->setFetchMode(PDO::FETCH_ASSOC);
        $tab = $rep->fetchAll();
        //var_dump($tab);
        return $tab;
    }

    public static function getAllInfo($ref){
        $tab= [];
        foreach ($ref as $value){
            foreach ($value as $v) {
                $sql = "SELECT * FROM Produits where refProduit = :ref";
                $valeur = array(
                    "ref" => $v
                );
                $rec_prep = Model::$pdo->prepare($sql);
                $rec_prep->execute($valeur);
                $rec_prep->setFetchMode(PDO::FETCH_ASSOC);
                $tab = array_merge($tab, $rec_prep->fetchAll());
            }
        }
        return $tab;
    }
}