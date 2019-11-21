<?php
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
    $nom = $res[0]['nom'];
    $prenom = $res[0]['prenom'];
     echo '<p>Bonjour '.$nom.' '.$prenom.' !</p>'
    ?>

    <form method="post" action="../controller/routeur.php">
        <input type="hidden" name="action" value="creation" >
        <div class="under-container1">
            <div class="i-container">
                <i class="material-icons i">
                    edit
                </i>
            </div>
            <input type="email" name="mail" value="exemple@gmail.com"readonly>
        </div>
        <div class="under-container2">
            <div class="i-container">
                <i class="material-icons i">
                    edit
                </i>
            </div>
            <input name="adresse" value="2 rue Patrice Montreuil" readonly>
        </div>
        <div class="under-container2">
            <div class="i-container">
                <i class="material-icons i">
                    edit
                </i>
            </div>
            <input name="ville" value="Montpellier" readonly>
        </div>
        <button id="ok" type="submit"><p>Changer</p></button>
    </form>
    <div class="mdp">
        <a href="#"><p>Changer de mot de passe</p></a>
    </div>
    <button id="connect"><p>se déconnecter</p></button>
    <button id="revenir"><p>revenir à l'acceuil</p></button>
</div>
</body>
</html>