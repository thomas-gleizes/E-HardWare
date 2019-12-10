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
    <title>Connexion</title>
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
        if(!$_GET==null){
            echo "<p id=\"error1\">Cette combinaison Login - Mot de passe n'éxiste pas !</p>";
        }
        if(!isset($panier)){
            $panier["quantiter"] = 0;
            $_SESSION["panier"] = $panier;
        }
        ?>
        <form method="post" action="../controller/routeur.php">
            <input type="hidden" name="action" value="connection">
            <div class="under-container1">
                <div class="i-container">
                    <i class="material-icons i">
                        mail_outline
                    </i>
                </div>
                <?php
                if(!$_GET==null){
                    echo "<input type=\"email\" placeholder=\"Votre mail\" name=\"mail\" value=\"".$_GET['mail']."\" required>";
                } else {
                    echo'<input type="email" placeholder="Votre mail" name="mail" required>';
                }
                ?>
            </div>
            <div class="under-container2">
                <div class="i-container">
                    <i class="material-icons i">
                        lock_open
                    </i>
                </div>
                <input type="password" placeholder="Votre mot de passe" name="mdp" required>
            </div>
            <button id="ok" type="submit"><p>Connexion</p></button>
        </form>
        <div class="mdp">
            <a href="../controller/routeur.php?action=askChangeMdp"><p>Mot de passe oublié ?</p></a>
        </div>
        <button id="new"><p>créer un nouveau compte</p></button>
        <button id="revenir"><p>revenir à l'acceuil</p></button>
    </div>
</body>
</html>