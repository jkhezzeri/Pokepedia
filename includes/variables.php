<?php

// Récupérer depuis la base de données les types de pokémon
$typesStatement = $pdo->prepare('SELECT * FROM types WHERE id_type <= 18 ORDER BY name_type');
$typesStatement->execute();
$types = $typesStatement->fetchAll();

// Récupérer depuis la base de données les valeurs de la table des types
$chartStatement = $pdo->prepare('SELECT types_att.name_type AS name_type_att, types_def.name_type AS name_type_def, value_chart FROM types_chart
                                INNER JOIN types AS types_att ON types_chart.id_type_att = types_att.id_type
                                INNER JOIN types AS types_def ON types_chart.id_type_def = types_def.id_type
                                ORDER BY name_type_att, name_type_def');
$chartStatement->execute();
$chart = $chartStatement->fetchAll();

// $pokedex0Statement = $pdo->prepare('SELECT pokedex.*, first_type.name_type AS name_first_type, second_type.name_type AS name_second_type, color.*, shape.* FROM pokedex
//                                     LEFT JOIN types AS first_type ON pokedex.id_first_type = first_type.id_type
//                                     LEFT JOIN types AS second_type ON pokedex.id_second_type = second_type.id_type
//                                     LEFT JOIN color ON pokedex.color_pokemon = color.id_color
//                                     LEFT JOIN shape ON pokedex.body_shape = shape.id_shape
//                                     ORDER BY id_pokemon');
// $pokedex0Statement->execute();
// $pokedex0 = $pokedex0Statement->fetchAll();

// SELECT JSON_OBJECT("id_type", id_type, "name_type", name_type, "en_name_type", en_name_type, "icon_type", icon_type) AS type_tag FROM types

// $pokedexStatement = $pdo->prepare('SELECT pokedex.*, color.*, shape.*,
//                                     (SELECT JSON_OBJECT("name_type", first_type.name_type, "en_name_type", first_type.en_name_type, "icon_type", first_type.icon_type)) AS first_type_tag,
//                                     (SELECT JSON_OBJECT("name_type", second_type.name_type, "en_name_type", second_type.en_name_type, "icon_type", second_type.icon_type)) AS second_type_tag
// 									FROM pokedex
//                                    	LEFT JOIN types AS first_type ON pokedex.id_first_type = first_type.id_type
//                                     LEFT JOIN types AS second_type ON pokedex.id_second_type = second_type.id_type
//                                     LEFT JOIN color ON pokedex.color_pokemon = color.id_color
//                                     LEFT JOIN shape ON pokedex.body_shape = shape.id_shape
//                                     ORDER BY id_pokemon');
// $pokedexStatement->execute();
// $pokedex = $pokedexStatement->fetchAll();

// Récupérer depuis la base de données les statuts de combat
$statusStatement = $pdo->prepare('SELECT * FROM status ORDER BY id_status');
$statusStatement->execute();
$status = $statusStatement->fetchAll();

// Récupérer depuis la base de données les catégories des capacités
$damagesStatement = $pdo->prepare('SELECT * FROM damages ORDER BY id_damage');
$damagesStatement->execute();
$damages = $damagesStatement->fetchAll();

// Récupérer depuis la base de données les générations de pokémon
$generationsStatement = $pdo->prepare('SELECT * FROM generations ORDER BY id_generation');
$generationsStatement->execute();
$generations = $generationsStatement->fetchAll();
