<?php

require_once (File::build_path(array('model','Model.php')));

class ModelPanier{

    public static function getPanier($idClient){
        $sql = "SELECT pa.refProduit, pa.quantiteProduit , nom, nomMarque, Url, prix, stock, categorie FROM Panier pa, Produits p WHERE pa.refProduit = p.refProduit AND pa.idClient = :idClient;";
        $value['idClient'] = $idClient;
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($value);
        $rec_prep->setFetchMode(PDO::FETCH_ASSOC);
        $tab = $rec_prep->fetchAll();
        return $tab;
    }

    public static function getNbProduit ($idClient){
        $sql = "SELECT idClient, nbProduitPanier FROM Clients WHERE idClient = :idClient;";
        $value['idClient'] = $idClient;
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($value);
        $rec_prep->setFetchMode(PDO::FETCH_ASSOC);
        $tab = $rec_prep->fetchAll();
        return $tab;
    }

    public static function deletePanier($idClient, $refProduit){
        $sql = "DELETE FROM Panier WHERE idClient = :idClient AND refProduit = :refProduit;)";
        $value['idClient'] = $idClient;
        $value['refProduit'] = $refProduit;
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($value);
    }

    public static function insertPanier($idClient, $refProduit, $quantite){
        $sql = "INSERT INTO Panier VALUES (:idClient, :refProduit, :quantite)";
        $value['idClient'] = $idClient;
        $value['refProduit'] = $refProduit;
        $value['quantite'] = $quantite;
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($value);
    }

    public static function deleteAllPanier($idClient){
        $sql = "DELETE FROM Panier WHERE idClient = :idClient;)";
        $value['idClient'] = $idClient;
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($value);
    }

    public static function getRefproduit($idClient){
        $sql = "SELECT refProduit, quantiteProduit FROM Panier WHERE idClient = :idClient";
        $value['idClient'] = $idClient;
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($value);
        $rec_prep->setFetchMode(PDO::FETCH_ASSOC);
        $tab = $rec_prep->fetchAll();
        return $tab;
    }

    public static function addprodPanier($idClient, $refProduit, $quantiteProduit){
        $sql = "INSERT INTO Panier VALUES (:idClient, :refProduit, :quantiteProduit)";
        $value['idClient'] = $idClient;
        $value['$refProduit'] = $refProduit;
        $value['quantiteProduit'] = $quantiteProduit;
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($value);
    }

    public static function ajoutPanier($ref,$quantiter,$id){
        if(isset($_SESSION["login"])){
            if ($quantiter == null){
                $quantiter = 0;
            }
            $sql = "INSERT INTO Panier  (idClient,refProduit,quantiteProduit) VALUES (:id,:ref,:quantitier)";
            $value = array(
                "ref" => $ref,
                "quantitier" => $quantiter,
                "id" => $id
            );
            $rec_prep = Model::$pdo->prepare($sql);
            $rec_prep->execute($value);
            $panier["reference"] = $ref;
            $_SESSION["panier"]["quantiter"] +=1;
        }
    }

    public static function verifprodPanier($refProduit, $idClient){
        $sql = "SELECT COUNT(*) AS NB FROM Panier WHERE refProduit = :refProduit AND idClient = :idClient";
        $value['refProduit'] = $refProduit;
        $value['idClient'] = $idClient;
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($value);
        $rec_prep->setFetchMode(PDO::FETCH_ASSOC);
        $tab = $rec_prep->fetchAll();
        return $tab[0]['NB'];
    }


    public static function upDatePanier($refProduit, $idClient, $quantite){
        $sql = "UPDATE Panier SET quantiteProduit = quantiteProduit + :quantite WHERE refProduit = :refProduit AND idClient = :idClient;";
        $value['refProduit'] = $refProduit;
        $value['idClient'] = $idClient;
        $value['quantite'] = $quantite;
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($value) ;
    }

    public static function getMailPanier($refProduit){
        $sql = "SELECT Email FROM Clients c, Panier pa, Produits p WHERE c.idClient = pa.idClient AND pa.refProduit = p.refProduit AND p.refProduit = :refProduit AND p.stock = 0; ";
        $value['refProduit'] = $refProduit;
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($value);
        $rec_prep->setFetchMode(PDO::FETCH_ASSOC);
        $tab = $rec_prep->fetchAll();
        return $tab;
    }


}