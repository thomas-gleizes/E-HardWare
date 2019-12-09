
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
    if (!$_GET == null) {
        echo '
            <form method="post" action="../controller/routeur.php">
            <input type="hidden" name="action" value="connection">
            <div class="under-container1">
                <div class="i-container">
                    <i class="material-icons i">
                        lock_open
                    </i>
                </div>
                <input type="password" id="mdp1" name="mdp1" placeholder="insérez votre nouveau mot de passe" required>
            </div>
            <div class="under-container2">
                <div class="i-container">
                    <i class="material-icons i">
                        lock
                    </i>
                </div>
                <input type="password" id="mdp2" name="mdp2" placeholder="Confirmez Mot de passe" required>
            </div>
            <button id="Confirmer"><p>Confirmer</p></button>
        </form>
        ';
    } else {
        header('Location:../../index.php');
    }

    ?>

</div>
</body>
</html>
