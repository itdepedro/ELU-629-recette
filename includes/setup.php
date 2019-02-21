<?php
$db = mysqli_connect('localhost', 'root', 'root', 'recette');
mysqli_set_charset($db, "utf8");
if (!$db) {
    echo "Erreur: Impossible de se connecter à MySQL." . PHP_EOL;
    echo "Erreur de débogage: " . mysqli_connect_errno() . PHP_EOL;
    exit;
}

?>