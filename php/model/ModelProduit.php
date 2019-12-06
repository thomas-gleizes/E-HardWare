<?php
File::build_path(array('model','Model.php'));
require_once ('../model/ModelRecherche.php');

class ModelProduit {

    public static function ajouterPanier ($tab){

        $sql = "INSERT INTO Panier VALUES (:idClient, :idProduit, quantite)";
        $valeur = array(
            "idClient" => $tab['id'],
            "idProduit" => $tab['ref'],
            "quantite" => $tab['quantite'],
        );
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($valeur);
    }

    public static function supProdPanier ($tab){
        $sql = "DELETE FROM Panier WHERE idClient = :idClient AND refProduit = :idProduit";
        $valeur = array(
            "idClient" => $tab['id'],
            "idProduit" => $tab['ref'],
        );
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($valeur);
    }

    public static function supprAllProdPanier ($id){
        $sql = "DELETE FROM Panier WHERE idClient = :idClient";
        $valeur = array(
            "idClient" => $id,
        );
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($valeur);
    }

    public static function insertProduit($tabProd){
        $sql = "INSERT INTO Produits VALUES ('', :nom, :nomMarque, :categorie, :prix, :stock, :Url)";
        $valeur = array(
            "nom" => $tabProd['nom'],
            "nomMarque" => $tabProd['nomMarque'],
            "categorie" => $tabProd['categorie'],
            "prix" => $tabProd['prix'],
            "stock" => $tabProd['stock'],
            "Url" => $tabProd['Url'],
        );
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($valeur);
    }

    public static function insertProcesseur($tab){
        $sql = "INSERT INTO Processeur VALUES ('', :nbCoeur, :nbThreads, :socket, :frequence, :boost, :cache, :refProduit)";
        $valeur = array(
            "nbCoeur" => $tab['nbCoeur'],
            "nbThreads" => $tab['nbThreads'],
            "socket" => $tab['socket'],
            "frequence" => $tab['frequence'],
            "boost" => $tab['boost'],
            "cache" => $tab['cache'],
            "refProduit" => $tab['refProduit'],
        );
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($valeur);
    }

    public static function insertCarteGraphique($tab){
        $sql = "INSERT INTO CarteGraphique VALUES ('', :chipset, :memoire, :architecture, :bus, :refProduit)";
        $valeur = array(
            "chipset" => $tab['chipset'],
            "memoire" => $tab['memoire'],
            "architecture" => $tab['architecture'],
            "bus" => $tab['bus'],
            "refProduit" => $tab['refProduit'],
        );
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($valeur);
    }

    public static function insertCarteMere($tab){
        $sql = "INSERT INTO CarteMere VALUES ('', :chipset, :socket, :format, :refProduit)";
        $valeur = array(
            "chipset" => $tab['chipset'],
            "socket" => $tab['socket'],
            "format" => $tab['format'],
            "refProduit" => $tab['refProduit'],
        );
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($valeur);
    }

    public static function insertDisqueDur($tab){
        $sql = "INSERT INTO DisqueDur VALUES ('', :capacite, :interface, :vitesseRotation, :refProduit)";
        $valeur = array(
            "capacite" => $tab['capacite'],
            "interface" => $tab['interface'],
            "vitesseRotation" => $tab['vitesseRotation'],
            "refProduit" => $tab['refProduit'],
        );
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($valeur);
    }

    public static function insertMemoire($tab){
        $sql = "INSERT INTO Memoire VALUES ('', :typ, :capacite, :frequence, :CAS, :nbBarrette, :refProduit)";
        $valeur = array(
            "typ" => $tab['typ'],
            "capacite" => $tab['capacite'],
            "frequence" => $tab['frequence'],
            "CAS" => $tab['CAS'],
            "nbBarrette" => $tab['nbBarrette'],
            "refProduit" => $tab['refProduit'],
        );
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($valeur);
    }

    public static function insertSSD($tab){
        $sql = "INSERT INTO SSD VALUES ('', :format, :capacite, :interface, :lecture, :ecriture, :refProduit)";
        $valeur = array(
            "format" => $tab['format'],
            "capacite" => $tab['capacite'],
            "interface" => $tab['interface'],
            "lecture" => $tab['lecture'],
            "ecriture" => $tab['ecriture'],
            "refProduit" => $tab['refProduit'],
        );
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($valeur);
    }

    public static function insertAlimentation($tab){
        $sql = "INSERT INTO Alimentation VALUES ('', :puissance, :modularite, :refProduit)";
        $valeur = array(
            "puissance" => $tab['puissance'],
            "modularite" => $tab['modularite'],
            "refProduit" => $tab['refProduit'],
        );
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($valeur);
    }

    public static function getIdProduit($nom){
        $sql = "SELECT refProduit FROM Produits WHERE nom = :nom";
        $valeur['nom'] = $nom;
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($valeur);
        $rec_prep->setFetchMode(PDO::FETCH_ASSOC);
        $tab = $rec_prep->fetchAll();

        return (int)$tab[0]["refProduit"];
    }

    public static function infoVueProduit($ref){
        $tab = ModelRecherche::getAllInformation($ref);
        return $tab;
    }

