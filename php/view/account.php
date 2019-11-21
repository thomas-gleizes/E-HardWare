<?php
require_once ('../model/Model.php');
session_start();

if (!isset($_SESSION['login'])) {
    header('Location:./connection.php');
}
$mail = $_SESSION['login'];
$rep = Model::$pdo->query("SELECT * FROM Clients WHERE Email = '$mail'");
$rep -> setFetchMode(PDO::FETCH_CLASS, 'Client');
$res = $rep->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Création</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1,user-scalable=no">
    <link href="../../css/connection.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald|Roboto+Condensed&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../../javascript/connection.js"></script>
</head>
<body>
<div id="container-spe" class="container">
    <?php
    $prenom = $res[0]['prenomClient'];
     echo '<p id="bonjour">Bonjour '.$prenom.' !</p>'
    ?>
    <form method="post" action="../controller/routeur.php">
        <input type="hidden" name="action" value="edit" >
        <?php
        $id = $res[0]['idClient'];
        echo '<input type="hidden" name="id" value="'.$id.'" >';
        ?>
        <div class="under-container1 edit-div">
            <div class="i-container">
                <i class="material-icons i edit">
                    edit
                </i>
            </div>
            <?php
            $mail = $res[0]['Email'];
            echo '<input class="changeable" type="email" name="mail" value="'.$mail.'"readonly>';
            ?>
        </div>
        <div class="under-container2 edit-div">
            <div class="i-container">
                <i class="material-icons i edit">
                    edit
                </i>
            </div>
            <?php
            $adresse = $res[0]['adresseClient'];
            echo '<input class="changeable" name="adresse" value="'.$adresse.'" readonly>';
            ?>
        </div>
        <div  class="under-container2 edit-div">
            <div class="i-container">
                <i class="material-icons i edit">
                    edit
                </i>
            </div>
            <?php
            $ville = $res[0]['villeClient'];
            echo '<input class="changeable" name="ville" value="'.$ville.'" readonly>';
            ?>

        </div>
        <button id="ok" ><p>Changer</p></button>
    </form>
    <div class="mdp">
        <a href="#"><p>Changer de mot de passe</p></a>
    </div>
    <form method="post" action="../controller/routeur.php">
        <input type="hidden" name="action" value="disconnect" >
        <button id="connect" type="submit"><p>se déconnecter</p></button>
    </form>
    <button id="revenir" ><p>revenir à l'acceuil</p></button>
</div>
</body>
</html>