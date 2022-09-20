<?php

include '../config/database.php';
include '../includes/functions.php';

// On récupère l'id du type
$id = $_POST['id'];

// Récupérer depuis la base de données les données du type choisi
$getTypeStatement = $pdo->prepare('SELECT * FROM types WHERE id_type = '.$id);
$getTypeStatement->execute();
$getType = $getTypeStatement->fetchAll();

// On retourne le type choisi
echo(display_type_tag($getType[0]));

?>
