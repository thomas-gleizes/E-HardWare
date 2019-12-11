<?php
if (session_status() == PHP_SESSION_NONE) {
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
    <p id="info">Veuillez entrer votre code de confirmation reçu par Email !</p>
    <form method="post" action="../controller/routeur.php">
        <input type="hidden" name="action" value="connection">
        <div class="under-container1">
            <input type="text" placeholder="Votre code de confirmation" name="codeConf" required>
        </div>
    </form>
    <button id="Confirmer">Confirmez</button>
    <button id="revenir">Revenir à l'acceuil</button>
</div>
</body>
</html>