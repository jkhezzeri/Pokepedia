<?php

// Fonction qui affiche une image sur le site
// en fonction d'une URL
function display_image(string $image) : string {
    $image_content = '';
    $image_content = '<img src="'.$image.'"/>';
    return $image_content;
}

// Fonction qui affiche un type de pokémon
// en fonction d'un type
function display_type_tag(array $type) : string {
    $tag_content = '';
    $tag_content .= '<div class="type_tag '.strtolower($type['en_name_type']).'">';
    $tag_content .= display_image($type['icon_type']);
    $tag_content .= '<div class="type_tag_name">'.$type['name_type'].'</div>';
    $tag_content .= '</div>';
    return $tag_content;
}

// Fonction qui affiche un pokémon sur la page d'accueil
// en fonction d'un pokémon
function display_pokedex_pokemon(array $pokemon) : string {
    $pokedex_content = '';
    // Numéro du pokémon
    $pokedex_content .= '<div class="pokedex_pokemon_number">N° '.str_pad($pokemon['id_pokemon'], 3, 0, STR_PAD_LEFT).'</div>';
    // Image du pokémon en mode liste
    $pokedex_content .= '<a href="pokemon.php?id='.$pokemon['id_pokemon'].'" class="pokedex_pokemon_miniature">';
    $pokedex_content .= display_image($pokemon['miniature_pokemon']);
    $pokedex_content .= '</a>';
    // Nom du pokémon
    $pokedex_content .= '<div class="pokedex_pokemon_name">'.$pokemon['fr_name_pokemon'].'</div>';
    // Image du pokémon en mode grille
    $pokedex_content .= '<a href="pokemon.php?id='.$pokemon['id_pokemon'].'" class="pokedex_pokemon_image">';
    $pokedex_content .= display_image($pokemon['image_pokemon']);
    $pokedex_content .= '</a>';
    // Type(s) du pokémon
    $pokedex_content .= '<div class="pokedex_pokemon_types">';
    $pokedex_content .= display_type_tag(json_decode($pokemon['first_type_tag'], true));
    if (isset($pokemon['id_second_type'])){
        $pokedex_content .= display_type_tag(json_decode($pokemon['second_type_tag'], true));
    }
    $pokedex_content .= '</div>';
    return $pokedex_content;
}

// function display_mini_pokedex_pokemon(array $pokemon) : string {
//     $mini_pokedex_content = '';
//     $mini_pokedex_content .= '<div class="mini_pokedex_pokemon_number">N° '.str_pad($pokemon['id_pokemon'], 3, 0, STR_PAD_LEFT).'</div>';
//     $mini_pokedex_content .= '<a href="pokemon.php?id='.$pokemon['id_pokemon'].'">';
//     $mini_pokedex_content .= display_image($pokemon['miniature_pokemon']);
//     $mini_pokedex_content .= '</a>';
//     $mini_pokedex_content .= '<div class="mini_pokedex_pokemon_name">'.$pokemon['fr_name_pokemon'].'</div>';
//     $mini_pokedex_content .= '<div class="mini_pokedex_pokemon_types">';
//     $mini_pokedex_content .= display_type_tag(json_decode($pokemon['first_type_tag'], true));
//     if (isset($pokemon['id_second_type'])){
//         $mini_pokedex_content .= display_type_tag(json_decode($pokemon['second_type_tag'], true));
//     }
//     $mini_pokedex_content .= '</div>';
//     return $mini_pokedex_content;
// }

