<!DOCTYPE html>
<html>
<head>

    <?php include_once('includes/head.php'); ?>
    <link class="css_home" rel="stylesheet" type="text/css" href="css/home.css">
    <script src="script/search.js"></script>
    <title>Pokepedia - Page d'accueil</title>

</head>
<body>

    <?php include_once('includes/header.php'); ?>

    <!-- Page d'accueil -->
    <div class="container">

        <!-- Section de recherche de pokémon -->
        <section id="pokedex_menu">
            <!-- Recherche principale -->
            <div id="pokedex_base_search">
                <!-- Recherche par texte (nombre ou nom) -->
                <input id="pokedex_search" type="search" placeholder="Nom / Numéro" autocomplete="off" autofocus="">
                <!-- Recherche par génération -->
                <div id="pokedex_gen">
                    <div id="pokedex_gen_menu">
                        <div id="pokedex_gen_title">Toutes les générations</div>
                        <div id="pokedex_gen_arrow">▼</div>
                    </div>
                    <!-- Liste des générations -->
                    <ul id="pokedex_gen_list">
                        <li onclick="setSearchGeneration(0)">Toutes les générations</li>
                        <!-- <li onclick="setSearchGeneration(<?php echo(json_encode(intval(current($generations)['first_pokemon']))) ?>, <?php echo(json_encode(intval(end($generations)['last_pokemon']))) ?>)">Toutes les générations</li> -->
                        <?php foreach($generations as $generation) : ?>
                            <li onclick="setSearchGeneration(<?php echo($generation['id_generation']) ?>)"><?php echo($generation['name_generation']." génération"); ?></li>
                            <!-- <li onclick="setSearchGeneration(<?php echo($generation['first_pokemon']) ?>, <?php echo($generation['last_pokemon']) ?>)"><?php echo($generation['name_generation']." génération"); ?></li> -->
                        <?php endforeach ?>
                    </ul>
                </div>
                <!-- Bouton de recherche avancée -->
                <div id="pokedex_more">Afficher la recherche avancée</div>

                <!-- Boutons pour changer la vue de la liste des pokémon -->
                <div id="pokedex_view">
                    <div id="pokedex_view_title">Voir sous forme de</div>
                    <div id="pokedex_view_buttons">
                        <img class="pokedex_view_button" src="images/grid.png" onclick="setSearchView(1)"/>
                        <img class="pokedex_view_button" src="images/list.png" onclick="setSearchView(2)"/>
                    </div>
                </div>
                <!-- Boutons pour changer l'ordre de la liste des pokémon -->
                <div id="pokedex_sort">
                    <div id="pokedex_sort_title">Trier par</div>
                    <ul id="pokedex_sort_list">
                        <li onclick="setSearchSort(1)"><div>0 9</div><div>▲ ▼</div></li>
                        <li onclick="setSearchSort(2)"><div>9 0</div><div>▲ ▼</div></li>
                        <li onclick="setSearchSort(3)"><div>A Z</div><div>▲ ▼</div></li>
                        <li onclick="setSearchSort(4)"><div>Z A</div><div>▲ ▼</div></li>
                    </ul>
                </div>
            </div>

            <!-- Recherche avancée -->
            <div id="pokedex_advance_search" class="searchStart">
                <!-- Recherche par forme -->
                <div id="pokedex_forms">
                    <div id="pokedex_forms_title">Formes</div>
                    <ul id="pokedex_forms_list">
                        <li class="pokedex_form">Sans</li>
                        <li class="pokedex_form">Principales</li>
                        <li class="pokedex_form">Toutes</li>
                    </ul>
                </div>
                <!-- Recherche par type(s) -->
                <div id="pokedex_types">
                    <div id="pokedex_types_title">Types (2 max)</div>
                    <ul id="pokedex_types_list">
                        <?php foreach($types as $type) : ?>
                            <li title="<?php echo($type['name_type']) ?>" onclick="setSearchType('<?php echo(strtolower($type['en_name_type'])) ?>')"><?php echo(display_image($type['logo_type'])); ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Section de liste des pokémon -->
        <section id="pokedex_results"><!-- php/search.php -->
            <!-- <ul>
                <?php foreach($pokedex as $pokemon) : ?>
                    <li>
                        <?php echo(display_pokedex_pokemon($pokemon)); ?>
                    </li>
                <?php endforeach ?>
            </ul> -->
        </section>

    </div>

    <?php include_once('includes/footer.php'); ?>
</body>
</html>
