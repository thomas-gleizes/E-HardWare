<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Création</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1,user-scalable=no">
    <link rel="icon" type="image/png" href="../../image/Logo.png"/>
    <link href="../../css/connection.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald|Roboto+Condensed&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../../javascript/connection.js"></script>
</head>
<body>
    <div id="container-spe" class="container">
        <form method="post" action="../controller/routeur.php">
            <input type="hidden" name="action" value="creation" required>
            <div class="under-container1">
                <div class="i-container">
                    <i class="material-icons i">
                        mail_outline
                    </i>
                </div>
                <?php
                    if (!$_GET == null) {
                        echo "<input type=\"email\" placeholder=\"Votre mail\" name=\"mail\" value=\"".$_GET['mail']."\" required>";
                    } else {
                        echo '<input type="email" placeholder="Mail" name="mail" required>';
                    }
                ?>
            </div>
            <div class="under-container2">
                <div class="i-container">
                    <i class="material-icons i">
                        perm_identity
                    </i>
                </div>
                <?php
                    if (!$_GET == null) {
                        echo "<input type=\"nom\" placeholder=\"Nom\" name=\"nom\" value=\"".$_GET['nom']."\" required>";
                    } else {
                        echo '<input placeholder="Nom" name="nom" required>';
                    }
                ?>
            </div>
            <div class="under-container2">
                <div class="i-container">
                    <i class="material-icons i">
                        perm_identity
                    </i>
                </div>
                <?php
                    if (!$_GET == null) {
                        echo "<input type=\"prenom\" placeholder=\"Prénom\" name=\"prenom\" value=\"".$_GET['prenom']."\" required>";
                    } else {
                        echo '<input placeholder="Prénom" name="prenom" required>';
                    }
                ?>
            </div>
            <div class="under-container2">
                <div class="i-container">
                    <i class="material-icons i">
                        lock_open
                    </i>
                </div>
                <input type="password" id="mdp1" name="mdp1" placeholder="Mot de passe" required>
            </div>
            <div class="under-container2">
                <div class="i-container">
                    <i class="material-icons i">
                        lock
                    </i>
                </div>
                <input type="password" id="mdp2" name="mdp2" placeholder="Confirmez Mot de passe" required>
            </div>
            <div class="under-container2">
                <div class="i-container">
                    <i class="material-icons i">
                        map
                    </i>
                </div>
                <?php
                    if (!$_GET == null) {
                        echo "<input type=\"adresse\" placeholder=\"Adresse\" name=\"adresse\" value=\"".$_GET['adresse']."\" required>";
                    } else {
                        echo '<input name="adresse" placeholder="Adresse" required>';
                    }
                ?>
            </div>
            <div class="under-container2">
                <div class="i-container">
                    <i class="material-icons i">
                        location_city
                    </i>
                </div>
                <?php
                    if (!$_GET == null) {
                        echo "<input type=\"ville\" placeholder=\"Ville\" name=\"ville\" value=\"".$_GET['ville']."\" required>";
                    } else {
                        echo '<input name="ville" placeholder="Ville" required>';
                    }
                ?>
            </div>

            <button id="ok" type="submit"><p>Inscription</p></button>
            <p id="error">Les mots de passes ne sont pas les mêmes !</p>
            <?php
            if (!$_GET == null) {
                if ($_GET['error'] == 1){
                    echo'<p id="error10">Les mots de passes ne sont pas les mêmes !</p>';
                } else if($_GET['error'] == 0) {
                    echo'<p id="error10">L\'un des champs est vide !</p>';
                } else if($_GET['error'] == 2) {
                    echo'<p id="error10">L\'email est invalide !</p>';
                } else if($_GET['error'] == 3) {
                    echo'<p id="error10">Mot de passe trop court !</p>';
                } else if($_GET['error'] == 4) {
                    echo'<p id="error10">L\'un des champs contient un emoji !</p>';
                }
            }
            ?>
        </form>

        <button id="connect"><p>se connecter</p></button>
        <button id="revenir"><p>revenir à l'acceuil</p></button>
    </div>
</body>
</html>