<?php

// ob_start();

include '../config/database.php';

// On récupère l'id de la génération
$id = $_POST['id'];

// Récupérer depuis la base de données les données de la génération choisie
$searchGenStatement = $pdo->prepare('SELECT * FROM generations WHERE id_generation = '.$id);
$searchGenStatement->execute();
$searchGen = $searchGenStatement->fetch();

// ob_end_clean();

// echo json_encode(array(intval($searchGen['first_pokemon']), intval($searchGen['last_pokemon'])));

// On retourne les numéros du premier et du dernier pokémon de la génération choisie
echo($searchGen['first_pokemon']."-".$searchGen['last_pokemon']);

?>