    public static function getInfoCate($refProduit, $categorie){
        $sql = "SELECT * FROM :categorie WHERE refProduit = :refProduit";
        $value['categorie'] = $categorie;
        $value['refPorduit'] = $refProduit;
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($value);
        $rec_prep->setFetchMode(PDO::FETCH_ASSOC);
        $tab = $rec_prep->fetchAll();
        return $tab;
    }

    public static function getReview($refProduit){
        $sql = "SELECT Clients.prenomClient, Avis.note, Avis.commentaire, Avis.date FROM Avis, Clients WHERE Avis.idClient = Clients.idClient AND Avis.refProduit = :refProduit";
        $value['refProduit'] = $refProduit;
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($value);
        $rec_prep->setFetchMode(PDO::FETCH_ASSOC);
        $tab = $rec_prep->fetchAll();
        return $tab;
    }

    public static function markAverage($refProduit){
        $sql = "SELECT AVG(note) AS MOY FROM Avis WHERE refProduit = :ref";
        $value['ref'] = $refProduit;
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($value);
        $rec_prep->setFetchMode(PDO::FETCH_ASSOC);
        $tab = $rec_prep->fetchAll();
        //var_dump($avr);
        return $tab[0]['MOY'];
    }

    public static function insertReview($tab){
        $sql = "INSERT INTO Avis VALUES (:idClient, :refProduit, :note, :commentaire, :date)";
        $value = array(
            'idClient' => $tab['idClient'],
            'refProduit' => $tab['refProduit'],
            'note' => $tab['note'],
            'commentaire' => $tab['commentaire'],
            'date' => $tab['date'],
        );
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($value);
    }

    public static function review($ref){
        $sql = "SELECT * FROM Avis WHERE refProduit = :ref";
        $value['ref'] = $ref;
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($value);
        $rec_prep->setFetchMode(PDO::FETCH_ASSOC);
        $tab = $rec_prep->fetchAll();
        return $tab;
    }

    public static function countReview($idClient, $refProduit){
        $sql = "SELECT COUNT() AS nb FROM AVIS WHERE idClient = :idClient, refProduit = :refProduit;";
        $value['idClient'] = $idClient;
        $value['refProduit'] = $refProduit;
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($value);
        $rec_prep->setFetchMode(PDO::FETCH_ASSOC);
        $tab = $rec_prep->fetchAll();
        if ($tab[0]['nb'] == 1){
            return true;
        } else {
            return false;
        }

    }





    //desc Produit
    public static function getProduit($refProduit){
        $sql = "SELECT * FROM Produits WHERE refProduit = :refProduit;";
        $value['refProduit'] = $refProduit;
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($value);
        $rec_prep->setFetchMode(PDO::FETCH_ASSOC);
        $tab = $rec_prep->fetchAll();
        return $tab;
    }
    public static function getProcesseur($refProduit){
        $sql = "SELECT * FROM Processeur WHERE refProduit = :refProduit;";
        $value['refProduit'] = $refProduit;
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($value);
        $rec_prep->setFetchMode(PDO::FETCH_ASSOC);
        $tab = $rec_prep->fetchAll();
        return $tab;
    }
    public static function getCarteGraphique($refProduit){
        $sql = "SELECT * FROM CarteGraphique WHERE refProduit = :refProduit;";
        $value['refProduit'] = $refProduit;
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($value);
        $rec_prep->setFetchMode(PDO::FETCH_ASSOC);
        $tab = $rec_prep->fetchAll();
        return $tab;
    }
    public static function getCarteMere($refProduit){
        $sql = "SELECT * FROM CarteMere WHERE refProduit = :refProduit;";
        $value['refProduit'] = $refProduit;
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($value);
        $rec_prep->setFetchMode(PDO::FETCH_ASSOC);
        $tab = $rec_prep->fetchAll();
        return $tab;
    }
    public static function getMemoire($refProduit){
        $sql = "SELECT * FROM Memoire WHERE refProduit = :refProduit;";
        $value['refProduit'] = $refProduit;
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($value);
        $rec_prep->setFetchMode(PDO::FETCH_ASSOC);
        $tab = $rec_prep->fetchAll();
        return $tab;
    }
    public static function getDisqueDur($refProduit){
        $sql = "SELECT * FROM DisqueDur WHERE refProduit = :refProduit;";
        $value['refProduit'] = $refProduit;
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($value);
        $rec_prep->setFetchMode(PDO::FETCH_ASSOC);
        $tab = $rec_prep->fetchAll();
        return $tab;
    }
    public static function getSSD($refProduit){
        $sql = "SELECT * FROM SSD WHERE refProduit = :refProduit;";
        $value['refProduit'] = $refProduit;
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($value);
        $rec_prep->setFetchMode(PDO::FETCH_ASSOC);
        $tab = $rec_prep->fetchAll();
        return $tab;
    }
    public static function getAlimentation($refProduit){
        $sql = "SELECT * FROM Alimentation WHERE refProduit = :refProduit;";
        $value['refProduit'] = $refProduit;
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($value);
        $rec_prep->setFetchMode(PDO::FETCH_ASSOC);
        $tab = $rec_prep->fetchAll();
        return $tab;
    }

    //desc produit





}