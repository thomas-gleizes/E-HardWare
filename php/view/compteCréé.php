<?php
session_name("mlsfhvliusqfrbguilqdfjlqhdf");
if(!isset($_SESSION['login'])){
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
    <p id="info">Merci d'avoir créé un compte, <br> Un email de confirmation vous a été envoyé !</p>
    <button id="revenir"><p>revenir à l'acceuil</p></button>
</div>
</body>
</html>