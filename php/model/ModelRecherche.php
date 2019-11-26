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
        $valeur = [];
        $valeur["nom"] = $nom;
        if ($prix == 1){
            echo"1";
            if($marque==null && $categorie==null){
                $requete = "SELECT * FROM Produits where nom like :nom ";
            }
            if($marque==null && $categorie!=null){
                $requete = "SELECT * FROM :categorie c JOIN Produits p on p.refProduit = c.refProduit where p.nom like :nom";
                $valeur["categorie"] = $categorie;
            }
            if($marque!=null && $categorie == null){
                $requete = "SELECT * FROM Produits where nomMarque =:marque and  nom like :nom";
                $valeur["marque"] = $marque;
            }
            if($marque!=null && $categorie != null){
                $requete = "SELECT * FROM Produits p JOIN :categorie ca ON ca.refProduit = p.refProduit WHERE p.nomMarque = :marque AND p.nom like :nom";
                $valeur["marque"] = $marque;
                $valeur["categorie"] = $categorie;
            }
            $sql = $requete." GROUP BY(Produits.refProduit) ORDER BY Produits.prix ASC";

        }
        if ($prix == 2){
            //echo"2";
            if($marque==null && $categorie==null){
                $requete = "SELECT * FROM Produits p where nom like :nom ";
            }
            if($marque==null && $categorie!=null){
                $requete = "SELECT * FROM :categorie c JOIN Produits p on p.refProduit = c.refProduit where p.nom like :nom";
                $valeur["categorie"] = $categorie;
            }
            if($marque!=null && $categorie == null){
                $requete = "SELECT * FROM Produits p where nomMarque =:marque and  nom like :nom";
                $valeur["marque"] = $marque;
            }
            if($marque!=null && $categorie != null){
                $requete = "SELECT * FROM Produits p JOIN :categorie ca ON ca.refProduit = p.refProduit WHERE p.nomMarque = :marque AND p.nom like :nom";
                $valeur["marque"] = $marque;
                $valeur["categorie"] = $categorie;
            }
            $sql = $requete." GROUP BY(p.refProduit) ORDER BY p.prix DESC";

        } if($prix == null) {

            if($marque==null && $categorie==null){
                //echo"3.1";
                $requete = "SELECT * FROM Produits where nom like :nom ";
            }
            if($marque==null && $categorie!=null){
                // echo"3.2";
                $requete = "SELECT * FROM :categorie c JOIN Produits p on p.refProduit = c.refProduit where p.nom like :nom";
                $valeur["categorie"] = $categorie;
            }
            if($marque!=null && $categorie == null){
                //echo"3.3";
                $requete = "SELECT * FROM Produits where nomMarque =:marque and  nom like :nom";
                $valeur["marque"] = $marque;
            }
            if($marque!=null && $categorie != null){
                //echo"3.4";
                $requete = "SELECT * FROM Produits p JOIN :categorie ca ON ca.refProduit = p.refProduit WHERE p.nomMarque = :marque AND p.nom like :nom";
                $valeur["marque"] = $marque;
                $valeur["categorie"] = $categorie;
            }
            $sql=$requete;
            //echo $sql;
        }
        //echo "$sql <br>";
        //var_dump($tab);

        $rep = Model::$pdo->prepare($sql);
        $rep->execute($valeur);
        $rep->setFetchMode(PDO::FETCH_CLASS,"ModelRecherche");
        $tab = $rep->fetchAll();
        if(empty($tab))
            return null;
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

    public static function trie($indicetri,$tab){
        $trie = [];
        if ($indicetri ==1){
            foreach ($tab as $value){
                $trie = array_merge($trie, sort($value, 0));
            }
        }
        if ($indicetri ==2){
            foreach ($tab as $value){
                $trie = array_merge($trie, rsort($value, 0));
            }
        }
        return $trie;
    }
}