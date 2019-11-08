<?php
require_once '../model/Model.php';
$rep = Model::$pdo->query("SELECT nomMarque FROM porduits GROUP BY (nomMarque);");
$rep -> setFetchMode(PDO::FETCH_CLASS, 'nomMarque');
$tab = $rep->fetchAll(PDO::FETCH_ASSOC);
foreach ($tab as $value){
    echo $value;
}
?>