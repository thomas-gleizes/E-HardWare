<?php

require_once (File::build_path(array('model','Model.php')));
class ModelRecherche{

    public static function afficherRecherche($nom){
        $sql = "SELECT * FROM Produits where nom like :nom ";
        $valeur  =array(
            "nom" => "%".$nom."%"
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
        $dfbbd = explode(",",$marque);
        if ($prix == 1){
            $sql =self::search($nom,$prix,$marque,$categorie)[0]." GROUP BY(Produits.refProduit) ORDER BY Produits.prix ASC";

        }
        if ($prix == 2){
            $sql = self::search($nom,$prix,$marque,$categorie)[0]." GROUP BY(Produits.refProduit) ORDER BY Produits.prix DESC";

        } if($prix == null) {
            $sql=self::search($nom,$prix,$marque,$categorie)[0];
        }

        $valeur = self::search($nom,$prix,$marque,$categorie)[1];
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($valeur);
        $rec_prep->setFetchMode(PDO::FETCH_ASSOC);
        $tab = $rec_prep->fetchAll();
        if(empty($tab))
            return null;
        return $tab;
    }

    public static function getAllInfo($ref){
        $tab = [];
        if(isset($ref)){
                    foreach ($ref as $value){
                        foreach ($value as $v) {
                            $sql = "SELECT  distinct(refProduit) , Url,nom,nomMarque,prix FROM Produits where refProduit = :ref GROUP BY (refProduit)";
                            $valeur = array(
                                "ref" => $v
                            );
                            $rec_prep = Model::$pdo->prepare($sql);
                            $rec_prep->execute($valeur);
                            $rec_prep->setFetchMode(PDO::FETCH_ASSOC);
                            if(!in_array($value,$tab)){
                                //echo"pas dedans";
                                //echo"<br>";
                                $tab = array_merge($tab,$rec_prep->fetchAll());
                            }/*else{
                        //echo"dedans";
                        //echo"<br>";
                    }*/
                }
            }
        }

        //var_dump($tab);
        return $tab;
    }

    public static function getAllInformation($ref){
        $tab= [];
            $sql = "SELECT * FROM Produits where refProduit = :ref";
            $valeur = array(
                "ref" => $ref
            );
            $rec_prep = Model::$pdo->prepare($sql);
            $rec_prep->execute($valeur);
            $rec_prep->setFetchMode(PDO::FETCH_ASSOC);
            $tab = array_merge($tab, $rec_prep->fetchAll());
        return $tab;
    }


    public static function infoProduit($ref){
        $sql = "SELECT * FROM Produits WHERE refProduit = :ref";
        $valeur["ref"] = $ref;
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($valeur);
        $rec_prep->setFetchMode(PDO::FETCH_ASSOC);
        $tab = $rec_prep->fetchAll();
        if(empty($tab))
            return null;
        return $tab;
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

    public static function search($nom,$prix,$marque,$categorie){
        $sql ="";
        $requete = "";
        $valeur = [];
        $valeur["nom"] = "%".$nom."%";
        $dfbbd = explode(",",$marque);
        if($marque==null && $categorie==null){
            $requete = "SELECT Url,refProduit,nom,nomMarque,prix FROM Produits where nom like :nom ";
        }
        if($marque==null && $categorie!=null){
            //echo"1.2";
            $requete = "SELECT Url,refProduit,nom,nomMarque,prix FROM Produits where categorie = :categorie AND nom like :nom";
            $valeur["categorie"] = $categorie;
        }
        if($marque!=null && $categorie == null){
            //echo"1.3";
            $requete = "SELECT Url,refProduit,nom,nomMarque,prix FROM Produits where nomMarque = :marque ";
            foreach ($dfbbd as $m){
                $str = $m;
                $requete = $requete."OR nomMarque = :$str ";
                $valeur[$str] = $m;
            }
            $requete = $requete."and nom like :nom";
            $valeur["marque"] = $marque;

        }
        if($marque!=null && $categorie != null){
            //echo"1.4";
            $requete = "SELECT Url,refProduit,nom,nomMarque,prix FROM Produits where categorie = :categorie AND nomMarque = :marque ";
            foreach ($dfbbd as $m){
                $str = $m;
                $requete = $requete."OR nomMarque = :$str ";
                $valeur[$str] = $m;
            }
            $requete = $requete."and nom like :nom";
            $valeur["marque"] = $marque;
            $valeur["categorie"] = $categorie;
        }
        return array($requete,$valeur);
    }
}