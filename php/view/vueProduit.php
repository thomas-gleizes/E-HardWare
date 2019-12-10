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
    <link href="../../css/produit.css" rel="stylesheet" type="text/css">
    <link href="../../css/index.css" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/png" href="../../image/Logo.png"/>
    <link href="https://fonts.googleapis.com/css?family=Oswald|Roboto+Condensed&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../../javascript/ajax1.js"></script>
    <script src="../../javascript/produit.js"></script>
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
    else {
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


<?php
$u = "Url";
$r ="refProduit";
$n = "nom";
$nm = "nomMarque";
$p = "prix";
$s = "stock";
$c = "categorie";
$prenom = "prenomClient";
$idClient = "idClient";
$login = "Email";
$note = "note";
$com = "commentaire";
$date = "date";
foreach ($tab as $tav){
    $cat = $tav[$c];
    $ref = $tav[$r];
    echo '
        <div class="image-container">
            <input type="hidden" id="url" value="'.$tav[$u].'">
        </div>
            <div class="desc-container">
            <p id="produit" class="left">'.$tav[$n].'<p/>
            ';
}
if ($cat == 'Processeur'){
    $nbCoeur = "nbCoeur";
    $nbThreads = "nbThreads";
    $socket = "socket";
    $frequence = "frequence";
    $boost = "boost";
    $cache = "cache";
} else if ($cat == 'CarteGraphique'){
    $chipset = "chipset";
    $memore = "memoire";
    $architecture = "architecture";
    $bus = "bus";
} else if ($cat == 'CarteMere'){
    $chipset = "chipset";
    $socket = "socket";
    $format = "format";
} else if ($cat == 'Memoire'){
    $type = "type";
    $capacite = "capacite";
    $frequence = "frequence";
    $CAS = "CAS";
    $nbBarrette = "nbBarrette";
} else if ($cat == "SSD"){
    $format = "format";
    $capacite = "capacite";
    $interface = "interface";
    $lecture = "lecture";
    $ecriture = "ecriture";
} else if ($cat == 'DisqueDur'){
    $capacite = "capacite";
    $interface = "interface";
    $vitesse = "vitesseRotation";
} else if ($cat == 'Alimentation'){
    $puissance = "puissance";
    $modularite = "modularite";
}
foreach ($tabProd as $tai){
    if ($cat == 'Processeur'){
        echo '<p id="info">Nombre de Coeur : '. $tai[$nbCoeur] .'<br> Nombre de threads : '. $tai[$nbThreads] .'<br> Socket : '. $tai[$socket] .'<br> Fréquence : '. $tai[$frequence] .'GHz<br> Fréquence boost: '. $tai[$boost] .'GHz<br> Cache : '. $tai[$cache] .'Mo<br></p>';
    } else if($cat == 'CarteGraphique'){
        echo '<p id="info">Chipset Graphique : '. $tai[$chipset].' <br>Memoire vidéo : '. $tai[$memore].'Go <br>Architecture : '. $tai[$architecture].'<br> Bus : '. $tai[$bus].'</p>';
    } else if ($cat == 'CarteMere'){
        echo '<p id="info">Chipset : '. $tai[$chipset].'<br> Socket : '. $tai[$socket].'<br> Format : '. $tai[$format].' </p>';
    } else if ($cat == 'Memoire'){
        echo '<p id="info"> Type : '. $tai[$type].'<br> Capacité : '. $tai[$capacite].'Go <br> Fréquence : '. $tai[$frequence].'MHz<br> CAS : '. $tai[$CAS].' </p>';
    } else if ($cat == 'SSD'){
        echo '<p id="info"> Format : '. $tai[$format].'<br> Capacité : '. $tai[$capacite].'Go <br> Interface : '. $tai[$interface].' <br> Vitesse de Lecture : '. $tai[$lecture].'Mo/s<br> Vitesse d\'écriture : '. $tai[$ecriture].'Mo/s</p>';
    } else if ($cat == 'DisqueDur'){
        echo '<p id="info"> Capacité : '. $tai[$capacite].'Go <br> Interface : '. $tai[$interface].' <br> Vitesse de rotation : '. $tai[$vitesse].'t/m</p>';
    } else if ($cat == 'Alimentation'){
        echo '<p id="info"> Puissance ; '. $tai[$puissance].'W <br> Modularité : '. $tai[$modularite].' </p>';
    }
}
foreach ($tab as $tav){
    echo '  
            <p id="marque" class="left">'.$tav[$nm].'</p>
            <p id="categorie" class="left">'.$tav[$c].'</p>
            <p id="disponibilite" class="left">en stock ('.$tav[$s].' disponible)</p>
            <input type="hidden" id="stock" value="'.$tav[$s].'">
            <p id="prix-total" class="left">'.$tav[$p].',00 €</p>
            <p id="quantity" class="left">quantité :</p>
            <form  method="Post" action="../controller/routeur.php">
                <select id="select6" name="nombre">
                </select>
                <input type="hidden" id="id_produit" name="id_produit" value="'.$ref.'">
                <input type="hidden" name="action" value="ajoutPanier">
                <button id="achat-btn" type="submit"><p>Ajouter</p></button>
            </form>
        </div>
    ';
}
echo '
            <div class="onglet" id="onglet1"><p>Commentaires des utilisateurs</p></div>
            <div class="onglet" id="onglet2"><p>écrire un commentaire</p></div>';
if (isset($_SESSION['admin'])){
    if ($_SESSION['admin'] == 1){
        echo '<div class="onglet" id="onglet3"><p>Modification</p></div>';
    }}
            echo'<div class="commentaire-container">
                <div class="average-container">
                    <p class="average">Note moyenne des utilisateurs:</p>
                    <div id="global" class="rate">'.$avr.'
                        </div>
                    <p class="noteA ">'.$avr.'</p>
                </div>';
if (!empty($tabReview)){
    foreach ($tabReview as $value){
        echo '
                <div class="com">
                    <img class="user-icon" src="https://img.icons8.com/ultraviolet/40/000000/guest-male.png">
                    <p class="name">'.htmlspecialchars($value[$prenom]).'</p>
                    <div  class="rate">'.$value[$note].'</div>
                    <p class="note">'.$value[$note].'</p>
                    <p class="date">'.$value[$date].'</p>';
        if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1){
           // if ($_SESSION['admin'] == 1){
                echo '  <form method="post" action="./../controller/routeur.php">
                        <input type="hidden" name="action" value="supprReview">
                        <input type="hidden" name="id_produit" value="' . $ref . '">
                        <input type="hidden" name="idClient" value="'. $value[$idClient].'">
                        <button class="sup-btn" type="submit"><i class="material-icons">clear</i></button>
                    </form>';
            //}
        } else if (isset($_SESSION['login'])){
            if ($value[$login] == $_SESSION['login']) {
                echo '<form method="post" action="./../controller/routeur.php">
                    <input type="hidden" name="action" value="supprReview">
                    <input type="hidden" name="id_produit" value="' . $ref . '">
                    <input type="hidden" name="idClient" value="' . $value[$idClient] . '">
                    <button class="sup-btn" type="submit"><i class="material-icons">clear</i></button>
                  </form>';
            }
        }

        echo '
                    <div class="message-container">
                        <p class="message">'.htmlspecialchars($value[$com]).'</p>
                    </div>
                    </div>
                    ';
    }
} else {
    echo "<h2 class='firstAvis'> Soyez le premier à donnée votre avis !</h2>";
}
echo' </div>
            
            <div class="write-commentaire open">';
