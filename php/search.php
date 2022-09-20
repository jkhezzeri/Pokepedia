<?php

include '../config/database.php';
include '../includes/functions.php';

// On récupère l'id de l'ordre de la liste des pokémon
$id = $_POST['id'];

// On défini l'ordre dans la requête SQL selon l'id
switch ($id) {
    case 1:
        $orderBy = 'id_pokemon';
        break;
    case 2:
        $orderBy = 'id_pokemon DESC';
        break;
    case 3:
        $orderBy = 'fr_name_pokemon';
        break;
    case 4:
        $orderBy = 'fr_name_pokemon DESC';
        break;
}

// Récupérer depuis la base de données les données des pokémon avec l'odre choisi
$pokedexStatement = $pdo->prepare('SELECT pokedex.*, shape.*,
                                    (SELECT JSON_OBJECT("name_type", first_type.name_type, "en_name_type", first_type.en_name_type, "icon_type", first_type.icon_type)) AS first_type_tag,
                                    (SELECT JSON_OBJECT("name_type", second_type.name_type, "en_name_type", second_type.en_name_type, "icon_type", second_type.icon_type)) AS second_type_tag
                                    FROM pokedex
                                    LEFT JOIN types AS first_type ON pokedex.id_first_type = first_type.id_type
                                    LEFT JOIN types AS second_type ON pokedex.id_second_type = second_type.id_type
                                    LEFT JOIN shape ON pokedex.body_shape = shape.id_shape
                                    ORDER BY '.$orderBy);
$pokedexStatement->execute();
$pokedex = $pokedexStatement->fetchAll();

?>

<!-- On retourne la liste des pokémon selon l'ordre choisi -->
 <ul>
     <?php foreach($pokedex as $pokemon) : ?>
         <li><?php echo(display_pokedex_pokemon($pokemon)); ?></li>
     <?php endforeach ?>
 </ul>
