<?php
require_once (File::build_path(array('model','Model.php')));

require_once (File::build_path(array('lib','Security.php')));


class ModelUtilisateur{

    public static function creationCompte($tab){
        $mdp = ModelUtilisateur::chiffrer($tab['mdp1'].Security::getSeed());
        $sql = "INSERT INTO Clients values( '',:mail,:nom,:prenom,:ville,:adresse,0,0,0,:mdp,0) ";
        $valeur  =array(
            "mail" => $tab['mail'],
            "nom" => $tab['nom'],
            "prenom" => $tab['prenom'],
            "ville" => $tab['ville'],
            "adresse" => $tab['adresse'],
            "mdp" => $mdp
        );
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($valeur);
        $mail = $tab['mail'];
        $sql = "CALL GenereCodeConfirmation('$mail')";
        $stmt = Model::$pdo->prepare($sql);
        $stmt->execute();

        session_start();
        $_SESSION['login'] = $mail;
        $panier["quantiter"]=0;
        $_SESSION["panier"] = $panier;
        $_SESSION['admin'] = 0;
    }

    public static function connectionCompte($tab){
        $mail = $tab['mail'];
        $rep = Model::$pdo->query("SELECT mdp FROM Clients WHERE Email = '$mail'");
        $rep -> setFetchMode(PDO::FETCH_CLASS, 'Client');
        $res = $rep->fetchAll(PDO::FETCH_ASSOC);
        $mdp = ModelUtilisateur::chiffrer($tab['mdp'].Security::getSeed());
        $rep1 = Model::$pdo->query("SELECT prioriter FROM Clients WHERE Email = '$mail'");
        $rep1 -> setFetchMode(PDO::FETCH_CLASS, 'Client');
        $res1 = $rep1->fetchAll(PDO::FETCH_ASSOC);
        session_start();
        $_SESSION['login'] = $mail;
        $_SESSION['admin'] = $res1[0]['prioriter'];
        if ($res[0]['mdp'] == $mdp){
            return true;
        } else {
            return false;
        }
    }

    public static function myaccount(){
        if (!isset($_SESSION['login'])) {
            session_start();
        }
        $mail = $_SESSION['login'];
        $rep = Model::$pdo->query("SELECT * FROM Clients WHERE Email = '$mail'");
        $rep -> setFetchMode(PDO::FETCH_CLASS, 'Client');
        $resClient = $rep->fetchAll(PDO::FETCH_ASSOC);
        return $resClient;
    }

    public static function editCompte($tab){
        $sql = "UPDATE Clients SET Email = :mail, villeClient = :ville, adresseClient = :adresse where idClient = :id";
        $valeur  =array(
            "mail" => $tab['mail'],
            "ville" => $tab['ville'],
            "adresse" => $tab['adresse'],
            "id" => $tab['id']
        );
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($valeur);

        session_start();

        $mail = $tab['mail'];
        if ($mail != $_SESSION['login']){
            $sqll = "CALL GenereCodeConfirmation('$mail')";
            $stmt = Model::$pdo->prepare($sqll);
            $stmt->execute();
            ControllerUtilisateur::reValiderMail($mail);
        }

        $_SESSION['login'] = $tab['mail'];
    }

    public static function chiffrer($mdp){
        $mdp_chiffre = hash('sha256', $mdp);
        return $mdp_chiffre;
    }

    public static function getCodeConf($mail){
        $rep = Model::$pdo->query("SELECT codeConfirmation FROM Clients Where Email = '$mail'");
        $rep -> setFetchMode(PDO::FETCH_CLASS, 'Client');
        $res = $rep->fetchAll(PDO::FETCH_ASSOC);
        return $res[0]['codeConfirmation'];
    }

    public static function validerCompte($codeValid){
        session_start();
        $mail = $_SESSION['login'];
        $code = self::getCodeConf($mail);
        if ($code == $codeValid){
            $sql = 'UPDATE Clients SET codeConfirmation = 0 WHERE Email = :mail';
            $valeur  = array(
                "mail" => $mail
            );
            $rec_prep = Model::$pdo->prepare($sql);
            $rec_prep->execute($valeur);

            return true;
        } else {
            return false;
        }
    }

    public static function mailMdp($tab){
        $id = ModelUtilisateur::chiffrer($tab['id'].Security::getSeedMail());
    }

    public static function getIdUti($mail){
        $sql = "SELECT idClient FROM Clients WHERE Email = :mail";
        $valeur = array(
            "mail" => $mail,
        );
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($valeur);
        $rec_prep->setFetchMode(PDO::FETCH_CLASS,'Client');
        $res = $rec_prep->fetchAll(PDO::FETCH_ASSOC);
        return $res[0]['idClient'];
    }

    public static function modifMdp($tab){
        $mdp = tab['mdp'];
        $mdp = ModelUtilisateur::chiffrer($tab['mdp'].Security::getSeed());
        $sql = "UPDATE Clients SET mdp = :mdp WHERE Email = :mail";
        $valeur = array(
            "mdp" => $mdp,
            "mail" => tab['mail']
        );
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($valeur);
    }


    public static function getInfoCommande($idClient){
        $sql = "SELECT montantPanier, villeClient, adresseClient FROM Clients WHERE idClient = :idClient;";
        $value['idClient'] = $idClient;
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($value);
        $rec_prep->setFetchMode(PDO::FETCH_ASSOC);
        $tab = $rec_prep->fetchAll();
        return $tab;
    }

    public static function getNbProdPanier ($idClient){
        $sql = "SELECT nbProduitPanier FROM Clients WHERE idClient = :idClient";
        $value['idClient'] = $idClient;
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($value);
        $rec_prep->setFetchMode(PDO::FETCH_ASSOC);
        $tab = $rec_prep->fetchAll();
        return $tab[0]['nbProduitPanier'];
    }





}