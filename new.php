<?php

include_once('config/database.php');

// On récupère le numéro du nouveau pokémon
$searchLastId = $pdo->prepare('SELECT MAX(id_pokemon) AS id_last FROM pokedex');
$searchLastId->execute();
$lastId = $searchLastId->fetchAll();
$newId = $lastId[0]['id_last'] + 1;
$newNumber = str_pad($newId, 3, 0, STR_PAD_LEFT);

// On récupère la génération du nouveau pokémon
$searchGeneration = $pdo->prepare('SELECT short_name_generation FROM generations WHERE :num BETWEEN first_pokemon AND last_pokemon');
$searchGeneration->execute([
	'num' => $newId,
]);
$generation = $searchGeneration->fetchAll();
$generation = $generation[0]['short_name_generation'];

// On récupère l'image du nouveau pokémon
$newImage = "https://assets.pokemon.com/assets/cms2/img/pokedex/full/".$newId.".png";

// On récupère le numéro et le nom français des pokémon existants
// Nécessaire pour la partie Évolution
$pokemonListStatement = $pdo->prepare('SELECT id_pokemon, fr_name_pokemon FROM pokedex ORDER BY id_pokemon');
$pokemonListStatement->execute();
$pokemonList = $pokemonListStatement->fetchAll();

?>


<!DOCTYPE html>
<html>
<head>

    <?php include_once('includes/head.php'); ?>
    <link class="css_new" rel="stylesheet" type="text/css" href="css/new.css">
    <script src="script/new.js"></script>
    <title>Pokepedia - Ajouter un nouveau Pokémon dans le Pokédex</title>

