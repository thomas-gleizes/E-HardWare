<?php
if (session_status() == PHP_SESSION_NONE) {
    session_name("mlsfhvliusqfrbguilqdfjlqhdf");
    session_start();
}

if(!isset($_COOKIE["panier"])){
    setcookie("panier","0",time()+31570000)  ;
}
if(isset($valCookie)){
    setcookie("panier",strval($valCookie),time()+31570000)  ;
}
//echo "<br>".$_SESSION["panier"]["quantigit ter"];
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
        <form method="post" action="./../controller/routeur.php">
            <input type="hidden" name="action" value="Panier">
            <button class="pan-btn" type="submit">
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
    $val = 0;
    if(isset($_COOKIE['panier'])){
        $val = $_COOKIE["panier"];
        echo'
        <form  method="Post" action="./../controller/routeur.php">
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
    else{
        echo'
       <form  method="Post" action="./../controller/routeur.php">
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
    <label for="croissant"><p>Prix par ordre croissant</p></label>
    <input class="check2" type="checkbox" id="decroissant" >
    <label for="decroissant"><p>Prix par ordre décroissant</p></label>
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
        <p class="produit">Nvidia Rtx 2080<p/>
        <p class="disponibilite">en stock (20 disponible)<p/>
        <p class="prix-total">1500 €<p/>
        <p class="choix">combien voulez vous en ajoutez à votre panier?</p>
        <i id="achat-icon" class="material-icons categorie-icon">
            arrow_drop_down
        </i>
        <form  method="Post" action="../controller/routeur.php">
            <select id="select3" name="nombre">
                <option id="option1" value="1">1</option>
                <option id="option2" value="2">2</option>
                <option id="option3" value="3">3</option>
                <option id="option4" value="4">4</option>
                <option id="option5" value="5">5</option>
            </select>
            <input type="hidden" id="id_produit" name="id_produit" value="1">
            <input type="hidden" name="action" value="ajoutPanier">
            <button id="achat-btn" type="submit"><p>Ajouter</p></button>
        </form>
    </div>
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
            <form  class=\"card-form\"  method=\"post\" action=\"../controller/routeur.php\">
                <input type=\"hidden\" name=\"action\" value=\"infoVueProduit\" > 
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
                    echo "<form method='post' action='../controller/routeur.php'>
                    <input type=\"hidden\" name=\"action\" value=\"infoVueProduit\" > 
                    <input type=\"hidden\" name=\"id_produit\" value=\"$v[$r]\">
                    <button type='submit' id='mod'><p>Modifier le produit</p></button></form>";
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
                <form method="post" action="../controller/routeur.php" class="alimentation open">
                    <h3> Alimentation </h3>
                    <input type="hidden" class="ajout-input" name="action" value="ajoutProduit" required>
                    <input type="hidden" class="ajout-input" name="categorie" value="Alimentation" required>
                    <input type="text" class="ajout-input" placeholder="Nom du produit" name="nom" required>
                    <input type="text" class="ajout-input" placeholder="Marque du produit" name="nomMarque" required>
                    <input type="number" min="0" step="any" class="ajout-input" placeholder="Prix du produit" name="prix" required>
                    <input type="number" min="0" class="ajout-input" placeholder="Quantité de stock" name="stock" required>
                    <input type="url" class="ajout-input" placeholder="Url de l\'image du produit" name="Url" required>
                    <input type="number" min="0" step="any" class="ajout-input" placeholder="Puissance" name="puissance" required>
                    <input type="text" class="ajout-input" placeholder="Modularité" name="modularite" required>
                    <button class="ok" type="submit"><p>Ajout</p></button> 
                </form>
                <form method="post" action="../controller/routeur.php" class="ssd open">
                    <h3> Solide State Drive </h3>
                    <input type="hidden" class="ajout-input" name="action" value="ajoutProduit" required>
                    <input type="hidden" class="ajout-input" name="categorie" value="SSD" required>
                    <input type="text" class="ajout-input" placeholder="Nom du produit" name="nom" required>
                    <input type="text" class="ajout-input" placeholder="Marque du produit" name="nomMarque" required>
                    <input type="number" min="0" step="any" class="ajout-input" placeholder="Prix du produit" name="prix" required>
                    <input type="number" min="0" class="ajout-input" placeholder="Quantité de stock" name="stock" required>
                    <input type="url" class="ajout-input" placeholder="Url de l\'image du produit" name="Url" required>
                    <input type="text" class="ajout-input" placeholder="Format SSD" name="format" required>
                    <input type="number" min="0" class="ajout-input" placeholder="Capacite SSD" name="capacite" required>
                    <input type="text" class="ajout-input" placeholder="Interface SSD" name="interface" required>
                    <input type="number" min="0" class="ajout-input" placeholder="Vitesse de lecture" name="lecture" required>
                    <input type="number" min="0" step="any" class="ajout-input" placeholder="Vitesse d\'écriture" name="ecriture" required>
                    <button class="ok" type="submit"><p>Ajout</p></button>
                 </form>
                 <form method="post" action="../controller/routeur.php" class="dd open">
                    <h3> Disque Dur </h3>
                    <input type="hidden" class="ajout-input" name="action" value="ajoutProduit" required>
                    <input type="hidden" class="ajout-input" name="categorie" value="DisqueDur" required>
                    <input type="text" class="ajout-input" placeholder="Nom du produit" name="nom" required>
                    <input type="text" class="ajout-input" placeholder="Marque du produit" name="nomMarque" required>
                    <input type="number" min="0" step="any" class="ajout-input" placeholder="Prix du produit" name="prix" required>
                    <input type="number" min="0" class="ajout-input" placeholder="Quantité de stock" name="stock" required>
                    <input type="url" class="ajout-input" placeholder="Url de l\'image du produit" name="Url" required>
                    <input type="number" min="0" class="ajout-input" placeholder="Capacite HDD" name="capacite" required>
                    <input type="text" class="ajout-input" placeholder="Interface" name="interface" required>
                    <input type="number" min="0" class="ajout-input" placeholder="Vitesse de rotation" name="vitesseRotation" required>
                    <button class="ok" type="submit"><p>Ajout</p></button> 
                </form>
                <form method="post" action="../controller/routeur.php" class="cg open">
                    <h3> Carte Graphique </h3>
                    <input type="hidden" class="ajout-input" name="action" value="ajoutProduit" required>
                    <input type="hidden" class="ajout-input" name="categorie" value="CarteGraphique" required>
                    <input type="text" class="ajout-input" placeholder="Nom du produit" name="nom" required>
                    <input type="text" class="ajout-input" placeholder="Marque du produit" name="nomMarque" required>
                    <input type="number" min="0" step="any" class="ajout-input" placeholder="Prix du produit" name="prix" required>
                    <input type="number" min="0" class="ajout-input" placeholder="Quantité de stock" name="stock" required>
                    <input type="url" class="ajout-input" placeholder="Url de l\'image du produit" name="Url" required>
                    <input type="text" class="ajout-input" placeholder="Chipset Graphique" name="chipset" required>
                    <input type="number" min="0" class="ajout-input" placeholder="Mémoire vidéo" name="memoire" required>
                    <input type="text" class="ajout-input" placeholder="Architecture" name="architecture" required>
                    <input type="text" class="ajout-input" placeholder="Bus" name="bus" required>
                    <button class="ok" type="submit"><p>Ajout</p></button> 
                </form>
                <form method="post" action="../controller/routeur.php" class="mm open">
                    <h3>Mémoire</h3>
                    <input type="hidden" class="ajout-input" name="action" value="ajoutProduit" required>
                    <input type="hidden" class="ajout-input" name="categorie" value="Memoire" required>
                    <input type="text" class="ajout-input" placeholder="Nom du produit" name="nom" required>
                    <input type="text" class="ajout-input" placeholder="Marque du produit" name="nomMarque" required>
                    <input type="number" min="0" step="any"" class="ajout-input" placeholder="Prix du produit" name="prix" required>
                    <input type="number" min="0" class="ajout-input" placeholder="Quantité de stock" name="stock" required>
                    <input type="url" class="ajout-input" placeholder="Url de l\'image du produit" name="Url" required>
                    <input type="text" class="ajout-input" placeholder="Type de RAM" name="typ" required>
                    <input type="number" min="0" class="ajout-input" placeholder="Capacite RAM" name="capacite" required>
                    <input type="number" min="0" class="ajout-input" placeholder="Frequence RAM" name="frequence" required>
                    <input type="number" min="0" class="ajout-input" placeholder="CAS" name="CAS" required>
                    <input type="number" min="0" max = "8" class="ajout-input" placeholder="Nombre de barrrette" name="nbBarrette" required>  
                    <button class="ok" type="submit"><p>Ajout</p></button>
                </form>
                <form method="post" action="../controller/routeur.php" class="cm open">
                    <h3> Carte Mère </h3>
                    <input type="hidden" class="ajout-input" name="action" value="ajoutProduit" required>
                    <input type="hidden" class="ajout-input" name="categorie" value="CarteMere" required>
                    <input type="text" class="ajout-input" placeholder="Nom du produit" name="nom" required>
                    <input type="text" class="ajout-input" placeholder="Marque du produit" name="nomMarque" required>
                    <input type="number" min="0" step="any" class="ajout-input" placeholder="Prix du produit" name="prix" required>
                    <input type="number" min="0" class="ajout-input" placeholder="Quantité de stock" name="stock" required>
                    <input type="url" class="ajout-input" placeholder="Url de l\'image du produit" name="Url" required>
                    <input type="text" class="ajout-input" placeholder="Chipset" name="chipset" required>
                    <input type="text" class="ajout-input" placeholder="Socket" name="socket" required>
                    <input type="text" class="ajout-input" placeholder="Format" name="format" required>
                    <button class="ok" type="submit"><p>Ajout</p></button> 
                </form>
                <form method="post" action="../controller/routeur.php" class="pro open">
                    <h3> Processeur </h3>
                    <input type="hidden" class="ajout-input" name="action" value="ajoutProduit" required>
                    <input type="hidden" class="ajout-input" name="categorie" value="Processeur" required>
                    <input type="text" class="ajout-input" placeholder="Nom du produit" name="nom" required>
                    <input type="text" class="ajout-input" placeholder="Marque du produit" name="nomMarque" required>
                    <input type="number" min="0" step="any" class="ajout-input" placeholder="Prix du produit" name="prix" required>
                    <input type="number" min="0" class="ajout-input" placeholder="Quantité de stock" name="stock" required>
                    <input type="url" class="ajout-input" placeholder="Url de l\'image du produit" name="Url" required>
                    <input type="number" min="0" class="ajout-input" placeholder="Nombre de coeur" name="nbCoeur" required>
                    <input type="number" min="0" class="ajout-input" placeholder="Nombre de threads" name="nbThreads" required>
                    <input type="text" class="ajout-input" placeholder="Socket" name="socket" required>
                    <input type="number" min="0" step="any" class="ajout-input" placeholder="Frequence CPU" name="frequence" required>
                    <input type="number" min="0" step="any" class="ajout-input" placeholder="Boost CPU" name="boost" required>
                    <input type="number" min="0" class="ajout-input" placeholder="Cache" name="cache" required>
                    <button class="ok" type="submit"><p>Ajout</p></button> 
                </form>

        </div> ';
    }
}
?>



</body>
</html>