if (!isset($_SESSION['login'])){
    echo '<h5 class="firstAvis"> Connectez-vous pour donner votre avis !</h5>';
} else if ($nbAvis == 1) {
    echo '<h5 class="firstAvis"> Vous ne pouvez pas noter deux fois un produit ! </h5>';
} else {
    echo '
                <form method="post" action="../controller/routeur.php">
                    <input type="hidden" name="action" value="ajoutReview">                
                    <input type="hidden" name="id_produit" value="' . $ref . '">
                    <p class="mynote">votre note:</p>
                    <select id="select7" name="note">
                        <option value="0">0</option>
                        <option value="0.5">0.5</option>
                        <option value="1">1</option>
                        <option value="1.5">1.5</option>
                        <option value="2">2</option>
                        <option value="2.5">2.5</option>
                        <option value="3">3</option>
                        <option value="3.5">3.5</option>
                        <option value="4">4</option>
                        <option value="4.5">4.5</option>
                        <option value="5">5</option>
                    </select>
                    <textarea id="mycom" name="commentaire" placeholder="écrivez un commentaire"></textarea>
                    <button id="achat-btn" type="submit"><p>Envoyer</p></button>
                </form>
    ';
}
echo' </div>';
if (isset($_SESSION['admin'])){
    if ($_SESSION['admin'] == 1){
        echo '<div class="admin-part open">
            <form class="stock-form" method="post" action="./../controller/routeur.php">
                <p>Ajouter du stock du produit:</p>
                <input class="number" type="number" min="0" placeholder="nouveau stock" name="stock" required>
                <input type="hidden" name="action" value="stock">
                <input type="hidden" name="id_produit" value="'. $ref .'">
                <button class="ok" type="submit">ok</button>
            </form>
            <form class="name-form" method="post" action="./../controller/routeur.php">
                <p>Changer le nom du produit:</p>
                <input class="number" type="text" placeholder="nouveau nom" name="name" required>
                <input type="hidden" name="id_produit" value="'. $ref .'">
                <input type="hidden" name="action" value="name"> 
                <button class="ok" type="submit">ok</button>
            </form>
            <form class="price-form" method="post" action="./../controller/routeur.php">
                <p>Changer le prix du produit:</p>
                <input class="number" type="number" min="0" placeholder="nouveau prix" name="price" required>
                <input type="hidden" name="id_produit" value="'. $ref .'">
                <input type="hidden" name="action" value="prix">
                <button class="ok" type="submit">ok</button>
            </form>
            <form method="post" action="./../controller/routeur.php">
                <input type="hidden" name="id_produit" value="'. $ref .'">
                <input type="hidden" name="action" value="supprProduit">
                <button class="modif" type="submit">Suprimer le produit</button>
            </form>
        </div>';
    }}
?>






</body>
</html>