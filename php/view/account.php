<?php
if (session_status() == PHP_SESSION_NONE) {
    session_name("mlsfhvliusqfrbguilqdfjlqhdf");
    session_start();
}
if (!isset($_SESSION['login'])) {
    if (!isset($resClient)) {
        header('Location:./connection.php');
    }
}
if (!isset($resClient)) {
    if(!$_GET==null){
        header('Location:../controller/routeur.php?action=actionExt&error='.$_GET['error']);
    } else {
        header('Location:../controller/routeur.php?action=actionExt');
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Création</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1,user-scalable=no">
    <link href="../../css/connection.css" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/png" href="../../image/Logo.png"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald|Roboto+Condensed&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../../javascript/connection.js"></script>
</head>
<body>
<div id="container-spe" class="container">
    <?php
    $prenom = $resClient[0]['prenomClient'];
     echo '<p id="bonjour">Bonjour '.$prenom.' !</p>';
    ?>
    <?php
    if(!$_GET==null){
        if(isset($_GET['error'])) {
            if ($_GET['error'] == 0) {
                echo "<p id=\"error2\">vous ne pouvez pas mettre d'émoji dans votre adresse ou votre ville !</p>";
            } else if ($_GET['error'] == 1) {
                echo "<p id=\"error2\">L'un des champs est vide !</p>";
            } else if ($_GET['error'] == 2) {
                echo "<p id=\"error2\">Ce code n'est pas bon !</p>";
            }
        }
    }
    ?>
    <?php
    if ($resClient[0]['codeConfirmation'] != 0){
        echo '<form method="post" action="../controller/routeur.php">
        <p class="p-code">Code de validation reçu par mail :</p>
        <input type="hidden" name="action" value="validation" >
        <input id="code-input" type="text" name="code" >
        <button id="ok1" >Ok</button>
    </form>';
    } else {
        echo'<form method="post" action="../controller/routeur.php">
                <input type="hidden" name="action" value="commande" >
                <button id="command" type="submit" >Mes commandes</button>
             </form>';
    }

    ?>
    <form method="post" action="../controller/routeur.php">
        <input type="hidden" name="action" value="edit" >
        <?php
        $id = $resClient[0]['idClient'];
        echo '<input type="hidden" name="id" value="'.$id.'" >';
        ?>
        <div class="under-container1 edit-div">
            <div class="i-container">
                <i class="material-icons i edit">
                    edit
                </i>
            </div>
            <?php
            $adresse = $resClient[0]['adresseClient'];
            echo '<input class="changeable" name="adresse" value="'.$adresse.'" required>';
            ?>
        </div>
        <div  class="under-container2 edit-div">
            <div class="i-container">
                <i class="material-icons i edit">
                    edit
                </i>
            </div>
            <?php
            $ville = $resClient[0]['villeClient'];
            echo '<input class="changeable" name="ville" value="'.$ville.'" required>';
            ?>

        </div>
        <button id="ok" >Changer</button>
    </form>
    <div class="mdp">
        <a href="../controller/routeur.php?action=askChangeMdp"><p>Changer de mot de passe</p></a>
    </div>
    <form method="post" action="../controller/routeur.php">
        <input type="hidden" name="action" value="disconnect" >
        <button id="connect" type="submit">se déconnecter</button>
    </form>
    <button id="revenir" >revenir à l'acceuil</button>
</div>
</body>
</html>