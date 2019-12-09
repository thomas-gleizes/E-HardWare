<?php
if(!isset($_SESSION['login'])){
    session_name("mlsfhvliusqfrbguilqdfjlqhdf");
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Compte créé</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1,user-scalable=no">
    <link rel="icon" type="image/png" href="../../image/Logo.png"/>
    <link href="../../css/connection.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald|Roboto+Condensed&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../../javascript/connection.js"></script>
</head>
<body>
<div class="container">
    <?php
        if(!$_GET == null) {
            echo '<p id="info">Changement de mot de passe effectué avec succès !</p>';
        } else {
            echo'<p id="info">Un mail de changement de mot de passe vous a été envoyé !</p>';
        }
    ?>
    <button id="revenir"><p>Revenir à l'acceuil</p></button>
</div>
</body>
</html>
