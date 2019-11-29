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
        $valeur["nom"] = "%".$nom."%";
        if ($prix == 1){
            //echo"1";
            if($marque==null && $categorie==null){
                $requete = "SELECT Url,refProduit,nom,nomMarque,prix FROM Produits where nom like :nom ";
            }
            if($marque==null && $categorie!=null){
                echo"1.2";
                $requete = "SELECT Url,refProduit,nom,nomMarque,prix FROM Produits where categorie = :categorie AND nom like :nom";
                $valeur["categorie"] = $categorie;
            }
            if($marque!=null && $categorie == null){
                echo"1.3";
                $requete = "SELECT Url,refProduit,nom,nomMarque,prix FROM Produits where nomMarque = :marque and nom like :nom";
                $valeur["marque"] = $marque;
            }
            if($marque!=null && $categorie != null){
                echo"1.4";
                $requete = "SELECT Url,refProduit,nom,nomMarque,prix FROM Produits WHERE categorie = :categorie AND nomMarque = :marque AND nom like :nom";
                $valeur["marque"] = $marque;
                $valeur["categorie"] = $categorie;
            }
            $sql = $requete." GROUP BY(Produits.refProduit) ORDER BY Produits.prix ASC";

        }
        if ($prix == 2){
            //echo"2";
            if($marque==null && $categorie==null){
                echo"2.1";
                $requete = "SELECT Url,refProduit,nom,nomMarque,prix FROM Produits WHERE nom like :nom ";
            }
            if($marque==null && $categorie!=null){
                echo"2.2";
                $requete = "SELECT Url,refProduit,nom,nomMarque,prix FROM Produits WHERE categorie = :categorie AND nom like :nom";
            }
            if($marque!=null && $categorie == null){
                echo"2.3";
                $requete = "SELECT Url,refProduit,nom,nomMarque,prix FROM Produits WHERE nomMarque =:marque and nom like :nom";
                $valeur["marque"] = $marque;
            }
            if($marque!=null && $categorie != null){
                echo"2.4";
                $requete = "SELECT Url,refProduit,nom,nomMarque,prix FROM Produits WHERE nomMarque = :marque AND categorie = :categorie AND nom like :nom";
                $valeur["marque"] = $marque;
                $valeur["categorie"] = $categorie;
            }
            $sql = $requete." GROUP BY(Produits.refProduit) ORDER BY Produits.prix DESC";

        } if($prix == null) {

            if($marque==null && $categorie==null){
                echo"3.1";
                $requete = "SELECT Url,refProduit,nom,nomMarque,prix FROM Produits WHERE nom like :nom ";
            }
            if($marque==null && $categorie!=null){
                echo"3.2";
                $requete = "SELECT Url,refProduit,nom,nomMarque,prix FROM Produits WHERE categorie = :categorie AND nom like :nom";
                $valeur["categorie"] = $categorie;
            }
            if($marque!=null && $categorie == null){
                echo"3.3";
                $requete = "SELECT Url,refProduit,nom,nomMarque,prix FROM Produits WHERE nomMarque =:marque AND nom like :nom";
                $valeur["marque"] = $marque;
            }
            if($marque!=null && $categorie != null){
                echo"3.4";
                $requete = "SELECT Url,refProduit,nom,nomMarque,prix FROM Produits WHERE categorie = :categorie AND nomMarque = :marque AND nom like :nom";
                $valeur["marque"] = $marque;
                $valeur["categorie"] = $categorie;
            }
            $sql=$requete;
            //echo $sql;
        }
        echo "$sql <br>";


        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($valeur);
        $rec_prep->setFetchMode(PDO::FETCH_ASSOC);
        $tab = $rec_prep->fetchAll();
        return $tab;
    }

    public static function getAllInfo($ref){
        $tab= [];
        //var_dump($ref);
        foreach ($ref as $value){
            foreach ($value as $v) {
                $sql = "SELECT Url,refProduit,nom,nomMarque,prix FROM Produits where refProduit = :ref";
                $valeur = array(
                    "ref" => $v
                );
                $rec_prep = Model::$pdo->prepare($sql);
                $rec_prep->execute($valeur);
                $rec_prep->setFetchMode(PDO::FETCH_ASSOC);
                $tab = array_merge($tab, $rec_prep->fetchAll());
            }
        }
        //var_dump($tab);
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

    public static function infoSidebar($categorie){
        //$sql = "SELECT * FROM :categorie c JOIN Produits p on p.refProduit = c.refProduit where p.nom like %%";
        $sql = "SELECT Url,refProduit,nom,nomMarque,prix FROM Produits WHERE categorie = :categorie";
        $value["categorie"] = $categorie;
        //echo $categorie;
        //echo $sql;
        //var_dump($sql);

        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($value);
        $rec_prep->setFetchMode(PDO::FETCH_ASSOC);
        $tab = $rec_prep->fetchAll();
        if(empty($tab))
            return null;
        return $tab;
    }
}