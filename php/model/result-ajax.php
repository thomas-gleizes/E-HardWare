<?php
require_once (File::build_path(array('model','Model.php')));

$result = $_GET['result'];
$rep = Model::$pdo->query("SELECT nom,refProduit FROM Produits WHERE nom like '%$result%';");
$rep -> setFetchMode(PDO::FETCH_CLASS, 'nomMarque');
$tab = $rep->fetchAll(PDO::FETCH_ASSOC);
foreach ($tab as $value){
    foreach ($value as $val){
        echo $val."$";
    }
}
?>