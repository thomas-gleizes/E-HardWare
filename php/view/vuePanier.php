<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>E-HardWare</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1,user-scalable=no">
    <link href="../../css/index.css" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/png" href="../../image/Logo.png"/>
    <link href="https://fonts.googleapis.com/css?family=Oswald|Roboto+Condensed&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../../javascript/ajax1.js"></script>
    <script src="../../javascript/index.js"></script>
</head>
<body>
<div class="cache-ajout open"></div>
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
        <p>Mon panier</p>
        <i  class="material-icons navbaricons">
            shopping_cart
        </i>
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

    <form  method="Post" action="PHP/view/Participant/preLobby.php">
        <button type="submit" id="cart-button">
            <i id="cart-icon" class="material-icons">
                shopping_cart
            </i>
            <p>0</p>
        </button>
    </form>
</header>
<div class="filtre-container open">
    <input class="check1" type="checkbox" id="croissant" >
    <label for="croissant"><p>Prix par ordre croissant</p></label>
    <input class="check2" type="checkbox" id="decroissant" >
    <label for="decroissant"><p>Prix par ordre décroissant</p></label>
    <p id="marque-p">Trier par marque:</p>
</div>

<div class="padding-container">
    <div class="container">
        <?php
        $u = "Url";
        $r ="refProduit";
        $n = "nom";
        $nm = "nomMarque";
        $p = "prix";

        foreach ($tabvaleur as $v) {
            echo("<div class=\"card\">
            <form  class=\"card-form\"  method=\"get\" action=\"PHP/view/Participant/preLobby.php\">
                <input type=\"hidden\" class=\"url\" name=\"id_produit\" value=\"$v[$u]\">
                <button type=\"submit\" class=\"img-container\">
                    <input type=\"hidden\" name=\"id_produit\" value=\"$v[$r]\">
                </button></form>
            <div class=\"description-container\">
                <p class=\"marque\">$v[$nm]<p/>
                <p class=\"description\">$v[$n]<p/>
                <p class=\"prix\">$v[$p] €<p/>
                <div class=\"rond\">
                    <p>
                        <input class=\"id\" type=\"hidden\" name=\"id_produit\" value=\"$v[$r]\">
                        <i class=\"add-icon material-icons buy-icon\">add_shopping_cart</i>
                    </p>
                </div> ");
            if (isset($_SESSION['admin'])){
                if ($_SESSION['admin'] == 1){
                    echo "<form method='post' action=''><button id='mod'><p>Modifier le produit</p></button></form>";
                }

            }
            echo "</div></div>";
        }
        ?>
    </div>
</div>

<?php
if (isset($_SESSION['admin'])){
    if ($_SESSION['admin'] == 1){
        echo '
        <div id="tools">
            <i class="material-icons" id="tool-icon">
                build
            </i>
        </div>
        <div id="p-container">
            <p id="p-tool">Vous êtes connecté en tant qu\'administrateur <br> Et avez donc accès à des outils supplémentaires</p>
        </div>
        <div id="tools1">
            <i class="material-icons" id="tool-icon1">
                add
            </i>
        </div>
        <div id="p-container1">
            <p id="p-tool1">Ajouter un produit à la vente</p>
        </div>
       
        <div class="ajout-container open">
            <div id="cat">
                <p id="cat-text" class="categorie-text">choisissez une catégorie</p>
                <i class="material-icons categorie-icon">
                    arrow_drop_down
                </i>
                <select id="select5" name="categorie">
                    <option class="val" value="Processeur">Processeur</option>
                    <option class="val" value="CarteMere">Carte mère</option>
                    <option class="val" value="Memoire">Mémoire</option>
                    <option class="val" value="CarteGraphique">Carte graphique</option>
                    <option class="val" value="SSD">SSD</option>
                    <option class="val" value="DisqueDur">Disque Dur</option>
                    <option class="val" value="Alimentation">Alimentation</option>
                </select>
            </div>
        </div>
        ';
    }
}
?>
<form method="post" action="../controller/routeur.php">
    <input type="hidden" name="action" value="">
    <button id="command-btn" type="submit"><p>commander</p></button>
</form>

</body>
</html>