</head>
<body>

    <?php include_once('includes/header.php'); ?>

	<!-- Page du formulaire pour rentrer un nouveau pokémon dans la base de données -->
    <div class="container">
		<!-- Formulaire -->
        <form id="" action="" method="post">
			<!-- Numéro du nouveau pokémon -->
            <div class="form_very_small">
                <label for="number">Numéro</label>
                <div class="form_very_small_box" id="form_number" name="number">
                    <input type="text" value="N° <?php echo($newNumber); ?>" id="" placeholder="Numéro" autocomplete="off" maxlength="6" readonly>
                </div>
            </div>
			<!-- Génération du nouveau pokémon -->
            <div class="form_very_small">
                <label for="number">Gén.</label>
                <div class="form_very_small_box" id="form_generation" name="generation">
                    <input type="text" value="<?php echo($generation); ?>" id="" placeholder="Gen" autocomplete="off" maxlength="4" readonly>
                </div>
            </div>
			<!-- Groupe du nouveau pokémon -->
            <div class="form_small">
                <label for="group">Groupe</label>
                <div class="form_small_box" id="form_group" name="group">

                </div>
            </div>
			<!-- Nom français du nouveau pokémon -->
            <div class="form_small">
                <label for="fr_name">Nom Français</label>
                <div class="form_small_box" id="form_fr_name" name="fr_name">
                    <input type="text" id="" placeholder="Nom Français" autocomplete="off" maxlength="12" autofocus="">
                </div>
            </div>
			<!-- Nom anglais du nouveau pokémon -->
            <div class="form_small">
                <label for="en_name">Nom Anglais</label>
                <div class="form_small_box" id="form_en_name" name="en_name">
                    <input type="text" id="" placeholder="Nom Anglais" autocomplete="off" maxlength="12">
                </div>
            </div>
			<!-- Nom japonais du nouveau pokémon -->
            <div class="form_normal">
                <label for="jp_name">Nom Japonais</label>
                <div class="form_normal_box" id="form_jp_name" name="jp_name">
                    <input type="text" id="" placeholder="Nom Japonais" autocomplete="off" maxlength="28">
                </div>
            </div>
			<!-- Image du nouveau pokémon -->
            <div class="form_very_big">
                <label for="image">Image</label>
                <div class="form_very_big_box" id="form_image" name="image">
                    <textarea placeholder="URL de l'Image" required readonly><?php echo($newImage); ?></textarea>
                    <?php echo(display_image($newImage)); ?>
                </div>
            </div>
			<!-- Premier type du nouveau pokémon -->
            <div class="form_small">
                <label for="first_type">Premier Type</label>
                <div class="form_small_box" id="form_first_type" name="first_type">
					<div class="form_type_selected" id="form_first_type_selected"></div>
					<!-- Liste des types -->
					<ul class="form_list_types" id="form_first_type_list">
						<?php foreach($types as $type) : ?>
							<li onclick="changeFirstType(<?php echo($type['id_type']); ?>)"><?php echo(display_type_tag($type)); ?></li>
						<?php endforeach ?>
					</ul>
                </div>
            </div>
			<!-- Second type du nouveau pokémon -->
            <div class="form_small">
                <label for="second_type">Second Type</label>
                <div class="form_small_box" id="form_second_type" name="second_type">
					<div class="form_type_selected" id="form_second_type_selected"></div>
					<!-- Liste des types -->
					<ul class="form_list_types" id="form_second_type_list">
						<li onclick="changeSecondType(0)">—</li>
						<?php foreach($types as $type) : ?>
							<li onclick="changeSecondType(<?php echo($type['id_type']); ?>)"><?php echo(display_type_tag($type)); ?></li>
						<?php endforeach ?>
					</ul>
                </div>
            </div>
			<!-- Évolution du nouveau pokémon -->
            <div class="form_normal">
                <label for="evolution">Évolution</label>
                <div class="form_normal_box" id="form_evolution" name="evolution">
					<!-- Partie où on sélectionne un pokémon existant -->
                    <div class="form_evolution_box">
                        <input type="text" id="form_evolution_from" placeholder="Évolution" autocomplete="off" maxlength="20">
                        <ul id="form_evolution_list">
                            <?php foreach($pokemonList as $pokemon) : ?>
                                <li>N° <?php echo(str_pad($pokemon['id_pokemon'], 3, 0, STR_PAD_LEFT)); ?> <?php echo($pokemon['fr_name_pokemon']); ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
					<!-- Bouton pour changer le sens de l'évolution -->
                    <div class="form_button from_to" id="form_evolution_button">►</div>
					<!-- Partie où se place le nouveau pokémon -->
                    <div class="form_evolution_box">
                        <input type="text" id="form_evolution_to" autocomplete="off" maxlength="20" readonly>
                    </div>
                </div>
            </div>
			<!-- Miniature du nouveau pokémon -->
            <div class="form_big">
                <label for="miniature">Miniature</label>
                <div class="form_big_box" id="form_miniature" name="miniature">
                    <textarea placeholder="URL de la Miniature" required></textarea>
                    <img src="" alt="">
                </div>
            </div>
			<!-- Chromatique du nouveau pokémon -->
            <div class="form_big">
                <label for="shiny">Chromatique</label>
                <div class="form_big_box" id="form_shiny" name="shiny">
                    <textarea placeholder="URL du Chromatique" required></textarea>
                    <img src="" alt="">
                </div>
            </div>
			<!-- Taille du nouveau pokémon -->
            <div class="form_normal">
                <label for="height">Taille</label>
                <div class="form_normal_box" id="form_height" name="height">
					<!-- Boutons pour réduire la taille -->
                    <div class="form_button" onclick="changeHeight(-100)">-100</div>
                    <div class="form_button" onclick="changeHeight(-10)">-10</div>
                    <div class="form_button" onclick="changeHeight(-1)">-1</div>
                    <div class="form_button" onclick="changeHeight(-0.1)">-0,1</div>
					<!-- Champ de saisie de la taille -->
                    <input type="text" id="form_height_value" value="000,0 m" inputmode="decimal">
					<!-- Boutons pour augmenter la taille -->
                    <div class="form_button" onclick="changeHeight(0.1)">+0,1</div>
                    <div class="form_button" onclick="changeHeight(1)">+1</div>
                    <div class="form_button" onclick="changeHeight(10)">+10</div>
                    <div class="form_button" onclick="changeHeight(100)">+100</div>
                </div>
            </div>
			<!-- Poids du nouveau pokémon -->
            <div class="form_normal">
                <label for="weight">Poids</label>
                <div class="form_normal_box" id="form_weight" name="weight">
					<!-- Boutons pour réduire le poids -->
                    <div class="form_button" onclick="changeWeight(-100)">-100</div>
                    <div class="form_button" onclick="changeWeight(-10)">-10</div>
                    <div class="form_button" onclick="changeWeight(-1)">-1</div>
                    <div class="form_button" onclick="changeWeight(-0.1)">-0,1</div>
					<!-- Champ de saisie du poids -->
                    <input type="text" id="form_weight_value" value="000,0 kg" inputmode="decimal">
					<!-- Boutons pour augmenter le poids -->
                    <div class="form_button" onclick="changeWeight(0.1)">+0,1</div>
                    <div class="form_button" onclick="changeWeight(1)">+1</div>
                    <div class="form_button" onclick="changeWeight(10)">+10</div>
                    <div class="form_button" onclick="changeWeight(100)">+100</div>
                </div>
            </div>
			<!-- Morphologie du nouveau pokémon -->
            <div class="form_normal">
                <label for="shape">Morphologie</label>
                <div class="form_normal_box" id="form_shape" name="shape">

                </div>
            </div>
			<!-- Sexe du nouveau pokémon -->
            <div class="form_normal">
                <label for="sex">Sexe</label>
                <div class="form_normal_box" id="form_sex" name="sex">

                </div>
            </div>
			<!-- Catégorie du nouveau pokémon -->
            <div class="form_small">
                <label for="category">Catégorie</label>
                <div class="form_small_box" id="form_category" name="category">
                    <input type="text" id="" placeholder="Catégorie" autocomplete="off" maxlength="12">
                </div>
            </div>
			<!-- Premier talent du nouveau pokémon -->
            <div class="form_small">
                <label for="first_talent">Premier Talent</label>
                <div class="form_small_box" id="form_first_talent" name="first_talent">
                    <input type="text" id="" placeholder="Premier Talent" autocomplete="off" maxlength="12">
                </div>
            </div>
			<!-- Second talent du nouveau pokémon -->
            <div class="form_small">
                <label for="second_talent">Second Talent</label>
                <div class="form_small_box" id="form_second_talent" name="second_talent">
                    <input type="text" id="" placeholder="Second Talent" autocomplete="off" maxlength="12">
                </div>
            </div>
			<!-- Talent caché du nouveau pokémon -->
            <div class="form_small">
                <label for="hidden_talent">Talent Caché</label>
                <div class="form_small_box" id="form_hidden_talent" name="hidden_talent">
                    <input type="text" id="" placeholder="Talent Caché" autocomplete="off" maxlength="12">
                </div>
            </div>

        </form>

    </div>

    <?php include_once('includes/footer.php'); ?>
</body>
</html>
