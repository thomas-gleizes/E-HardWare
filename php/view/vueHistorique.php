<?php
if (session_status() == PHP_SESSION_NONE) {
    session_name("mlsfhvliusqfrbguilqdfjlqhdf");
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>E-HardWare</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1,user-scalable=no">
    <link href="../../css/index.css" rel="stylesheet" type="text/css">
    <link href="../../css/commande.css" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/png" href="../../image/Logo.png"/>
    <link href="https://fonts.googleapis.com/css?family=Oswald|Roboto+Condensed&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../../javascript/ajax1.js"></script>
    <script src="../../javascript/index.js"></script>
    <script src="../../javascript/commande.js"></script>
</head>
<body>
<div class="cache-ajout open"></div>
<div id="nav-bar" class="nav">
    <div id="fermer" class="section">
        <p>Fermer</p>
        <i class="material-icons navbaricons">clear</i>
    </div>
    <div class="section" id="moncompte">
        <p>Mon compte</p>
        <i  class="material-icons navbaricons">
            account_circle
        </i>
    </div>
    <div class="section">
        <form method="post" action="./../controller/routeur.php">
            <input type="hidden" name="action" value="Panier">
            <button type="submit">
                <p>Mon panier</p>
                <i class="material-icons navbaricons">shopping_cart</i>
            </button>
        </form>
    </div>
    <div id="categories" class="section">
        <div class="section">
            <p>Catégories</p>
            <i  id="expand-icon" class="material-icons navbaricons">
                expand_more
            </i>
        </div>
    </div>
    <form method="get" action="../controller/routeur.php">
        <input type="hidden" name="action" value="rechercherSidebar" >
        <button type="submit" name="categorie" value="Processeur" class="section under"> <p>Processeur</p> <i  class="material-icons navbaricons"> chevron_right </i> </button>
    </form>


    <form method="get" action="../controller/routeur.php">
        <input type="hidden" name="action" value="rechercherSidebar" >
        <button type="submit" name="categorie" value="CarteMere" class="section under"> <p>Carte mère</p> <i  class="material-icons navbaricons"> chevron_right </i> </button>
    </form>


    <form method="get" action="../controller/routeur.php">
        <input type="hidden" name="action" value="rechercherSidebar" >
        <button type="submit" name="categorie" value="Memoire" class="section under"> <p>Mémoire</p> <i  class="material-icons navbaricons"> chevron_right </i> </button>
    </form>


    <form method="get" action="../controller/routeur.php">
        <input type="hidden" name="action" value="rechercherSidebar" >
        <button type="submit" name="categorie" value="CarteGraphique" class="section under"> <p>Carte graphique</p> <i  class="material-icons navbaricons"> chevron_right </i> </button>
    </form>


    <form method="get" action="../controller/routeur.php">
        <input type="hidden" name="action" value="rechercherSidebar" >
        <button type="submit" name="categorie" value="SSD" class="section under"> <p>SSD</p> <i  class="material-icons navbaricons"> chevron_right </i> </button>
    </form>


    <form method="get" action="../controller/routeur.php">
        <input type="hidden" name="action" value="rechercherSidebar" >
        <button type="submit" name="categorie" value="DisqueDur" class="section under"> <p>Disque Dur</p> <i  class="material-icons navbaricons"> chevron_right </i> </button>
    </form>


    <form method="get" action="../controller/routeur.php">
        <input type="hidden" name="action" value="rechercherSidebar" >
        <button type="submit" name="categorie" value="Alimentation" class="section under"> <p>Alimentation</p> <i  class="material-icons navbaricons"> chevron_right </i> </button>
    </form>

</div>
<div id="nav-bar-comp" class="navcomp">
</div>
<div id="buy-comp" class="navcomp">
</div>
<header>
    <i id="nav-bar-btn" class="material-icons">
        menu
    </i>
    <div id="search-bar">
        <form method="Get" id="research-form" action="../controller/routeur.php">
            <input type="hidden" name="action" value="afficherRecherche" >
            <div id="selection">
                <div id="filtrer">
                    <p class="categorie-text">filtrer</p>
                    <i class="material-icons categorie-icon">
                        arrow_drop_down
                    </i>
                    <input id="prix" type="hidden" name="prix" value="">
                    <input id="marque" type="hidden" name="marque" value="">
                </div>
                <div id="choix-catégorie">
                    <p id="c-text" class="categorie-text">toutes catégories</p>
                    <i class="material-icons categorie-icon">
                        arrow_drop_down
                    </i>
                    <select id="select" name="categorie">
                        <option value="">toutes catégories</option>
                        <option value="Processeur">Processeur</option>
                        <option value="CarteMere">Carte mère</option>
                        <option value="Memoire">Mémoire</option>
                        <option value="CarteGraphique">Carte graphique</option>
                        <option value="SSD">SSD</option>
                        <option value="DisqueDur">Disque Dur</option>
                        <option value="Alimentation">Alimentation</option>
                    </select>
                </div>
                <input id="reseach" type="text" name="research" autocomplete="off"/>
                <i id="clear-icon" class="material-icons clear">
                    clear
                </i>
                <button type="submit" id="reseach-button">
                    <i id="research-icon" class="material-icons">
                        search
                    </i>
                </button>
            </div>
        </form>
    </div>
    <?php
    if (isset($_SESSION['login'])) {
        echo '<form  method="Post" action="../view/account.php">
                <button type="submit" id="account-button">
                    <i id="account-icon" class="material-icons">
                        account_circle
                    </i>
                </button>
            </form>';
    } else {
        echo '<form  method="Post" action="../view/connection.php">
                <button type="submit" id="account-button">
                    <i id="account-icon" class="material-icons">
                        account_circle
                    </i>
                </button>
            </form>';
    }
    ?>
    <?php
    $val = $_COOKIE["panier"];
    if(isset($_SESSION["panier"])){
        $val = $_SESSION["panier"]["quantiter"];
        echo'
        <form  method="Post" action="../controller/routeur.php">
        <input type="hidden" name="action" value="Panier">
        <button type="submit" id="cart-button">
            <i id="cart-icon" class="material-icons">
                shopping_cart
            </i>
            <p>'.$val.'</p>
        </button>
    </form>
    ';
    }else{
        echo'
        <form  method="Post" action="../controller/routeur.php">
        <input type="hidden" name="action" value="Panier">
        <button type="submit" id="cart-button">
            <i id="cart-icon" class="material-icons">
                shopping_cart
            </i>
            <p>'.$val.'</p>
        </button>
    </form>
    ';
    }


    ?>

</header>
<div class="filtre-container open">
    <input class="check1" type="checkbox" id="croissant" >
    <label for="croissant"><p class="p">Prix par ordre croissant</p></label>
    <input class="check2" type="checkbox" id="decroissant" >
    <label for="decroissant"><p class="p">Prix par ordre décroissant</p></label>
    <p id="marque-p">Trier par marque:</p>
</div>
<div class="result">
</div>
<div class="container">
    <?php
        $idCommande = "idCommande";
        $date = "dateCommande";
        $nbProduit = "nbProduit";
        $montant = "montantCommande";
        $etat = "etatCommande";

    foreach ($tab as $item) {
        echo '
        <div class="historique-card">
            <p class="date">Commande passer le : '.$item[$date].'</p>
            <p class="number-commande">Contenant '.$item[$nbProduit].' articles</p>
            <p class="prix-commande">Prix totale: '.$item[$montant].',00€</p>
            <p>Etat de la Commande : '.$item[$etat].'</p>
            <form class="command-form" method="post" action="../controller/routeur.php">
                <input type="hidden" name="action" value="affCommande">
                <input type="hidden" name="idCommande" value="'. $item[$idCommande].'">
                <button class="command-btn" type="submit"></button>
            </form>
        </div>
        ';
    }
    ?>
</div>

<div class="container" style="display: none;">
    <div class="historique-card">
        <p class="date">Commande livré le : 10/08/2018</p>
        <p class="number-commande">contenant 3 articles</p>
        <p class="prix-commande">Prix totale: 4500,00€</p>
        <p>Etat de la Commande : Livré</p>
        <form class="command-form" method="post" action="../controller/routeur.php">
            <input type="hidden" name="action" value="">
            <button class="command-btn" type="submit"></button>
        </form>
    </div>

</div>

</body>
</html>