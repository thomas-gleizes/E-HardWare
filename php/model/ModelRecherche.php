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
        $sql ="";
        $requete = "";
        $valeur  = [];//array(
            //"nom" => "%".$nom."%"
            //"marque" => $marque,
            //"categorie" => $categorie
        //);
        if ($prix == 1){
            echo"1";
            if($marque==null && $categorie==null){
                $requete = "SELECT * FROM Produits where nom like :nom ";
                $valeur["nom"] = "%".$nom."%";
            }
            if($marque==null && $categorie!=null){
                $requete = "SELECT * FROM :categorie c JOIN Produits p on p.refProduit = c.refProduit where p.nom like :nom";
                $valeur["nom"] = "%".$nom."%";
                $valeur["categorie"] = $categorie;
            }
            if($marque!=null && $categorie == null){
                $requete = "SELECT * FROM Produits where nomMarque =:marque  and  nom like :nom";
                $valeur["nom"] = "%".$nom."%";
                $valeur["marque"] = $marque;
            }
            if($marque!=null && $categorie != null){
                $requete = "SELECT * FROM Produits p JOIN :categorie ca ON ca.refProduit = p.refProduit WHERE p.nomMarque = :marque  AND p.nom like :nom";
                $valeur["nom"] = "%".$nom."%";
                $valeur["categorie"] = $categorie;
                $valeur["marque"] = $marque;
            }
            $sql = $requete." GROUP BY(Produits.refProduit) ORDER BY Produits.prix ASC";

        }
        if ($prix == 2){
            //echo"2";
            if($marque==null && $categorie==null){
                $requete = "SELECT * FROM Produits p where nom like :nom ";
                $valeur["nom"] = "%".$nom."%";
            }
            if($marque==null && $categorie!=null){
                $requete = "SELECT * FROM :categorie c JOIN Produits p on p.refProduit = c.refProduit where p.nom like :nom";
                $valeur["nom"] = "%".$nom."%";
                $valeur["categorie"] = $categorie;
            }
            if($marque!=null && $categorie == null){
                $requete = "SELECT * FROM Produits p where nomMarque =:marque  and  nom like :nom";
                $valeur["nom"] = "%".$nom."%";
                $valeur["marque"] = $marque;
            }
            if($marque!=null && $categorie != null){
                $requete = "SELECT * FROM Produits p JOIN :categorie ca ON ca.refProduit = p.refProduit WHERE p.nomMarque = :marque AND p.nom like :nom";
                $valeur["nom"] = "%".$nom."%";
                $valeur["categorie"] = $categorie;
                $valeur["marque"] = $marque;
            }
            $sql = $requete." GROUP BY(p.refProduit) ORDER BY p.prix DESC";

        } if($prix == null) {

            if($marque==null && $categorie==null){
                //echo"3.1";
                $requete = "SELECT * FROM Produits where nom like :nom ";
                $valeur["nom"] = "%".$nom."%";
            }
            if($marque==null && $categorie!=null){
                // echo"3.2";
                $requete = "SELECT * FROM :categorie c JOIN Produits p on p.refProduit = c.refProduit where p.nom like :nom";
                $valeur["nom"] = "%".$nom."%";
                $valeur["categorie"] = $categorie;
            }
            if($marque!=null && $categorie == null){
                //echo"3.3";
                $requete = "SELECT * FROM Produits where nomMarque =:marque  and  nom like :nom";
                $valeur["nom"] = "%".$nom."%";
                $valeur["marque"] = $marque;
            }
            if($marque!=null && $categorie != null){
                //echo"3.4";
                $requete = "SELECT * FROM Produits p JOIN :categorie ca ON ca.refProduit = p.refProduit WHERE p.nomMarque = :marque  AND p.nom like :nom";
                $valeur["nom"] = "%".$nom."%";
                $valeur["categorie"] = $categorie;
                $valeur["marque"] = $marque;
            }
            $sql=$requete;
            //echo $sql;
        }
        //echo "$sql <br>";
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($valeur);
        $rec_prep->setFetchMode(PDO::FETCH_CLASS,"ModelRecherche");
        $tab = $rec_prep->fetchAll();
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