
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Changement de mot de passe</title>
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
        if (isset($_GET['error'])) {
            if ($_GET['error'] == 0) {
                echo'<p id="error10">votre confirmation de mot de passe comporte une erreur !</p>';
            } else if ($_GET['error'] == 1) {
                header('Location:https://www.cybermalveillance.gouv.fr/');
            } else if ($_GET['error'] == 2) {
                header('Location:https://www.cybermalveillance.gouv.fr/');
            } else if ($_GET['error'] == 3) {
                echo'<p id="error10">vous n\'avez pas fait de demande de changement de mot de passe !</p>';
            }
        }
        echo '
            <form method="post" action="../controller/routeur.php">
            <input type="hidden" name="action" value="changePassword">
            <input type="hidden" name="mail" value="'.$_GET['mail'].'">
            <input type="hidden" name="token" value="'.$_GET['token'].'">
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
            <button type="submit" id="ok" ><p>Confirmer</p></button>
        </form>
        ';
    } else {
        header('Location:../../index.php');
    }

    ?>

</div>
</body>
</html>
