<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
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
        <form method="post">
            <div class="under-container1">
                <div class="i-container">
                    <i class="material-icons i">
                        mail_outline
                    </i>
                </div>
                <input type="text" placeholder="Mail" name="identifiant">
            </div>
            <div class="under-container2">
                <div class="i-container">
                    <i class="material-icons i">
                        perm_identity
                    </i>
                </div>
                <input placeholder="Nom" name="nom">
            </div>
            <div class="under-container2">
                <div class="i-container">
                    <i class="material-icons i">
                        perm_identity
                    </i>
                </div>
                <input placeholder="Prénom" name="prenom">
            </div>
            <div class="under-container2">
                <div class="i-container">
                    <i class="material-icons i">
                        lock_open
                    </i>
                </div>
                <input type="password" placeholder="Mot de passe">
            </div>
            <div class="under-container2">
                <div class="i-container">
                    <i class="material-icons i">
                        lock_open
                    </i>
                </div>
                <input type="password" name="mot de passe" placeholder="Mot de passe">
            </div>
            <div class="under-container2">
                <div class="i-container">
                    <i class="material-icons i">
                        map
                    </i>
                </div>
                <input name="adresse" placeholder="Adresse">
            </div>
        </form>
        <button id="ok"><p>ok</p></button>
        <button id="new"><p>se connecter</p></button>
    </div>
</body>
</html>