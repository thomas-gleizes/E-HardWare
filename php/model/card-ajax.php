<?php
File::build_path(array('model','Model.php'));

$rep = Model::$pdo->query("SELECT refProduit, nom, nomMarque, prix, Url  FROM Produits WHERE stock > 0 ORDER BY RAND() LIMIT 10");
$rep -> setFetchMode(PDO::FETCH_CLASS, 'nomMarque');
$tab = $rep->fetchAll(PDO::FETCH_ASSOC);
foreach ($tab as $value){
    foreach ($value as $val){
        echo $val."£";
    }
}
?>