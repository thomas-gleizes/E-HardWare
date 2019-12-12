<?php
require_once (File::build_path(array('model','Model.php')));
require_once (File::build_path(array('lib','Security.php')));


class ModelUtilisateur{

    public static function creationCompte($tab){
        $mdp = ModelUtilisateur::chiffrer($tab['mdp1'].Security::getSeed());
        $sql = "INSERT INTO Clients values( '',:mail,:nom,:prenom,:ville,:adresse,0,0,0,:mdp,0,'') ";
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
        if (session_status() == PHP_SESSION_NONE) {
            session_name("mlsfhvliusqfrbguilqdfjlqhdf");
            session_start();
        }
        $_SESSION['login'] = $mail;
        $panier["quantiter"]=0;
        $_SESSION["panier"] = $panier;
        $_SESSION['admin'] = 0;
    }

    public static function connectionCompte($tab){
        $sql = "SELECT mdp FROM Clients WHERE Email = :mail";
        $valeur  =array(
            "mail" => $tab['mail']
        );
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($valeur);
        $rec_prep -> setFetchMode(PDO::FETCH_CLASS, 'Client');
        $res = $rec_prep->fetchAll(PDO::FETCH_ASSOC);
        $mdp = ModelUtilisateur::chiffrer($tab['mdp'].Security::getSeed());
        $sql = "SELECT prioriter FROM Clients WHERE Email = :mail";
        $valeur  =array(
            "mail" => $tab['mail']
        );
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($valeur);
        $rec_prep -> setFetchMode(PDO::FETCH_CLASS, 'Client');
        $res1 = $rec_prep->fetchAll(PDO::FETCH_ASSOC);
        if (session_status() == PHP_SESSION_NONE) {
            session_name("mlsfhvliusqfrbguilqdfjlqhdf");
            session_start();
        }
        if ($res[0]['mdp'] == $mdp){
            $_SESSION['login'] = $tab['mail'];
            $_SESSION['admin'] = $res1[0]['prioriter'];
            return true;
        } else {
            return false;
        }
    }

    public static function myaccount(){
        if (session_status() == PHP_SESSION_NONE) {
            session_name("mlsfhvliusqfrbguilqdfjlqhdf");
            session_start();
        }
        $mail = $_SESSION['login'];
        $sql = "SELECT * FROM Clients WHERE Email = :mail";
        $valeur  =array(
            "mail" => $mail
        );
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($valeur);
        $rec_prep -> setFetchMode(PDO::FETCH_CLASS, 'Client');
        $resClient = $rec_prep->fetchAll(PDO::FETCH_ASSOC);
        return $resClient;
    }

    public static function editCompte($tab){
        $sql = "UPDATE Clients SET villeClient = :ville, adresseClient = :adresse where idClient = :id";
        $valeur  =array(
            "ville" => $tab['ville'],
            "adresse" => $tab['adresse'],
            "id" => $tab['id']
        );
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($valeur);
        if (session_status() == PHP_SESSION_NONE) {
            session_name("mlsfhvliusqfrbguilqdfjlqhdf");
            session_start();
        }
    }

    public static function chiffrer($mdp){
        $mdp_chiffre = hash('sha256', $mdp);
        return $mdp_chiffre;
    }

    public static function getCodeConf($mail){
        $sql = "SELECT codeConfirmation FROM Clients Where Email = :mail";
        $valeur  =array(
            "mail" => $mail
        );
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($valeur);
        $rec_prep-> setFetchMode(PDO::FETCH_CLASS, 'Client');
        $res = $rec_prep->fetchAll(PDO::FETCH_ASSOC);
        return $res[0]['codeConfirmation'];
    }

    public static function validerCompte($codeValid){
        if (session_status() == PHP_SESSION_NONE) {
            session_name("mlsfhvliusqfrbguilqdfjlqhdf");
            session_start();
        }
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

    public static function securedLink(){
        $id = self::getIdUti($_SESSION['login']);
        $token = ModelUtilisateur::chiffrer(Security::getSeedLink().$mail.Security::getSeedLinkEnd());
        $sql = "UPDATE Clients SET token = :token WHERE idClient = :id";
        $valeur = array(
            "token" => $token,
            "id" => $id
        );
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($valeur);
        return $token;
    }

    public static function changePassword($id, $mdp){
        $sql = "UPDATE Clients SET mdp = :mdp, token = 0 WHERE idClient = :idClient;";
        $value['mdp'] = self::chiffrer($mdp.Security::getSeed());
        $value['idClient'] = $id;
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($value);
    }

    public static function verifEmail($mail){
        $sql = "SELECT COUNT(Email) AS testEmail FROM Clients WHERE Email = :mail";
        $value = array(
            "mail" => $mail
        );
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($value);
        $rec_prep->setFetchMode(PDO::FETCH_ASSOC);
        $tab = $rec_prep->fetchAll();
        return $tab[0]['testEmail'];
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

    public static function getToken($id){
        $sql = "SELECT token FROM Clients WHERE idClient = :id";
        $valeur = array(
            "id" => $id
        );
        $rec_prep = Model::$pdo->prepare($sql);
        $rec_prep->execute($valeur);
        $res = $rec_prep->fetchAll(PDO::FETCH_ASSOC);
        return $res[0]['token'];
    }





}