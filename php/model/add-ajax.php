<?php
require_once (File::build_path(array('model','Model.php')));
$id = $_GET['id'];
$rep = Model::$pdo->query("SELECT nom, stock, prix, Url FROM Produits WHERE refProduit = '$id'");
$rep -> setFetchMode(PDO::FETCH_CLASS, 'nomMarque');
$tab = $rep->fetchAll(PDO::FETCH_ASSOC);
foreach ($tab as $value){
    foreach ($value as $val){
        echo $val."£";
    }
}
?>