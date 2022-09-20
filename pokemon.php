<?php

include_once('config/database.php');

// On récupère l'id du pokémon
$getData = $_GET;
// Erreur si pas d'id
if (!isset($getData['id'])) {
	$error = "Aucun pokémon sélectionné !";
} else {
	// On vérifie que l'id existe en récupérant le dernier id existant
	$searchLastId = $pdo->prepare('SELECT MAX(id_pokemon) AS id_last FROM pokedex');
	$searchLastId->execute();
	$lastId = $searchLastId->fetchAll();
	$lastId = $lastId[0]['id_last'];
	// Erreur si l'id n'existe pas
	if ($getData['id'] > $lastId) {
		$error = "Ce pokémon n'existe pas !";
	} else {
		$pokemonId = $getData['id'];
		// On récupère les données du pokémon selon son id
		$searchPokemonData = $pdo->prepare('SELECT * FROM pokedex WHERE pokedex.id_pokemon = :id');
		$searchPokemonData->execute([
		    'id' => $pokemonId,
		]);
		$pokemonData = $searchPokemonData->fetchAll();

		$pokemon = [
		    'number' => str_pad($pokemonData[0]['id_pokemon'], 3, 0, STR_PAD_LEFT),
		    'fr_name' => $pokemonData[0]['fr_name_pokemon'],
		    'en_name' => $pokemonData[0]['en_name_pokemon'],
		    'jp_name' => $pokemonData[0]['jp_name_pokemon'],
		    'id_first_type' => $pokemonData[0]['id_first_type'],
		    'id_second_type' => $pokemonData[0]['id_second_type'],
		    'category' => $pokemonData[0]['category_pokemon'],
		    'height' => str_replace('.' , ',', $pokemonData[0]['height_pokemon']).' m',
		    'weight' => str_replace('.' , ',', $pokemonData[0]['weight_pokemon']).' kg',
		    'first_talent' => $pokemonData[0]['first_talent'],
		    'second_talent' => $pokemonData[0]['second_talent'],
		    'hidden_talent' => $pokemonData[0]['hidden_talent'],
		    'id_sex' => $pokemonData[0]['sex_pokemon'],
		    'id_shape' => $pokemonData[0]['body_shape'],
		    'group' => $pokemonData[0]['group_pokemon'],
		    'image' => $pokemonData[0]['image_pokemon'],
		    'miniature' => $pokemonData[0]['miniature_pokemon'],
		    'shiny' => $pokemonData[0]['shiny_pokemon'],
		];

		// On récupère les données du premier type du pokémon
		$searchFirstType = $pdo->prepare('SELECT * FROM types WHERE types.id_type = :id');
		$searchFirstType->execute([
		    'id' => $pokemon['id_first_type'],
		]);
		$firstType = $searchFirstType->fetchAll();
		// On récupère les données du second type du pokémon s'il existe
		if (isset($pokemon['id_second_type'])) {
		    $searchSecondType = $pdo->prepare('SELECT * FROM types WHERE types.id_type = :id');
		    $searchSecondType->execute([
		        'id' => $pokemon['id_second_type'],
		    ]);
		    $secondType = $searchSecondType->fetchAll();
		}

		// On récupère les données du sexe du pokémon
		$searchSex = $pdo->prepare('SELECT * FROM sexes WHERE sexes.id_sex = :id');
		$searchSex->execute([
		    'id' => $pokemon['id_sex'],
		]);
		$sex = $searchSex->fetchAll();

		$pokemonSex = [
		    'sex_name' => str_replace(' (' , '</br>(', $sex[0]['name_sex']),
		];

		// On récupère les données de la morphologie du pokémon
		$searchBodyShape = $pdo->prepare('SELECT * FROM shape WHERE shape.id_shape = :id');
		$searchBodyShape->execute([
		    'id' => $pokemon['id_shape'],
		]);
		$bodyShape = $searchBodyShape->fetchAll();

		$pokemonShape = [
		    'shape_name' => $bodyShape[0]['name_shape'],
		    'shape_image' => $bodyShape[0]['image_shape'],
		];

		// On récupère les id précédent et suivant de l'id du pokémon actuel
		// (on boucle si on atteint une limite)
		$previousId = $pokemonId-1;
		$nextId = $pokemonId+1;
		if ($previousId == 0) {
		    $previousId = $lastId;
		}
		if ($nextId > $lastId) {
			$nextId = 1;
		}

		// On récupère les données principales du pokémon précédent
		$searchPreviousData = $pdo->prepare('SELECT * FROM pokedex WHERE pokedex.id_pokemon = :id');
		$searchPreviousData->execute([
			'id' => $previousId,
		]);
		$previousData = $searchPreviousData->fetchAll();

		$previous = [
			'number' => str_pad($previousData[0]['id_pokemon'], 3, 0, STR_PAD_LEFT),
			'fr_name' => $previousData[0]['fr_name_pokemon'],
			'image' => $previousData[0]['image_pokemon'],
			'miniature' => $previousData[0]['miniature_pokemon'],
		];

		// On récupère les données principales du pokémon suivant
		$searchNextData = $pdo->prepare('SELECT * FROM pokedex WHERE pokedex.id_pokemon = :id');
		$searchNextData->execute([
			'id' => $nextId,
		]);
		$nextData = $searchNextData->fetchAll();

		$next = [
			'number' => str_pad($nextData[0]['id_pokemon'], 3, 0, STR_PAD_LEFT),
			'fr_name' => $nextData[0]['fr_name_pokemon'],
			'image' => $nextData[0]['image_pokemon'],
			'miniature' => $nextData[0]['miniature_pokemon'],
		];

		// On récupère la génération selon son l'id du pokémon actuel
		$searchGeneration = $pdo->prepare('SELECT name_generation FROM generations WHERE :num BETWEEN first_pokemon AND last_pokemon');
		$searchGeneration->execute([
			'num' => $pokemonData[0]['id_pokemon'],
		]);
		$generation = $searchGeneration->fetchAll();
		$generation = $generation[0]['name_generation'];

		// On récupère les sensibilités du premier type du pokémon
		$firstTypeEffectiveness = $pdo->prepare('SELECT types_att.name_type, types_att.logo_type, value_chart FROM types_chart
								INNER JOIN types AS types_att ON types_chart.id_type_att = types_att.id_type
								WHERE types_chart.id_type_def = :id
								ORDER BY name_type');
		$firstTypeEffectiveness->execute([
		    'id' => $pokemon['id_first_type'],
		]);
		$firstTypeEffect = $firstTypeEffectiveness->fetchAll();

		// On récupère les sensibilités du second type du pokémon s'il existe
		if (isset($pokemon['id_second_type'])) {
			$secondTypeEffectiveness = $pdo->prepare('SELECT types_att.name_type, value_chart FROM types_chart
									INNER JOIN types AS types_att ON types_chart.id_type_att = types_att.id_type
									WHERE types_chart.id_type_def = :id
									ORDER BY name_type');
			$secondTypeEffectiveness->execute([
			    'id' => $pokemon['id_second_type'],
			]);
			$secondTypeEffect = $secondTypeEffectiveness->fetchAll();

			// On calcule les sensibilités du pokémon en combinant les deux types
			for ($i=0; $i < count($firstTypeEffect); $i++) {
				$firstTypeEffect[$i]['value_chart'] = $firstTypeEffect[$i]['value_chart']*$secondTypeEffect[$i]['value_chart'];
			}
		}
		$pokemonEffectiveness = $firstTypeEffect;
	}
}

?>




<!DOCTYPE html>
<html>
<head>

    <?php include_once('includes/head.php'); ?>
    <link class="css_chart" rel="stylesheet" type="text/css" href="css/pokemon.css">
    <title><?php echo($pokemon['fr_name']); ?> - Pokepedia</title>

</head>
<body>

    <?php include_once('includes/header.php'); ?>

	<!-- Page du pokémon -->
	<div class="container">
		<!-- Si erreur, on affiche le message d'erreur -->
		<?php if (!isset($getData['id']) || $getData['id'] > $lastId) {
			echo ($error);
		} else {?>

		<!-- Section du menu pour accéder aux pokémon précédent et suivant -->
        <div id="pokemon_pagination">
			<!-- Pokémon précédent -->
            <a href="pokemon.php?id=<?php echo($previousId); ?>" id="pokemon_previous" class="pokemon_page">
				<div class="pokemon_pagination_arrow">◄</div>
                <?php echo(display_image($previous['miniature'])); ?>
				<div class="pokemon_pagination_number"><?php echo('N° '.$previous['number']); ?></div>
				<div class="pokemon_pagination_name"><?php echo($previous['fr_name']); ?></div>
            </a>
			<!-- Pokémon actuel -->
            <div class="pokemon_page" id="pokemon_current">
				<div class="pokemon_current_number"><?php echo('N° '.$pokemon['number']); ?></div>
				<?php echo(display_image($pokemon['miniature'])); ?>
				<div class="pokemon_current_name"><?php echo($pokemon['fr_name']); ?></div>
            </div>
			<!-- Pokémon suivant -->
            <a href="pokemon.php?id=<?php echo($nextId); ?>" id="pokemon_next" class="pokemon_page">
				<div class="pokemon_pagination_arrow">►</div>
				<?php echo(display_image($next['miniature'])); ?>
				<div class="pokemon_pagination_number"><?php echo('N° '.$next['number']); ?></div>
				<div class="pokemon_pagination_name"><?php echo($next['fr_name']); ?></div>
            </a>
        </div>

		<!-- Section des informations du pokémon -->
		<div id="pokemon_infos">
			<!-- Image du pokémon -->
			<?php echo(display_image($pokemon['image'])); ?>
			<div class="pokemon_infos_column">
				<!-- Numéro du pokémon -->
				<div class="pokemon_info_row">
					<div class="pokemon_info_title">Numéro</div>
					<div class="pokemon_info_result"><?php echo($pokemon['number']); ?></div>
				</div>
				<!-- Nom français du pokémon -->
				<div class="pokemon_info_row">
					<div class="pokemon_info_title">Nom Français</div>
					<div class="pokemon_info_result"><?php echo($pokemon['fr_name']); ?></div>
				</div>
				<!-- Nom anglais du pokémon -->
				<div class="pokemon_info_row">
					<div class="pokemon_info_title">Nom Anglais</div>
					<div class="pokemon_info_result"><?php echo($pokemon['en_name']); ?></div>
				</div>
				<!-- Nom japonais du pokémon -->
				<div class="pokemon_info_row">
					<div class="pokemon_info_title">Nom Japonais</div>
					<div class="pokemon_info_result"><?php echo($pokemon['jp_name']); ?></div>
				</div>
				<!-- Génération du pokémon -->
				<div class="pokemon_info_row">
					<div class="pokemon_info_title">Génération</div>
					<div class="pokemon_info_result"><?php echo($generation); ?> génération</div>
				</div>
				<!-- Premier type du pokémon -->
				<div class="pokemon_info_row">
					<div class="pokemon_info_title">Premier Type</div>
					<div class="pokemon_info_result"><?php echo(display_type_tag($firstType[0])); ?></div>
				</div>
				<!-- Second type du pokémon -->
				<div class="pokemon_info_row">
					<div class="pokemon_info_title">Second Type</div>
					<div class="pokemon_info_result">
						<?php if(isset($pokemon['id_second_type'])): ?>
							<?php echo(display_type_tag($secondType[0])); ?>
						<?php else: ?>—
						<?php endif; ?>
					</div>
				</div>
				<!-- Miniature du pokémon -->
				<div class="pokemon_info_cell">
					<div class="pokemon_info_title">Miniature</div>
					<div class="pokemon_info_image"><?php echo(display_image($pokemon['miniature'])); ?></div>
				</div>
				<!-- Chromatique du pokémon -->
				<div class="pokemon_info_cell">
					<div class="pokemon_info_title">Chromatique</div>
					<div class="pokemon_info_image">
						<?php if(isset($pokemon['shiny'])): ?>
							<?php echo(display_image($pokemon['shiny'])); ?>
						<?php else: ?>—
						<?php endif; ?>
					</div>
				</div>
			</div>
			<div class="pokemon_infos_column">
				<!-- Catégorie du pokémon -->
				<div class="pokemon_info_row">
					<div class="pokemon_info_title">Catégorie</div>
					<div class="pokemon_info_result"><?php echo($pokemon['category']); ?></div>
				</div>
				<!-- Taille du pokémon -->
				<div class="pokemon_info_row">
					<div class="pokemon_info_title">Taille</div>
					<div class="pokemon_info_result"><?php echo($pokemon['height']); ?></div>
				</div>
				<!-- Poids du pokémon -->
				<div class="pokemon_info_row">
					<div class="pokemon_info_title">Poids</div>
					<div class="pokemon_info_result"><?php echo($pokemon['weight']); ?></div>
				</div>
				<!-- Premier talent du pokémon -->
				<div class="pokemon_info_row">
					<div class="pokemon_info_title">Premier Talent</div>
					<div class="pokemon_info_result"><?php echo($pokemon['first_talent']); ?></div>
				</div>
				<!-- Second talent du pokémon -->
				<div class="pokemon_info_row">
					<div class="pokemon_info_title">Second Talent</div>
					<div class="pokemon_info_result">
						<?php if(isset($pokemon['second_talent'])): ?>
			                <?php echo($pokemon['second_talent']); ?>
						<?php else: ?>—
			            <?php endif; ?>
					</div>
				</div>
				<!-- Talent caché du pokémon -->
				<div class="pokemon_info_row">
					<div class="pokemon_info_title">Talent Caché</div>
					<div class="pokemon_info_result">
						<?php if(isset($pokemon['hidden_talent'])): ?>
			                <?php echo($pokemon['hidden_talent']); ?>
						<?php else: ?>—
			            <?php endif; ?>
					</div>
				</div>
				<!-- Sexe du pokémon -->
				<div class="pokemon_info_row">
					<div class="pokemon_info_title">Sexe</div>
					<div class="pokemon_info_result"><?php echo($pokemonSex['sex_name']); ?></div>
				</div>
				<!-- Morphologie du pokémon -->
				<div class="pokemon_info_row">
					<div class="pokemon_info_title">Morphologie</div>
					<div class="pokemon_info_result">
						<?php echo(display_image($pokemonShape['shape_image'])); ?>
						<?php echo($pokemonShape['shape_name']); ?>
					</div>
				</div>
				<!-- Groupe du pokémon -->
				<div class="pokemon_info_row">
					<div class="pokemon_info_title">Groupe</div>
					<div class="pokemon_info_result">
						<?php if(isset($pokemon['group'])): ?>
			                <?php echo($pokemon['group']); ?>
						<?php else: ?>—
			            <?php endif; ?>
					</div>
				</div>
			</div>
		</div>

		<!-- Section du tableau des sensibilités du pokémon -->
        <div class="pokemon_chart">
			<table>
				<!-- En-tête du tableau -->
				<thead>
					<!-- Titre du tableau -->
					<tr>
						<td class="pokemon_chart_title" colspan="19">
							<div class="pokemon_chart_name">Sensibilités de <?php echo($pokemon['fr_name']); ?></div>
							<div class="pokemon_chart_first_type <?php echo(strtolower($firstType[0]['en_name_type'])); ?>">
								<?php echo(display_image($firstType[0]['icon_type'])); ?>
								<div><?php echo($firstType[0]['name_type']); ?></div>
							</div>

							<?php if(isset($pokemon['id_second_type'])): ?>
								<div class="pokemon_chart_second_type <?php echo(strtolower($secondType[0]['en_name_type'])); ?>">
									<?php echo(display_image($secondType[0]['icon_type'])); ?>
									<div><?php echo($secondType[0]['name_type']); ?></div>
								</div>
							<?php endif; ?>
						</td>
					</tr>
				</thead>
				<!-- Corps du tableau -->
				<tbody>
					<tr>
						<!-- Image du pokémon -->
						<td class="pokemon_chart_image" rowspan="2"><?php echo(display_image($pokemon['image'])); ?></td>
						<!-- Types offensifs -->
						<?php foreach($types as $type) : ?>
							<td class="chart_type">
								<a href="" title="<?php echo($type['name_type']); ?>">
									<?php echo(display_image($type['logo_type'])); ?>
									<div class=""><?php echo($type['name_type']); ?></div>
								</a>
							</td>
				        <?php endforeach ?>
					</tr>
					<!-- Classe de la cellule en fonction de sa valeur -->
					<tr>
						<?php foreach($pokemonEffectiveness as $effect) : ?>
								<?php switch ($effect['value_chart']) :
								case 1 : ?>
									<td class="normal_effect"></td>
								<?php break; ?>
								<?php case 0 : ?>
									<td class="no_effect">× <?php echo($effect['value_chart']); ?></td>
								<?php break; ?>
								<?php case 0.5 : ?>
									<td class="not_very_effective">× ½</td>
								<?php break; ?>
								<?php case 2 : ?>
									<td class="super_effective">× <?php echo($effect['value_chart']); ?></td>
								<?php break; ?>
								<?php case 0.25 : ?>
									<td class="double_not_very_effective">× ¼</td>
								<?php break; ?>
								<?php case 4 : ?>
									<td class="double_super_effective">× <?php echo($effect['value_chart']); ?></td>
								<?php break; ?>
								<?php endswitch; ?>
						<?php endforeach ?>
					</tr>
				</tbody>
				<!-- Pied de page du tableau -->
				<tfoot>
					<!-- Légende du tableau des sensibilités -->
					<tr>
						<td class="pokemon_chart_legend_title">Légende</td>
						<td class="normal_effect"></td>
						<td class="pokemon_chart_legend_name" colspan="2">Neutralité</td>
						<td class="super_effective">× 2</td>
						<td class="pokemon_chart_legend_name" colspan="2">Faiblesse</td>
						<td class="not_very_effective">× ½</td>
						<td class="pokemon_chart_legend_name" colspan="2">Résistance</td>
						<td class="no_effect">× 0</td>
						<td class="pokemon_chart_legend_name" colspan="2">Immunité</td>
						<td class="double_super_effective">× 4</td>
						<td class="pokemon_chart_legend_name" colspan="2">Double Faiblesse</td>
						<td class="double_not_very_effective">× ¼</td>
						<td class="pokemon_chart_legend_name" colspan="2">Double Résistance</td>
					</tr>
				</tfoot>
			</table>
        </div>

		<?php } ?>

    </div>

    <?php include_once('includes/footer.php'); ?>
</body>
</html>
