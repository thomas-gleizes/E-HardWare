<?php
require_once (File::build_path(array('model','Model.php')));

$rep = Model::$pdo->query("SELECT nomMarque FROM Produits GROUP BY (nomMarque);");
$rep -> setFetchMode(PDO::FETCH_CLASS, 'nomMarque');
$tab = $rep->fetchAll(PDO::FETCH_ASSOC);
foreach ($tab as $value){
    foreach ($value as $val){
        echo $val." ";
    }
}
?>