// Fonction qui affiche une table des types (tableau général et tableaux des double types)
// en fonction des valeurs de la table des types, des types et possiblement d'un double type
function display_chart(array $chart, array $types, array $double) : string {
    $chart_content = '';
    $chart_content .= '<table>';
    // Titre du tableau
    $chart_content .= '<caption>';
    if ($double != []) {
        $chart_content .= '<div id="table'.$double['en_name_type'].'"></div>';
        $chart_content .= '<div class="chart_name">Tableau des faiblesses et des résistances des doubles types '.$double['name_type'].'</div>';
        $chart_content .= display_image($double['logo_type']);
    } else {
        $chart_content .= '<div id="tableGeneral"></div>';
        $chart_content .= '<div class="chart_name">Tableau général des faiblesses et des résistances de chaque type</div>';
        $chart_content .= display_image('images/pokeball.png');
    }
    $chart_content .= '</caption>';
    // En-tête du tableau
    $chart_content .= '<thead>';
    // Ligne du double type
    if ($double != []) {
        $chart_content .= '<tr>';
        $chart_content .= '<th class="'.strtolower($double['en_name_type']).'" colspan="19"><a href="" title="'.$double['name_type'].'">';
        $chart_content .= display_image($double['icon_type']);
        $chart_content .= '<div class="double_name">'.$double['name_type'].'</div>';
        $chart_content .= '</a></th>';
        $chart_content .= '</tr>';
    }
    // Coin du tableau
    $chart_content .= '<tr>';
    $chart_content .= '<th class="chart_titles">';
    $chart_content .= '<div class="chart_title">Défensif ►</div>';
    $chart_content .= '<div class="chart_title">Offensif ▼</div>';
    $chart_content .= '</th>';
    // Types défensifs
    foreach ($types as $type) {
        $chart_content .= '<td class="def_type chart_type"><a href="" title="'.$type['name_type'].'">';
        $chart_content .= display_image($type['logo_type']);
        $chart_content .= '<div class="def_type_name">'.$type['name_type'].'</div>';
        $chart_content .= '</a></td>';
    }
    $chart_content .= '</tr>';
    $chart_content .= '</thead>';
    // Corps du tableau
    $chart_content .= '<tbody>';
    // Ligne du corps du tableau
    foreach ($types as $type) {
        $chart_content .= '<tr>';
        // Types offensifs
        $chart_content .= '<td class="off_type chart_type"><a href="" title="'.$type['name_type'].'">';
        $chart_content .= display_image($type['logo_type']);
        $chart_content .= '<div class="off_type_name">'.$type['name_type'].'</div>';
        $chart_content .= '</a></td>';
        // Retrouver la valeur dans le tableau général nécesaire pour le calcul de la valeur de la cellule si double type
        if ($double != []) {
            foreach ($chart as $db_val) {
                if ($db_val['name_type_def'] == $double['name_type'] && $db_val['name_type_att'] == $type['name_type']) {
                    $double_value = $db_val['value_chart'];
                }
            }
        }
        // Valeurs des cellules
        foreach ($chart as $value) {
            if ($value['name_type_att'] == $type['name_type']) {
                if ($double != []) {
                    // Pas de valeur si double type identique au type principal
                    if ($value['name_type_def'] == $double['name_type']) {
                        $total_value = -1;
                    // Calcul de la valeur de la cellule si double type
                    } else {
                        $total_value = $value['value_chart'] * $double_value;
                    }
                // Valeur si pas de double type
                } else {
                    $total_value = $value['value_chart'];
                }
                // Classe de la cellule en fonction de sa valeur
                switch ($total_value) {
                    case 1:
                        $chart_content .= '<td class="normal_effect"></td>';
                        break;
                    case 0:
                        $chart_content .= '<td class="no_effect">× '.$total_value.'</td>';
                        break;
                    case 0.5:
                        $chart_content .= '<td class="not_very_effective">× ½</td>';
                        break;
                    case 2:
                        $chart_content .= '<td class="super_effective">× '.$total_value.'</td>';
                        break;
                    case 0.25:
                        $chart_content .= '<td class="double_not_very_effective">× ¼</td>';
                        break;
                    case 4:
                        $chart_content .= '<td class="double_super_effective">× '.$total_value.'</td>';
                        break;
                    case -1:
                        $chart_content .= '<td class="no_exist">—</td>';
                        break;
                }
            }
        }
        $chart_content .= '</tr>';
    }
    $chart_content .= '</tbody>';
    $chart_content .= '</table>';
    return $chart_content;
}
