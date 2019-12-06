<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>E-HardWare</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1,user-scalable=no">
    <link href="../../css/commande.css" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/png" href="../../image/Logo.png"/>
    <link href="https://fonts.googleapis.com/css?family=Oswald|Roboto+Condensed&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
    <div class="command-container">
        <div class="commande">
            <div class="image-container"></div>
            <div class="d">
                <p class="name">Nvidia Rtx</p>
                <p class="prix">1500</p>
                <p class="number">5</p>
                <form method="post" action="../controller/routeur.php">
                    <input type="hidden" name="action" value="del">
                    <input type="hidden" name="id_produit" value="">
                    <button type="submit" class="clear-btn">
                        <i class="material-icons clear">
                            clear
                        </i>
                    </button>

                </form>

            </div>
        </div>

    </div>
    <div class="resume-container">
        <p class="total">Voici votre Panier!</p>
        <p class="total">Prix totale: 4500</p>
        <p>Livraison à:</p>
        <i class="material-icons edit">
            edit
        </i>
        <p class="adress">340 rue Maurice et Katia Kraft, batiment A, apartement 245</p>
        <button class="validation"><p>Valider la commande</p></button>
        <button class="validation"><p>revenir à l'acceuil</p></button>
    </div>
</body>
</html>