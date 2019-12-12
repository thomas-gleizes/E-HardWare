<?php
if(!isset($quantierpanier)){
    $quantierpanier = 0;
    $elementpanier = [];
}else{

}
require('php/lib/File.php');

if (session_status() == PHP_SESSION_NONE) {
    session_name("mlsfhvliusqfrbguilqdfjlqhdf");
    session_start();
}
if(!empty($tab)){
    $t = count($tab);
    $string = "";
    foreach ($tab as $v){
        $string =  $string. $v['refProduit'].",";
    }
//echo $string;
    setcookie("nbpanier",$t,time()+time()+31570000);
    setcookie("elementpanier",$string,time()+time()+31570000);
}
if (isset($_SESSION['login'])) {
    if ($_SESSION['admin'] == 1){
        header('Location:./php/controller/routeur.php?action=rechercheVide');
    }
}
//File::build_path(array('php','lib','File.php'));

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>E-HardWare</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1,user-scalable=no">
    <link rel="icon" type="image/png" href="./image/Logo.png"/>
    <link href="css/index.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Oswald|Roboto+Condensed&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="javascript/ajax.js"></script>
    <script src="javascript/index.js"></script>
</head>
<body>
    <div id="nav-bar" class="nav">
        <div id="fermer" class="section">
            <p>Fermer</p>
            <i  class="material-icons navbaricons">
                clear
            </i>
        </div>
        <div class="section" id="moncompte">
            <p>Mon compte</p>
            <i  class="material-icons navbaricons">
                account_circle
            </i>
        </div>
        <div class="section">
            <form method="post" action="./php/controller/routeur.php">
                <input type="hidden" name="action" value="Panier">
                <button class="pan-btn" type="submit">
                    Mon panier
                    <i class="material-icons navbaricons">shopping_cart</i>
                </button>
            </form>
        </div>
        <div id="categories" class="section">
            <div class="section">
                <p>Catégories</p>
                <i id="expand-icon" class="material-icons navbaricons">expand_more</i>
            </div>
        </div>
        <form method="get" action="php/controller/routeur.php">
            <input type="hidden" name="action" value="rechercherSidebar" >
            <button type="submit" name="categorie" value="Processeur" class="section under"> Processeur <i  class="material-icons navbaricons"> chevron_right </i> </button>
        </form>


        <form method="get" action="php/controller/routeur.php">
            <input type="hidden" name="action" value="rechercherSidebar" >
            <button type="submit" name="categorie" value="CarteMere" class="section under"> Carte mère <i  class="material-icons navbaricons"> chevron_right </i> </button>
        </form>


        <form method="get" action="php/controller/routeur.php">
            <input type="hidden" name="action" value="rechercherSidebar" >
            <button type="submit" name="categorie" value="Memoire" class="section under"> Mémoire <i  class="material-icons navbaricons"> chevron_right </i> </button>
        </form>


        <form method="get" action="php/controller/routeur.php">
            <input type="hidden" name="action" value="rechercherSidebar" >
            <button type="submit" name="categorie" value="CarteGraphique" class="section under"> Carte graphique <i  class="material-icons navbaricons"> chevron_right </i> </button>
        </form>


        <form method="get" action="php/controller/routeur.php">
            <input type="hidden" name="action" value="rechercherSidebar" >
            <button type="submit" name="categorie" value="SSD" class="section under"> SSD <i  class="material-icons navbaricons"> chevron_right </i> </button>
        </form>


        <form method="get" action="php/controller/routeur.php">
            <input type="hidden" name="action" value="rechercherSidebar" >
            <button type="submit" name="categorie" value="DisqueDur" class="section under"> Disque Dur <i  class="material-icons navbaricons"> chevron_right </i> </button>
        </form>


        <form method="get" action="php/controller/routeur.php">
            <input type="hidden" name="action" value="rechercherSidebar" >
            <button type="submit" name="categorie" value="Alimentation" class="section under"> Alimentation <i  class="material-icons navbaricons"> chevron_right </i> </button>
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
            <form method="get" id="research-form" action="./php/controller/routeur.php">
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
            echo '<form  method="Post" action="./php/view/account.php">
                <button type="submit" id="account-button">
                    <i id="account-icon" class="material-icons">
                        account_circle
                    </i>
                </button>
            </form>';
        } else {
            echo '<form  method="Post" action="./php/view/connection.php">
                <button type="submit" id="account-button">
                    <i id="account-icon" class="material-icons">
                        account_circle
                    </i>
                </button>
            </form>';
        }
        ?>
        <?php
        $val = 0;
        if(isset($_COOKIE['nbpanier'])){
            $val = $_COOKIE["nbpanier"];
            echo'
            <form  method="Post" action="./php/controller/routeur.php">
                <input type="hidden" name="action" value="Panier">
                <button type="submit" id="cart-button">
                    <i id="cart-icon" class="material-icons">
                        shopping_cart
                    </i>
                    '.$val.'
                </button>
            </form>
        ';
        }else {
            echo'
                <form  method="Post" action="./php/controller/routeur.php">
                    <input type="hidden" name="action" value="Panier">
                    <button type="submit" id="cart-button">
                        <i id="cart-icon" class="material-icons">
                            shopping_cart
                        </i>
                        '.$val.'
                    </button>
             </form>
            ';
        }

        ?>
    </header>
    <div class="filtre-container open">
        <input class="check1" type="checkbox" id="croissant" >
        <label for="croissant">Prix par ordre croissant</label>
        <input class="check2" type="checkbox" id="decroissant" >
        <label for="decroissant">Prix par ordre décroissant</label>
        <p id="marque-p">Trier par marque:</p>
    </div>
    <div class="result">
    </div>
    <div id="buy" class="buy open">
        <div class="img2-container">
            <i id="clear-icon2" class="material-icons">
                clear
            </i>
        </div>
        <div class="achat-container">
            <p class="produit">Nvidia Rtx 2080</p>
            <p class="disponibilite">en stock (20 disponible)</p>
            <p class="prix-total">1500 €</p>
            <p class="choix">combien voulez vous en ajoutez à votre panier?</p>
            <i id="achat-icon" class="material-icons categorie-icon">
                arrow_drop_down
            </i>
            <form  method="Post" action="php/controller/routeur.php">
                <select id="select3" name="nombre">
                    <option id="option1" value="1">1</option>
                    <option id="option2" value="2">2</option>
                    <option id="option3" value="3">3</option>
                    <option id="option4" value="4">4</option>
                    <option id="option5" value="5">5</option>
                </select>
                <input type="hidden" id="id_produit" name="id_produit" value="1">
                <input type="hidden" name="action" value="ajoutPanier">
                <button id="achat-btn" type="submit">Ajouter</button>
            </form>
        </div>
    </div>
    <div class="padding-container">
        <div class="container">
        </div>
    </div>
</body>
</html>


